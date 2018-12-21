<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ){
	exit; // Exit if accessed directly
}

global $post, $woocommerce, $product, $layout;
?>

<div class="images woo_product_images">
<?php 

if ( has_post_thumbnail() ) { 	

	$attachment_ids = array_merge( array( get_post_thumbnail_id() ), $product->get_gallery_image_ids() ); 
	$attachment_count = count( $product->get_gallery_image_ids() );  
						
	/**
	 * call the product slider 
	 */

	//carousel atts
	$carousel_atts = array(  
		"id"  => $post->ID."-product-image-carosel", 
		"item_width"  => 1, 
		"class" => "product-image-carosel",
		"nav" => "true",
		"dots" => "false"
	);

	echo rt_create_image_carousel( apply_filters("rt_woo_single_product_carousel", array("rt_gallery_images" => $attachment_ids, "column_width" => $layout["content_width"] == "1/1" ? "6/12": $layout["content_width"] , "carousel_atts" => $carousel_atts, "w" => "", "h" => "" ) )) ;


}

?>  
</div>