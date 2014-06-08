<?php
/* Template Name: Import Resources */

/**
 * File Name tpl-import-resources.php
 * @package WordPress
 * @subpackage ParentTheme_VC
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 00.00.13
 **/
####################################################################################################

die('class ImportResourcesVCWP is de-activated');



/**
 * ClassName
 *
 * @version 1.0
 * @updated 00.00.13
 **/
class ImportResourcesVCWP {
	
	
	
	/**
	 * querystr
	 * 
	 * @access public
	 * @var string
	 **/
	var $querystr = "SELECT * FROM resource";
	
	
	
	/**
	 * resource
	 * 
	 * @access public
	 * @var object
	 **/
	var $resource = null;
	
	
	
	/**
	 * resources
	 * 
	 * @access public
	 * @var array
	 **/
	var $resources = array();
	
	
	
	/**
	 * have_raw_resources
	 * 
	 * @access public
	 * @var bool
	 **/
	var $have_raw_resources = 0;
	
	
	
	/**
	 * raw_resources
	 * 
	 * @access public
	 * @var array
	 **/
	var $raw_resources = null;
	
	
	
	
	
	
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
	 * get__resources
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function get__resources() {
		global $wpdb;

		$this->set( 'raw_resources', $wpdb->get_results( $this->querystr ) );
		
	} // end function get__resources
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Functionality
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * import
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function import() {
		
		$this->get__resources();
		if ( $this->have_raw_resources() ) {
			$this->process_resources();
			
			$CreatePostsVCWP = create__posts( $this->resources, array(
				'overwrite_posts' => true
			) );
			print_r($CreatePostsVCWP);
			
		}
		
	} // end function import 
	
	
	
	
	
	
	/**
	 * process_resources
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function process_resources() {
		
		foreach ( $this->raw_resources as $this->k => $this->resource ) {
			$this->append__resource__post();
			$this->append__resource__post_meta();
			$this->append__resource__terms();
		}
		
	} // end function process_resources
	
	
	
	
	
	
	/**
	 * append__resource__post
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function append__resource__post() {
		
		$this->resources[$this->k]['post'] = array(
			'post_title' => $this->resource->name,
			'post_type' => 'resource',
			'post_status' => 'publish'
		);
		
	} // end function append__resource__post 
	
	
	
	
	
	
	/**
	 * append__resource__post_meta
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function append__resource__post_meta() {
		
		$this->resources[$this->k]['post_meta'] = array(
			'_resources__url' => array(
				'key' => '_resources__url',
				'value' => $this->resource->url,
				'unique' => 1,
			),
			'_resources__email' => array(
				'key' => '_resources__email',
				'value' => $this->resource->email,
				'unique' => 1,
			),
			'_resources__city' => array(
				'key' => '_resources__city',
				'value' => $this->resource->city,
				'unique' => 1,
			),
			'_resources__state' => array(
				'key' => '_resources__state',
				'value' => $this->resource->state,
				'unique' => 1,
			),
			'_resources__region_abbr' => array(
				'key' => '_resources__region_abbr',
				'value' => $this->resource->state_abbr,
				'unique' => 1,
			),
			'_resources__country' => array(
				'key' => '_resources__country',
				'value' => $this->resource->country,
				'unique' => 1,
			),
			'_resources__type' => array(
				'key' => '_resources__type',
				'value' => $this->resource->type,
				'unique' => 1,
			),
		);
		
	} // end function append__resource__post_meta 
	
	
	
	
	
	
	/**
	 * append__resource__terms
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function append__resource__terms() {
		
		$this->resources[$this->k]['post_terms'] = array(
			'resources' => array(
				'append_terms' => false,
				'taxonomy' => 'resources',
				'terms' => array( $this->resource->state ),
			),
		);
		
	} // end function append__resource__terms
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Conditionals
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * have_raw_resources
	 *
	 * @version 1.0
	 * @updated 00.00.13
	 **/
	function have_raw_resources() {
		
		if ( isset( $this->raw_resources ) AND is_array( $this->raw_resources ) AND ! empty( $this->raw_resources ) ) {
			$this->set( 'have_raw_resources', 1 );
		} else {
			$this->set( 'have_raw_resources', 0 );
		}
		
		return $this->have_raw_resources;
		
	} // end function have_raw_resources
	
	
	
} // end class ImportResourcesVCWP


$resources = new ImportResourcesVCWP();
$resources->import();