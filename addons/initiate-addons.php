<?php
/**
 * File Name initiate-addons.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.2
 * @updated 10.02.13
 *
 * Description:
 * Include core functionality, activation and theme functions.
 **/
#################################################################################################### */


if ( ! defined('THEME_ADDONS_INIT') ) {
	
	// Init ParentTheme_VC lib
	require_once( get_template_directory() . "/includes/initiate-lib.php" );
	
	// Added Functionality
	require_once( "ThemeSupport/initiate.php" );
	require_once( "AdminCustomizationsWP.php" );
	require_once( "GeoMyIPWP.php" );
	
	require_once( "BookClubsPostType.php" );
	require_once( "BookPostType.php" );
	require_once( "ResourcesPostType.php" );
	require_once( "SponsorsPostType.php" );
	
	define( 'THEME_ADDONS_INIT', true );
	
} // end if ( ! defined('THEME_ADDONS_INIT') )