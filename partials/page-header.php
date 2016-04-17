<?php
/**
 * Template part for displaying page header.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Habitat Cambodia
 */

$images = rwmb_meta( 'wpsp_masthead_image', array( 'type' => 'image_advanced' ) ); 
$subheadline = get_post_meta( get_the_ID(), 'wpsp_sub_headline', true );
$button_text = get_post_meta( get_the_ID(), 'wpsp_masthead_button_text', true );
$button_link = get_post_meta( get_the_ID(), 'wpsp_masthead_button_link', true );
if ( $images )	{
	foreach ($images as $image ) {
		$masthead_image = $image['full_url'];
	}
}
?>

<div class="page-header page-header-background-image" style="background-image:url(<?php echo $masthead_image; ?>);">
	<div class="page-header-inner">
		<div class="container clearfix">
			<header class="page-header-wrap">
				<h1 class="page-header-title"><?php the_title(); ?></h1>
				<?php echo $subheadline ?>
				<a href="<?php echo esc_url( $button_link ); ?>" class="button"><?php echo esc_html( $button_text ); ?></a>
			</header>
		</div>
	</div> <!-- .page-header-inner -->
	<span class="page-header-overlay"></span>
</div> <!-- #page-header -->
