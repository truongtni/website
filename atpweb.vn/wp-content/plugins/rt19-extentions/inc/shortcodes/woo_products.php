<?php
/**
 * 
 * Extended WooCommerce Shortcode
 * 
 */
if( ! function_exists("rt_woo_products") ){
	/**
	 * Woo Products
	 * @param  array   $wp_query
	 * @param  array   $atts   
	 * @return output           
	 */
	function rt_woo_products( $atts = array() ) { 


		//sanitize fields
		$atts["id"] = isset( $atts["id"] ) ? sanitize_html_class( $atts["id"] ) : 'product-dynamicID-'.rand(100000, 1000000);

		//defaults
		$rt_product_list_atts = shortcode_atts( array(  
			"id"  => 'product-dynamicID-'.rand(100000, 1000000), 
			"list_layout" => "1/3", 
			"pagination" => "true",
			"list_orderby" => "date",
			"list_order" => "DESC",
			"item_per_page"=> 10,
			"categories" => "",
			"paged" => 0,
			"ids" => ""
		), $atts);

		extract($rt_product_list_atts); 

		//counter
		$counter = 1;

		//paged
		if( $pagination && $paged == 0 ){
			if (get_query_var('paged') ) {$paged = get_query_var('paged');} elseif ( get_query_var('page') ) {$paged = get_query_var('page');} else {$paged = 1;} 
		}

		//create a post status array
		$post_status = is_user_logged_in() ? array( 'private', 'publish' ) : "publish";

		//general query
		$args = array( 
					'post_status'         => $post_status,
					'post_type'           => 'product',
					'orderby'             => $list_orderby,
					'order'               => $list_order,
					'posts_per_page'      => $item_per_page,
					'ignore_sticky_posts' => 1,
					'paged'               => $paged,
					'meta_query' 	=> WC()->query->get_meta_query(),
					'tax_query'     => WC()->query->get_tax_query(),		 
				);

		if( ! empty ( $ids ) ){				
			$ids = ! empty( $ids ) ? explode(",", trim( $ids ) ) : array();							
			$args = array_merge($args, array( 'post__in'  => $ids) );
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

		//get page & post counts
		$post_count = $wp_query->post_count;
		$page_count = $wp_query->max_num_pages;

		//item width percentage
		$list_layout = ! empty( $list_layout ) ? $list_layout : "1/3";

		global $woo_product_layout;
		$woo_product_layout = $list_layout;
		
		//layout style
		$add_holder_class = $list_layout == "1/1" ? "" : " border_grid fixed_heights" ;
 
 		//column class
 		$add_column_class = "product_item_holder ";
 		$add_column_class .= rt_column_class( $list_layout );

		//column count
		$column_count = rt_column_count( $list_layout );

		//output
		$output = "";

		if ( $wp_query->have_posts() ){ 
			
			//open the wrapper
			$output .= "\n".'<div id="'.$id.'" class="woocommerce product_holder product-showcase clearfix '.$add_holder_class.'" data-column-width="'. $column_count .'" itemscope itemtype="http://schema.org/Product">'."\n";

			//the loop
			while ( $wp_query->have_posts() ) : $wp_query->the_post();


				//open row block
				if( $list_layout != "1/1" && ( $counter % $column_count == 1 || $column_count == 1 ) ){
					$output .= '<div class="row clearfix">'."\n";
				}	

					$output .= $list_layout != "1/1" ? '<div class="col '.$add_column_class.'">'."\n" : "";

					ob_start();
					get_template_part( 'woocommerce/shortcode-content','product'); 
					$output .=  ob_get_contents();
					ob_end_clean();						

					$output .= $list_layout != "1/1" ? '</div>'."\n" : "";

						 
				//close row block
				if( $list_layout != "1/1" && ( $counter % $column_count == 0 || $post_count == $counter ) ){
					$output .= '</div>'."\n";  
				}

			$counter++;
			endwhile;  
			
			//reset post data for the new query
			wp_reset_postdata(); 	

			//close wrapper
			$output .= '</div>'."\n"; 		


			if( $pagination !== "false" ){
				$output .= rt_get_pagination( $wp_query, 8, false, false, false );	
			}  

			return $output;
		}
		
	}
}

add_shortcode('woo_products', 'rt_woo_products'); 
?>