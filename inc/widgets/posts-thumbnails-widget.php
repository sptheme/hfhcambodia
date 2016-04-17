<?php
/**
 * Recent posts with Thumbnails custom widget
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
class WPSP_Recent_Posts_Thumbnails_Widget extends WP_Widget {
	private $defaults;

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		$branding = wpsp_get_theme_branding(false);
		$branding = $branding ? $branding . ' - ' : '';
		parent::__construct(
			'wpsp-recent-posts-thumb',
            $branding . esc_html__( 'Posts With Thumbnails', 'wpsp_widget' ),
            $widget_ops = array(
                'classname'         => 'wpsp-recent-posts-thumb',
            )
		);

		$this->defaults = array(
			'title'      => esc_html__( 'Recent Posts', 'wpsp_widget' ),
			'number'     => '3',
			'style'      => 'default',
			'post_type'  => 'post',
			'taxonomy'   => '',
			'terms'      => '',
			'order'      => 'DESC',
			'orderby'    => 'date',
			'columns'    => '3',
			'img_size'   => 'wpsp_custom',
			'img_hover'  => '',
			'img_width'  => '',
			'img_height' => '',
			'date'       => '',
		);

	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {

		// Parse instance
		extract( wp_parse_args( $instance, $this->defaults ) );

		// Apply filters to the title
		$title = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';

		// Before widget WP hook
		echo $args['before_widget'];

		// Display title if defined
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title']; 
		} ?>

		<ul class="wpsp-widget-recent-posts clear style-<?php echo esc_attr( $style ); ?>">

			<?php
			// Query args
			$query_args = array(
				'post_type'      => $post_type,
				'posts_per_page' => $number,
				'meta_key'       => '_thumbnail_id',
				'no_found_rows'  => true,
			);

			// Order params - needs FALLBACK don't ever edit!
			if ( ! empty( $orderby ) ) {
				$query_args['order']   = $order;
				$query_args['orderby'] = $orderby;
			} else {
				$query_args['orderby'] = $order; // THIS IS THE FALLBACK
			}

			// Taxonomy args
			if ( ! empty( $taxonomy ) && ! empty( $terms ) ) {

				// Sanitize terms and convert to array
				$terms = str_replace( ', ', ',', $terms );
				$terms = explode( ',', $terms );

				// Add to query arg
				$query_args['tax_query']  = array(
					array(
						'taxonomy' => $taxonomy,
						'field'    => 'slug',
						'terms'    => $terms,
					),
				);

			}

			// Exclude current post
			if ( is_singular() ) {
				$query_args['post__not_in'] = array( get_the_ID() );
			}

			// Query posts
			$wpsp_query = new WP_Query( $query_args );

			// If there are posts loop through them
			if ( $wpsp_query->have_posts() ) :

				// Loop through posts
				while ( $wpsp_query->have_posts() ) : $wpsp_query->the_post(); ?>

					<?php
					// Get hover classes
					if ( $img_hover ) {
						$hover_classes = ' '. wpsp_image_hover_classes( $img_hover );
					} else {
						$hover_classes = '';
					} ?>

					<li class="wpsp-widget-recent-posts-li clear">
						<a href="<?php wpsp_permalink(); ?>" title="<?php wpsp_esc_title(); ?>" class="wpsp-widget-recent-posts-thumbnail<?php echo esc_attr( $hover_classes ); ?>">
							<?php wpsp_post_thumbnail_total( array(
								'size'   => $img_size,
								'width'  => $img_width,
								'height' => $img_height,
								'alt'    => wpsp_get_esc_title(),
							) ); ?>
						</a>
						<a href="<?php wpsp_permalink(); ?>" title="<?php wpsp_esc_title(); ?>" class="wpsp-widget-recent-posts-title"><?php the_title(); ?></a>

						<?php
						// Display date if enabled
						if ( '1' != $date ) : ?>

							<div class="wpsp-widget-recent-posts-date">
								<?php echo get_the_date(); ?>
							</div><!-- .wpsp-widget-recent-posts-date -->

						<?php endif; ?>

					</li><!-- .wpsp-widget-recent-posts-li -->

				<?php endwhile; ?>

			<?php endif; ?>

		</ul><!-- .wpsp-widget-recent-posts -->

		<?php wp_reset_postdata(); ?>
		
		<?php
		// After widget WordPress hook
		echo $args['after_widget'];
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance               = $old_instance;
		$instance['title']      = ! empty( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['post_type']  = ! empty( $new_instance['post_type'] ) ? strip_tags( $new_instance['post_type'] ) : '';
		$instance['taxonomy']   = ! empty( $new_instance['taxonomy'] ) ? strip_tags( $new_instance['taxonomy'] ) : '';
		$instance['terms']      = ! empty( $new_instance['terms'] ) ? strip_tags( $new_instance['terms'] ) : '';
		$instance['number']     = ! empty( $new_instance['number'] ) ? strip_tags( $new_instance['number'] ) : '';
		$instance['order']      = ! empty( $new_instance['order'] ) ? strip_tags( $new_instance['order'] ) : '';
		$instance['orderby']    = ! empty( $new_instance['orderby'] ) ? strip_tags( $new_instance['orderby'] ) : '';
		$instance['style']      = ! empty( $new_instance['style'] ) ? strip_tags( $new_instance['style'] ) : '';
		$instance['img_hover']  = ! empty( $new_instance['img_hover'] ) ? strip_tags( $new_instance['img_hover'] ) : '';
		$instance['img_size']   = ! empty( $new_instance['img_size'] ) ? strip_tags( $new_instance['img_size'] ) : 'wpsp_custom';
		$instance['img_height'] = ! empty( $new_instance['img_height'] ) ? intval( $new_instance['img_height'] ) : '';
		$instance['img_width']  = ! empty( $new_instance['img_width'] ) ? intval( $new_instance['img_width'] ) : '';
		$instance['date']       = isset( $new_instance['date'] ) ? true : false;
		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

		extract( wp_parse_args( ( array ) $instance, $this->defaults ) ); ?>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'wpsp_widget' ); ?></label> 
			<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'style' ) ); ?>"><?php esc_html_e( 'Style', 'wpsp_widget' ); ?></label>
			<br />
			<select class='wpsp-select' name="<?php echo esc_attr( $this->get_field_name( 'style' ) ); ?>">
				<option value="default" <?php selected( $style, 'default' ); ?>><?php esc_html_e( 'Small Image', 'wpsp_widget' ); ?></option>
				<option value="fullimg" <?php selected( $style, 'fullimg' ); ?>><?php esc_html_e( 'Full Image', 'wpsp_widget' ); ?></option>
			</select>
		</p>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'post_type' ) ); ?>"><?php esc_html_e( 'Post Type', 'wpsp_widget' ); ?></label>
		<br />
		<select class='wpsp-select' name="<?php echo esc_attr( $this->get_field_name( 'post_type' ) ); ?>" style="width:100%;">
			<option value="post" <?php selected( $post_type, 'post' ); ?>><?php esc_html_e( 'Post', 'wpsp_widget' ); ?></option>
			<?php
			// Get Post Types
			$args = array(
				'public'              => true,
				'_builtin'            => false,
				'exclude_from_search' => false,
			);
			$output   = 'names';
			$operator = 'and';
			$get_post_types = get_post_types( $args, $output, $operator );
			if ( ! isset( $get_post_types['portfolio'] ) && WPsp_PORTFOLIO_IS_ACTIVE ) {
				$obj = get_post_type_object( 'portfolio' );
				$get_post_types['portfolio'] = $obj->labels->name;
			}
			if ( ! isset( $get_post_types['staff'] ) && WPsp_STAFF_IS_ACTIVE ) {
				$obj = get_post_type_object( 'staff' );
				$get_post_types['staff'] = $obj->labels->name;
			}
			if ( ! isset( $get_post_types['testimonials'] ) && WPsp_TESTIMONIALS_IS_ACTIVE ) {
				$obj = get_post_type_object( 'testimonials' );
				$get_post_types['testimonials'] = $obj->labels->name;
			}
			foreach ( $get_post_types as $get_post_type ) : ?>
				<?php if ( $get_post_type != 'post' ) { ?>
					<option value="<?php echo esc_attr( $get_post_type ); ?>" <?php selected( $post_type, $get_post_type ); ?>><?php echo ucfirst( $get_post_type ); ?></option>
				<?php } ?>
			<?php endforeach; ?>
		</select>
		</p>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'taxonomy' ) ); ?>"><?php esc_html_e( 'Query By Taxonomy', 'wpsp_widget' ); ?></label>
		<br />
		<select class='wpsp-select' name="<?php echo esc_attr( $this->get_field_name( 'taxonomy' ) ); ?>" style="width:100%;">
			<option value="" <?php if ( ! $taxonomy ) { ?>selected="selected"<?php } ?>><?php esc_html_e( 'No', 'wpsp_widget' ); ?></option>
			<?php
			// Get Taxonomies
			$get_taxonomies = get_taxonomies( array(
				'public' => true,
			), 'objects' ); ?>
			<?php foreach ( $get_taxonomies as $get_taxonomy ) : ?>
				<option value="<?php echo esc_attr( $get_taxonomy->name ); ?>" <?php selected( $taxonomy, $get_taxonomy->name ); ?>><?php echo ucfirst( $get_taxonomy->labels->singular_name ); ?></option>
			<?php endforeach; ?>
		</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'terms' ) ); ?>"><?php esc_html_e( 'Terms', 'wpsp_widget' ); ?></label>
			<br />
			<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'terms' ) ); ?>" type="text" value="<?php echo esc_attr( $terms ); ?>" />
			<small><?php esc_html_e( 'Enter the term slugs to query by seperated by a "comma"', 'wpsp_widget' ); ?></small>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>"><?php esc_html_e( 'Order', 'wpsp_widget' ); ?></label>
			<br />
			<select class='wpsp-select' name="<?php echo esc_attr( $this->get_field_name( 'order' ) ); ?>">
				<option value="DESC" <?php selected( $order, 'DESC', true ); ?>><?php esc_html_e( 'Descending', 'wpsp_widget' ); ?></option>
				<option value="ASC" <?php selected( $order, 'ASC', true ); ?>><?php esc_html_e( 'Ascending', 'wpsp_widget' ); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>"><?php esc_html_e( 'Order By', 'wpsp_widget' ); ?>:</label>
			<br />
			<select class='wpsp-select' name="<?php echo esc_attr( $this->get_field_name( 'orderby' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>">
			<?php
			// Orderby options
			$orderby_array = array (
				'date'          => esc_html__( 'Date', 'wpsp_widget' ),
				'title'         => esc_html__( 'Title', 'wpsp_widget' ),
				'modified'      => esc_html__( 'Modified', 'wpsp_widget' ),
				'author'        => esc_html__( 'Author', 'wpsp_widget' ),
				'rand'          => esc_html__( 'Random', 'wpsp_widget' ),
				'comment_count' => esc_html__( 'Comment Count', 'wpsp_widget' ),
			);
			foreach ( $orderby_array as $key => $value ) { ?>
				<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $orderby, $key ); ?>>
					<?php echo strip_tags( $value ); ?>
				</option>
			<?php } ?>
			</select>
		</p>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number', 'wpsp_widget' ); ?></label> 
			<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'img_hover' ) ); ?>"><?php esc_html_e( 'Image Hover', 'wpsp_widget' ); ?></label>
			<br />
			<select class='wpsp-select' name="<?php echo esc_attr( $this->get_field_name( 'img_hover' ) ); ?>" style="width:100%;">
				<?php
				// Get image sizes
				$hovers = wpsp_image_hovers();
				// Loop through hovers and add options
				foreach ( $hovers as $key => $val ) { ?>
					<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $img_hover, $key ); ?>>
						<?php echo strip_tags( $val ); ?>
					</option>
				<?php } ?>
				
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'img_size' ) ); ?>"><?php esc_html_e( 'Image Size', 'wpsp_widget' ); ?></label>
			<br />
			<select class='wpsp-select' name="<?php echo esc_attr( $this->get_field_name( 'img_size' ) ); ?>" style="width:100%;">
			<option value="wpsp_custom" <?php selected( $img_size, 'wpsp_custom' ); ?>><?php esc_html_e( 'Custom', 'wpsp_widget' ); ?></option>
				<?php
				// Get image sizes
				$get_img_sizes = wpsp_get_thumbnail_sizes();
				// Loop through image sizes
				foreach ( $get_img_sizes as $key => $val ) { ?>
					<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $img_size, $key ); ?>><?php echo strip_tags( $key ); ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'img_width' ) ); ?>"><?php esc_html_e( 'Image Crop Width', 'wpsp_widget' ); ?></label> 
			<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'img_width' ) ); ?>" type="text" value="<?php echo esc_attr( $img_width ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'img_height' ) ); ?>"><?php esc_html_e( 'Image Crop Height', 'wpsp_widget' ); ?></label> 
			<input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'img_height' ) ); ?>" type="text" value="<?php echo esc_attr( $img_height ); ?>" />
		</p>
		<p>
			<input name="<?php echo esc_attr( $this->get_field_name( 'date' ) ); ?>" type="checkbox" value="1" <?php checked( $date, '1', true ); ?> />
			<label for="<?php echo esc_attr( $this->get_field_id( 'date' ) ); ?>"><?php esc_html_e( 'Disable Date?', 'wpsp_widget' ); ?></label>
		</p>

	<?php
	}

}

// Register the widget
function wpsp_register_recent_posts_thumb_widget() {
	register_widget( 'WPSP_Recent_Posts_Thumbnails_Widget' );
}
add_action( 'widgets_init', 'wpsp_register_recent_posts_thumb_widget' ); ?>