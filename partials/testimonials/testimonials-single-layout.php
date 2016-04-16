<?php
/**
 * Template part for displaying Testimonials single post layout.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Habitat Cambodia
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<div class="entry-content entry clear">

	<?php if ( 'standard' == wpsp_get_redux( 'testimonial-post-style', 'standard' ) ) : ?>

		<?php get_template_part( 'partials/testimonials/testimonials-entry' ); ?>

	<?php else : ?>
		<blockquote>
		<?php the_content(); ?>
		</blockquote>

	<?php endif; ?>

</div>
