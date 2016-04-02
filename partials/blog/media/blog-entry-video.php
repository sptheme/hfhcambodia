<?php
/**
 * Blog entry post standard format media
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Habitat Cambodia
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} 

// Display videos
if ( wpsp_get_redux('blog-entry-video-output', true)  ) : ?>
	<?php
	// Get post video
	$video = wpsp_get_post_video_html(); ?>

	<?php
	// Display video if one exists and it's not a password protected post
	if ( $video && ! post_password_required() ) : ?>

		<div class="blog-entry-media entry-media clear">

			<div class="blog-entry-video">

				<?php echo $video; ?>

			</div><!-- .blog-entry-video -->

		</div><!-- .blog-entry-media -->

	<?php
	// Else display post thumbnail
	else : ?>

		<?php get_template_part( 'partials/blog/media/blog-entry' ); ?>

	<?php endif; ?>
<?php
// Do not display videos
else : ?>

	<?php get_template_part( 'partials/blog/media/blog-entry' ); ?>

<?php endif; ?>

