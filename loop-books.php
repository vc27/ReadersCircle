<?php
/**
 * File Name loop-books.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 06.05.14
 **/
#################################################################################################### */

$query = array(
	'posts_per_page' => get_field('_col_books_book_count','option'),
	'post_type' => 'book',
	'orderby' => 'rand',
);
if ( is_page_template('tpl-home.php') ) {
	$query['orderby'] = 'meta_value_num';
	
	$query['meta_key'] = '_books__featured_order';
	$query['meta_compare'] = '>';
	$query['meta_value'] = 0;
	$query['meta_query'] = array(
		array(
			'key' => '_books__featured_order',
			'value' => 0,
			'compare' => '>'
		),
		array(
			'key' => '_books__is_featured',
			'value' => 1,
			'compare' => '='
		),
	);
}

$wp_query = new WP_Query();
$wp_query->query( $query );

if ( have_posts() ) {
	
	echo "<div id=\"loop-books\">";
		echo "<div class=\"head entry\">";
			echo "<div class=\"h3\">" . get_field('_col_books_title','option') . "</div>";
			echo get_field('_col_books_content','option');
		echo "</div>";
		echo "<div class=\"body\">";
			echo "<div class=\"hentry-book link\"><a href=\"" . get_field('_col_books_browse_authors_url','option') . "\">Browse all authors</a></div>";
			echo "<div class=\"hentry-book link\"><a href=\"" . get_field('_col_books_list_your_book_url','option') . "\">List your book</a></div>";
			while ( have_posts() ) {
				the_post();
				echo ThemeSupport::single_book_display();
			} // end while ( have_posts() )
		echo "</div>";
		
	echo "</div>";
	
} // end if ( have_posts() )

wp_reset_postdata();
wp_reset_query();