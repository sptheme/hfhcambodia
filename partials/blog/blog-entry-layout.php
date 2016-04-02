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

$post_format = get_post_format();
$entry_style = wpsp_blog_entry_style(); 

// Add classes to the blog entry post class - see framework/blog/blog-functions
$classes = wpsp_blog_entry_classes(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
	<?php
	// Thumbnail entry style uses different layout
	if ( 'thumbnail-entry-style' == $entry_style ) : ?>

	<?php get_template_part( 'partials/blog/media/blog-entry', $post_format ); ?>
	<div class="blog-entry-content entry-details">
		<?php get_template_part( 'partials/blog/blog-entry-title' ); ?>	
		<?php get_template_part( 'partials/blog/blog-entry-meta' ); ?>
		<?php get_template_part( 'partials/blog/blog-entry-content' ); ?>
	</div>
	<?php else : ?>
		<?php get_template_part( 'partials/blog/media/blog-entry', $post_format ); ?>
		<?php get_template_part( 'partials/blog/blog-entry-title' ); ?>	
		<?php get_template_part( 'partials/blog/blog-entry-meta' ); ?>
		<?php get_template_part( 'partials/blog/blog-entry-content' ); ?>
	<?php endif; ?>	
</article><!-- #post-## -->

