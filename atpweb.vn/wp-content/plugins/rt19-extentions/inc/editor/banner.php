<?php
/*
*
* Banner 
*
*/ 

vc_map(
	array(
		'base'        => 'banner',
		'name'        => __( 'Banner Box', 'rt_theme_admin' ),
		'icon'        => 'rt_theme banner',
		'category'    => array(__( 'Content', 'rt_theme_admin' ), __( 'Theme Addons', 'rt_theme_admin' )),
		'description' => __( 'Add a content box with an image', 'rt_theme_admin' ),
		'params'      => array(

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


							/* button */

							array(
								'param_name'  => 'button_text',
								'heading'     => __('Button Text', 'rt_theme_admin' ),
								'type'        => 'textfield',
								'value'       => '',
								'group'       => 'Button',
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
												),
								'group'       => 'Button',
								'save_always' => true
							),

							array(
								'param_name'  => 'button_style',
								'heading'     => __( 'Button Style', 'rt_theme_admin' ),
								'type'        => 'dropdown',
								"value"       => array(
													__("Default Flat", "rt_theme_admin") => "default",
													__("Colored Flat", "rt_theme_admin") => "color",
												),
								'group'       => 'Button',
								'save_always' => true
							),
								
							array(
								'param_name'  => 'button_icon',
								'heading'     => __('Icon', 'rt_theme_admin' ),
								'type'        => 'textfield',
								'value'       => '',
								'group'       => 'Button'
							),

							array(
								'param_name'  => 'button_link',
								'heading'     => __('Link', 'rt_theme_admin' ),
								'type'        => 'textfield',
								'value'       => '',
								'group'       => 'Button'
							),

							array(
								'param_name'  => 'link_target',
								'heading'     => __('Link Target', 'rt_theme_admin' ),
								'type'        => 'dropdown',
								"value"       => array(
													__("Same Tab", "rt_theme_admin") => "_self",
													__("New Tab", "rt_theme_admin") => "_blank", 
												),
								'group'       => 'Button',
								'save_always' => true
							),										

							array(
								'param_name'  => 'href_title',
								'heading'     => __('Link Title', 'rt_theme_admin' ),
								'type'        => 'dropdown',
								'type'        => 'textfield',
								'group'       => 'Button'
							),		
						)
	)
);	

?>