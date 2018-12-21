<?php
/*
*
* Content Box With Icons
* [content_icon_box] 
*
*/ 

vc_map(
	array(
		'base'        => 'content_icon_box',
		'name'        => __( 'Content Box With Icon', 'rt_theme_admin' ),
		'icon'        => 'rt_theme content_box',
		'category'    => array(__( 'Content', 'rt_theme_admin' ), __( 'Theme Addons', 'rt_theme_admin' )),
		'description' => __( 'Add a content box with an icon', 'rt_theme_admin' ),
		'params'      => array(

							array(
								'param_name'  => 'heading',
								'heading'     => __( 'Heading', 'rt_theme_admin' ),
								'description' => '',
								'type'        => 'textfield',
								'holder'      => 'div',
								'value'       => __( 'Box Heading', 'rt_theme_admin' ),
								'holder'      => 'div',
								'group'       => 'Text',
								'save_always' => true
							), 

							array(
								'param_name'  => 'heading_size',
								'heading'     => __( 'Heading Size', 'rt_theme_admin' ),
								'description' => __( 'Select the size of the heading tag', 'rt_theme_admin' ),
								'type'        => 'dropdown',
								'group'       => 'Text',
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
								'param_name'  => 'content',
								'heading'     => __( 'Text', 'rt_theme_admin' ),
								'description' => '',
								'type'        => 'textarea_html',
								'holder'      => 'div',
								'value'       => __( 'I am text block. Click edit button to change this text.', 'rt_theme_admin' ),
								'group'       => 'Text',
								'holder'      => 'div',
								'save_always' => true
							),

							array(
								'param_name'  => 'icon_name',
								'heading'     => __('Icon Name', 'rt_theme_admin' ),
								'description' => __('Click inside the field to select an icon or type the icon name', 'rt_theme_admin' ),
								'type'        => 'textfield',
								'class'       => 'icon_selector',
								'group'       => 'Icon'
							),

							array(
								'param_name'  => 'icon_position',
								'heading'     => __( 'Icon Position', 'rt_theme_admin' ),
								'description' => __( 'Select an Icon Position', 'rt_theme_admin' ),
								'type'        => 'dropdown',
								"value"       => array(
													__("Left", "rt_theme_admin") => "left",
													__("Right", "rt_theme_admin") => "right", 
													__("Top", "rt_theme_admin") => "top", 
												),
								'group'       => 'Icon',
								'save_always' => true,
							),

							array(
								'param_name'  => 'icon_style',
								'heading'     => __( 'Icon Style', 'rt_theme_admin' ),
								'description' => __( 'Select an Icon Style', 'rt_theme_admin' ),
								'type'        => 'dropdown',
								"value"       => array(
													__("Style One", "rt_theme_admin") => "style-1",
													__("Style Two", "rt_theme_admin") => "style-2", 
													__("Style Three", "rt_theme_admin") => "style-3", 
													__("Style Four", "rt_theme_admin") => "style-4", 
												),
								'group'       => 'Icon',
								'save_always' => true,
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
								'group'       => 'Link',
								'save_always' => true,
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