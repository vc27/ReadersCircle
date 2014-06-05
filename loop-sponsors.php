<?php
/**
 * File Name loop-sponsors.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 06.05.14
 **/
#################################################################################################### */

$query = array(
	'posts_per_page' => -1,
	'post_type' => 'sponsors',
);

$wp_query = new WP_Query();
$wp_query->query( $query );

if ( have_posts() ) {
	
	echo "<div id=\"loop-sponsors\">";
		echo "<div class=\"head entry\">";
			echo "<div class=\"h3\">" . get_field('_col_sponsors_title','option') . "</div>";
			echo get_field('_col_sponsors_content','option');
			echo "<a href=\"#\">Become a Sponsor</a>";
		echo "</div>";
		echo "<div class=\"body\">";
			while ( have_posts() ) {
				the_post();
				
				echo "<div "; post_class(); echo " itemscope itemtype=\"http://schema.org/Book\">";
					echo "<a href=\"" . get_field('_sponsors__url') . "\" target=\"_blank\"><img itemprop=\"image\" src=\"" . get_field('_sponsors__image') . "\" alt=\"\"/></a>";
				echo "</div>";

			} // end while ( have_posts() )
		echo "</div>";
		
	echo "</div>";
	
} // end if ( have_posts() )

wp_reset_postdata();
wp_reset_query();