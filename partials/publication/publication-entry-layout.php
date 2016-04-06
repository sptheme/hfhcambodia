<?php
/**
 * Template part for displaying entry publication post.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Habitat Cambodia
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array('wpsp-row', 'clearfix', 'publication-entry') ); ?>>
	<?php get_template_part( 'partials/publication/publication-entry-media' ); ?>
	<?php get_template_part( 'partials/publication/publication-entry-title' ); ?>	
	<?php get_template_part( 'partials/publication/publication-entry-meta' ); ?>
</article><!-- #post-## -->
