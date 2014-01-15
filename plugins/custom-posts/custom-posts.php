<?php
/**
* custom-posts.php
* 
* Loads the Wordpress Cuztom Helper class
*
* Also use this to include any custom post types you create for your project
* 
* https://github.com/Gizburdt/Wordpress-Cuztom-Helper/wiki
*
* @url 		https://github.com/Gizburdt/Wordpress-Cuztom-Helper
* @author	Ben Moody
*/

/**
* cuztom-helper
* 
* Includes the Wordpress Cuztom Helper inc file
* This helper class allows quick and easy creation of custom Post Types and Meta Fields
*
* See the template file in theme-post-types folder for example on how to use this
*
* @author	Ben Moody
*/
function prso_init_cuztom_helper() {
	
	//Init vars
	$file_path = plugin_dir_path( __FILE__ ) . "wordpress-cuztom-helper/cuztom.php";
	
	if( file_exists($file_path) ) {
		require_once( $file_path );
	}
	
}
prso_init_cuztom_helper();

/**
* Init theme posts types
* 
* Include the post type files for you theme here to set them up
*
* See the template file in theme-post-types folder for example on how to use this
*
* @author	Ben Moody
*/
function prso_init_theme_post_types() {
	
	//Init vars
	$file_path = plugin_dir_path( __FILE__ ) . "theme-post-types";
	
	//include_once( $file_path . '/cuztom-post-type_TEMPLATE.php' );
	
}
prso_init_theme_post_types();

/**
* Init theme meta boxes
* 
* Include the meta box files for you theme here to set them up
*
* See the template file in theme-meta-boxes folder for example on how to use this
*
* @author	Ben Moody
*/
function prso_init_theme_meta_boxes() {
	
	//Init vars
	$file_path = plugin_dir_path( __FILE__ ) . "theme-meta-boxes";
	
	//include_once( $file_path . '/cuztom-meta-box_TEMPLATE.php' );
	
}
prso_init_theme_meta_boxes();

/**
* Init theme taxonomies
* 
* Include the taxonomies files for you theme here to set them up
*
* See the template file in theme-taxonomies folder for example on how to use this
*
* @author	Ben Moody
*/
function prso_init_theme_taxonomies() {
	
	//Init vars
	$file_path = plugin_dir_path( __FILE__ ) . "theme-taxonomies";
	
	//include_once( $file_path . '/cuztom-taxonomy_TEMPLATE.php' );
	
}
prso_init_theme_taxonomies();

?>