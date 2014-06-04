<?php
/**
 * File Name footer.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 1.4
 * @updated 01.20.14
 **/
#################################################################################################### */

?>
			<div class="clear"></div>
		</div><!-- End content-wrap-inner -->
	</div><!-- End content-wrap -->
	
	<!-- Start Footer -->
	<div id="footer" class="outer-wrap">
		<footer class="inner-wrap">
			<?php 
			
			wp_nav_menu( array( 
				'depth' => 1, 
				'fallback_cb' => '', 
				'theme_location' => 'footer-navigation', 
				'container' => 'div', 
				'container_id' => 'footer-navigation' 
			) );
			
			?>
			<p>Copyright &copy; <?php echo date('Y'); ?> Reader's Circle, Inc., a 501(c)(3) non-profit organization. All rights reserved.</p>
			<div class="clear"></div>
		</footer>
	</div><!-- End Footer -->

</div><!-- End Page -->

<!-- Start wp_footer -->
<?php wp_footer(); ?>
</body>
</html>