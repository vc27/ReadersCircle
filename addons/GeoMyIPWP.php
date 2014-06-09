<?php
/**
 * File Name GeoMyIPWP.php
 * @package WordPress
 * @subpackage ProjectName
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 00.00.00
 **/
####################################################################################################





/**
 * GeoMyIPWP
 *
 * @version 1.0
 * @updated 00.00.00
 **/
$GeoMyIPWP = new GeoMyIPWP();
class GeoMyIPWP {
	
	
	
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
	 * __construct
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function __construct() {

		// hook method after_setup_theme
		add_action( 'after_setup_theme', array( &$this, 'after_setup_theme' ) );

		// hook method init
		add_action( 'init', array( &$this, 'init' ) );

		// hook method admin_init
		add_action( 'admin_init', array( &$this, 'admin_init' ) );

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
		
        //
		
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
	
	
	
	
	
	
	/**
	 * get_countries
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	static function get_countries() {
		global $wpdb;
		
		$output = array();
		$table = $wpdb->prefix . "places_locator";
		$results = $wpdb->get_results( "SELECT DISTINCT country FROM $table where country != '' AND country not REGEXP '^[0-9]+$'" );
		
		if ( isset( $results ) AND ! empty( $results ) AND is_array( $results ) ) {
			foreach ( $results as $val ) {
				$output[$val->country] = $val->country;
			}
		}
		
		return $output;
		
	} // end function get_countries
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Functionality
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * select_country
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	static function select_country() {
		
		$output = false;
		$countries = self::get_countries();
		if ( $countries ) {
			$output = "";

			$output .= "<select id=\"country\" required>";
				// $output .= "<option value=\"\">Select a country</option>";
				foreach ( $countries as $country ) {
					$output .= "<option value=\"$country\">$country</option>";
				}
			$output .= "</select>";
		}
		
		return $output;
		
	} // end function select_country
	
	
	
	
	
	
	/**
	 * gmw_form_submit_fields
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	static function gmw_form_submit_fields( $gmw, $subValue ) {
	    
		echo "<div id=\"gmw-submit-wrapper-" . $gmw['ID'] . "\" class=\"gmw-submit-wrapper gmw-submit-wrapper-" . $gmw['ID'] . "\">";
	        echo "<input type=\"hidden\" id=\"gmw-form-id-" . $gmw['ID'] . "\" class=\"gmw-form-id gmw-form-id-" . $gmw['ID'] . "\" name=\"gmw_form\" value=\"" . $gmw['ID'] . "\" />";
	        echo "<input type=\"hidden\" id=\"gmw-paged-" . $gmw['ID'] . "\" class=\"gmw-paged gmw-paged-" . $gmw['ID'] . "\" name=\"paged\" value=\""; echo ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; echo "\" />";
	        echo "<input type=\"hidden\" id=\"gmw-per-page-" . $gmw['ID'] . "\" class=\"gmw-per-page gmw-per-page-" . $gmw['ID'] . "\" name=\"gmw_per_page\" value=\"" . current( explode( ",", $gmw['search_results']['per_page'] ) ) . "\" />";
	        echo "<input type=\"hidden\" id=\"prev-address-" . $gmw['ID'] . "\" class=\"prev-address prev-address-" . $gmw['ID'] . "\" value=\""; if ( isset( $_GET['gmw_address'] ) ) { echo implode( ' ', $_GET['gmw_address'] ); } echo "\">";
	        echo "<input type=\"hidden\" id=\"gmw-lat-" . $gmw['ID'] . "\" class=\"gmw-lat gmw-lat-" . $gmw['ID'] . "\" name=\"gmw_lat\" value=\""; if ( isset( $_GET['gmw_lat'] ) ) { echo $_GET['gmw_lat']; } echo "\">";
	        echo "<input type=\"hidden\" id=\"gmw-long-" . $gmw['ID'] . "\" class=\"gmw-lng gmw-long-" . $gmw['ID'] . "\" name=\"gmw_lng\" value=\""; if ( isset( $_GET['gmw_lng'] ) ) { echo $_GET['gmw_lng']; } echo "\">";
	        echo "<input type=\"hidden\" id=\"gmw-prefix-" . $gmw['ID'] . "\" class=\"gmw-prefix gmw-prefix-" . $gmw['ID'] . "\" name=\"gmw_px\" value=\"" . $gmw['prefix'] . "\" />";
	        echo "<input type=\"hidden\" id=\"gmw-action-" . $gmw['ID'] . "\" class=\"gmw-action gmw-action-" . $gmw['ID'] . "\" name=\"action\" value=\"gmw_post\" />";

			$submit_button = "<input type=\"submit\" id=\"gmw-submit-" . $gmw['ID'] . "\" class=\"gmw-submit\" value=\"$subValue\" />";
			echo apply_filters( 'gmw_form_submit_button', $submit_button, $gmw, $subValue );
	    echo "</div>";

	} // end function gmw_form_submit_fields
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Conditionals
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * have_something
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function have_something() {
		
		if ( isset( $this->something ) AND ! empty( $this->something ) ) {
			$this->set( 'have_something', 1 );
		} else {
			$this->set( 'have_something', 0 );
		}
		
		return $this->have_something;
		
	} // end function have_something
	
	
	
} // end class GeoMyIPWP