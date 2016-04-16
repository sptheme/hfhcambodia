<?php
/**
 * Template part for displaying Staff entry content
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Habitat Cambodia
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Return if disabled
if ( is_singular( 'staff' ) ) {

	// Disabled on related posts
	if ( ! wpsp_get_redux( 'is-staff-post-related', true ) ) {
		return;
	}

} else {

	// Disabled on archives
	if ( ! wpsp_get_redux( 'staff-entry-details', true ) ) {
		return;
	}

}

// Entry content classes
$classes = 'staff-entry-details clear'; ?>

<div class="<?php echo $classes; ?>">
	<?php get_template_part( 'partials/staff/staff-entry-title' ); ?>
	<?php get_template_part( 'partials/staff/staff-entry-position' ); ?>
	<?php get_template_part( 'partials/staff/staff-entry-excerpt' ); ?>
	<?php //get_template_part( 'partials/staff/staff-entry-social' ); ?>
</div><!-- .staff-entry-details -->