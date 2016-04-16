<?php
/**
 * Template part for displaying staff entry post.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Habitat Cambodia
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<article id="#post-<?php the_ID(); ?>" <?php post_class( array('wpsp-row', 'clear') ); ?>>
	<div class="col span_1_of_3">
		<?php get_template_part( 'partials/staff/staff-single-media' ); ?>
	</div>
	<div class="col span_2_of_3">
		<?php get_template_part( 'partials/staff/staff-single-title' ); ?>
		<?php get_template_part( 'partials/staff/staff-single-content' ); ?>
	</div>
</article><!-- .staff-entry -->
<?php get_template_part( 'partials/staff/staff-single-share' ); ?>
<?php get_template_part( 'partials/staff/staff-single-related' ); ?>
