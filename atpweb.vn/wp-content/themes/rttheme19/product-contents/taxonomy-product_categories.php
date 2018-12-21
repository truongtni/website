<?php
/* 
* rt-theme product categories
*/
get_header();

$term = get_queried_object();
$term_id = $term->term_id;
$description = isset($term->description) ? $term->description : ""; 
$hide_current_category_desc = get_theme_mod(RT_THEMESLUG.'_hide_current_category_desc');

$tax_meta = get_option( "taxonomy_$term_id" );
$cat_image_id = is_array( $tax_meta ) && isset( $tax_meta["product_category_image"] ) && ! empty( $tax_meta["product_category_image"] ) ? $tax_meta["product_category_image"] : "";

if( $cat_image_id ){
	$get_cat_image = wp_get_attachment_image_src( $cat_image_id, "thumbnail" );
	$cat_image_url = is_array( $get_cat_image ) ? $get_cat_image[0] : "";
}

?>

		<?php if( $description && $hide_current_category_desc != "true" ):?>
			<!-- Category Description -->
			<div class="tax-description clearfix <?php echo isset( $cat_image_url ) ? 'with-cat-image' : ""; ?>"> 
				<?php echo isset( $cat_image_url ) ? '<img src="'. $cat_image_url .'" class="product-category-thumbnail">' : ""; ?> 
				<?php echo apply_filters('the_content',($term->description));?> 
			</div> 
			<div class="rt_divider style-5"></div>
		<?php endif;?>		


		<?php
		//show subcategories	 
		$category_display = get_theme_mod(RT_THEMESLUG."_category_display");
		$term_childrens = get_term_children( $term_id, $rt_taxonomy );

		if( $category_display == "both" || $category_display == "categories_only" ):
		?>

			<?php

				$sub_categories_layout_style   = get_theme_mod( RT_THEMESLUG .'_product_category_layout_style' ) == "masonry" ? "masonry" : "grid" ;
				$sub_categories_item_width     = get_theme_mod( RT_THEMESLUG .'_product_category_layout' );
				$sub_categories_list_orderby   = get_theme_mod( RT_THEMESLUG .'_product_category_list_orderby' );
				$sub_categories_list_order     = get_theme_mod( RT_THEMESLUG .'_product_category_list_order' );
				$product_category_show_names   = get_theme_mod( RT_THEMESLUG .'_product_category_show_names' ) == "false" ? "false" : "true";
				$product_category_show_desc    = get_theme_mod( RT_THEMESLUG .'_product_category_show_desc' ) == "false" ? "false" : "true";
				$product_category_show_thumbs  = get_theme_mod( RT_THEMESLUG .'_product_category_show_thumbs' ) == "false" ? "false" : "true";
				$product_category_image_crop   = get_theme_mod( RT_THEMESLUG .'_product_category_crop' ) == "false" ? "false" : "true";
				$product_category_image_height = get_theme_mod( RT_THEMESLUG .'_product_category_image_height' );		

				if( is_array( $term_childrens ) && ! empty( $term_childrens ) ):
			?> 
				<?php

					$create_category_shortcode = sprintf( 
						'[rt_product_categories id="product-category-list" layout_style="%s" list_layout="%s" parent="%s" orderby="%s" order="%s" display_descriptions="%s" display_titles="%s" display_thumbnails="%s" image_max_height="%s" crop="%s"]', 
						$sub_categories_layout_style, $sub_categories_item_width, $term_id, $sub_categories_list_orderby, $sub_categories_list_order, $product_category_show_desc, $product_category_show_names, $product_category_show_thumbs, $product_category_image_height, $product_category_image_crop
					);

					echo do_shortcode( $create_category_shortcode );
				?>			

				<?php if ( $category_display != "categories_only" ) : ?><div class="rt_divider style-5"></div><?php endif; ?>

			<?php endif; ?>
		<?php endif; ?>


		<?php if ( $category_display == "" || $category_display == "both" || $category_display == "products_only" || ( is_array( $term_childrens ) && empty( $term_childrens ) ) ) : ?>
			<?php 
				if ( have_posts() ){
					do_action( "rt_product_post_loop", $wp_query);
				}else{				
					get_template_part( 'content', 'none' );
				}
			?>
		<?php endif; ?>

<?php get_footer(); ?>