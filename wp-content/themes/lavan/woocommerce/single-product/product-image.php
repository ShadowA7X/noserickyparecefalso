<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $woocommerce, $product;

?>
<div class="single-product-image">
	<?php if ( $product->is_on_sale() ) : ?>
	<?php echo apply_filters( 'woocommerce_sale_flash', '	<span class="onsale"><span class="label-sale">' . __( 'Sale!', 'woocommerce' ) . '</span></span>', $post, $product ); ?>

<?php endif; ?>
<div class="images">
	<?php
		if ( has_post_thumbnail() ) {

			$image_title = esc_attr( get_the_title( get_post_thumbnail_id() ) );
			$image_link  = wp_get_attachment_url( get_post_thumbnail_id() );
			$image       = get_the_post_thumbnail( $post->ID, apply_filters( 'kaya-gallery', 'kaya-gallery' ), array(
				'title' => $image_title,
				) );

			$attachment_count = count( $product->get_gallery_attachment_ids() );

			if ( $attachment_count > 0 ) {
				$gallery = '[product-gallery]';
			} else {  
				$gallery = '';
			}
			$position ="position:'inside'";
			if($image){
			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image cloud-zoom zoom " rel="'.$position.', showTitle:false,adjustX:0,adjustY:0, smoothMove:5,zoomWidth:1000" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a>', $image_link, $image_title, $image ), $post->ID );
		}else{
			$default_img = get_template_directory_uri().'/images/woocommerce_default_img.jpg';
			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', $default_img ), $post->ID );
		}
		} else {
			$default_img = get_template_directory_uri().'/images/woocommerce_default_img.jpg';
			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', 
				$default_img ), $post->ID );
		}
	?>
<?php do_action( 'woocommerce_product_thumbnails' ); ?>
</div>
</div>