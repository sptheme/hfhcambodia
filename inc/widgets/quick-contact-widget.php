<?php
/**
 * Quick Contact Widget
 *
 * Short contact information
 * Learn more: http://codex.wordpress.org/Widgets_API
 *
 *
 * @package Learning_Institute
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'WPSP_Quick_Contact_Widget' ) ) :
class WPSP_Quick_Contact_Widget extends WP_Widget {

	/**
     * Register widget with WordPress.
     *
     * @since 1.0.0
     */
    public function __construct() {
        $branding = wpsp_get_theme_branding(false);
        $branding = $branding ? $branding . ' - ' : '';
        parent::__construct(
            'wpsp-quick-contact-widget',
            $branding . esc_html__( 'Business Info', 'wpsp_widget' ),
            $widget_ops = array(
                'classname'         => 'wpsp-quick-contact-widget',
                'description'   => __( 'A widget to display short contact information.', 'wpsp_widget' )
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

        $address          = $instance['address'];
        $telephone        = $instance['telephone'];
        $fax              = $instance['fax'];
        $email            = $instance['email'];
    

        $title = apply_filters('widget_title', empty($instance['title'] ) ? __('Office address:', 'wpsp') : $instance['title'], $instance, $this->id_base);

        echo $before_widget;

        echo $before_title.$title.$after_title;

        // We're good to go, let's build the menu
        $out = '<ul class="quick-contact">';
        $out .= '<li class="address"><span>' . $address . '</span></li>';
        $out .= '<li class="telephone">' . $telephone . '</li>';
        $out .= '<li class="fax">' . $fax . '</li>';
        $out .= '<li class="email"><a href="mailto:' . antispambot( $email ) . '">' . antispambot( $email ) . '</a></li>';
        $out .= '</ul>';

        echo $out;

        echo $after_widget;
        
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
 
        $instance['title'] = sanitize_text_field($new_instance['title']);  
        $instance['address'] = strip_tags( $new_instance['address']);
        $instance['telephone'] = strip_tags( $new_instance['telephone'] );
        $instance['fax'] = strip_tags( $new_instance['fax'] );
        $instance['email'] = strip_tags( $new_instance['email'] );

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
        $defaults = array( 
            'title' => esc_html__('Office address: ', 'wpsp_widget'), 
            'address' => '#170, street 450, Toul Tompoung II, Chamcar Morn, Phnom Penh',
            'telephone' => '+855 (0)23 997 840', 
            'fax' => '+855 (0)23 997 840',
            'email' => 'info@mydomain.com' );
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'wpsp_widget'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']) ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('address'); ?>"><?php _e('Address:', 'wpsp_widget'); ?></label>
            <textarea class="widefat" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" row="3"><?php echo esc_attr($instance['address']) ?></textarea>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('telephone'); ?>"><?php _e('Telephone:', 'wpsp_widget'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('telephone'); ?>" name="<?php echo $this->get_field_name('telephone'); ?>" type="text" value="<?php echo esc_attr($instance['telephone']) ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('fax'); ?>"><?php _e('Fax:', 'wpsp_widget'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('fax'); ?>" name="<?php echo $this->get_field_name('fax'); ?>" type="text" value="<?php echo esc_attr($instance['fax']) ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('E-mail:', 'wpsp_widget'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo esc_attr($instance['email']) ?>" />
        </p>
<?php    
    }    
}
endif;

// Register widget with widgets init hook
if ( ! function_exists( 'register_wpsp_quick_contact_widget' ) ) :
function register_wpsp_quick_contact_widget() {
    register_widget( 'WPSP_Quick_Contact_Widget' );
}
endif;
add_action( 'widgets_init', 'register_wpsp_quick_contact_widget' );