<?php
/**
 * Title Excerpt Hover Overlay
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
}

// Get excerpt length
$excerpt_length = isset( $args['overlay_excerpt_length'] ) ? $args['overlay_excerpt_length'] : 15;

// Generate Excerpt
$excerpt = wpsp_get_excerpt( array(
    'length' => $excerpt_length,
) );

// Make sure excerpt isn't too long when custom
if ( strlen( $excerpt ) > $excerpt_length ) {
    $excerpt = wp_trim_words( $excerpt, $excerpt_length );
} ?>

<div class="overlay-title-excerpt-hover overlay-hide theme-overlay">

    <div class="overlay-title-excerpt-hover-inner clear">

        <div class="overlay-title-excerpt-hover-text clear">

            <h3 class="overlay-title-excerpt-hover-title">
                <?php the_title(); ?>
            </h3><!-- .overlay-title-excerpt-hover-title -->

            <?php if ( $excerpt ) : ?>

                <div class="overlay-title-excerpt-hover-excerpt">
                    <?php echo $excerpt; ?>
                </div><!-- .overlay-title-excerpt-hover-excerpt -->

            <?php endif; ?>

        </div><!-- .overlay-title-excerpt-hover-text -->

    </div><!-- .overlay-title-excerpt-hover-inner -->

</div><!-- .overlay-title-excerpt-hover -->