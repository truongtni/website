<?php

if( ! function_exists("rt_chained_contents") ){
	/**
	 * Chained Contents Holder Shortcode
	 * 
	 * @param  array $atts
	 * @param  string $content
	 * @return html $holder_output
	 */			
	function rt_chained_contents( $atts, $content = null ) {
	global $rt_content_counter, $rt_chain_stlye;

	extract(shortcode_atts(array(  
		"id" => '',
		"class" => '',			
		"style" => 1,
		"chained" => false,
		"align" => "left",
		"start_from" => 1,
		"font" => "",
		"font_size" => "",
		"thick_border" => ""
	), $atts));

	$list_holder_output = $title_output = "";

	//class names
	$class_names = array( 1 => "style-1", 2 => "style-1", 3 => "style-2", 4 => "style-2" );

	//list style
	$rt_chain_stlye = $style;

	//reset counter
	$rt_content_counter = $start_from-1;
 
	//fix shortcode
	$content = do_shortcode($content); 

	//id attr
	$id_attr = ! empty( $id ) ? 'id="'.$id.'"' : "";

	//class
	$class .= ' '.$align;

	//custom font size
	$css = ! empty( $font_size ) ? ' style="font-size:'.rtframework_check_unit($font_size).';"' : "";

	//font fammily
	$class .= ! empty( $font ) ? ' '.$font : "";

	//font fammily
	$class .= ! empty( $thick_border ) ? ' thick-border': "";


	$holder_output = sprintf('	 
		<div %1$s class="chained_contents %2$s %3$s" data-rt-animation-group="group" %5$s>
		%4$s
		</div>
	', $id_attr, $class_names[$style], $class, $content, $css );

	return $holder_output;
	}
}

if( ! function_exists("rt_chained_content") ){
	/**
	 * Chained Contents Single Item Shortcode
	 * 
	 * @param  array $atts
	 * @param  string $content
	 * @return html $output
	 */				
	function rt_chained_content( $atts, $content = null ) {
		
	global $rt_content_counter, $rt_chain_stlye;	
	$rt_content_counter ++;	

	extract(shortcode_atts(array(  
		"id" => '',
		"class" => '',
		"title" => '',
		"icon_name" => ''
	), $atts));	

	//title
	$title_output = ! empty( $title ) ? '<h4 class="list-title">'.$title.'</h4>' : "";

	//content
	$content = rt_visual_composer_content_fix(do_shortcode($content));
	
	//id attr
	$id_attr = ! empty( $id ) ? 'id="'.$id.'"' : "";

	//the box output
	if( $rt_chain_stlye == 1 || $rt_chain_stlye == 3 ){
		//icon output
		$box_output = ! empty( $icon_name ) ? '<span class="'.$icon_name.' icon"></span>' : "";
	}else{
		//number output
		$box_output = '<span class="number">'. $rt_content_counter .'</span>';			
	}

	//output
	$output = sprintf('	 
		<div %1$s class="%2$s" data-rt-animate="animate" data-rt-animation-type="fadeInDown">
		%3$s<div class="list-content">%4$s%5$s</div>
		</div>
	', $id_attr, $class, $box_output, $title_output, $content );

	return $output;
	}
}

add_shortcode('rt_chained_contents', 'rt_chained_contents');
add_shortcode('rt_chained_content', 'rt_chained_content');