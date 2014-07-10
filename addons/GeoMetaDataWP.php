<?php
/**
 * @package WordPress
 * @subpackage ProjectName
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
####################################################################################################





/**
 * GeoMetaDataWP
 *
 * @version 1.0
 * @updated 00.00.00
 **/
$GeoMetaDataWP = new GeoMetaDataWP();
class GeoMetaDataWP {
	
	
	
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
		
		if ( ! is_admin() ) {
			
			add_action( 'init', array( &$this, 'init' ) );
		}

	} // end function __construct
	
	
	
	
	
	
	/**
	 * init
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function init() {
		
		add_action( 'wp_head', array( &$this, 'wp_head' ), 1 );
		
	} // end function init
	
	
	
	
	
	
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
	
	
	
	
	
	
	####################################################################################################
	/**
	 * Functionality
	 **/
	####################################################################################################
	
	
	
	
	
	
	/**
	 * wp_head
	 *
	 * @version 1.0
	 * @updated 00.00.00
	 **/
	function wp_head() {
		
		if ( is_single() AND get_post_type() == 'book-club' ) {
			global $post;
			?>
			
			<!-- Geo Meta -->
			<meta name="geo.position" content="<?php echo $post->location->lat; ?>;<?php echo $post->location->long; ?>" />
			<meta name="geo.placename" content="<?php echo $post->location->city; ?>, <?php echo $post->location->state_long; ?>, <?php echo $post->location->state; ?>, <?php echo $post->location->country; ?>" />
			<meta name="geo.region" content="<?php echo $post->location->country; ?>-<?php echo $post->location->state; ?>" />

			<meta property="og:locality" content="<?php echo $post->location->city; ?>" />
			<meta property="og:country-name" content="<?php echo $post->location->country; ?>" />
			<meta property="og:region" content="<?php echo $post->location->state; ?>" />
			<meta property="og:postal-code" content="<?php echo $post->location->zipcode; ?>" />
			<meta property="og:latitude" content="<?php echo $post->location->lat; ?>" />
			<meta property="og:longitude" content="<?php echo $post->location->long; ?>" />

<?php
		}
		
	} // end function wp_head
	
	
	
	
	
	
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
	
	
	
} // end class GeoMetaDataWP