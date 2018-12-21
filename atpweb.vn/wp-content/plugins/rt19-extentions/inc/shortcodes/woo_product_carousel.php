<?php
if( ! function_exists("rt_woo_products_carousel") ){
	/**
	 * Product Carousel	
	 * returns html ouput of woo products for carousel
	 * 
	 * @param  array   $atts   
	 * @return output 
	 */
	function rt_woo_products_carousel( $atts = array() ) { 

		//defaults
		$rt_product_list_atts = shortcode_atts( array(  
			"id"            => 'carousel-dynamicID-'.rand(100000, 1000000), 
			"list_layout"   => "1/3",
			"mobile_layout" => 1,
			"tablet_layout" => "",			
			"nav"           => "true",
			"dots"          => "false", 
			"list_orderby"  => "date",
			"list_order"    => "DESC",			
			"max_item"      => 10,
			"categories"    => "",
			"ids"           => "",
			"autoplay"      => "false",
			"timeout"       => 5000,	
		), $atts);

		extract($rt_product_list_atts); 

		//sanitize fields
		$id = sanitize_html_class( $id );

		//counter
		$counter = 1;

		//create a post status array
		$post_status = is_user_logged_in() ? array( 'private', 'publish' ) : "publish";

		//general query
		$args = array( 
			'post_status' => $post_status,
			'post_type'   => 'product',
			'orderby'     => $list_orderby,
			'order'       => $list_order,
			'showposts'   => $max_item,		
			'meta_query'  => WC()->query->get_meta_query(),
			'tax_query'   => WC()->query->get_tax_query(),										
		);

		if( ! empty ( $ids ) ){				
			$ids = ! empty( $ids ) ? explode(",", trim( $ids ) ) : array();							
			$args = array_merge( $args, array( 'post__in' => $ids ) );
		}

		if( ! empty ( $categories ) ){

			$categories = is_array( $categories ) ? $categories : explode(",", rt_wpml_lang_object_ids( $categories, "product_cat" ) ); 

			$args['tax_query'][] = array(
				'taxonomy' =>	'product_cat',
				'field'    =>	'id',
				'terms'    =>	$categories,
				'operator' => 	"IN"
			);

		} 

		$wp_query  = new WP_Query($args); 

		//column count
		$item_width = rt_column_count( $list_layout );
 
		global $woo_product_layout;
		$woo_product_layout = $list_layout; 		

 		//column class
 		$add_column_class = "product_item_holder item product"; 

		if ( $wp_query->have_posts() ){ 
			
			$output = array();

			//the loop
			while ( $wp_query->have_posts() ) : $wp_query->the_post();

				ob_start();

				echo '<div class="'.$add_column_class.'">'."\n";

					get_template_part( 'woocommerce/content-product','carousel'); 

				echo '</div>'."\n";

				$output[] .=  ob_get_contents();
				ob_end_clean();
						 
			$counter++;
			endwhile;  
 
			//reset post data for the new query
			wp_reset_postdata(); 	
			
			//carousel atts
			$atts = array(  
				"id"                => sanitize_html_class($id), 
				"item_width"        => $item_width, 
				"mobile_item_width" => $mobile_layout, 
				"tablet_item_width" => $tablet_layout, 				
				"class"             => "wc-product-carousel woocommerce",
				"nav"               => $nav,
				"dots"              => $dots,
				"margin"            => 14,
				"autoplay"          => $autoplay,
				"timeout"           => $timeout		
			);

			//create carousel 
			return rt_create_carousel( $output, $atts );

		}

	}
}
add_shortcode('woo_product_carousel', 'rt_woo_products_carousel'); 
?>