<?php
/**
 * Event entry content
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WPSP_Blog
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
} ?>

<div class="events-entry-excerpt clear">

    <?php
    // Check if the post tag is using the "more" tag
    if ( $check_more_tag && strpos( get_the_content(), 'more-link' ) ) :

        // Display the content up to the more tag
        the_content( '', '&hellip;' );

    // Otherwise display custom excerpt
    else :

        // Display custom excerpt
        wpsp_excerpt( array(
            'length' => wpsp_excerpt_length(),
        ) );

    endif; ?>

</div><!-- .blog-entry-excerpt -->