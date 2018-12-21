<?php

extract(shortcode_atts(array(
	'font_color'              => '',
	'el_class'                => '',
	'css_animation'           => '',	
	'width'                   => '1/1',
	'css'                     => '',	
	'offset'                  => '',	
	'id'                      => '',	
	'class'                   => '',	
	'rt_font_color'           => '',	
	'rt_bg_color'             => '',
	'rt_bg_image'             => '',
	'rt_bg_effect'            => '',
	'rt_bg_image_repeat'      => '',
	'rt_bg_position'          => '',
	'rt_bg_size'              => '',
	'rt_bg_attachment'        => '',
	'rt_padding_top'          => '',
	'rt_padding_bottom'       => '',
	'rt_padding_left'         => '',
	'rt_padding_right'        => '',
	'rt_wrp_padding_top'      => '',
	'rt_wrp_padding_bottom'   => '',
	'rt_wrp_padding_left'     => '',
	'rt_wrp_padding_right'    => '',			
	'rt_color_set'            => '', 
	'rt_bg_holder'            => '', 	
	'rt_margin_top'           => '',
	'rt_margin_bottom'        => '',
	'rt_border_top'           => '',
	'rt_border_bottom'        => '',
	'rt_border_left'          => '',
	'rt_border_right'         => '',		
	'rt_border_top_mobile'    => '',
	'rt_border_bottom_mobile' => '',
	'rt_border_left_mobile'   => '',
	'rt_border_right_mobile'  => '',
	'rt_min_height'           => '',		
), $atts));

$el_class = $this->getExtraClass($el_class) . $this->getCSSAnimation( $css_animation );
$width = wpb_translateColumnWidthToSpan($width);
$width = vc_column_offset_class_merge($offset, $width);
$el_class .= ' wpb_column vc_column_container';

$class .= " ".apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $width . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

//create shortcode
$create_shortcode = '[rt_column vc_base="'.$this->settings('base').'" width="'.$width.'" rt_font_color="'.$font_color.'" id="'.$id.'" class="'.$class.'" rt_bg_color="'.$rt_bg_color.'" rt_bg_image="'.$rt_bg_image.'" rt_bg_effect="'.$rt_bg_effect.'" rt_bg_image_repeat="'.$rt_bg_image_repeat.'"  rt_bg_position="'.$rt_bg_position.'" rt_bg_size="'.$rt_bg_size.'" rt_bg_attachment="'.$rt_bg_attachment.'" rt_padding_top="'.$rt_padding_top.'" rt_padding_bottom="'.$rt_padding_bottom.'" rt_padding_left="'.$rt_padding_left.'" rt_padding_right="'.$rt_padding_right.'" rt_color_set="'.$rt_color_set.'" rt_margin_top="'.$rt_margin_top.'" rt_margin_bottom="'.$rt_margin_bottom.'" rt_border_bottom="'.$rt_border_bottom.'" rt_border_left="'.$rt_border_left.'" rt_border_top="'.$rt_border_top.'" rt_border_right="'.$rt_border_right.'" rt_border_bottom_mobile="'.$rt_border_bottom_mobile.'" rt_border_left_mobile="'.$rt_border_left_mobile.'" rt_border_top_mobile="'.$rt_border_top_mobile.'" rt_border_right_mobile="'.$rt_border_right_mobile.'" rt_wrp_padding_top="'.$rt_wrp_padding_top.'" rt_wrp_padding_bottom="'.$rt_wrp_padding_bottom.'" rt_wrp_padding_left="'.$rt_wrp_padding_left.'" rt_wrp_padding_right="'.$rt_wrp_padding_right.'" rt_bg_holder="'.$rt_bg_holder.'" rt_min_height="'.$rt_min_height.'"]'.$content.'[/rt_column]';

//run
echo do_shortcode( $create_shortcode );