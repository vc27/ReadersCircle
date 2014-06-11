<?php
/**
 * File Name single.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.3
 * @updated 01.20.14
 **/
#################################################################################################### */

get_template_part( 'header' );

echo "<div class=\"row-fluid\">";
	echo "<div class=\"span8\">";

		// Default Loop
		if ( have_posts() ) { 
			$i = 0; 

			echo "<div id=\"loop-default\" class=\"loop\">";
			
				while ( have_posts() ) { 
					the_post();

					echo "<article "; post_class(); echo ">";

						vc_title( $post, array( 
							'permalink' => false,
							'class' => 'lrg-txt',
						) );

						echo "<div class=\"address\">";
							// echo "$post->city, $post->state_long $post->zipcode"; 
							echo $post->location->address;
		    			echo "</div> ";

						if ( get_field( '_book_club__desc' ) ) {
							echo "<div class=\"entry\">";
			    				echo get_field( '_book_club__desc' );
			    			echo "</div>";
						}

						echo "<div class=\"email\">";
							echo "<span class=\"icon-envelope\"></span> <a href=\"mailto:" . antispambot( get_field('_book_club__email') ) . "\">Contact Organizer</a>";
		    			echo "</div> ";

						echo "<div class=\"clear\"> </div>";
					echo "</article>";

				} // End while(have_post())

				echo "<div class=\"clear\"></div>";
			echo "</div>";


		} // End if(have_post())


	echo "</div>";
	echo "<div class=\"span4\">";
		get_template_part( 'loop-books' );
	echo "</div>";
echo "</div>";

get_template_part( 'footer' );