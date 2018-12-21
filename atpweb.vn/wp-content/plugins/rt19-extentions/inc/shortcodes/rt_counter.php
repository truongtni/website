<?php
if( ! function_exists("rt_counter_function") ){
	/**
	 * Counter Shortcode
	 * 
	 * @param  array $atts
	 * @param  string $content
	 * @return html $output
	 */			
	function rt_counter_function( $atts, $content = null ) {		

	//defaults
	extract(shortcode_atts(array(  
		"id"     => '',
		"number" => 0,
	), $atts));

	//id attr
	$id_attr = ! empty( $id ) ? 'id="'.$id.'"' : "";

	//number
	$number = intval($number);

	//button format
	$output_format = '<div %1$s class="rt_counter"><span class="number">%2$s</span>%3$s</div>';

	$output = sprintf($output_format, $id, $number,$content);

	return $output;
	}
}

add_shortcode('rt_counter', 'rt_counter_function');	