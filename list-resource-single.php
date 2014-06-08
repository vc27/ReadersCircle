<?php
/**
 * File Name list-resources.php
 * @package WordPress
 * @subpackage ParentTheme_VC
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 04.11.13
 **/
#################################################################################################### */

if ( have_posts() ) {
	echo "<div class=\"list-resource\">";
		echo "<div class=\"h3\">" . $wp_query->title . "</div>";
		echo "<ul>";
			while ( have_posts() ) {
				the_post();
				echo "<li itemscope itemtype=\"http://schema.org/LocalBusiness\">";
					echo "<a itemprop=\"url\" href=\"" . get_field('_resources__url') . "\" title=\"" . esc_attr( strip_tags( $post->post_title ) ) . "\" target=\"_blank\" rel=\"bookmark\"><span itemprop=\"name\">$post->post_title</span></a> <span itemprop=\"address\" itemscope itemtype=\"http://schema.org/PostalAddress\"><span itemprop=\"addressLocality\">" . get_field('_resources__city') . "</span>, <span itemprop=\"addressRegion\">" . get_field('_resources__region_abbr') . "</span></span>";
				echo "</li>";
			}
		echo "</ul>";
	echo "</div>";
}