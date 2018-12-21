<?php
if( ! function_exists("rt_products_carousel") ){
	/**
	 * Product Carousel	
	 * returns html ouput of products custom post type for carousel
	 * 
	 * @param  array   $atts   
	 * @return output 
	 */
	function rt_products_carousel( $atts = array() ) { 
		global $rt_product_post_values, $rt_product_list_atts;   

		//sanitize fields
		$atts["id"] = isset( $atts["id"] ) ? sanitize_html_class( $atts["id"] ) : 'product-dynamicID-'.rand(100000, 1000000);

		//defaults
		$rt_product_list_atts = shortcode_atts( array(  
			"id"                        => 'product-dynamicID-'.rand(100000, 1000000), 
			"list_layout"               => "1/3",
			"mobile_layout"             => 1,
			"tablet_layout"             => "",			
			"nav"                       => "true",
			"dots"                      => "false",
			"featured_image_resize"     => "true",
			"featured_image_max_width"  => 0,			
			"featured_image_max_height" => 0,
			"featured_image_crop"       => "false",		
			"list_orderby"              => "date",
			"list_order"                => "DESC",
			"max_item"                  => 10,
			"categories"                => "",
			"ids"                       => "", 
			"display_descriptions"      => "true",
			"display_titles"            => "true",
			"display_price"             => "true",
			"autoplay"                  => "false",
			"timeout"                   => 5000,			
		), $atts);

		extract($rt_product_list_atts); 

		//counter
		$counter = 1;

		//create a post status array
		$post_status = is_user_logged_in() ? array( 'private', 'publish' ) : "publish";

		//general query
		$args = array( 
			'post_status'    =>	$post_status,
			'post_type'      =>	'products',
			'orderby'        =>	$list_orderby,
			'order'          =>	$list_order,
			'showposts' 	 =>	$max_item,					
		);

		if( ! empty ( $ids ) ){				
			$ids = ! empty( $ids ) ? explode(",", trim( $ids ) ) : array();							
			$args = array_merge( $args, array( 'post__in' => $ids ) );
		}

		if( ! empty ( $categories ) ){

			$categories = is_array( $categories ) ? $categories : explode(",", rt_wpml_lang_object_ids( $categories, "product_categories",$wpml_lang ) ); 	
			
			$args = array_merge($args, array( 

				'tax_query' => array(
						array(
							'taxonomy' =>	'product_categories',
							'field'    =>	'id',
							'terms'    =>	$categories,
							'operator' => 	"IN"
						)
					),
			) );
		} 

		$wp_query  = new WP_Query($args); 

		//column count
		$item_width = rt_column_count( $list_layout );
 
 		//column class
 		$add_column_class = "product_item_holder item product"; 

		if ( $wp_query->have_posts() ){ 
			
			$output = array();

			//the loop
			while ( $wp_query->have_posts() ) : $wp_query->the_post();

				//get post values
				$rt_product_post_values = rt_get_product_loop_post_values( $wp_query->post, $rt_product_list_atts );

				//selected term list of each post
				$term_list = get_the_terms($wp_query->post->ID, 'product_categories');
				
				//add terms as class name
				$addTermsClass = "";
				if($term_list){
					if(is_array($term_list)){
						foreach ($term_list as $termSlug) {
							$addTermsClass .= " ". $termSlug->slug;
						}
					}
				}

				ob_start();

				echo '<div class="'.$add_column_class.' '.$addTermsClass.'">'."\n";

					get_template_part( 'product-contents/loop','content'); 

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
				"class"             => "product-carousel",
				"nav"               => $nav,
				"dots"              => $dots,
				"autoplay"          => $autoplay,
				"timeout"           => $timeout,
				"margin"            => apply_filters("product_carousel_margin", 25)
			);

			//create carousel 
			return rt_create_carousel( $output, $atts );

		}

	}
}
add_shortcode('product_carousel', 'rt_products_carousel'); 
?>