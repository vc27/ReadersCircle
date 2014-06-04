<?php
/**
 * File Name TemplatePageOptionsVCWP.php
 * @package WordPress
 * @subpackage ParentTheme_VC
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.2
 * @updated 10.16.13
 **/
####################################################################################################





/**
 * TemplatePageOptionsVCWP
 *
 * @version 1.0
 * @updated 00.00.13
 **/
$TemplatePageOptionsVCWP = new TemplatePageOptionsVCWP();
class TemplatePageOptionsVCWP {
	
	
	
	/**
	 * Option name
	 * 
	 * @access public
	 * @var string
	 * Description:
	 * Used for various purposes when an import may be adding content to an option.
	 **/
	var $option_name = 'template_page_options';
	
	
	
	
	
	
	/**
	 * __construct
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function __construct() {

		// hook method after_setup_theme
		add_action( 'after_setup_theme', array( &$this, 'after_setup_theme' ) );

	} // end function __construct
	
	
	
	
	
	
	/**
	 * after_setup_theme
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 *
	 * @codex http://codex.wordpress.org/Plugin_API/Action_Reference/after_setup_theme
	 **/
	function after_setup_theme() {
		
		$this->add_options_page();
		
	} // end function after_setup_theme
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Functionality
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * add_options_page
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function add_options_page() {
		
		create__options_page( array(

			'version' => '1.0',

			'option_name' => "_$this->option_name",
			'option_group' => $this->option_name,

			'add_submenu_page' => array(
				'parent_slug' => 'edit.php?post_type=page',
				'page_title' => 'Template Options',
				'menu_title' => 'Template Options',
				'capability' => 'administrator',
				),

			// 'options_page_title' => false,
			'options_page_desc' => 'General options for various page templates.',

			// Metaboxs and Optionns
			'options' => array(
                
				// Default Metabox and Options
				'general' => array(

					// Metabox
					'meta_box' => array(
						'title' => 'General Page Setting',
						'context' => 'normal',
						'priority' => 'core',
						'desc' => 'Overall settings for various template pages.',
						// 'callback' => array( &$this, 'custom_meta_box_option' ),
						'save_all_settings' => 'Save', // uses value as button text & sanitize_title_with_dashes(save_all_settings) for value
						),

					// settings and options
					'settings' => array(

						// Single setting and option
						'test_link' => array(
							'type' => 'text',
							'validation' => 'text',
							'title' => 'Test Link',
							'desc' => 'This is a test link as an example.',
							),
						),
					), // end Default Metabox and Options

				),

			) ); // end default_settings array
	} // end function add_options_page
	
	
	
} // end class TemplatePageOptionsVCWP