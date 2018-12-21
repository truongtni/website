<?php
/*
*
* Testimonials
*
*/ 

vc_map(
	array(
		'base'        => 'staff_box',
		'name'        => __( 'Team', 'rt_theme_admin' ),
		'icon'        => 'rt_theme rt_team',
		'category'    => array(__( 'Content', 'rt_theme_admin' ), __( 'Theme Addons', 'rt_theme_admin' )),
		'description' => __( 'Displays team members', 'rt_theme_admin' ),
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
								'param_name'  => 'ids',
								'heading'     => __( 'Select Members', 'rt_theme_admin' ),
								"description" => __("List posts of selected memebers only.",'rt_theme_admin'),
								'type'        => 'dropdown_multi',
								"value"       => array_merge(array(__('All Members','rt_theme_admin')=>""),array_flip(rt_get_staff_list())),
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
			
						)
	)
);	

?>