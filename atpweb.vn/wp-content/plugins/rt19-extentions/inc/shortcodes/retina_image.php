<?php
if( ! function_exists("rt_retina_image") ){
	/**
	 * Retina Image
	 * @param  array $atts
	 * @param  string $content
	 * @return html $output
	 */
	function rt_retina_image( $atts, $content = null ) {

	//defaults
	extract(shortcode_atts(array(  
		"id"  => "", 
		"class" => "",
		"img" => "",//image id
		"img_width" => "",
		"img_height" => "",
		"link" => "",
		"link_title" => "",
		"link_target" => "_self",
		"img_align" => "left",
	 	"crop" => "false"
	), $atts));


	if( empty( $img ) ){
		return;
	}

	$resize_image = rt_vt_resize( $img, '', $img_width, $img_height, $crop );	
	$image_alternative_text = get_post_meta($img, '_wp_attachment_image_alt', true);


	if( ! empty( $img_width ) ) 

	
	$img_2x_width = ! empty( $img_width ) ? intval($img_width) * 2 : "";
	$img_2x_height = ! empty( $img_height ) ? intval($img_height) * 2 : "";

	//srcset
	$resize_retina_image = ! empty( $img_2x_height ) || ! empty( $img_2x_width ) ? rt_vt_resize( $img, '', $img_2x_width, $img_2x_height, $crop ) : "";	
	$srcset = is_array($resize_retina_image) ? ' srcset="'.$resize_retina_image["url"].' 1.3x"' : "";

	//id attr
	$id = ! empty( $id ) ? ' id="'.sanitize_html_class($id).'"' : "";	 

	//align
	$class = ! empty( $img_align ) ? " align".$img_align : "";

	//class attr
	$class = ! empty( $class ) ? ' class="'.trim($class).'"' : "";	 

	//link target
	$link_target = ! empty( $link_target ) ? $link_target : '_self';

	//output format
	$output_format = ! empty( $link ) ? '<a href="%7$s" title="%8$s" target="%9$s"><img src="%1$s" width="%2$s" height="%3$s" alt="%4$s"%5$s%6$s /></a>' : '<img src="%1$s" width="%2$s" height="%3$s" alt="%4$s"%5$s%6$s />';

	return sprintf( $output_format, $resize_image["url"], $resize_image["width"], $resize_image["height"], $image_alternative_text, $id.$class, $srcset, $link, $link_title, $link_target );
	}
}
 
add_shortcode('rt_retina_image', 'rt_retina_image');