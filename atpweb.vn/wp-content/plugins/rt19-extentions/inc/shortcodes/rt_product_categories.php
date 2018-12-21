<?php

if( ! function_exists("rt_product_categories_shortcode") ){
	/**
	 * Product Categories	
	 * @param  array $atts 
	 * @param  string $content
	 * @return output
	 */
	function rt_product_categories_shortcode( $atts = array(), $content = null ) { 

		global $rt_list_atts, $rt_category;

		//defaults
		$rt_list_atts = shortcode_atts( array(  
			"id"                   => '',
			"class"                => '',
			"ids"                  => '',
			"list_layout"          => "1/3",
			"display_titles"       => "true",		
			"display_descriptions" => "true",		
			"display_thumbnails"   => "true",		
			"image_max_height"     => '',
			"crop"                 => '',
			'orderby'              => 'name',
			"order"                => "ACS",
			'parent'               => 0,
			'layout_style'         => ''
		), $atts );

		extract( $rt_list_atts );
		ob_start();
		
		// Product Categories		
		$product_args = array(
			'type'         => 'post',
			'orderby'      => $orderby,
			'order'        => $order,
			'hide_empty'   => 0,
			'hierarchical' => 1,  
			'taxonomy'     => 'product_categories',
			'pad_counts'   => true,
			'include'      => $ids
		);	

		if( ! empty( $parent ) ) {
			$product_args["parent"] = $parent;
		}

		$product_categories = get_categories($product_args);

		//fix true false
		$rt_list_atts["display_titles"] = ! empty( $display_titles ) && $display_titles !== "false" ? "true" : "false";
		$rt_list_atts["display_descriptions"] = ! empty( $display_descriptions ) && $display_descriptions !== "false" ? "true" : "false";
		$rt_list_atts["display_thumbnails"] = ! empty( $display_thumbnails ) && $display_thumbnails !== "false" ? "true" : "false";
		$rt_list_atts["crop"] = ! empty( $crop ) && $crop !== "false" ? "true" : $crop;

		//id attr
		$id = ! empty( $id ) ? 'id="'.sanitize_html_class($id).'"' : "";	 

		//item width percentage
		$list_layout = ! empty( $list_layout ) ? $list_layout : "1/3";

		//column count
		$column_count = rt_column_count( $list_layout );

		//category count
		$post_count = count( $product_categories );

		//layout style
		$add_holder_class = $list_layout == "1/1" ? "" : ( $layout_style == "grid" ? " border_grid fixed_heights" : " masonry" ) ;
		$add_holder_class .= " ".sanitize_html_class( $class );

 		//column class
 		$add_column_class = "product_item_holder ";
 		$add_column_class .= rt_column_class( $list_layout );
		$add_column_class .= $layout_style == "masonry" ? " isotope-item" : "";

		//open the wrapper
		echo "\n".'<div '.$id.' class="product_holder product-showcase product-showcase-categories clearfix '.trim($add_holder_class).'" data-column-width="'. $column_count .'" >'."\n";


		$counter = 1;

		foreach ($product_categories as $key => $category ) {

				$rt_category  = $category;
 
				//open row block
				if(  $layout_style != "masonry" && $list_layout != "1/1" && ( $counter % $column_count == 1 || $column_count == 1 ) ){
					echo '<div class="row clearfix">'."\n";
				}	

					echo $list_layout != "1/1" ? '<div class="col '.$add_column_class.'">'."\n" : "";

					get_template_part( 'product-contents/category-shortcode-content'); 
				
					echo $list_layout != "1/1" ? '</div>'."\n" : "";

						 
				//close row block
				if( $layout_style != "masonry" && $list_layout != "1/1" && ( $counter % $column_count == 0 || $post_count == $counter ) ){
					echo '</div>'."\n";  
				}

			$counter++;


		}

		echo '</div>';	

		$output_string = ob_get_contents();

		ob_end_clean(); 

		return $output_string;


	}
}

add_shortcode('rt_product_categories', 'rt_product_categories_shortcode'); 