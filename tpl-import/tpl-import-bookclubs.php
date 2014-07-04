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
	 * _post
	 * 
	 * @access public
	 * @var mix
	 **/
	var $_post = false;
	
	
	
	/**
	 * post
	 * 
	 * @access public
	 * @var mix
	 **/
	var $post = false;
	
	
	
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
	var $querystr = "SELECT * FROM circles WHERE xloc = '_ad' AND userid >= 0";
	
	
	
	/**
	 * book_clubs
	 * 
	 * @access public
	 * @var mix
	 **/
	var $book_clubs = false;
	
	
	
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
		add_filter( 'import--add-update-delete-post', array( &$this, 'wp_update_post' ) );
		
		$this->set_book_clubs();
		$this->prep_book_clubs();
		
		$CreatePostsVCWP = create__posts( $this->posts, array(
			'overwrite_posts' => true
		) );
		
		print_r($CreatePostsVCWP); die();

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
	 * append__posts
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function append__posts() {
		
		if ( isset( $this->post ) AND is_array( $this->post ) AND ! empty( $this->post ) ) {
			$this->posts[$this->k]['post'] = $this->post;
		}
		
	} // end function append__posts
	
	
	
	
	
	
	/**
	 * append__post
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function append__post( $key, $val = false ) {
		
		if ( isset( $key ) AND ! empty( $key ) ) {
			$this->post[$key] = $val;
		}
		
	} // end function append__post
	
	
	
	
	
	
	/**
	 * set__post_array
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function set__post_array() {
		
		$this->post = null;
		$this->post = array();
		
		$this->append__post( 'post_title', $this->_post->focus );
		$this->append__post( 'post_content', html_entity_decode( $this->_post->descr ) );
		$this->append__post( 'post_status', 'publish' );
		$this->append__post( 'post_author', 1 );
		$this->append__post( 'post_type', 'book-club' );
		
	} // end function set__post_array 
	
	
	
	
	
	
	/**
	 * append__post_meta
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function append__post_meta( $key, $value = false ) {
		
		if ( isset( $value ) AND ! empty( $value ) ) {
			$this->post_meta[$key] = $value;
		}
		
	} // end function append__post_meta
	
	
	
	
	
	
	/**
	 * set__posts_meta_array
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function set__post_meta_array() {
		
		foreach ( $this->_post as $meta_key => $meta_value ) {
			
			if ( isset( $meta_value ) AND ! empty( $meta_value ) ) {
				
				$this->post_meta = null;

				switch ( $meta_key ) {
					case 'userid' : 
						$this->append__post_meta( 'key', "_book_club__rc_id" );
						break;
					case 'typex' :
						$meta_value = sanitize_title_with_dashes($meta_value);
						$this->append__post_meta( 'key', "_book_club__type" );
						break;
					case 'circleid' : 
						$this->append__post_meta( 'key', "_book_club__circle_id" );
						break;
					case 'descr' :
						$meta_value = html_entity_decode($meta_value);
						$this->append__post_meta( 'key', "_book_club__desc" );
						break;
				}
				
				if ( isset( $this->post_meta['key'] ) AND ! empty( $this->post_meta['key'] ) ) {
					$this->append__post_meta( 'value', $meta_value );
					$this->append__post_meta( 'unique', 1 );
					$this->append__post_meta_array();
				}
				
			} else {
				$meta_value = null;
			}
			
		}
		
	} // end function set__post_meta_array 
	
	
	
	
	
	
	/**
	 * append__post_meta_array
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function append__post_meta_array() {
		
		$this->posts_meta[$this->post_meta['key']] = $this->post_meta;
		
	} // end function append__post_meta_array
	
	
	
	
	
	
	/**
	 * append__posts_meta
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function append__posts_meta() {
		
		if ( isset( $this->posts_meta ) AND is_array( $this->posts_meta ) AND ! empty( $this->posts_meta ) ) {
			$this->posts[$this->k]['post_meta'] = $this->posts_meta;
		}
		
	} // end function append__posts_meta 
	
	
	
	
	
	
	/**
	 * set__post_terms_array
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function set__post_terms_array() {
		
		if ( isset( $this->posts[$this->k]['post_meta']['_books__last_name']['value'] ) AND ! empty( $this->posts[$this->k]['post_meta']['_books__last_name']['value'] ) ) {
			$this->term = substr( $this->posts[$this->k]['post_meta']['_books__last_name']['value'], 0, 1 );
			if ( $this->have_term() ) {
				$this->posts[$this->k]['post_terms'] = array(
					'books' => array(
						'append_terms' => 0,
						'taxonomy' => 'books',
						'terms' => array( $this->term ), // (array/int/string)
						),
					);
			}
		}
		
	} // end function set__post_terms_array
	
	
	
	
	
	
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
	 * prep_books
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function prep_book_clubs() {
		
		if ( $this->have_book_clubs() ) {
			foreach ( $this->book_clubs as $this->k => $this->_post ) {
				
				$this->set__post_array();
				$this->append__posts();
				$this->set__post_meta_array();
				$this->append__posts_meta();
				
				// $this->set__post_terms_array();
			}
		}
		
	} // end function prep_book_clubs
	
	
	
	
	
	
	/**
	 * insert_location
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function insert_location( $post_id ) {
		global $wpdb;
		
		$_book_club__circle_id = get_post_meta( $post->ID, '_book_club__circle_id', true );
		$results = $wpdb->get_results("SELECT * FROM `circles` WHERE `circleid` = $_book_club__circle_id");
		$_book_club__object = $results[0];
		
		$results = Geolocation::getCoordinates( '', '', '', $_book_club__object->zip, $_book_club__object->country );
		
		// if ( isset( $results['latitude'] ) AND ! empty( $results['latitude'] ) AND isset( $results['longitude'] ) AND ! empty( $results['longitude'] ) ) {}
		
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
		
	} // end function insert_location
	
	
	
	
	
	
	/**
	 * wp_update_post
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function wp_update_post( $post_id ) {
		
		$_book_club__object = get_post_meta( $post_id, '_book_club__object', true );
		
		$user_query = new WP_User_Query( array( 
			'meta_key' => 'rc_id', 
			'meta_value' => $_book_club__object->userid 
		) );
		
		$post = array(
			'ID' => $post_id,
			'post_type' => 'book-club',
			'post_author' => $user_query->results[0]->data->ID,
		);
		
		if ( isset( $user_query->results[0]->data->ID ) AND is_numeric( $user_query->results[0]->data->ID ) ) {
			$post['post_author'] = $user_query->results[0]->data->ID;
		} else {
			$post['post_status'] = 'draft';
		}
		
		update_post_meta( $post_id, '_book_club__email', $user_query->results[0]->data->user_email );
		
		wp_update_post($post);
		
	} // end function wp_update_post
	
	
	
	
	
	
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
	
	
	
	
	
	
	/**
	 * have_book_clubs
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function have_book_clubs() {
		
		if ( isset( $this->book_clubs ) AND ! empty( $this->book_clubs ) AND is_array( $this->book_clubs ) ) {
			$this->set( 'have_book_clubs', 1 );
		} else {
			$this->set( 'have_book_clubs', 0 );
		}
		
		return $this->have_book_clubs;
		
	} // end function have_book_clubs
	
	
	
} // end class ImportBookClubsWP