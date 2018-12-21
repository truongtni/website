<?php
/*
*
* RT Icon Lists
* [rt_icon_list]
*  [rt_icon_list_line][/rt_icon_list_line] 
*  [rt_icon_list_line][/rt_icon_list_line] 
*  [rt_icon_list_line][/rt_icon_list_line] 
* [/rt_icon_list]
*
*/

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_rt_icon_list extends WPBakeryShortCodesContainer { }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_rt_icon_list_line extends WPBakeryShortCode { }
}

vc_map(
	array(
		'base'        => 'rt_icon_list',
		'name'        => __( 'Icon Lists', 'rt_theme_admin' ),
		'icon'        => 'rt_theme icon_list',
		'category'    => array(__( 'Content', 'rt_theme_admin' ), __( 'Theme Addons', 'rt_theme_admin' )),
		'description' => __( 'Icon list holder', 'rt_theme_admin' ),
		'as_parent'    => array( 'only' => 'rt_icon_list_line' ),
		'js_view'       => 'VcColumnView',
		'content_element' => true,
		"show_settings_on_create" => false,
		'default_content' => '
			[rt_icon_list_line icon_name="icon-address"]63739 street lorem ipsum City, Country[/rt_icon_list_line]
			[rt_icon_list_line icon_name="icon-phone"]+1 123 312 32 23[/rt_icon_list_line]
			[rt_icon_list_line icon_name="icon-mobile"]+1 123 312 32 24[/rt_icon_list_line]
			[rt_icon_list_line icon_name="icon-mail-1"]info@company.com[/rt_icon_list_line]
		',		
		'params'      => array(

							array(
								'param_name'  => 'list_style',
								'heading'     => __('List Style', 'rt_theme_admin' ),
								'type'        => 'dropdown',
								'description' => __('Select a list style', 'rt_theme_admin' ),
								"value"       => array(
													__("Default Icons", "rt_theme_admin") => "style-1", 
													__("Light Icons", "rt_theme_admin") => "style-2", 
													__("Boxed Icons", "rt_theme_admin") => "style-3", 
													__("Big Icons", "rt_theme_admin") => "style-4", 
												),
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


						)
	)
);
 
vc_map(
	array(
		'base'        => 'rt_icon_list_line',
		'name'        => __( 'List Item', 'rt_theme_admin' ),
		'icon'        => 'rt_theme list_line sub',
		'category'    => __( 'Contents', 'rt_theme_admin' ),
		'description' => __( 'Adds a new item to the icon list', 'rt_theme_admin' ),
		'as_child'    => array( 'only' => 'rt_icon_list' ),
		'content_element' => true,
		'params'      => array(

							array(
								'param_name'  => 'icon_name',
								'heading'     => __('Icon', 'rt_theme_admin' ),
								'description' => __('Click inside the field to select an icon or type the icon name', 'rt_theme_admin' ),
								'type'        => 'textfield',
								'class'       => 'icon_selector',
							),

							array(
								'param_name'  => 'content',
								'heading'     => __( 'Content', 'rt_theme_admin' ),
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

						)
	)
);		


?>