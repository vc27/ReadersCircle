<?php
/**
 * File Name list-resources.php
 * @package WordPress
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 04.11.13
 **/
#################################################################################################### */

$taxonomy = 'resources';
$terms = get_terms( $taxonomy ); 
if ( ! is_wp_error($terms) ) {
	
	$term_count = count( $terms );
	$col_count = ceil( $term_count / 3 );
	$n = 1;
	$i = 0;
	$j = $col_count;
	
	?>
	<div id="list-bookstore">

		<div class="h3">US Independent Bookstores</div>
		<div class="row-fluid">
			<ul class="span4">
			<?php

				foreach ( $terms as $term ) {
					$i++;

					echo "<li><a href=\"" . get_term_link( $term, $taxonomy ) . "\" title=\"" . esc_html( strip_tags( $term->name ) ) . "\">$term->name</a></li>";

					if ( $i == $j ) {
						$n++;
						$j = $j + $col_count;
						echo "</ul>";

						if ( $i < $term_count ) {
							echo "<ul class=\"span4\">";
						}

					}

				} // end foreach ( $terms as $term )

			?>
			</ul>
		</div>
	</div>
	<?php

} // end if ( isset( $terms ) AND is_array( $terms ) AND ! empty( $terms ) )