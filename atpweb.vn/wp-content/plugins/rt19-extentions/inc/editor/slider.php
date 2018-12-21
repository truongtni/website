<?php
/*
*
* RT Slider
* [rt_slider]
*  [rt_slide][/rt_slide]  
* [/rt_slider]
*
*/

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_rt_slider extends WPBakeryShortCodesContainer { }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_rt_slide extends WPBakeryShortCode { }
}

vc_map(
	array(
		'base'        => 'rt_slider',
		'name'        => __( 'Content Slider', 'rt_theme_admin' ),
		'icon'        => 'rt_theme slider',
		'category'    => array(__( 'Content', 'rt_theme_admin' ), __( 'Theme Addons', 'rt_theme_admin' )),
		'description' => __( 'Content slider holder', 'rt_theme_admin' ),
		'as_parent'   => array( 'only' => 'rt_slide' ),
		'js_view'     => 'VcColumnView',
		'content_element' => true,
		"show_settings_on_create" => false,	
		'params'      => array(


							array(
								'param_name'  => 'min_height',
								'heading'     => __('Minimum Slider Height (px)', 'rt_theme_admin' ),
								'description' => __('Slider minimum height value to be applied for big screens only. For mobile device screens, the height will be calculated automatically depended the cotent of each slide.', 'rt_theme_admin' ),
								'type'        => 'rt_number',
								'value'       => 400,
								'save_always' => true
							),


							array(
								'param_name'  => 'autoplay',
								'heading'     => __('Autoplay', 'rt_theme_admin' ),
								'type'        => 'checkbox',
								"value"       => array(
													__("Start sliding automatically", "rt_theme_admin") => "true",
												),
							),

							array(
								'param_name'  => 'parallax',
								'heading'     => __('Parallax Effect', 'rt_theme_admin' ),
								'type'        => 'checkbox',
								"value"       => array(
													__("Enable parallax effect for this slider", "rt_theme_admin") => "true",
												),
							),

							array(
								'param_name'  => 'timeout',
								'heading'     => __('Timeout', 'rt_theme_admin' ),
								'description' => __('Timeout value for each slide. Default is 5000 (equal 5sec)', 'rt_theme_admin' ),
								'value'       => '5000',
								'type'        => 'rt_number',
								'save_always' => true
							),

						),
	)
);
 

vc_map(
	array(
		'base'        => 'rt_slide',
		'name'        => __( 'Slide', 'rt_theme_admin' ),
		'icon'        => 'code',
		'category'    => __( 'Contents', 'rt_theme_admin' ),
		'description' => __( 'Adds a slide to the Content Slider', 'rt_theme_admin' ),
		'as_child'    => array( 'only' => 'rt_slider' ),
		'content_element' => true,
		'params'      => array(


							/**
							 * Slide Content Options
							 */
							array(
								'param_name'  => 'content',
								'heading'     => __( 'Text', 'rt_theme_admin' ),
								'description' => '',
								'type'        => 'textarea_html', 
								'group' => __('Slide Content', 'rt_theme_admin')
							), 

 							array(
								'param_name'  => 'class',
								'heading'     => __('Class', 'rt_theme_admin' ),
								'description' => __('CSS Class Name', 'rt_theme_admin' ),
								'type'        => 'textfield',
								'group' => __('Slide Content', 'rt_theme_admin')
							),


							array(
								'param_name'  => 'content_color_schema',
								'heading'     => __( 'Content Color Scheme', 'rt_theme_admin' ),
								'description' => __( 'Select a color scheme for the column. Please note the background color of the scheme will not be applied.', 'rt_theme_admin' ),
								'type'        => 'dropdown',
								"value"       => array(
													__("Global", "rt_theme_admin") => "global-style",
													__("Color Set 1", "rt_theme_admin") => "default-style",
													__("Color Set 2", "rt_theme_admin") => "alt-style-1",
													__("Color Set 3", "rt_theme_admin") => "alt-style-2",
													__("Color Set 4", "rt_theme_admin") => "light-style",
												),
								'group' => __('Slide Content', 'rt_theme_admin'),
								'save_always' => true
							),

							array(
								'param_name'  => 'content_bg_color',
								'heading'     => __( 'Content Background Color', 'rt_theme_admin' ),
								'description' => '',
								'type'        => 'colorpicker',
								'group'       => __('Slide Content', 'rt_theme_admin')
							),

							array(
								'param_name'  => 'content_wrapper_width',
								'heading'     => __('Content Wrapper Width', 'rt_theme_admin' ),
								'description' => __( 'Select a pre-defined width for the row content', 'rt_theme_admin' ),
								'type'        => 'dropdown',
								"value"       => array(
													__("Default Width", "rt_theme_admin") => "default",
													__("Full Width", "rt_theme_admin") => "fullwidth",
												),	
								'group'       => __('Slide Content', 'rt_theme_admin'),
								'save_always' => true
							),

							array(
								'param_name'  => 'content_width',
								'heading'     => __('Content Width (percent)', 'rt_theme_admin' ),
								'description' => __('Width of the content block. For mobile device screens, this value will be calculated automatically depends the screen width.', 'rt_theme_admin' ),
								'type'        => 'rt_number',
								'value'       => '40',
								'group'       => __('Slide Content', 'rt_theme_admin'),
								'save_always' => true
							),

							array(
								'param_name'  => 'content_align',
								'heading'     => __('Content Align', 'rt_theme_admin' ),
								'description' => __('Select a position for the content block. For mobile device screens, the content block will be aligned to the center automatically', 'rt_theme_admin' ),
								'type'        => 'dropdown',
								"value"       => array(		
													__("Right","rt_theme_admin") => "right",
													__("Left","rt_theme_admin") => "left",
													__("Center","rt_theme_admin") => "center", 
												),
								'group' => __('Slide Content', 'rt_theme_admin'),
								'save_always' => true
							),

							array(
								'param_name'  => 'top_margin',
								'heading'     => __('Top Margin (px)', 'rt_theme_admin' ),
								'description' => __('Height of the space between top of the slide and the content block. For mobile device screens, this value will be calculated automatically depends the screen height.', 'rt_theme_admin' ),
								'type'        => 'rt_number',
								'group'       => __('Slide Content', 'rt_theme_admin')
							),

							array(
								'param_name'  => 'link',
								'heading'     => __('Link', 'rt_theme_admin' ),
								'type'        => 'textfield',
								'value'       => '',
								'group'       => __('Link', 'rt_theme_admin')
							),

							array(
								'param_name'  => 'link_target',
								'heading'     => __('Link Target', 'rt_theme_admin' ),
								'type'        => 'dropdown',
								"value"       => array(
													__("Same Tab", "rt_theme_admin") => "_self",
													__("New Tab", "rt_theme_admin") => "_blank", 
												),
								'group'       => __('Link', 'rt_theme_admin')
							),		

 							array(
								'param_name'  => 'link_title',
								'heading'     => __('Link Title', 'rt_theme_admin' ),
								'description' => __('Text for the title attribute', 'rt_theme_admin' ),
								'type'        => 'textfield',
								'group'       => __('Link', 'rt_theme_admin')
							),

							/**
							 * Background Options
							 */
							array(
								'param_name'  => 'bg_color',
								'heading'     => __( 'Background Color', 'rt_theme_admin' ),
								'description' => '',
								'type'        => 'colorpicker',
								'group'       => __('Background Options', 'rt_theme_admin')
							),


							array(
								'param_name'  => 'bg_image',
								'heading'     => __('Background Image', 'rt_theme_admin' ),
								'description' => __('Select an image for the slider background', 'rt_theme_admin' ),
								'type'        => 'attach_image',
								'value'	     => '',
								'group'       => __('Background Options', 'rt_theme_admin')
							),
 


							array(
								'param_name'  => 'bg_image_repeat',
								'heading'     => __( 'Background Repeat', 'rt_theme_admin' ),
								'description' => __( 'Select and set repeat mode direction for the background image.', 'rt_theme_admin' ),
								'type'        => 'dropdown',
								"value"       => array(		
													__("No Repeat","rt_theme_admin") => "no-repeat",
													__("Tile","rt_theme_admin") => "repeat",
													__("Tile Horizontally","rt_theme_admin") => "repeat-x",
													__("Tile Vertically","rt_theme_admin") => "repeat-y"
												),
								'group'       => __( 'Background Options', 'rt_theme_admin' ),
								'save_always' => true
							),

							array(
								'param_name'  => 'bg_size',
								'heading'     => __( 'Background Image Size', 'rt_theme_admin' ),
								'description' => __( 'Select and set size / coverage behaviour for the background image.', 'rt_theme_admin' ),
								'type'        => 'dropdown', 
								"value"       => array(		
													__("Cover","rt_theme_admin") => "cover",
													__("Auto","rt_theme_admin") => "auto auto",						
													__("Contain","rt_theme_admin") => "contain",
													__("100%","rt_theme_admin") => "100% auto",
													__("50%","rt_theme_admin") => "50% auto",
													__("25%","rt_theme_admin") => "25% auto",
												),	
								'group'       => __( 'Background Options', 'rt_theme_admin' ),
								'save_always' => true
							),

							array(
								'param_name'  => 'bg_position',
								'heading'     => __( 'Background Position', 'rt_theme_admin' ),
								'description' => __( 'Select a positon for the background image.', 'rt_theme_admin' ),
								'type'        => 'dropdown', 
								"value"       => array(		
													__("Right Top","rt_theme_admin") => "right top",
													__("Right Center","rt_theme_admin") => "right center",
													__("Right Bottom","rt_theme_admin") => "right bottom",
													__("Left Top","rt_theme_admin") => "left top",
													__("Left Center","rt_theme_admin") => "left center",
													__("Left Bottom","rt_theme_admin") => "left bottom",
													__("Center Top","rt_theme_admin") => "center top",
													__("Center Center","rt_theme_admin") => "center center",
													__("Center Bottom","rt_theme_admin") => "center bottom",
												),	
								'group'       => __( 'Background Options', 'rt_theme_admin' ),
								'save_always' => true
							),


							array(
								'param_name'  => 'padding_top',
								'heading'     => __( 'Padding Top', 'rt_theme_admin' ),
								'description' => __( 'Set padding top value (px,%)', 'rt_theme_admin' ),
								'group'       => _x( 'Paddings', 'Admin Panel','rt_theme_admin' ),
								'type'        => 'rt_number',
							),

							array(
								'param_name'  => 'padding_bottom',
								'heading'     => __( 'Padding Bottom', 'rt_theme_admin' ),
								'description' => __( 'Set padding bottom value (px,%)', 'rt_theme_admin' ),
								'group'       => _x( 'Paddings', 'Admin Panel','rt_theme_admin' ),
								'type'        => 'rt_number',
							),

							array(
								'param_name'  => 'padding_left',
								'heading'     => __( 'Padding Left', 'rt_theme_admin' ),
								'description' => __( 'Set padding left value (px,%)', 'rt_theme_admin' ),
								'group'       => _x( 'Paddings', 'Admin Panel','rt_theme_admin' ),
								'type'        => 'rt_number',
							),

							array(
								'param_name'  => 'padding_right',
								'heading'     => __( 'Padding Right', 'rt_theme_admin' ),
								'description' => __( 'Set padding right value (px,%)', 'rt_theme_admin' ),
								'group'       => _x( 'Paddings', 'Admin Panel','rt_theme_admin' ),
								'type'        => 'rt_number',
							),


							/*
							array(
								'param_name'  => 'bg_attachment',
								'heading'     => __( 'Background Attachment', 'rt_theme_admin' ),
								'description' => __( 'Select and set fixed or scroll mode for the background image.', 'rt_theme_admin' ),
								'type'        => 'dropdown', 
								"value"       => array(		
													__("Scroll","rt_theme_admin") => "scroll",
													__("Fixed","rt_theme_admin") => "fixed",  
												),	
								'group'       => __( 'Background Options', 'rt_theme_admin' ),
								"dependency"  => array(
														"element" => "rt_bg_effect",
														"value" => array("classic")
													),			
								
							),
							*/	
	

						)
	)
);		


?>