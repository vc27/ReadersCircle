<?php 
/**
 * Default search form for Post, post types and pages.
 * @version 1.0
 * @author Eyal Fitoussi
 */

echo "<div id=\"gmw-form-wrap\">";
echo "<div id=\"gmw-form-wrapper-" . $gmw['ID'] . "\" class=\"gmw-form-wrapper gmw-form-wrapper-" . $gmw['ID'] . " gmw-pt-form-wrapper\">";
	
	echo "<form id=\"gmw-form-" . $gmw['ID'] . "\" class=\"standard-form gmw-form gmw-form-" . $gmw['ID'] . " gmw-pt-form \" name=\"gmw_form\" action=\"" . $gmw['search_results']['results_page'] . "\" method=\"get\">";
			
		do_action( 'gmw_search_form_start', $gmw );
		
		echo "<div class=\"gmw-post-types-wrapper\">";
			gmw_pt_form_post_types_dropdown( $gmw, $title='', $class='', $all= __(' -- Search Site -- ','GMW') );
		echo "</div>";
		
		do_action( 'gmw_search_form_before_taxonomies', $gmw );
		
		echo "<div class=\"gmw-taxonomies-wrapper\">";
			gmw_pt_form_taxonomies( $gmw, $tag='', $class='kaka' );
		echo "</div>";
		
		do_action( 'gmw_search_form_before_address', $gmw );
		
		gmw_search_form_address_field( $gmw, $id='', $class='' );
		
		GeoMyIPWP::gmw_form_submit_fields( $gmw, 'Go' );
		
		gmw_search_form_locator_icon( $gmw, $class='' );
		
		do_action( 'gmw_search_form_before_distance', $gmw );
		
		echo "<div class=\"gmw-unit-distance-wrapper\">";
			gmw_search_form_radius_values( $gmw, $class='', $btitle='', $stitle='' );
			gmw_search_form_units( $gmw, $class='' );
			echo GeoMyIPWP::select_country();
		echo "</div>";
		
		do_action( 'gmw_search_form_end', $gmw );
		
	echo "</form>";
echo "</div>";
echo "</div>";