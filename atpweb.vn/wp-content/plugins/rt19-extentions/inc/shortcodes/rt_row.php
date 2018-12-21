<?php
if( ! function_exists("rt_row") ){

	/**
	 * rt_row shortcode
	 * 
	 * creates a holder for contents with several background effects and layouts
	 * 
	 * @param  [array] $atts    
	 * @param  [string] $content  
	 */
	function rt_row( $atts, $content = null, $tag = "" ) { 

	extract(shortcode_atts(array(
		'rt_row_background_width' => '',
		'rt_row_content_width' => '',
		'rt_row_height' => '',
		'rt_row_style' => '',
		'rt_bg_color' => '',
		'rt_bg_image' => '',
		'rt_bg_effect' => '',
		'rt_bg_parallax_effect' => '',
		'rt_pspeed' => '',
		'rt_bg_custom_height' => '',
		'rt_bg_custom_alignment' => '',
		'rt_bg_image_repeat' => '',
		'rt_bg_position' => '',
		'rt_bg_size' => '',
		'rt_bg_attachment' => '',
		'rt_row_paddings' => '',
		'rt_padding_top' => '',
		'rt_padding_bottom' => '',
		'rt_padding_left' => '',
		'rt_padding_right' => '',   
		'rt_border_radius_tl' => '',
		'rt_border_radius_tr' => '',
		'rt_border_radius_bl' => '',
		'rt_border_radius_br' => '',   			
		'rt_grid' => "",  
		'rt_equal_heights' => "",
		'rt_overlap' => "",   
		'rt_row_borders' => "",
		'el_class' => '',
		'vc_base' => '',
		'class' => '',
		'id' => '',
		'full_height' => '',
		'columns_placement' => '', 
		'rt_column_placement' => '',
		'rt_bg_overlay_color' => '',
		'rt_bg_video_mp4' => '',
		'rt_bg_video_webm' => '',		
		'rt_bg_video_youtube' => '',		
		'disable_element'=>'',
		'rt_col_anim' => ''
	), $atts));

	if( $disable_element == "yes" ){
		return false;
	}

	$style = $bg_style = $output = $wrapper_style = $wrapper_class = $attr = "";


	$rt_row_background_width = apply_filters( "rt_row_background_width", $rt_row_background_width );
	$rt_row_content_width = apply_filters( "rt_row_content_width", $rt_row_content_width );

	//image id attr
	$id = ! empty( $id ) ? 'id="'.sanitize_html_class($id).'"' : "";

	//el_class
	$class .= ! empty( $el_class ) ? " ".$el_class : "";	

	//row style
	$class .= ! empty( $rt_row_style ) ? " ".$rt_row_style : "";	

	//row background width
	$class .= ! empty( $rt_row_background_width ) ? " ".$rt_row_background_width : "";

	//equal height
	$class .= ! empty( $rt_equal_heights ) && $rt_equal_heights == "true" ? " fixed_heights" : "";

	//border grid
	$class .= ! empty( $rt_grid ) && $rt_grid == "true" ? " border_grid fixed_heights" : "";

	//overlap
	$class .= ! empty( $rt_overlap ) && $rt_overlap == "true" ? " overlap" : "";

	//column aniimations
	$class .= ! empty( $rt_col_anim ) && $rt_col_anim == "true" ? " animate-cols" : "";


	/**
	 * VC Related Features
	 */
	if ( ! empty( $full_height ) ) {
		$class .= ' full-height-row';
		if ( ! empty( $columns_placement ) ) {
			$class .= ' row-content-' . $columns_placement;
		}
	}

	if ( ! empty( $rt_column_placement ) && $rt_column_placement != "top"  ) {
		$wrapper_class .= ' align-contents content-align-' . $rt_column_placement;
	}


	/**
	 * Paddings
	 */
	if($rt_row_paddings !== "false"){


		if( $vc_base == "vc_row" || $vc_base == "" ){
			//row paddings for left & right 10 is the default value
			$rt_padding_left = $rt_padding_left == "10" ? "" : $rt_padding_left;
			$rt_padding_right = $rt_padding_right == "10" ? "" : $rt_padding_right;

			//row paddings for top & bottom 20 is the default value
			$rt_padding_top = $rt_padding_top == "20" ? "" : $rt_padding_top;
			$rt_padding_bottom = $rt_padding_bottom == "20" ? "" : $rt_padding_bottom;
		}

		//css for row paddings
		$wrapper_style  .= $rt_padding_top != "" ? 'padding-top:'.rtframework_check_unit($rt_padding_top ).';': "";
		$wrapper_style  .= $rt_padding_bottom != "" ? 'padding-bottom:'.rtframework_check_unit($rt_padding_bottom ).';': "";
		$wrapper_style  .= $rt_padding_left != "" ? 'padding-left:'.rtframework_check_unit($rt_padding_left ).';': "";
		$wrapper_style  .= $rt_padding_right != "" ? 'padding-right:'.rtframework_check_unit($rt_padding_right ).';': "";
			
	}else{
		$wrapper_class .= " nopadding";
	}

	/**
	 * Borders
	 */
	$rt_row_borders = ! empty( $rt_row_borders ) ? explode(",", $rt_row_borders) : array();

	foreach ($rt_row_borders as $v) {
		$class .= " border-".$v;
	}	

	//radius
	$style .= $rt_border_radius_tl != "" ? 'border-top-left-radius:'.str_replace("%", "", $rt_border_radius_tl ).'%;': "";
	$style .= $rt_border_radius_tr != "" ? 'border-top-right-radius:'.str_replace("%", "", $rt_border_radius_tr ).'%;': "";
	$style .= $rt_border_radius_bl != "" ? 'border-bottom-left-radius:'.str_replace("%", "", $rt_border_radius_bl ).'%;': "";
	$style .= $rt_border_radius_br != "" ? 'border-bottom-right-radius:'.str_replace("%", "", $rt_border_radius_br ).'%;': "";	

	//row height
	$wrapper_style .= ! empty( $rt_row_height ) ? 'height:'.str_replace("px", "", $rt_row_height ).'px;': ""; 

	//parallax settings 
	$parallax = "";


	/*
	*	Background options  
	*/
	//background image
	$bg_image_url = "";


	if( $rt_bg_image ){
		$bg_image_url = rt_get_attachment_image_src($rt_bg_image); 		
	}

	

	/**
	 * classic bg values
	 */
	
	if( ! empty( $bg_image_url ) ){
		//background image
		$bg_style  .= 'background-image: url('.$bg_image_url.');';
		
		//background repeat
		$bg_style  .= ! empty( $rt_bg_image_repeat ) ? 'background-repeat: '.$rt_bg_image_repeat.';': "";

		//background size
		$bg_style  .= ! empty( $rt_bg_size ) ? 'background-size: '.$rt_bg_size.';': "";

		//background attachment
		$rt_bg_attachment = $rt_bg_effect != "parallax" ? $rt_bg_attachment : "";
		$bg_style  .= ! empty( $rt_bg_attachment ) ? 'background-attachment: '.$rt_bg_attachment.';': "";

		//background position
		//$rt_bg_position = $rt_bg_effect == "parallax" ? "center" : $rt_bg_position;
		$bg_style  .= ! empty( $rt_bg_position ) ? 'background-position: '.$rt_bg_position.';': "";		
	}	

	//background color
	$bg_style  .= ! empty( $rt_bg_color ) ? 'background-color: '.$rt_bg_color.';': "";


	if( $rt_bg_effect == "parallax" && ! empty( $bg_image_url ) ){

		$pspeed = empty($rt_pspeed) ? 6 : $rt_pspeed;

		//parallax settings
		$parallax_settings = array(
					"1"=> array( "effect" => "horizontal", "direction" => -1),
					"2"=> array( "effect" => "horizontal", "direction" => 1),
					"3"=> array( "effect" => "vertical", "direction" => -1),
					"4"=> array( "effect" => "vertical", "direction" => 1),
					);		

		$bg_style .= "width:100%;height:100%;top:0;";

		$parallax = ! empty( $bg_image_url ) && $rt_bg_effect == "parallax" ? '<div class="rt-parallax-background has-bg-image" data-rt-parallax-speed="'.$pspeed.'" data-rt-parallax-direction="'. $parallax_settings[$rt_bg_parallax_effect]["direction"] .'" data-rt-parallax-effect="'.$parallax_settings[$rt_bg_parallax_effect]["effect"].'" style="'.$bg_style.'"></div>':"";		

		$bg_style = "";
		$class .= " has-custom-bg";
	}


	/**
	 * Stand Alone Background / custom height
	*/

	$sa_background = "";
	if( $rt_bg_effect == "custom_height" ){

		//alignment of the sa background 
		$bg_style .= empty( $rt_bg_custom_alignment ) || $rt_bg_custom_alignment  == "top" ? "top:0;" : "bottom:0;";

		//height
		$bg_style .= empty( $rt_bg_custom_height ) ? 'height:100%;' : 'height:'.rtframework_check_unit( $rt_bg_custom_height ).';';

		//color overlay layer
		$sa_background .= '<div class="rt-sa-background has-bg-image" style="'. $bg_style .'"></div>'."\n";

		
		$bg_style = "";

		$class .= " has-custom-bg";
	}
	 

	/**
	 * HTML5 Video BG
	 */

	$video_bg = "";
	if( ! empty( $rt_bg_video_mp4 ) ){


		//the video output
		$mp4_url = is_numeric( $rt_bg_video_mp4 ) ?  wp_get_attachment_url( $rt_bg_video_mp4 ) : $rt_bg_video_mp4;
		$webm_url = is_numeric( $rt_bg_video_webm ) ?  wp_get_attachment_url( $rt_bg_video_webm ) : $rt_bg_video_webm;

		$video_bg .= '<video class="content-row-video"  autoplay="true" preload="1" loop="1">'."\n";
		$video_bg .= '<source src=" '.$mp4_url.'" type="video/mp4"></source>'."\n";
		$video_bg .= ! empty( $webm_url ) ? '<source src=" '.$webm_url.'" type="video/webm"></source>'."\n" : "";
		$video_bg .= '</video>'."\n";

		$class .= " has-video-bg";
	}


	/**
	 * Youtube Video BG
	 */

	if( ! empty( $rt_bg_video_youtube ) ){

		$video_bg = "";

		//the video output
		$attr .=' data-vc-video-bg="'.$rt_bg_video_youtube.'"';
		$class .= " has-video-bg vc_video-bg-container";
		
	}


	/**
	 * BG Overlay
	 */

	$overlay = "";
	if( ! empty( $rt_bg_overlay_color ) ){

		//color overlay layer
		$overlay = '<div class="content-row-video-overlay" style="background-color:'. $rt_bg_overlay_color .'"></div>'."\n";

		$class .= " has-bg-overlay";
	}

	/**
	 * BG Image Preloading
	 */
	$class .= ! empty( $bg_image_url ) && $rt_bg_effect != "parallax" ? " has-bg-image" : "";

	//create styles
	$style .= $bg_style;
	$style_output = ! empty( $style ) ? 'style="'.$style.'"' : "";
	$wrapper_style = ! empty( $wrapper_style ) ? 'style="'.$wrapper_style.'"' : "";

	//content output
	$content_output =  '<div class="content_row_wrapper '. $wrapper_class .' '. $rt_row_content_width .'" '. $wrapper_style .'>'.do_shortcode($content).'</div>';

	$output .= "\n".'<div '.$id.' class="content_row row '.trim($class).'" '.$style_output.''.$attr.'>';
	$output .= "\n\t".$video_bg.$parallax.$sa_background.$overlay;
	$output .= "\n\t".$content_output;
	$output .= "\n".'</div>'."\n";

	return $output;

	}

}
add_shortcode('rt_row', 'rt_row'); 


if ( ! class_exists( "Vc_Manager" ) ) {
	add_shortcode('vc_row', 'rt_row'); 
	add_shortcode('vc_row_inner', 'rt_row'); 
}