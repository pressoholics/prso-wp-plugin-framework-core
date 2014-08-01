<?php
/**
* custom-posts.php
* 
* Register Custom post types and Taxonomies for use with current theme
*
* Use http://generatewp.com/ to generate code :)
*
* @author	Ben Moody
*/

function prso_init_custom_post_tax_filter_class() {
	
	//Init vars
	$file_path = plugin_dir_path( __FILE__ ) . "class.custom-post-tax-filter.php";
	
	include_once( $file_path );
}
prso_init_custom_post_tax_filter_class();

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
	global $prso_posttype_admin_icon;
	$file_path = plugin_dir_path( __FILE__ ) . "theme-post-types";
	
	$prso_posttype_admin_icon = get_stylesheet_directory_uri() . '/images/admin/custom_post_icon.png';
	
	//include_once( $file_path . '/cuztom-post-type_TEMPLATE.php' );
	
}
prso_init_theme_post_types();

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

/**
* Init theme custom fields
* 
* Include adv custom field export
*
* @author	Ben Moody
*/
function prso_init_acf_custom_fields() {
	
	//Init vars
	$file_path = plugin_dir_path( __FILE__ ) . "custom-fields.php";
	$acf_path = plugin_dir_path( __FILE__ ) . "/advanced-custom-fields/acf.php";
	
	define( 'ACF_LITE', true );
	
	include_once( $acf_path );
	include_once( $file_path );
	
}
//prso_init_acf_custom_fields();

/**
* Init theme custom fields -- PRO VERSION
* 
* Include adv custom field export
*
* @author	Ben Moody
*/
function prso_init_acf_PRO_custom_fields() {
	
	//Init vars
	$file_path = plugin_dir_path( __FILE__ ) . "custom-fields.php";
	$acf_path = plugin_dir_path( __FILE__ ) . "/advanced-custom-fields-pro/acf.php";
	
	include_once( $acf_path );
	include_once( $file_path );
	
	//Setup acf paths
	add_filter('acf/settings/path', 'prso_acf_settings_path');
	add_filter('acf/settings/dir', 'prso_acf_settings_dir');
	
	//Disable backend user options
	//add_filter('acf/settings/show_admin', '__return_false');
	
}
prso_init_acf_PRO_custom_fields();

function prso_acf_settings_path( $path ) {
 
	// update path
	$path = plugin_dir_path( __FILE__ ) . '/advanced-custom-fields-pro/';
	
	// return
	return $path;
	
}
function prso_acf_settings_dir( $dir ) {
 
	// update path
	$dir = plugin_dir_url( __FILE__ ) . '/advanced-custom-fields-pro/';
	
	// return
	return $dir;
	
}
?>