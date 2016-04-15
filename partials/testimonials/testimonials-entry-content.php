<?php
/**
 * Template part for displaying testimonial entry content.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Habitat Cambodia
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<div class="testimonial-entry-content clear">
	<span class="testimonial-caret"></span>
	<?php if ( wpsp_get_redux( 'is-testimonial-entry-title', true ) ) : ?>
		<h2 class="testimonial-entry-title entry-title clear">
			<?php the_title(); ?>
		</h2><!-- .testimonial-entry-title -->
	<?php endif; ?>
	<div class="testimonial-entry-text">
		<?php the_content(); ?>
	</div><!-- .testimonial-entry-text -->
</div><!-- .home-testimonial-entry-content-->