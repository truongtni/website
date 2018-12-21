<?php
/*
*
* RT Image Gallery
* [rt_image_gallery]
*  [rt_gal_item][/rt_gal_item] 
*  [rt_gal_item][/rt_gal_item] 
*  [rt_gal_item][/rt_gal_item] 
* [/rt_image_gallery]
*
*/

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_rt_image_gallery extends WPBakeryShortCodesContainer { }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_rt_gal_item extends WPBakeryShortCode { }
}

vc_map(
	array(
		'base'        => 'rt_image_gallery',
		'name'        => __( 'Image Gallery Grid', 'rt_theme_admin' ),
		'icon'        => 'rt_theme img_gallery_grid',
		'category'    => array(__( 'Content', 'rt_theme_admin' ), __( 'Theme Addons', 'rt_theme_admin' )),
		'description' => __( 'Image gallery holder', 'rt_theme_admin' ),
		'as_parent'   => array( 'only' => 'rt_gal_item' ),
		'js_view'     => 'VcColumnView',
		'content_element' => true,
		"show_settings_on_create" => false,	
		'params'      => array(

							array(
								'param_name'  => 'list_layout',
								'heading'     => __( 'Layout', 'rt_theme_admin' ),
								"description" => __("Column layout for the list",'rt_theme_admin'),
								'type'        => 'dropdown',
								"value"       => array(
													"1/6" => "1/6", 
													"1/4" => "1/4",
													"1/3" => "1/3",
													"1/2" => "1/2",
													"1/1" => "1/1"
												),
								'save_always' => true
							),

							array(
								'param_name'  => 'crop',
								'heading'     => __('Crop', 'rt_theme_admin' ),
								'type'        => 'checkbox',
								"value"       => array(
													__("Crop Images", "rt_theme_admin") => "true",
												),
								'save_always' => true
							),
							
							array(
								'param_name'  => 'tooltips',
								'heading'     => __('Tooltips', 'rt_theme_admin' ),
								'type'        => 'checkbox',
								"value"       => array(
													__("Enable Tooltips", "rt_theme_admin") => "true",
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
 

vc_map(
	array(
		'base'        => 'rt_gal_item',
		'name'        => __( 'Image', 'rt_theme_admin' ),
		'icon'        => 'code',
		'category'    => __( 'Contents', 'rt_theme_admin' ),
		'description' => __( 'Adds a new content block to the chained content group', 'rt_theme_admin' ),
		'as_child'    => array( 'only' => 'rt_image_gallery' ),
		'content_element' => true,
		'params'      => array(

							array(
								'param_name'  => 'image_id',
								'heading'     => __('Image', 'rt_theme_admin' ),
								'description' => __('Select an image', 'rt_theme_admin' ),
								'type'        => 'attach_image',
								'holder'      => 'img',
								'value'	     => '',
							),
 
							array(
								'param_name'  => 'title',
								'heading'     => __( 'Title', 'rt_theme_admin' ),
								'description' => '',
								'type'        => 'textfield',
								'holder'      => 'h4',
							),

							array(
								'param_name'  => 'content',
								'heading'     => __( 'Caption', 'rt_theme_admin' ),
								'description' => '',
								'type'        => 'textarea_html',
								'holder'      => 'div',
								'value'       => __( '<p>Optional caption text</p>', 'rt_theme_admin' ),
								'holder'      => 'div',
								'save_always' => true
							),
							

							//link
							array(
								'param_name'  => 'action',
								'heading'     => __('Action', 'rt_theme_admin' ),
								'type'        => 'dropdown',
								'value'       => array(
													__("Open orginal image in a lightbox", "rt_theme_admin") => "lightbox",
													__("Link the thumbnail to the custom link", "rt_theme_admin") => "custom_link", 
													__("No link", "rt_theme_admin") => "no_link", 
												), 
								'save_always' => true
							),


							//link
							array(
								'param_name'  => 'custom_link',
								'heading'     => __('Custom Link', 'rt_theme_admin' ),
								'type'        => 'textfield',
								'value'       => '',
								"dependency"  => array(
												"element" => "action",
												"value" => array("custom_link")
								),									
							),
 
							array(
								'param_name'  => 'link_target',
								'heading'     => __('Link Target', 'rt_theme_admin' ),
								'type'        => 'dropdown',
								"value"       => array(
													__("Same Tab", "rt_theme_admin") => "_self",
													__("New Tab", "rt_theme_admin") => "_blank", 
												),
								"dependency"  => array(
												"element" => "action",
												"value" => array("custom_link")	
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