<?php
if( ! function_exists("rt_quote_function") ){
	/**
	 * Heading Shortcode
	 * 
	 * @param  array $atts
	 * @param  string $content
	 * @return html $heading_output
	 */	
	function rt_quote_function( $atts, $content = null ) {

	//defaults
	extract(shortcode_atts(array(
		"id" => '',
		"class" => '',
		"name" => '',
		"position" => '',
		"link" => '',
		"link_title" => '',
	), $atts));

	$content = $content;

	//id attr
	$id = ! empty( $id ) ? 'id="'.sanitize_html_class($id).'"' : "";	

	//class attr
	$class = ! empty( $class ) ? 'class="'.sanitize_html_class($class).'"' : "";	




	//author link
	$link = esc_url( $link );
	$link_output = ! empty( $link ) && ! empty( $link_title ) ? '<a href="'. $link. '" target="_blank" title="'.$link_title.'" class="client_link">'. $link_title. '</a>' : "" ;
	$link_output = ! empty( $link ) ? '<a href="'. $link. '" target="_blank" title="" class="client_link">'. str_replace( "http://","",$link ). '</a>' : $link_output;


	//author name
	$author = ! empty( $name ) ? '<span>'. $name .'</span>' : "" ; 

	//position
	$author .= ! empty( $position ) ? ", ".$position : "";

	//author output
	$author_output = ! empty($author) || ! empty( $link_output ) ? sprintf(
					'<div class="author_info">
						%1$s %2$s
					</div>',
					$author, $link_output) : "";

	//output
	$output = sprintf(
					'<div class="rt_quote" %1$s %2$s>
							<p>
								<span class="icon-quote-left"></span>
								%3$s
								<span class="icon-quote-right"></span>
							</p>
							%4$s
					</div>',
					$id, $class, $content, $author_output);

	return $output; 

	}
}

add_shortcode('rt_quote', 'rt_quote_function'); 