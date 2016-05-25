<?php
/**
 * Template part for displaying career entry post.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Habitat Cambodia
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} 

$job_ann = get_post_meta( get_the_ID(), 'wpsp_job_announcement', true ); 
$job_desc = get_post_meta( get_the_ID(), 'wpsp_job_description', true );
$app_form = get_post_meta( get_the_ID(), 'wpsp_application_form', true );
$job_type = rwmb_meta( 'wpsp_career_type' );
$job_type_class = wpsp_career_type_class();
$job_location = rwmb_meta( 'wpsp_career_location' );
$job_expired = date("j M, Y", strtotime( get_post_meta( get_the_ID(), 'wpsp_career_expire', true ) ) ); ?>

<div class="wpsp-row clear">
	<div class="col span_3_of_4">
		<h3 id="career-entry-title" class="entry-title career-entry-title">
			<?php the_title(); ?>	
		</h3> <!-- .career-entry-title -->
	
		<div class="career-entry-meta wpsp-row clear">
			<div class="col span_1_of_3"><a href="<?php echo wp_get_attachment_url( $job_ann ); ?>" target="_blank"><?php echo esc_html__('Job announcement', 'hfhcambodia'); ?></a></div>
			<div class="col span_1_of_3"><a href="<?php echo wp_get_attachment_url( $job_desc ); ?>" target="_blank"><?php echo esc_html__('Job description', 'hfhcambodia'); ?></a></div>
			<div class="col span_1_of_3"><a href="<?php echo wp_get_attachment_url( $app_form ); ?>" target="_blank"><?php echo esc_html__('Application form', 'hfhcambodia'); ?></a></div>
		</div> <!-- .career-entry-meta -->
	</div> <!-- .span_3_of_4 -->

	<div class="col span_1_of_4">
		<div class="job-location"><i class="fa fa-map-marker"></i><?php echo esc_html( $job_location->name ); ?></div>
		<div class="job-type <?php echo $job_type_class; ?>"><?php echo wpsp_get_term_name_by_id ( $job_type->term_id, 'career_type' ); ?></div>
		<div class="closed-date">
			<span><?php echo esc_html__( 'Close Date', 'hfhcambodia' ); ?></span>
			<?php echo esc_html( $job_expired ); ?>
		</div> <!-- .closed-date -->
	</div> <!-- .span_1_of_4 -->
</div> <!-- .wpsp-row -->
