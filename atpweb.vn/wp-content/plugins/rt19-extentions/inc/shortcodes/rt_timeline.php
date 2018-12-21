<?php
if( ! function_exists("rt_timeline") ){
	/**
	 * Timeline Holder Shortcode
	 * 
	 * @param  array $atts
	 * @param  string $content
	 * @return html $holder_output
	 */		
	function rt_timeline( $atts, $content = null ) { 

	extract(shortcode_atts(array(  
		"id" => '',
		"class" => '',			
		"style" => "",
		"chained" => false
	), $atts));

	$holder_output = "";
 
	//fix shortcode
	$content = do_shortcode($content); 

	//id attr
	$id_attr = ! empty( $id ) ? 'id="'.$id.'"' : "";

	$holder_output = sprintf('	 
		<section %1$s class="timeline %2$s %3$s">
		%4$s
		</section>
	', $id_attr, $style, $class, $content );

	return $holder_output;

	}
}

if( ! function_exists("rt_tl_event") ){
	/**
	 * Timeline Single Event Shortcode
	 * 
	 * @param  array $atts
	 * @param  string $content
	 * @return html $holder_output
	 */		
	function rt_tl_event( $atts, $content = null ) {

 	extract(shortcode_atts(array(  
		"id" => '',
		"class" => '', 
		"day" => '',
		"month" => '',
		"year" => '',
		"title" => ''
	), $atts));	

	//content
	$content = rt_visual_composer_content_fix(do_shortcode($content));

	//title
	$title_output = ! empty( $title ) ? '<h4 class="event-title">'.$title.'</h4>' : "";

 	//output
	$date_output = sprintf('	 
		<span class="event-date">
			<span class="day">%1$s</span>
			<span class="month">%2$s</span>
			<span class="year">%3$s</span>
		</span>
	', $day, $month, $year );

	//id attr
	$id_attr = ! empty( $id ) ? 'id="'.$id.'"' : "";

	//class attr
	$class_attr = ! empty( $class ) ? 'class="'.$class.'"' : "";

	//output
	$output = sprintf('	 
		<div %1$s %2$s>
		%3$s<div class="event-details">%4$s%5$s</div>
		</div>
	', $id_attr, $class_attr, $date_output, $title_output, $content );

	return $output;
	}
}

add_shortcode('rt_timeline', 'rt_timeline');
add_shortcode('rt_tl_event', 'rt_tl_event');