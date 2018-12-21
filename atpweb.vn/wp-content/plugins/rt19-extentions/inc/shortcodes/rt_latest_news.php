<?php
if( ! function_exists("rt_latest_news") ){
	/**
	 * Latest News Shortcode
	 * @param  array $atts 
	 * @param  string $content
	 * @return html $output
	 */
	function rt_latest_news( $atts = array(), $content = null ) { 

		global $rt_post_values, $rt_blog_list_atts;   

		//defaults
		$atts = shortcode_atts( array(  
			"id"  => "", 
			"image_width" => 250,
			"image_height" => 250,
			"list_orderby" => "date",
			"list_order" => "DESC",
			"max_item"=> 10,
			"categories" => "", 
			"excerpt_length" => 100,
			"style" => 1,
			"show_dates" => false
		), $atts);

		extract($atts); 

		//id attr
		$id_attr = ! empty( $id ) ? 'id="'.$id.'"' : "";

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

		$output = "";

		//get posts
		if ( $wp_query->have_posts() ){ 
			
			//the loop
			while ( $wp_query->have_posts() ) : $wp_query->the_post();
 

				$post_title        = get_the_title();
				$link              = get_permalink();
				$date              = get_the_time('d M Y');
				$comment_count     = get_comment_count( $wp_query->post->ID );
				$featured_image_id = get_post_thumbnail_id(); 
				$get_the_excerpt   = ($excerpt_length > 0) ? '<p>'.wp_html_excerpt(get_the_excerpt(),$excerpt_length).'...</p>' : "" ;						

				// Create thumbnail image
				$thumbnail_image_output = ! empty( $featured_image_id ) ? get_resized_image_output( array( "image_url" => "", "image_id" => $featured_image_id, "w" => $image_width, "h" => $image_height, "crop" => "true", "class"=>"posts-image" ) ) : ""; 

				if ( empty( $thumbnail_image_output ) || ! empty( $show_thumbnails ) ) {
					$thumbnail_image_output = "";
				} 

				if ( $style == 1 ) {

					/**
					 * Output Style 1
					 */
					$output .= '<article>'."\n";

					$output .= sprintf( '
					<div class="date">
						<span class="day">%1$s</span>
						<span class="year">%2$s %3$s</span>
					</div>
					'."\n", get_the_time("d"), get_the_time("M"), get_the_time("y") );

					$output .= sprintf( '
					<div class="text">
						<h5 class="clean_heading"><a class="title" href="%1$s" title="%2$s" rel="bookmark">%2$s</a></h5>
						%3$s
					</div>
					'."\n",$link, $post_title, $get_the_excerpt );

					$output .= '</article>'."\n";

				}else{

					/**
					 * Output Style 2
					 */
					$output .= '<article>'."\n";

					$output .= ! empty( $thumbnail_image_output ) ?  sprintf( ' <figure>%1$s</figure> '."\n", $thumbnail_image_output ) : "";

					$date = ! empty( $show_dates ) ? '<span class="date">'.get_the_date().'</span>' : "";					

					$output .= sprintf( '
					<div class="text">
						%3$s
						<h5 class="clean_heading"><a class="title" href="%1$s" title="%2$s" rel="bookmark">%2$s</a></h5>						
						%4$s
					</div>
					'."\n",$link, $post_title, $date, $get_the_excerpt );

					$output .= '</article>'."\n";
				}
						
			endwhile;  
 
 			//reset post data for the new query
			wp_reset_postdata(); 	 

		}


		//create holder html
		$output = ! empty( $output) ? '<section class="latest_news clearfix style-'.$style.'">'.$output.'</section>' : "";

		return $output;
	}
}

add_shortcode('rt_latest_news', 'rt_latest_news'); 
