<?php
/**
 * Template part for displaying Event entry meta
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Habitat Cambodia
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<?php // Display datetime
if ( $datetime = get_post_meta( get_the_ID(), 'wpsp_event_datetime', true ) ) : 
	$datetime = explode( ' ' , $datetime );
	$start_date = $datetime[0]; ?>

	<div class="event-entry-meta">
		<span class="event-day"><?php echo date('d', strtotime($start_date)); ?></span>
		<span class="event-month"><?php echo date('M', strtotime($start_date)); ?></span>
	</div>

<?php endif; ?>