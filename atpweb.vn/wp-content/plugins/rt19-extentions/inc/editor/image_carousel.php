<?php
/*
*
* Image Carousel
* [rt_image_carousel] 
*
*/ 

vc_map(
	array(
		'base'        => 'rt_image_carousel',
		'name'        => __( 'Image Carousel', 'rt_theme_admin' ),
		'icon'        => 'rt_theme carousel',
		'category'    => array(__( 'Content', 'rt_theme_admin' ), __( 'Theme Addons', 'rt_theme_admin' )),
		'description' => __( 'Add an image carousel', 'rt_theme_admin' ),
		'params'      => array(

							array(
								'param_name'  => 'images',
								'heading'     => __('Images', 'rt_theme_admin' ),
								'description' => __('Select images for the carousel', 'rt_theme_admin' ),
								'type'        => 'attach_images',
								'value'	     => '',
							),

							array(
								'param_name'  => 'carousel_layout',
								'heading'     => __( 'Carousel Layout (Desktop)', 'rt_theme_admin' ),
								"description" => __("Visible image count for each slide",'rt_theme_admin'),
								'type'        => 'dropdown',
								"value"       => array(
													"1" => "1",
													"2" => "2",													
													"3" => "3",													
													"4" => "4",													
													"5" => "5",													
													"6" => "6",													
													"7" => "7",													
													"8" => "8",													
													"9" => "9", 
													"10" => "10"
													),
								'save_always' => true
							),


  							array(
								'param_name'  => 'tablet_layout',
								'heading'     => __( 'Carousel Layout (Tablet)', 'rt_theme_admin' ),
								"description" => __("Visible image count for each slide on medium screens.",'rt_theme_admin'),
								'type'        => 'dropdown',
								"value"       => array(
													__("Default","rt_theme_admin") => "",
													"1" => "1",
													"2" => "2",													
													"3" => "3",													
													"4" => "4",													
													"5" => "5",													
													"6" => "6"
													),
								'save_always' => true
							),

							array(
								'param_name'  => 'mobile_layout',
								'heading'     => __( 'Carousel Layout (Mobile)', 'rt_theme_admin' ),
								"description" => __("Visible image count for each slide on small screens.",'rt_theme_admin'),
								'type'        => 'dropdown',
								"value"       => array(
													__("Default","rt_theme_admin") => "",
													"1" => "1",
													"2" => "2",													
													"3" => "3",													
													"4" => "4"		 
													),
								'save_always' => true
							),

							array(
								'param_name'  => 'img_width',
								'heading'     => __('Max Image Width', 'rt_theme_admin' ),
								'description' => __('Set an maximum width value for the carousel images. Note: Remember that the carousel width will be fluid.', 'rt_theme_admin' ),
								'type'        => 'rt_number',
								'value'       => ''
							),

							array(
								'param_name'  => 'img_height',
								'heading'     => __('Max Image Height', 'rt_theme_admin' ),
								'description' => __('Set an maximum height value for the carousel images.', 'rt_theme_admin' ),
								'type'        => 'rt_number',
								'value'       => ''
							),

							array(
								'param_name'  => 'crop',
								'heading'     => __( 'Crop Images', 'rt_theme_admin' ),
								'type'        => 'dropdown',
								"value"       => array(
													__("Disabled","rt_theme_admin") => "false",
													__("Enabled","rt_theme_admin") => "true"
												),
								'save_always' => true
							),

							array(
								'param_name'  => 'nav',
								'heading'     => __( 'Navigation Arrows', 'rt_theme_admin' ),
								'type'        => 'dropdown',
								"value"       => array(
													__("Enabled","rt_theme_admin") => "true", 
													__("Disabled","rt_theme_admin") => "false"													
												),
								'save_always' => true						
							),

							array(
								'param_name'  => 'dots',
								'heading'     => __( 'Navigation Dots', 'rt_theme_admin' ),
								'type'        => 'dropdown',
								"value"       => array(
													__("Disabled","rt_theme_admin") => "false",	
													__("Enabled","rt_theme_admin") => "true"							
												),
								'save_always' => true						
							),

							array(
								'param_name'  => 'autoplay',
								'heading'     => __( 'Auto Play', 'rt_theme_admin' ),
								'type'        => 'dropdown',
								"value"       => array(												
													__("Disabled","rt_theme_admin") => "false",
													__("Enabled","rt_theme_admin") => "true"
												),
								'save_always' => true						
							),

							array(
								'param_name'  => 'timeout',
								'heading'     => __('Auto Play Speed (ms)', 'rt_theme_admin' ),
								'type'        => 'rt_number',
								'value'       => "",
								"description" => __("Auto play speed value in milliseconds. For example; set 5000 for 5 seconds",'rt_theme_admin'),
								"dependency"  => array(
													"element" => "autoplay",
													"value" => array("true")
												),
								'save_always' => true
							),

							array(
								'param_name'  => 'links',
								'heading'     => _x('Item Links', 'Admin Panel','rt_theme_admin' ),
								'type'        => 'dropdown',
								"value"       => array(
													_x("Orginal Images",'Admin Panel','rt_theme_admin') => "image",
													_x("Custom Links",'Admin Panel','rt_theme_admin') => "custom"
												),
								'save_always' => true
							),

							array(
								'param_name'  => 'custom_links',
								'heading'     => _x( 'Custom Links', 'Admin Panel','rt_theme_admin' ),
								'description' => _x("Enter links for each image. The links must be entered line by line. ( enter ) ",'Admin Panel','rt_theme_admin'),
								'type'        => 'exploded_textarea',
								"dependency"  => array(
														"element" => "links",
														"value" => array("custom")
													),								
							),

							array(
								'param_name'  => 'link_target',
								'heading'     => _x('Link Target', 'Admin Panel','rt_theme_admin' ),
								'type'        => 'dropdown',
								"value"       => array(
													_x("Same Tab", 'Admin Panel','rt_theme_admin') => "_self",
													_x("New Tab", 'Admin Panel','rt_theme_admin') => "_blank", 
												),
								"dependency"  => array(
														"element" => "links",
														"value" => array("custom")
													),											
								'save_always' => true
							),


							array(
								'param_name'  => 'lightbox',
								'heading'     => __( 'Open Orginal Images in Lightbox', 'rt_theme_admin' ),
								'type'        => 'dropdown',
								"value"       => array(
													__("Disabled","rt_theme_admin") => "false",
													__("Enabled","rt_theme_admin") => "true"
												),
								"dependency"  => array(
														"element" => "links",
														"value" => array("image")
													),											
								'save_always' => true
							),

							array(
								'param_name'  => 'margin',
								'heading'     => __('Item Margin', 'rt_theme_admin' ),
								'description' => __('Set a value for the margin between carousel items. Default is 15px', 'rt_theme_admin' ),
								'type'        => 'rt_number',
								'value'       => ''
							),


							array(
								'param_name'  => 'loop',
								'heading'     => _x( 'Loop Items', 'Admin Panel','rt_theme_admin' ),
								'type'        => 'dropdown',
								"value"       => array(
													_x("Disabled",'Admin Panel','rt_theme_admin') => "false",
													_x("Enabled",'Admin Panel','rt_theme_admin') => "true"
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