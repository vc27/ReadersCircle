<?php
/* Template Name: 04 Import Books */

/**
 * File Name tpl-import-books.php
 * @subpackage MetaCake
 * @license MetaCake LLC
 * @version 1.0
 * @updated 00.00.13
 **/
####################################################################################################


// die('ImportBooks deactivated');


/**
 * ImportBooks
 *
 * @version 1.0
 * @updated 00.00.13
 **/
$ImportBooks = new ImportBooks();
class ImportBooks {
	
	
	
	/**
	 * querystr
	 * 
	 * @access public
	 * @var string
	 **/
	var $querystr = "SELECT * FROM authors";
	
	
	
	/**
	 * k
	 * 
	 * @access public
	 * @var int
	 **/
	var $k = 0;
	
	
	
	/**
	 * post
	 * 
	 * @access public
	 * @var array
	 **/
	var $post = null;



	/**
	 * posts
	 * 
	 * @access public
	 * @var array
	 **/
	var $posts = null;
	
	
	
	/**
	 * have_posts
	 * 
	 * @access public
	 * @var bool
	 **/
	var $have_posts = 0;
	
	
	
	/**
	 * post_meta
	 * 
	 * @access public
	 * @var array
	 **/
	var $post_meta = null;
	
	
	
	/**
	 * posts_meta
	 * 
	 * @access public
	 * @var array
	 **/
	var $posts_meta = null;
	
	
	
	/**
	 * books
	 * 
	 * @access public
	 * @var array
	 **/
	var $books = 0;



	/**
	 * have_books
	 * 
	 * @access public
	 * @var bool
	 **/
	var $have_books = 0;



	/**
	 * book
	 * 
	 * @access public
	 * @var array
	 **/
	var $book = 0;
	
	
	
	/**
	 * have_book
	 * 
	 * @access public
	 * @var bool
	 **/
	var $have_book = 0;
	
	
	
	/**
	 * term
	 * 
	 * @access public
	 * @var string
	 **/
	var $term = 0;
	
	
	
	/**
	 * have_term
	 * 
	 * @access public
	 * @var bool
	 **/
	var $have_term = 0;
	
	
	
	
	
	
	/**
	 * __construct
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function __construct() {
		
		$this->get_books();
		if ( $this->have_books() ) {
			$this->prep_books();
			$this->import_books();
		}
		
	} // end function __construct
	
	
	
	
	
	
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
		
	} // end function set
	
	
	
	
	
	
	/**
	 * get_books
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function get_books() {
		global $wpdb;

		$this->books = $wpdb->get_results( $this->querystr );
		
	} // end function get_books
	
	
	
	
	
	
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
		
		$this->append__post( 'post_title', $this->book->book_title );
		$this->append__post( 'post_content', $this->book->author_content );
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
		
		foreach ( $this->book as $meta_key => $meta_value ) {
			
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
	 * prep_books
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function prep_books() {
		
		foreach ( $this->books as $this->k => $this->book ) {
			
			if ( $this->have_book() ) {
				
				$this->set__post_array();
				$this->append__posts();
				
				$this->set__post_meta_array();
				$this->append__posts_meta();
				
				$this->set__post_terms_array();
				
			}
			
		}
		
	} // end function prep_books
	
	
	
	
	
	
	/**
	 * import_books
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function import_books() {
		
		$CreatePostsVCWP = create__posts( $this->posts, array(
			'overwrite_posts' => true
		) );
		print_r($CreatePostsVCWP);
		
	} // end function import_books
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Conditionals
	 **/
	####################################################################################################
	
	
	
	
	
	/**
	 * have_books
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_books() {

		if ( isset( $this->books ) AND is_array( $this->books ) AND ! empty( $this->books ) ) {
			$this->set( 'have_books', 1 );
		} else {
			$this->set( 'have_books', 0 );
		}
		
		return $this->have_books;
		
	} // end function have_books 
	
	
	
	
	
	
	/**
	 * have_book
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_book() {

		if ( isset( $this->book ) AND is_object( $this->book ) AND ! empty( $this->book ) ) {
			$this->set( 'have_book', 1 );
		} else {
			$this->set( 'have_book', 0 );
		}
		
		return $this->have_book;
		
	} // end function have_book 
	
	
	
	
	
	
	/**
	 * have_posts
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_posts() {

		if ( isset( $this->posts ) AND is_array( $this->posts ) AND ! empty( $this->posts ) ) {
			$this->set( 'have_posts', 1 );
		} else {
			$this->set( 'have_posts', 0 );
		}
		
		return $this->have_posts;
		
	} // end function have_posts 
	
	
	
	
	
	
	/**
	 * have_term
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_term() {

		if ( isset( $this->term ) AND ! empty( $this->term ) ) {
			$this->set( 'have_term', 1 );
		} else {
			$this->set( 'have_term', 0 );
		}
		
		return $this->have_term;
		
	} // end function have_term
	
	
	
} // end class ImportBooks