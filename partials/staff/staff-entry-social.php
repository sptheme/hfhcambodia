<?php
/**
 * Template part for displaying staff entry excerpt.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Habitat Cambodia
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} 

// Display if enabled
if ( wpsp_get_redux( 'staff-entry-social', true ) ) : ?>
	<?php echo wpsp_get_staff_social(); ?>
<?php endif; ?>
