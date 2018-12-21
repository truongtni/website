<?php
/*
*
* RT Google Maps
*
*/
 

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_google_maps extends WPBakeryShortCodesContainer {}
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_location extends WPBakeryShortCode {}
}

vc_map(
	array(
		'base'                    => 'google_maps',
		'name'                    => __( 'Google Maps', 'rt_theme_admin' ),
		'icon'                    => 'rt_theme rt_maps',
		'category'    				  => array(__( 'Content', 'rt_theme_admin' ), __( 'Theme Addons', 'rt_theme_admin' )),
		'description'             => __( 'Google Maps Holder Shortcode', 'rt_theme_admin' ),
		'as_parent'               => array( 'only' => 'location' ),
		'js_view'                 => 'VcColumnView',
		'content_element'         => true,
		"show_settings_on_create" => false,
		'default_content'         => '[location title="' . __( 'Location Title','rt_theme_admin' ) . '"][/location] ',
		'params'                  => array(
					
											array(
												'param_name'  => 'map_id',
												'heading'     => __('ID', 'rt_theme_admin' ),
												'description' => __('Unique ID', 'rt_theme_admin' ),
												'type'        => 'textfield',
												'value'       => ''
											),

											array(
												'param_name'  => 'height',
												'heading'     => __('Height', 'rt_theme_admin' ),
												'description' => __('Map Height', 'rt_theme_admin' ),
												'type'        => 'rt_number'
											),

											array(
												'param_name'  => 'zoom',
												'heading'     => __('Zoom Level', 'rt_theme_admin' ),
												'type'        => 'rt_number',
												'description' => __('Zoom level. Works only with single map location. Enter a zoom level between 1 and 19','rt_theme_admin'),
												'value'       => 10,
												'save_always' => true
											),

											array(
												'param_name'  => 'bwcolor',
												'heading'     => _x('Black & White Map', 'Admin Panel','rt_theme_admin' ),
												'type'        => 'checkbox', 
												'save_always' => true,
												'value' => array( _x( 'Make the map only black and white', 'Admin Panel','rt_theme_admin' ) => 'yes' ),
											),


											array(
												'param_name'  => 'class',
												'heading'     => _x('Class', 'Admin Panel','rt_theme_admin' ),
												'description' => _x('CSS Class Name', 'Admin Panel','rt_theme_admin' ),
												'type'        => 'textfield',
											)

									)
	)
);

$params = array();

$params[] = array(
	'default'       => sprintf(__('%1$sPlease note:%2$s Google Maps require an API key that provided by Google. Enter the key to the field inside the %1$sCustomize > General Options > Google Maps%2$s. If you have not created an API key yet, refer the online documentation of the theme to learn how to create one.', 'rt_theme_admin' ),"<strong>",'</strong>'),
	'param_name'  => 'rt_desc',
	'type'        => 'rt_vc_description'
);

$params[] = array(
	'param_name'  => 'title',
	'heading'     => __('Location Title', 'rt_theme_admin' ),
	'type'        => 'textfield',
	'holder'      => 'span',
);

$params[] = array(
	'param_name'  => 'content',
	'heading'     => __( 'Location Description', 'rt_theme_admin' ),
	'description' => '',
	'type'        => 'textarea'
);

$api_key = get_theme_mod(RT_THEMESLUG.'_google_api_key');

if(  ! empty( $api_key ) ){
	$params[] = array(
		'default'       => sprintf(__('%sClick here%s to open the location finder to find Latitude and Longitude values easily.', 'rt_theme_admin' ),'<a class="open-rt-location-finder" href="#">','</a>'),
		'param_name'  => 'rt_desc',
		'type'        => 'rt_vc_description'
	);
}

$params[] = array(
	'param_name'  => 'lat',
	'heading'     => __('Latitude', 'rt_theme_admin' ),
	'type'        => 'rt_number',
	'class'       => 'geo_selection',
	'edit_field_class' => 'vc_col-sm-12 vc_column wpb_el_type_textfield vc_shortcode-param rt_geo_selection'
);

$params[] = array(
	'param_name'  => 'lon',
	'heading'     => __('Longitude', 'rt_theme_admin' ),
	'type'        => 'rt_number',
	'class'       => 'geo_selection',
	'edit_field_class' => 'vc_col-sm-12 vc_column wpb_el_type_textfield vc_shortcode-param rt_geo_selection'
); 

vc_map(
	array(
		'base'                    => 'location',
		'name'                    => __( 'Google Map Location', 'rt_theme_admin' ),
		'icon'                    => 'rt_theme rt_location sub',
		'category'                => __( 'Contents', 'rt_theme_admin' ),
		'description'             => __( 'Adds a new location to the map', 'rt_theme_admin' ),
		'as_child'                => array( 'only' => 'google_maps' ),
		"show_settings_on_create" => true,
		'content_element'         => true,
		'params'                  => $params
	)
);		
	


?>