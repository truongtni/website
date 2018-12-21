<?php
/**
 *
 * Fallback functions for other themes
 *
 * @author 	RT-Themes
 */

if( ! function_exists("rt_create_image_carousel") ){
	/**
	 * Create a carousel from the provided images
	 *
	 * @since 1.0
	 * 
	 * @param  array $rt_gallery_images  
	 * @param  string $id  
	 * @return output html
	 */
	function rt_create_image_carousel( $atts = array() ){

		//defaults
		extract(shortcode_atts(array(  
			"id"  => 'carousel-'.rand(100000, 1000000),   
			"crop" => false, 	   
			"h" => 10000,
			"w" =>  10000,
			"rt_gallery_images" => array(),
			"column_width" => "1/1",
			"carousel_atts" => array(),
			"echo" => true,
			"lightbox" => "true"			
		), $atts));

		//slider id
		$slider_id = "slider-".$id; 

		//crop
		$crop = ($crop === "false") ? false : $crop;	

		//image dimensions for product image slider
		$w = empty( $w ) ? rt_get_min_resize_size( $column_width ) : $w;

		//height		
		if( empty( $h ) ){
			$h = $crop ? $w / 1.5 : 10000;	
		}

		//create slides and thumbnails outputs
		$output  = array();

		foreach ($rt_gallery_images as $image) { 								 

			// Resize Image
			$image_output = is_numeric( $image ) ? rt_get_image_data( array( "image_id" => trim($image), "w" => $w, "h" => $h, "crop" => $crop )) : rt_get_image_data( array( "image_url" => trim($image), "w" => $w, "h" => $h, "crop" => $crop ) ); 	

			if( $lightbox != "false" ){
				
				//create lightbox link
				$output[] = rt_create_lightbox_link(
					array(
						'class'            => 'imgeffect zoom lightbox_',
						'href'             => $image_output["image_url"],
						'title'            => __('Enlarge Image','rt_theme'),
						'data_group'       => $slider_id,
						'data_title'       => $image_output["image_title"],
						'data_description' => $image_output["image_caption"],
						'data_thumbnail'   => $image_output["lightbox_thumbnail"],
						'echo'             => false,
						'inner_content'    => sprintf('<img src="%s" alt="%s" itemprop="image">',$image_output["thumbnail_url"], $image_output["image_alternative_text"] )
					)
				);

			}else{
				$output[] = sprintf('<img src="%s" alt="%s" itemprop="image">',$image_output["thumbnail_url"], $image_output["image_alternative_text"] );
			}

		}

		//create slider
		if($echo){
			echo rt_create_carousel( $output, $carousel_atts );
		}else{
			return rt_create_carousel( $output, $carousel_atts );
		}

	}
}
add_action( "rt_create_image_carousel", "rt_create_image_carousel", 10, 1 );


if( ! function_exists("rt_get_image_data") ){
	/**
	 * Get data of a resized image
	 * @param  array $args
	 * @return array      
	 */
	function rt_get_image_data($args){
		global $post;  
	   
		//args
		extract(shortcode_atts(array(  
			"image_id"  => "", 
			"image_url"  => "", 
			"w" => "",
			"h" => "",
			"crop" => false 
		), $args));


		//save the global post if any
		$save_post = $post;

		//find post id from src 
		if ( empty( $image_id ) && ! empty( $image_url ) ){
			$image_id = rt_get_attachment_id_from_src($image_url);			

		}

		//get the post attachment
		$attachment = ! empty ( $image_id ) ? get_post( $image_id ) : false ;	

		if( $attachment ){

			//attachment data
			$image_title =  $attachment->post_title;			
			$image_caption =  $attachment->post_excerpt;			
			$image_description =  $attachment->post_content;			
			$image_alternative_text = get_post_meta( $image_id , '_wp_attachment_image_alt', true);		

			//image url - if not provided
			$orginal_image_url = empty( $image_url ) ? $attachment->guid : $image_url ;
 
			//resized img src - resize the image if $w and $h suplied 
			$thumbnail_url = ( ! empty( $w ) && ! empty( $h ) ) ? rt_vt_resize( $image_id, '', $w, $h, $crop ) : $orginal_image_url;	
			$thumbnail_url = is_array( $thumbnail_url ) ? $thumbnail_url["url"] : $thumbnail_url ;
	 
			// Tiny image thumbnail for lightbox gallery feature
			$lightbox_thumbnail = rt_vt_resize( $image_id, '', 75, 50, true ); 
			$lightbox_thumbnail = is_array( $lightbox_thumbnail ) ? $lightbox_thumbnail["url"] : $thumbnail_url ;		
		}


		//give back the global post
		$post = $save_post; 


		if( $attachment ){
			//output
			return array(
				"image_title"   => $image_title, 
				"image_caption" => $image_caption, 
				"image_alternative_text" => $image_alternative_text,
				"image_url" => $orginal_image_url,
				"thumbnail_url" => $thumbnail_url,
				"lightbox_thumbnail" => $lightbox_thumbnail
			);			
		}else{

			//output
			return array(
				"image_title"   => "", 
				"image_caption" => "", 
				"image_alternative_text" => "",
				"image_url" => $image_url,
				"thumbnail_url" => $image_url,
				"lightbox_thumbnail" => $image_url
			);			
		}

	}
}

if( ! function_exists("rt_create_lightbox_link") ){
	/**
	 * Create a link for lightbox
	 * @param  array $args
	 * @return html      
	 */
	function rt_create_lightbox_link($atts){

		//defaults
		extract(shortcode_atts(array(  
			"id"  => 'lightbox-'.rand(100000, 1000000), 
			"title" => "",
			"href" => "",
			"class" => "",
			"data_group" => "",
			"data_thumbnail" => "",
			"data_thumbTooltip" => "",
			"data_title" => "", 
			"data_description" => "", 
			"data_scaleUp" => "", 
			"data_href" => "", 
			"data_width" => "", 
			"data_height" => "", 
			"data_flashHasPriority" => "", 
			"data_poster" => "", 
			"data_autoplay" => "", 
			"data_audiotitle" => "", 
			"inner_content" => "",
			"tooltip" => false,
			"echo"=> true
		), $atts));

		//description id
		$data_description_id = ! empty( $data_description ) ? '#'.$id.'-description' : "";

		//description output
		$data_description_output = ! empty( $data_description ) ? sprintf('
			<div class="jackbox-description" id="%s-description">        
				<h3>%s</h3>
				%s
			</div>',
		$id, $data_title, $data_description) : "";

		//tooltip
		$tooltip = $tooltip == "true" ? ' data-placement="top" data-toggle="tooltip"' : "";

		//output
		$lightbox_link = sprintf(
			'<a id="%s" class="%s" data-group="%s" title="%s" data-title="%s" data-description="%s" data-thumbnail="%s" data-thumbTooltip="%s" data-scaleUp="%s" data-href="%s" data-width="%s" data-height="%s" data-flashHasPriority="%s" data-poster="%s" data-autoplay="%s" data-audiotitle="%s" href="%s" %s>%s</a>%s',
			$id,
			$class,
			$data_group,
			$title,
			$data_title,
			$data_description_id,
			$data_thumbnail,
			$data_thumbTooltip,
			$data_scaleUp,
			$data_href,
			$data_width,
			$data_height,
			$data_flashHasPriority,
			$data_poster,
			$data_autoplay,
			$data_audiotitle,
			$href,
			$tooltip,
			$inner_content,
			$data_description_output
		);

		//echo 
		echo ( $echo ) ? $lightbox_link : "";

		return $lightbox_link;
	}
}
add_action( "create_lightbox_link", "rt_create_lightbox_link", 10, 1 );

if( ! function_exists("get_resized_image_output") ){
	/**
	 * Get html output of a resized image
	 * @param  array $atts
	 * @return html 
	 */
	function get_resized_image_output( $atts = array() ){

		//defaults
		extract(shortcode_atts(array(  
			"image_url" => "", 	   
			"image_id" => "", 	   
			"w" => "", 	   
			"h" => "", 	   
			"crop" => false,
			"class" => ""
		), $atts)); 

		
		if ( empty( $image_id ) && empty( $image_url ) ){
			return false;
		}else{

			$image_id = empty( $image_id ) && ! empty( $image_url ) ? rt_get_attachment_id_from_src( $image_url ) : $image_id ;

			$image_thumb = ! empty( $image_id ) ? rt_vt_resize( $image_id, '', $w, $h, $crop ) : rt_vt_resize( '', $image_url, $w, $h, $crop );

			$image_alternative_text = ! empty( $image_id ) ? get_post_meta($image_id, '_wp_attachment_image_alt', true) : "";		

			$image_output = is_array($image_thumb) ? '<img src="'.$image_thumb['url'].'" alt="'.$image_alternative_text.'" class="'.$class.'" />' : "";	

			return $image_output;
		}
	}
}

if( ! function_exists("rt_get_image_output") ){
	/**
	 * Get html output of an image
	 * @param  array $atts
	 * @return html 
	 */	
	function rt_get_image_output( $atts = array() ){

		//defaults
		extract(shortcode_atts(array(  
			"image_url" => "", 	   
			"image_id" => "", 	   
			"class" => "",
			"id" => ""
		), $atts)); 
		
		if ( empty( $image_id ) && empty( $image_url ) ){
			return false;
		}else{

			//find img id from src 
			if ( empty( $image_id ) && ! empty( $image_url ) ){
				$image_id = rt_get_attachment_id_from_src($image_url);
			}

			//image alt texx
			$image_alternative_text = ! empty( $image_id ) ? get_post_meta($image_id, '_wp_attachment_image_alt', true) : "";		

			//image src
			$image_src = ! empty( $image_id ) ? rt_get_attachment_image_src( $image_id ) : $image_url;

			//if img src couldn't found return false
			if( ! $image_src ){
				return ;
			}
	 	
	 		//image id attr
			$id = ! empty( $id ) ? 'id="'.$id.'"' : "";

			//the output
			$image_output = '<img '.$id.' itemprop="image" src="'.$image_src.'" alt="'.$image_alternative_text.'" class="'.$class.'" />';	

			return $image_output;
		}
	}
}

if( ! function_exists("rt_create_carousel") ){
	/**
	 * Creates a carousel
	 *
	 * @since 1.0
	 * 
	 * @param  array $contents
	 * @param  string $id  
	 * @return output
	 */
	function rt_create_carousel( $contents = array(), $atts = array() ){
 
		//defaults
		extract(shortcode_atts(array(  
			"id"  => 'slider-'.rand(100000, 1000000), 
			"item_width"  => 4, 
			"class" => "",
			"dots" => "false",
			"nav" => "true",
			"margin" => 15,
			"autoplay" => "false"
		), $atts));

		//id
		$id = "slider-".$id;
	
		$output = $contents_output  = "";

		//create carousel items
		foreach ( $contents as $content ) {
			$contents_output .= sprintf('<div>%s</div>',$content);
		} 

		//dots holder
		$dots_holder = ( $dots == "true" ) ? sprintf('
				<div id="%1$s-dots" class="dots-holder">
				</div>
			', $id) : "";


		//create final output
		$output = sprintf('
				<div id="%1$s" class="rt-carousel carousel-holder clearfix %2$s" data-item-width="%4$s" data-nav="%5$s" data-dots="%6$s" data-margin="%8$s" data-autoplay="%9$s">
					<div class="owl-carousel">
						%3$s
					</div>
					%7$s
				</div>
			', $id, $class, $contents_output, $item_width, $nav, $dots, $dots_holder, $margin, $autoplay); 		
  
		return $output;
	}
}

if( ! function_exists("rt_create_photo_gallery") ){
	/**
	 * Create photo gallery 
	 * by using provided image urls as an array
	 * 
	 * @param  array $atts 
	 * @return output
	 */
	function rt_create_photo_gallery( $atts ){

		//defaults
		extract(shortcode_atts(array(  
			"gallery_id"  => 'gallery-'.rand(100000, 1000000),   
			"crop" => false, 	   
			"h"	 => "",
			"image_urls" => array(),
			"image_ids" => array(),
			"lightbox" => false,
			"captions" => true,
			"item_width" => "1/6",
			"layout_style" => "grid"
		), $atts));

		//item width percentage
		$item_width = ! empty( $item_width ) ? $item_width : "1/3";

		//image array
		$image_array = ! empty( $image_urls ) ? $image_urls : $image_ids ;

		//create values
		$items_output = $caption_output = $lightbox_link = $image_effect = ""; 

		// Thumbnail width & height
		$w = rt_get_min_resize_size( $item_width );
		
		if( empty( $h ) ){
			$h = $crop ? $w / 1.5 : 10000;	
		}

		//layout style
		$add_holder_class = $item_width == "1/1" ? "" : ( $layout_style == "grid" ? " border_grid fixed_heights" : " masonry" ) ;

		//add column class
		$add_column_class = rt_column_class( $item_width );
		$add_column_class .= $layout_style == "masonry" ? " isotope-item" : "";
		
		//row count
		$column_count = rt_column_count( $item_width );

		//item counter
		$counter = 1;

		foreach ($image_array as $image) { 								 

			// Get image data
			$image_args = array( 
				"image_url" => "",
				"image_id" => "",
				"w"=> $w,
				"h"=> $h,
				"crop" => $crop,
			);

			if( ! empty( $image_urls ) ){
				$image_args["image_url"] = $image ;
			}else{
				$image_args["image_id"] = $image ;
			}

			$image_data = rt_get_image_data( $image_args );   


			//create image html output
			if( $lightbox ){

				$image_output = rt_create_lightbox_link(
					array(
						'class' => 'lightbox_ zoom imgeffect',
						'href' => $image_data["image_url"],
						'title' => __('Enlarge Image','rt_theme'),
						'data_group' => $gallery_id,
						'data_title' => $image_data["image_title"],
						'data_description' => $image_data["image_caption"],
						'data_thumbnail' => $image_data["lightbox_thumbnail"],
						'echo' => false,
						'inner_content' => sprintf('<img src="%s" alt="%s">',$image_data["thumbnail_url"], $image_data["image_alternative_text"])
					)
				);

			}else{

				$image_output = sprintf('<img src="%s" alt="%s">',$image_data["thumbnail_url"], $image_data["image_alternative_text"] );

			}


			//create caption
			$caption_output = $captions && ! empty( $image_data["image_caption"] ) ? sprintf('
				<p class="gallery-caption-text">%s</p>
			', $image_data["image_caption"] ) : "";
		

			//open row block
			if(  $layout_style != "masonry" && $item_width != "1/1" && ( $counter % $column_count == 1 || $column_count == 1 ) ){
				$items_output .= '<div class="row clearfix">'."\n";
			}	

				//list items output
				$items_output .= sprintf('
					<div class="col %s">
						%s
						%s 	
					</div>
				', $add_column_class, $image_output, $caption_output);


			//close row block
			if( $layout_style != "masonry" && $item_width != "1/1" && ( $counter % $column_count == 0 || count($image_array) == $counter ) ){
				$items_output .= '</div>'."\n";  
			}

		$counter++;
		}

		//the gallery holder output
		$gallery_holder_output = sprintf('
			<div class="photo_gallery clearfix %s" id="%s" data-column-width="%s">%s</div> 
		',$add_holder_class, $gallery_id, $column_count, $items_output ); 

		echo $gallery_holder_output; 
	}
}
add_action( "create_photo_gallery", "rt_create_photo_gallery", 10, 1 );

if( ! function_exists("rt_ajax_loader") ){
	/**
	 * Load ajax products
	 *
	 * @since 1.0
	 * 
	 * @param  array $atts 
	 * @return output
	 */

	function rt_ajax_loader( $atts = array() )
	{
		$atts = unserialize(base64_decode( sanitize_text_field($_POST["atts"]) ) );
		$page = sanitize_text_field( $_POST["page"] );
		$atts["paged"] = $page;
		$atts["wpml_lang"] = $_POST["wpml_lang"];


		//current lang
		if( isset( $_POST["wpml_lang"] ) && ! empty( $_POST["wpml_lang"] ) ){
			global $sitepress;
			$sitepress->switch_lang( sanitize_text_field($_POST['wpml_lang']), true);
			load_theme_textdomain('rt_theme', get_template_directory().'/languages' );
		}

		//conditional contens
		if( $atts["purpose"] == "products" ){
			echo rt_product_post_loop( array(), $atts );	
		}elseif( $atts["purpose"] == "portfolio" ){
			echo rt_portfolio_post_loop( array(), $atts );				
		}else{
			echo rt_blog_post_loop( array(), $atts ); 
		}
		
		die();
	}
}
add_action( 'wp_ajax_rt_ajax_loader', 'rt_ajax_loader' );
add_action( 'wp_ajax_nopriv_rt_ajax_loader', 'rt_ajax_loader' );

if( ! function_exists("rt_get_ajax_loader_button") ){
	/**
	 * Get ajax load more button
	 *
	 * @since 1.0
	 * 
	 * @param  array $atts 
	 * @return output
	 */

	function rt_get_ajax_loader_button( $atts = array(), $page_count = 0 )
	{
		printf('<button href="#" class="load_more button_ medium default aligncenter" autocomplete="off" data-atts="%1$s" data-page_count="%2$s" data-current_page="%3$s" data-listid="%5$s"><span class="icon-angle-double-down"></span>%4$s</button>',
				base64_encode(serialize( $atts )),
				$page_count,
				1,
				__("LOAD MORE","rt_theme"),
				$atts["id"]
			);
	}
}

if( ! function_exists("rt_create_product_image_slider") ){
	/**
	 * Create slider for product images
	 *
	 * @since 1.0
	 * 
	 * @param  array $rt_gallery_images  
	 * @param  string $id  
	 * @return output html
	 */
	function rt_create_product_image_slider( $rt_gallery_images = array(), $id = "", $column_width = 12 ){

		//slider id
		$slider_id = "slider-".$id;


		//image dimensions for product image slider
		$w = rt_get_min_resize_size( $column_width );


		//create slides and thumbnails outputs
		$output  = array();


		foreach ($rt_gallery_images as $image) { 								 

			// Resize Image
			$image_output = is_numeric( $image ) ? rt_get_image_data( array( "image_id" => trim($image), "w" => $w, "h" => 1000, "crop" => "" )) : rt_get_image_data( array( "image_url" => trim($image), "w" => $w, "h" => 1000, "crop" => "" ) ); 	
	 
			//create lightbox link
			$lightbox_link = rt_create_lightbox_link(
				array(
					'class'            => 'icon-zoom-in single lightbox_',
					'href'             => $image,
					'title'            => __('Enlarge Image','rt_theme'),
					'data_group'       => 'group_product_slider',
					'data_title'       => $image_output["image_title"],
					'data_description' => $image_output["image_caption"],
					'data_thumbnail'   => $image_output["thumbnail_url"],
					'echo'             => false
				)
			);

			$output[] .= sprintf('					 
				<div class="imgeffect">								
					%s
					<img src="%s" alt="%s" itemprop="image">
				</div>  
			',$lightbox_link, $image_output["thumbnail_url"], $image_output["image_alternative_text"] );
 
		}
   
		//slider atts
		$atts = array(  
			"id"  => "product-image-carosel", 
			"item_width"  => 1, 
			"class" => "product-image-carosel",
			"nav" => "true",
			"dots" => "false"
		);

		//create slider
		echo rt_create_carousel( $output, $atts );

	}
}
add_action( "rt_product_image_slider", "rt_create_product_image_slider", 10, 3 );

if( ! function_exists("rt_create_image_carousel") ){
	/**
	 * Create a carousel from the provided images
	 *
	 * @since 1.0
	 * 
	 * @param  array $rt_gallery_images  
	 * @param  string $id  
	 * @return output html
	 */
	function rt_create_image_carousel( $atts = array() ){

		//defaults
		extract(shortcode_atts(array(  
			"id"  => 'carousel-'.rand(100000, 1000000),   
			"crop" => false, 	   
			"h" => 10000,
			"w" =>  10000,
			"rt_gallery_images" => array(),
			"column_width" => "1/1",
			"carousel_atts" => array(),
			"echo" => true,
			"lightbox" => "true"			
		), $atts));

		//slider id
		$slider_id = "slider-".$id; 

		//crop
		$crop = ($crop === "false") ? false : $crop;	

		//image dimensions for product image slider
		$w = empty( $w ) ? rt_get_min_resize_size( $column_width ) : $w;

		//height		
		if( empty( $h ) ){
			$h = $crop ? $w / 1.5 : 10000;	
		}

		//create slides and thumbnails outputs
		$output  = array();

		foreach ($rt_gallery_images as $image) { 								 

			// Resize Image
			$image_output = is_numeric( $image ) ? rt_get_image_data( array( "image_id" => trim($image), "w" => $w, "h" => $h, "crop" => $crop )) : rt_get_image_data( array( "image_url" => trim($image), "w" => $w, "h" => $h, "crop" => $crop ) ); 	

			if( $lightbox != "false" ){
				
				//create lightbox link
				$output[] = rt_create_lightbox_link(
					array(
						'class'            => 'imgeffect zoom lightbox_',
						'href'             => $image_output["image_url"],
						'title'            => __('Enlarge Image','rt_theme'),
						'data_group'       => $slider_id,
						'data_title'       => $image_output["image_title"],
						'data_description' => $image_output["image_caption"],
						'data_thumbnail'   => $image_output["lightbox_thumbnail"],
						'echo'             => false,
						'inner_content'    => sprintf('<img src="%s" alt="%s" itemprop="image">',$image_output["thumbnail_url"], $image_output["image_alternative_text"] )
					)
				);

			}else{
				$output[] = sprintf('<img src="%s" alt="%s" itemprop="image">',$image_output["thumbnail_url"], $image_output["image_alternative_text"] );
			}

		}

		//create slider
		if($echo){
			echo rt_create_carousel( $output, $carousel_atts );
		}else{
			return rt_create_carousel( $output, $carousel_atts );
		}

	}
}
add_action( "rt_create_image_carousel", "rt_create_image_carousel", 10, 1 );

if( ! function_exists("rt_column_count") ){

	/**
	 * Column count according fractional number
	 *
	 * @since 1.0
	 * 
	 * @param  string $width 
	 * @return number $count;
	 */
	function rt_column_count( $width = "1/1" ) {

 		$number = explode("/", $width);
 		$number = is_array($number) && isset( $number[1] ) && isset( $number[0] ) && is_numeric( $number[0] ) && is_numeric( $number[1] ) ? $number[1]/$number[0] : 1;
 		$number = is_numeric( $number ) ? $number : 1 ;

		return $number;
	}
}

#
# Check a file exists in the child theme from path 
# @return file url
#
function rt_locate_media_file( $file_path ){
	if ( is_child_theme() ){
		$child_file_path = get_stylesheet_directory() . $file_path ; 

		if ( file_exists( $child_file_path ) ){
			$file_url = get_stylesheet_directory_uri() . $file_path ; 
		}else{
			$file_url = RT_THEMEURI . $file_path ; 
		}
	}else{
		$file_url = RT_THEMEURI . $file_path ; 
	}

	return $file_url;
}

#
# find vimeo and youtube id from url
#
function rt_find_tube_video_id($url){
	$tubeID="";

	if( strpos($url, 'youtube') || strpos($url, 'youtu.be')  ) {	
		$tubeID=parse_url($url);		

		isset( $tubeID['path'] ) && strpos($url, 'http://youtu.be') 
			and $tubeID=str_replace("/", "", $tubeID['path']);	

		isset( $tubeID['query'] ) 
			and parse_str($tubeID['query'], $url_parts);

		isset( $url_parts ) && is_array( $url_parts ) 
			and $tubeID=$url_parts["v"];
	}
	
	if( strpos($url, 'vimeo')  ) {
		$tubeID=parse_url($url, PHP_URL_PATH);			
		$tubeID=str_replace("/", "", $tubeID);	
	}	


	if( is_string( $tubeID ) ) return $tubeID;
}

#
# Check layer slider
#

function rt_check_layer_slider() { 
	if( function_exists( "layerslider_load_lang" ) || function_exists( "layerslider_activation_scripts" ) || function_exists( "layerslider_new_site" ) ) {
		return true;
	}else{
		return false;
	}
}

#
# layer slider slides list 
#
function rt_layer_slider_list() { 

	$get_layer_slider_list = array();

	if( function_exists( "lsSliders" ) ){
		$sliders = lsSliders(200, false, true); 

		if ( rt_check_layer_slider() ){
			if( is_array( $sliders ) ){
				foreach ($sliders as $key => $value) { 
					$get_layer_slider_list[$value["id"]] = $value["name"];  
				}		
			}
		}
	}else{
		$get_layer_slider_list[0] = "Layer Slider has not been installed or activated!";
	}

	return $get_layer_slider_list;		
}

#
# layer revslider slides list 
#

function rt_rev_slider_list() { 
	global $wpdb,$table_prefix;
	
	$get_rev_slider_list = array();

	if( class_exists( "RevSlider" ) ){

		$revslider_sliders = $wpdb->get_results( "SELECT title,alias FROM ".$table_prefix."revslider_sliders" );

		if( isset( $revslider_sliders ) ){
			foreach ($revslider_sliders as $key => $value) {
				$get_rev_slider_list[ $value->alias ] = $value->title;   
			}
		}
	}else{
		$get_layer_slider_list[0] = "Slider Revolution has not been installed or activated!";		
	}

	return $get_rev_slider_list;
}

#
# returns a post ID from a url
#

function rt_get_attachment_id_from_src ($image_src) { 
	global $wpdb; 

	$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
	$id    = $wpdb->get_var($query);
	return $id; 
}

if( ! function_exists("rt_get_attachment_image_src") ){

	/**
	 * Get Attachment Image Source
	 * Returns url of the attachment image by using native WP function
	 * in some shortcode settings the image can be ID or URL. 
	 * This function only works when ID provided
	 *
	 * @since 1.0
	 *
	 * @param  string $image image id or url
	 * @param  string $size  thumbnail width
	 * @return array $url 
	 */
	function rt_get_attachment_image_src( $image = "", $size = "full" ) {

		$url = is_numeric(trim($image)) ? wp_get_attachment_image_src( $image, $size ) : $image ;
		$url = is_array( $url ) ? $url[0] : $url ;	

		return $url;
	}
}

#
# find orginal image url - clean thumbnail extensions
#

function rt_clean_thumbnail_ext ($image_src) { 
	$search = '#-\d+x\d+#';  
	return preg_replace($search, "", $image_src);
}

#
# generate shortcode function
#
function rt_generate_shortcode($class,$shorcode_name=""){

	$shorcode_name = !empty( $shorcode_name ) ? $shorcode_name : $class->content_type;

	$template_shortcode ='['.$shorcode_name.' ';
	foreach ($class as $key => $value) {
		$template_shortcode  .= $key.'="'.$value.'" ';
	}

	return $template_shortcode.']';	
}


#
# Remove slashes from strings, arrays and objects
#
if( ! function_exists("rt_stripslashesFull") ){
	function rt_stripslashesFull($input){
		if (is_array($input)) {
			$input = array_map('rt_stripslashesFull', $input);
		} elseif (is_object($input)) {
			$vars = get_object_vars($input);
			foreach ($vars as $k=>$v) {
				$input->{$k} = rt_stripslashesFull($v);
			}
		} else {
			$input = stripcslashes($input);
		}
		return $input;
	}
}


if( ! function_exists("rt_wpml_t") ){
	/**
	 * WPML Get Registered String
	 * Get string translation of a theme mod value
	 * @return string 
	 */
	function rt_wpml_t($name="", $field="", $value=""){
		if(function_exists('icl_translate')) {			
			return apply_filters( 'wpml_translate_single_string', $value, $field, $name );
		}

		return $value;
	}
}

if( ! function_exists("rtframework_get_sidebar_list") ){
	/**
	 * Get registered sidebars
	 * @return bool | array
	 */
	 function rtframework_get_sidebar_list(){

		global $wp_registered_sidebars;

		$sidebar_array = array();

		if( ! isset( $wp_registered_sidebars ) || empty( $wp_registered_sidebars ) ){
			return false;
		}

		foreach ($wp_registered_sidebars as $sidebar_id => $val) {			
			$sidebar_array[ $val["id"] ] = $val["name"];
		}

		return $sidebar_array;
	}	
} 

if( ! function_exists("rtframework_convert_bool") ){
	/**
	 * Converts the bools, 1/0 or on/off to string true false 
	 * @return output
	 */
	function rtframework_convert_bool( $string ){ 

		if( ! $string || $string === "false" || $string == "false" || $string == "0" || $string == "off" || $string == "" ){
			return "false";
		}

		if( $string || $string === "true" || $string == "true" || $string == "1" || $string == "on" ){
			return "true";
		}

		return $string;

	}
}