<?php
/**
 * File Name archive-resources.php
 * @package WordPress
 * @subpackage ParentTheme_VC
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 05.12.13
 **/
#################################################################################################### */

get_template_part( 'header' );

$state = $wp_query->queried_object;
$query = array(
	'posts_per_page' => -1,
	'post_type' => 'resource',
	'orderby' => 'title',
	'order' => 'ASC',
	'meta_key' => '_resources__type',
	'meta_value' => 'bookstore',
	'tax_query' => array(
		'relation' => 'AND',
		array(
			'taxonomy' => 'resources',
			'field' => 'slug',
			'terms' => $state->slug
			)
		),
	);

?>

<div class="row-fluid">
	<div class="span8">
		
		<a class="back-link" href="<?php echo home_url(); ?>/search" title="Back to Directory">&laquo; Back to Directory</a>
		<div id="list-resources">
			<div class="row-fluid">
				<?php 

				// Bookstores
				echo "<div class=\"span6\">";
					$wp_query = new WP_Query();		
					$wp_query->query( $query );
					$wp_query->title = "$state->name Bookstores";
					get_template_part( 'list-resource-single' );
					get_template_part( 'list-resources-related' );
				echo "</div>";
				
				
				
				// Public Radio
				echo "<div class=\"span6\">";
					$query['meta_value'] = 'public-radio';
					$wp_query = new WP_Query();
					$wp_query->query( $query );
					$wp_query->title = "Public Radio";
					get_template_part( 'list-resource-single' );


					// Museums
					$query['meta_value'] = 'museums';
					$wp_query = new WP_Query();
					$wp_query->query( $query );
					$wp_query->title = "Museums";
					get_template_part( 'list-resource-single' );


					// performing-arts
					$query['meta_value'] = 'performing-arts';
					$wp_query = new WP_Query();
					$wp_query->query( $query );
					$wp_query->title = "Performing Arts";
					get_template_part( 'list-resource-single' );


					// public-affairs
					$query['meta_value'] = 'public-affairs';
					$wp_query = new WP_Query();
					$wp_query->query( $query );
					$wp_query->title = "Public Affairs";
					get_template_part( 'list-resource-single' );



					wp_reset_postdata();
					wp_reset_query();
				echo "</div>";

				?>
			</div><!-- end row-fluid -->
		</div><!-- end list-resources -->
	</div><!-- end span 8 -->
	
	<div class="span4">
		sidebar hree
	</div>
	
</div>
		
<?php

get_template_part( 'footer' );