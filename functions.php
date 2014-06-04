<?php
/**
 * File Name functions.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 2.4
 * @updated 04.14.14
 **/
#################################################################################################### */


/**
 * ThemeCompatibility
 * 
 * @access public
 * @var int
 **/
$ThemeCompatibility = 5.0;



/**
 * Initiate Addons
 **/
require_once( "addons/initiate-addons.php" );






/**
 * ChildTheme_VC Class
 *
 * @version 1.5
 * @updated 10.17.13
 **/
$ChildTheme_VC = new ChildTheme_VC();
$ChildTheme_VC->set( 'ThemeCompatibility', $ThemeCompatibility );
$ChildTheme_VC->init_child_theme();
class ChildTheme_VC {
	
	
	
	/**
	 * is_IE
	 *
	 * @version 1.0
	 * @updated 06.02.14
	 **/
	var $is_IE = false;
	
	
	
	
	
	
	/**
	 * __construct
	 *
	 * @version 1.0
	 * @updated 10.17.13
	 **/
	function __construct() {
		
		if ( isset( $_GET['is_IE'] ) ) {
			$this->set( 'is_IE', 1 );
		}
		
		$this->set( 'stylesheet_directory', get_stylesheet_directory() );
		$this->set( 'stylesheet_directory_uri', get_stylesheet_directory_uri() );
		$this->set( 'ajax_action', 'vc-ajax' );
		
	} // end function __construct
	
	
	
	
	
	
	/**
	 * init_child_theme
	 *
	 * @version 1.0
	 * @updated 10.17.13
	 **/
	function init_child_theme() {
		
		add_action( 'init', array( &$this, 'init' ) );
		
	} // end function init_child_theme
	
	
	
	
	
	
	/**
     * set
     *
     * @version 1.0
     * @updated 00.00.13
     **/
    function set( $key, $val = false ) {

        if ( isset( $key ) AND ! empty( $key ) ) {
            $this->$key = $val;
        }

    } // end function set
	
	
	
	
	
	
	/**
	 * After Setup Theme
	 *
	 * @version 1.0
	 * @updated 11.18.12
	 **/
	function after_setup_theme() {
		
		// Translations can be added to the /languages/ directory.
		load_theme_textdomain( 'childtheme', "$this->stylesheet_directory/languages" );
		load_theme_textdomain( 'parenttheme', $this->parent_theme->template_directory . "/languages" );
		
	} // end function after_setup_theme
	
	
	
	
	
	
	/**
	 * Initiate
	 *
	 * @version 1.0
	 * @updated 11.18.12
	 **/
	function init() {
		
		// Add Parent Theme class
		$this->set( 'parent_theme', new ParentTheme_VC() );
		
		
		// register_sidebars
		$register_sidebars = $this->parent_theme->register_sidebars( array(
			'Primary Sidebar' => array(
				'desc' => 'This is the primary widgetized area.',
			),
		) );
		
		
		// register_nav_menus
		register_nav_menus( array(
			'primary-navigation' => 'Primary Navigation',
			'footer-navigation' => 'Footer Navigation'
		) );
		
		
		// register styles and scripts
		$this->register_style_and_scripts();
		
		
		/**
		 * Front End - Enqueue, Print & other menial labor
		 **/
		
		// Layout Options
		add_action( 'template_redirect', array( &$this, 'layout_options' ) );
		
		// CSS // wp_print_styles
		add_action( 'wp_enqueue_scripts', array( &$this, 'wp_print_styles' ) );
		
		// Javascripts // wp_enqueue_scripts // wp_print_scripts
		add_action( 'wp_enqueue_scripts', array( &$this, 'wp_enqueue_scripts' ) );
		add_filter( 'parenttheme-localize_script', array( &$this, 'localize_script' ) );
		
		add_action( 'wp_enqueue_scripts', array( &$this, 'deregister' ), 10 );
		
		// Breadcrumb Navigation
		add_action( 'inner_wrap_top', array( &$this, 'breadcrumb_navigation' ) );
		
		// Login Scripts
		add_action( 'login_enqueue_scripts', array( &$this, 'login_enqueue_scripts' ) );
		
	} // end function init
	
	
	
	
	
	
	/**
	 * Admin Initiate
	 *
	 * @version 1.0
	 * @updated 11.18.12
	 **/
	function admin_init() {
		
		
		
	} // end function admin_init 
	
	
	
	
	
	
	/**
	 * Widgets Initiate
	 *
	 * @version 1.0
	 * @updated 11.18.12
	 **/
	function widgets_init() {
		
		// widgets_init
		
	} // end function widgets_init
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Register / De-Register Scripts & CSS
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * register_style_and_scripts
	 *
	 * @version 2.1
	 * @updated 04.15.14
	 **/
	function register_style_and_scripts() {
		global $is_IE;
		
		wp_register_style( 'icomoon', "$this->stylesheet_directory_uri/css/icomoon/style.css", array(), null );
		wp_register_style( 'childtheme-default', "$this->stylesheet_directory_uri/css/default.css", array(), null );
		wp_register_script( 'childTheme', "$this->stylesheet_directory_uri/js/min/childTheme-min.js", array('jquery'), null );
		
		if ( $is_IE OR $this->is_IE ) {
			wp_register_style( 'IE8', "$this->stylesheet_directory_uri/css/IE8.css", array(), null );
			wp_register_style( 'IE9', "$this->stylesheet_directory_uri/css/IE9.css", array(), null );
		}
		
	} // end function register_style_and_scripts 
	
	
	
	
	
	
	/**
	 * deregister
	 *
	 * @version 2.0
	 * @updated 03.14.14
	 **/
	function deregister() {
		
		wp_deregister_script('helper');
		wp_dequeue_style('pmpro_frontend');
		
	} // end function deregister
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Front End - Enqueue, Print & other menial labor
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * Add Actions
	 * 
	 * @version 1.2
	 * @updated	11.18.12
	 * 
	 * These actions will add various items to the site.
	 * You are free to turn them off or move them around.
	 * 
	 * ToDo: remove apply_filters. add_action is the same thing, 
	 * this is doubling up on an item that does not need it.
	 **/
	function layout_options() {
		
		// Archive Post Navigation
		add_action( 'vc_below_loop', 'vc_navigation_posts' );
		
		// Single Post Navigation
		add_action( 'vc_below_loop', 'vc_navigation_post' );
		
		// Add Page Title
		add_action( 'inner_wrap_top', 'vc_page_title' );


	} // end function layout_options
	
	
	
	
	
	
	/**
	 * wp_print_styles
	 *
	 * @version 2.1
	 * @updated 04.15.14
	 **/
	function wp_print_styles() {
		
		wp_enqueue_style( 'icomoon' );
		wp_enqueue_style( 'childtheme-default' );
		global $is_IE, $wp_styles;
		if ( $is_IE OR $this->is_IE ) {
			wp_enqueue_style( 'IE8' );
			wp_enqueue_style( 'IE9' );
			if ( ! $this->is_IE ) {
				$wp_styles->add_data( 'IE8', 'conditional', 'lt IE 9' );
				$wp_styles->add_data( 'IE9', 'conditional', 'lt IE 10' );
			}
		}

	} // end function wp_print_styles
	
	
	
	
	
	
	/**
	 * Enqueue Scripts
	 *
	 * @version 2.0
	 * @updated 03.14.14
	 **/
	function wp_enqueue_scripts() {
		
		wp_enqueue_script( 'childTheme' );
		
	} // function wp_enqueue_scripts 
	
	
	
	
	
	
	/**
	 * Localize Scripts
	 *
	 * @version 1.0
	 * @updated 11.18.12
	 **/
	function localize_script( $array ) {
		
		$array['action'] = $this->ajax_action;
		$array['ajaxurl'] = admin_url( 'admin-ajax.php' );
		
		return $array;
		
	} // function localize_script
	
	
	
	
	
	
	/**
	 * login_enqueue_scripts
	 *
	 * @version 1.0
	 * @updated 11.18.12
	 *
	 * Note: You can use the login_enqueue_scripts hook to insert CSS
	 * reference: http://codex.wordpress.org/Customizing_the_Login_Form#Change_the_Login_Logo
	 **/
	function login_enqueue_scripts() {
		
		wp_enqueue_style( 'login-style' );
		
	} // end function login_enqueue_scripts
	
	
	
	
	
	
	/**
	 * BreadCrumb Nav
	 *
	 * @version 0.1
	 * @update	11.16.12
	 **/
	function breadcrumb_navigation() {
		
		if ( ! get_vc_option( 'post_display', 'childpage_breadcrumb' ) ) {
			return;
		} else {
			
			require_once( $this->parent_theme->template_directory . "/includes/classes/Breadcrumb_Navigation_VC.php" );
			
			// Breadcrumb Navigation
			$this->set( 'breadcrumb', new Breadcrumb_Navigation_VC() );
			$this->breadcrumb->breadcrumb_navigation( array(
				'before' => '<div id="navigation-breadcrumb-inner-wrap">',
				'after' => '</div>',
			) );
			
		}
		
	} // end function breadcrumb_navigation
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Child Theme Options
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * Child Options
	 *
	 * @version 1.0
	 * @updated 11.18.12
	 * 
	 * Notes:
	 * This function can be used to filter the default options.
	 * e.g. remove an options metabox or alter a portion of the 
	 * default array from includes / options / default-options.php
	 **/
	function filter_default_vc_options( $default_options ) {
		
		return $default_options;
		
	} // function filter_default_vc_options
	
	
	
	
} // end class ChildTheme_VC