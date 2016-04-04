<?php
/**
 * Call to Action Widget
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

if ( ! class_exists( 'WPSP_Call_To_Action_Widget' ) ) :
class WPSP_Call_To_Action_Widget extends WP_Widget {

	/**
     * Register widget with WordPress.
     *
     * @since 1.0.0
     */
    public function __construct() {
        $branding = wpsp_get_theme_branding(false);
        $branding = $branding ? $branding . ' - ' : '';
        parent::__construct(
            'wpsp-call-to-action-widget',
            $branding . esc_html__( 'Call to Action', 'wpsp_widget' ),
            $widget_ops = array(
                'classname'         => 'wpsp-call-to-action-widget',
                'description'   => __( 'A widget to display call-to-action block, relevant/important information about your company or product.', 'wpsp_widget' )
            )
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     * @since 1.0.0
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    function widget( $args, $instance ) {
        // Extract args
        extract( $args, EXTR_SKIP );

        $callout_content  = isset( $instance['callout_content'] ) ? $instance['callout_content'] : '';
        $button_name      = isset( $instance['button_name'] ) ? $instance['button_name'] : 'Get in Touch';
        $button_link      = isset( $instance['button_link'] ) ? $instance['button_link'] : '';
        $target            = isset( $instance['target'] ) ? $instance['target'] : 'blank';

        $target = 'blank' == $target ? ' target="_blank"' : '';

        echo $before_widget; ?>

       <div class="callout-wrap">
            <div class="container clear">
                <div class="callout-left callout-content"><?php  echo $callout_content; ?></div>
                <div class="callout-right callout-button"><a class="button yellow" href="<?php echo esc_url( $button_link ); ?>"<?php echo $target; ?>><?php echo esc_html( $button_name ); ?></a></div>
            </div> <!-- .container -->
        </div>

        <?php echo $after_widget;
        
        return $instance;
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @since 1.0.0
     *
     * @see WP_Widget::form()
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $instance['callout_content']    = ( ! empty( $new_instance['callout_content'] ) ) ? strip_tags( $new_instance['callout_content'] ) : '';
        $instance['button_name']        = ( ! empty( $new_instance['button_name'] ) ) ? strip_tags( $new_instance['button_name'] ) : 'Get in Touch';
        $instance['button_link']        = ( ! empty( $new_instance['button_link'] ) ) ? strip_tags( $new_instance['button_link'] ) : '';
        $instance['target']             = ( ! empty( $new_instance['target'] ) ) ? strip_tags( $new_instance['target'] ) : 'blank';
        
        return $instance;
    }	

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     * @since 1.0.0
     *
     * @param array $instance Previously saved values from database.
     */
    function form( $instance ) {
        //Set up some default widget settings.
       $instance = wp_parse_args( ( array ) $instance, array(
            'callout_content' => '', 
            'button_name' => esc_html__('Get in Touch', 'wpsp_widget'),
            'button_link' => '', 
            'target' => 'blank'
        ) ); ?>
        <p>
            <label for="<?php echo $this->get_field_id('callout_content'); ?>"><?php _e('Content:', 'wpsp_widget'); ?></label>
            <textarea class="widefat" id="<?php echo $this->get_field_id('callout_content'); ?>" name="<?php echo $this->get_field_name('callout_content'); ?>" row="5"><?php echo $instance['callout_content']; ?></textarea>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('button_name'); ?>"><?php _e('Button Name:', 'wpsp_widget'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('button_name'); ?>" name="<?php echo $this->get_field_name('button_name'); ?>" type="text" value="<?php echo esc_attr($instance['button_name']); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('button_link'); ?>"><?php _e('Link/Url:', 'wpsp_widget'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('button_link'); ?>" name="<?php echo $this->get_field_name('button_link'); ?>" type="text" value="<?php echo esc_attr($instance['button_link']); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('target'); ?>"><?php _e('Link Target:', 'wpsp_widget'); ?></label>
            <select class='wpsp-widget-select' name="<?php echo $this->get_field_name('target'); ?>" id="<?php echo $this->get_field_id('target'); ?>">
                <option value="blank" <?php selected( $instance['target'], 'blank' ) ?>><?php esc_html_e( 'Blank', 'wpsp_widget' ); ?></option>
                <option value="self" <?php selected( $instance['target'], 'self' ) ?>><?php esc_html_e( 'Self', 'wpsp_widget' ); ?></option>
            </select>
        </p>
<?php    
    }    
}
endif;

// Register widget with widgets init hook
if ( ! function_exists( 'register_wpsp_call_to_action_widget' ) ) :
function register_wpsp_call_to_action_widget() {
    register_widget( 'WPSP_Call_To_Action_Widget' );
}
endif;
add_action( 'widgets_init', 'register_wpsp_call_to_action_widget' );