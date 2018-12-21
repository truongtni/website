<?php
/*
*
* Product Categories
*
*/ 

vc_map(
	array(
		'base'        => 'rt_product_categories',
		'name'        => __( 'Product Showcase Categories', 'rt_theme_admin' ),
		'icon'        => 'rt_theme product_box',
		'category'    => array(__( 'Content', 'rt_theme_admin' ), __( 'Theme Addons', 'rt_theme_admin' )),
		'description' => __( 'Displays product showcase categories with selected parameters', 'rt_theme_admin' ),
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
								'param_name'  => 'layout_style',
								'heading'     => __( 'Layout Style', 'rt_theme_admin' ),
								"description" => __("Design of the layout",'rt_theme_admin'),
								'type'        => 'dropdown',
								"value"       => array(
													__("Grid","rt_theme_admin") => "grid",
													__("Masonry","rt_theme_admin") => "masonry" 
												),
								'save_always' => true
							),
  

							array(
								'param_name'  => 'orderby',
								'heading'     => __( 'Order By', 'rt_theme_admin' ),
								"description" => __("Sorts the categories by this parameter",'rt_theme_admin'),
								'type'        => 'dropdown',
								"value"       => array(
														__('ID','rt_theme_admin') => 'id',
														__('Name','rt_theme_admin') => 'name',
														__('Slug','rt_theme_admin') => 'slug', 
														__('Count','rt_theme_admin') => 'count',
													),
								'save_always' => true
							),

							array(
								'param_name'  => 'order',
								'heading'     => __( 'List Order', 'rt_theme_admin' ),
								"description" => __("Designates the ascending or descending order of the orderby parameter",'rt_theme_admin'),
								'type'        => 'dropdown',
								"value"       => array(
														__('Descending','rt_theme_admin') => 'DESC',
														__('Ascending','rt_theme_admin') => 'ASC',
													),
								'save_always' => true
							),


							array(
								'param_name'  => 'parent',
								'heading'     => __( 'Parent Category', 'rt_theme_admin' ),
								"description" => __("(Optional) Select a parent category to list only the subcategories of the category.",'rt_theme_admin'),
								'type'        => 'dropdown',
								"value"       => array_merge(array(__('All Categories','rt_theme_admin')=>""),array_flip(rt_get_product_categories())),
								'save_always' => true
							),

							array(
								'param_name'  => 'ids',
								'heading'     => __( 'Select Product Categories', 'rt_theme_admin' ),
								"description" => __("(Optional) List only selected categories",'rt_theme_admin'),
								'type'        => 'dropdown_multi',
								"value"       => array_merge(array(__('All Categories','rt_theme_admin')=>""),array_flip(rt_get_product_categories())),
								'save_always' => true
							),


							array(
								'param_name'  => 'display_titles',
								'heading'     => __("Display titles", "rt_theme_admin"),
								'type'        => 'dropdown',
								"value"       => array(
													__('Yes','rt_theme_admin') => 'true',
													__('No','rt_theme_admin') => 'false',
												),
								'save_always' => true
							),

							array(
								'param_name'  => 'display_descriptions',
								'heading'     => __("Display short descriptions", "rt_theme_admin"),
								'type'        => 'dropdown',
								"value"       => array(
													__('Yes','rt_theme_admin') => 'true',
													__('No','rt_theme_admin') => 'false',
												),
								'save_always' => true
							),

							array(
								'param_name'  => 'display_thumbnails',
								'heading'     => __("Display thumbnails", "rt_theme_admin"),
								'type'        => 'dropdown',
								"value"       => array(
													__('Yes','rt_theme_admin') => 'true',
													__('No','rt_theme_admin') => 'false',
												),
								'save_always' => true
							),
 

							/* Featured Images */
							array(
								'param_name'  => 'crop',
								'heading'     => __( 'Crop Featured Images', 'rt_theme_admin' ),
								'type'        => 'dropdown',	
								"description" => __("If enabled the category thumbnails will be cropped according the 'Maximum Thumbnail Height' value.",'rt_theme_admin'),
								"value"       => array(
													__("Disabled","rt_theme_admin") => "false",
													__("Enabled","rt_theme_admin") => "true"
												), 
								'save_always' => true
							),

							array(
								'param_name'  => 'image_max_height',
								'heading'     => __('Featured Image Max Height', 'rt_theme_admin' ),
								'type'        => 'textfield',
								"description" => __("Maximum image height for the category thumbnails. 'Crop Thumbnails' option must be checked in order to use this option.",'rt_theme_admin'),
								'value'       => "", 
								'save_always' => true
							),


			
						)
	)
);	

?>