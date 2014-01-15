<?php
/**
* [REPLACE_NAME] custom meta box setup
* 
* Makes use of Cuztom post type helper to setup post meta boxes
* 
* @access 	public
* @author	Ben Moody
*/

/**
* Add meta boxes to custom post type
* 
* Create a new meta box by adding an args array item to $add_box array:
*
* Some Options: others here -> https://github.com/Gizburdt/Wordpress-Cuztom-Helper/wiki/Meta-Boxes

Repeatable Fields:
	array(
        'name'          => 'name_text',
        'label'         => 'Text',
        'description'   => 'Text Description',
        'type'          => 'text',
        'repeatable'    => true
    )
    
Bundles (Repeatable):
	array(
            'bundle', 
        array(
            array(
                'name'          => 'model',
                'label'         => 'Model',
                'description'   => 'Model number',
                'type'          => 'text'
            ),
            array(
                'name'          => 'price',
                'label'         => 'Price',
                'description'   => 'Price of this model',
                'type'          => 'text'
            )
        )
    )

*
* NOTE:: 	To add multiple meta box sections to a custom post type just
*			add another args array to $add_box
*
* @access 	public
* @author	Ben Moody
*/
function [REPLACE_NAME]_add_meta_boxes() {
	
	//Init vars
	$PostType = NULL;
	$add_box = array();
	
	//Create cuztom object for post type - e.g. 'post', 'page', or other post type
	$PostType = new Cuztom_Post_Type( 'page' );
	
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
	
	//Loop add box args and call Cuztom helper on each
	foreach( $add_box as $key => $meta_box_args ) {
		$PostType->add_meta_box( $meta_box_args['box_id'], $meta_box_args['box_title'], $meta_box_args['box_args'] );
	}
	
}
[REPLACE_NAME]_add_meta_boxes();