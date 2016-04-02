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
<?php if ( wpsp_get_redux( 'is-featured-image' )  ) { ?>
	<div class="blog-entry-media entry-media clear wpsp-image-hover opacity overlay-parent">
		<a href="<?php the_permalink(); ?>" title="<?php wpsp_esc_title(); ?>" rel="bookmark" class="related-post-thumb">
			<?php wpsp_get_post_thumbnail('thumb-landscape'); ?>
			<span class="overlay-plus-hover overlay-hide theme-overlay"></span>
		</a>
	</div> <!-- #post-media -->
<?php } // is featured image ?>

