<?php
/**
 * File Name links-author-books-directory.php
 * @package WordPress
 * @subpackage ParentTheme_VC
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 05.12.13
 **/
#################################################################################################### */

$terms = get_terms( 'books' );
if ( isset( $terms ) AND is_array( $terms ) AND ! empty( $terms ) ) {
	$i = 0;
	
	$this_object_slug = 'a';
	if ( isset( $wp_query->queried_object->slug ) AND ! empty( $wp_query->queried_object->slug ) ) {
		$this_object_slug = $wp_query->queried_object->slug;
	}
	
	echo "<div id=\"links-author-books-directory\" class=\"books-abc\">";
		echo "<ul>";
			echo "<li class=\"title\">Authors: </li>";
			foreach ( $terms as $term ) {
				$i++;
				
				if ( $this_object_slug == $term->slug ) {
					$class = 'current-term';
				} else {
					$class = false;
				}
				
				echo "<li class=\"$class\"><a href=\"" . get_term_link( $term, 'books' ) . "\" title=\"Authors: $term->name\">$term->name</a></li>";
			}
		echo "</ul>";
	echo "</div>";
}