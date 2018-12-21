<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


/**
 * RT-Theme Logo Options
 */
$this->options["rt_logo_options"] = array(

		'title' => __("Logo Options", "rt_theme_admin"), 
		'priority' => 1,
		"description" => esc_html_x('Your site may have two different sets of logos to be used different header skins such as light or dark headers.','Admin Panel','rt_theme_admin'),
		'sections' => array(
 
								array(
									"id"          => RT_THEMESLUG."_logo_url", 	
									"label"       => __("Logo Image",'rt_theme_admin'),
									"description" => __('Upload a image file by the use of the upload button or insert a valid url to a image to use as the website logo. Use a bigger image than the logo box width like 580px (width) to get a sharp look with the retina devices.','rt_theme_admin'),
									"transport"   => "refresh",															
									"type"        => "rt_media"
								), 

								array(
									"id"          => RT_THEMESLUG."_sticky_logo_url", 	
									"label"       => __("Logo Image for the Sticky Header (optional)",'rt_theme_admin'),
									"description" => __('Upload an alternative logo image for the sticky navigation bar.','rt_theme_admin'),
									"transport"   => "refresh",															
									"type"        => "rt_media"
								), 

					)
	);