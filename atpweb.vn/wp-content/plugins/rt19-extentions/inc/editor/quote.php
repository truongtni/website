<?php
/*
*
* Quote 
*
*/ 

vc_map(
	array(
		'base'        => 'rt_quote',
		'name'        => __( 'Quote', 'rt_theme_admin' ),
		'icon'        => 'rt_theme quote',
		'category'    => array(__( 'Content', 'rt_theme_admin' ), __( 'Theme Addons', 'rt_theme_admin' )),
		'description' => __( 'Add a quote', 'rt_theme_admin' ),
		'params'      => array(

							array(
								'param_name'  => 'content',
								'heading'     => __( 'Text', 'rt_theme_admin' ),
								'description' => '',
								'type'        => 'textarea_html',
								'holder'      => 'div',
								'value'       => __( 'I am text block. Click edit button to change this text.', 'rt_theme_admin' ),
								'holder'      => 'div',
							),

							array(
								'param_name'  => 'name',
								'heading'     => __('Name', 'rt_theme_admin' ),
								'type'        => 'textfield',
								'value'       => ''
							),

							array(
								'param_name'  => 'position',
								'heading'     => __('Position', 'rt_theme_admin' ),
								'type'        => 'textfield',
								'value'       => ''
							),

							array(
								'param_name'  => 'link',
								'heading'     => __('Link', 'rt_theme_admin' ),
								'type'        => 'textfield',
								'value'       => ''
							),

							array(
								'param_name'  => 'link_title',
								'heading'     => __('Link Title', 'rt_theme_admin' ),
								'type'        => 'textfield'
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