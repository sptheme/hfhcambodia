<?php
/**
 * Template Name: What We Build
 *
 * This is the template that displays landing what we build page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Habitat Cambodia
 */

get_header(); ?>

	<?php // Loop page
	while ( have_posts() ) : the_post(); ?>

		<section class="build-highlight">
			<div class="container">
			<?php the_content(); ?>
			</div>
		</section> <!-- .build-highlight -->

		<section class="callout-boxes">
			<div class="container wpsp-row clear">
				<div class="col span_1_of_3">
					<div class="callout-box">
						<?php $images = rwmb_meta( 'wpsp_callout_image_1', array( 'type' => 'image_advanced' ) );
						if ( $images )	{
							foreach ($images as $image ) { ?>
								<img src="<?php echo $image['full_url']; ?>">
						<?php }
						}?>
						<div class="callout-box-content">
							<h3><?php echo rwmb_meta('wpsp_callout_title_1'); ?></h3>
							<p><?php echo rwmb_meta('wpsp_callout_desc_1'); ?></p>
							<a href="<?php echo rwmb_meta('wpsp_callout_button_link_1'); ?>" class="button"><?php echo rwmb_meta('wpsp_callout_button_text_1'); ?></a>
						</div>
					</div> <!-- .callout-box -->
				</div> <!-- .col .span_1_of_3 -->

				<div class="col span_1_of_3">
					<div class="callout-box">
						<?php $images = rwmb_meta( 'wpsp_callout_image_2', array( 'type' => 'image_advanced' ) );
						if ( $images )	{
							foreach ($images as $image ) { ?>
								<img src="<?php echo $image['full_url']; ?>">
						<?php }
						}?>
						<div class="callout-box-content">
							<h3><?php echo rwmb_meta('wpsp_callout_title_2'); ?></h3>
							<p><?php echo rwmb_meta('wpsp_callout_desc_2'); ?></p>
							<a href="<?php echo rwmb_meta('wpsp_callout_button_link_2'); ?>" class="button"><?php echo rwmb_meta('wpsp_callout_button_text_1'); ?></a>
						</div>
					</div> <!-- .callout-box -->
				</div> <!-- .col .span_1_of_3 -->

				<div class="col span_1_of_3">
					<div class="callout-box">
						<?php $images = rwmb_meta( 'wpsp_callout_image_3', array( 'type' => 'image_advanced' ) );
						if ( $images )	{
							foreach ($images as $image ) { ?>
								<img src="<?php echo $image['full_url']; ?>">
						<?php }
						}?>
						<div class="callout-box-content">
							<h3><?php echo rwmb_meta('wpsp_callout_title_3'); ?></h3>
							<p><?php echo rwmb_meta('wpsp_callout_desc_3'); ?></p>
							<a href="<?php echo rwmb_meta('wpsp_callout_button_link_3'); ?>" class="button"><?php echo rwmb_meta('wpsp_callout_button_text_1'); ?></a>
						</div>
					</div> <!-- .callout-box -->
				</div> <!-- .col .span_1_of_3 -->
			</div>
		</section> <!-- .callout-boxes -->

	<?php endwhile; // End of the loop page. ?>

<?php get_footer(); ?>