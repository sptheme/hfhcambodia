<?php
/**
 * Template part for displaying staff single position.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Habitat Cambodia
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} 

// Display if position is defined
if ( $position = get_post_meta( get_the_ID(), 'wpsp_staff_position', true ) ) : ?>
	<div id="staff-single-position" class="single-staff-position clear"><?php echo $position; ?></div>
<?php endif; ?>
