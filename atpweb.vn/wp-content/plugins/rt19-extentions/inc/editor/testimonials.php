<?php
/*
*
* Testimonials
*
*/ 

vc_map(
	array(
		'base'        => 'testimonial_box',
		'name'        => __( 'Testimonials', 'rt_theme_admin' ),
		'icon'        => 'rt_theme testimonial',
		'category'    => array(__( 'Content', 'rt_theme_admin' ), __( 'Theme Addons', 'rt_theme_admin' )),
		'description' => __( 'Displays testimonial posts', 'rt_theme_admin' ),
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
													"1/1" => "1/1",
													"1/2" => "1/2",
													"1/3" => "1/3",
													"1/4" => "1/4",
													"1/6" => "1/6", 
												),
								'save_always' => true
							),
 
 							array(
								'param_name'  => 'style',
								'heading'     => __( 'Style', 'rt_theme_admin' ),
								'type'        => 'dropdown',
								"value"       => array(
													__("Left Aligned Text","rt_theme_admin") => "left",
													__("Centered Small Text ","rt_theme_admin") => "center",
													__("Centered Big Text ","rt_theme_admin") => "center big"
												),
								'save_always' => true
							),

							
							array(
								'param_name'  => 'client_images',
								'heading'     => __( 'Display Client Images', 'rt_theme_admin' ),
								'type'        => 'dropdown',
								"value"       => array(
													__("Enabled","rt_theme_admin") => "true", 
													__("Disabled","rt_theme_admin") => "false"													
												),
								'save_always' => true										
							),
							
							array(
								'param_name'  => 'pagination',
								'heading'     => __( 'Pagination', 'rt_theme_admin' ),
								"description" => __("Splits the list into pages",'rt_theme_admin'),
								'type'        => 'dropdown',
								"value"       => array(
													"False" => "false", 
													"True" => "true"													
												),
								'save_always' => true										
							),

/*
							array(
								'param_name'  => 'ids',
								'heading'     => __( 'Select Testimonials', 'rt_theme_admin' ),
								"description" => __("List posts of selected posts only.",'rt_theme_admin'),
								'type'        => 'dropdown_multi',
								"value"       => array_merge(array(__('All Testimonials','rt_theme_admin')=>""),array_flip(RTTheme::rt_get_testimonial_list())),
							),
*/

							array(
								'param_name'  => 'categories',
								'heading'     => __( 'Categories', 'rt_theme_admin' ),
								"description" => __("List posts of selected categories only.",'rt_theme_admin'),
								'type'        => 'dropdown_multi',
								"value"       => array_merge(array(__('All Categories','rt_theme_admin')=>""),array_flip(rt_get_testimonial_categories())),
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
								'param_name'  => 'item_per_page',
								'heading'     => __('Amount of post per page', 'rt_theme_admin' ),
								'type'        => 'textfield'
							),
 
			
						)
	)
);	

?>