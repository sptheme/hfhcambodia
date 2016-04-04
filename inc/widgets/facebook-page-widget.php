<?php
/**
 * Facebook Page Widget
 *
 * Short contact information
 * Learn more: http://codex.wordpress.org/Widgets_API
 *
 *
 * @package Habitat Cambodia
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start class
class WPSP_Facebook_Page_Widget extends WP_Widget {
	
	/**
	 * Register widget with WordPress.
	 *
	 * @since 1.1.0
	 */
	public function __construct() {
		$branding = wpsp_get_theme_branding(false);
		$branding = $branding ? $branding . ' - ' : '';
		parent::__construct(
			'wpsp-facebook-page-widget',
			$branding . esc_html__( 'Facebook Page', 'wpsp_widget' ),
			$widget_ops = array(
                'classname'         => 'wpsp-facebook-page-widget',
                'description'   => __( 'A widget to display facebook page.', 'wpsp_widget' )
            )
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 * @since 3.2.0
	 *
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {

		// Set vars for widget usage
		$title        	= isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';
		$facebook_url 	= isset( $instance['facebook_url'] ) ? $instance['facebook_url'] : '';
		$height 		= isset( $instance['height'] ) ? $instance['height'] : '';

		// Before widget WP hook
		echo $args['before_widget'];

		// Display title if defined
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>

		<?php
		// Show nothing in customizer to keep it fast
		if ( function_exists( 'is_customize_preview' ) && is_customize_preview() ) :

			esc_html_e( 'Facebook widget does not display in the Customizer because it can slow things down.', 'wpsp_widget' );

		elseif ( $facebook_url ) : ?>

			<div class="fb-page" data-href="<?php echo esc_url( $facebook_url ); ?>" data-tabs="timeline" data-height="<?php echo $height; ?>" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"></div>
			
			<div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.async=true; js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>

		<?php endif; ?>

		<?php
		// After widget WP hook
		echo $args['after_widget']; ?>
		
	<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 * @since 3.2.0
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance                 	= $old_instance;
		$instance['title']        	= ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['facebook_url'] 	= ( ! empty( $new_instance['facebook_url'] ) ) ? esc_url( $new_instance['facebook_url'] ) : '';
		$instance['height'] 		= ( ! empty( $new_instance['height'] ) ) ? (int) $new_instance['height'] : '';
		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 * @since 3.2.0
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

		extract( wp_parse_args( ( array ) $instance, array(
			'title'        => esc_html__( 'Find Us On Facebook', 'wpsp_widget' ),
			'facebook_url' => '',
			'height' => '',
		) ) ); ?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'wpsp_widget' ); ?></label>
			<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'facebook_url' ) ); ?>"><?php esc_html_e( 'Facebook Page URL', 'wpsp_widget' ); ?></label>
			<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'facebook_url' ) ); ?>" type="text" value="<?php echo esc_attr( $facebook_url ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'height' ) ); ?>"><?php esc_html_e( 'Height', 'wpsp_widget' ); ?></label>
			<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'height' ) ); ?>" type="text" value="<?php echo esc_html( $height ); ?>" placeholder="The pixel height of the embed (Min. 70)" />
		</p>
		
	<?php
	}
}

// Register the widget
function wpsp_register_facebook_page_widget() {
	register_widget( 'WPSP_Facebook_Page_Widget' );
}
add_action( 'widgets_init', 'wpsp_register_facebook_page_widget' );