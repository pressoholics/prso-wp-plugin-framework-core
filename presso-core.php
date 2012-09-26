<?php
/*
Plugin Name: Presso Core Plugin
Version: 1.0
Author URI: http://Pressoholics.com
Plugin URI: http://Pressoholics.com
Description:  Plugin to handle all Pressoholic theme business logic.
Author: Ben Moody
*/

/**
 * Presso Plugin
 *
 * Plugin provides a framework to handle all business logic for Pressohoilc themes
 *
 * PHP versions 4 and 5
 *
 * @copyright     Pressoholics (http://pressoholics.com)
 * @link          http://pressoholics.com
 * @package       pressoholics theme framework
 * @since         Pressoholics v 1.0
 */

/**
* Call method to boot core framework
*
*/		
if( file_exists( dirname(__FILE__) . '/bootstrap.php' ) ) {

	if( !class_exists('PrsoCoreBootstrap') ) {
		
		/**
		* Include config file to set core definitions
		*
		*/
		if( file_exists( dirname(__FILE__) . '/config.php' ) ) {
			
			include( dirname(__FILE__) . '/config.php' );
			
			if( class_exists('PrsoCoreConfig') ) {
				
				new PrsoCoreConfig();
				
				//Core loaded, load rest of plugin core
				include( dirname(__FILE__) . '/bootstrap.php' );

				//Instantiate bootstrap class
				if( class_exists('PrsoCoreBootstrap') ) {
					new PrsoCoreBootstrap();
				}
				
			}
			
		}
		
	} else {
		
		//If there is a class namespace conflict, deactivate class and error out
		deactivate_plugins( __FILE__ );
		wp_die( wp_sprintf( '%1s: ' . __( 'Sorry, it appears that you already have a version of the Prso Core installed.', 'prso_core' ), __FILE__ ) );
		
	}
	
}

