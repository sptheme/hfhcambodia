<?php
/**
 * Template part for displaying testimonial entry meta.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Habitat Cambodia
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<div class="testimonial-entry-meta clear">
	<?php get_template_part( 'partials/testimonials/testimonials-entry-author' ); ?>
	<?php get_template_part( 'partials/testimonials/testimonials-entry-other' ); ?>
</div><!-- .testimonial-entry-meta -->