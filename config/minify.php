<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Minify config
 * 
 * This code use Minify libs : http://code.google.com/p/minify/
 *
 * @author              Spir
 * @license             MIT
 * @version             0.2
 */

/*
|--------------------------------------------------------------------------
| Minify settings
|--------------------------------------------------------------------------
|
| minify_lib_path : Path to Minify folder
| use_minify : set if minify is used or not
|
*/
$config['minify_lib_path'] 		= APPPATH.'/libraries/third_party/minify_2.1.3/lib/';
$config['use_minify']	 		= TRUE;
$config['use_ci_cache']	 		= FALSE; // set to TRUE if you use phil's cache lib
$config['use_min_cache']	 	= FALSE;

/*
|--------------------------------------------------------------------------
| CSS settings
|--------------------------------------------------------------------------
|
| css_local_path : Path to CSS folder
| css_cache_path : path to CSS cache folder
| css_cache_max_age: header expires
| css_groups: files name and path (relative to css_local_path)
| 			  do not names a group like a file!
|
*/
$config['css_route_segment'] 		= 'css';
$config['css_local_path'] 		= FCPATH.'/css/';
$config['css_cache_path'] 		= APPPATH.'/cache/'; // for minify cache only
$config['css_cache_max_age'] 		= 3600 * 24 * 7 * 4; // 4 week cache header
$config['css_groups']			= Array(
						'example1.css' => Array( // when loading example.com/css/example1.css you will load stylesheet1.css and stylesheet2.css into one single file
									'stylesheet1.css',
									'stylesheet2.css',
						),
						'example2.css' => Array( // when loading example.com/css/example2.css you will load stylesheet2.css and stylesheet3.css into one single file
									'stylesheet2.css',
									'stylesheet3.css',
						),
);

/*
|--------------------------------------------------------------------------
| JS settings
|--------------------------------------------------------------------------
|
| js_local_path : Path to JS folder
| js_cache_path : path to JS cache folder
| js_cache_max_age: header expires
| js_groups: files name and path (relative to js_local_path)
| 			 do not names a group like a file!
|
*/
$config['js_route_segment'] 		= 'js';
$config['js_local_path'] 		= FCPATH.'/js/';
$config['js_cache_path'] 		= APPPATH.'/cache/'; // for minify cache only
$config['js_cache_max_age'] 		= 3600 * 24 * 7 * 4; // 4 week cache header
$config['js_groups']			= Array(
						'example1.js' => Array( // when loading example.com/js/example1.js you will load javascript1.js and javascript2.js into one single file
								'javascript1.js',
								'javascript2.js',
						),
						'example2.js' => Array( // when loading example.com/js/example2.js you will load javascript2.js and javascript3.js into one single file
								'javascript2.js',
								'javascript3.js',
						),
);
