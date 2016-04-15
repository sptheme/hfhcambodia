<?php
/**
 * Blog single post standard format media
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
	<div id="post-media" class="clear">
	<?php if ( wpsp_get_redux( 'is-featured-image-lightbox' )  ) { ?>
		<a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" data-type="image">
			<?php wpsp_post_thumbnail_total( array(
			'size'   => 'thumb-landscape',
			'alt'    => wpsp_get_esc_title(),
		) ); ?>
		</a>
	<?php } else { ?>
		<?php wpsp_post_thumbnail_total( array(
			'size'   => 'thumb-landscape',
			'alt'    => wpsp_get_esc_title(),
		) ); ?>
	<?php }	 ?>
	</div> <!-- #post-media -->
<?php } // is featured image ?>

