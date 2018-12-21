<?php
/*
*
* Icons
* [rt_heading] 
*
*/

vc_map(
	array(
	  'base'        => 'icon',
	  'name'        => __( 'Icon', 'rt_theme_admin' ),
	  'icon'        => 'rt_theme rt_icon',
	  'category'    => array(__( 'Content', 'rt_theme_admin' ), __( 'Theme Addons', 'rt_theme_admin' )),
	  'description' => __( 'Add a theme icon.', 'rt_theme_admin' ),
	  'params'      => array(


								array(
									'param_name'  => 'icon_name',
									'heading'     => __('Icon Name', 'rt_theme_admin' ),
									'description' => __('Click inside the field to select an icon or type the icon name', 'rt_theme_admin' ),
									'type'        => 'textfield',
									'class'       => 'icon_selector'
								),


								array(
									'param_name'  => 'align',
									'heading'     => __( 'Text Align', 'rt_theme_admin' ),
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
									'param_name'  => 'color_type',
									'heading'     => _x( 'Icon Color', 'Admin Panel','rt_theme_admin' ),
									'type'        => 'dropdown',
									"value"       => array(
														_x("Text Color", 'Admin Panel','rt_theme_admin') => "text", 
														_x("Primary Color", 'Admin Panel','rt_theme_admin') => "primary", 
														_x("Custom Color", 'Admin Panel','rt_theme_admin') => "custom", 
													),
									'save_always' => true
								),

								array(
									'param_name'  => 'color',
									'heading'     => _x('Custom Icon Color', 'Admin Panel','rt_theme_admin' ),
									'type'        => 'colorpicker',
									"dependency"  => array(
													"element" => "color_type",
													"value" => array("custom")
									),											
								),

								array(
									'param_name'  => 'background_color',
									'heading'     => _x('Custom Background Color', 'Admin Panel','rt_theme_admin' ),
									'type'        => 'colorpicker',
									"dependency"  => array(
													"element" => "color_type",
													"value" => array("custom")
									),											
								),

								array(
									'param_name'  => 'font_size',
									'heading'     => _x('Custom Icon Size (px)', 'Admin Panel','rt_theme_admin' ),
									'type'        => 'rt_number'								
								),

								array(
									'param_name'  => 'border_color',
									'heading'     => _x('Border Color', 'Admin Panel','rt_theme_admin' ),
									'type'        => 'colorpicker'				
								),

								array(
									'param_name'  => 'border_width',
									'heading'     => _x('Border Width (px,%)', 'Admin Panel','rt_theme_admin' ),
									'type'        => 'rt_number'							
								),

								array(
									'param_name'  => 'border_radius',
									'heading'     => _x('Border Radius (px,%)', 'Admin Panel','rt_theme_admin' ),
									'type'        => 'rt_number'							
								),

								array(
									'param_name'  => 'id',
									'heading'     => _x('ID', 'Admin Panel','rt_theme_admin' ),
									'description' => _x('Unique ID', 'Admin Panel','rt_theme_admin' ),
									'type'        => 'textfield',
									'value'       => ''
								),

								array(
									'param_name'  => 'class',
									'heading'     => _x('Class', 'Admin Panel','rt_theme_admin' ),
									'description' => _x('CSS Class Name', 'Admin Panel','rt_theme_admin' ),
									'type'        => 'textfield'
								),


								array(
									'param_name'  => 'margin_top',
									'heading'     => _x( 'Margin Top', 'Admin Panel','rt_theme_admin' ),
									'description' => _x( 'Set margin top value (px,%)', 'Admin Panel','rt_theme_admin' ),
									'type'        => 'rt_number',
									'group'       => _x( 'Margins', 'Admin Panel','rt_theme_admin' ),
								),

								array(
									'param_name'  => 'margin_bottom',
									'heading'     => _x( 'Margin Bottom', 'Admin Panel','rt_theme_admin' ),
									'description' => _x( 'Set margin bottom value (px,%)', 'Admin Panel','rt_theme_admin' ),
									'type'        => 'rt_number',
									'group'       => _x( 'Margins', 'Admin Panel','rt_theme_admin' ),
								),

								array(
									'param_name'  => 'margin_left',
									'heading'     => _x( 'Margin Left', 'Admin Panel','rt_theme_admin' ),
									'description' => _x( 'Set margin left value (px,%)', 'Admin Panel','rt_theme_admin' ),
									'type'        => 'rt_number',
									'group'       => _x( 'Margins', 'Admin Panel','rt_theme_admin' ),
								),

								array(
									'param_name'  => 'margin_right',
									'heading'     => _x( 'Margin Right', 'Admin Panel','rt_theme_admin' ),
									'description' => _x( 'Set margin right value (px,%)', 'Admin Panel','rt_theme_admin' ),
									'type'        => 'rt_number',
									'group'       => _x( 'Margins', 'Admin Panel','rt_theme_admin' ),
								),	


								array(
									'param_name'  => 'padding_top',
									'heading'     => _x( 'Padding Top', 'Admin Panel','rt_theme_admin' ),
									'description' => _x( 'Set padding top value (px,%)', 'Admin Panel','rt_theme_admin' ),
									'type'        => 'rt_number',
									'group'       => _x( 'Paddings', 'Admin Panel','rt_theme_admin' ),
								),

								array(
									'param_name'  => 'padding_bottom',
									'heading'     => _x( 'Padding Bottom', 'Admin Panel','rt_theme_admin' ),
									'description' => _x( 'Set padding bottom value (px,%)', 'Admin Panel','rt_theme_admin' ),
									'type'        => 'rt_number',
									'group'       => _x( 'Paddings', 'Admin Panel','rt_theme_admin' ),
								),

								array(
									'param_name'  => 'padding_left',
									'heading'     => _x( 'Padding Left', 'Admin Panel','rt_theme_admin' ),
									'description' => _x( 'Set padding left value (px,%)', 'Admin Panel','rt_theme_admin' ),
									'type'        => 'rt_number',
									'group'       => _x( 'Paddings', 'Admin Panel','rt_theme_admin' ),
								),

								array(
									'param_name'  => 'padding_right',
									'heading'     => _x( 'Padding Right', 'Admin Panel','rt_theme_admin' ),
									'description' => _x( 'Set padding right value (px,%)', 'Admin Panel','rt_theme_admin' ),
									'type'        => 'rt_number',
									'group'       => _x( 'Paddings', 'Admin Panel','rt_theme_admin' ),
								),	

							)
	)
);				

?>