<?php
/**
 * Hover Button Overlay
 *
 * @package Habitat Cambodia
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Only used for outside_link position
if ( 'outside_link' != $position ) {
    return;
}

// Lightbox
$lightbox_link = ! empty( $args['lightbox_link'] ) ? $args['lightbox_link'] : '';
$lightbox_data = ! empty( $args['lightbox_data'] ) ? $args['lightbox_data'] : '';
$lightbox_data = ( is_array( $lightbox_data ) ) ? implode( ' ', $lightbox_data ) : $lightbox_data;

// Define link
$link = $lightbox_link ? $lightbox_link : wpsp_get_permalink();
$link = ! empty( $args['overlay_link'] ) ? $args['overlay_link'] : $link;
$link = apply_filters( 'wpsp_hover_button_overlay_link', $link );

// Define text
$text = ! empty( $args['overlay_button_text'] ) ? $args['overlay_button_text'] : _x( 'View Post', 'Overlay Button Text', 'hfhcambodia' );
$text = ( 'post_title' == $text ) ? get_the_title() : $text;
$text = apply_filters( 'wpsp_hover_button_overlay_text', $text );

// Define link target
$target = '';
if ( isset( $args['link_target'] ) ) {
    if ( 'blank' == $args['link_target'] || '_blank' == $args['link_target'] ) {
        $target = 'blank';
    }
}
$target = apply_filters( 'wpsp_button_overlay_target', $target );
$target = 'blank' == $target ? ' target="_blank"' : ''; ?>

<div class="overlay-hover-button overlay-hide theme-overlay">
    <div class="overlay-hover-button-inner clear">
        <div class="overlay-hover-button-text clear">
            <a href="<?php echo $link; ?>" class="overlay-hover-button-link theme-button minimal-border white<?php if ( $lightbox_link ) echo ' wpex-lightbox'; ?>" title="<?php echo esc_attr( $text ); ?>"<?php echo $target; ?><?php echo $lightbox_data; ?>>
                <?php echo $text; ?>
            </a><!-- .overlay-hover-button-title -->
        </div><!-- .overlay-hover-button-text -->
    </div><!-- .overlay-hover-button-inner -->
</div><!-- .overlay-hover-button -->