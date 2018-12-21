<?php
/*
*
* Counter
*
*/ 

vc_map(
	array(
		'base'        => 'rt_counter',
		'name'        => __( 'Animated Number', 'rt_theme_admin' ),
		'icon'        => 'rt_theme rt_counter',
		'category'    => array(__( 'Content', 'rt_theme_admin' ), __( 'Theme Addons', 'rt_theme_admin' )),
		'description' => __( 'Add an animated number', 'rt_theme_admin' ),
		'params'      => array(

  
							array(
								'param_name'  => 'id',
								'heading'     => __('ID', 'rt_theme_admin' ),
								'description' => __('Unique ID', 'rt_theme_admin' ),
								'type'        => 'textfield',
								'value'       => ''
							),

							array(
								'param_name'  => 'number',
								'heading'     => __('Number', 'rt_theme_admin' ),
								'type'        => 'rt_number',
								'value'       => '99',
								'holder'      => 'h2',
								'save_always' => true
							),

							array(
								'param_name'  => 'content',
								'heading'     => __( 'Description', 'rt_theme_admin' ),
								'description' => '',
								'type'        => 'textfield',
								'holder'      => 'div',
								'value'       => __( 'Number Description', 'rt_theme_admin' ),
								'holder'      => 'span',
								'save_always' => true
							), 


						)
	)
);	

?>