<?php
/**
 * File Name ThemeSupport.php
 * @package WordPress
 * @subpackage ParentTheme_VC
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.3
 * @updated 10.16.13
 **/
####################################################################################################





/**
 * ThemeSupport
 *
 * @version 1.0
 * @updated 00.00.13
 **/
$ThemeSupport = new ThemeSupport();
class ThemeSupport {
	
	
	
	/**
	 * appName
	 * 
	 * @access public
	 * @var string
	 **/
	var $appName = 'projectApp';
	
	
	
	
	
	
	/**
	 * __construct
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function __construct() {
		
		$this->set( 'stylesheet_directory_uri', get_stylesheet_directory_uri() );
		
		// add_action( 'after_setup_theme', array( &$this, 'after_setup_theme' ) );
		
		add_action( 'init', array( &$this, 'init' ) );
		
		add_action( 'admin_init', array( &$this, 'admin_init' ) );
		
		add_action( 'wp', array( &$this, 'wp' ) );
		
		// add_action( 'widgets_init', array( &$this, 'widgets_init' ) );

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
		
		/*
		add__featured_image( array(
			'label' => 'Artist Header',
			'id' => 'artist-header',
			'post_type' => 'artists',
			'priority' => 'low',
			'context' => 'side'
		) );
		*/
		
	} // end function after_setup_theme
	
	
	
	
	
	
	/**
	 * init
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 * @codex http://codex.wordpress.org/Plugin_API/Action_Reference/init
	 * 
	 * Description:
	 * Runs after WordPress has finished loading but before any headers are sent.
	 **/
	function init() {
		
		$this->register_style_and_scripts();
		add_filter( 'body_class', array( &$this, 'body_class' ) ) ;
		
	} // end function init
	
	
	
	
	
	
	/**
	 * admin_init
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 * @codex http://codex.wordpress.org/Plugin_API/Action_Reference/admin_init
	 * 
	 * Description:
	 * admin_init is triggered before any other hook when a user access the admin area.
	 * This hook doesn't provide any parameters, so it can only be used to callback a 
	 * specified function.
	 **/
	function admin_init() {
		
		add_action( 'admin_enqueue_scripts', array( &$this, 'admin_enqueue_scripts' ) );
		add_action('wp_dashboard_setup', array( &$this, 'remove_dashboard_widget' ), 11 );
		add_action( 'wp_dashboard_setup', array( &$this, 'add_dashboard_widgets' ) );
		
	} // end function admin_init
	
	
	
	
	
	
	/**
	 * wp
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function wp() {
		
		add_filter( 'the_post', array( &$this, 'the_post' ) );
		// add_action( 'wp_enqueue_scripts', array( &$this, 'wp_enqueue_scripts' ) );
		
	} // end function wp
	
	
	
	
	
	
	/**
	 * Widgets Initiate
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function widgets_init() {
		
		// register_widget( 'TwitterWidgetVCWP' );
		
	} // end function widgets_init
	
	
	
	
	
	
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
	 * get
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function get( $key ) {
		
		if ( isset( $key ) AND ! empty( $key ) AND isset( $this->$key ) AND ! empty( $this->$key ) ) {
			return $this->$key;
		} else {
			return false;
		}
		
	} // end function get
	
	
	
	
	
	
	/**
	 * have_template_page_options
	 *
	 * @version 1.1
	 * @updated 10.16.13
	 **/
	static function have_template_page_options( $option, $setting ) {
		global $template_page_options;
		if ( ! isset( $template_page_options ) ) {
			$template_page_options = get_option("_template_page_options");
		}
		
		if ( isset( $template_page_options ) AND isset( $template_page_options[$option][$setting] ) AND  ! empty( $template_page_options[$option][$setting] ) ) {
			return true;
		} else {
			return false;
		}
		
	} // end function have_template_page_options
	
	
	
	
	
	
	/**
	 * template_page_options
	 *
	 * @version 1.2
	 * @updated 10.16.13
	 **/
	static function template_page_options( $option, $setting ) {
		global $template_page_options;
		if ( ! isset( $template_page_options ) ) {
			$template_page_options = get_option("_template_page_options");
		}
		
		if ( self::have_template_page_options( $option, $setting ) ) {
			return html_entity_decode( $template_page_options[$option][$setting] );
		} else {
			return false;
		}
		
	} // end function template_page_options
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Functionality
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * the_post
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function the_post( $post ) {
		
		if ( $post->post_type == 'book-club' AND isset( $post->email ) AND ! empty( $post->email ) ) {
			$post->email = antispambot($post->email);
		}
		
		return $post;
		
	} // end function the_post
	
	
	
	
	
	
	/**
	 * Register Styles and Scripts
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function register_style_and_scripts() {
		
		wp_register_style( 'style-admin', "$this->stylesheet_directory_uri/css/style-admin.css" );
		wp_register_script( 'custom-admin-js', "$this->stylesheet_directory_uri/js/min/adminJs-min.js", array( 'jquery' ) );
		
	} // end function register_style_and_scripts
	
	
	
	
	
	
	/**
	 * admin_enqueue_scripts
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function admin_enqueue_scripts() {
		
		wp_enqueue_style( 'style-admin' );
		wp_enqueue_script( 'custom-admin-js' );

	} // end function admin_enqueue_scripts
	
	
	
	
	
	
	/**
	 * remove_dashboard_widget
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function remove_dashboard_widget() {
	 	// global $wp_meta_boxes; print_r($wp_meta_boxes); die();
		remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
		remove_meta_box( 'pmpro_db_widget', 'dashboard', 'normal' );
		remove_meta_box( 'tribe_dashboard_widget', 'dashboard', 'normal' );
	
	} // end function remove_dashboard_widget
	
	
	
	
	
	
	/**
	 * add_dashboard_widgets
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function add_dashboard_widgets() {

		wp_add_dashboard_widget( 'my_dashboard_widget', 'Example Dashboard Widget', array( &$this, 'my_dashboard_widget' ) );
		
	} // end function add_dashboard_widgets
	
	
	
	
	
	
	/**
	 * body_class
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function body_class( $classes ) {
		global $wp_query;
		
		if ( is_page_template('taxonomy-books.php') OR isset( $wp_query->query['books'] ) AND ! empty( $wp_query->query['books'] ) ) {
			$classes[] = 'author-book-directory';
		}
		
		return $classes;
		
	} // end function body_class
	
	
	
	
	
	
	####################################################################################################
	/**
	 * static
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * jetpack_sharing
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function jetpack_sharing() {

		if ( function_exists( 'sharing_display' ) ) {
			return sharing_display();
		}
		
	} // end function jetpack_sharing
	
	
	
	
	
	
	/**
	 * single_book_display
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	static function single_book_display() {
		
		if ( $image = get_field('_books__image') AND isset( $image['url'] ) ) {
			$image = $image['url'];
		} else if ( get_field('_books__image_url') ) {
			$image = get_field('_books__image_url');
		}
		
		$output = "<div class=\"hentry-book\" itemscope itemtype=\"http://schema.org/Book\">";
			$output .= "<div class=\"post-wrap\">";
				$output .= "<a href=\"" . get_field('_books__book_url') . "\" target=\"_blank\"><img itemprop=\"image\" src=\"$image\" alt=\"\"/></a>";
				$output .= "<span itemprop=\"name\">" . get_the_title() . "</span>";
				$output .= "<a itemprop=\"author\" href=\"mailto:" . antispambot( get_field('_books__email') ) . "\" target=\"_blank\">" . get_field('_books__first_name') . " " . get_field('_books__last_name') . "</a>";
			$output .= "</div>";
		$output .= "</div>";
		
		return $output;
		
	} // end function single_book_display
	
	
	
	
	
	
	/**
	 * Test Function
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	static function test_function() {
		
		// template function for building new static functions.
		
	} // end function test_function
	
	
	
} // end class ThemeSupport