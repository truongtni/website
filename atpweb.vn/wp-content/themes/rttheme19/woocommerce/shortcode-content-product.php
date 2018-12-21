<?php
# 
# rt-theme
# loop item for woocommerce products
#
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
<div <?php post_class("product_item_holder"); ?>>
 
		<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

			<?php
				/**
				 * woocommerce_before_shop_loop_item_title hook
				 *
				 * @hooked woocommerce_show_product_loop_sale_flash - 10
				 * @hooked woocommerce_template_loop_product_thumbnail - 10
				 */
				do_action( 'woocommerce_before_shop_loop_item_title' );
			?>

			<div class="product_info">
				<h5 class="clean_heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>

				<?php
					/**
					 * woocommerce_after_shop_loop_item_title hook 
					 */
					do_action( 'woocommerce_after_shop_loop_item_title' );
				?>

				<div class="product_info_footer clearfix">
				<?php
					/**
					 * rt_product_info_footer hook
					 *
					 * @hooked rt_product_info_footer - 10
					 */
					do_action( 'rt_product_info_footer' );
				?>
				</div>

			</div> 
		<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>

</div>