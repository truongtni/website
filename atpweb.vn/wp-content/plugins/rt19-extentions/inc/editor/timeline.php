<?php
/*
*
* RT Timeline
* [rt_timeline]
*  [rt_tl_event][/rt_tl_event] 
*  [rt_tl_event][/rt_tl_event] 
*  [rt_tl_event][/rt_tl_event] 
* [/rt_timeline]
*
*/

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_rt_timeline extends WPBakeryShortCodesContainer { }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_rt_tl_event extends WPBakeryShortCode { }
}

vc_map(
	array(
		'base'        => 'rt_timeline',
		'name'        => __( 'Timeline Events', 'rt_theme_admin' ),
		'icon'        => 'rt_theme timeline',
		'category'    => array(__( 'Content', 'rt_theme_admin' ), __( 'Theme Addons', 'rt_theme_admin' )),
		'description' => __( 'Timeline holder', 'rt_theme_admin' ),
		'as_parent'    => array( 'only' => 'rt_tl_event' ),
		'js_view'       => 'VcColumnView',
		'content_element' => true,
		"show_settings_on_create" => false,
		'default_content' => '
			[rt_tl_event day="01" month="January" year="2015" title="Title"]<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum non dolor ultricies, porttitor justo non, pretium mi.</p>[/rt_tl_event]
			[rt_tl_event day="01" month="February" year="2015" title="Title"]<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum non dolor ultricies, porttitor justo non, pretium mi.</p>[/rt_tl_event]
			[rt_tl_event day="01" month="March" year="2015" title="Title"]<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum non dolor ultricies, porttitor justo non, pretium mi.</p>[/rt_tl_event]
		',		
		'params'      => array(

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
		'base'        => 'rt_tl_event',
		'name'        => __( 'Event', 'rt_theme_admin' ),
		'icon'        => 'code',
		'category'    => __( 'Contents', 'rt_theme_admin' ),
		'description' => __( 'Adds a new event to the timeline', 'rt_theme_admin' ),
		'as_child'    => array( 'only' => 'rt_timeline' ),
		'content_element' => true,
		'params'      => array(
							
							array(
								'param_name'  => 'title',
								'heading'     => __( 'Title', 'rt_theme_admin' ),
								'description' => '',
								'type'        => 'textfield',
								'holder'      => 'h4',
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
								'param_name'  => 'day',
								'heading'     => __('Event Day', 'rt_theme_admin' ),
								'description' => __('Day', 'rt_theme_admin' ),
								'type'        => 'textfield',
								'class'       => 'icon_selector',
							),

							array(
								'param_name'  => 'month',
								'heading'     => __('Event Month', 'rt_theme_admin' ),
								'description' => __('Month', 'rt_theme_admin' ),
								'type'        => 'textfield',
								'class'       => 'icon_selector',
							),

							array(
								'param_name'  => 'year',
								'heading'     => __('Event Year', 'rt_theme_admin' ),
								'description' => __('Year', 'rt_theme_admin' ),
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