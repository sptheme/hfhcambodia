<?php
/**
 * Quick Contact Widget
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

if ( ! class_exists( 'WPSP_Quick_Contact_Widget' ) ) :
class WPSP_Quick_Contact_Widget extends WP_Widget {

	/**
     * Register widget with WordPress.
     *
     * @since 1.0.0
     */
    public function __construct() {

        // Declare social services array
            $this->social_services_array = apply_filters( 'wpsp_social_widget_profiles', array(
                'twitter' => array(
                    'name' => 'Twitter',
                    'url'  => '',
                ),
                'facebook' => array(
                    'name' => 'Facebook',
                    'url'  => '',
                ),
                'instagram' => array(
                    'name' => 'Instagram',
                    'url'  => '',
                ),
                'google-plus' => array(
                    'name' => 'GooglePlus',
                    'url'  => '',
                ),
                'linkedin' => array(
                    'name' => 'LinkedIn',
                    'url'  => '',
                ),
                'pinterest' => array(
                    'name' => 'Pinterest',
                    'url'  => '',
                ),
                'youtube' => array(
                    'name' => 'Youtube',
                    'url'  => '',
                ),
            ) );

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
        $social_headline  = $instance['social_headline'];
        $social_services  = isset( $instance['social_services'] ) ? $instance['social_services'] : '';
    

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

        echo $out; ?>

        <ul class="wpsp-fa-social">
            <li><?php echo esc_html( $social_headline ); ?></li>
            <?php
            // Original Array
            $social_services_array = $this->social_services_array;
            $target = ' target="_blank"';

            // Loop through each item in the array
            foreach( $social_services as $key => $val ) {
                $link     = ! empty( $social_services[$key]['url'] ) ? $social_services[$key]['url'] : null;
                $name     = $social_services_array[$key]['name'];
                $nofollow = isset( $social_services_array[$key]['nofollow'] ) ? ' rel="nofollow"' : '';
                if ( $link ) {
                    $key  = 'vimeo-square' == $key ? 'vimeo' : $key;
                    $icon = 'youtube' == $key ? 'youtube-play' : $key;
                    $icon = 'bloglovin' == $key ? 'heart' : $icon;
                    $icon = 'vimeo-square' == $key ? 'vimeo' : $icon;
                    echo '<li>
                        <a href="'. esc_url( $link ) .'" title="'. esc_attr( $name ) .'" class="wpsp-'. esc_attr( $key ) .' flat-color"'. $target . $nofollow .'><span class="fa fa-'. esc_attr( $icon ) .'"></span>
                        </a>
                    </li>';
                }
            } ?>
        </ul>

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
 
        $instance['title'] = sanitize_text_field($new_instance['title']);  
        $instance['address'] = strip_tags( $new_instance['address']);
        $instance['telephone'] = strip_tags( $new_instance['telephone'] );
        $instance['fax'] = strip_tags( $new_instance['fax'] );
        $instance['email'] = strip_tags( $new_instance['email'] );
        $instance['social_headline'] = $new_instance['social_headline'];
        $instance['social_services'] = $new_instance['social_services'];

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
            'email' => 'info@mydomain.com',
            'social_headline' => 'Keep connected: ',
            'social_services' => $this->social_services_array
        );
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
        $field_id_services   = $this->get_field_id( 'social_services' );
        $field_name_services = $this->get_field_name( 'social_services' ); ?>
        <h3 style="margin-top:20px;margin-bottom:0;"><?php esc_html_e( 'Social Links','wpsp_widget' ); ?></h3>
        <p>
            <label for="<?php echo $this->get_field_id('social_headline'); ?>"><?php _e('Headline:', 'wpsp_widget'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('social_headline'); ?>" name="<?php echo $this->get_field_name('social_headline'); ?>" type="text" value="<?php echo esc_attr($instance['social_headline']) ?>" />
        </p>
        <ul id="<?php echo esc_attr( $field_id_services ); ?>" class="wpsp-social-services-list">
            <input type="hidden" id="<?php echo esc_attr( $field_name_services ); ?>" value="<?php echo esc_attr( $field_name_services ); ?>">
            <input type="hidden" id="<?php echo esc_attr( wp_create_nonce( 'wpsp_fontawesome_social_widget_nonce' ) ); ?>">
            <?php
            // Social array
            $social_services_array = $this->social_services_array;
            // Get current services display
            $display_services = isset ( $instance['social_services'] ) ? $instance['social_services']: '';
            // Loop through social services to display inputs
            foreach( $display_services as $key => $val ) {
                $url  = ! empty( $display_services[$key]['url'] ) ? esc_url( $display_services[$key]['url'] ) : null;
                $name = $social_services_array[$key]['name'];
                // Set icon
                $icon = 'vimeo-square' == $key ? 'vimeo' : $key;
                $icon = 'youtube' == $key ? 'youtube-play' : $icon;
                $icon = 'vimeo-square' == $key ? 'vimeo' : $icon; ?>
                <li id="<?php echo esc_attr( $field_id_services ); ?>_0<?php echo esc_attr( $key ); ?>">
                    <p>
                        <label for="<?php echo esc_attr( $field_id_services ); ?>-<?php echo esc_attr( $key ); ?>-name"><span class="fa fa-<?php echo esc_attr( $icon ); ?>"></span><?php echo strip_tags( $name ); ?>:</label>
                        <input type="hidden" id="<?php echo esc_attr( $field_id_services ); ?>-<?php echo esc_attr( $key ); ?>-url" name="<?php echo esc_attr( $field_name_services .'['.$key.'][name]' ); ?>" value="<?php echo esc_attr( $name ); ?>">
                        <input type="url" class="widefat" id="<?php echo esc_attr( $field_id_services ); ?>-<?php echo esc_attr( $key ); ?>-url" name="<?php echo esc_attr( $field_name_services .'['.$key.'][url]' ); ?>" value="<?php echo esc_attr( $url ); ?>" />
                    </p>
                </li>
            <?php } ?>
        </ul>
        
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

// Widget Styles
if ( ! function_exists( 'wpsp_social_style' ) ) {
    function wpsp_social_style() { ?>
        <style>
        .wpsp-social-services-list { padding-top: 10px; }
        .wpsp-social-services-list li { cursor: move; background: #fafafa; padding: 10px; border: 1px solid #e5e5e5; margin-bottom: 10px; }
        .wpsp-social-services-list li p { margin: 0 }
        .wpsp-social-services-list li label { margin-bottom: 3px; display: block; color: #222; }
        .wpsp-social-services-list li label span.fa { margin-right: 10px }
        .wpsp-social-services-list .placeholder { border: 1px dashed #e3e3e3 }
        .wpsp-widget-select { width: 100% }
        </style>
    <?php
    }
}

// Widget AJAX functions
function wpsp_fontawesome_social_scripts() {
    global $pagenow;
    if ( is_admin() && $pagenow == "widgets.php" ) {
        add_action( 'admin_head', 'wpsp_social_style' );
        add_action( 'admin_footer', 'add_new_wpsp_social_ajax_trigger' );
        function add_new_wpsp_social_ajax_trigger() { ?>
            <script type="text/javascript" >
                jQuery(document).ready(function($) {
                    jQuery(document).ajaxSuccess(function(e, xhr, settings) {
                        var widget_id_base = 'wpsp-quick-contact-widget';
                        if ( settings.data.search( 'action=save-widget' ) != -1 && settings.data.search( 'id_base=' + widget_id_base) != -1 ) {
                            wpspSortServices();
                        }
                    } );
                    function wpspSortServices() {
                        jQuery( '.wpsp-social-services-list' ).each( function() {
                            var id = jQuery(this).attr( 'id' );
                            $( '#'+ id ).sortable( {
                                placeholder : "placeholder",
                                opacity     : 0.6
                            } );
                        } );
                    }
                    wpspSortServices();
                } );
            </script>
        <?php
        }
    }
}
add_action( 'admin_init', 'wpsp_fontawesome_social_scripts' );