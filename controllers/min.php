<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Min(ify) controller
 *
 * This controller will minify on the fly and cache (if set) results in order to quicker serve your static content
 * This code use Minify libs : http://code.google.com/p/minify/
 *
 * @author              Spir
 * @license             MIT
 * @version             0.2
 */

class Min extends CI_Controller {

	private $_request;
	private $_offset; // header cache delay
	private $_type; // type of requested file : js/css

	function __construct()
	{
		parent::__construct();

		// loading config
		$this->load->config('minify');
		
		// get type of request
		$segments = $this->uri->segment(1);

		if (count($segments))
		{
			switch($segments)
			{
				case $this->config->item('js_route_segment'):
					$this->_type = 'js';
					break;
					
				case $this->config->item('css_route_segment'):
					$this->_type = 'css';
					break;
					
				// should not append if route propely done, this switch could be extended for some other static items
				default:
					$this->_type = 'unknow';
					break;
			}
		}
	}
    

	/**
	 * load the files depending of type of request (single file or group files set in config)
	 */
	function _remap($request)
	{
		if ($this->_type=='unknow')
			$this->_error();
		
		# check if requested files is actually a group of js files
		$groups = $this->config->item($this->_type.'_groups'); // loading group of files
		if(array_key_exists($request, $groups))
		{
			$files = Array();
	    		$this->_request = $request;
	    		foreach($groups[$request] as $file)
	    		{
	    			$files[] = $this->config->item($this->_type.'_local_path').$file;
	    		}
	    		$this->_display($files);
	    	} 
	    	else # should be a file
	    	{    		
	    		# check if we are requesting a file within some folders
	    		if (is_dir($this->config->item($this->_type.'_local_path').$request))
	    		{
	    			$args = array_slice($this->uri->rsegments, 2);
	    			$path = implode("/", $args);
	    			$this->_request = $request.'/'.$path;
	    			$requested_file = $this->config->item($this->_type.'_local_path').$request.'/'.$path;
	    		} 
	    		else
	    		{
	    			$this->_request = $request;
	    			$requested_file = $this->config->item($this->_type.'_local_path').$request;
	    		}
	    		
	    		# check if requested files is actually a file
	    		if (file_exists($requested_file))
	    		{
	    			$this->_display(Array($requested_file));
	    		}
	    		else 
	    		{
	    			# error
	    			$this->_error();
	    		}
	    	}
	}


	private function _display($files)
	{
		# ci based cache
		$cache_name = str_replace('/','_', $this->_request); // this is why we needed that request var
	
		if (!$cache = $this->read_from_cache($cache_name))
		{
			$cache = $this->_minify($files);
			$this->write_to_cache($cache_name, $cache);
		}
	
		foreach ($cache['headers'] as $header => $value)
		{
			// we don't want to display ETag
			if ($header!='ETag')
				Header($header . ': ' . $value);
		}
		echo $cache['content'];
		exit;
	}    

	
	private function _minify($files=Array())
	{
		if (!$this->config->item('use_minify')){
			# set headers
			$cache = Array();
			$cache['headers'] = Array();
			$cache['headers']['Expires'] = gmdate("D, d M Y H:i:s", time() + $this->_offset) . " GMT";
			switch($this->_type)
			{
				case 'js':
					$cache['headers']['Content-type'] = 'application/x-javascript';
					break;
					
				case 'css':
					$cache['headers']['Content-type'] = 'text/css';
					break;
			}
			    		
			# loop on each file to grab it content
			$cache['content'] = '';
			foreach($files as $file){
				$cache['content'] .= file_get_contents($file);
			}
			return $cache;
		}
		else
		{
			# adding Minify scripts to the include path
			set_include_path($this->config->item('minify_lib_path') . PATH_SEPARATOR . get_include_path());
	
			# loading the minify scripts
			require_once 'Minify.php';
			require_once 'Minify/Cache/File.php';
	    	
			# setting the cache system
			if ($this->config->item('use_min_cache'))
	    			Minify::setCache(new Minify_Cache_File($this->config->item($this->_type.'_cache_path'))); // guesses a temp directory
	    	    	
			$sources = array();
			foreach($files as $file){
				$sources[] = new Minify_Source( Array( 'filepath' => $file ) ) ;
			}
	    	
			// setup serve options
			$options = array(
				'files' => $sources,
				'maxAge' => $this->config->item($this->_type.'_cache_max_age'),
				'quiet' => TRUE
			);
			
			return Minify::serve( 'Files', $options ) ;
		}
	}
    
    
	private function _error()
	{
		# 404
		show_404();
		exit;
	}
	

	function read_from_cache($name)
	{
		if ($this->config->item('use_ci_cache'))
		{
			return $this->cache->get($name);
		}
		return FALSE;
	}


	function write_to_cache($name, $value)
	{
		if ($this->config->item('use_ci_cache'))
		{
			$this->cache->write($value, $name);
		}
	}

}
