<?php
/*
*
* Latest News
*
*/ 

vc_map(
	array(
		'base'        => 'rt_latest_news',
		'name'        => __( 'Latest News', 'rt_theme_admin' ),
		'icon'        => 'rt_theme latest_news',
		'category'    => array(__( 'Content', 'rt_theme_admin' ), __( 'Theme Addons', 'rt_theme_admin' )),
		'description' => __( 'Displays blog posts with latest news style', 'rt_theme_admin' ),
		'params'      => array(

 							array(
								'param_name'  => 'style',
								'heading'     => __( 'Style', 'rt_theme_admin' ),
								'type'        => 'dropdown',
								"value"       => array(
													__('Style 1 - Big Dates','rt_theme_admin') => '1',
													__('Style 2- Featured Images','rt_theme_admin') => '2', 
												),
								'save_always' => true
							),

							array(
								'param_name'  => 'show_dates',
								'heading'     => __('Display Post Dates?', 'rt_theme_admin' ),
								'type'        => 'checkbox',
								"value"       => array(
													__("Yes", "rt_theme_admin") => "true"
								),			
								"dependency"  => array(
									"element" => "style",
									"value" => array("2")
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
								'param_name'  => 'max_item',
								'heading'     => __('Amount of item to display', 'rt_theme_admin' ),
								'type'        => 'rt_number',
								'value'       => '10',
								'save_always' => true
							),


							array(
								'param_name'  => 'excerpt_length',
								'heading'     => __('Excerpt Length', 'rt_theme_admin' ),
								'type'        => 'rt_number',
								'value'       => '100',
								'save_always' => true
							),

							array(
								'param_name'  => 'list_orderby',
								'heading'     => __( 'List Order By', 'rt_theme_admin' ),
								"description" => __("Sorts the posts by this parameter",'rt_theme_admin'),
								'type'        => 'dropdown',
								"value"       => array(
													__('Date','rt_theme_admin') => 'date',
													__('Author','rt_theme_admin') => 'author',
													__('Title','rt_theme_admin') => 'title',
													__('Modified','rt_theme_admin') => 'modified',
													__('ID','rt_theme_admin') => 'ID',
													__('Randomized','rt_theme_admin') => 'rand',
												),
								'save_always' => true
							),

							array(
								'param_name'  => 'list_order',
								'heading'     => __( 'List Order', 'rt_theme_admin' ),
								"description" => __("Designates the ascending or descending order of the list_orderby parameter",'rt_theme_admin'),
								'type'        => 'dropdown',
								"value"       => array(
													__('Descending','rt_theme_admin') => 'DESC',
													__('Ascending','rt_theme_admin') => 'ASC',
												),
								'save_always' => true
							),


							array(
								'param_name'  => 'categories',
								'heading'     => __( 'Categories', 'rt_theme_admin' ),
								"description" => __("List posts of selected categories only.",'rt_theme_admin'),
								'type'        => 'dropdown_multi',
								"value"       => array_merge(array(__('All Categories','rt_theme_admin')=>""),array_flip(rt_get_categories())),
								'save_always' => true
							),


							/* Featured Images */
							array(
								'param_name'  => 'image_width',
								'heading'     => __('Featured Image Max Width', 'rt_theme_admin' ),
								'type'        => 'textfield',
								'value'       => 250,
								"dependency"  => array(
													"element" => "style",
													"value" => array("2")
												),
								'save_always' => true
							),

							array(
								'param_name'  => 'image_height',
								'heading'     => __('Featured Image Max Height', 'rt_theme_admin' ),
								'type'        => 'textfield',
								'value'       => 250,
								"dependency"  => array(
													"element" => "style",
													"value" => array("2")
												),
								'save_always' => true
							),


			
						)
	)
);	

?>