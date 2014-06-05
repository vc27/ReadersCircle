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
			echo "<div class=\"hentry link\"><a href=\"#\">Browse all authors</a></div>";
			echo "<div class=\"hentry link\"><a href=\"#\">List your book</a></div>";
			while ( have_posts() ) {
				the_post();
				if ( $image = get_field('_books__image') AND isset( $image['url'] ) ) {
					$image = $image['url'];
				} else if ( get_field('_books__image_url') ) {
					$image = get_field('_books__image_url');
				}
				
				echo "<div "; post_class(); echo " itemscope itemtype=\"http://schema.org/Book\">";
					echo "<div class=\"post-wrap\">";
						echo "<a href=\"" . get_field('_books__book_url') . "\" target=\"_blank\"><img itemprop=\"image\" src=\"$image\" alt=\"\"/></a>";
						echo "<span itemprop=\"name\">" . get_the_title() . "</span>";
						echo "<a itemprop=\"author\" href=\"mailto:" . antispambot( get_field('_books__email') ) . "\" target=\"_blank\">" . get_field('_books__first_name') . " " . get_field('_books__last_name') . "</a>";
					echo "</div>";
				echo "</div>";

			} // end while ( have_posts() )
		echo "</div>";
		
	echo "</div>";
	
} // end if ( have_posts() )

wp_reset_postdata();
wp_reset_query();