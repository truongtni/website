<?php
/*
*
* Content Box With Images
* [content_box] 
*
*/ 

vc_map(
	array(
		'base'        => 'content_box',
		'name'        => __( 'Content Box With Image', 'rt_theme_admin' ),
		'icon'        => 'rt_theme content_box',
		'category'    => array(__( 'Content', 'rt_theme_admin' ), __( 'Theme Addons', 'rt_theme_admin' )),
		'description' => __( 'Add a content box with an image', 'rt_theme_admin' ),
		'params'      => array(

							array(
								'param_name'  => 'featured_image',
								'heading'     => __('Featured Image', 'rt_theme_admin' ),
								'description' => __('Select a featured image from your media', 'rt_theme_admin' ),
								'type'        => 'attach_image',
								'holder'      => 'img',
								'value'	     => '',
							),

							array(
								'param_name'  => 'img_bottom_margin',
								'heading'     => __( 'Image Bottom Margin (px)', 'rt_theme_admin' ),
								'type'        => 'rt_number',
							),

							array(
								'param_name'  => 'heading',
								'heading'     => __( 'Heading', 'rt_theme_admin' ),
								'description' => '',
								'type'        => 'textfield',
								'holder'      => 'div',
								'value'       => __( 'Box Heading', 'rt_theme_admin' ),
								'holder'      => 'h4',
								'save_always' => true
							), 

							array(
								'param_name'  => 'content',
								'heading'     => __( 'Text', 'rt_theme_admin' ),
								'description' => '',
								'type'        => 'textarea_html',
								'holder'      => 'div',
								'value'       => __( 'I am text block. Click edit button to change this text.', 'rt_theme_admin' ),
								'holder'      => 'div',
								'save_always' => true
							), 

							array(
								'param_name'  => 'heading_size',
								'heading'     => __( 'Heading Size', 'rt_theme_admin' ),
								'description' => __( 'Select the size of the heading tag', 'rt_theme_admin' ),
								'type'        => 'dropdown',
								"value"       => array(
													"H1" => "h1", 
													"H2" => "h2", 
													"H3" => "h3", 
													"H4" => "h4", 
													"H5" => "h5", 
													"H6" => "h6", 
												),
								'save_always' => true
							),

							array(
								'param_name'  => 'style',
								'heading'     => __( 'Box Style', 'rt_theme_admin' ),
								'description' => __( 'Select a box style', 'rt_theme_admin' ),
								'type'        => 'dropdown',
								"value"       => array(
													__("Style One", "rt_theme_admin") => "style-1",
													__("Style Two", "rt_theme_admin") => "style-2", 
													__("Style Three", "rt_theme_admin") => "style-3", 
												),
								'group'       => 'Box Style',
								'save_always' => true
							),

							array(
								'param_name'  => 'image_mask_color',
								'heading'     => __( 'Image Mask Color', 'rt_theme_admin' ),
								'description' => __( 'Select a mask color for the image. Leave blank for the default color.', 'rt_theme_admin' ),
								'type'        => 'colorpicker',
								'group'       => 'Box Style',
								"dependency"  => array(
												"element" => "style",
												"value" => array("style-2")
								),
								'save_always' => true											
							),

							array(
								'param_name'  => 'box_height',
								'heading'     => __( 'Box Height', 'rt_theme_admin' ),
								'type'        => 'rt_number',
								'group'       => 'Box Style',
								"dependency"  => array(
												"element" => "style",
												"value" => array("style-3")
								),
								'save_always' => true											
							),

							array(
								'param_name'  => 'text_align',
								'heading'     => __( 'Text Align', 'rt_theme_admin' ),
								'type'        => 'dropdown',
								'group'       => 'Box Style',
								"value"       => array(
													__("Left", "rt_theme_admin") => "left",
													__("Right", "rt_theme_admin") => "right", 
													__("Center", "rt_theme_admin") => "center", 
												),
								"dependency"  => array(
												"element" => "style",
												"value" => array("style-1","style-3")
								),	
								'save_always' => true							
							),

							array(
								'param_name'  => 'text_color',
								'heading'     => __( 'Text Color', 'rt_theme_admin' ),
								'type'        => 'colorpicker',
								'group'       => 'Box Style',
								"dependency"  => array(
												"element" => "style",
												"value" => array("style-2","style-3")
								),
								'save_always' => true											
							),

							array(
								'param_name'  => 'text_bg_color',
								'heading'     => __( 'Text Background Color', 'rt_theme_admin' ),
								'type'        => 'colorpicker',
								'group'       => 'Box Style',
								"dependency"  => array(
												"element" => "style",
												"value" => array("style-3")
								),
								'save_always' => true											
							),

							array(
								'param_name'  => 'link',
								'heading'     => __('Link', 'rt_theme_admin' ),
								'type'        => 'textfield',
								'value'       => '',
								'group'       => 'Link'
							),

							array(
								'param_name'  => 'link_text',
								'heading'     => __('Link Text', 'rt_theme_admin' ),
								'type'        => 'textfield',
								'value'       => '',
								'group'       => 'Link'
							),

							array(
								'param_name'  => 'link_target',
								'heading'     => __('Link Target', 'rt_theme_admin' ),
								'type'        => 'dropdown',
								"value"       => array(
													__("Same Tab", "rt_theme_admin") => "_self",
													__("New Tab", "rt_theme_admin") => "_blank", 
												),
								'group'       => 'Link'
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

						)
	)
);	

?>