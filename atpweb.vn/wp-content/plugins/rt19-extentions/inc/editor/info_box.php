<?php
/*
*
* Info Box
*
*/ 

vc_map(
	array(
		'base'        => 'info_box',
		'name'        => __( 'Info Box', 'rt_theme_admin' ),
		'icon'        => 'rt_theme info_box',
		'category'    => array(__( 'Content', 'rt_theme_admin' ), __( 'Theme Addons', 'rt_theme_admin' )),
		'description' => __( 'Adds a info box', 'rt_theme_admin' ),
		'params'      => array(

							array(
								'param_name'  => 'content',
								'heading'     => __( 'Text', 'rt_theme_admin' ),
								'description' => '',
								'type'        => 'textarea_html',
								'holder'      => 'div',
								'value'       => __( 'I am text block. Click edit button to change this text.', 'rt_theme_admin' ),
								'holder'      => 'span',
								'save_always' => true
							),
 
							array(
								'param_name'  => 'style',
								'heading'     => __( 'Button Size', 'rt_theme_admin' ),
								'type'        => 'dropdown',
								"value"       => array(
													__("Announcement","rt_theme_admin")=>"announcement",
													__("Ok","rt_theme_admin")=>"ok",
													__("Attention","rt_theme_admin")=>"attention",
													__("Info","rt_theme_admin")=>"info",
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

?>