<?php

extract(shortcode_atts(array(
		"title" => '',
		"id" => '',
		"class" => '',
		"icon_name" => ''	 
), $atts));

$content = wpb_js_remove_wpautop($content,"true");

//create rt_row shortcode
$create_shortcode = '[rt_tab id="'.$id.'" title="'.$title.'" class="'.$class.'" icon_name="'.$icon_name.'" ]'.$content.'[/rt_tab]'; 

//run
echo $create_shortcode;