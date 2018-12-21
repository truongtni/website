<?php

if( ! function_exists("rt_column") ){

	/**
	 * rt_column shortcode
	 * 
	 * creates a holder for contents with several background effects and layouts
	 * 
	 * @param  [array] $atts    
	 * @param  [string] $content  
	 */
	function rt_column( $atts, $content = null ) { 

	extract(shortcode_atts(array(
		'width' => '1/1',
		'id' => '',	
		'class' => '',	
		'rt_font_color' => '',
		'rt_bg_color' => '',
		'rt_bg_image' => '',
		'rt_bg_effect' => '',
		'rt_bg_image_repeat' => '',
		'rt_bg_size' => '',
		'rt_bg_attachment' => '',
		'rt_bg_position' => '',

		'rt_padding_top' => '',
		'rt_padding_bottom' => '',
		'rt_padding_left' => '',
		'rt_padding_right' => '',

		'rt_color_set' => '',
		'rt_bg_holder'            => '', 

		'rt_wrp_col_paddings'     => '',
		'rt_wrp_padding_top'      => '',
		'rt_wrp_padding_bottom'   => '',
		'rt_wrp_padding_left'     => '',
		'rt_wrp_padding_right'    => '',		

		'rt_margin_top'           => '',
		'rt_margin_bottom'        => '',	


		'rt_border_top'           => '',
		'rt_border_bottom'        => '',	
		'rt_border_left'          => '',
		'rt_border_right'         => '',

		'rt_border_top_mobile'    => '',
		'rt_border_bottom_mobile' => '',
		'rt_border_left_mobile'   => '',
		'rt_border_right_mobile'  => '',	

		'rt_min_height'           => '',

		'vc_base' => '',
	), $atts));

	$style = $output = "";

	$style = $output = $attr = $wrapper_style = $wrapper_style_output  = $bg_style ="" ;


	//id attr
	$id = ! empty( $id ) ? ' id="'.sanitize_html_class($id).'"' : "";

	//row style
	$class .= ! empty( $rt_color_set ) ? " ".$rt_color_set : "";

	//column width
	if( empty( $vc_base ) ){
		$class .= " col col-xs-12 ".rt_column_class($width)."";		
	}


	//column margins 
	$style  .= $rt_margin_top != "" ? 'margin-top:'. rtframework_check_unit($rt_margin_top) .';': "";
	$style  .= $rt_margin_bottom != "" ? 'margin-bottom:'. rtframework_check_unit($rt_margin_bottom) .';': ""; 
	$class  .= ! empty( $rt_margin_bottom ) || ! empty( $rt_margin_top ) ? " has-custom-margin": "";
	$class  .= intval( $rt_margin_top ) < 0  ? " has-nmargin": "";//nagative margin
	
	//column borders 
	$class  .= ! empty( $rt_border_top ) ? ' bt' : '';
	$class  .= ! empty( $rt_border_bottom ) ? ' bb' : '';
	$class  .= ! empty( $rt_border_left ) ? ' bl' : '';
	$class  .= ! empty( $rt_border_right ) ? ' br' : '';

	//column borders mobile
	$class  .= ! empty( $rt_border_top_mobile ) ? ' mobile-bt' : '';
	$class  .= ! empty( $rt_border_bottom_mobile ) ? ' mobile-bb' : '';
	$class  .= ! empty( $rt_border_left_mobile ) ? ' mobile-bl' : '';
	$class  .= ! empty( $rt_border_right_mobile ) ? ' mobile-br' : '';

	//column paddings 
	$style  .= $rt_padding_top != "" ? 'padding-top:'.rtframework_check_unit($rt_padding_top ).';': "";
	$style  .= $rt_padding_bottom != "" ? 'padding-bottom:'.rtframework_check_unit($rt_padding_bottom ).';': "";
	$style  .= $rt_padding_left != "" ? 'padding-left:'.rtframework_check_unit($rt_padding_left ).';': "";
	$style  .= $rt_padding_right != "" ? 'padding-right:'.rtframework_check_unit($rt_padding_right ).';': "";


	//column wrapper paddings 
	if( $rt_wrp_col_paddings !== "false" ){
		$wrapper_style  .= $rt_wrp_padding_top != "" ? 'padding-top:'.rtframework_check_unit($rt_wrp_padding_top ).';': "";
		$wrapper_style  .= $rt_wrp_padding_bottom != "" ? 'padding-bottom:'.rtframework_check_unit($rt_wrp_padding_bottom ).';': "";
		$wrapper_style  .= $rt_wrp_padding_left != "" ? 'padding-left:'.rtframework_check_unit($rt_wrp_padding_left ).';': "";
		$wrapper_style  .= $rt_wrp_padding_right != "" ? 'padding-right:'.rtframework_check_unit($rt_wrp_padding_right ).';': "";
	}

	//min height
	$min_height_style = ! empty( $rt_min_height ) != "" ? 'min-height:'.rtframework_check_unit($rt_min_height).';': ""; 
	$class  .= ! empty( $rt_min_height ) ? " custom-min-height" : "";
	$attr   .= ! empty( $rt_min_height ) ? ' data-custom-min-height="'.intval($rt_min_height).'"' : "";

	//background settings
	if( ! empty( $rt_bg_image ) ){
		$bg_image_url =  wp_get_attachment_image_src($rt_bg_image,"full"); 
		$bg_image_url = is_array( $bg_image_url ) ? $bg_image_url[0] : "";	
	 
		//background image
		$bg_style  .= ! empty( $bg_image_url ) ? 'background-image: url('.$bg_image_url.');': "";

		//background repeat
		$bg_style  .= ! empty( $rt_bg_image_repeat ) ? 'background-repeat: '.$rt_bg_image_repeat.';': "";

		//background size
		$bg_style  .= ! empty( $rt_bg_size ) ? 'background-size: '.$rt_bg_size.';': "";

		//background attachment
		$bg_style  .= ! empty( $rt_bg_attachment ) ? 'background-attachment: '.$rt_bg_attachment.';': "";	

		//position
		$bg_style  .= ! empty( $rt_bg_position ) ? 'background-position: '.$rt_bg_position.';': "";		
	}

	//background color
	$bg_style  .= ! empty( $rt_bg_color ) ? 'background-color: '.$rt_bg_color.';': "";

	//font color
	$style  .= ! empty( $rt_font_color ) ? 'color: '.$rt_font_color.';': "";


	//background for
	if( $rt_bg_holder == "wrapper" ){
		$wrapper_style .= $bg_style.$min_height_style;
	}else{
		$style .= $bg_style.$min_height_style;
	}

	//create styles
	$style_output = ! empty( $style ) ? ' style="'.$style.'"' : "";
	$wrapper_style_output = ! empty( $wrapper_style ) ? ' style="'.$wrapper_style.'"' : "";

	$output .= "\n\t".'<div'.$id.' class="'.trim($class).'"'.$style_output.'>';
	$output .= ! empty( $vc_base ) ? "\n\t\t".'<div class="wpb_wrapper"'.$wrapper_style_output.'>' : "";
	$output .= "\n\t\t\t".do_shortcode($content);
	$output .= ! empty( $vc_base ) ? "\n\t\t".'</div>' : "";
	$output .= "\n\t".'</div>'."\n";

	return $output;
 

	}

}
add_shortcode('rt_column', 'rt_column'); 
add_shortcode('rt_col', 'rt_column'); 

if ( ! class_exists( "Vc_Manager" ) ) {
	add_shortcode('vc_column', 'rt_column'); 
	add_shortcode('vc_column_inner', 'rt_column'); 
}