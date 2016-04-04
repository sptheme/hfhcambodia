<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Habitat Cambodia
 */

?>
		</div> <!-- .container .clear -->
	</div><!-- #content -->

	<?php wpsp_hook_content_bottom(); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div id="footer-top-sidebar" class="footer-top-sidebar">
			<?php if ( is_active_sidebar( 'footer-top-sidebar' ) ) : ?>
			<?php dynamic_sidebar( 'footer-top-sidebar' ); ?>
			<?php else : ?>
				<p>Go to <strong>Widget</strong> in Appearance menu to add widget into <strong>Footer Top Sidebar</strong>.</p>
			<?php endif; ?>
		</div> <!-- .footer-top-sidebar -->
		<div id="footer-bottom-sidebar" class="footer-bottom-sidebar">
			<div class="container clear col span_1_of_3">
				<?php if ( is_active_sidebar( 'footer-bottom-sidebar' ) ) : ?>
				<?php dynamic_sidebar( 'footer-bottom-sidebar' ); ?>
				<?php else : ?>
					<p>Go to <strong>Widget</strong> in Appearance menu to add widget into <strong>Footer Bottom Sidebar</strong>.</p>
				<?php endif; ?>
			</div> <!-- .container .clearfix -->	
		</div> <!-- .footer-bottom-sidebar -->

		<div class="site-info">
			<div class="copyright"><?php esc_html_e( 'All content copyright © 2012, Habitat For Humanity Cambodia. All Rights Reserved.', 'hfhcambodia' ); ?></div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<nav id="sitemenu-container" role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
	<div id="inner-mobile-menu">
	    <div class="mobile-branding">
	    	<img src="<?php echo get_template_directory_uri(); ?>/images/hfh-logo.png" alt="<?php bloginfo( 'name' ); ?>">
	    </div>
	    
	    <?php if ( has_nav_menu( 'mobile' ) ) {
	    		wp_nav_menu( array( 'container' => false, 'menu_id' => 'menu-mobile', 'theme_location' => 'mobile', 'menu_class' => 'mobile-nav' ) ); 
	    	}?>
    </div> <!-- #inner-mobile-menu -->
</nav>

<?php wp_footer(); ?>

</body>
</html>
