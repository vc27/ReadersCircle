<?php
/* Template Name: Create Import Users CSV */

/**
 * File Name CreatetUsersCSV.php
 * @subpackage ProjectName
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 00.00.00
 **/
####################################################################################################





/**
 * CreatetUsersCSV
 *
 * @version 1.0
 * @updated 00.00.00
 **/
$CreatetUsersCSV = new CreatetUsersCSV();
class CreatetUsersCSV {
	
	
	
	/**
	 * count
	 * 
	 * @access public
	 * @var int
	 **/
	var $count = 0;
	
	
	
	/**
	 * user_querystr
	 * 
	 * @access public
	 * @var string
	 **/
	var $user_querystr = "SELECT * FROM users LIMIT 10";
	
	
	
	/**
	 * errors
	 * 
	 * @access public
	 * @var array
	 **/
	var $errors = array();
	
	
	
	/**
	 * user_fields
	 * 
	 * @access public
	 * @var array
	 **/
	/*var $required__user_fields = array(
		'user_login',
		'user_email',
		'user_pass',
		'first_name',
		'last_name',
		'role',
		'membership_id'
	);*/
	
	
	
	/**
	 * role
	 * 
	 * @access public
	 * @var array
	 **/
	var $role = 'book-club-author';
	
	
	
	/**
	 * membership_id
	 * 
	 * @access public
	 * @var array
	 **/
	var $membership_id = 1;
	
	
	
	/**
	 * user_fields
	 * 
	 * @access public
	 * @var array
	 **/
	var $user_fields = array(
		'user_login',
		'user_email',
		'user_pass',
		'first_name',
		'last_name',
		'display_name',
		'role',
		'rc_id',
		'membership_id',
		'membership_code_id',
		'membership_initial_payment',
		'membership_billing_amount',
		'membership_cycle_number',
		'membership_cycle_period',
		'membership_billing_limit',
		'membership_trial_amount',
		'membership_trial_limit',
		'membership_status',
		'membership_startdate',
		'membership_enddate',
		'membership_subscription_transaction_id',
		'membership_gateway',
		'membership_payment_transaction_id	',
		'membership_affiliate_id',
		'pmpro_stripe_customerid'
	);
	
	
	
	/**
	 * csv_text
	 * 
	 * @access public
	 * @var object
	 **/
	var $csv_text = '';
	
	
	
	/**
	 * users
	 * 
	 * @access public
	 * @var object
	 **/
	var $users = null;
	
	
	
	
	
	
	/**
	 * __construct
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function __construct() {
		
		$this->get_users();
		$this->set( 'count', count( $this->users ) );
		$this->process_users();
		$this->output_headers();
		echo $this->csv_text;
		die();

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
	
	
	
	
	
	
	/**
	 * get_users
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function get_users() {		
		global $wpdb;

		$this->set( 'users', $wpdb->get_results( $this->user_querystr ) );
		
	} // end function get_users
	
	
	
	
	
	
	/**
	 * set_header
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function output_headers() {
		
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: private",false);
		header("Content-Type: application/octet-stream");
		header("Content-Disposition: attachment; filename=\"rc-users.csv\";" );
		header("Content-Transfer-Encoding: binary");
		
	} // end function output_headers 
	
	
	
	
	
	
	/**
	 * append_csv_text
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function append_csv_text( $string ) {
		
		$this->csv_text .= $string;
		
	} // end function append_csv_text 
	
	
	
	
	
	
	/**
	 * get_user__user_login
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function get_user__user_login() {
		
		if ( isset( $this->user->username ) AND ! empty( $this->user->username ) ) {
			return $this->user->username;
		} else {
			$output = explode( '@', $this->user->email );
			return sanitize_title_with_dashes( $output[0] );
		}
		
	} // end function get_user__user_login
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Functionality
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * process_users
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function process_users() {
		
		if ( $this->have_users() ) {
			
			$this->append_csv_text("\"" . implode( '","', $this->user_fields ) . "\"\n");
			
			foreach ( $this->users as $this->user ) {
				
				if ( ! $this->have_email() ) {
					
					$this->errors['users-no-email'] = $this->user;
					
				} else if ( ! $this->have_password() ) {
					
					$this->errors['users-no-password'] = $this->user;
					
				} else {
					
					$output = array();
					foreach ( $this->user_fields as $field ) {
						switch ( $field ) {
							case 'user_login' :
								$output[$field] = $this->get_user__user_login();
								break;
							case 'user_email' :
								$output[$field] = $this->user->email;
								break;
							case 'user_pass' :
								$output[$field] = $this->user->password;
								break;
							case 'role' :
								$output[$field] = $this->role;
								break;
							case 'rc_id' : 
								$output[$field] = $this->user->userid;
								break;
							case 'membership_id' :
								$output[$field] = $this->membership_id;
								break;
							default :
								$output[$field] = '';
								break;
						}
					}
				}
				
				$this->append_csv_text("\"" . implode( '","', $output ) . "\"\n");
				
			}
			
		}
		
	} // end function process_users
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Conditionals
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * have_users
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function have_users() {
		
		if ( isset( $this->users ) AND ! empty( $this->users ) AND is_array( $this->users ) ) {
			$this->set( 'have_users', 1 );
		} else {
			$this->set( 'have_users', 0 );
		}
		
		return $this->have_users;
		
	} // end function have_users 
	
	
	
	
	
	
	/**
	 * have_email
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function have_email() {
		
		if ( isset( $this->user->email ) AND ! empty( $this->user->email ) AND is_email( $this->user->email ) ) {
			$this->set( 'have_email', 1 );
		} else {
			$this->set( 'have_email', 0 );
		}
		
		return $this->have_email;
		
	} // end function have_email 
	
	
	
	
	
	
	/**
	 * have_password
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function have_password() {
		
		if ( isset( $this->user->password ) AND ! empty( $this->user->password ) ) {
			$this->set( 'have_password', 1 );
		} else {
			$this->set( 'have_password', 0 );
		}
		
		return $this->have_email;
		
	} // end function have_password
	
	
	
} // end class CreatetUsersCSV