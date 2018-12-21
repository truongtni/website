<?php

extract(shortcode_atts(array(
		"style"         => 'style-4',
		"id"            => '',
		"class"         => '',
		"margin_top"    => '',
		"margin_bottom" => '',		
		"border_width"  => '',
		"color"         => '',
		"width"	       => ''
), $atts));

$content = wpb_js_remove_wpautop($content,"true");

//create rt_row shortcode
$create_shortcode = '[rt_divider id="'.$id.'" class="'.$class.'" style="'.$style.'" margin_top="'.$margin_top.'" margin_bottom="'.$margin_bottom.'" border_width="'.$border_width.'" color="'.$color.'" width="'.$width.'"][/rt_divider]'; 

//run
echo do_shortcode($create_shortcode);