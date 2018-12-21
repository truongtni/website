<?php
if( ! function_exists("rt_heading_function") ){
	/**
	 * Heading Shortcode
	 * 
	 * @param  array $atts
	 * @param  string $content
	 * @return html $heading_output
	 */	
	function rt_heading_function( $atts, $content = null ) {

	//defaults
	extract(shortcode_atts(array(
		"id"               => '',
		"class"            => '',
		"style"            => '',
		"icon_name"        => '',
		"punchline"        => '',
		"size"             => 'h1',
		"font_size"        => '',
		"custom_font_size" => '',
		"max_font_size"    => '',
		"min_font_size"    => '',
		"font_color"       => '',
		"line_height"      => '',
		"letter_spacing"   => '',
		"font_color_type"  => '',
		"link"             => '',
		"link_open"        => '_self',
		"href_title"       => '',
		"margin_top"       => '',
		"margin_bottom"    => '',
		"margin_left"      => '',
		"margin_right"     => '',
		"padding_top"      => '',
		"padding_bottom"   => '',
		"padding_left"     => '',
		"padding_right"    => '',		
		"font"             => '',
		"align"            => '',
		"mobile_align"     => '',
	), $atts));

	$css = $wrapper_css = $data = "";

	//id attr
	$id = ! empty( $id ) ? 'id="'.sanitize_html_class($id).'"' : "";	

	//add class
	$class .= ! empty( $punchline ) ? ' with_punchline' : "";

	//style 7 - centered
	$class .= $style == "style-7" ? ' aligncenter' : "";

	//align
	if( empty( $style ) ){
		$class .= ! empty( $align ) ? ' align'.$align : "";	
		$class .= ! empty( $mobile_align ) ? ' mobile_align'.$mobile_align : "";	
	}

	//custom font size
	$css .= ! empty( $font_size ) && $custom_font_size == "custom" ? "font-size:".rtframework_check_unit($font_size).";" : "";

	//responsive font size
	$data .= ! empty( $max_font_size ) && $custom_font_size == "responsive" ? ' data-maxfont-size="'.str_replace("px","",$max_font_size).'"' : "";
	$css .= ! empty( $max_font_size ) && $custom_font_size == "responsive" ? "font-size:".rtframework_check_unit($max_font_size).";" : "";
	$data .= ! empty( $min_font_size ) && $custom_font_size == "responsive" ? ' data-minfont-size="'.str_replace("px","",$min_font_size).'"' : "";

	//custom font color
	$css .= ! empty( $font_color ) ? "color:{$font_color};" : "";

	//primary font color
	$class .= $font_color_type == "primary" ? ' primary-color' : "";

	//font fammily
	$class .= ! empty( $font ) ? ' '.$font : "";


	//custom line-height
	$css .= ! empty( $line_height ) ? "line-height:".rtframework_check_unit($line_height).";" : "";

	//custom letter-spacing
	$css .= ! empty( $letter_spacing ) ? "letter-spacing:".rtframework_check_unit($letter_spacing).";" : "";

	//margins
	$css .= $margin_top != "" ? 'margin-top:'.rtframework_check_unit( $margin_top ).';': "";
	$css .= $margin_bottom != "" ? 'margin-bottom:'.rtframework_check_unit( $margin_bottom ).';': "";
	$css .= $margin_left != "" ? 'margin-left:'.rtframework_check_unit( $margin_left ).';': "";
	$css .= $margin_right != "" ? 'margin-right:'.rtframework_check_unit( $margin_right ).';': "";	

	//paddings
	$wrapper_css .= $padding_top != "" ? 'padding-top:'.rtframework_check_unit( $padding_top ).';': "";
	$wrapper_css .= $padding_bottom != "" ? 'padding-bottom:'.rtframework_check_unit( $padding_bottom ).';': "";
	$wrapper_css .= $padding_left != "" ? 'padding-left:'.rtframework_check_unit( $padding_left ).';': "";
	$wrapper_css .= $padding_right != "" ? 'padding-right:'.rtframework_check_unit( $padding_right ).';': "";	

	//style output
	$css = ! empty( $css ) ? ' style="'.$css.'"' : "";
	$wrapper_css = ! empty( $wrapper_css ) ? ' style="'.$wrapper_css.'"' : "";
	
	//icon
	$icon_output = ! empty( $icon_name ) ? sprintf('<span class="%s heading_icon"></span>', $icon_name) : "";

	//hidden link output
	$link_start = ! empty( $link ) ? sprintf('<a href="%1$s" target="%2$s" title="%3$s">', $link, $link_open, $href_title) : "";
	$link_end = ! empty( $link ) ? "</a>" : "";

	//punchline
	$punchline_style = ! empty( $font_color ) ? ' style="color:'.$font_color.';"' : "";
	$punchline = ! empty( $punchline ) && ( $style == "style-1" || $style == "style-4" || $style == "style-5" ) ? sprintf('<span class="punchline"'.$punchline_style.'>%s</span>', $punchline) : "";

	//output
	$heading_output = sprintf(
					'<div class="rt_heading_wrapper %3$s"%12$s>
						%9$s%7$s<%1$s class="rt_heading %2$s %3$s" %4$s%8$s%11$s>%5$s%6$s</%1$s>%10$s
					</div>',
					$size, $class, $style, $id, $icon_output, $content, $punchline, $css, $link_start, $link_end, $data,$wrapper_css);

	return $heading_output; 

	}
}

add_shortcode('rt_heading', 'rt_heading_function'); 