<?php
extract(shortcode_atts(array(
		"id" => '',
		"class"=> '',
		"style" => 'numbered',
		"first_one_open" => 'false', 	
), $atts));

//$content = wpb_js_remove_wpautop($content,"true");

//create rt_row shortcode
$create_shortcode = '[rt_accordion id="'.$id.'" class="'.$class.'" style="'.$style.'" first_one_open="'.$first_one_open.'" ]'.$content.'[/rt_accordion]'; 

//run
echo do_shortcode($create_shortcode);