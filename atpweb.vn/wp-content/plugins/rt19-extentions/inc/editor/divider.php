<?php
/*
*
* Seperator
*
*/
vc_map_update( 'vc_separator', array(
	'category'    => array(__( 'Content', 'rt_theme_admin' ), __( 'Theme Addons', 'rt_theme_admin' )),
));

//remove vc_row params
rt_vc_remove_param('vc_separator', array('color','el_width','el_class','style','accent_color','css','align','border_width'));

vc_add_param( 'vc_separator',array(
	'param_name'  => 'style',
	'heading'     => __( 'Style', 'rt_theme_admin' ),
	'description' => __( 'Select a style', 'rt_theme_admin' ),
	'type'        => 'dropdown',
	"value"       => array(
						__("Style One - Three Circle", "rt_theme_admin") => "style-1",
						__("Style Two - Small Left Aligned Line", "rt_theme_admin") => "style-2", 
						__("Style Three - With Down Arrow", "rt_theme_admin") => "style-3", 						
						__("Style Four - Classic One Line", "rt_theme_admin") => "style-4", 
						__("Style Five - Double Line", "rt_theme_admin") => "style-5", 
						__("Style Six - Small Center Aligned Line", "rt_theme_admin") => "style-6", 
					),
	'save_always' => true
));


vc_add_param( 'vc_separator', array(
	'param_name'  => 'color',
	'heading'     => __( 'Custom Color', 'rt_theme_admin' ),
	'description' => __( 'Color of the border.', 'rt_theme_admin' ),
	'type'        => 'colorpicker',
	"dependency"  => array(
						"element" => "style",
						"value" => array("style-2","style-4","style-5","style-6")
					), 
));

vc_add_param( 'vc_separator', array(
	'param_name'  => 'border_width',
	'heading'     => __( 'Custom Border Width', 'rt_theme_admin' ),
	'description' => __( 'Set border width value (px)', 'rt_theme_admin' ),
	'type'        => 'rt_number',
	"dependency"  => array(
						"element" => "style",
						"value" => array("style-2","style-4","style-5","style-6")
					),
));

vc_add_param( 'vc_separator', array(
	'param_name'  => 'margin_top',
	'heading'     => __( 'Custom Margin Top', 'rt_theme_admin' ),
	'description' => __( 'Set margin top value (px) Default is 40px', 'rt_theme_admin' ),
	'type'        => 'rt_number', 
));

vc_add_param( 'vc_separator', array(
	'param_name'  => 'margin_bottom',
	'heading'     => __( 'Custom Margin Bottom', 'rt_theme_admin' ),
	'description' => __( 'Set margin bottom value (px) Default is 40px', 'rt_theme_admin' ),
	'type'        => 'rt_number',
));

vc_add_param( 'vc_separator', array(
	'param_name'  => 'width',
	'heading'     => __( 'Custom Width', 'rt_theme_admin' ),
	'description' => __( 'Set a custom width value (px,%)', 'rt_theme_admin' ),
	'type'        => 'rt_number', 
));

vc_add_param( 'vc_separator',array(
	'param_name'  => 'id',
	'heading'     => __('ID', 'rt_theme_admin' ),
	'description' => __('Unique ID', 'rt_theme_admin' ),
	'type'        => 'textfield',
	'value'       => ''
));

vc_add_param( 'vc_separator',array(
	'param_name'  => 'class',
	'heading'     => __('Class', 'rt_theme_admin' ),
	'description' => __('CSS Class Name', 'rt_theme_admin' ),
	'type'        => 'textfield'
));

?>