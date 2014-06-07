<?php
/* Template Name: Author Directory */

/**
Note: This page is used as both a page-template and an archive template.
**/

/**
 * File Name taxonomy-books.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.8
 * @updated 01.20.14
 **/
#################################################################################################### */

get_template_part( 'header' );

echo "<div class=\"row-fluid\">";

	echo "<div class=\"span8\">";
		if ( is_archive() ) {
			$wp_query = new WP_Query();
			$wp_query->query( array(
				'post_type' => 'page',
				'meta_key' => '_wp_page_template',
				'meta_value' => 'taxonomy-books.php',
				) );
		}
		get_template_part( 'loop-page-default' );
		wp_reset_postdata();
		wp_reset_query();
		
		get_template_part( 'links-author-books-directory' );
		get_template_part( 'loop-archive-author-books' );
		
	echo "</div>";
	
	echo "<div class=\"span4\">";
		echo "Side Bar Here...";
	echo "</div>";
	
echo "</div>";

get_template_part( 'footer' );