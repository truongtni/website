<?php
if( ! function_exists("rt_pullquote") ){
	/**
	 * Pullquote Shortcode
	 * 
	 * @param  array $atts
	 * @param  string $content
	 * @return html $output
	 */					
	function rt_pullquote( $atts, $content = null ) {

	//defaults
	extract(shortcode_atts(array(
		"align"  => 'left',
	), $atts));
 
	$output = sprintf('
		<blockquote class="pullquote align%s" data-rt-animate="animate" data-rt-animation-type="fadeInDown" data-rt-animation-group="single">%s</blockquote>
	',$align, $content ); 

	return $output;
	}
}

add_shortcode('pullquote', 'rt_pullquote'); 		