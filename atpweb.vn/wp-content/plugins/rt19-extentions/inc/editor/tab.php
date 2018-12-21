<?php

vc_map_update( 'vc_tabs', array(
	'category'    => array(__( 'Content', 'rt_theme_admin' ), __( 'Theme Addons', 'rt_theme_admin' )),
));

rt_vc_remove_param('vc_tabs', array('title','interval','el_class'));

vc_add_param( 'vc_tabs', array(
	'param_name'  => 'tabs_style',
	'heading'     => __('Tab Style', 'rt_theme_admin' ),
	'type'        => 'dropdown',
	"value"       => array(
						__("Horizontal Tabs", "rt_theme_admin") => "style-1",
						__("Left Vertical Tabs", "rt_theme_admin") => "style-2", 
						__("Right Vertical Tabs", "rt_theme_admin") => "style-3", 
					),
	'save_always' => true
));									

vc_add_param( 'vc_tabs', array(
	'param_name'  => 'id',
	'heading'     => __('ID', 'rt_theme_admin' ),
	'description' => __('Unique ID', 'rt_theme_admin' ),
	'type'        => 'textfield',
	'value'       => ''
));

vc_add_param( 'vc_tabs', array(
	'param_name'  => 'class',
	'heading'     => __('Class', 'rt_theme_admin' ),
	'description' => __('CSS Class Name', 'rt_theme_admin' ),
	'type'        => 'textfield'
));


 
rt_vc_remove_param('vc_tab', array('title','tab_id'));

vc_add_param( 'vc_tab', array(
	'param_name'  => 'title',
	'heading'     => __('Title', 'rt_theme_admin' ),
	'description' => __('Tab Title', 'rt_theme_admin' ),
	'type'        => 'textfield',
	'value'       => __( 'Tab Title', 'rt_theme_admin' ),
	'save_always' => true
));

vc_add_param( 'vc_tab', array(
	'param_name'  => 'icon_name',
	'heading'     => __('Tab Icon', 'rt_theme_admin' ),
	'description' => __('Click inside the field to select an icon or type the icon name', 'rt_theme_admin' ),
	'type'        => 'textfield',
	'class'       => 'icon_selector',
));

vc_add_param( 'vc_tab', array(
	'param_name'  => 'id',
	'heading'     => __('ID', 'rt_theme_admin' ),
	'description' => __('Unique ID', 'rt_theme_admin' ),
	'type'        => 'textfield',
	'value'       => ''
));

vc_add_param( 'vc_tab', array(
	'param_name'  => 'class',
	'heading'     => __('Class', 'rt_theme_admin' ),
	'description' => __('CSS Class Name', 'rt_theme_admin' ),
	'type'        => 'textfield'
));




/*
*
* RT Tabs
* [rt_tabs]
*  [rt_tab][/rt_tab] 
*  [rt_tab][/rt_tab] 
*  [rt_tab][/rt_tab] 
* [/rt_tabs]
*
*/
 
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_rt_tabs extends WPBakeryShortCodesContainer { }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_rt_tab extends WPBakeryShortCode { }
}

vc_map(
	array(
		'base'        => 'rt_tabs',
		'name'        => __( 'Tabs', 'rt_theme_admin' ),		
		'icon'        => 'rt_theme tab',
		'category'    => array(__( 'Content', 'rt_theme_admin' ), __( 'Theme Addons', 'rt_theme_admin' )),
		'description' => __( 'Tabular content holder', 'rt_theme_admin' ),
		'as_parent'    => array( 'only' => 'rt_tab' ),
		'js_view'       => 'VcColumnView',
		'content_element' => true,
		'is_container' => true,
		"show_settings_on_create" => false,
		'default_content' => '
			[rt_tab title="' . __( 'Tab 1','rt_theme_admin' ) . '"]'.__('I am text block. Click edit button to change this text.','rt_theme_admin').'[/rt_tab]
			[rt_tab title="' . __( 'Tab 2','rt_theme_admin' ) . '"]'.__('I am text block. Click edit button to change this text.','rt_theme_admin').'[/rt_tab]
		',

		'params'      => array(
 

							array(
								'param_name'  => 'tabs_style',
								'heading'     => __('Tab Style', 'rt_theme_admin' ),
								'type'        => 'dropdown',
								"value"       => array(
													__("Horizontal Tabs", "rt_theme_admin") => "style-1",
													__("Left Vertical Tabs", "rt_theme_admin") => "style-2", 
													__("Right Vertical Tabs", "rt_theme_admin") => "style-3", 
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
 
vc_map(
	array(
		'base'        => 'rt_tab',
		'name'        => __( 'Tab', 'rt_theme_admin' ),
		'icon'        => 'rt_theme tab-content',
		'category'    => __( 'Contents', 'rt_theme_admin' ),
		'description' => __( 'Adds a new tab to a tabular content.', 'rt_theme_admin' ),
		'as_child'    => array( 'only' => 'rt_tabs' ),
		'content_element' => true,
		'params'      => array(

							array(
								'param_name'  => 'title',
								'heading'     => __('Title', 'rt_theme_admin' ),
								'description' => __('Tab Title', 'rt_theme_admin' ),
								'type'        => 'textfield',
								'value'       => __( 'Tab Title', 'rt_theme_admin' ),
							),

							array(
								'param_name'  => 'content',
								'heading'     => __( 'Tab Content', 'rt_theme_admin' ),
								'description' => '',
								'type'        => 'textarea_html',
								'holder'      => 'div',
								'value'       => __( 'I am text block. Click edit button to change this text.', 'rt_theme_admin' ),
								'holder'      => 'div',
							),

							array(
								'param_name'  => 'icon_name',
								'heading'     => __('Tab Icon', 'rt_theme_admin' ),
								'description' => __('Click inside the field to select an icon or type the icon name', 'rt_theme_admin' ),
								'type'        => 'textfield',
								'class'       => 'icon_selector',
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