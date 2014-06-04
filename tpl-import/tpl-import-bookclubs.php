<?php
/* Template Name: Import Bookclubs */

/**
 * File Name tpl-import-bookclubs.php
 * @package WordPress
 * @subpackage ParentTheme_VC
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 03.09.13
 **/
#################################################################################################### */



/**
 * Class: Import Readers Circle Bookclubs
 *
 * @version 1.0
 * @updated 03.09.13
 **/
class ImportReadersCircleBookclubs {
	
	
	
	
	
	
	/**
	 * import
	 *
	 * @version 1.0
	 * @updated 03.09.13
	 **/
	function import() {
		
		$this->set_user_ids();
		$this->import_bookclubs();
		
	} // end function import
	
	
	
	
	
	
	/**
	 * set
	 *
	 * @version 1.0
	 * @updated 03.09.13
	 **/
	function set( $key, $val = false ) {
		
		if ( isset( $key ) AND ! empty( $key ) ) {
			$this->$key = $val;
		}
		
	} // end function set
	
	
	
	
	
	
	/**
	 * set_user_ids
	 *
	 * @version 1.0
	 * @updated 03.09.13
	 **/
	function set_user_ids() {		
		global $wpdb;

		$this->user_query = array(
			// 'number' => 1,
			'role' => 'Subscriber',
			'meta_key' => '_rc_bookclub_ids',
			'fields' => 'ids'
		);
		$users = new WP_User_Query( $this->user_query );
		$this->user_ids = $users->get_results();
		
	} // end function set_user_ids
	
	
	
	
	
	
	/**
	 * import_bookclubs
	 *
	 * @version 1.0
	 * @updated 03.09.13
	 **/
	function import_bookclubs() {		
		
		foreach ( $this->user_ids as $this->user_id ) {
			
			$this->set_rc_bookclub_ids();
			$this->set_rc_bookclubs();
			$this->prep_bookclubs_for_import();
			$this->insert_posts();
			
		}
		
	} // end function import_bookclubs 
	
	
	
	
	
	
	/**
	 * set_rc_bookclub_ids
	 *
	 * @version 1.0
	 * @updated 03.09.13
	 **/
	function set_rc_bookclub_ids() {		
		
		$this->rc_bookclub_ids = get_user_meta( $this->user_id, '_rc_bookclub_ids', true );
		
	} // end function set_rc_bookclub_ids 
	
	
	
	
	
	
	/**
	 * set_rc_bookclubs
	 *
	 * @version 1.0
	 * @updated 03.09.13
	 **/
	function set_rc_bookclubs() {		
		global $wpdb;
		
		$circleid__in = "'" . implode( "', '", $this->rc_bookclub_ids ) . "'";

		$this->bookclub_querystr = "	SELECT * 
							FROM circles 
							WHERE 
								circleid IN($circleid__in)
							";

		$bookclubs = $wpdb->get_results( $this->bookclub_querystr );
		if ( is_array( $bookclubs ) AND isset( $bookclubs[0] ) AND ! empty( $bookclubs[0] ) AND isset( $bookclubs[0]->circleid ) AND is_numeric( $bookclubs[0]->circleid ) ) {
			$this->set( 'have_bookclubs', true );
			$this->bookclubs = $bookclubs;
		} else {
			$this->bookclubs = false;
			$this->set( 'have_bookclubs', false );
		}
		
	} // end function set_rc_bookclubs 
	
	
	
	
	
	
	/**
	 * prep_bookclubs_for_import
	 *
	 * @version 1.0
	 * @updated 03.09.13
	 **/
	function prep_bookclubs_for_import() {		
		
		if ( $this->have_bookclubs ) {
			$this->posts = array();
			foreach ( $this->bookclubs as $k => $club ) {
				
				$this->posts[$k] = array(
					'id' => 'rc-bookclub', // used as an array key in stored option
					'post_terms' => array(
						'city' => array(
							'append_terms' => false,
							'taxonomy' => 'city',
							'terms' => array( $club->city ),
							),
						'state' => array(
							'append_terms' => false,
							'taxonomy' => 'state',
							'terms' => array( $club->state ),
							),
						'country' => array(
							'append_terms' => false,
							'taxonomy' => 'country',
							'terms' => array( $club->country ),
							),
						'bookclub-type' => array(
							'append_terms' => false,
							'taxonomy' => 'bookclub-type',
							'terms' => array( $club->typex ),
							),
					),
					'post_meta' => array(
						'_rc_circleid' => array(
							'key' => '_rc_circleid',
							'value' => $club->circleid,
							'unique' => true,
							),
						'_rc_userid' => array(
							'key' => '_rc_userid',
							'value' => $club->userid,
							'unique' => true,
							),
						'_rc_type' => array(
							'key' => '_rc_type',
							'value' => $club->typex,
							'unique' => true,
							),
						'_rc_day' => array(
							'key' => '_rc_day',
							'value' => $club->day,
							'unique' => true,
							),
						'_rc_starttime' => array(
							'key' => '_rc_starttime',
							'value' => $club->starttime,
							'unique' => true,
							),
						'_rc_endtime' => array(
							'key' => '_rc_endtime',
							'value' => $club->endtime,
							'unique' => true,
							),
						'_rc_place' => array(
							'key' => '_rc_place',
							'value' => $club->place,
							'unique' => true,
							),
						'_rc_address' => array(
							'key' => '_rc_address',
							'value' => $club->place,
							'unique' => true,
							),
						'_bookclub_address' => array(
							'key' => '_bookclub_address',
							'value' => $club->place,
							'unique' => true,
							),
						'_rc_city' => array(
							'key' => '_rc_city',
							'value' => $club->city,
							'unique' => true,
							),
						'_rc_state' => array(
							'key' => '_rc_state',
							'value' => $club->state,
							'unique' => true,
							),
						'_rc_zip' => array(
							'key' => '_rc_zip',
							'value' => $club->zip,
							'unique' => true,
							),
						'_bookclub_zip' => array(
							'key' => '_bookclub_zip',
							'value' => $club->zip,
							'unique' => true,
							),
						'_rc_status' => array(
							'key' => '_rc_status',
							'value' => $club->status,
							'unique' => true,
							),
						'_rc_focus' => array(
							'key' => '_rc_focus',
							'value' => $club->focus,
							'unique' => true,
							),
						'_rc_active' => array(
							'key' => '_rc_active',
							'value' => $club->active,
							'unique' => true,
							),
						'_rc_descr' => array(
							'key' => '_rc_descr',
							'value' => $club->descr,
							'unique' => true,
							),
						'_rc_chgdate' => array(
							'key' => '_rc_chgdate',
							'value' => $club->chgdate,
							'unique' => true,
							),							
						'_rc_xloc' => array(
							'key' => '_rc_xloc',
							'value' => $club->xloc,
							'unique' => true,
							),							
						'_bookclub_xloc' => array(
							'key' => '_bookclub_xloc',
							'value' => $club->xloc,
							'unique' => true,
							),
						'_rc_country' => array(
							'key' => '_rc_country',
							'value' => $club->country,
							'unique' => true,
							),
						),
					'post' => array( // post array
						'post_title' => $club->focus,
						'post_content' => $club->descr,
						'post_status' => 'publish',
						'post_author' => $this->user_id,
						'post_type' => 'bookclub',
						),
					);
				
			} // end foreach ( $this->bookclubs as $k => $club )
			
		} else {
			$this->posts = array();
		}
		
	} // end function prep_bookclubs_for_import 
	
	
	
	
	
	
	/**
	 * insert_posts
	 *
	 * @version 2.0
	 * @updated 04.21.14
	 **/
	function insert_posts() {
		
		$this->create_posts = create__posts( $this->posts, array(
			'overwrite_posts' => true
		) );
		
	} // end function insert_posts
	
	
	
} // end class ImportReadersCircleBookclubs

$rc = new ImportReadersCircleBookclubs();
$rc->import();
print_r($rc);