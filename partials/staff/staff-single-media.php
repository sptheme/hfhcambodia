<?php
/**
 * Template part for displaying staff single content.
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
$thumbnail	= wpsp_get_staff_post_thumbnail();

// Return if thumbnail isn't defined
if ( ! $thumbnail ) {
	return;
} ?>

<div id="staff-single-media" class="staff-single-media">
	<?php echo $thumbnail ?>
</div> <!-- .staff-single-media -->
