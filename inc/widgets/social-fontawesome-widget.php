<?php
/**
 * Call to Action Widget
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

// Start class
if ( ! class_exists( 'WPSP_Fontawesome_Social_Widget' ) ) {
    class WPSP_Fontawesome_Social_Widget extends WP_Widget {
        private $social_services_array = array();

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
                'yelp' => array(
                    'name' => 'Yelp',
                    'url'  => '',
                ),
                'dribbble' => array(
                    'name' => 'Dribbble',
                    'url'  => '',
                ),
                'flickr' => array(
                    'name' => 'Flickr',
                    'url'  => '',
                ),
                'vk' => array(
                    'name' => 'VK',
                    'url'  => '',
                ),
                'github' => array(
                    'name' => 'GitHub',
                    'url'  => '',
                ),
                'tumblr' => array(
                    'name' => 'Tumblr',
                    'url'  => '',
                ),
                'skype' => array(
                    'name' => 'Skype',
                    'url'  => '',
                ),
                'trello' => array(
                    'name' => 'Trello',
                    'url'  => '',
                ),
                'foursquare' => array(
                    'name' => 'Foursquare',
                    'url'  => '',
                ),
                'renren' => array(
                    'name' => 'RenRen',
                    'url'  => '',
                ),
                'xing' => array(
                    'name' => 'Xing',
                    'url'  => '',
                ),
                'vimeo-square' => array(
                    'name' => 'Vimeo',
                    'url'  => '',
                ),
                'vine' => array(
                    'name' => 'Vine',
                    'url'  => '',
                ),
                'youtube' => array(
                    'name' => 'Youtube',
                    'url'  => '',
                ),
                'rss' => array(
                    'name' => 'RSS',
                    'url'  => '',
                ),
            ) );

            // Start up widget
            $branding = wpsp_get_theme_branding(false);
            $branding = $branding ? $branding . ' - ' : '';
            parent::__construct(
                'wpsp-fontawesome-social-widget',
                $branding . esc_html__( 'Font Awesome Social Widget', 'wpsp_widget' ),
                $widget_ops = array(
                    'classname'         => 'wpsp-fontawesome-social-widget clear',
                    'description'   => __( 'A widget to display Font Awesome Social Icon.', 'wpsp_widget' )
                )
            );

        }

        /**
         * Front-end display of widget.
         *
         * @see WP_Widget::widget()
         * @since 1.0.0
         *
         *
         * @param array $args Widget arguments.
         * @param array $instance Saved values from database.
         */
        public function widget( $args, $instance ) {

            // Get social services and 
            $social_services = isset( $instance['social_services'] ) ? $instance['social_services'] : '';

            // Return if no services defined
            if ( ! $social_services ) {
                return;
            }

            // Define vars
            $title         = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';
            $description   = isset( $instance['description'] ) ? $instance['description'] : '';
            $style         = isset( $instance['style'] ) ? $instance['style'] : '';
            $type          = isset( $instance['type'] ) ? $instance['type'] : '';
            $target        = isset( $instance['target'] ) ? $instance['target'] : '';
            $size          = isset( $instance['size'] ) ? intval( $instance['size'] ) : '';
            $font_size     = isset( $instance['font_size'] ) ? $instance['font_size'] : '';
            $border_radius = isset( $instance['border_radius'] ) ? $instance['border_radius'] : '';

            // Parse style
            $style = $this->parse_style( $style, $type ); // Fallback for OLD styles pre-3.0.0

            // Sanitize vars
            $size          = $size ? wpsp_sanitize_data( $size, 'px' ) : '';
            $font_size     = $font_size ? wpsp_sanitize_data( $font_size, 'font_size' ) : '';
            $border_radius = $border_radius ? wpsp_sanitize_data( $border_radius, 'border_radius' ) : '';
            $target        = 'blank' == $target ? ' target="_blank"' : '';

            // Wrapper style
            $ul_style = '';
            if ( $font_size ) {
                $ul_style .= ' style="font-size:'. esc_attr( $font_size ) .';"';
            }

            // Inline style
            $add_style = '';
            if ( $size ) {
                $add_style .= 'height:'. $size .';width:'. $size .';line-height:'. $size .';';
            }
            if ( $border_radius ) {
                $add_style .= 'border-radius:'. $border_radius .';';
            }
            if ( $add_style ) {
                $add_style = ' style="' . esc_attr( $add_style ) . '"';
            }

            // Before widget hook
            echo $args['before_widget'];

            // Display title
            if ( $title ) {
                echo $args['before_title'] . $title . $args['after_title'];
            } ?>

            <div class="wpsp-fa-social-widget clearfix">
                <?php               
                // Description
                if ( $description ) : ?>
                    <div class="desc clearfix">
                        <?php echo wpsp_sanitize_data( $description, 'html' ); ?>
                    </div><!-- .desc -->
                <?php endif; ?>
                <ul<?php echo $ul_style; ?>>
                    <?php
                    // Original Array
                    $social_services_array = $this->social_services_array;

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
                                <a href="'. esc_url( $link ) .'" title="'. esc_attr( $name ) .'" class="wpsp-'. esc_attr( $key ) .' '. wpsp_get_social_button_class( $style ) .'"'. $add_style . $target . $nofollow .'><span class="fa fa-'. esc_attr( $icon ) .'"></span>
                                </a>
                            </li>';
                        }
                    } ?>
                </ul>
            </div><!-- .fontawesome-social-widget -->

            <?php
            // After widget hook
            echo $args['after_widget']; ?>

        <?php
        }

        /**
         * Parses style attribute for fallback styles
         *
         * @since 3.0.0
         */
        public function parse_style( $style = '', $type = '' ) {
            if ( 'color' == $style && 'flat' == $type ) {
                return 'flat-color';
            }
            if ( 'color' == $style && 'graphical' == $type ) {
                return 'graphical-rounded';
            }
            if ( 'black' == $style && 'flat' == $type ) {
                return 'black-rounded';
            }
            if ( 'black' == $style && 'graphical' == $type ) {
                return 'black-rounded';
            }
            if ( 'black-color-hover' == $style && 'flat' == $type ) {
                return 'black-ch-rounded';
            }
            if ( 'black-color-hover' == $style && 'graphical' == $type ) {
                return 'black-ch-rounded';
            }
            return $style;
        }

        /**
         * Sanitize widget form values as they are saved.
         *
         * @see WP_Widget::update()
         * @since 1.0.0
         *
         * @param array $new_instance Values just sent to be saved.
         * @param array $old_instance Previously saved values from database.
         *
         * @return array Updated safe values to be saved.
         */
        public function update( $new_instance, $old_instance ) {

            // Sanitize data
            $instance = $old_instance;
            $instance['title']           = ! empty( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : null;
            $instance['description']     = ! empty( $new_instance['description'] ) ? $new_instance['description'] : null;
            $instance['style']           = ! empty( $new_instance['style'] ) ? strip_tags( $new_instance['style'] ) : 'flat-color';
            $instance['target']          = ! empty( $new_instance['target'] ) ? strip_tags( $new_instance['target'] ) : 'blank';
            $instance['size']            = ! empty( $new_instance['size'] ) ? strip_tags( $new_instance['size'] ) : '';
            $instance['border_radius']   = ! empty( $new_instance['border_radius'] ) ? strip_tags( $new_instance['border_radius'] ) : '';
            $instance['font_size']       = ! empty( $new_instance['font_size'] ) ? strip_tags( $new_instance['font_size'] ) : '';
            $instance['social_services'] = $new_instance['social_services'];

            // Remove deprecated param
            $instance['type'] = null;

            // Return instance
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
        public function form( $instance ) {

            $instance = wp_parse_args( ( array ) $instance, array(
                'title'           => esc_attr__( 'Follow Us', 'wpsp_widget' ),
                'description'     => '',
                'style'           => 'flat-color',
                'type'            => '',
                'font_size'       => '',
                'border_radius'   => '',
                'target'          => 'blank',
                'size'            => '',
                'social_services' => $this->social_services_array
            ) ); ?>
            
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'wpsp_widget' ); ?>:</label> 
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"><?php esc_html_e( 'Description','wpsp_widget' ); ?>:</label>
                <textarea class="widefat" rows="5" cols="20" id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>"><?php echo wpsp_sanitize_data( $instance['description'], 'html' ); ?></textarea>
            </p>

            <?php
            // Styles
            $social_styles = apply_filters( 'wpsp_social_button_styles', array(
                                ''                   => esc_html__( 'Skin Default', 'wpsp_widget' ),
                                'minimal'            => esc_html_x( 'Minimal', 'Social Button Style', 'wpsp_widget' ),
                                'none'               => esc_html__( 'None', 'wpsp_widget' ),
                                'flat'               => esc_html_x( 'Flat', 'Social Button Style', 'wpsp_widget' ),
                                'flat-color'         => esc_html_x( 'Flat Color', 'Social Button Style', 'wpsp_widget' ),
                            ) );;

            // Parse style
            $style = $this->parse_style( $instance['style'], $instance['type'] ); ?>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'style' ) ); ?>"><?php esc_html_e( 'Style', 'wpsp_widget' ); ?>:</label>
                <br />
                <select class="wpsp-widget-select" name="<?php echo esc_attr( $this->get_field_name( 'style' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'style' ) ); ?>">
                    <?php foreach ( $social_styles as $key => $val ) { ?>
                        <option value="<?php echo esc_attr( $key ); ?>" <?php selected( $style, $key ) ?>><?php echo strip_tags( $val ); ?></option>
                    <?php } ?>
                </select>
            </p>
            
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>"><?php esc_html_e( 'Link Target', 'wpsp_widget' ); ?>:</label>
                <br />
                <select class="wpsp-widget-select" name="<?php echo esc_attr( $this->get_field_name( 'target' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>">
                    <option value="blank" <?php selected( $instance['target'], 'blank' ) ?>><?php esc_html_e( 'Blank', 'wpsp_widget' ); ?></option>
                    <option value="self" <?php selected( $instance['target'], 'select' ) ?>><?php esc_html_e( 'Self', 'wpsp_widget' ); ?></option>
                </select>
            </p>
            
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>"><?php esc_html_e( 'Dimensions', 'wpsp_widget' ); ?>:</label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'size' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['size'] ); ?>" />
                <small><?php esc_html_e( 'Example:', 'wpsp_widget' ); ?> 40px</small>
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'font_size' ) ); ?>"><?php esc_html_e( 'Font Size', 'wpsp_widget' ); ?>:</label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'font_size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'font_size' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['font_size'] ); ?>" />
                <small><?php esc_html_e( 'Example:', 'wpsp_widget' ); ?> 18px</small>
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'border_radius' ) ); ?>"><?php esc_html_e( 'Border Radius', 'wpsp_widget' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'border_radius' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'border_radius' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['border_radius'] ); ?>" />
                <small><?php esc_html_e( 'Example:', 'wpsp_widget' ); ?> 4px</small>
            </p>

            <?php
            $field_id_services   = $this->get_field_id( 'social_services' );
            $field_name_services = $this->get_field_name( 'social_services' ); ?>
            <h3 style="margin-top:20px;margin-bottom:0;"><?php esc_html_e( 'Social Links','wpsp_widget' ); ?></h3>
            <ul id="<?php echo esc_attr( $field_id_services ); ?>" class="wpsp-social-widget-services-list">
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
}

// Register the widget
if ( ! function_exists( 'register_wpsp_fontawesome_social_widget' ) ) {
    function register_wpsp_fontawesome_social_widget() {
        register_widget( 'WPSP_Fontawesome_Social_Widget' );
    }
}
add_action( 'widgets_init', 'register_wpsp_fontawesome_social_widget' );

// Widget Styles
if ( ! function_exists( 'wpsp_social_widget_style' ) ) {
    function wpsp_social_widget_style() { ?>
        <style>
        .wpsp-social-widget-services-list { padding-top: 10px; }
        .wpsp-social-widget-services-list li { cursor: move; background: #fafafa; padding: 10px; border: 1px solid #e5e5e5; margin-bottom: 10px; }
        .wpsp-social-widget-services-list li p { margin: 0 }
        .wpsp-social-widget-services-list li label { margin-bottom: 3px; display: block; color: #222; }
        .wpsp-social-widget-services-list li label span.fa { margin-right: 10px }
        .wpsp-social-widget-services-list .placeholder { border: 1px dashed #e3e3e3 }
        .wpsp-widget-select { width: 100% }
        </style>
    <?php
    }
}

// Widget AJAX functions
function wpsp_fontawesome_social_widget_scripts() {
    global $pagenow;
    if ( is_admin() && $pagenow == "widgets.php" ) {
        add_action( 'admin_head', 'wpsp_social_widget_style' );
        add_action( 'admin_footer', 'add_new_wpsp_fontawesome_social_ajax_trigger' );
        function add_new_wpsp_fontawesome_social_ajax_trigger() { ?>
            <script type="text/javascript" >
                jQuery(document).ready(function($) {
                    jQuery(document).ajaxSuccess(function(e, xhr, settings) {
                        var widget_id_base = 'wpsp-fontawesome-social-widget';
                        if ( settings.data.search( 'action=save-widget' ) != -1 && settings.data.search( 'id_base=' + widget_id_base) != -1 ) {
                            wpspSortServices();
                        }
                    } );
                    function wpspSortServices() {
                        jQuery( '.wpsp-social-widget-services-list' ).each( function() {
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
add_action( 'admin_init', 'wpsp_fontawesome_social_widget_scripts' );