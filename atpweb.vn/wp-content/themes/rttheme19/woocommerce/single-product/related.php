<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
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

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $woo_product_layout;
$woo_product_layout = ($woo_product_layout = get_theme_mod(RT_THEMESLUG."_woo_related_product_layout")) ? $woo_product_layout : 3;
$item_width = rt_column_count($woo_product_layout);

if ( $related_products ) : ?>

	<div class="related products margin-t40">
  
		<div class="rt_heading_wrapper style-3">
			<h6 class="rt_heading style-3"><?php esc_html_e( 'Related Products', 'woocommerce' ) ?></h6>
		</div> 
 

		<?php woocommerce_product_loop_start(); ?>

			<?php foreach ( $related_products as $related_product ) : ?>

				<?php
				 	$post_object = get_post( $related_product->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object );

					ob_start();

					wc_get_template_part( 'content', 'product-carousel' );

					$output[] .=  ob_get_contents();
					ob_end_clean();

					?>

			<?php endforeach; ?>

		<?php woocommerce_product_loop_end(); ?>

		<?php
			//carousel atts
			$atts = array(  
				"id"  => "woocommerce-related-carousel", 
				"item_width"  => intval($item_width), 
				"class" => "wc-product-carousel woocommerce",
				"nav" => "true",
				"dots" => "false",
			);

			//create carousel 
			echo rt_create_carousel( $output, $atts );
		?>
	</div>

<?php endif;

wp_reset_postdata();