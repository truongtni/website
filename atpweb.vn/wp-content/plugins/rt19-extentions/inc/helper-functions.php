<?php
/**
 *
 * Various Helper Functions
 *
 * @author RT-Themes
 */
 
if( ! function_exists("rt_portfolio_post_loop") ){
	/**
	 * Portfolio Loop
	 * @param  array  $wp_query
	 * @param  array  $atts   
	 * @return output           
	 */
	function rt_portfolio_post_loop( $wp_query = array(), $atts = array() ) { 
		global $rt_portfolio_post_values, $rt_portfolio_list_atts;   

		//sanitize fields
		$atts["id"] = isset( $atts["id"] ) ? sanitize_html_class( $atts["id"] ) : 'portfolio-dynamicID-'.rand(100000, 1000000);

		//defaults
		$rt_portfolio_list_atts = shortcode_atts(array(  
			"id"  => 'portfolio-dynamicID-'.rand(100000, 1000000), 
			"list_layout" => get_theme_mod(RT_THEMESLUG.'_portfolio_layout'),
			"layout_style" => get_theme_mod(RT_THEMESLUG.'_portfolio_layout_style'),
			"item_style" => get_theme_mod(RT_THEMESLUG.'_portfolio_item_style'),
			"filterable" => "false",
			"pagination" => "true",
			"ajax_pagination" => "false",
			"featured_image_resize" => get_theme_mod(RT_THEMESLUG."_portfolio_image_resize"),
			"featured_image_max_width" => get_theme_mod(RT_THEMESLUG."_portfolio_image_width"),
			"featured_image_max_height" => get_theme_mod(RT_THEMESLUG."_portfolio_image_height"),
			"featured_image_crop" => get_theme_mod(RT_THEMESLUG."_portfolio_image_crop"),		
			"list_orderby" => "date",
			"list_order" => "DESC",
			"item_per_page"=> 10,
			"categories" => "",
			"ajax" => "false",
			"ids" => "",
			"paged" => 0,
			"wpml_lang" => "",
			"remove_paddings" => "false",
			"remove_buttons" => "false",
		), $atts);


		extract($rt_portfolio_list_atts);

		//pagination fix
		$pagination = rtframework_convert_bool($pagination);
		$ajax_pagination = rtframework_convert_bool($ajax_pagination);
		
		$wp_reset_postdata = false;

		//counter
		$counter = 1;

		//custom query
		if( ! $wp_query ){


			//paged
			if( $pagination && $paged == 0 ){
				if (get_query_var('paged') ) {$paged = get_query_var('paged');} elseif ( get_query_var('page') ) {$paged = get_query_var('page');} else {$paged = 1;} 
			}


			//create a post status array
			$post_status = is_user_logged_in() ? array( 'private', 'publish' ) : "publish";

			//general query
			$args = array( 
						'post_status'    => $post_status,
						'post_type'      => 'portfolio',
						'orderby'        => $list_orderby,
						'order'          => $list_order,
						'posts_per_page' => $item_per_page,
						'paged'          => $paged 
					);

			if( ! empty ( $ids ) ){				
				$ids = ! empty( $ids ) ? explode(",", trim( $ids ) ) : array();							
				$args = array_merge($args, array( 'post__in'  => $ids) );
			}

			if( ! empty ( $categories ) ){
				
				$categories = is_array( $categories ) ? $categories : explode(",", rt_wpml_lang_object_ids( $categories, "portfolio_categories",$wpml_lang ) ); 				

				$args = array_merge($args, array( 

					'tax_query' => array(
							array(
								'taxonomy' =>	'portfolio_categories',
								'field'    =>	'id',
								'terms'    =>	$categories,
								'operator' => 	"IN"
							)
						),	
				) );
			} 

			$wp_query  = new WP_Query($args); 

			//filter navigation
			if( $filterable !== "false" ){
				//categories - turn into an array
				$sortCategories = $categories;  
				$sortNavigation = "";

				if( ! empty( $sortCategories ) ){  
					if(is_array($sortCategories)){ 
						foreach ($sortCategories as $arrayorder => $termID) { 
							$sortCategories = get_term_by('id', $termID, 'portfolio_categories');
							$sortNavigation .= '<li><a href="#" data-filter=".'.$sortCategories->slug.'">'.$sortCategories->name.'</a></li>';
						}
					}  

				}else{
					$sortCategories  = get_terms( 'portfolio_categories', 'orderby=name&hide_empty=1&order=ASC' );
					$sortCategories  = is_array($sortCategories) ? $sortCategories : "";

					foreach ($sortCategories as $key => $term) {
						$sortNavigation  .= '<li><a data-filter=".'.$term->slug.'" title="'.$term->name.'">'.$term->name.'</a></li>';
					}	
				}

				$filter_holder = ! empty( $sortNavigation ) ? sprintf('
						<div class="filter-holder" data-list-id="%s">
						<ul class="filter_navigation">%s %s</ul>
						</div>',$id,'<li><a href="#" data-filter="*" class="active animate" title="'.apply_filters("filter_nav_text",__("Show All","rt_theme")).'"><span class="icon-filter"></span></a></li>',$sortNavigation) : "";

				echo $filter_holder;
			}

			$wp_reset_postdata = true;
		}

		//get page & post counts
		$post_count = $wp_query->post_count;
		$page_count = $wp_query->max_num_pages;

		//item width percentage
		$list_layout = ! empty( $list_layout ) ? $list_layout : "1/3";

		//layout style
		$add_holder_class = $list_layout == "1/1" ? "" : ( $layout_style == "grid" ? " border_grid fixed_heights" : " masonry" ) ;
		$add_holder_class .= $filterable !== "false" ? " filterable" : "";
		$add_holder_class .= $remove_paddings === "true" ? " remove_paddings" : "";
 
 		//column class
 		$grid_global_class = rt_column_class( $list_layout );
		$add_column_class = $layout_style == "masonry" ? " isotope-item" : "";

		//double column width values
		$double_width = array("1"=> "1/1", "2"=> "1/1","3"=> "8/12","4"=> "1/2","6"=> "4/12");

		//row count
		$column_count = rt_column_count( $list_layout );


		if ( $wp_query->have_posts() ){ 
			
			//open the wrapper
			echo "\n".'<div id="'.$id.'" class="portfolio_list clearfix '.$add_holder_class.'" data-column-width="'. $column_count .'">'."\n";

			//the loop
			while ( $wp_query->have_posts() ) : $wp_query->the_post();

				//get post values
				$rt_portfolio_post_values = rt_get_portfolio_loop_post_values( $wp_query->post, $rt_portfolio_list_atts );

				//selected term list of each post
				$term_list = get_the_terms($wp_query->post->ID, 'portfolio_categories');
				
				//add terms as class name
				$addTermsClass = "";
				if($term_list){
					if(is_array($term_list)){
						foreach ($term_list as $termSlug) {
							$addTermsClass .= " ". $termSlug->slug;
						}
					}
				}

				//open row block
				if(  $layout_style != "masonry" && $list_layout != "1/1" && ( $counter % $column_count == 1 || $column_count == 1 ) ){
					echo '<div class="row clearfix">'."\n";
				}	

				if( $rt_portfolio_post_values["masonry_view"] == "double" && $layout_style == "masonry" ){
					$grid_class = rt_column_class($double_width[$column_count]);
				}else{
					$grid_class = $grid_global_class;
				}

					echo $list_layout != "1/1" ? '<div class="col '.trim($grid_class.' '.$add_column_class.' '.$addTermsClass).'">'."\n" : "";

						get_template_part( 'portfolio-contents/loop','content'); 

					echo $list_layout != "1/1" ? '</div>'."\n" : "";

						 
				//close row block
				if( $layout_style != "masonry" && $list_layout != "1/1" && ( $counter % $column_count == 0 || $post_count == $counter ) ){
					echo '</div>'."\n";  
				}

			$counter++;
			endwhile;  
			
			//close wrapper
			echo '</div>'."\n"; 		


			if( ( $pagination !== "false" && $ajax_pagination === "false" ) || ( $pagination !== "false" && $layout_style != "masonry" ) ){
				rt_get_pagination( $wp_query );	
			} 
			
			if( $ajax_pagination !== "false" && $layout_style == "masonry" && $page_count > 1 && $ajax === "false" ){

				$rt_portfolio_list_atts["purpose"] = "portfolio";
				rt_get_ajax_loader_button( $rt_portfolio_list_atts, $page_count );	

			}

		}		

		//reset post data for the new query
		if( $wp_reset_postdata ){
			wp_reset_postdata(); 	
		} 
	}
}
add_action('portfolio_post_loop', 'rt_portfolio_post_loop', 10, 2); 

if( ! function_exists("rt_get_portfolio_loop_post_values") ){
	/**
	 * Get post values for loops
	 * gets all data of a portfolio item including metas
	 * 
	 * @param  array $post
	 * @param  array $atts [atts of rt_portfolio_post_loop function]
	 * @return array
	 */
	function rt_get_portfolio_loop_post_values( $post = array(), $atts = array(), $purpose = "" ){

		extract( $atts );

		//featured image
		$featured_image_id     = get_post_thumbnail_id(); 
		$featured_image_url    = ! empty( $featured_image_id ) ? wp_get_attachment_image_src( $featured_image_id, "full" ) : "";
		$featured_image_url    = is_array( $featured_image_url ) ? $featured_image_url[0] : "";	

		//custom thumbnail max height & crop settings for this post				
		if( $purpose != "carousel" ){
			if( get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'_featured_image_settings', true) == "new" ){
				$featured_image_resize = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'_portfolio_image_resize', true);
				$featured_image_max_width = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'_portfolio_image_width', true);
				$featured_image_max_height = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'_portfolio_image_height', true);
				$featured_image_crop = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'_portfolio_image_crop', true);
			}
		}

		if( $featured_image_resize !== "false" ){
			
			// thumbnail min width
			$w = ! empty( $featured_image_max_width ) ? $featured_image_max_width : rt_get_min_resize_size( $list_layout );

			// thumbnail max height
			$h = ! empty( $featured_image_max_height ) ? $featured_image_max_height : 10000;

			//thumbnail output
			$thumbnail_image_output = ! empty( $featured_image_id ) ? get_resized_image_output( array( "image_url" => "", "image_id" => $featured_image_id, "w" => $w, "h" => $h, "crop" => $featured_image_crop ) ) : ""; 	

		}else{
			//thumbnail output
			$thumbnail_image_output = ! empty( $featured_image_id ) ? rt_get_image_output( array( "image_url" => "", "image_id" => $featured_image_id ) ) : ""; 						
		}


		// Tiny image thumbnail for lightbox gallery feature
		$lightbox_thumbnail = ! empty( $featured_image_id ) ? rt_vt_resize( $featured_image_id, "", 75, 50, true ) : rt_vt_resize( $featured_image_id, "", 75, 50, true ); 
		$lightbox_thumbnail = is_array( $lightbox_thumbnail ) ? $lightbox_thumbnail["url"] : "" ; 
 
		//get post format
		$portfolio_format = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'_portfolio_post_format', true);
				
		//external link 
		$external_link = get_post_meta( $post->ID, RT_COMMON_THEMESLUG .'_external_link', true);

		//open in
		$target = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'_open_in_new_tab', true);

		//remove the link to single page
		$remove_link = get_post_meta( $post->ID, RT_COMMON_THEMESLUG .'_portf_no_detail', true);

		//permalink
		$permalink = ! empty( $remove_link ) ? "" : get_permalink();
		$permalink = ! empty( $external_link ) ? $external_link : $permalink;		

		//create global values array
		$rt_portfolio_post_values = array(
			"title" => get_the_title(),
			"permalink" => $permalink,
			"featured_image_id" => $featured_image_id ,
			"featured_image_url" => $featured_image_url, 
			"portfolio_format" => get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'_portfolio_post_format', true),
			"remove_link" => $remove_link, 
			"disable_lightbox" => get_post_meta( $post->ID, RT_COMMON_THEMESLUG .'_disable_lightbox', true), 
			"external_link" => $external_link, 
			"target" => ! empty( $target ) ? '_blank' : "_self", 
			"video_mp4" => get_post_meta( $post->ID, RT_COMMON_THEMESLUG .'_portfolio_video_m4v', true),
			"video_webm" => get_post_meta( $post->ID, RT_COMMON_THEMESLUG .'_portfolio_video_webm', true), 
			"external_video" => get_post_meta( $post->ID, RT_COMMON_THEMESLUG .'_portfolio_video', true),
			"audio_mp3" => get_post_meta( $post->ID, RT_COMMON_THEMESLUG .'_portfolio_audio_mp3', true), 
			"audio_ogg" => get_post_meta( $post->ID, RT_COMMON_THEMESLUG .'_portfolio_audio_oga', true), 
			"thumbnail_image_output" => $thumbnail_image_output,
			"lightbox_thumbnail" => $lightbox_thumbnail,
			"short_desc" => get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'_portfolio_desc', true) ,
			"masonry_view" => get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'_masonry_view', true)
		); 
	

		$rt_portfolio_post_values = apply_filters( "rt_portfolio_post_values", $rt_portfolio_post_values );

		return $rt_portfolio_post_values;
	}
}

if( ! function_exists("rt_get_portfolio_single_post_values") ){
	/**
	 * Get post values for single portfolio pages
	 * gets data of a portfolio item including metas
	 * 
	 * @param  array $post
	 * @param  array $atts 
	 * @return array
	 */
	function rt_get_portfolio_single_post_values( $post = array(), $atts = array()){

		//defaults
		$atts = shortcode_atts(array(  
			"layout" => "1/1", 
			"featured_image_max_height" => 1000,
			"featured_image_crop" => "false",
			"hide_featured_image_single_page" => get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'_hide_featured_image_single_page', true),
			"show_share_buttons" => "true"
		), $atts);

		$atts = apply_filters( "rt_portfolio_single_post_values", $atts );

		extract( $atts );

		//featured image
		$featured_image_id     = get_post_thumbnail_id(); 
		$featured_image_url    = ! empty( $featured_image_id ) ? wp_get_attachment_image_src( $featured_image_id, "full" ) : "";
		$featured_image_url    = is_array( $featured_image_url ) ? $featured_image_url[0] : "";	

		//custom thumbnail max height & crop settings for this post				
		$this_featured_image_settings = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'_featured_image_settings', true);
		$featured_image_max_height = $this_featured_image_settings == "new" ? get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'_portfolio_image_height', true) : $featured_image_max_height;
		$featured_image_crop = $this_featured_image_settings == "new" ? get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'_portfolio_image_crop', true) : $featured_image_crop;

		//featured media width
		$featured_media_width = get_post_meta( $post->ID, RT_COMMON_THEMESLUG .'_portfolio_featured_media_width', true);
		$featured_media_width = ! empty( $featured_media_width );

		// thumbnail min width
		$w = ! $featured_media_width ? rt_get_min_resize_size( $layout ) : 10000;

		// thumbnail max height
		$h = 10000;

		//thumbnail output
		$thumbnail_image_output = ! empty( $featured_image_id ) ? get_resized_image_output( array( "image_url" => "", "image_id" => $featured_image_id, "w" => $w, "h" => $h, "crop" => false ) ) : ""; 

		// Tiny image thumbnail for lightbox gallery feature
		$lightbox_thumbnail = ! empty( $featured_image_id ) ? rt_vt_resize( $featured_image_id, "", 75, 50, true ) : rt_vt_resize( $featured_image_id, "", 75, 50, true ); 
		$lightbox_thumbnail = is_array( $lightbox_thumbnail ) ? $lightbox_thumbnail["url"] : "" ; 

		// gallery images
		$rt_gallery_images = get_post_meta( $post->ID, RT_COMMON_THEMESLUG . "rt_gallery_images", true ); 
		$rt_gallery_images = ! empty( $rt_gallery_images ) ? ! is_array( $rt_gallery_images ) ? explode(",", $rt_gallery_images) : $rt_gallery_images : array(); //turn into an array

		//get post format
		$portfolio_format = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'_portfolio_post_format', true);
		$portfolio_format = empty( $portfolio_format ) ? "image" : $portfolio_format;
				
		//permalink
		$permalink = ! empty( $remove_link ) ? "" : get_permalink();
		$permalink = ! empty( $external_link ) ? $external_link : $permalink;		
 
		//no media for image post type
		$no_featured_media = $portfolio_format == "image" && empty( $rt_gallery_images ) && ( ( empty($featured_image_url) ) || ( $featured_image_url && $hide_featured_image_single_page ) ) ? true : false;
		

		//create global values array
		$rt_portfolio_post_values = array(
			"title" => get_the_title(),
			"permalink" => $permalink,
			"featured_image_id" => $featured_image_id ,
			"featured_image_url" => $featured_image_url, 
			"portfolio_format" => $portfolio_format,
			"video_mp4" => get_post_meta( $post->ID, RT_COMMON_THEMESLUG .'_portfolio_video_m4v', true),
			"video_webm" => get_post_meta( $post->ID, RT_COMMON_THEMESLUG .'_portfolio_video_webm', true), 
			"external_video" => get_post_meta( $post->ID, RT_COMMON_THEMESLUG .'_portfolio_video', true),
			"audio_mp3" => get_post_meta( $post->ID, RT_COMMON_THEMESLUG .'_portfolio_audio_mp3', true), 
			"audio_ogg" => get_post_meta( $post->ID, RT_COMMON_THEMESLUG .'_portfolio_audio_oga', true), 
			"gallery_images" => $rt_gallery_images,
			"gallery_usage"=> get_post_meta( $post->ID, RT_COMMON_THEMESLUG .'_featured_image_usage', true), 
			"gallery_images_crop" => get_post_meta( $post->ID, RT_COMMON_THEMESLUG .'image_crop', true),
			"gallery_images_max_height" => get_post_meta( $post->ID, RT_COMMON_THEMESLUG .'portfolio_max_image_height', true),
			"gallery_layout" => get_post_meta( $post->ID, RT_COMMON_THEMESLUG .'_gallery_layout', true),
			"thumbnail_image_output" => $thumbnail_image_output,
			"lightbox_thumbnail" => $lightbox_thumbnail,
			"featured_media_width" => $featured_media_width,
			"no_featured_media" => $no_featured_media,
			"video_poster_img" => get_post_meta( $post->ID, RT_COMMON_THEMESLUG .'_video_poster_img', true)
		); 

		$rt_portfolio_post_values = array_merge($rt_portfolio_post_values, $atts);

		return $rt_portfolio_post_values;
	}
}

if( ! function_exists("rt_product_post_loop") ){
	/**
	 * Product Loop
	 * @param  array $wp_query
	 * @param  array $atts   
	 * @return output           
	 */
	function rt_product_post_loop( $wp_query = array(), $atts = array() ) { 
		global $rt_product_post_values, $rt_product_list_atts;   

		//sanitize fields
		$atts["id"] = isset( $atts["id"] ) ? sanitize_html_class( $atts["id"] ) : 'product-dynamicID-'.rand(100000, 1000000);

		//defaults
		$rt_product_list_atts = shortcode_atts( array(  
			"id"  => 'product-dynamicID-'.rand(100000, 1000000), 
			"list_layout" => apply_filters( "rt-category-list-layout", get_theme_mod(RT_THEMESLUG.'_product_layout')),
			"layout_style" => apply_filters( "rt-category-list-layout-style", get_theme_mod(RT_THEMESLUG.'_product_layout_style')),
			"pagination" => "true",
			"ajax_pagination" => "false",
			"featured_image_resize" => get_theme_mod(RT_THEMESLUG."_product_image_resize"),
			"featured_image_max_width" => get_theme_mod(RT_THEMESLUG."_product_image_width"),			
			"featured_image_max_height" => get_theme_mod(RT_THEMESLUG."_product_image_height"),
			"featured_image_crop" => get_theme_mod(RT_THEMESLUG."_product_image_crop"),		
			"list_orderby" => "date",
			"list_order" => "DESC",
			"item_per_page"=> 10,
			"categories" => "",
			"ajax" => "false",
			"paged" => 0,
			"wpml_lang" => "",
			"display_descriptions" => "true",
			"display_titles" => "true",
			"display_price" => get_theme_mod( RT_THEMESLUG."_show_price_in_list" ),
			"ids" => ""
		), $atts);

		extract($rt_product_list_atts); 

		//pagination fix
		$pagination = rtframework_convert_bool($pagination);
		$ajax_pagination = rtframework_convert_bool($ajax_pagination);
		
		$wp_reset_postdata = false;

		//counter
		$counter = 1;

		//custom query
		if( ! $wp_query ){

			//paged
			if( $pagination !== "false" && $paged == 0 ){
				if (get_query_var('paged') ) {$paged = get_query_var('paged');} elseif ( get_query_var('page') ) {$paged = get_query_var('page');} else {$paged = 1;} 
			}

			//create a post status array
			$post_status = is_user_logged_in() ? array( 'private', 'publish' ) : "publish";

			//general query
			$args = array( 
						'post_status'    =>	$post_status,
						'post_type'      =>	'products',
						'orderby'        =>	$list_orderby,
						'order'          =>	$list_order,
						'posts_per_page' =>	$item_per_page,
						'paged'          => $paged 
					);

			if( ! empty ( $ids ) ){				
				$ids = ! empty( $ids ) ? explode(",", trim( $ids ) ) : array();							
				$args = array_merge($args, array( 'post__in'  => $ids) );
			}

			if( ! empty ( $categories ) ){

				$categories = is_array( $categories ) ? $categories : explode(",", rt_wpml_lang_object_ids( $categories, "product_categories",$wpml_lang ) );

				$args = array_merge($args, array( 

					'tax_query' => array(
							array(
								'taxonomy' =>	'product_categories',
								'field'    =>	'id',
								'terms'    =>	$categories ,
								'operator' => 	"IN"
							)
						),	
				) );
			} 


			$wp_query  = new WP_Query($args); 

			$wp_reset_postdata = true;
		}

		//get page & post counts
		$post_count = $wp_query->post_count;
		$page_count = $wp_query->max_num_pages;

		//item width percentage
		$list_layout = ! empty( $list_layout ) ? $list_layout : "1/3";

		//layout style
		$add_holder_class = $list_layout == "1/1" ? "" : ( $layout_style == "grid" ? " border_grid fixed_heights" : " masonry" ) ;
 
 		//column class
 		$add_column_class = "product_item_holder ";
 		$add_column_class .= rt_column_class( $list_layout );
		$add_column_class .= $layout_style == "masonry" ? " isotope-item" : "";

		//column count
		$column_count = rt_column_count( $list_layout );

		if ( $wp_query->have_posts() ){ 
			
			//open the wrapper
			echo "\n".'<div id="'.$id.'" class="product_holder product-showcase clearfix '.$add_holder_class.'" data-column-width="'. $column_count .'">'."\n";

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


				//open row block
				if(  $layout_style != "masonry" && $list_layout != "1/1" && ( $counter % $column_count == 1 || $column_count == 1 ) ){
					echo '<div class="row clearfix">'."\n";
				}	

					echo $list_layout != "1/1" ? '<div class="col '.$add_column_class.' '.$addTermsClass.'">'."\n" : "";

						get_template_part( 'product-contents/loop','content'); 

					echo $list_layout != "1/1" ? '</div>'."\n" : "";

						 
				//close row block
				if( $layout_style != "masonry" && $list_layout != "1/1" && ( $counter % $column_count == 0 || $post_count == $counter ) ){
					echo '</div>'."\n";  
				}

			$counter++;
			endwhile;  
			
			//close wrapper
			echo '</div>'."\n"; 		


			if( ( $pagination !== "false" && $ajax_pagination === "false" ) || ( $pagination !== "false" && $layout_style != "masonry" ) ){
				rt_get_pagination( $wp_query );	
			} 
			
			if( $ajax_pagination !== "false" && $layout_style == "masonry" && $page_count > 1 && $ajax === "false" ){

				$rt_product_list_atts["purpose"] = "products";
				rt_get_ajax_loader_button( $rt_product_list_atts, $page_count );	

			}

		}

		//reset post data for the new query
		if( $wp_reset_postdata ){
			wp_reset_postdata(); 	
		} 
	}
}
add_action('rt_product_post_loop', 'rt_product_post_loop', 10, 2); 

if( ! function_exists("rt_get_product_loop_post_values") ){
	/**
	 * Get post values for loops
	 * gets all data of a portfolio item including metas
	 * 
	 * @param  array $post
	 * @param  array $atts [atts of rt_product_post_loop function]
	 * @return array
	 */
	function rt_get_product_loop_post_values( $post = array(), $atts = array() ){

		extract( $atts );

		//featured image
		$featured_image_id     = get_post_thumbnail_id(); 
		$featured_image_url    = ! empty( $featured_image_id ) ? wp_get_attachment_image_src( $featured_image_id, "full" ) : "";
		$featured_image_url    = is_array( $featured_image_url ) ? $featured_image_url[0] : "";	

		if( $featured_image_resize !== "false" ){
			// thumbnail min width
			$w = ! empty( $featured_image_max_width ) ? $featured_image_max_width : rt_get_min_resize_size( $list_layout );

			// thumbnail max height
			$h = ! empty( $featured_image_max_height ) ? $featured_image_max_height : 10000;

			//thumbnail output
			$thumbnail_image_output = ! empty( $featured_image_id ) ? get_resized_image_output( array( "image_url" => "", "image_id" => $featured_image_id, "w" => $w, "h" => $h, "crop" => $featured_image_crop ) ) : ""; 	

		}else{
			//thumbnail output
			$thumbnail_image_output = ! empty( $featured_image_id ) ? rt_get_image_output( array( "image_url" => "", "image_id" => $featured_image_id ) ) : ""; 						
		}

		//permalink
		$permalink = get_permalink();

		//create global values array
		$rt_product_post_values = array(
			"title" => get_the_title(),
			"permalink" => $permalink,
			"featured_image_id" => $featured_image_id ,
			"featured_image_url" => $featured_image_url, 
			"regular_price" => get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'price_regular', true),
			"sale_price" => get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'sale_price', true),
			"short_desc" => get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'short_description', true),
			"thumbnail_image_output" => $thumbnail_image_output
		); 


		return $rt_product_post_values;
	}
}

if( ! function_exists("rt_get_product_single_post_values") ){
	/**
	 * Get post values for single product pages
	 * gets data of a product item including metas
	 * 
	 * @param  array $post
	 * @param  array $atts 
	 * @return array
	 */
	function rt_get_product_single_post_values( $post = array(), $atts = array()){

		//defaults
		$atts = shortcode_atts(apply_filters("single_products_layout",array(  
			"gallery_images_max_height" => 1000,
			"gallery_images_crop" => "false",
			"share_buttons" => get_theme_mod( RT_THEMESLUG ."_hide_product_share_buttons" ) ? "false" : "true",
			"display_price" => get_theme_mod( RT_THEMESLUG."_show_price_in_pages" )
		)), $atts);

		extract( $atts );

		//single content layout
		$single_content_layout = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'_product_content_layout_options', true);
		$content_width         = $single_content_layout == "new" ? get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'_product_content_width', true) : get_theme_mod( RT_THEMESLUG."_product_content_width" );
		$content_style         = $single_content_layout == "new" ? get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'_product_content_style', true) : get_theme_mod( RT_THEMESLUG."_product_content_style" );
		$content_width         = ! empty( $content_width ) ? $content_width : "1/1" ;
		$content_style         = ! empty( $content_style ) ? $content_style : "1" ;

		// gallery images
		$rt_gallery_images = get_post_meta( $post->ID, RT_COMMON_THEMESLUG . "rt_gallery_images", true ); 
		$rt_gallery_images = ! empty( $rt_gallery_images ) ? ! is_array( $rt_gallery_images ) ? explode(",", $rt_gallery_images) : $rt_gallery_images : array(); //turn into an array
		$rt_gallery_images = rt_merge_featured_images( $rt_gallery_images ); //add the wp featured image to the array

		//calculate tabs content width
		$slider_width = explode("/", $content_width);
		$slider_width = $slider_width[1] - $slider_width[0] ."/". $slider_width[1];


		//related products
		$related_products = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'related_products[]', true);

		//attached documents
		$attached_documents = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'attached_documents', true);


		//is tabs required
		$tabbed_page = false;

		//free tabs
		$tab_count=4;
		for( $i=0; $i < $tab_count+1; $i++ ){
			if (trim(get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'free_tab_'.$i.'_title', true))) {
				$tabbed_page = true;
			}
		}

		$tabbed_page = ! empty( $related_products ) || ! empty( $attached_documents ) ? true : $tabbed_page;


		//create global values array
		$rt_get_product_single_post_values = array(
			"title"              => get_the_title(),
			"permalink"          => get_permalink(),
			"content"            => get_the_content(),
			"regular_price"      => get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'price_regular', true),
			"sale_price"         => get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'sale_price', true),
			"sku"                => get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'sku', true),
			"attached_documents" => $attached_documents,
			"related_products"   => $related_products,
			"short_desc"         => get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'short_description', true),
			"tabbed_page"        => $tabbed_page,
			"gallery_images"     => $rt_gallery_images,
			"tab_count"          => $tab_count,
			"slider_width"       => $slider_width,
			"content_width"      => $content_width,
			"content_style"      => $content_style
		); 

		$rt_get_product_single_post_values = array_merge($rt_get_product_single_post_values, $atts);

		return $rt_get_product_single_post_values;
	}
}

if( ! function_exists("create_rt_product_price") ){
	/**
	 * Create product price
	 * 	 
	 * @param  array $args{
	 *         "regular_price" => $regular_price,
	 *         "sale_price" => $sale_price
	 * }
	 * @return output
	 */
	function create_rt_product_price( $args = array() ){

		extract( $args );	

		$regular_price_output = $sale_price_output = "";		

		//get currency displaying format from options
		$currency_location = get_theme_mod(RT_THEMESLUG."_currency_location");
		$currency_location  = $currency_location ? $currency_location : "before";

		$currency_format = $currency_location == "before" ? "%1\$s%2\$s" : "%2\$s%1\$s";

		//currency
		$currency  = apply_filters("rt_product_currency", get_theme_mod(RT_THEMESLUG."_currency") );
	 
		//regular price with currency 
		$regular_price = ! empty( $regular_price ) ? sprintf( $currency_format, $currency, $regular_price ) : "";

		//sale price with currency 
		$sale_price = ! empty( $sale_price ) ? sprintf( $currency_format, $currency, $sale_price ) : "";

		//regular price output
		$regular_price_output = ! empty( $regular_price ) ? sprintf( '<del><span class="amount">%s</span></del>', $regular_price ) : "";

		//sale price output
		$sale_price_output = ! empty( $sale_price ) ? sprintf( '<ins><span class="amount">%s</span></ins>', $sale_price ) : "";

		//price group output
		$price_output = ! empty( $regular_price_output ) || ! empty( $sale_price_output ) ? sprintf( 
		'
			<!-- product price -->
			<p class="price icon-">	
				%1$s %2$s
			</p> 
		',$regular_price_output, $sale_price_output): "";

		echo $price_output;
	}
}
add_action( "rt_product_price", "create_rt_product_price", 10, 1 );

if( ! function_exists("rt_tax_pagination_fix") ){
	/**
	 * Taxonomy Query & Pagination Fix
	 * 
	 * Changes item per page
	 * Changes OrderBy and Order Parameter of the query
	 * Prevents 404 pages of paginations
	 * 
	 * @param  object $query the wp_query
	 * @return object $query 
	 */
	function rt_tax_pagination_fix($query) { 

		if ( ! class_exists( 'RTTheme' ) ){
			return; 
		}

		$rt_taxonomy = isset( $query->query_vars["taxonomy"] ) ? $query->query_vars["taxonomy"] : "";

		if ( $rt_taxonomy == "product_categories" ){

			$post_per_page = get_theme_mod(RT_THEMESLUG.'_product_list_pager') ;
			$post_per_page = is_numeric( $post_per_page ) ? $post_per_page : 10 ;
			
			$list_orderby = get_theme_mod(RT_THEMESLUG."_product_list_orderby");
			$list_orderby = !empty( $list_orderby ) ? $list_orderby : "date" ;

			$list_order = get_theme_mod(RT_THEMESLUG."_product_list_order");
			$list_order = !empty( $list_order ) ? $list_order : "DESC" ;

			$query->set('posts_per_page',  $post_per_page ); 
			$query->set('orderby', $list_orderby);  
			$query->set('order', $list_order);  
			$query->set('post_type', "products");

			return $query; 
		}

		elseif ( $rt_taxonomy == "portfolio_categories" ){
			
			$post_per_page = get_theme_mod(RT_THEMESLUG.'_portf_pager') ;
			$post_per_page = is_numeric( $post_per_page ) ? $post_per_page : 10 ;
			
			$list_orderby = get_theme_mod(RT_THEMESLUG."_portf_list_orderby");
			$list_orderby = !empty( $list_orderby ) ? $list_orderby : "date" ;

			$list_order = get_theme_mod(RT_THEMESLUG."_portf_list_order");
			$list_order = !empty( $list_order ) ? $list_order : "DESC" ;

			$query->set('posts_per_page',  $post_per_page ); 
			$query->set('orderby', $list_orderby);  
			$query->set('order', $list_order);  
			$query->set('post_type', "portfolio");

			return $query; 
		}

		else{
			return;
		}
	}
}
add_filter('pre_get_posts','rt_tax_pagination_fix');

if( ! function_exists("rt_category_templates") ){
	/**
	 * Change the portfolio, product, testimonial taxonomy template paths
	 * @param  array $template
	 * @return array $template
	 */
	function rt_category_templates( $template ){ 
		
		if ( ! is_tax() || ! class_exists( 'RTTheme' ) ){
			return $template; 
		}

		$term = get_queried_object();

		$template_path = pathinfo( $template );
		$file_name = $template_path["filename"];
		$taxonomy = $term->taxonomy;

		if( ! empty( $file_name ) && $taxonomy == "product_categories" && $file_name == "archive" ){
			$template = array();
			$template[] = 'product-contents/taxonomy-product_categories-' . $term->slug . '.php'; 
			$template[] = 'product-contents/taxonomy-product_categories.php';
			$template = locate_template( $template );
		}

		if( ! empty( $file_name ) && $taxonomy == "portfolio_categories" && $file_name == "archive" ){
			$template = array();
			$template[] = 'portfolio-contents/taxonomy-portfolio_categories-' . $term->slug . '.php'; 
			$template[] = 'portfolio-contents/taxonomy-portfolio_categories.php';
			$template = locate_template( $template );
		}
	/*
			if( ! empty( $file_name ) && $taxonomy == "testimonial_categories" && $file_name == "archive" ){
				$template = array();
				$template[] = 'testimonial-contents/taxonomy-testimonial_categories-' . $term->slug . '.php'; 
				$template[] = 'testimonial-contents/taxonomy-testimonial_categories.php';
				$template = locate_template( $template );
			}
	*/
		return $template;
	}
}
add_filter( 'template_include', 'rt_category_templates');


if( ! function_exists("rt_single_templates") ){
	/**
	 * Change the portfolio & product single template paths
	 * @param  array $template
	 * @return array $template
	 */	
	function rt_single_templates( $template ){
 
		if ( ! is_single() || ! class_exists( 'RTTheme' )  ){
			return $template; 
		}

		global $rt_post_type;

		$template_path = pathinfo( $template );
		$file_name = $template_path["filename"];
		 

		if( ! empty( $rt_post_type ) && $rt_post_type == "products" && ! empty( $file_name ) && $file_name == "single"){ 
			$template = locate_template( '/product-contents/single-products.php', false );
		} 

		if( ! empty( $rt_post_type ) && $rt_post_type == "portfolio" && ! empty( $file_name ) && $file_name == "single"){
			$template = locate_template( '/portfolio-contents/single-portfolio.php', false );
		} 

		if( ! empty( $rt_post_type ) && $rt_post_type == "staff" && ! empty( $file_name ) && $file_name == "single"){
			$template = locate_template( '/staff-contents/single-content.php', false );
		}
	 
		return $template;
	}
}
add_filter( 'template_include', 'rt_single_templates' );


if( ! function_exists("rt_get_pages") ){
	/**
	 * Get Pages as array
	 * @return array $rt_getpages
	 */
	function rt_get_pages(){

		// Pages		
		$pages = query_posts('posts_per_page=-1&post_type=page&orderby=title&order=ASC');
		$rt_getpages = array();
		
		if(is_array($pages)){
			foreach ($pages as $page_list ) {
				$rt_getpages[$page_list->ID] = $page_list ->post_title;
			}
		}
		
		wp_reset_query();
		return $rt_getpages; 
	}
}

if( ! function_exists("rt_get_categories") ){
	/**
	 * Get Blog Categories - only post categories
	 * @return array $rt_getcat
	 */
	function rt_get_categories(){

		if( ! taxonomy_exists("category") ){
			return array();
		}

		// Categories
		$args = array(
			'type'                     => 'post',
			'child_of'                 => 0, 
			'orderby'                  => 'name',
			'order'                    => 'ASC',
			'hide_empty'               => 1,
			'hierarchical'             => 1,  
			'taxonomy'                 => 'category',
			'pad_counts'               => false
			);
		
		
		$categories = get_categories($args);
		$rt_getcat = array();
		
		if(is_array($categories)){
			foreach ($categories as $category_list ) {
				$rt_getcat[$category_list->cat_ID] = $category_list->cat_name;
			}
		}

		return $rt_getcat;
	}
}

if( ! function_exists("rt_get_woo_product_categories") ){
	/**
	 * Get Woo Product Categories 
	 * @return array $rt_product_getcat;
	 */
	function rt_get_woo_product_categories(){

		if( ! taxonomy_exists("product_cat") ){
			return array();
		}

		// Product Categories		
		$product_args = array(
			'type'                     => 'post',
			'child_of'                 => 0, 
			'orderby'                  => 'name',
			'order'                    => 'ASC',
			'hide_empty'               => 1,
			'hierarchical'             => 1,  
			'taxonomy'                 => 'product_cat',
			'pad_counts'               => false
			);
		
		
		$product_categories = get_categories($product_args);
		$rt_product_getcat = array();
		
		if(is_array($product_categories)){
			foreach ($product_categories as $category_list ) {
				@$rt_product_getcat[$category_list->slug] = @$category_list->cat_name;
			}
		}
		
		return $rt_product_getcat;
		
	}
}

if( ! function_exists("rt_get_woo_product_category_ids") ){
	/**
	 * Get Woo Product Categories as ID => Cat Name
	 * @return $cat_list
	 */
	function rt_get_woo_product_category_ids(){

		if( ! taxonomy_exists("product_cat") ){
			return array();
		}

		// Product Categories		
		$product_args = array(
			'type'                     => 'post',
			'child_of'                 => 0, 
			'orderby'                  => 'name',
			'order'                    => 'ASC',
			'hide_empty'               => 1,
			'hierarchical'             => 1,  
			'taxonomy'                 => 'product_cat',
			'pad_counts'               => false
			);
		
		
		$product_categories = get_categories($product_args);
		$cat_list = array();
		
		if ( class_exists( 'Woocommerce' ) ) { 

			if(is_array($product_categories)){
				foreach ($product_categories as $category_list ) {
					$cat_list[$category_list->cat_ID] = $category_list->cat_name;
				}
			}
		}
		
		return $cat_list;
	}	
}

if( ! function_exists("rt_get_product_categories_with_slugs") ){
	/**
	 * Get Product Categories - only product categories with slugs
	 * @return [type] [descriptarray
	 */
	function rt_get_product_categories_with_slugs(){

		if( ! taxonomy_exists("product_categories") ){
			return array();
		}

		// Product Categories		
		$product_args = array(
			'type'                     => 'post',
			'child_of'                 => 0, 
			'orderby'                  => 'name',
			'order'                    => 'ASC',
			'hide_empty'               => 1,
			'hierarchical'             => 1,  
			'taxonomy'                 => 'product_categories',
			'pad_counts'               => false
			);
		
		$product_categories = get_categories($product_args);
		$rt_product_getcat = array();
		
		if(is_array($product_categories)){
			foreach ($product_categories as $category_list ) {
				@$rt_product_getcat[$category_list->slug] = @$category_list->cat_name;
			}
		}
		
		return $rt_product_getcat;
	}	
}

if( ! function_exists("rt_get_product_categories") ){
	/**
	 * Get Product Categories - only product categories with cat IDs
	 * @return [type] [descriptarray
	 */
	function rt_get_product_categories( $parent_ID = 0, $hierarchical_list = false, $depthcount = 1  ){

		if( ! taxonomy_exists("product_categories") ){
			return array();
		}

		// Product Categories		
		$product_args = array(
			'type'         => 'post',
			'child_of'     => 0, 
			'orderby'      => 'name',
			'order'        => 'ASC',
			'hide_empty'   => 0,
			'hierarchical' => 1,  
			'taxonomy'     => 'product_categories',
			'pad_counts'   => false,
			'parent'       => $parent_ID
			);
		
		
		$product_categories = get_categories($product_args);
		$rt_product_getcat = array();
		
		if(is_array($product_categories)){
			foreach ($product_categories as $category_list ) {

				//space
				$space = "";

				for ($i=1; $i < $depthcount ; $i++) { 
					$space .= "-";
				}

				$rt_product_getcat[$category_list->cat_ID] = $space . @$category_list->cat_name . " ($category_list->category_count)";

				//look sub categories  
				$rt_product_getcat = $rt_product_getcat + rt_get_product_categories( $category_list->cat_ID, true , $depthcount+1 );

				//reset depth count
				$depthcount =  isset( $category_list->category_parent ) && intval( $category_list->category_parent ) > 0 ? $depthcount : 1;

			}
		}
		
		return $rt_product_getcat;
	}	
}

if( ! function_exists("rt_get_portfolio_categories") ){
	/**
	 * Get Portfolio Categories
	 * @return [type] [descarray
	 */
	function rt_get_portfolio_categories(){

		if( ! taxonomy_exists("portfolio_categories") ){
			return array();
		}

		// Product Categories		
		$product_args = array(
			'type'                     => 'post',
			'child_of'                 => 0, 
			'orderby'                  => 'name',
			'order'                    => 'ASC',
			'hide_empty'               => 1,
			'hierarchical'             => 1,  
			'taxonomy'                 => 'portfolio_categories',
			'pad_counts'               => false
			);
		
		
		$portfolio_categories = get_categories($product_args);
		$rt_portfolio_getcat = array(); 

		if(is_array($portfolio_categories)){
			foreach ($portfolio_categories as $category_list ) {
				$rt_portfolio_getcat[$category_list->cat_ID] = $category_list->cat_name;
			}
		}
		
		return $rt_portfolio_getcat;
	}	
}

if( ! function_exists("rt_get_testimonial_categories") ){
	/**
	 * Get Testimonial Categories
	 * @return array $rt_testimonial_getcat
	 */
	function rt_get_testimonial_categories(){

		if( ! taxonomy_exists("testimonial_categories") ){
			return array();
		}

		// Product Categories		
		$args = array(
			'type'                     => 'post',
			'child_of'                 => 0, 
			'orderby'                  => 'name',
			'order'                    => 'ASC',
			'hide_empty'               => 1,
			'hierarchical'             => 1,  
			'taxonomy'                 => 'testimonial_categories',
			'pad_counts'               => false
			);
		
		
		$testimonial_categories = get_categories($args);
		$rt_testimonial_getcat = array(); 

		if(is_array($testimonial_categories)){
			foreach ($testimonial_categories as $category_list ) {
				$rt_testimonial_getcat[$category_list->cat_ID] = $category_list->cat_name;
			}
		}
		
		return $rt_testimonial_getcat;
	}	
}

if( ! function_exists("rt_get_products") ){
	/**
	 * Get Products
	 * @return array $rt_get_product 
	 */
	function rt_get_products(){

		
		$products  = query_posts('posts_per_page=-1&post_type=products&orderby=title&order=ASC'); // Products 
		$rt_get_product= array();

		if(is_array($products)){
			foreach ($products as $post_list ) {	// add product posts to the list
				$rt_get_product[$post_list->ID] = $post_list ->post_title;
			}
		}
		
		wp_reset_query();
		return $rt_get_product;
	}	
}

if( ! function_exists("rt_get_staff_list") ){
	/**
	 * Get Staff List
	 * @return array $staff_array 
	 */
	function rt_get_staff_list(){
		
		$staff_query  = query_posts('posts_per_page=-1&post_type=staff&orderby=title&order=ASC'); // Products 
		$staff_array = array();

		if(is_array($staff_array)){
			foreach ($staff_query as $staff ) {	// add product posts to the list
				$staff_array[$staff->ID] = $staff->post_title;
			}
		}
		
		wp_reset_query();
		return $staff_array;
	}	
}

if( ! function_exists("rt_get_testimonial_list") ){
	/**
	 * Get Testimonial List
	 * @return array $testimonial_array;
	 */
	function rt_get_testimonial_list(){
		
		$testimonial_query  = query_posts('posts_per_page=-1&post_type=testimonial&orderby=title&order=ASC'); // Products 
		$testimonial_array = array();

		if(is_array($testimonial_array)){
			foreach ($testimonial_query as $testimonial ) {	// add product posts to the list
				$testimonial_array[$testimonial->ID] = __("Testimonial","rt_theme_admin") . ' - ' . $testimonial->ID;
			}
		}
		
		wp_reset_query();
		return $testimonial_array;
	}	
}



if( ! function_exists("rt_find_image_org_path") ){
	/**
	 * Find image orginal path
	 * gets orginal paths of images when multi site mode active
	 * @param string $image
	 * @return string $image
	 */
	function rt_find_image_org_path($image) {
		if(is_multisite()){
			global $blog_id;
			if (isset($blog_id) && $blog_id > 0) {
				if(strpos($image, esc_url( home_url() ) )!==false){//image is local 
					if(empty(get_current_site(1)->path)){
						$the_image_path = get_current_site(1)->path.str_replace(get_blog_option($blog_id,'fileupload_url'),get_blog_option($blog_id,'upload_path'),$image);
					}else{
						$the_image_path = $image;
					}				
				}else{
					$the_image_path = $image;
				}
			}else{
				$the_image_path = $image;
			}
		}else{
			$the_image_path = $image;
		} 

		return rt_clean_thumbnail_ext($the_image_path);
	}
}


if( ! function_exists("rt_get_nav_menus") ){
	/**
	 * Get nav menus
	 * gets navigation menus as an array pair slug=>name
	 * @return array
	 */
	 function rt_get_nav_menus(){
		
		$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );

		$menus_array = array();
		
		if(is_array($menus)){
			foreach ($menus as $menu ) {
				$menus_array[$menu->slug] = $menu->name;
			}
		}
		
		return $menus_array;
	}	
} 

?>