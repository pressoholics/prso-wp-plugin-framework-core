<?php
/**
* [REPLACE_NAME] custom taxonomy setup
* 
* Makes use of Cuztom post type helper to setup post taxonomy
* 
* @access 	public
* @author	Ben Moody
*/

/**
* Register new taxonomy with option to add meta boxes to taxonomy
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
*			add another args array to $tax_args
*
* @access 	public
* @author	Ben Moody
*/
function [REPLACE_NAME]_add_taxonomy() {
	
	//Init vars
	$Taxonomy = NULL;
	$tax_args = array();
	
	$tax_args[] = array(
		'tax_name'		=> '',
		'post_type'		=> '',
		'meta_boxes'	=> array(
			array(
                'name'        => __( '', 'text-domain' ),
                'label'       => __( '', 'text-domain' ),
                'description' => __( '', 'text-domain' ),
                'type'        => 'text'
            )
		)
	);
	
	//Loop add box args and call Cuztom helper on each
	foreach( $tax_args as $taxonomy_args ) {
		
		//First register new taxonomy
		$Taxonomy = register_cuztom_taxonomy( $taxonomy_args['tax_name'], $taxonomy_args['post_type'] );
		
		//Now add custom meta boxes if required
		if( isset($taxonomy_args['meta_boxes']) && !empty($taxonomy_args['meta_boxes']) ) {
		
			$Taxonomy->add_term_meta( $taxonomy_args['meta_boxes'] );
			
		}
		
	}
	
}
[REPLACE_NAME]_add_taxonomy();