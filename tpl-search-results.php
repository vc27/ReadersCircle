<?php
/* Template Name: Search Results */

/**
 * File Name tpl-search-results.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.0
 * @updated 00.00.00
 **/
#################################################################################################### */

get_template_part( 'header' );

?>
<div class="row-fluid">
	<div class="span8">
		<?php 
		
		get_template_part( 'loop-page-default' ); 
		
		?>
	</div>
	<div class="span4">
		<?php get_template_part( 'loop-books' ); ?>
	</div>
</div>
<?php
get_template_part( 'footer' );