<?php
if( ! function_exists("rt_blog_carousel") ){
	/**
	 * Blog Carousel	
	 * returns html ouput of posts for carousel
	 * 
	 * @param  array   $atts   
	 * @return output 
	 */
	
	function rt_blog_carousel( $atts = array() ) { 
		global $rt_post_values, $rt_blog_list_atts;   

		//sanitize fields
		$atts["id"] = isset( $atts["id"] ) ? sanitize_html_class( $atts["id"] ) : 'blog-carousel-dynamicID-'.rand(100000, 1000000);

		//defaults
		$rt_blog_list_atts = shortcode_atts( array(  
			"id"                        => 'blog-carousel-dynamicID-'.rand(100000, 1000000), 
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
			"show_author"               => "true",
			"show_categories"           => "true",
			"show_comment_numbers"      => "true",
			"show_date"                 => "true",
			"use_excerpts"              => "true",
			"excerpt_length"            => 100,
			"autoplay"                  => "false",
			"timeout"                   => 5000,
		), $atts);

		extract($rt_blog_list_atts); 

		//counter
		$counter = 1;

		//create a post status array
		$post_status = is_user_logged_in() ? array( 'private', 'publish' ) : "publish";

		//general query
		$args = array( 
			'post_status'    =>	$post_status,
			'post_type'      =>	'post',
			'orderby'        =>	$list_orderby,
			'order'          =>	$list_order,
			'showposts' 	 =>	$max_item,					
		);

		if( ! empty ( $ids ) ){				
			$ids = ! empty( $ids ) ? explode(",", trim( $ids ) ) : array();							
			$args = array_merge( $args, array( 'post__in' => $ids ) );
		}

		if( ! empty ( $categories ) ){

			$categories = is_array( $categories ) ? $categories : explode(",", rt_wpml_lang_object_ids( $categories, "category" ) ); 	

			$args = array_merge($args, array( 

				'tax_query' => array(
						array(
							'taxonomy' =>	'category',
							'field'    =>	'id',
							'terms'    =>	$categories,
							'operator' => 	"IN"
						)
					),
			) );
		} 

		$wp_query  = new WP_Query($args); 
		wp_reset_postdata();
		//column count
		$item_width = rt_column_count( $list_layout );
 
 		//column class
 		$add_column_class = "item post"; 

		if ( $wp_query->have_posts() ){ 
			
			$output = array();

			//the loop
			while ( $wp_query->have_posts() ) : $wp_query->the_post();

				//get post values
				$rt_post_values = rt_get_loop_post_values( $wp_query->post, $rt_blog_list_atts, "carousel" );

				ob_start();

				echo '<div class="'.$add_column_class.'">'."\n";

					get_template_part( '/post-contents/carousel','content'); 

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
				"class"             => "blog-carousel",
				"nav"               => $nav,
				"dots"              => $dots,
				"autoplay"          => $autoplay,
				"timeout"           => $timeout
			);

			//create carousel 
			return rt_create_carousel( $output, $atts );

		}
	}
}
add_shortcode('blog_carousel', 'rt_blog_carousel'); 
?>