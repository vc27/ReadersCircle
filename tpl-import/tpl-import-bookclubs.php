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
	var $querystr = "SELECT * FROM circles WHERE xloc = '_ad' LIMIT 10";
	
	
	
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
		
		$this->set_book_clubs();
		$this->prep_book_clubs();
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
		$this->append__post( 'post_content', $this->_post->descr );
		$this->append__post( 'post_status', 'publish' );
		$this->append__post( 'post_author', 1 );
		$this->append__post( 'post_type', 'book' );
		
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
					case 'first_name' :
						$this->append__post_meta( 'key', "_books__first_name" );
						break;
					case 'last_name' : 
						$this->append__post_meta( 'key', "_books__last_name" );
						break;
					case 'author_email' :
						$this->append__post_meta( 'key', "_books__email" );
						break;
					case 'book_url' :
						$this->append__post_meta( 'key', "_books__book_url" );
						break;
					case 'author_link' :
						$this->append__post_meta( 'key', "_books__site_url" );
						break;
					case 'book_image' :
						$this->append__post_meta( 'key', "_books__image_url" );
						break;
					case 'featured' :
						$this->append__post_meta( 'key', "_books__is_featured" );
						break;
					case 'order' :
						$this->append__post_meta( 'key', "_books__featured_order" );
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
				print_r($this); die('need to finish method set__post_meta_array');
				$this->append__posts_meta();
				
				$this->set__post_terms_array();
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