<?php
if( ! function_exists("rt_testimonial_carousel") ){
	/**
	 * Testimonanial Carousel
	 * returns html ouput of testimonial posts for carousel
	 * 
	 * @param  array   $atts   
	 * @return output 
	 */
	function rt_testimonial_carousel( $atts = array() ) { 
		global $client_images;

		//sanitize fields
		$atts["id"] = isset( $atts["id"] ) ? sanitize_html_class( $atts["id"] ) : 'testimonial-dynamicID-'.rand(100000, 1000000);

		//defaults
		$rt_product_list_atts = shortcode_atts( array(  
			"id"            => 'testimonial-dynamicID-'.rand(100000, 1000000), 
			"class"         => "", 
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
			"style"         => "center",
			"client_images" => "true",
			"autoplay"      => "false",
			"timeout"       => 5000,		
			"loop"            => "false"
		), $atts);

		extract($rt_product_list_atts); 

		//counter
		$counter = 1;

		//create a post status array
		$post_status = is_user_logged_in() ? array( 'private', 'publish' ) : "publish";

		//general query
		$args = array( 
			'post_status'    =>	$post_status,
			'post_type'      =>	'testimonial',
			'orderby'        =>	$list_orderby,
			'order'          =>	$list_order,
			'showposts' 	 =>	$max_item,					
		);

		if( ! empty ( $ids ) ){				
			$ids = ! empty( $ids ) ? explode(",", trim( $ids ) ) : array();							
			$args = array_merge( $args, array( 'post__in' => $ids ) );
		}

		if( ! empty ( $categories ) ){

			$categories = is_array( $categories ) ? $categories : explode(",", rt_wpml_lang_object_ids( $categories, "testimonial_categories" ) ); 	

			$args = array_merge($args, array( 					

				'tax_query' => array(
						array(
							'taxonomy' =>	'testimonial_categories',
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
 		$add_column_class = "testimonial item"; 

		if ( $wp_query->have_posts() ){ 
			
			$output = array();

			//the loop
			while ( $wp_query->have_posts() ) : $wp_query->the_post();

				ob_start();

				echo '<div class="'.$add_column_class.'">'."\n";

					//get content
					get_template_part( 'testimonial-contents/content'); 		

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
				"class"             => "testimonial-carousel testimonials ".trim($style." ".$class),
				"nav"               => $nav,
				"dots"              => $dots,
				"autoplay"          => $autoplay,
				"timeout"           => $timeout,
				"loop"              => $loop
			);

			//create carousel 
			return rt_create_carousel( $output, $atts );

		}

	}
}
add_shortcode('testimonial_carousel', 'rt_testimonial_carousel'); 
?>