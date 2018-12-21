<?php
if( ! function_exists("rt_scroll") ){
	/**
	 * Animated scroll
	 * 
	 * @param  array $atts
	 * @param  string $content
	 * @return html
	 */		
	function rt_scroll( $atts, $content = null ) { 

	//defaults
	extract(shortcode_atts(array(  
		"target" => "",
		"class" => "",
		"title" => "", 
	), $atts));

  
	//title attr
	$title_attr = ! empty( $title ) ? 'title="'.esc_attr($title).'"' : "";	 

	//class
	$class .=" scroll";

	return '<a href="#'.$target.'" class="'.trim($class).'" '.$title_attr.'>'.$content.'</a>';

	}
 }

add_shortcode('rt_scroll', 'rt_scroll'); 