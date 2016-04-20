<?php
/**
 * Events widget
 *
 * Learn more: http://codex.wordpress.org/Widgets_API
 *
 * @package Habitat Cambodia
 * @subpackage Widgets
 */

// Prevent direct file access
if ( ! defined ( 'ABSPATH' ) ) {
	exit;
}

// Start widget class
if ( ! class_exists( 'WPSP_Events_Widget' ) ) {

	class WPSP_Events_Widget extends WP_Widget {
		
		/**
		 * Register widget with WordPress.
		 *
		 * @since 1.1.0
		 */
		public function __construct() {
			$branding = wpsp_get_theme_branding(false);
			$branding = $branding ? $branding . ' - ' : '';
			parent::__construct(
				'wpsp-event-widget',
	            $branding . esc_html__( 'Events', 'wpsp_widget' ),
	            $widget_ops = array(
	                'classname'         => 'wpsp-event-widget',
	            )
			);
			add_action( 'load-widgets.php', array( $this, 'scripts' ), 100 );
		}

		/**
		 * Enqueue media scripts
		 *
		 * @since 1.1.0
		 */
		public function scripts() {
			
		}

		/**
		 * Front-end display of widget.
		 *
		 * @see WP_Widget::widget()
		 * @since 1.1.0
		 *
		 *
		 * @param array $args     Widget arguments.
		 * @param array $instance Saved values from database.
		 */
		public function widget( $args, $instance ) {

			// Widget options
			$title       = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';
			$post_count = isset( $instance['post_count'] ) ? $instance['post_count'] : '';
			$tax_category = isset( $instance['tax_category'] ) ? $instance['tax_category'] : '';
			$tax_province = isset( $instance['tax_province'] ) ? $instance['tax_province'] : '';
			$tax_year = isset( $instance['tax_year'] ) ? $instance['tax_year'] : '';

			// Before widget hook
			echo $args['before_widget']; ?>

				<?php
				// Display widget title
				if ( $title ) {
					echo $args['before_title'] . $title . $args['after_title'];
				} ?>

				<div class="wpsp-event-countdown clear">

				</div><!-- .wpsp-event-countdown .clear -->

			<?php
			// After widget hook
			echo $args['after_widget'];
		}

		/**
		 * Sanitize widget form values as they are saved.
		 *
		 * @see WP_Widget::update()
		 * @since 1.1.0
		 *
		 * @param array $new_instance Values just sent to be saved.
		 * @param array $old_instance Previously saved values from database.
		 *
		 * @return array Updated safe values to be saved.
		 */
		public function update( $new_instance, $old_instance ) {
			$instance                	= $old_instance;
			$instance['title']       	= strip_tags( $new_instance['title'] );
			$instance['post_count']   = (int) $new_instance['post_count'];
			$instance['tax_category']   = strip_tags( $new_instance['tax_category'] );
			$instance['tax_province']   = strip_tags( $new_instance['tax_province'] );
			$instance['tax_year'] 		= strip_tags( $new_instance['tax_year'] );
			return $instance;
		}

		/**
		 * Back-end widget form.
		 *
		 * @see WP_Widget::form()
		 * @since 1.1.0
		 *
		 * @param array $instance Previously saved values from database.
		 */
		public function form( $instance ) {
			$instance = wp_parse_args( ( array ) $instance, array(
				'title'       => esc_html__( 'Latest Events', 'wpsp_widget' ),
				'post_count'  => '1',
				'tax_category'    => '',
				'tax_province'	  => '',
				'tax_year'	  	  => '',
			) );
			extract( $instance ); ?>
			
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'wpsp_widget' ); ?>:</label> 
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'post_count' ) ); ?>"><?php esc_html_e( 'Post number', 'wpsp_widget' ); ?>:</label> 
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'post_count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_count' ) ); ?>" type="number" value="<?php echo esc_attr( $title ); ?>" />
			</p>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>"><?php esc_html_e( 'Category', 'wpsp_widget' ); ?>:</label>
				<select id="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'category' ) ); ?>" class="widefat">
					<option><?php esc_html_e('Select term', 'wpsp_widget');?></option>
				<?php
                    $args = array( 
                    	'hide_empty' => 0,
                    );
                    $terms = get_terms( 'events_category', $args );
                    foreach ($terms as $term) {
                        $selected = $term->name == $instance['tax_category'] ? ' selected="selected"' : '';
                        echo '<option'.$selected.' value="'.$term->name.'">'.$term->name.'</option>';
                    }
                ?>
				</select>
			</p>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'Province' ) ); ?>"><?php esc_html_e( 'Category', 'wpsp_widget' ); ?>:</label>
				<select id="<?php echo esc_attr( $this->get_field_id( 'Province' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'Province' ) ); ?>" class="widefat">
					<option><?php esc_html_e('Select term', 'wpsp_widget');?></option>
				<?php
                    $args = array(
                      'hide_empty' => 0,
                    );
                    $terms = get_terms( 'events_province', $args );
                    foreach ($terms as $term) {
                        $selected = $term->name == $instance['tax_province'] ? ' selected="selected"' : '';
                        echo '<option'.$selected.' value="'.$term->name.'">'.$term->name.'</option>';
                    }
                ?>
				</select>
			</p>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'Year' ) ); ?>"><?php esc_html_e( 'Year', 'wpsp_widget' ); ?>:</label>
				<select id="<?php echo esc_attr( $this->get_field_id( 'Year' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'Year' ) ); ?>" class="widefat">
					<option><?php esc_html_e('Select term', 'wpsp_widget');?></option>
				<?php
                    $args = array(
                      'hide_empty' => 0,
                    );
                    $terms = get_terms( 'events_tag', $args );
                    foreach ($terms as $term) {
                        $selected = $term->name == $instance['tax_year'] ? ' selected="selected"' : '';
                        echo '<option'.$selected.' value="'.$term->name.'">'.$term->name.'</option>';
                    }
                ?>
				</select>
			</p>
			<script type="text/javascript">
				(function($) {
					"use strict";
					$( document ).ready( function() {
						
					} );
				} ) ( jQuery );
			</script>

			<?php
		}
	}
}
register_widget( 'WPSP_Events_Widget' );