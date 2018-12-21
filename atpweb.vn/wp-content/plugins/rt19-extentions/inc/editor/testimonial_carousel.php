<?php
/*
*
* Testimonial Carousel 
*
*/ 

vc_map(
	array(
		'base'        => 'testimonial_carousel',
		'name'        => __( 'Testimonial Carousel', 'rt_theme_admin' ),
		'icon'        => 'rt_theme carousel',
		'category'    => array(__( 'Content', 'rt_theme_admin' ), __( 'Theme Addons', 'rt_theme_admin' )),
		'description' => __( 'Displays testimonial posts within a carousel', 'rt_theme_admin' ),
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
								"description" => __("Column width of an item. Percent of the visible part.",'rt_theme_admin'),
								'type'        => 'dropdown',
								"value"       => array(
													"1/1" => "1/1",
													"1/2" => "1/2",
													"1/3" => "1/3",
													"1/4" => "1/4",
													"1/5" => "1/5", 
													"1/6" => "1/6", 
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
													"1/1" => "1",
													"1/2" => "2",													
													"1/3" => "3",													
													"1/4" => "4",													
													"1/5" => "5",													
													"1/6" => "6"	
												),
							),


 							array(
								'param_name'  => 'mobile_layout',
								'heading'     => __( 'Carousel Layout (Mobile)', 'rt_theme_admin' ),
								"description" => __("Visible image count for each slide on small screens.",'rt_theme_admin'),
								'type'        => 'dropdown',
								"value"       => array(
													__("Default","rt_theme_admin") => "",
													"1/1" => "1",
													"1/2" => "2",													
													"1/3" => "3",													
													"1/4" => "4",													
													"1/5" => "5",													
													"1/6" => "6"	
												),
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
								'param_name'  => 'max_item',
								'heading'     => __('Amount of item to display', 'rt_theme_admin' ),
								'type'        => 'rt_number',
								'value'       => '10',
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
													__("Enabled","rt_theme_admin") => "true", 
													__("Disabled","rt_theme_admin") => "false"												
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
								'param_name'  => 'loop',
								'heading'     => _x( 'Loop Items', 'Admin Panel','rt_theme_admin' ),
								'type'        => 'dropdown',
								"value"       => array(
													_x("Disabled",'Admin Panel','rt_theme_admin') => "false",
													_x("Enabled",'Admin Panel','rt_theme_admin') => "true"
												),
								'save_always' => true
							),
			
						)
	)
);	

?>