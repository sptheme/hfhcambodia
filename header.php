<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Habitat Cambodia
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'hfhcambodia' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="container clear">
			<div class="site-branding">
				<?php if( !is_singular() ) echo '<h1 class="site-title">'; else echo '<h2>'; ?>
					<a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/images/hfh-logo.png" alt="<?php bloginfo( 'name' ); ?>"></a>
				<?php if( !is_singular() ) echo '</h1>'; else echo '</h2>'; ?>
			</div><!-- .site-branding -->

			<div class="site-donate"><a href="#" class="button orange"><?php esc_html_e( 'Donate Now', 'hfhcambodia' ); ?></a></div>
		</div> <!-- .container .clear -->
	</header><!-- #masthead -->

	<nav id="site-navigation" class="main-navigation" role="navigation">
		<div class="container clear">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'hfhcambodia' ); ?></button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'container' => false ) ); ?>
		</div>
	</nav><!-- #site-navigation -->

	<?php wpsp_hook_content_top(); ?>

	<div id="content" class="site-content">
		<div class="container clear">
