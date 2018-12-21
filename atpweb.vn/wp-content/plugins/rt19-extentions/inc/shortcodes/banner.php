<?php

if( ! function_exists("rt_shortcode_banner") ){
	/**
	 * Banner Box Shortcode
	 * 
	 * @param  array $atts
	 * @param  string $content
	 * @return html $banner
	 */			
	function rt_shortcode_banner( $atts, $content = null ) {		
	
	//defaults
	extract(shortcode_atts(array(  
		"id"             => "", 
		"class"          => "", 
		"text_alignment" => 'left',
		"button_text"    => '',
		"button_icon"    => '',
		"button_link"    => '',
		"button_size"    => 'small',
		"button_style"	 => 'default',
		"href_title"	 => '',
		"link_target"    => '_self', 
	), $atts));

	#
	# Button
	# 

		$withbutton = $button = "";

		$href_title = ! empty( $href_title ) ? $href_title : $button_text;

		//button format
		$button_format = '
			[button 
				button_size = "'.$button_size.'" 
				button_text = "'.$button_text.'" 
				button_link = "'.$button_link.'" 
				button_icon = "'.$button_icon.'"  
				button_style = "'.$button_style.'"  
				href_title = "'.$href_title.'" 
				link_open = "'.$link_target.'" 
			]
		';
 
		! empty( $button_text )		
			and $button = '<div class="button_holder"><div>'.do_shortcode($button_format).'</div></div>';

			
	#
	# Banner
	#

		//id attr
		$id_attr = ! empty( $id ) ? 'id="'.$id.'"' : "";

		//withbutton
		! empty( $button_text ) 
			and $class .= "withbutton";


		//banner format
		if( $text_alignment == "left"){
			$banner_format = '
				<div %1$s class="banner %2$s clearfix" data-rt-animate="animate" data-rt-animation-type="fadeIn" data-rt-animation-group="single" >
					<div class="featured_text">
						%3$s
					</div>
					%4$s				
				</div>
			';
		}else{
			$banner_format = '
				<div %1$s class="banner %2$s clearfix" data-rt-animate="animate" data-rt-animation-type="fadeIn" data-rt-animation-group="single" >			
					<div class="featured_text">
						%3$s
					</div>
					%4$s				
				</div>
			';
		}		

		//banner output
		$banner = sprintf($banner_format, 
			$id_attr,
			$class, 
			rt_visual_composer_content_fix(do_shortcode($content)),
			$button
			);
		return $banner;
	} 
}

add_shortcode('banner', 'rt_shortcode_banner');	