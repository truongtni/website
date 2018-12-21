<?php
if( ! function_exists("rt_dividers") ){
	/**
	 * Divider
	 * @param  array $atts
	 * @param  string $content
	 * @return html $divider
	 */
	function rt_dividers( $atts, $content = null ) {		
 
 	//defaults
	extract(shortcode_atts(array(
		"id"            => '',
		"class"         => '',		
		"style"         => 'style-5',
		"margin_top"    => '0',
		"margin_bottom" => '0',
		"color"         => "",
		"border_width"  => "",
		"width"         => ""
	), $atts));

	//id attr
	$id_attr = ! empty( $id ) ? 'id="'.sanitize_html_class($id).'"' : "";	  
 
 	//margins
	$style_output = $margin_top != "" ? "margin-top:".rtframework_check_unit($margin_top).";" : "";
	$style_output .= $margin_bottom != "" ? "margin-bottom:".rtframework_check_unit($margin_bottom).";" : "";
	$style_output .= $color != "" ? "border-color:".$color.";" : ""; 	
	$style_output .= $border_width != "" ? "border-width:".rtframework_check_unit($border_width).";" : ""; 	
	

	$style_output .= $border_width != "" && $style == "style-4" ? "border-style:solid;height:auto;" : ""; 	
	$style_output .= $border_width != "" && $style == "style-5" ? "border-style:double;height:auto;" : ""; 	

	$style_output .= $width != "" ? "width:".rtframework_check_unit($width).";" : ""; 	

	$style_output = ! empty( $style_output ) ? 'style="'.$style_output.'"' : "";

	//output
	$divider = sprintf('<div %1$s class="rt_divider %3$s %2$s" %4$s></div>', $id_attr, sanitize_html_class($class), $style, $style_output);

	return $divider;

	}
}

add_shortcode('rt_divider', 'rt_dividers'); 		 
