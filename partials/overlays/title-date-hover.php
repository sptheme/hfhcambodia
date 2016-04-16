<?php
/**
 * Title Date Hover Overlay
 *
 * @package Habitat Cambodia
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Only used for inside position
if ( 'inside_link' != $position ) {
	return;
} ?>

<div class="overlay-title-date-hover overlay-hide theme-overlay">
	<div class="overlay-title-date-hover-inner clear">
		<div class="overlay-title-date-hover-text clear">
			<div class="overlay-title-date-hover-title">
				<?php the_title(); ?>
			</div><!-- .overlay-title-date-hover-title -->
			<div class="overlay-title-date-hover-date">
				<?php echo get_the_date( 'F j, Y' ); ?>
			</div><!-- .overlay-title-date-hover-date -->
		</div><!-- .overlay-title-date-hover-text -->
	</div><!-- .overlay-title-date-hover-inner -->
</div><!--. overlay-title-date-hover -->