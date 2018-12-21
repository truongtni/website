<?php
/*
*
* Headings
* [rt_heading] 
*
*/

vc_map(
	array(
	  'base'        => 'rt_heading',
	  'name'        => __( 'Heading', 'rt_theme_admin' ),
	  'icon'        => 'rt_theme rt_heading',
	  'category'    => array(__( 'Content', 'rt_theme_admin' ), __( 'Theme Addons', 'rt_theme_admin' )),
	  'description' => __( 'Add a styled heading', 'rt_theme_admin' ),
	  'params'      => array(

								array(
									'param_name'  => 'content',
									'heading'     => __( 'Heading Text', 'rt_theme_admin' ),
									'description' => '',
									'type'        => 'textfield',
									'holder'      => 'div',
									'value'       => __( 'Heading Text', 'rt_theme_admin' ),
									'save_always' => true
								),

								array(
									'param_name'  => 'style',
									'heading'     => __( 'Style', 'rt_theme_admin' ),
									'description' => __( 'Select a style', 'rt_theme_admin' ),
									'type'        => 'dropdown',
									"value"       => array(
														__("No-Style", "rt_theme_admin") => "", 
														__("Style One - ( w/ a short thin line below )", "rt_theme_admin") => "style-1",
														__("Style Two - ( w/ an arrow points the heading )", "rt_theme_admin") => "style-2", 
														__("Style Three - ( w/ lines before and after )", "rt_theme_admin") => "style-3", 
														__("Style Four - ( w/ a thin line below and punchline - centered ) ", "rt_theme_admin") => "style-4", 
														__("Style Five - ( w/ a thin line below and punchline - left aligned ) ", "rt_theme_admin") => "style-5", 
														__("Style Six - ( w/ a line after - left aligned )  ", "rt_theme_admin") => "style-6", 
														__("Style Seven - (centered) ", "rt_theme_admin") => "style-7"														
													),
									'save_always' => true
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
								"dependency"  => array(
												"element" => "style",
												"value" => array("")
								),									
								'save_always' => true
							),

							array(
								'param_name'  => 'mobile_align',
								'heading'     => __( 'Mobile Text Align', 'rt_theme_admin' ),
								'description' => __( 'Tablet portrait or smaller', 'rt_theme_admin' ),
								'type'        => 'dropdown',
								"value"       => array(
													__("Default", "rt_theme_admin") => "",
													__("Left", "rt_theme_admin") => "left",
													__("Right", "rt_theme_admin") => "right",
													__("Center", "rt_theme_admin") => "center",													
												),
								"dependency"  => array(
												"element" => "style",
												"value" => array("")
								),									
								'save_always' => true
							),

								array(
									'param_name'  => 'punchline',
									'heading'     => __('Punchline', 'rt_theme_admin' ),
									'description' => __('Optional puchline text', 'rt_theme_admin' ),
									'type'        => 'textfield',
									"dependency"  => array(
													"element" => "style",
													"value" => array("style-4","style-5")
									),	
									'save_always' => true									
								),


								array(
									'param_name'  => 'size',
									'heading'     => __( 'Size', 'rt_theme_admin' ),
									'description' => __( 'Select the size of the heading tag', 'rt_theme_admin' ),
									'type'        => 'dropdown',
									"value"       => array(
														"H1" => "h1", 
														"H2" => "h2", 
														"H3" => "h3", 
														"H4" => "h4", 
														"H5" => "h5", 
														"H6" => "h6", 
														"p" => "p",
														"span" => "span"													
													),
									'save_always' => true
								),

								array(
									'param_name'  => 'icon_name',
									'heading'     => __('Icon Name', 'rt_theme_admin' ),
									'description' => __('Click inside the field to select an icon or type the icon name', 'rt_theme_admin' ),
									'type'        => 'textfield',
									'class'       => 'icon_selector'
								),

								array(
									'param_name'  => 'font_color_type',
									'heading'     => _x( 'Font Color', 'Admin Panel','rt_theme_admin' ),
									'type'        => 'dropdown',
									"value"       => array(
														_x("Default Heading Color", 'Admin Panel','rt_theme_admin') => "", 
														_x("Custom Color", 'Admin Panel','rt_theme_admin') => "custom", 
														_x("Primary Color", 'Admin Panel','rt_theme_admin') => "primary", 
													),
									'save_always' => true
								),

								array(
									'param_name'  => 'font_color',
									'heading'     => _x('Custom Font Color', 'Admin Panel','rt_theme_admin' ),
									'type'        => 'colorpicker',
									"dependency"  => array(
													"element" => "font_color_type",
													"value" => array("custom")
									),											
								),

								array(
									'param_name'  => 'font',
									'heading'     => _x( 'Font Family', 'Admin Panel','rt_theme_admin' ),
									'type'        => 'dropdown',
									"value"       => array(
														_x("Default", 'Admin Panel','rt_theme_admin') => "", 
														_x("Heading Font", 'Admin Panel','rt_theme_admin') => "heading-font", 
														_x("Body Font", 'Admin Panel','rt_theme_admin') => "body-font", 
														_x("Secondary Font", 'Admin Panel','rt_theme_admin') => "secondary-font", 
														_x("Menu Font", 'Admin Panel','rt_theme_admin') => "menu-font"
													),
									'save_always' => true
								),


								array(
									'param_name'  => 'custom_font_size',
									'heading'     => _x('Font Size', 'Admin Panel','rt_theme_admin' ),
									'type'        => 'dropdown',
									"value"       => array(
														_x("Default Size", 'Admin Panel','rt_theme_admin') => "", 
														_x("Custom Size", 'Admin Panel','rt_theme_admin') => "custom", 
														_x("Responsive Size", 'Admin Panel','rt_theme_admin') => "responsive",  
													),
									'save_always' => true
								),


								array(
									'param_name'  => 'font_size',
									'heading'     => _x('Custom Font Size (px)', 'Admin Panel','rt_theme_admin' ),
									'type'        => 'rt_number',
									"dependency"  => array(
													"element" => "custom_font_size",
													"value" => array("custom")
									),											
								),

								array(
									'param_name'  => 'max_font_size',
									'heading'     => _x('Max Font Size (px)', 'Admin Panel','rt_theme_admin' ),
									'type'        => 'rt_number',
									"dependency"  => array(
													"element" => "custom_font_size",
													"value" => array("responsive")
									),											
								),

								array(
									'param_name'  => 'min_font_size',
									'heading'     => _x('Min Font Size (px)', 'Admin Panel','rt_theme_admin' ),
									'type'        => 'rt_number',
									"dependency"  => array(
													"element" => "custom_font_size",
													"value" => array("responsive")
									),											
								),

								array(
									'param_name'  => 'line_height',
									'heading'     => _x('Custom Line Height (px, %)', 'Admin Panel','rt_theme_admin' ),
									'type'        => 'rt_number'
								),
								
								array(
									'param_name'  => 'letter_spacing',
									'heading'     => _x('Custom Letter Spacing (px)', 'Admin Panel','rt_theme_admin' ),
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
									'param_name'  => 'link',
									'heading'     => _x('Link', 'Admin Panel','rt_theme_admin' ),
									'type'        => 'textfield',
									'value'       => '',
									'save_always' => true,
									'group'       => 'Link'
								),

								array(
									'param_name'  => 'link_open',
									'heading'     => _x('Link Target', 'Admin Panel','rt_theme_admin' ),
									'type'        => 'dropdown',
									"value"       => array(
														_x("Same Tab", 'Admin Panel','rt_theme_admin') => "_self",
														_x("New Tab", 'Admin Panel','rt_theme_admin') => "_blank", 
													),
									'save_always' => true,
									'group'       => 'Link'
								),

								array(
									'param_name'  => 'href_title',
									'heading'     => _x('Link Title', 'Admin Panel','rt_theme_admin' ),
									'type'        => 'dropdown',
									'type'        => 'textfield',
									'group'       => 'Link'
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