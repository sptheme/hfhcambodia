<?php
/**
 * Blog single post video format media
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Habitat Cambodia
 */

// Get post video
$video = wpsp_get_post_video_html(); 

// Show featured image for password-protected post or if video isn't defined
if ( post_password_required() || ! $video ) {
    get_template_part( 'partials/blog/media/blog-single' );
    return;
} ?>

<div id="post-media" class="clr">
    <div id="blog-post-video">
        <?php printf( '<div class="blog-single-video">%s</div>',
				wpsp_get_post_video_html()
			); ?>
    </div><!-- #blog-post-video -->
</div><!-- #post-media -->