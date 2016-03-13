<?php
/**
 * Custom Taxonomy Menu Widget
 *
 * List post thumbnail formath by category
 * Learn more: http://codex.wordpress.org/Widgets_API
 *
 *
 * @package Discover Travel
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'WPSP_Custom_Taxonomy_Menu_Widget' ) ) :
class WPSP_Custom_Taxonomy_Menu_Widget extends WP_Widget {

	/**
     * Register widget with WordPress.
     *
     * @since 1.0.0
     */
    public function __construct() {
        // Start up widget
        $branding = wpsp_get_theme_branding(false);
        $branding = $branding ? $branding . ' - ' : '';
        parent::__construct(
            'widget-tax-nav-menu',
            $branding . esc_html__( 'Menu nav by term', 'wpsp_widget' ),
            $widget_ops = array(
                'classname'         => 'widget-tax-nav-menu widget_nav_menu',
                'description'   => __( 'Simple menu of custom taxonomies and their associated terms.', 'wpsp_widget' )
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

        $tax_name           = $instance['tax_name'];
        $show_post_count    = $instance['show_post_count'];
        $is_icon            = $instance['is_icon'];
        $hide_empty         = $instance['hide_empty'];

        $title = apply_filters('widget_title', $instance['title'] );

        echo $before_widget;

        if ( $title )
            echo $before_title . $title . $after_title;

        // We're good to go, let's build the menu
        $args = array(
            'hide_empty' => $hide_empty,
            );
             
        $terms = get_terms( $tax_name, $args );
        
        if ( $is_icon ) {
            $body_widget = "\n" . '<ul>' . "\n";
        } else {
            $body_widget = "\n" . '<ul>' . "\n";
        }    
        
        foreach ($terms as $term) {
            $body_widget .= '<li><a href="' . get_term_link( $term ) . '" title="' . $term->name . '">';
            
            if ( $is_icon ) {
                $body_widget .= '<span class="sprite ' . get_option( 'tour_style_'.$term->term_id.'_icon', '' ) . '"></span>';
            }
            
            $body_widget .=  $term->name;
            
            if ( $show_post_count ) {
                $body_widget .=  '&nbsp;(' . $term->count . ')';    
            }
            
            $body_widget .= '</a></li>';
        }

                        
        $body_widget .= "\n" . '</ul>' . "\n";

        echo $body_widget;

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
 
        //Strip tags from title and name to remove HTML
        $instance['title'] = strip_tags( $new_instance['title'] );  
        $instance['tax_name'] = strip_tags( $new_instance['tax_name'] );
        $instance['show_post_count'] = (int) $new_instance['show_post_count'];
        $instance['is_icon'] = (int) $new_instance['is_icon'];
        $instance['hide_empty'] = (int) $new_instance['hide_empty'];

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
            'title' => __('Custom taxonomy menu', 'wpsp_widget'), 
            'tax_name' => '', 
            'show_post_count' => '',
            'is_icon' => '',
            'hide_empty' => '' );
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'wpsp_widget'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']) ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('tax_name'); ?>">
            <strong><?php _e('Select taxonomy:', 'wpsp_widget'); ?></strong><br>
            <small><?php _e('choose which custom taxonomies and terms you want to include in your menu.', 'wpsp_widget'); ?></small>
            </label>
            <select class="widefat" id="<?php echo $this->get_field_id('tax_name'); ?>" name="<?php echo $this->get_field_name('tax_name'); ?>">
                <?php
                    $args = array(
                      'public'   => true,
                      '_builtin' => false
                      
                    ); 
                    $output = 'objects'; // or names
                    $operator = 'and'; // 'and' or 'or'
                    $custom_taxonomies = get_taxonomies( $args, $output, $operator );
                    foreach ($custom_taxonomies as $taxonomy) {
                        $selected = $taxonomy->name == $instance['tax_name'] ? ' selected="selected"' : '';
                        echo '<option'.$selected.' value="'.$taxonomy->name.'">'.$taxonomy->label.'</option>';
                    }
                ?>
            </select>
        </p>
        <p>
            <input id="<?php echo $this->get_field_id('show_post_count'); ?>" name="<?php echo $this->get_field_name('show_post_count'); ?>" type="checkbox" value="1" <?php if ($instance['show_post_count']) echo 'checked="checked"'; ?>/>
            <label for="<?php echo $this->get_field_id('show_post_count'); ?>"><?php _e('Show post counts?', 'wpsp_widget'); ?></label>
        </p>
        <p>
            <input id="<?php echo $this->get_field_id('is_icon'); ?>" name="<?php echo $this->get_field_name('is_icon'); ?>" type="checkbox" value="1" <?php if ($instance['is_icon']) echo 'checked="checked"'; ?>/>
            <label for="<?php echo $this->get_field_id('is_icon'); ?>"><?php _e('Show icon?', 'wpsp_widget'); ?></label>
        </p>
        <p>
            <input id="<?php echo $this->get_field_id('hide_empty'); ?>" name="<?php echo $this->get_field_name('hide_empty'); ?>" type="checkbox" value="1" <?php if ($instance['hide_empty']) echo 'checked="checked"'; ?>/>
            <label for="<?php echo $this->get_field_id('hide_empty'); ?>"><?php _e('Hide empty?', 'wpsp_widget'); ?></label>
        </p>
<?php    
    }    
}
endif;

// Register widget with widgets init hook
if ( ! function_exists( 'register_wpsp_custom_taxonomy_menu_widget' ) ) :
function register_wpsp_custom_taxonomy_menu_widget() {
    register_widget( 'WPSP_Custom_Taxonomy_Menu_Widget' );
}
endif;
add_action( 'widgets_init', 'register_wpsp_custom_taxonomy_menu_widget' );