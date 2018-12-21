<?php
/*
*
* 	RT Compare Tables
*
*	[rt_compare_table]
*		[rt_compare_table_column]
*		<ul>
*		<li></li>
*		</ul>
*		[/rt_compare_table_column]
*	
*		[rt_compare_table_column]
*		<ul>
*		<li></li>
*		</ul>
*		[/rt_compare_table_column]
*	[/rt_compare_table]
*
*/
 

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_rt_compare_table extends WPBakeryShortCodesContainer { }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_rt_compare_table_column extends WPBakeryShortCode { }
}

vc_map(
	array(
		'base'        => 'rt_compare_table',
		'name'        => __( 'Compare Table', 'rt_theme_admin' ),
		'icon'        => 'rt_theme comp_table',
		'category'    => array(__( 'Content', 'rt_theme_admin' ), __( 'Theme Addons', 'rt_theme_admin' )),
		'description' => __( 'Compare Table Holder', 'rt_theme_admin' ),
		'as_parent'    => array( 'only' => 'rt_compare_table_column' ),
		'js_view'       => 'VcColumnView',
		'content_element' => true,
		"show_settings_on_create" => false,
		'default_content' => '

			[rt_compare_table_column style="features"]
			<ul>
			<li>Use Tooltips</li>
			<li>Use Icons</li>
			<li>CPU</li>
			<li>Memory</li>
			</ul>
			[/rt_compare_table_column]

			[rt_compare_table_column caption="BASIC PACKAGE" price="$19" info="yearly plan"]
			<ul>
			<li>[tooltip text="Tooltip Text"][icon name="icon-info-circled"][/tooltip]</li>
			<li>[icon name="icon-cancel"]</li>
			<li>[icon name="icon-cancel"]</li>
			<li>256 MB Memory</li>
			<li>[button button_link="#" button_text="BUY NOW" button_size="small" button_icon="icon-basket"]</li>
			</ul>
			[/rt_compare_table_column]

			[rt_compare_table_column caption="START PACKAGE" price="49$" info="yearly plan" style="highlight"]
			<ul>
			<li>[tooltip text="Tooltip Text"][icon name="icon-info-circled"][/tooltip]</li>
			<li>[icon name="icon-ok"]</li>
			<li>[icon name="icon-ok"]</li>
			<li>512 MB Memory</li>
			<li>[button button_link="#" button_text="BUY NOW" button_size="small" button_icon="icon-basket"]</li>
			</ul>
			[/rt_compare_table_column]

			[rt_compare_table_column caption="PRO PACKAGE" price="109$" info="monthly plan"]
			<ul>
			<li>[tooltip text="Tooltip Text"][icon name="icon-info-circled"][/tooltip]</li>
			<li>[icon name="icon-ok"]</li>
			<li>[icon name="icon-ok"]</li>
			<li>1000 MB Memory</li>
			<li>[button button_link="#" button_text="BUY NOW" button_size="small" button_icon="icon-basket"]</li>
			</ul>
			[/rt_compare_table_column]

		',

		'params'      => array(
 
							array(
								'param_name'  => 'style',
								'heading'     => __('Table Style', 'rt_theme_admin' ),
								'type'        => 'dropdown',
								"value"       => array(
													__("Compare", "rt_theme_admin") => "compare", 
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
		'base'        => 'rt_compare_table_column',
		'name'        => __( 'Table Column', 'rt_theme_admin' ),
		'icon'        => 'rt_theme list_line sub',
		'category'    => __( 'Contents', 'rt_theme_admin' ),
		'description' => __( 'Adds a new tab to a tabular content.', 'rt_theme_admin' ),
		'as_child'    => array( 'only' => 'rt_compare_table' ),
		'content_element' => true,
		'params'      => array(


							array(
								'param_name'  => 'style',
								'heading'     => __('Column Type', 'rt_theme_admin' ),
								'type'        => 'dropdown',
								"value"       => array(
													__("Regular column", "rt_theme_admin") => "",
													__("Features column for compare tables", "rt_theme_admin") => "features",
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
								"dependency"  => array(
														"element" => "style",
														"value" => array("","highlight")
													),
								'save_always' => true										
							),

							array(
								'param_name'  => 'info',
								'heading'     => __('Caption', 'rt_theme_admin' ),
								'description' => __('Column caption', 'rt_theme_admin' ),
								'type'        => 'textfield',
								'value'       => __( 'Package Name', 'rt_theme_admin' ),
								"dependency"  => array(
														"element" => "style",
														"value" => array("","highlight")
													),
								'save_always' => true										
							),


							array(
								'param_name'  => 'price',
								'heading'     => __('Price', 'rt_theme_admin' ),
								'type'        => 'textfield',
								"dependency"  => array(
														"element" => "style",
														"value" => array("","highlight")
													),										
							),

							array(
								'param_name'  => 'content',
								'heading'     => __( 'Tab Content', 'rt_theme_admin' ),
								'description' => '',
								'type'        => 'textarea_html',
								'holder'      => 'div',
								'value'       => __( '<ul>
														<li>[tooltip text="Tooltip Text"][icon name="icon-info-circled"][/tooltip]</li>
														<li>[icon name="icon-ok"]</li>
														<li>[icon name="icon-ok"]</li>
														<li>1000 MB Memory</li>
														<li>[button button_link="#" button_text="BUY NOW" button_size="small" button_icon="icon-basket"]</li>
													</ul>', 'rt_theme_admin' ),
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