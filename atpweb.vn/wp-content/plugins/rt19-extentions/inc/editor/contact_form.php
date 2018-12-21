<?php
/*
*
* Contact Form Shortcode 
*
*/ 

global $current_user; 

vc_map(
	array(
		'base'        => 'contact_form',
		'name'        => __( 'Contact Form', 'rt_theme_admin' ),
		'icon'        => 'rt_theme contact_form',
		'category'    => array( __( 'Theme Addons', 'rt_theme_admin' ) ),
		'description' => __( 'Displays a contact form', 'rt_theme_admin' ),
		'params'      => array(

							array(
								'param_name'  => 'email',
								'heading'     => __('Email', 'rt_theme_admin' ),
								'description' => __('The contact form will be submited to this email.', 'rt_theme_admin' ),
								'type'        => 'textfield',
								'value'       => $current_user->user_email,
								'save_always' => true
							),

							array(
								'param_name'  => 'security',
								'heading' => __( 'Security Question', 'rt_theme_admin' ),
								'type'        => 'checkbox',
								"value"       => array(
													__("Enable the security question to prevent spam messages.", "rt_theme_admin") => "true",
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
							)
			
						)
	)
);	

?>