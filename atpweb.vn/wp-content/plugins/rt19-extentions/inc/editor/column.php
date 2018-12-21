<?php
/*
*
* Column
* [Column] 
*
*/
vc_map_update( 'vc_column', array(
	'icon'        => 'content-band',
	'category'    => array(__( 'Structure', 'rt_theme_admin' ), __( 'Theme Addons', 'rt_theme_admin' )),
));


rt_vc_add_param( array('vc_column','vc_column_inner'), array(
	'param_name'  => 'rt_color_set',
	'heading'     => __( 'Column Color Scheme', 'rt_theme_admin' ),
	'description' => __( 'Select a color scheme for the column.', 'rt_theme_admin' ),
	'type'        => 'dropdown',
	"value"       => array(
						__("Global", "rt_theme_admin") => "global-style",
						__("Color Set 1", "rt_theme_admin") => "default-style",
						__("Color Set 2", "rt_theme_admin") => "alt-style-1",
						__("Color Set 3", "rt_theme_admin") => "alt-style-2",
						__("Color Set 4", "rt_theme_admin") => "light-style",
					)
));

//remove vc_column params
rt_vc_remove_param('vc_column', array('el_class','el_id','parallax','parallax_speed_bg','parallax_image','video_bg_url','video_bg','video_bg_parallax','parallax_speed_video'));
rt_vc_remove_param('vc_column_inner', array('el_class','el_id','parallax','parallax_speed_bg','parallax_image','video_bg_url','video_bg','video_bg_parallax','parallax_speed_video'));

			//column general options	
			rt_vc_add_param( array('vc_column','vc_column_inner'), array(
				'param_name'  => 'id',
				'heading'     => __('ID', 'rt_theme_admin' ),
				'description' => __('Unique ID', 'rt_theme_admin' ),
				'type'        => 'textfield',
				'value'       => ''
			));

			rt_vc_add_param( array('vc_column','vc_column_inner'), array(
				'param_name'  => 'class',
				'heading'     => __('Class', 'rt_theme_admin' ),
				'description' => __('CSS Class Name', 'rt_theme_admin' ),
				'type'        => 'textfield'
			));			

			rt_vc_add_param( array('vc_column','vc_column_inner'), array(
				'param_name'  => 'rt_min_height',
				'heading'     => _x( 'Minimum Height', 'Admin Panel','rt_theme_admin' ),
				'description' => _x( 'Set minimum height(px)', 'Admin Panel','rt_theme_admin' ),
				'type'        => 'textfield',
			));
			
			rt_vc_add_param( array('vc_column','vc_column_inner'), array(
				'param_name'  => 'rt_padding_top',
				'heading'     => __( 'Padding Top', 'rt_theme_admin' ),
				'description' => __( 'Set padding top value (px,%)', 'rt_theme_admin' ),
				'group'       => _x( 'Paddings', 'Admin Panel','rt_theme_admin' ),
				'type'        => 'rt_number',
			));

			rt_vc_add_param( array('vc_column','vc_column_inner'), array(
				'param_name'  => 'rt_padding_bottom',
				'heading'     => __( 'Padding Bottom', 'rt_theme_admin' ),
				'description' => __( 'Set padding bottom value (px,%)', 'rt_theme_admin' ),
				'group'       => _x( 'Paddings', 'Admin Panel','rt_theme_admin' ),
				'type'        => 'rt_number',
			));

			rt_vc_add_param( array('vc_column','vc_column_inner'), array(
				'param_name'  => 'rt_padding_left',
				'heading'     => __( 'Padding Left', 'rt_theme_admin' ),
				'description' => __( 'Set padding left value (px,%)', 'rt_theme_admin' ),
				'group'       => _x( 'Paddings', 'Admin Panel','rt_theme_admin' ),
				'type'        => 'rt_number',
			));

			rt_vc_add_param( array('vc_column','vc_column_inner'), array(
				'param_name'  => 'rt_padding_right',
				'heading'     => __( 'Padding Right', 'rt_theme_admin' ),
				'description' => __( 'Set padding right value (px,%)', 'rt_theme_admin' ),
				'group'       => _x( 'Paddings', 'Admin Panel','rt_theme_admin' ),
				'type'        => 'rt_number',
			));	

			rt_vc_add_param( array('vc_column','vc_column_inner'), array(
				'param_name'  => 'rt_wrp_col_paddings',
				'heading'     => _x( 'Column Wrapper Paddings', 'Admin Panel','rt_theme_admin' ),
				'description' => _x( 'Remove/add paddings (gaps) around the content of the column.', 'Admin Panel','rt_theme_admin' ),
				'type'        => 'dropdown',
				"value"       => array(
									_x("No Paddings", 'Admin Panel','rt_theme_admin') => "false",
									_x("Add Paddings", 'Admin Panel','rt_theme_admin') => "true"
								),						
				'group'       => _x( 'Paddings', 'Admin Panel','rt_theme_admin' ),
				'save_always' => true
			));

			rt_vc_add_param( array('vc_column','vc_column_inner'), array(
				'param_name'  => 'rt_wrp_padding_top',
				'heading'     => _x( 'Wrapper Padding Top', 'Admin Panel','rt_theme_admin' ),
				'description' => _x( 'Set padding top value (px,%) defauult: 0px', 'Admin Panel','rt_theme_admin' ),
				'type'        => 'rt_number',
				'group'       => _x( 'Paddings', 'Admin Panel','rt_theme_admin' ),
				"dependency"  => array(
										"element" => "rt_wrp_col_paddings",
										"value" => array("true")
									),		
			));

			rt_vc_add_param( array('vc_column','vc_column_inner'), array(
				'param_name'  => 'rt_wrp_padding_bottom',
				'heading'     => _x( 'Wrapper Padding Bottom', 'Admin Panel','rt_theme_admin' ),
				'description' => _x( 'Set padding bottom value (px,%) defauult: 0px', 'Admin Panel','rt_theme_admin' ),
				'type'        => 'rt_number',
				'group'       => _x( 'Paddings', 'Admin Panel','rt_theme_admin' ),
				"dependency"  => array(
										"element" => "rt_wrp_col_paddings",
										"value" => array("true")
									),	
			));

			rt_vc_add_param( array('vc_column','vc_column_inner'), array(
				'param_name'  => 'rt_wrp_padding_left',
				'heading'     => _x( 'Wrapper Padding Left', 'Admin Panel','rt_theme_admin' ),
				'description' => _x( 'Set padding left value (px,%) default: 40px', 'Admin Panel','rt_theme_admin' ),
				'type'        => 'rt_number',
				'group'       => _x( 'Paddings', 'Admin Panel','rt_theme_admin' ),
				"dependency"  => array(
										"element" => "rt_wrp_col_paddings",
										"value" => array("true")
									),	
			));

			rt_vc_add_param( array('vc_column','vc_column_inner'), array(
				'param_name'  => 'rt_wrp_padding_right',
				'heading'     => _x( 'Wrapper Padding Right', 'Admin Panel','rt_theme_admin' ),
				'description' => _x( 'Set padding right value (px,%) default: 40px', 'Admin Panel','rt_theme_admin' ),
				'type'        => 'rt_number',
				'group'       => _x( 'Paddings', 'Admin Panel','rt_theme_admin' ),
				"dependency"  => array(
										"element" => "rt_wrp_col_paddings",
										"value" => array("true")
									),	
			));	


			rt_vc_add_param( array('vc_column','vc_column_inner'), array(
				'param_name'  => 'rt_border_top',
				'heading'     => _x( 'Borders', 'Admin Panel','rt_theme_admin' ),
				"value"       => array(
									_x("Border Top", 'Admin Panel','rt_theme_admin') => "true"
								),							
				'type'        => 'checkbox',
				'save_always' => true
			));

			rt_vc_add_param( array('vc_column','vc_column_inner'), array(
				'param_name'  => 'rt_border_bottom',
				"value"       => array(
									_x("Border Bottom", 'Admin Panel','rt_theme_admin') => "true"
								),							
				'type'        => 'checkbox',
				'save_always' => true
			));

			rt_vc_add_param( array('vc_column','vc_column_inner'), array(
				'param_name'  => 'rt_border_left',
				"value"       => array(
									_x("Border Left", 'Admin Panel','rt_theme_admin') => "true"
								),							
				'type'        => 'checkbox',
				'save_always' => true
			));

			rt_vc_add_param( array('vc_column','vc_column_inner'), array(
				'param_name'  => 'rt_border_right',
				"value"       => array(
									_x("Border Right", 'Admin Panel','rt_theme_admin') => "true"
								),							
				'type'        => 'checkbox',
				'save_always' => true
			));	


			rt_vc_add_param( array('vc_column','vc_column_inner'), array(
				'param_name'  => 'rt_border_top_mobile',
				'heading'     => _x( 'Mobile Borders', 'Admin Panel','rt_theme_admin' ),
				"value"       => array(
									_x("Border Top", 'Admin Panel','rt_theme_admin') => "true"
								),							
				'type'        => 'checkbox',
				'save_always' => true
			));

			rt_vc_add_param( array('vc_column','vc_column_inner'), array(
				'param_name'  => 'rt_border_bottom_mobile',
				"value"       => array(
									_x("Border Bottom", 'Admin Panel','rt_theme_admin') => "true"
								),							
				'type'        => 'checkbox',
				'save_always' => true
			));

			rt_vc_add_param( array('vc_column','vc_column_inner'), array(
				'param_name'  => 'rt_border_left_mobile',
				"value"       => array(
									_x("Border Left", 'Admin Panel','rt_theme_admin') => "true"
								),							
				'type'        => 'checkbox',
				'save_always' => true
			));

			rt_vc_add_param( array('vc_column','vc_column_inner'), array(
				'param_name'  => 'rt_border_right_mobile',
				"value"       => array(
									_x("Border Right", 'Admin Panel','rt_theme_admin') => "true"
								),							
				'type'        => 'checkbox',
				'save_always' => true
			));	



			//column background options
			rt_vc_add_param( array('vc_column','vc_column_inner'), array(
				'param_name'  => 'rt_bg_holder',
				'heading'     => _x( 'Background Holder', 'Admin Panel','rt_theme_admin' ),
				'description' => _x( 'Select a background holder layer that you want to apply the background styles. Use "Column Wrapper" when you select seperate column views for the row.', 'Admin Panel','rt_theme_admin' ),
				'type'        => 'dropdown',
				"value"       => array(		
									_x("Column Container",'Admin Panel','rt_theme_admin') => "container",
									_x("Column Wrapper",'Admin Panel','rt_theme_admin') => "wrapper",
								),
				'group'       => _x( 'Background Options', 'Admin Panel','rt_theme_admin' )
			));

			rt_vc_add_param( array('vc_column','vc_column_inner'), array(
				'param_name'  => 'rt_bg_image',
				'heading'     => __( 'Background Image', 'rt_theme_admin' ),
				'description' => __( 'Select a background image', 'rt_theme_admin' ),
				'type'        => 'attach_image',	
				'group'       => __( 'Background Options', 'rt_theme_admin' ),
				'value'	     => '',
			));


			rt_vc_add_param( array('vc_column','vc_column_inner'), array(
				'param_name'  => 'rt_bg_color',
				'heading'     => __( 'Background Color', 'rt_theme_admin' ),
				'description' => __( 'Select a background color for the content row', 'rt_theme_admin' ),
				'type'        => 'colorpicker',
				'group'       => __( 'Background Options', 'rt_theme_admin' )
			));

			rt_vc_add_param( array('vc_column','vc_column_inner'), array(
				'param_name'  => 'rt_bg_image_repeat',
				'heading'     => __( 'Background Repeat', 'rt_theme_admin' ),
				'description' => __( 'Select and set repeat mode direction for the background image.', 'rt_theme_admin' ),
				'type'        => 'dropdown',
				"value"       => array(		
									__("Tile","rt_theme_admin") => "repeat",
									__("Tile Horizontally","rt_theme_admin") => "repeat-x",
									__("Tile Vertically","rt_theme_admin") => "repeat-y",
									__("No Repeat","rt_theme_admin") => "no-repeat"
								),
				'group'       => __( 'Background Options', 'rt_theme_admin' ),	
				'save_always' => true		
			));

			rt_vc_add_param( array('vc_column','vc_column_inner'), array(
				'param_name'  => 'rt_bg_size',
				'heading'     => __( 'Background Image Size', 'rt_theme_admin' ),
				'description' => __( 'Select and set size / coverage behaviour for the background image.', 'rt_theme_admin' ),
				'type'        => 'dropdown', 
				"value"       => array(		
									__("Auto","rt_theme_admin") => "auto auto",
									__("Cover","rt_theme_admin") => "cover",
									__("Contain","rt_theme_admin") => "contain",
									__("100%","rt_theme_admin") => "100% auto",
									__("50%","rt_theme_admin") => "50% auto",
									__("25%","rt_theme_admin") => "25% auto",
								),	
				'group'       => __( 'Background Options', 'rt_theme_admin' ),
				'save_always' => true
			));

			rt_vc_add_param( array('vc_column','vc_column_inner'), array(
				'param_name'  => 'rt_bg_position',
				'heading'     => __( 'Background Position', 'rt_theme_admin' ),
				'description' => __( 'Select a positon for the background image.', 'rt_theme_admin' ),
				'type'        => 'dropdown', 
				"value"       => array(		
									__("Right Top","rt_theme_admin") => "right top",
									__("Right Center","rt_theme_admin") => "right center",
									__("Right Bottom","rt_theme_admin") => "right bottom",
									__("Left Top","rt_theme_admin") => "left top",
									__("Left Center","rt_theme_admin") => "left center",
									__("Left Bottom","rt_theme_admin") => "left bottom",
									__("Center Top","rt_theme_admin") => "center top",
									__("Center Center","rt_theme_admin") => "center center",
									__("Center Bottom","rt_theme_admin") => "center bottom",
								),	
				'group'       => __( 'Background Options', 'rt_theme_admin' ),
				'save_always' => true
			));

			rt_vc_add_param( array('vc_column','vc_column_inner'), array(
				'param_name'  => 'rt_bg_attachment',
				'heading'     => __( 'Background Attachment', 'rt_theme_admin' ),
				'description' => __( 'Select and set fixed or scroll mode for the background image.', 'rt_theme_admin' ),
				'type'        => 'dropdown', 
				"value"       => array(		
									__("Scroll","rt_theme_admin") => "scroll",
									__("Fixed","rt_theme_admin") => "fixed",  
								),	
				'group'       => __( 'Background Options', 'rt_theme_admin' ),	
				'save_always' => true
			));		


?>