<?php
/**
* [REPLACE_NAME] custom post type setup
* 
* Makes use of Cuztom post type helper to setup post type, taxonomies, fields
* for Cii home page slider
* 
* @access 	public
* @author	Ben Moody
*/

/**
* Setup post type
* 
* First let's register our custom post type
*
* @access 	public
* @author	Ben Moody
*/
add_action( 'init', '[REPLACE_NAME]_register_post_type', 1 );
function [REPLACE_NAME]_register_post_type() {
	
	//Init vars
	$CustomPostType = NULL;
	$args			= array();
	$labels			= array();
	$name			= array();
	
	//Set name label vars
	$name[0]	= 'Cuztom Post'; //Singluar name
	$name[1]	= 'Cuztom Posts'; //Plural name
	
	//Format args - no need to touch this
	$singular 	= $name[0];
	$plural		= $name[1];
	$slug		= Cuztom::uglify( $name[0] ); //Create a slug string from singular name
	
	//Set args
	$args = array(
		'public' 				=> true,
		'publicly_queryable' 	=> true,
		'show_ui' 				=> true, 
		'show_in_menu' 			=> true, 
		'query_var' 			=> true,
		'rewrite' 				=> array( 'slug' => $slug ),
		'capability_type' 		=> 'post',
		'has_archive' 			=> true, 
		'hierarchical' 			=> false,
		'menu_position' 		=> null,
		'supports' 				=> array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);
	
	//Set labels
	$labels = array(
		"name" 					=> $plural,
		"singular_name" 		=> $singular,
		"add_new" 				=> sprintf( __( 'Add New %1$s', 'text-domain' ), $singular ),
		"add_new_item" 			=> sprintf( __( 'Add New  %1$s', 'text-domain' ), $singular ),
		"edit_item" 			=> sprintf( __( 'Edit %1$s', 'text-domain' ), $singular ),
		"new_item" 				=> sprintf( __( 'New %1$s', 'text-domain' ), $singular ),
		"all_items" 			=> sprintf( __( 'All %1$s', 'text-domain' ), $plural ),
		"view_item" 			=> sprintf( __( 'View %1$s', 'text-domain' ), $plural ),
		"search_items" 			=> sprintf( __( 'Search %1$s', 'text-domain' ), $plural ),
		"not_found" 			=> sprintf( __( 'No %1$s', 'text-domain' ), $plural ),
		"not_found_in_trash" 	=> sprintf( __( 'No %1$s found in Trash', 'text-domain' ), $plural ), 
		"parent_item_colon" 	=> "",
		"menu_name" 			=> $plural
	);
	
	//Call cuztom helper to create post type
	$CustomPostType = new Cuztom_Post_type( $name, $args, $labels );
	
	//Call function to add meta boxes
	if( is_admin() ) {
		[REPLACE_NAME]_add_meta_boxes( $CustomPostType );
	}
	
}

/**
* Add meta boxes to custom post type
* 
* Create a new meta box by adding an args array item to $add_box array:
*
*	$add_box[] = array(
		'box_id'	=>	'',
		'box_title'	=>	__( '', 'text-domain' ),
		'box_args'	=>	array(
			array(
				'name'			=> __( '', 'text-domain' ),
				'label'			=> __( '', 'text-domain' ),
				'description'	=> __( '', 'text-domain' ),
				'type'			=> __( '', 'text-domain' )
			),
			array(
				'name'			=> __( '', 'text-domain' ),
				'label'			=> __( '', 'text-domain' ),
				'description'	=> __( '', 'text-domain' ),
				'type'			=> __( '', 'text-domain' )
			)
		)
	);
*
* NOTE:: 	To add multiple meta box sections to a custom post type just
*			add another args array to $add_box
*
* @access 	public
* @author	Ben Moody
*/
function [REPLACE_NAME]_add_meta_boxes( $CustomPostType ) {
	
	//Init vars
	$add_box = array();
	
	$add_box[] = array(
		'box_id'	=>	'meta_box_id',
		'box_title'	=>	__( '', 'text-domain' ),
		'box_args'	=>	array(
			array(
				'name'			=> __( '', 'text-domain' ),
				'label'			=> __( '', 'text-domain' ),
				'description'	=> __( '', 'text-domain' ),
				'type'			=> __( 'text', 'text-domain' )
			)
		)
	);
	
	//Uncomment to add separate box of meta fields
	/*
	$add_box[] = array(
		'box_id'	=>	'meta_box_id',
		'box_title'	=>	__( '', 'text-domain' ),
		'box_args'	=>	array(
			array(
				'name'			=> __( '', 'text-domain' ),
				'label'			=> __( '', 'text-domain' ),
				'description'	=> __( '', 'text-domain' ),
				'type'			=> __( 'text', 'text-domain' )
			)
		)
	);
	*/
	
	//Loop add box args and call Cuztom helper on each
	foreach( $add_box as $key => $meta_box_args ) {
		$CustomPostType->add_meta_box( $meta_box_args['box_id'], $meta_box_args['box_title'], $meta_box_args['box_args'] );
	}
	
}

/**
* Setup custom taxonomy
* 
* Add any custom taxonomy for your custom post type
*
* NOTE:: To add multiple taxonomies just copy this function, be sure
*		 to rename the function and update the function name in the add_action call.
*
* @access 	public
* @author	Ben Moody
*/
add_action( 'init', '[REPLACE_NAME]_register_taxonomy', 2 );
function [REPLACE_NAME]_register_taxonomy() {
	
	//Init vars
	$CustomTaxonomy = NULL;
	$post_type_slug = NULL;
	$args			= array();
	$labels			= array();
	$name			= array();
	
	//Set the post type to which this taxonomy should be added
	$post_type_slug = 'post';
	
	//Set name label vars
	$name[0]	= 'Cuztom Taxonomy'; //Singluar name
	$name[1]	= 'Cuztom Taxonomies'; //Plural name
	
	$singular 	= $name[0];
	$plural		= $name[1];
	$slug		= Cuztom::uglify( $name[0] ); //Create a slug string from singular name
	
	//Set args
	$args = array(
		'hierarchical'            => false,
		'show_ui'                 => true,
		'show_admin_column'       => true,
		'update_count_callback'   => NULL, // see in codex '_update_post_term_count'
		'query_var'               => true,
		'rewrite'                 => array( 'slug' => $slug )
	);
	
	//Set labels
	$labels = array(
		'name'                         => $plural,
		'singular_name'                => $singular,
		'search_items'                 => sprintf( __( 'Search %1$s', 'text-domain' ), $plural ),
		'popular_items'                => sprintf( __( 'Popular %1$s', 'text-domain' ), $plural ),
		'all_items'                    => sprintf( __( 'All %1$s', 'text-domain' ), $plural ),
		'parent_item'                  => null,
		'parent_item_colon'            => null,
		'edit_item'                    => sprintf( __( 'Edit %1$s', 'text-domain' ), $singular ), 
		'update_item'                  => sprintf( __( 'Update %1$s', 'text-domain' ), $singular ),
		'add_new_item'                 => sprintf( __( 'Add New %1$s', 'text-domain' ), $singular ),
		'new_item_name'                => sprintf( __( 'New %1$s', 'text-domain' ), $singular ),
		'separate_items_with_commas'   => sprintf( __( 'Separate %1$s with commas', 'text-domain' ), $plural ),
		'add_or_remove_items'          => sprintf( __( 'Add or remove %1$s', 'text-domain' ), $plural ),
		'choose_from_most_used'        => sprintf( __( 'Choose from the most used %1$s', 'text-domain' ), $plural ),
		'not_found'                    => sprintf( __( 'No %1$s found.', 'text-domain' ), $plural ),
		'menu_name'                    => $plural
	);
	
	//Call cuztom helper to create taxonomy
	$CustomTaxonomy = new Cuztom_Taxonomy( $name, $post_type_slug, $args, $labels );
	
}

/**
* After theme setup
* 
* Any actions you need to do for this custom post type after the theme
* had been setup - e.g. add_image_size
* 
* @access 	public
* @author	Ben Moody
*/
add_action( 'after_setup_theme', '[REPLACE_NAME]_theme_setup' );
function [REPLACE_NAME]_theme_setup() {
	//add_image_size( '', 100, 75, true );
}

/**
* Manage custom post type index view table columns
* 
* Add or remove columns from the index table for your custom post type
* 
* @access 	public
* @author	Ben Moody
*/
add_filter( 'manage_edit-slide_columns', '[REPLACE_NAME]_columns_filter', 10, 1 );
function [REPLACE_NAME]_columns_filter( $columns ) {
	
	/*
	$column_thumbnail = array( 
		'thumbnail' => 'Thumbnail' 
	);
	
	$columns = array_slice( $columns, 0, 1, true ) + $column_thumbnail + array_slice( $columns, 1, NULL, true );
	*/
	
	return $columns;
}

/**
* Add content to index view columns
* 
* @access 	public
* @author	Ben Moody
*/
add_action( 'manage_posts_custom_column', '[REPLACE_NAME]_column_action', 10, 1 );
function [REPLACE_NAME]_column_action( $column ) {

	global $post;
	/*
	switch ( $column ) {
		case 'thumbnail':
			echo get_the_post_thumbnail( $post->ID, 'edit-screen-thumbnail' );
		break;
	}
	*/
	
}