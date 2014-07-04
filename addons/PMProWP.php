<?php
/**
 * File Name PMProWP.php
 * @package WordPress
 * @subpackage ProjectName
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 00.00.00
 **/
####################################################################################################





/**
 * PMProWP
 *
 * @version 1.0
 * @updated 00.00.00
 **/
$PMProWP = new PMProWP();
class PMProWP {
	
	
	
	/**
	 * Option name
	 * 
	 * @access public
	 * @var string
	 * Description:
	 * Used for various purposes when an import may be adding content to an option.
	 **/
	var $option_name = false;
	
	
	
	/**
	 * errors
	 * 
	 * @access public
	 * @var array
	 **/
	var $errors = array();
	
	
	
	/**
	 * have_errors
	 * 
	 * @access public
	 * @var bool
	 **/
	var $have_errors = 0;
	
	
	
	
	
	
	/**
	 * __construct
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function __construct() {

		// hook method after_setup_theme
		// add_action( 'after_setup_theme', array( &$this, 'after_setup_theme' ) );

		// hook method init
		add_action( 'init', array( &$this, 'init' ) );

		// hook method admin_init
		// add_action( 'admin_init', array( &$this, 'admin_init' ) );

	} // end function __construct
	
	
	
	
	
	
	/**
	 * after_setup_theme
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 *
	 * @codex http://codex.wordpress.org/Plugin_API/Action_Reference/after_setup_theme
	 **/
	function after_setup_theme() {
		
		// 
		
	} // end function after_setup_theme
	
	
	
	
	
	
	/**
	 * init
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 * @codex http://codex.wordpress.org/Plugin_API/Action_Reference/init
	 * 
	 * Description:
	 * Runs after WordPress has finished loading but before any headers are sent.
	 **/
	function init() {
		
		add_action( 'wp', array( &$this, 'template_redirect' ) );
		add_filter( 'body_class', array( &$this, 'body_class' ) );
		add_filter( 'admin_body_class', array( &$this, 'body_class' ) );
		
	} // end function init
	
	
	
	
	
	
	/**
	 * admin_init
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 * @codex http://codex.wordpress.org/Plugin_API/Action_Reference/admin_init
	 * 
	 * Description:
	 * admin_init is triggered before any other hook when a user access the admin area.
	 * This hook doesn't provide any parameters, so it can only be used to callback a 
	 * specified function.
	 **/
	function admin_init() {
		
		// 
		
	} // end function admin_init
	
	
	
	
	
	
	/**
	 * set
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function set( $key, $val = false ) {
		
		if ( isset( $key ) AND ! empty( $key ) ) {
			$this->$key = $val;
		}
		
	} // end function set
	
	
	
	
	
	
	/**
	 * error
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function error( $error_key ) {
		
		$this->errors[] = $error_key;
		
	} // end function error
	
	
	
	
	
	
	/**
	 * get
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function get( $key ) {
		
		if ( isset( $key ) AND ! empty( $key ) AND isset( $this->$key ) AND ! empty( $this->$key ) ) {
			return $this->$key;
		} else {
			return false;
		}
		
	} // end function get
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Functionality
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * template_redirect
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function template_redirect() {
		global $wp_query;
		
		if ( isset( $wp_query->post->ID ) AND $wp_query->post->ID == get_option('pmpro_levels_page_id') ) {
			wp_redirect( pmpro_url("checkout", "?level=1", "https"), 301 );
			exit;
		}
		
	} // end function template_redirect 
	
	
	
	
	
	
	/**
	 * body_class
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function body_class($classes) {
		global $userdata;
		
		if ( user_can($userdata, 'book-club-author' ) ) {
			if ( is_admin() ) {
				$classes .= "is-book-club-author";
			} else {
				$classes[] = 'is-book-club-author';
			}
		}
		
		return $classes;
		
	} // end function body_class
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Conditionals
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * have_errors
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function have_errors() {
		
		if ( isset( $this->errors ) AND ! empty( $this->errors ) AND is_array( $this->errors ) ) {
			$this->set( 'have_errors', 1 );
		} else {
			$this->set( 'have_errors', 0 );
		}
		
		return $this->have_errors;
		
	} // end function have_errors
	
	
	
} // end class PMProWP