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
$config['css_local_path'] 		= FCPATH.'/css/';
$config['css_cache_path'] 		= APPPATH.'/cache/'; // for minify cache only
$config['css_cache_max_age'] 	= 3600 * 24 * 7 * 4; // 4 week cache header
$config['css_groups']			= Array(
										/* FRONTEND */
										'front.css' => Array(
												'reset.css',
												'base.css',
												'jquery-ui-1.8.10.custom.css',
												'main.css',
										),
										/* BACKEND */
										'super_admin.css' => Array(
											'reset.css',
											'grid.css',
											'superfish.css',
											'uniform.default.css',
											'jquery.wysiwyg.css',
											'facebox.css',
											'smoothness/jquery-ui-1.8.8.custom.css',
											'jqueryFileTree.css',
											'style.css',
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
$config['js_local_path'] 		= FCPATH.'/js/';
$config['js_cache_path'] 		= APPPATH.'/cache/'; // for minify cache only
$config['js_cache_max_age'] 	= 3600 * 24 * 7 * 4; // 4 week cache header
$config['js_groups']		= Array(
									/* FRONTEND */
									'javascript.js' => Array(
										'jquery-1.6.min.js',
										'jquery-ui-1.8.10.custom.min.js',
										'jquery.nivo.slider.pack.js',
										'jquery.cycle.min.js',
										'jquery.showLoading.min.js',
										'jquery.ui.selectmenu.js',
										'frontend.js'
									),
									/* BACKEND */
									'super_admin.js' => Array(
										'jquery.1.5.2.min.js', 
										'jquery-ui-1.8.8.custom.min.js', 
										'jquery.validate.min.js', 
										'jquery.uniform.min.js', 
										'jquery.wysiwyg.js',
										'manager.js',										
									),
);