<?php
/* Template Name: Update Book Club Lat Lon */

/**
 * File Name UpdateBookClubLatLon.php
 * @subpackage ProjectName
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 00.00.00
 **/
####################################################################################################

die('UpdateBookClubLatLon deactivated')




/**
 * UpdateBookClubLatLon
 *
 * @version 1.0
 * @updated 00.00.00
 **/
$UpdateBookClubLatLon = new UpdateBookClubLatLon();
class UpdateBookClubLatLon {
	
	
	
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
		global $wpdb, $wp_query, $post;
		
		
		$results = $wpdb->get_results("SELECT `post_id` FROM `wp_places_locator` WHERE `lat` < 1 ");
		$post__in = array();
		
		foreach ( $results as $p ) {
			$post__in[] = $p->post_id;
		}
		
		
		$query = array(
			'post_type' => 'book-club',
			'posts_per_page' => -1,
			'post__in' => $post__in
		);
		
		$wp_query = new WP_Query();
		$wp_query->query($query);
		$i = 0;
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();
				$i++;
				
				$_book_club__circle_id = get_post_meta( $post->ID, '_book_club__circle_id', true );
				$results = $wpdb->get_results("SELECT * FROM `circles` WHERE `circleid` = $_book_club__circle_id");
				$_book_club__object = $results[0];
				
				$results = Geolocation::getCoordinates( '', '', '', $_book_club__object->zip, $_book_club__object->country );
				
				if ( isset( $results['latitude'] ) AND ! empty( $results['latitude'] ) AND isset( $results['longitude'] ) AND ! empty( $results['longitude'] ) ) {
					$wpdb->replace( $wpdb->prefix . 'places_locator', array(
						'post_id' => $post->ID,
						'lat' => $results['latitude'],
						'long' => $results['longitude'],
						'feature'           => 0,
						'post_type'         => 'book-club',
						'post_title'        => $post->post_title,
						'post_status'       => $post->post_status,
						'street'			=> $_book_club__object->addr,
						'apt'			    => '',
						'city'			    => $_book_club__object->city,
						'state'			    => $_book_club__object->state,
						'state_long'        => $_book_club__object->state,
						'zipcode'           => $_book_club__object->zip,
						'country'           => $_book_club__object->country,
						'country_long'      => $_book_club__object->country,
						'address'           => "$_book_club__object->city $_book_club__object->state, $_book_club__object->zip $_book_club__object->country",
						'formatted_address' => "$_book_club__object->city $_book_club__object->state, $_book_club__object->zip $_book_club__object->country",
						'phone'			    => '',
						'fax'			    => '',
						'email'			    => '',
						'website'           => '',
						'map_icon'          => '_default.png',
					) );
				}
			}
		}
		
		
		echo "$i of " . count($post__in);
		die();
		
	} // end function __construct
	
	
	
	
	
	
	/**
	 * convert_posts
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function convert_posts() {
		global $wpdb, $wp_query, $post;
		
		$query = array(
			'post_type' => 'book-club',
			'posts_per_page' => -1,
			'post__in' => array( 1693 )
		);
		
		$wp_query = new WP_Query();
		$wp_query->query($query);
		$i = 0;
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();
				$i++;
				
				$_book_club__object = get_post_meta( $post->ID, '_book_club__object', true );
				$results = Geolocation::getCoordinates( '', '', '', $_book_club__object->zip, $_book_club__object->country );

				if ( isset( $results['latitude'] ) AND ! empty( $results['latitude'] ) AND isset( $results['longitude'] ) AND ! empty( $results['longitude'] ) ) {
					$wpdb->replace( $wpdb->prefix . 'places_locator', array(
						'post_id' => $post->ID,
						'lat' => $results['latitude'],
						'long' => $results['longitude'],
						'feature'           => 0,
						'post_type'         => 'book-club',
						'post_title'        => $post->post_title,
						'post_status'       => $post->post_status,
						'street'			=> $_book_club__object->addr,
						'apt'			    => '',
						'city'			    => $_book_club__object->city,
						'state'			    => $_book_club__object->state,
						'state_long'        => $_book_club__object->state,
						'zipcode'           => $_book_club__object->zip,
						'country'           => $_book_club__object->country,
						'country_long'      => $_book_club__object->country,
						'address'           => "$_book_club__object->city $_book_club__object->state, $_book_club__object->zip $_book_club__object->country",
						'formatted_address' => "$_book_club__object->city $_book_club__object->state, $_book_club__object->zip $_book_club__object->country",
						'phone'			    => '',
						'fax'			    => '',
						'email'			    => '',
						'website'           => '',
						'map_icon'          => '_default.png',
					) );
				}
				// if ( ! isset( $post->location->lat ) OR empty( $post->location->lat ) OR ! isset( $post->location->long ) OR empty( $post->location->long ) ) {}
				
			}
		}
		echo $i;
		die(' done');
		
	} // end function convert_posts
	
	
	
	
	
	
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
	
	
	
} // end class UpdateBookClubLatLon