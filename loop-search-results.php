<?php
/**
 * Custom - Results Page.
 * @version 1.0
 * @author Eyal Fitoussi
 */

echo "<div class=\"results-wrapper results-wrapper-" . $gmw['ID'] . "\">";
	
	do_action( 'gmw_search_results_start' , $gmw, $post );
	
	echo "<div class=\"results-count\">";
		gmw_pt_within( $gmw, $sm=__( 'Showing', 'GMW' ), $om=__( 'out of', 'GMW' ), $rm=__( 'results', 'GMW' ) ,$wm=__( 'within', 'GMW' ), $fm=__( 'from','GMW' ), $nm=__( 'your location', 'GMW' ) );
	echo "</div>";
	
	do_action( 'gmw_before_top_pagination' , $gmw, $post );
	
	echo "<div class=\"pagination-wrapper pagination-wrapper-top\">";
		gmw_pt_per_page_dropdown( $gmw, '' );
		gmw_pt_paginations( $gmw );
	echo "</div>";

	gmw_results_map( $gmw );
	
	echo "<div class=\"clear\"></div>";
	
	do_action( 'gmw_search_results_before_loop' , $gmw, $post );
	
	echo "<div class=\"loop loop-results\">";
		
		while ( $gmw_query->have_posts() ) {
			$gmw_query->the_post();
			
			echo "<div "; post_class(); echo ">";
				
				do_action( 'gmw_posts_loop_post_start' , $gmw, $post );
				
				echo "<h2 class=\"h2 lrg-txt\">";
					echo "<a href=\"" . get_permalink() . "\">" . get_the_title() . "</a>";
					if ( isset( $gmw['your_lat'] ) && !empty( $gmw['your_lat'] ) ) {
						echo " <span class=\"radius-dis\">("; gmw_pt_by_radius( $gmw, $post ); echo ")</span>";
					}
				echo "</h2>";
				
				echo "<div class=\"address\">";
					// echo "$post->city, $post->state_long $post->zipcode"; 
					echo $post->address;
    			echo "</div> ";
	    			
				if ( get_field( '_book_club__desc' ) ) {
					echo "<div class=\"entry\">";
	    				echo get_field( '_book_club__desc' );
	    			echo "</div>";
				}
				
				echo "<div class=\"email\">";
					echo "<span class=\"icon-envelope\"></span> <a href=\"mailto:" . antispambot( get_field('_book_club__email') ) . "\">Contact Organizer</a>";
    			echo "</div> ";
		    	
				do_action( 'gmw_posts_loop_post_end' , $gmw, $post );
		    	
		    echo "</div>";
	
		}
	
	echo "</div>";
	
	do_action( 'gmw_search_results_after_loop' , $gmw, $post );
	
	echo "<div class=\"pagination-wrapper pagination-wrapper-bottom\">";
		gmw_pt_per_page_dropdown( $gmw, '' );
		gmw_pt_paginations( $gmw );
	echo "</div>";
	
echo "</div>";
