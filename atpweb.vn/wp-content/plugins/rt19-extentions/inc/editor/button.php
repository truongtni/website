<?php
/*
*
* Button
*
*/ 
 
vc_map(
	array(
		'base'        => 'button',
		'name'        => __( 'Button', 'rt_theme_admin' ),
		'icon'        => 'rt_theme rt_button',
		'category'    => array(__( 'Content', 'rt_theme_admin' ), __( 'Theme Addons', 'rt_theme_admin' )),
		'description' => __( 'Add a button', 'rt_theme_admin' ),
		'params'      => array(

 
							/* button */

							array(
								'param_name'  => 'button_text',
								'heading'     => __('Button Text', 'rt_theme_admin' ),
								'type'        => 'textfield',
								'value'       => '',
								'holder'      => 'span',
								'save_always' => true
							),


							array(
								'param_name'  => 'button_style',
								'heading'     => __( 'Button Style', 'rt_theme_admin' ),
								'type'        => 'dropdown',
								"value"       => array(
													__("Default Flat", "rt_theme_admin") => "default",
													__("Colored Flat", "rt_theme_admin") => "color",
													__("Text Only", 'rt_theme_admin') => "text",
													__("Custom", 'rt_theme_admin') => "custom",													
												),
								'save_always' => true
							),


							array(
								'param_name'  => 'font',
								'heading'     => __( 'Font Family', 'rt_theme_admin' ),
								'type'        => 'dropdown',
								"value"       => array(
													__("Default", 'rt_theme_admin') => "", 
													__("Heading Font", 'rt_theme_admin') => "heading-font", 
													__("Body Font", 'rt_theme_admin') => "body-font", 
													__("Secondary Font", 'rt_theme_admin') => "secondary-font", 
												),
								'save_always' => true
							),
							

							array(
								'param_name'  => 'button_size',
								'heading'     => __( 'Button Size', 'rt_theme_admin' ),
								'type'        => 'dropdown',
								"value"       => array(
													__("Small", "rt_theme_admin") => "small",
													__("Medium", "rt_theme_admin") => "medium",
													__("Big", "rt_theme_admin") => "big",
													__("Hero", 'rt_theme_admin') => "hero",
												),
								'save_always' => true,
								"dependency"  => array(
									"element" => "button_style",
									"value" => array("default", "color","custom")
								),											
							),

							array(
								'param_name'  => 'font_size',
								'heading'     => __('Custom Font Size (px)', 'rt_theme_admin' ),
								'type'        => 'rt_number'
							),

							array(
								'param_name'  => 'button_icon',
								'heading'     => __('Button Icon', 'rt_theme_admin' ),
								'type'        => 'textfield',
								'value'       => '',
								'save_always' => true,
								"dependency"  => array(
									"element" => "button_style",
									"value" => array("default", "color","custom")
								),											
							),

							array(
								'param_name'  => 'button_align',
								'heading'     => __( 'Button Align', 'rt_theme_admin' ),
								'type'        => 'dropdown',
								"value"       => array(
													__("Default", "rt_theme_admin") => "",
													__("Left", "rt_theme_admin") => "left",
													__("Right", "rt_theme_admin") => "right",
													__("Center", "rt_theme_admin") => "center",													
												),
								'save_always' => true
							),


							array(
								'param_name'  => 'padding_v',
								'heading'     => __( 'Custom Vertical Padding (px)', 'rt_theme_admin' ),
								'type'        => 'textfield',
							),


							array(
								'param_name'  => 'padding_h',
								'heading'     => __( 'Custom Horizontal Padding (px)', 'rt_theme_admin' ),
								'type'        => 'textfield',
							),

							array(
								'param_name'  => 'button_link',
								'heading'     => __('Link', 'rt_theme_admin' ),
								'type'        => 'textfield',
								'value'       => '',
								'save_always' => true
							),

							array(
								'param_name'  => 'link_open',
								'heading'     => __('Link Target', 'rt_theme_admin' ),
								'type'        => 'dropdown',
								"value"       => array(
													__("Same Tab", "rt_theme_admin") => "_self",
													__("New Tab", "rt_theme_admin") => "_blank", 
												),
								'save_always' => true
							),

							array(
								'param_name'  => 'href_title',
								'heading'     => __('Link Title', 'rt_theme_admin' ),
								'type'        => 'dropdown',
								'type'        => 'textfield',
							),		

							array(
								'param_name'  => 'id',
								'heading'     => __('ID', 'rt_theme_admin' ),
								'description' => __('Unique ID', 'rt_theme_admin' ),
								'type'        => 'textfield',
								'value'       => ''
							),

							array(
								'param_name'  => 'class',
								'heading'     => __('Class', 'rt_theme_admin' ),
								'description' => __('CSS Class Name', 'rt_theme_admin' ),
								'type'        => 'textfield'
							),



							array(
								'param_name'  => 'bg_color',
								'heading'     => __( 'Background Color', 'rt_theme_admin' ),
								'description' => __( 'Select a background color for the button', 'rt_theme_admin' ),
								'type'        => 'colorpicker',
								"dependency"  => array(
													"element" => "button_style",
													"value" => array("custom")
								),	
								'group'       => __( 'Button Style', 'rt_theme_admin' ),							
							),

							array(
								'param_name'  => 'text_color',
								'heading'     => __( 'Text Color', 'rt_theme_admin' ),
								'description' => __( 'Select a text color for the button', 'rt_theme_admin' ),
								'type'        => 'colorpicker',
								"dependency"  => array(
													"element" => "button_style",
													"value" => array("custom")
								),
								'group'       => __( 'Button Style', 'rt_theme_admin' ),
							),

							array(
								'param_name'  => 'border_size',
								'heading'     => __( 'Border Thickness (px)', 'rt_theme_admin' ),
								'type'        => 'textfield',
								"dependency"  => array(
													"element" => "button_style",
													"value" => array("custom")
								),
								'group'       => __( 'Button Style', 'rt_theme_admin' ),
							),

							array(
								'param_name'  => 'border_color',
								'heading'     => __( 'Border Color', 'rt_theme_admin' ),
								'type'        => 'colorpicker',
								"dependency"  => array(
													"element" => "button_style",
													"value" => array("custom")
								),
								'group'       => __( 'Button Style', 'rt_theme_admin' ),
							),

							array(
								'param_name'  => 'border_radius',
								'heading'     => __( 'Border Radius (px)', 'rt_theme_admin' ),
								'type'        => 'textfield',
								"dependency"  => array(
													"element" => "button_style",
													"value" => array("custom")
								),
								'group'       => __( 'Button Style', 'rt_theme_admin' ),
							),


							array(
								'param_name'  => 'h_bg_color',
								'heading'     => __( 'Background Color', 'rt_theme_admin' ),
								'description' => __( 'Select a background color for the button', 'rt_theme_admin' ),
								'type'        => 'colorpicker',
								"dependency"  => array(
													"element" => "button_style",
													"value" => array("custom")
								),	
								'group'       => __( 'Button Style (Hover)', 'rt_theme_admin' ),							
							),

							array(
								'param_name'  => 'h_text_color',
								'heading'     => __( 'Text Color', 'rt_theme_admin' ),
								'description' => __( 'Select a text color for the button', 'rt_theme_admin' ),
								'type'        => 'colorpicker',
								"dependency"  => array(
													"element" => "button_style",
													"value" => array("custom")
								),
								'group'       => __( 'Button Style (Hover)', 'rt_theme_admin' ),
							),

							array(
								'param_name'  => 'h_border_size',
								'heading'     => __( 'Border Thickness (px)', 'rt_theme_admin' ),
								'type'        => 'textfield',
								"dependency"  => array(
													"element" => "button_style",
													"value" => array("custom")
								),
								'group'       => __( 'Button Style (Hover)', 'rt_theme_admin' ),
							),

							array(
								'param_name'  => 'h_border_color',
								'heading'     => __( 'Border Color', 'rt_theme_admin' ),
								'type'        => 'colorpicker',
								"dependency"  => array(
													"element" => "button_style",
													"value" => array("custom")
								),
								'group'       => __( 'Button Style (Hover)', 'rt_theme_admin' ),
							),

							array(
								'param_name'  => 'h_border_radius',
								'heading'     => __( 'Border Radius (px)', 'rt_theme_admin' ),
								'type'        => 'textfield',
								"dependency"  => array(
													"element" => "button_style",
													"value" => array("custom")
								),
								'group'       => __( 'Button Style (Hover)', 'rt_theme_admin' ),
							),

						)
	)
);	

?>