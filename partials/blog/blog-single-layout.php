<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Habitat Cambodia
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} 

// Get single blog layout blocks
$post_format       = get_post_format();
$password_required = post_password_required(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'single-blog-article', 'clear' ) ); ?>>
	<?php 
	// Render blog single post layout
	if ( 'gallery' == $post_format ) {
		get_template_part( 'partials/blog/blog-single-title' ); 
		get_template_part( 'partials/blog/blog-single-meta' );
		get_template_part( 'partials/blog/blog-single-content' );
		if ( ! $password_required ) {
			get_template_part( 'partials/blog/media/blog-single', $post_format ); 
		}
	} else { 
		if ( ! $password_required ) {
			get_template_part( 'partials/blog/media/blog-single', $post_format ); 
		}
		get_template_part( 'partials/blog/blog-single-title' ); 
		get_template_part( 'partials/blog/blog-single-meta' );
		get_template_part( 'partials/blog/blog-single-content' ); 
	} ?>
	<?php get_template_part( 'partials/social-share' ); ?>
	<?php //the_post_navigation(); ?>
	<?php get_template_part( 'partials/blog/blog-single-related' ); ?>
</article><!-- #post-## -->

