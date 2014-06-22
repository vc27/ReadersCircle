<?php
/**
 * File Name loop-featured-video.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 12.10.13
 **/
#################################################################################################### */

$query = array(
	'posts_per_page' => -5,
	'post_type' => 'tribe_events',
	'meta_key' => '_EventStartDate',
	'orderby' => 'meta_value_num',
	'order' => 'ASC',
	'meta_query' => array(
		array(
			'key' => '_EventStartDate',
			'value' => date( 'Y-m-d' ),
			'compare' => '>='
		)
	)
);

$wp_query = new WP_Query();
$wp_query->query( $query );

if ( have_posts() ) {
	echo "<div id=\"loop-event-dates\" class=\"sidebar\">";
		echo "<div class=\"head entry\">";
			echo "<div class=\"h3\">" . get_field('_col_events_title','option') . "</div>";
			echo get_field('_col_events_content','option');
			echo "<a href=\"" . get_field('_col_events_link','option') . "\">" . get_field('_col_events_link_text','option') . "</a>";
		echo "</div>";
		echo "<div class=\"body\">";
			while ( have_posts() ) {
				the_post();
				echo "<div class=\"hentry\" itemscope itemtype=\"http://schema.org/Event\">";
					echo "<a itemprop=\"url\" class=\"item block-link\" href=\"$post->_EventURL\" target=\"_blank\">";
						echo "<strong itemprop=\"name\">$post->post_title</strong><br />";
						echo "<em itemprop=\"address\" itemscope itemtype=\"http://schema.org/PostalAddress\"><span itemprop=\"addressLocality\">$post->_VenueCity, $post->_VenueState</span></em><br />";
						echo "<meta itemprop=\"startDate\" content=\"$post->_EventStartDate\">";
						echo "$post->date - $post->time";
					echo "</a>";
				echo "</div>";
			} // end while ( have_posts() )
		echo "</div>";
		echo "<div class=\"clear\"></div>";
	echo "</div>";
	
} // end if ( have_posts() )
wp_reset_postdata();
wp_reset_query();