<?php

rt_vc_remove_param('vc_accordion', array('title','interval','el_class','collapsible','active_tab','disable_keyboard'));

vc_map_update( 'vc_accordion', array(
	'default_content' => '
		[vc_accordion_tab title="' . __( 'Content 1','rt_theme_admin' ) . '"][vc_column_text]'.__('I am text block. Click edit button to change this text.','rt_theme_admin').'[/vc_column_text][/vc_accordion_tab]
		[vc_accordion_tab title="' . __( 'Content 2','rt_theme_admin' ) . '"][vc_column_text]'.__('I am text block. Click edit button to change this text.','rt_theme_admin').'[/vc_column_text][/vc_accordion_tab]
	',	
	'category'    => array(__( 'Content', 'rt_theme_admin' ), __( 'Theme Addons', 'rt_theme_admin' )),

));


vc_add_param( 'vc_accordion', array(
	'param_name'  => 'style',
	'heading'     => __('Accordion Style', 'rt_theme_admin' ),
	'type'        => 'dropdown',
	'description' => __('Select an accordion content style', 'rt_theme_admin' ),
	"value"       => array(
						__("Numbered", "rt_theme_admin") => "numbered",
						__("With Icons", "rt_theme_admin") => "icons", 
						__("Captions Only", "rt_theme_admin") => "only_captions"
					),
	'save_always' => true
));										

vc_add_param( 'vc_accordion', array(
	'param_name'  => 'first_one_open',
	'heading'     => __('First content', 'rt_theme_admin' ),
	'description' => __('Keep the first section opened when the page loaded.', 'rt_theme_admin' ),
	'type'        => 'checkbox',
	"value"       => array(
						__("First one open", "rt_theme_admin") => "true",
					),
	'save_always' => true
));

vc_add_param( 'vc_accordion', array(
	'param_name'  => 'id',
	'heading'     => __('ID', 'rt_theme_admin' ),
	'description' => __('Unique ID', 'rt_theme_admin' ),
	'type'        => 'textfield',
	'value'       => ''
));

vc_add_param( 'vc_accordion', array(
	'param_name'  => 'class',
	'heading'     => __('Class', 'rt_theme_admin' ),
	'description' => __('CSS Class Name', 'rt_theme_admin' ),
	'type'        => 'textfield'
));

rt_vc_remove_param('vc_accordion_tab', array('title'));

vc_add_param( 'vc_accordion_tab', array(
	'param_name'  => 'title',
	'heading'     => __('Title', 'rt_theme_admin' ),
	'description' => __('Accordion Title', 'rt_theme_admin' ),
	'type'        => 'textfield',
	'value'       => __( 'Accordion Title', 'rt_theme_admin' ),
	'save_always' => true
));

vc_add_param( 'vc_accordion_tab', array(
	'param_name'  => 'icon_name',
	'heading'     => __('Accordion Icon', 'rt_theme_admin' ),
	'description' => __('Click inside the field to select an icon or type the icon name', 'rt_theme_admin' ),
	'type'        => 'textfield',
	'class'       => 'icon_selector',
));

vc_add_param( 'vc_accordion_tab', array(
	'param_name'  => 'id',
	'heading'     => __('ID', 'rt_theme_admin' ),
	'description' => __('Unique ID', 'rt_theme_admin' ),
	'type'        => 'textfield',
	'value'       => ''
));

vc_add_param( 'vc_accordion_tab', array(
	'param_name'  => 'class',
	'heading'     => __('Class', 'rt_theme_admin' ),
	'description' => __('CSS Class Name', 'rt_theme_admin' ),
	'type'        => 'textfield'
));


	

/*
*
* RT Accordions
* [rt_accordion]
*  [rt_accordion_content][/rt_accordion_content] 
*  [rt_accordion_content][/rt_accordion_content] 
*  [rt_accordion_content][/rt_accordion_content] 
* [/rt_accordion]
*
*/

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_rt_accordion extends WPBakeryShortCodesContainer { }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_rt_accordion_content extends WPBakeryShortCode { }
}

vc_map(
	array(
		'base'        => 'rt_accordion',
		'name'        => __( 'Accordions', 'rt_theme_admin' ),
		'icon'        => 'rt_theme accordion',
		'category'    => array(__( 'Content', 'rt_theme_admin' ), __( 'Theme Addons', 'rt_theme_admin' )),
		'description' => __( 'Accordion content holder', 'rt_theme_admin' ),
		'as_parent'    => array( 'only' => 'rt_accordion_content' ),
		'js_view'       => 'VcColumnView',
		'content_element' => true,
		'is_container' => true,
		"show_settings_on_create" => false,
		'default_content' => '
			[rt_accordion_content title="' . __( 'Content 1','rt_theme_admin' ) . '"]'.__('I am text block. Click edit button to change this text.','rt_theme_admin').'[/rt_accordion_content]
			[rt_accordion_content title="' . __( 'Content 2','rt_theme_admin' ) . '"]'.__('I am text block. Click edit button to change this text.','rt_theme_admin').'[/rt_accordion_content]
		',		
		'params'      => array(

							array(
								'param_name'  => 'style',
								'heading'     => __('Accordion Style', 'rt_theme_admin' ),
								'type'        => 'dropdown',
								'description' => __('Select an accordion content style', 'rt_theme_admin' ),
								"value"       => array(
													__("Numbered", "rt_theme_admin") => "numbered",
													__("With Icons", "rt_theme_admin") => "icons", 
													__("Captions Only", "rt_theme_admin") => "only_captions"
												),
							),										

							array(
								'param_name'  => 'first_one_open',
								'heading'     => __('First content', 'rt_theme_admin' ),
								'description' => __('Keep the first section opened when the page loaded.', 'rt_theme_admin' ),
								'type'        => 'checkbox',
								"value"       => array(
													__("First one open", "rt_theme_admin") => "true",
												),
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
		'base'        => 'rt_accordion_content',
		'name'        => __( 'Accordion Content', 'rt_theme_admin' ),
		'icon'        => 'rt_theme accordion-content',
		'category'    => __( 'Contents', 'rt_theme_admin' ),
		'description' => __( 'Adds a new section to a accordion content.', 'rt_theme_admin' ),
		'as_child'    => array( 'only' => 'rt_accordion' ),
		'content_element' => true,
		'params'      => array(

							array(
								'param_name'  => 'title',
								'heading'     => __('Title', 'rt_theme_admin' ),
								'description' => __('Accordion Title', 'rt_theme_admin' ),
								'type'        => 'textfield',
								'value'       => __( 'Accordion Title', 'rt_theme_admin' ),
							),

							array(
								'param_name'  => 'content',
								'heading'     => __( 'Accordion Content', 'rt_theme_admin' ),
								'description' => '',
								'type'        => 'textarea_html',
								'holder'      => 'div',
								'value'       => __( 'I am text block. Click edit button to change this text.', 'rt_theme_admin' ),
								'holder'      => 'div',
							),

							array(
								'param_name'  => 'icon_name',
								'heading'     => __('Accordion Icon', 'rt_theme_admin' ),
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