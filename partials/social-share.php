<?php
/**
 * Social Share Buttons Output
 *
 * @package Habitat Cambodia
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} 

// Get sharing sites
$sites = wpsp_social_share_sites();

// Return if there aren't any sites enabled
if ( empty( $sites ) ) {
	return;
} 

$position = wpsp_social_share_position();
$style    = wpsp_social_share_style();
$heading  = wpsp_social_share_heading();
$post_id  = get_the_ID();
$url      = apply_filters( 'wpsp_social_share_url', get_permalink( $post_id ) );
$title    = html_entity_decode( wpsp_get_esc_title() ); 

// Get and encode summary
$summary = wpsp_get_excerpt( array(
	'length'          => '40',
	'echo'            => false,
	'ignore_more_tag' => true,
) ); ?>

<div class="wpsp-social-share-wrap clear">

	<?php
	// Display heading if enabled
	if ( wpsp_get_redux( 'is-social-share-heading', true ) && 'horizontal' == $position ) : ?>
		<div class="theme-heading social-share-title">
			<span class="text"><?php echo wpsp_get_redux( 'social-share-heading' ); ?></span>
		</div>
	<?php endif; ?>

	<ul class="wpsp-social-share position-<?php echo esc_attr( $position ); ?> style-<?php echo esc_attr( $style ); ?> clear">
	<?php foreach ( $sites as $key => $value ) : ?>
		<?php // Twitter
		if ( 'twitter' == $key && $value == 1 ) {

			// Get SEO meta and use instead if they exist
			if ( defined( 'WPSEO_VERSION' ) ) {
				if ( $meta = get_post_meta( $post_id, '_yoast_wpseo_twitter-title', true ) ) {
					$title = $meta;
				}
				if ( $meta = get_post_meta( $post_id, '_yoast_wpseo_twitter-description', true ) ) {
					$title = $title .': '. $meta;
					$title = rawurlencode( $title );
				}
			}

			// Get twitter handle
			$handle = wpsp_get_redux( 'social-share-twitter-handle' ); ?>

			<li class="share-twitter">
				<a href="http://twitter.com/share?text=<?php echo rawurlencode( $title ); ?>&amp;url=<?php echo rawurlencode( esc_url( $url ) ); ?><?php if ( $handle ) echo '&amp;via='. esc_attr( $handle ); ?>" title="<?php esc_html_e( 'Share on Twitter', 'hfhcambodia' ); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
					<span class="fa fa-twitter"></span>
					<span class="social-share-button-text"><?php esc_html_e( 'Tweet', 'hfhcambodia' ); ?></span>
				</a>
			</li>

		<?php }
		// Facebook
		elseif ( 'facebook' == $key && $value == 1 ) { ?>

			<li class="share-facebook">
				<a href="http://www.facebook.com/share.php?u=<?php echo rawurlencode( esc_url( $url ) ); ?>" title="<?php esc_html_e( 'Share on Facebook', 'hfhcambodia' ); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
					<span class="fa fa-facebook"></span>
					<span class="social-share-button-text"><?php esc_html_e( 'Share', 'hfhcambodia' ); ?></span>
				</a>
			</li>

		<?php }
			// Google+
			elseif ( 'google_plus' == $key && $value == 1 ) { ?>

				<li class="share-googleplus">
					<a href="https://plus.google.com/share?url=<?php echo rawurlencode( esc_url( $url ) ); ?>" title="<?php esc_html_e( 'Share on Google+', 'hfhcambodia' ); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
						<span class="fa fa-google-plus"></span>
						<span class="social-share-button-text"><?php esc_html_e( 'Plus one', 'hfhcambodia' ); ?></span>
					</a>
				</li>

			<?php }
			// Pinterest
			elseif ( 'pinterest' == $key && $value == 1 ) { ?>

				<li class="share-pinterest">
					<a href="https://www.pinterest.com/pin/create/button/?url=<?php echo rawurlencode( esc_url( $url ) ); ?>&amp;media=<?php echo wp_get_attachment_url( get_post_thumbnail_id( $post_id ) ); ?>&amp;description=<?php echo rawurlencode( $summary ); ?>" title="<?php esc_html_e( 'Share on Pinterest', 'hfhcambodia' ); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
						<span class="fa fa-pinterest"></span>
						<span class="social-share-button-text"><?php esc_html_e( 'Pin It', 'hfhcambodia' ); ?></span>
					</a>
				</li>

			<?php } ?>
	<?php $site_count++; endforeach; ?>
	</ul>
</div> <!-- .wpsp-social-share-wrap .clear -->
