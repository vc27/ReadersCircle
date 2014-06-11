<?php
/* Template Name: Import Book Club */

/**
 * File Name tpl-import-bookclubs.php
 * @subpackage ProjectName
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 00.00.00
 **/
####################################################################################################





/**
 * ImportBookClubsWP
 *
 * @version 1.0
 * @updated 00.00.00
 **/
$ImportBookClubsWP = new ImportBookClubsWP();
class ImportBookClubsWP {
	
	
	
	/**
	 * book_clubs
	 * 
	 * @access public
	 * @var mix
	 **/
	var $book_clubs = false;
	
	
	
	/**
	 * posts
	 * 
	 * @access public
	 * @var mix
	 **/
	var $posts = false;
	
	
	
	/**
	 * querystr
	 * 
	 * @access public
	 * @var string
	 **/
	var $querystr = "SELECT * FROM circles WHERE xloc = '_ad' LIMIT 10";
	
	
	
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
		
		add_filter( 'import--add-update-delete-post', array( &$this, 'insert_location' ) );
		
		$this->set_book_clubs();
		// $this->convert_to_posts();
		// $this->import();
		
		print_r($this); die();

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
	 * set_book_clubs
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function set_book_clubs() {
		global $wpdb;
		
		$results = $wpdb->get_results( $this->querystr );
		if ( isset( $results ) AND isset( $results[0] ) ) {
			$this->set( 'book_clubs', $results );
		}
		
	} // end function set_book_clubs
	
	
	
	
	
	
	/**
	 * insert_location
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function insert_location( $post_id ) {
		global $wpdb;
		
		$post = get_post('post_id');
		
		$wpdb->replace( $wpdb->prefix . 'places_locator', array(
			'post_id'           => $post->ID,
			'feature'           => 0,
			'post_type'         => $_POST[ 'post_type' ],
			'post_title'        => $_POST[ 'post_title' ],
			'post_status'       => $_POST[ 'post_status' ],
			'street'			=> $_POST[ '_wppl_street' ],
			'apt'			    => $_POST[ '_wppl_apt' ],
			'city'			    => $_POST[ '_wppl_city' ],
			'state'			    => $_POST[ '_wppl_state' ],
			'state_long'        => $_POST[ '_wppl_state_long' ],
			'zipcode'           => $_POST[ '_wppl_zipcode' ],
			'country'           => $_POST[ '_wppl_country' ],
			'country_long'      => $_POST[ '_wppl_country_long' ],
			'address'           => $_POST[ '_wppl_address' ],
			'formatted_address' => $_POST[ '_wppl_formatted_address' ],
			'phone'			    => $_POST[ '_wppl_phone' ],
			'fax'			    => $_POST[ '_wppl_fax' ],
			'email'			    => $_POST[ '_wppl_email' ],
			'website'           => $_POST[ '_wppl_website' ],
			'lat'			    => $_POST[ '_wppl_lat' ],
			'long'			    => $_POST[ '_wppl_long' ],
			'map_icon'          => $_POST[ 'gmw_map_icon' ],
		) );
		
	} // end function insert_location
	
	
	
	
	
	
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
	
	
	
} // end class ImportBookClubsWP