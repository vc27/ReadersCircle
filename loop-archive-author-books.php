<?php
/**
 * File Name loop-archive-author-books.php
 * @package WordPress
 * @subpackage ParentTheme_VC
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 05.12.13
 **/
#################################################################################################### */
global $author_book_options;

if ( is_page_template('taxonomy-books.php') ) {
	
	$wp_query = new WP_Query();
	$wp_query->query( array(
		'post_type' => 'book',
		'books' => 'a'
	) );
	
}

if ( have_posts() ) {
	
	echo "<div id=\"loop-archive-author-books\" class=\"loop loop-author-books\">";

		while ( have_posts() ) { 
			the_post();
			echo ThemeSupport::single_book_display();
		} // End while(have_post())

		echo "<div class=\"clear\"></div>";
	echo "</div>";

} // End if(have_post())