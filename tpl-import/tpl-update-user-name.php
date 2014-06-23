<?php
/* Template Name: Update User Names */
/**
 * File Name UpdateUserNameToEmail.php
 * @subpackage ProjectName
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 00.00.00
 **/
####################################################################################################





/**
 * UpdateUserNameToEmail
 *
 * @version 1.0
 * @updated 00.00.00
 **/
$UpdateUserNameToEmail = new UpdateUserNameToEmail();
class UpdateUserNameToEmail {
	
	
	
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
		global $wpdb;
		
		$users = $wpdb->get_results("SELECT * FROM wp_users WHERE user_login != 'randy'");
		
		foreach ( $users as $user ) {
			$wpdb->replace( 'wp_users', array(
				'ID' => $user->ID
				,'user_login' => $user->user_email
				,'user_pass' => $user->user_pass
				,'user_nicename' => sanitize_title_with_dashes( $user->user_email )
				,'user_email' => $user->user_email
				,'user_url' => $user->user_url
				,'user_registered' => $user->user_registered
				,'user_activation_key' => $user->user_activation_key
				,'user_status' => $user->user_status
				,'display_name' => $user->display_name
			) );
		}
		
		// $users = $wpdb->get_results("SELECT * FROM wp_users WHERE user_login != 'randy' LIMIT 2");
		// print_r($users); die();
		
		die('done');

	} // end function __construct
	
	
	
	
	
	
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
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Functionality
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * example_function
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function example_function() {
		
		// sss
		
	} // end function example_function
	
	
	
	
	
	
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
	
	
	
} // end class UpdateUserNameToEmail