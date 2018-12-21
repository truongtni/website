<?php
/*
*
* RT Chained Contents
* [rt_chained_contents]
*  [rt_chained_content][/rt_chained_content] 
*  [rt_chained_content][/rt_chained_content] 
*  [rt_chained_content][/rt_chained_content] 
* [/rt_chained_contents]
*
*/

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_rt_chained_contents extends WPBakeryShortCodesContainer { }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_rt_chained_content extends WPBakeryShortCode { }
}

vc_map(
	array(
		'base'        => 'rt_chained_contents',
		'name'        => __( 'Chained Contents', 'rt_theme_admin' ),
		'icon'        => 'rt_theme link',
		'category'    => array(__( 'Content', 'rt_theme_admin' ), __( 'Theme Addons', 'rt_theme_admin' )),
		'description' => __( 'Chained content holder', 'rt_theme_admin' ),
		'as_parent'    => array( 'only' => 'rt_chained_content' ),
		'js_view'       => 'VcColumnView',
		'is_container' => true,
		"show_settings_on_create" => false,
		'default_content' => '
			[rt_chained_content icon_name="icon-rocket" title="' . __( 'Content 1','rt_theme_admin' ) . '"]'.__('<p>I am text block. Click edit button to change this text.</p>','rt_theme_admin').'[/rt_chained_content]
			[rt_chained_content icon_name="icon-home" title="' . __( 'Content 2','rt_theme_admin' ) . '"]'.__('<p>I am text block. Click edit button to change this text.</p>','rt_theme_admin').'[/rt_chained_content]
		',		
		'params'      => array(

							array(
								'param_name'  => 'style',
								'heading'     => __('Style', 'rt_theme_admin' ),
								'type'        => 'dropdown',
								'description' => __('Select a style', 'rt_theme_admin' ),
								'value'       => array(
													__("Small Icons", "rt_theme_admin") => "1",
													__("Small Numbers", "rt_theme_admin") => "2", 
													__("Big Icons", "rt_theme_admin") => "3",
													__("Big Numbers", "rt_theme_admin") => "4"
												),
								'save_always' => true
							),

							array(
								'param_name'  => 'start_from',
								'heading'     => __( 'Start Number', 'rt_theme_admin' ),
								'description' => __( 'Set a start number for the list. e.g. set 1 to have 1,2,3,.. list', 'rt_theme_admin' ),
								'type'        => 'rt_number',
								'value'      => 1,
								"dependency"  => array(
														"element" => "style",
														"value" => array("2","4")
													),
								'save_always' => true
							),						

							array(
								'param_name'  => 'align',
								'heading'     => __('Number/Icon Align', 'rt_theme_admin' ),
								'type'        => 'dropdown',
								'value'       => array(
													__("Left", "rt_theme_admin") => "left",
													__("Right", "rt_theme_admin") => "right", 
												),
								'save_always' => true
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
								'param_name'  => 'font_size',
								'heading'     => _x('Custom Font Size (px)', 'Admin Panel','rt_theme_admin' ),
								'type'        => 'rt_number'					
							),

							array(
								'param_name'  => 'thick_border',
								"value"       => array(
															_x("Thick Borders", 'Admin Panel','rt_theme_admin') => "true"
														),							
								'type'        => 'checkbox',
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
		'base'        => 'rt_chained_content',
		'name'        => __( 'Chained Content', 'rt_theme_admin' ),
		'icon'        => 'rt_theme list_line sub',
		'category'    => __( 'Contents', 'rt_theme_admin' ),
		'description' => __( 'Adds a new content block to the chained content group', 'rt_theme_admin' ),
		'as_child'    => array( 'only' => 'rt_chained_contents' ),
		'content_element' => true,
		'is_container' => true,
		'params'      => array(

							array(
								'param_name'  => 'icon_name',
								'heading'     => __('Icon', 'rt_theme_admin' ),
								'description' => __('Click inside the field to select an icon or type the icon name', 'rt_theme_admin' ),
								'type'        => 'textfield',
								'class'       => 'icon_selector',
							),

							array(
								'param_name'  => 'title',
								'heading'     => __( 'Title', 'rt_theme_admin' ),
								'description' => '',
								'type'        => 'textfield',
								'holder'      => 'h4',
								'save_always' => true
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