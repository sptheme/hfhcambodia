<?php
/**
 * Template part for displaying Staff entry media
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Habitat Cambodia
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get thumbnail
$thumbnail	= wpsp_get_staff_entry_thumbnail();

// Return if thumbnail isn't defined
if ( ! $thumbnail ) {
	return;
}

// Classes
$classes = array( 'staff-entry-media', 'clear' );
if ( $overlay = wpsp_overlay_classes() ) {
	$classes[] =	$overlay;
}
$classes = implode( ' ', $classes ); ?>

<div class="<?php echo $classes; ?>">

	<?php
	// Open link around staff members if enabled
	if ( wpsp_get_redux( 'is-staff-link', true ) ) : ?>

		<a href="<?php wpsp_permalink(); ?>" title="<?php wpsp_esc_title(); ?>" rel="bookmark">

	<?php endif; ?>

		<?php echo $thumbnail; ?>

		<?php
		// Inside overlay HTML
		wpsp_overlay( 'inside_link' ); ?>

	<?php
	// Close link around staff item if enabled
	if ( wpsp_get_redux( 'is-staff-link', true ) ) echo '</a>'; ?>

	<?php
	// Outside overlay HTML
	wpsp_overlay( 'outside_link' ); ?>

</div><!-- .staff-entry-media -->