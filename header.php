<?php
/**
 * File Name header.php
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @version 2.3
 * @updated 01.20.14
 **/
#################################################################################################### */

get_template_part( 'header-head' );

?>
<!-- Start Body -->
<body <?php body_class(); ?>>
	<?php do_action('after_body_tag'); ?>
	<div id="page">
			
		<!-- Start Header -->
		<div id="header" class="outer-wrap">
			<header class="inner-wrap">
				
				<div class="top-right">
					<?php if ( get_vc_option( 'social_networks', 'facebook' ) ) { ?><a class="ic icon-facebook" target="_blank" href="<?php echo get_vc_option( 'social_networks', 'facebook' ); ?>"></a><?php } ?>
					<?php if ( get_vc_option( 'social_networks', 'twitter' ) ) { ?><a class="ic icon-twitter" target="_blank" href="<?php echo get_vc_option( 'social_networks', 'twitter' ); ?>"></a><?php } ?>
					<a target="_blank" href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=6UU6FRT69WCRC" class="btn btn-orange">Donate</a>
					<span class="meta-data">Yes, we are a 501(c)(3)<br />non-profit organization!</span>
				</div>
				
				<a href="<?php echo home_url(); ?>" title="<?php echo esc_attr( get_bloginfo('name') ); ?>"><img class="logo-text-full" src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo-text-full.png" alt="" /></a>
				
				<?php 
				wp_nav_menu( array( 
					'fallback_cb' => '', 
					'theme_location' => 'primary-navigation', 
					'container' => 'div', 
					'container_id' => 'primary-navigation',
				) );
				?>
				
				<a href="<?php echo home_url(); ?>" title="<?php echo esc_attr( get_bloginfo('name') ); ?>"><img class="img-header" src="<?php echo get_stylesheet_directory_uri(); ?>/images/img-header.jpg" alt="" /></a>
				
				<p><strong>Local listings</strong> 90,000 inquiries served annually! Add your book group.</p>
				
				<div class="clear"></div>
			</header>
		</div>
		
		<!-- Start Main Content -->
		<div id="content-wrap" class="outer-wrap">
			<div class="inner-wrap">