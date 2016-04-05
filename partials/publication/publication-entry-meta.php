<?php
/**
 * Entry publcation meta
 *
 * @package Habitat Cambodia
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php $file_en = get_post_meta( get_the_ID(), 'wpsp_pub_file_en', true ); 
	$file_kh = get_post_meta( get_the_ID(), 'wpsp_pub_file_kh', true ); 
	$file_size_en = size_format( filesize( get_attached_file( $file_en ) ) );
	$file_size_kh = size_format( filesize( get_attached_file( $file_kh ) ) ); ?>
 
    <div class="publication-entry-meta">
    	<ul class="file-info">
    <?php // get term publication tags
    	$terms = get_the_terms( get_the_ID(), 'publications_tag' );                        
		if ( $terms && ! is_wp_error( $terms ) ) : 
		 
		    $publications_tags = array();
		    foreach ( $terms as $term ) {
		        $publications_tags[] = $term->name;
		    }                
	    	$publications_tags = join( ", ", $publications_tags ); ?>
	    	
	    	<li><?php printf( esc_html__( 'Published: %s', 'learninginstitute' ), esc_html( $publications_tags ) ); ?></li>
	    	
    <?php endif; ?>
    	</ul> <!-- .file-info -->

    	<ul class="file-download">
    		<li><?php esc_html_e( 'Download: ', 'learninginstitute' ); ?></li>
    		<?php if ( !empty($file_en) ) : ?>
    		<li><a href="<?php echo wp_get_attachment_url( $file_en ); ?>" target="_blank"><?php esc_html_e( 'English', 'learninginstitute' ); ?></a><?php printf( __( '<small> (Size: %s)</small>', 'learninginstitute' ), esc_html( $file_size_en ) ); ?></li>
    		<?php endif; ?>	
    		<?php if ( !empty($file_kh) ) : ?>
    		<li><?php echo ( !empty($file_en) ) ? ' - ' : ''; ?><a href="<?php echo wp_get_attachment_url( $file_kh ); ?>" target="_blank"><?php esc_html_e( 'Khmer', 'learninginstitute' ); ?></a><?php printf( __( '<small> (Size: %s)</small>', 'learninginstitute' ), esc_html( $file_size_kh ) ); ?></li>
    		<?php endif; ?>	
    	</ul>
    </div>
