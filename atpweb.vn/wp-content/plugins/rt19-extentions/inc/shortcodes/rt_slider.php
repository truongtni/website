<?php
/**
 *  
 *  Shortcodes for RT Content Slider
 *  
 */

if( ! function_exists("rt_slider") ){
	/**
	 * RT Slider Holder
	 * returns html ouput of the content slider
	 * 
	 * @param  [array] $atts  
	 * @param  [string] $content
	 * @return [string] $output
	 */	
	function rt_slider( $atts, $content = null ) {
		global $rt_slider_min_height;

		//defaults
		extract(shortcode_atts(array(  
			"id"  => 'content-slider-'.rand(100000, 1000000),			
			"min_height" => 300,
			"autoplay" => true,
			"timeout" => 5000,
			"parallax" => false
		), $atts));

		//id
		$id = !empty( $id ) ? sanitize_html_class( $id ) : 'slider-dynamicID-'.rand(100000, 1000000);

		//min height
		$rt_slider_min_height = (double) $min_height;

		//parallax
		$parallax = $parallax === "true" ? "true" : "false";

		//autoplay
		$autoplay = $autoplay === "true" ? "true" : "false";		
		
		//get slides
		ob_start();
		echo (do_shortcode($content));
		$get_slides = ob_get_contents();
		ob_end_clean(); 

		//create the slider holder
		$output = '<div id="'.$id.'" style="min-height:'.$min_height.'px;" class="rt-carousel main-carousel carousel-holder clearfix" data-item-width="1" data-nav="true" data-dots="true" data-parallax="'.$parallax.'" data-timeout="'.$timeout.'" data-autoplay="'.$autoplay.'">'."\n";
		$output .= '<div class="owl-carousel">'."\n";
		$output .= $get_slides;
		$output .= '</div>'."\n";
		$output .= '</div>'."\n";

		return $output;


 	}
}
add_shortcode('rt_slider', 'rt_slider'); 


if( ! function_exists("rt_slide") ){
	/**
	 * RT Slide
	 * returns html ouput of a slide 
	 * 
	 * @param  [array] $atts  
	 * @param  [string] $content
	 * @return [string] $output
	 */	
	function rt_slide( $atts, $content = null ) {
		global $rt_slider_min_height;

		//defaults
		extract(shortcode_atts(array(  
			"class" => '',
			"content_width" => 600,
			"content_wrapper_width" => "default",
			"content_bg_color" => "",
			"content_color_schema" => "", 
			"content_align" =>  "right", 
			'bg_color' => '',
			'bg_image' => '',
			'bg_image_repeat' => '',
			'bg_position' => '',
			'bg_size' => '', 
			'top_margin' => '',
			'link'=> '',
			'link_target'=> '_self',
			'link_title'=> '',
			'padding_top' => '',
			'padding_bottom' => '',
			'padding_left' => '',
			'padding_right' => '',
		), $atts));

		$style_output = $content_style_output = $content_class = "";

		//get slide content
		ob_start();
		echo do_shortcode(rt_visual_composer_content_fix($content));
		$get_slide_content = ob_get_contents();
		ob_end_clean(); 

		//css class
		$class = ! empty( $class ) ? sanitize_html_class( $class ) : "";

		//color schema
		$class .= ! empty( $content_color_schema ) ? " ".sanitize_html_class( $content_color_schema ) : "";

		//bg values
		if( ! empty( $bg_image ) ){
			 
			$bg_image = rt_get_attachment_image_src($bg_image); 		
 
			//background image
			$style_output  .= 'background-image: url('.$bg_image.');';
			
			//background repeat
			$style_output  .= ! empty( $bg_image_repeat ) ? 'background-repeat: '.$bg_image_repeat.';': "";

			//background size
			$style_output  .= ! empty( $bg_size ) ? 'background-size: '.$bg_size.';': "";

			//background attachment
			//$style_output  .= ! empty( $bg_attachment ) ? 'background-attachment: '.$bg_attachment.';': "";

			//background position
			$style_output  .= ! empty( $bg_position ) ? 'background-position: '.$bg_position.';': "";		

			$class .= " slide-background";
		}	

		//background color
		$style_output  .= ! empty( $bg_color ) ? 'background-color: '.$bg_color.';': "";
		
		//height
		$style_output  .= ! empty( $rt_slider_min_height ) ? 'min-height: '.$rt_slider_min_height.'px;': "";

		//content width 
		$content_style_output  .= ! empty( $content_width ) ? 'width: '.$content_width.'%;': "";

		//content bg color
		$content_style_output  .= ! empty( $content_bg_color ) ? 'background-color: '.$content_bg_color.';': "";

		//content class
		$content_class .= ! empty( $content_align ) ? " ".$content_align: "";

		//content top margin
		$content_style_output  .= ! empty( $top_margin ) ? 'margin-top: '.$top_margin.'px;': "";

		//holder paddings 
		$content_style_output  .= $padding_top != "" ? 'padding-top:'.rtframework_check_unit($padding_top ).';': "";
		$content_style_output  .= $padding_bottom != "" ? 'padding-bottom:'.rtframework_check_unit($padding_bottom ).';': "";
		$content_style_output  .= $padding_left != "" ? 'padding-left:'.rtframework_check_unit($padding_left ).';': "";
		$content_style_output  .= $padding_right != "" ? 'padding-right:'.rtframework_check_unit($padding_right ).';': "";

		//style outputs
		$style_output = ! empty( $style_output ) ? 'style="'.$style_output.'"' : "";
		$content_style_output = ! empty( $content_style_output ) ? 'style="'.$content_style_output.'"' : "";
  
		$link_output = ! empty( $link ) ? '<a href="'.esc_url($link).'" target="'.$link_target.'" title="'.sanitize_text_field( $link_title ).'"></a>' : "";


		return sprintf('
		<div class="item %s" %s>
			%s
			<div class="slide-content-wrapper %s clearfix">
				<div class="slide-content animation %s" %s>					
					%s
				</div>
			</div>
		</div>',
		$class,
		$style_output,		
		$link_output,
		$content_wrapper_width,
		$content_class,	 
		$content_style_output,
		$get_slide_content
		);

 	}
}

add_shortcode('rt_slide', 'rt_slide'); 