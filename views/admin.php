<?php
/**
* PressoPosts Plugin View.
*
* How to use:
*	1. During __contruct class will check that PrsoCore framwork plugin is active, call methods to add wp menu pages
		for this plugin page and register a setting and sanitization callback for this options page.
		
	2. __construct also calls method to cache the plugin's option db data in the plugin shared $data array. 
		You can easily access this data by calling $this->data[ $this->plugin_options_db_slug ].
		
	3. Set your plugin options in $this->plugin_view_options()
		
	4. In $this->add_admin_page() select whether you want to add a top level menu section for you plugin or add a sub menu page
		NOTE the preset wp functions make use of the plugin shared vars set in config.php
		NOTE replace "array( &$this, 'start_plugin_options_page' )" with the method that will render your options page IF you
		don't want to use the Prso default of $this->start_plugin_options_page.
	
	5. If this plugin page is a sub page be sure to update the plugin shared var names ($this->page_title_CHILDNAMEHERE) as you
		set them in config.php
		
	6. Create all your option page sections and fields using $this->setup_sections() AND $this->setup_fields.
		NOTE use the commented examples (copy and paste them) and change the required vars. The arrays of section and field args
		are used by the PrsoCore custom WP actions 'prso_core_option_page_sections' AND 'prso_core_option_page_fields' to render 
		your plugin page's section and field html automagically.
	
	
	6. $this->create_settings() calls WP register_setting() to register the validation callback method AND it hooks into PrsoCore Framework
		actions to render options page sections and fields.
		NOTE see how action hook 'prso_core_option_page_fields' requires that we pass it the plugin data for this page - $this->data[ $this->plugin_options_db_slug ]
		the action will use the page slug param (2nd param) to try and find the option data for this specific page e.g. - $this->data[ $this->plugin_options_db_slug ][ $this->this_view_slug ]
	
	7. Once the plugin page sections and fields have been setup you can use $this->validate() to select fields to sanitize and validate.
		NOTE: use the commented example to quickyl setup the args for each field you wish to validate.
		NOTE: the PrsoCore validation helper will automatically add a user message on both success and error so don;t worry about that
	
		
	8. If you need to add custom methods for this plugin page go to the bottom of the class and add them under the comment marker
*
*/

class PrsoCoreAdminView extends PrsoCoreFunctions {
	
	/*********************************************************************
	* Prso Plugin Framework Default View Methods
	* Add custom methods for this view at near bottom of class after $this->validate()
	*********************************************************************/ 
	
	/**
	* PLUGIN VIEW OPTIONS
	**/
	private function plugin_view_options() {

		//Cache the page slug for this page - select the correct shared var you set for this page in config.php
		$this->this_view_slug = $this->menu_slug_parent;
		
		//Cache the page title for this page - select the correct shared var you set for this page in config.php
		$this->this_view_title = $this->page_title_parent;
		
		//Set the screen icon for this plugin view
		$this->this_view_screen_icon = 'options-general';
		
		//Set the submit button title for this view
		$this->this_view_submit_btn_title = 'Submit';
		
		//Set user message to show on form validation success - OPTIONAL
		$this->validation_success_message = NULL;
		
		//Set user message to show on form validation fail - OPTIONAL
		$this->validation_fail_message = NULL;
	}
	
	/**
	* add_admin_page
	* 
	* Add a wp admin menu item for this page
	* 
	*	Examples for add_submenu_page WP parent slug strings:

	    For Dashboard: add_submenu_page('index.php',...)
	    For Posts: add_submenu_page('edit.php',...)
	    For Media: add_submenu_page('upload.php',...)
	    For Links: add_submenu_page('link-manager.php',...)
	    For Pages: add_submenu_page('edit.php?post_type=page',...)
	    For Comments: add_submenu_page('edit-comments.php',...)
	    For Custom Post Types: add_submenu_page('edit.php?post_type=your_post_type',...)
	    For Appearance: add_submenu_page('themes.php',...)
	    For Plugins: add_submenu_page('plugins.php',...)
	    For Users: add_submenu_page('users.php',...)
	    For Tools: add_submenu_page('tools.php',...)
	    For Settings: add_submenu_page('options-general.php',...) 
	*
	* @access 	public
	* @author	Ben Moody
	*/
	public function add_admin_page() {
		
		//Use to add a top level menu section - if you want to make use of the PrsoCore request router set function to array( &$this, 'request_router' )
		/*
		add_menu_page(
			$this->page_title_parent,
			$this->menu_title_parent,
			$this->capability_parent,
			$this->menu_slug_parent,
			array( &$this, 'start_plugin_options_page' ),
			$this->icon_url_parent,
			$this->position_parent
		);
		*/
		
		//Use to add a sub menu page
		add_submenu_page(
			'options-general.php',
			$this->page_title_parent,
			$this->menu_title_parent,
			$this->capability_parent,
			$this->menu_slug_parent,
			array( &$this, 'start_plugin_options_page' )
		);
		
	}
	
	/**
	* setup_sections
	* 
	* Add section options array to $output to create a new section
	*
	* See the commented example within function.
	* 
	* @access 	private
	* @author	Ben Moody
	*/
	private function setup_sections() {
		
		//Init vars
		$output = false;
		
		/**
		* ADD PLUGIN OPTION SECTIONS HERE - use example
		**/
		
			/*
			$output[] = array(
				'id' 		=> $this->get_slug('general_options'),
				'title'		=> ''
			);
			*/
		
		/**
		* END PLUGIN OPTION SECTIONS
		**/
		
		return $output;
	}
	
	/**
	* setup_fields
	* 
	* Add field options array to $output to create a new section field
	*
	* See the commented example within function.
	*
	* 'type' is required as this is used by the admin model (in presso plugin) to decide how to output the form element html.
	* 
	* 	'type' Options: text, textarea, select, checkbox
	* 
	* @access 	private
	* @author	Ben Moody
	*/
	private function setup_fields() {
		
		//Init vars
		$output = false;
		
		/**
		* ADD PLUGIN SECTION FIELDS HERE - use example
		**/
		
			/*
			$output[] = array(
				'section' 	=> $this->get_slug('general_options'),
				'id'		=> $this->get_slug('field_legal_html'),
				'title'		=> '',
				'desc'		=> '',
				'type'		=> '',
				'default'	=> ''
			);
			*/
		
		/**
		* END PLUGIN SECTION FIELDS
		**/
		
		return $output;
	}
	
	/**
	* Validate
	* 
	* Makes use of the pressoholics framework validation helper to validate/sanitize data
	* Also uses the flash helper to return a message to the user.
	*
	* HOW TO USE:
	*	You should only have to add the fields you wish to validate into the $validate array
	*
	*	Like this: 
	*	$validate[ $fb_url_slug ] = array( 'nice_name' => 'Facebook Page Url', 'type' => 'url', 'message' => 'Invalid URL.', 'empty' => true ,'regex' => null );
	*
	*	'type' tells the validation model how to validate the field e.g phone_us, email, url, password
	*	'empty'	NOT REQUIRED will tell the validator that you are happy to let this field be null
	*	'regex'	This will override the 'type' arg and the validator will use the regex provided to validate the field
	* 
	* @access 	public
	* @author	Ben Moody
	*/
	public function validate( $data = array() ) {
		
		//Init vars
		$validate = array(); //An array of fields to validate
		
		//Set options args to override validation messages
		$args = array(
			'success_message' 	=> $this->validation_success_message,
			'fail_message'		=> $this->validation_fail_message
		);
		
		/**
		* ADD YOU VALIDATION OPTIONS HERE
		**/
		
			//Facebook Url//
			//$fb_url_slug = $this->get_slug('field_fb_url');
			//$validate[ $fb_url_slug ] = array( 'nice_name' => 'Facebook Page Url', 'type' => 'url', 'message' => 'Invalid URL.', 'empty' => true ,'regex' => null );	

		/**
		* END VALIDATION OPTIONS
		**/
		
		return apply_filters( 'prso_core_validate_plugin_fields', $validate, $data );
		
	}
	
	
	
	
	
	/**************************************************************************************************************************************
	* Custom Methods For This Plugin View Class - ADD YOUR METHODS HERE!!
	**/
	
	
	
	
	/**************************************************************************************************************************************
	* END Custom Methods For This Plugin View Class
	**/
	
	
	
	
	
	
	
	
	/**************************************************************************************************************************************
	* YOU SHOULDN'T HAVE TO EDIT THESE BUT IF YOU HAVE TO GO FOR IT
	**/
	
	private $this_view_slug 			= NULL;
	private $this_view_title			= NULL;
	private $this_view_screen_icon		= NULL;
	private $this_view_submit_btn_title	= NULL;
	private $validation_success_message	= NULL;
	private $validation_fail_message	= NULL;
	
	function __construct() {
		
		//Ensure vars set in config are available
 		parent::__construct();
		
		//Call method to set plugin view options
		$this->plugin_view_options();
		
		//Call method to cache plugin options data in plugin's $data array - see app_controller.php
		$this->get_plugin_options( NULL, $this->plugin_options_db_slug );
		
		//Add main parent page for theme admin section
 		add_action('admin_menu', array( &$this, 'add_admin_page' ));
		
		//Register sections and define fields
		add_action('admin_init', array(&$this, 'create_settings'));
		
	}
	
	/**
	* start_option_page
	* 
	* Used by wp function add_menu_page to create and parse the admin options page
	* Uses the PrsoCore 'prso_core_render_plugin_view' filter to call the required WP functions
	* and generate the required html to render a WP compliant plugin options page.
	*
	* NOTE you can insert custom html into the view using some filters:
	*	+ Before option page form use $this->render_before_options_form
	*	+ Before options page form submit button use $this->render_before_options_form_submit
	*	+ After options page form use $this->render_after_options_form
	* 
	* @access 	public
	* @author	Ben Moody
	*/
	public function start_plugin_options_page() {
		
		//Init args
		$view_output = NULL;
		$args = array(
			'screen_icon' 	=> $this->this_view_screen_icon,
			'view_slug'		=> $this->this_view_slug,
			'view_title'	=> $this->this_view_title,
			'submit_title'	=> $this->this_view_submit_btn_title,
		);
		
		//Add custom html before the option page form - see $this->render_before_options_form
		add_filter( 'prso_core_render_plugin_view_before_form', array( &$this, 'render_before_options_form' ) );
		
		//Add custom html after the option page form - see $this->render_before_options_form_submit
		add_filter( 'prso_core_render_plugin_view_before_submit', array( &$this, 'render_before_options_form_submit' ) );
		
		//Add custom html after the option page form - see $this->render_after_options_form
		add_filter( 'prso_core_render_plugin_view_after_form', array( &$this, 'render_after_options_form' ) );
		
		//Render the plugin options view
		echo apply_filters( 'prso_core_render_plugin_view', $view_output, $args );
		
	}
	
	/**
	* create_settings
	* 
	* Register a setting and it's sanitization callback
	*
	* This is part of the Settings API, which lets you automatically generate 
	* wp-admin settings pages by registering your settings and using a 
	* few callbacks to control the output. 
	* 
	* @access 	public
	* @author	Ben Moody
	*/
	public function create_settings() {
		
		//Init vars
		$field_data = array();
		
		//Register santization callback
		register_setting(
			$this->this_view_slug,
			$this->this_view_slug,
			array( &$this, 'validate' )
		);
		
		//Setup sections
		do_action( 'prso_core_option_page_sections', $this->setup_sections(), $this->this_view_slug );
		
		//Setup fields and current field values
		if( isset($this->data[$this->plugin_options_db_slug][$this->this_view_slug]) ) {
			//Cache all plugin data for PrsoCore WP action 'prso_core_option_page_fields'
			$field_data = $this->data[$this->plugin_options_db_slug];
		}
		do_action( 'prso_core_option_page_fields', $this->setup_fields(), $this->this_view_slug, $field_data );
	}
	
	/**
	* render_before_options_form
	* 
	* Add custom html before the plugin options form in the plugin view
	*
	* 
	* @access 	public
	* @author	Ben Moody
	*/
	public function render_before_options_form() {
		
		//Init vars
		$output = NULL;
		
		ob_start();
		//ADD YOUR CUSTOM HTML HERE
		?>
		
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		
		echo $output;
	}
	
	/**
	* render_before_options_form_submit
	* 
	* Add custom html before the plugin options form submit button in the plugin view
	*
	* 
	* @access 	public
	* @author	Ben Moody
	*/
	public function render_before_options_form_submit() {
		
		//Init vars
		$output = NULL;
		
		ob_start();
		//ADD YOUR CUSTOM HTML HERE
		?>
		
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		
		echo $output;
	}
	
	/**
	* render_after_options_form
	* 
	* Add custom html after the plugin options form in the plugin view
	*
	* 
	* @access 	public
	* @author	Ben Moody
	*/
	public function render_after_options_form() {
		
		//Init vars
		$output = NULL;
		
		ob_start();
		//ADD YOUR CUSTOM HTML HERE
		?>
		
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		
		echo $output;
	}
	
}