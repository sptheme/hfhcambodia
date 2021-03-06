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

?>

<div class="blog-entry-media entry-media clear wpsp-image-hover opacity overlay-parent">
	<a href="<?php the_permalink(); ?>" title="<?php wpsp_esc_title(); ?>" rel="bookmark" class="related-post-thumb">
		<?php wpsp_post_thumbnail_total( array(
			'size'   => 'thumb-landscape',
			'alt'    => wpsp_get_esc_title(),
		) ); ?>
		<span class="overlay-plus-hover overlay-hide theme-overlay"></span>
	</a>
</div> <!-- #post-media -->

