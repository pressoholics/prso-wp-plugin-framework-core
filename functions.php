<?php
/**
 * Database driven App Functions
 *
 * Contains functions that are driven by settings in the theme plugin admin panel.
 *
 * Use the Wordpress API call's within __construct to call your methods:
 *	//Action hook example
 *	add_action( 'init', array( &$this, 'test' ) ); 
 *
 * Contents:
 * 
 *
 */
class PrsoCoreFunctions extends PrsoCoreAppController {
	
	function __construct() {
	
		//Ensure vars set in config are available
 		parent::__construct();
 		
 		//Enqueue admin scripts
 		add_action( 'admin_enqueue_scripts', array($this, 'admin_enqueue_scripts') );
 		
	}
	
	function admin_enqueue_scripts() {
		
		//Register presso core's custom css for wp admin area
		wp_register_style( 'prso-core', 
			plugins_url('/stylesheets/core.css', __FILE__), 
			FALSE, 
			'1.0', 
			FALSE 
		);
		wp_enqueue_style( 'prso-core' );
		
	}
	
}