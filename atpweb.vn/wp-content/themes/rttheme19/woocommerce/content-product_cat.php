<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product_cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.1
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $woocommerce_loop,$woo_cat_counter, $new_row;


if( is_tax() || is_shop() ){
	$term 			= get_queried_object();
	$parent_id 		= empty( $term->term_id ) ? 0 : $term->term_id;

	$product_categories = get_categories( apply_filters( 'woocommerce_product_subcategories_args', array(
		'parent'       => $parent_id,
		'menu_order'   => 'ASC',
		'hide_empty'   => 0,
		'hierarchical' => 1,
		'taxonomy'     => 'product_cat',
		'pad_counts'   => 1,
		'hide_empty'   => 1
	) ) );

	$woo_cat_counter = count($product_categories);  
}
 

/*
*	add rt class namems
*/
$rt_extra_class = $woocommerce_loop['loop'] < $woocommerce_loop['columns'] ? "first-row" : "";
$rt_extra_class .= " col ".  rt_column_class( $woocommerce_loop['columns'] ) ; 

?>
<?php
	if ( $woocommerce_loop['loop'] % $woocommerce_loop['columns'] == 0 && $woocommerce_loop['loop'] > 0 && $woocommerce_loop['loop'] > $woocommerce_loop['columns'] -1 && ! $new_row ){
		$new_row = true;
		echo '<div class="row clearfix">';
	}
?>

<div <?php wc_product_cat_class("$rt_extra_class product-category product", $category );?>>
	<div class="product_item_holder">
		<?php
		/**
		 * woocommerce_before_subcategory hook.
		 *
		 * @hooked woocommerce_template_loop_category_link_open - 10
		 */
		do_action( 'woocommerce_before_subcategory', $category );

		/**
		 * woocommerce_before_subcategory_title hook.
		 *
		 * @hooked woocommerce_subcategory_thumbnail - 10
		 */
		do_action( 'woocommerce_before_subcategory_title', $category );

		/**
		 * woocommerce_shop_loop_subcategory_title hook.
		 *
		 * @hooked woocommerce_template_loop_category_title - 10
		 */
		do_action( 'woocommerce_shop_loop_subcategory_title', $category );

		/**
		 * woocommerce_after_subcategory_title hook.
		 */
		do_action( 'woocommerce_after_subcategory_title', $category );

		/**
		 * woocommerce_after_subcategory hook.
		 *
		 * @hooked woocommerce_template_loop_category_link_close - 10
		 */
		do_action( 'woocommerce_after_subcategory', $category ); ?>

	</div>
</div>

<?php
	if ( $woocommerce_loop['loop'] % $woocommerce_loop['columns'] == 0 && $new_row ){		
		echo '</div><!-- / end .row -->';
		$new_row = false;
	} 
?>