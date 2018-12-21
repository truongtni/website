<?php

extract(shortcode_atts(array(
		"tabs_style" => 'style-1',
		"id" => '',
		"class" => ''	
), $atts));

//$content = wpb_js_remove_wpautop($content,"true");

//create rt_row shortcode
$create_shortcode = '[rt_tabs id="'.$id.'" class="'.$class.'" tabs_style="'.$tabs_style.'" ]'.$content.'[/rt_tabs]'; 

//run
echo do_shortcode($create_shortcode);