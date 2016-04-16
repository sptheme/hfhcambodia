<?php
/**
 * Template part for displaying Staff entry position meta
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Habitat Cambodia
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} 

// Return if disabled via the Customizer
if ( ! wpsp_get_redux( 'is-staff-entry-position', true ) ) {
	return;
}

// Display position
if ( $position = get_post_meta( get_the_ID(), 'wpsp_staff_position', true ) ) : ?>
	<div class="staff-entry-position clear">
		<?php echo $position; ?>
	</div><!-- .staff-entry-position -->
<?php endif; ?>