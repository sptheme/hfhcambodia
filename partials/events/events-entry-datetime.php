<?php
/**
 * Template part for displaying Event entry datetime
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Habitat Cambodia
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} 

// Display datetime
if ( $datetime = get_post_meta( get_the_ID(), 'wpsp_event_datetime', true ) ) : ?>
	<div class="event-entry-datetime clear">
		<?php 
		$datetime = explode( ' ' , $datetime );
		$start_date = $datetime[0]; 
		$start_time = $datetime[1]; ?>
		<div class="event-date"><?php echo date( 'l, F j, Y', strtotime($start_date) ); ?></div>
		<div class="event-time"><?php echo date( 'h:i A', strtotime($start_time) ); ?></div>
	</div><!-- .event-entry-datetime -->
<?php endif; ?>