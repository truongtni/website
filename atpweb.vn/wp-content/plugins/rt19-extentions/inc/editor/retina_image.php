<?php
/*
*
* Retina Image
*
*/ 

vc_map(
	array(
		'base'        => 'rt_retina_image',
		'name'        => __( 'Retina Image', 'rt_theme_admin' ),
		'icon'        => 'rt_theme slider',
		'category'    => array(__( 'Content', 'rt_theme_admin' ), __( 'Theme Addons', 'rt_theme_admin' )),
		'description' => __( 'Add a image with retina device support', 'rt_theme_admin' ),
		'params'      => array(

							array(
								'param_name'  => 'img',
								'heading'     => __('Image', 'rt_theme_admin' ),
								'description' => __('Select an image from your media library. Make sure that you have selected at least 2x bigger image than the dimensions below for the retina version of the image. ', 'rt_theme_admin' ),
								'type'        => 'attach_image',
								'holder'      => 'img',
								'value'	     => '',
							),
   
							array(
								'param_name'  => 'img_width',
								'heading'     => __('Image Max Width', 'rt_theme_admin' ),
								'type'        => 'rt_number',
								'value'       => "",
								'save_always' => true
							),

							array(
								'param_name'  => 'img_height',
								'heading'     => __('Image Max Height', 'rt_theme_admin' ),
								'type'        => 'rt_number',
								'value'       => "",
								'save_always' => true
							),

							array(
								'param_name'  => 'crop',
								'heading'     => __( 'Crop', 'rt_theme_admin' ),
								'type'        => 'dropdown',
								"value"       => array(
													__("Disabled","rt_theme_admin") => "false",
													__("Enabled","rt_theme_admin") => "true"
												),
								'save_always' => true
							),

		 
							array(
								'param_name'  => 'img_align',
								'heading'     => __( 'Image Align', 'rt_theme_admin' ),
								'type'        => 'dropdown',
								"value"       => array(
													__("Default", "rt_theme_admin") => "",
													__("Left", "rt_theme_admin") => "left",
													__("Right", "rt_theme_admin") => "right", 
													__("Center", "rt_theme_admin") => "center", 
												),
								'save_always' => true							
							),

							array(
								'param_name'  => 'link',
								'heading'     => __('Link', 'rt_theme_admin' ),
								'type'        => 'textfield',
								'value'       => '',
								'group'       => 'Link'
							),

							array(
								'param_name'  => 'link_text',
								'heading'     => __('Link Text', 'rt_theme_admin' ),
								'type'        => 'textfield',
								'value'       => '',
								'group'       => 'Link'
							),

							array(
								'param_name'  => 'link_target',
								'heading'     => __('Link Target', 'rt_theme_admin' ),
								'type'        => 'dropdown',
								"value"       => array(
													__("Same Tab", "rt_theme_admin") => "_self",
													__("New Tab", "rt_theme_admin") => "_blank", 
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

?>