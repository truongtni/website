<?php
/*
*
* 	RT Pricing Tables
*
*	[pricing_table]
*		[table_column]
*		<ul>
*		<li></li>
*		</ul>
*		[/table_column]
*	
*		[table_column]
*		<ul>
*		<li></li>
*		</ul>
*		[/table_column]
*	[/pricing_table]
*
*/
 

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_rt_pricing_table extends WPBakeryShortCodesContainer { }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_rt_table_column extends WPBakeryShortCode { }
}

vc_map(
	array(
		'base'        => 'rt_pricing_table',
		'name'        => __( 'Pricing Table', 'rt_theme_admin' ),
		'icon'        => 'rt_theme pricing_table',
		'category'    => array(__( 'Content', 'rt_theme_admin' ), __( 'Theme Addons', 'rt_theme_admin' )),
		'description' => __( 'Pricing Table Holder', 'rt_theme_admin' ),
		'as_parent'    => array( 'only' => 'rt_table_column' ),
		'js_view'       => 'VcColumnView',
		'content_element' => true,
		"show_settings_on_create" => false,
		'default_content' => '

			[rt_table_column caption="BASIC PACKAGE" price="$19" info="yearly plan"]
			<ul>
			<li>[tooltip text="Tooltip Text"]Description With Tooltip[/tooltip]</li>
			<li>10 MB Max File Size</li>
			<li>1 GHZ CPU</li>
			<li>256 MB Memory</li>
			<li>[button button_link="#" button_text="BUY NOW" button_size="medium" button_icon="icon-basket"]</li>
			</ul>
			[/rt_table_column]

			[rt_table_column caption="PRO PACKAGE" price="49$" info="yearly plan" style="highlight"]
			<ul>
			<li>[tooltip text="Tooltip Text"]Description With Tooltip[/tooltip]</li>
			<li>20 MB Max File Size</li>
			<li>2 GHZ CPU</li>
			<li>512 MB Memory</li>
			<li>[button button_link="#" button_text="BUY NOW" button_size="medium" button_icon="icon-basket"]</li>
			</ul>
			[/rt_table_column]

			[rt_table_column caption="DEVELOPER PACKAGE" price="$109" info="monthly plan"]
			<ul>
			<li>[tooltip text="Tooltip Text"]Description With Tooltip[/tooltip]</li>
			<li>200 MB Max File Size</li>
			<li>3 GHZ CPU</li>
			<li>1000 MB Memory</li>
			<li>[button button_link="#" button_text="BUY NOW" button_size="medium" button_icon="icon-basket"]</li>
			</ul>
			[/rt_table_column]

		',

		'params'      => array(
 

							array(
								'param_name'  => 'style',
								'heading'     => __('Table Style', 'rt_theme_admin' ),
								'type'        => 'dropdown',
								"value"       => array(
													__("Service", "rt_theme_admin") => "service"
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
		'base'        => 'rt_table_column',
		'name'        => __( 'Table Column', 'rt_theme_admin' ),
		'icon'        => 'rt_theme list_line sub',
		'category'    => __( 'Contents', 'rt_theme_admin' ),
		'description' => __( 'Adds a new tab to a tabular content.', 'rt_theme_admin' ),
		'as_child'    => array( 'only' => 'rt_pricing_table' ),
		'content_element' => true,
		'params'      => array(


							array(
								'param_name'  => 'style',
								'heading'     => __('Column Type', 'rt_theme_admin' ),
								'type'        => 'dropdown',
								"value"       => array(
													__("Regular column", "rt_theme_admin") => "",
													__("Highlighted column", "rt_theme_admin") => "highlight",
												),
								'save_always' => true
							),

							array(
								'param_name'  => 'caption',
								'heading'     => __('Caption', 'rt_theme_admin' ),
								'description' => __('Column caption', 'rt_theme_admin' ),
								'type'        => 'textfield',
								'value'       => __( 'Package Name', 'rt_theme_admin' ),
								'save_always' => true							
							),

							array(
								'param_name'  => 'info',
								'heading'     => __('Caption', 'rt_theme_admin' ),
								'description' => __('Column caption', 'rt_theme_admin' ),
								'type'        => 'textfield',
								'value'       => __( 'Caption', 'rt_theme_admin' ),
								'save_always' => true
							),


							array(
								'param_name'  => 'price',
								'heading'     => __('Price', 'rt_theme_admin' ),
								'type'        => 'textfield'						
							),

							array(
								'param_name'  => 'content',
								'heading'     => __( 'Tab Content', 'rt_theme_admin' ),
								'description' => '',
								'type'        => 'textarea_html',
								'holder'      => 'div',
								'value'       => __( '
													<ul>
														<li>[tooltip text="Tooltip Text"]Description With Tooltip[/tooltip]</li>
														<li>200 MB Max File Size</li>
														<li>3 GHZ CPU</li>
														<li>1000 MB Memory</li>
														<li>[button button_link="#" button_text="BUY NOW" button_size="medium" button_icon="icon-basket"]</li>
													</ul>
													', 'rt_theme_admin' ),
								'holder'      => 'div',
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