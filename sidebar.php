<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Habitat Cambodia
 */
?>

<?php 
	$choice_sidebar = wpsp_sidebar_primary();
	$choice_layout = wpsp_layout_class();
?>
<?php if ( $choice_layout != 'col-1c'): 

	if ( ! is_active_sidebar( $choice_sidebar ) ) {
		return;
	}
?>
	<div id="secondary" class="widget-area" role="complementary">
		<?php dynamic_sidebar($choice_sidebar); ?>
	</div><!-- #secondary -->

<?php endif;?>
