<?php
/**
 * Template part for displaying events entry post.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Habitat Cambodia
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} 

$classes = wpsp_event_passed_class( get_the_ID() ); ?>

<article id="#post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
	<header id="event-single-header" class="single-header clear">
		<h1 id="event-single-title" class="entry-title single-post-title">
			<?php the_title(); ?>
			<span><?php echo __( 'Passed Event', 'hfhcambodia' ); ?></span>
		</h1>
		<?php // Display datetime
		if ( $datetime = get_post_meta( get_the_ID(), 'wpsp_event_datetime', true ) ) : ?>
			<div class="event-single-datetime clear">
				<?php 
				$location = get_post_meta( get_the_ID(), 'wpsp_event_location', true ); 
				$datetime = explode( ' ' , $datetime );
				$start_date = $datetime[0]; 
				$start_time = $datetime[1]; ?>
				<?php if ( $location ) : ?>
				<div class="event-location"><?php echo esc_html( $location ); ?></div>
				<?php endif; ?>
				<div class="event-datetime"><?php echo date( 'l, F j, Y', strtotime($start_date) ); ?> &#8212; <?php echo date( 'h:i A', strtotime($start_time) ); ?></div>				
			</div><!-- .event-single-datetime -->
		<?php endif; ?>
	</header><!-- #event-single-header -->
	<div class="entry clear">
		<?php the_content(); ?>
	</div>
</article><!-- .events-entry -->
<?php get_template_part( 'partials/social-share' ); ?>
<?php //get_template_part( 'partials/events/events-single-related' ); ?>
