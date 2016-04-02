<?php
/**
 * Blog single post gallery format media
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Habitat Cambodia
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} 

$photos_meta = rwmb_meta( 'wpsp_format_gallery_album', array('type' => 'image_advanced', 'size' => 'thumb-landscape') );
$photo_col = wpsp_get_redux('post-gallery-format-cols');
// Add Standard Classes
$classes   = array();
$classes[] = 'col';
$classes[] = wpsp_grid_class( $photo_col );
?>

<div id="post-media" class="clear">
	<div class="gallery wpsp-row clearfix">
	<?php foreach ( $photos_meta as $photo ) : ?>
		<div class="<?php echo implode(' ', $classes); ?>">
			<div class="blog-entry-media entry-media wpsp-image-hover grow overlay-parent">
				<a href="<?php echo $photo['full_url'];?>" rel="bookmark" title="<?php echo $photo['title'];?>">
					<img src="<?php echo $photo['url'];?>">
					<span class="overlay-plus-hover overlay-hide theme-overlay"></span>
				</a>
			</div>
		</div>
	<?php endforeach; ?>
	</div>
</div> <!-- #post-media -->

