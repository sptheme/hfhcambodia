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
} ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'single-blog-article', 'clear' ) ); ?>>
	<?php get_template_part( 'partials/blog/blog-single-title' ); 
	get_template_part( 'partials/blog/blog-single-meta' );
	get_template_part( 'partials/blog/blog-single-content' ); ?>
</article><!-- #post-## -->

