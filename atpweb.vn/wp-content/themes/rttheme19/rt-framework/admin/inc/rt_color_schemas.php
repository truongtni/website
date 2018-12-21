<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


/**
 * Create options
 */
$this->options["rt_color_schemas"] = array(
		'title' => __("Styling Options", "rt_theme_admin"),
		//'description' => __("Color Schemas Desc", "rt_theme_admin"),
		'priority'=> 2,
		'sections' => array(

							array(
								'id'       => 'layout',
								'title'    => __("Design Options", "rt_theme_admin"),
								"description" => __('Header layout is the main design element of the theme. There are many design elements and css files depends this option. Use the settigns inside the "Styling Options" such as Header Options, Logo Box, Main Navigation and Shortcut Buttons in order to customize the header design. Since all the header designs follows the same settings, when you switch between the header layouts it may not be look as the demo. You can apply the default settings by using the button below.','rt_theme_admin'),
								'controls' => array(

													array(
														"id"          => RT_THEMESLUG."_layout",
														"label"       => __("Select Header Layout",'rt_theme_admin'),
														'description' => "",
														"transport"   => "refresh",
														"choices"     => array(
																			"layout1" => __("Layout 1 - Vertical Navigation","rt_theme_admin"),
																			"layout2" => __("Layout 2 - Horizontal Navigation","rt_theme_admin"),
																			"layout3" => __("Layout 3 - Horizontal Navigation (v2)","rt_theme_admin"),
																			"layout4" => __("Layout 4 - Centered Logo","rt_theme_admin"),
																		),
														"type"    => "select",
														"default" => "layout1",
														"rt_skin" => true
													),

													array(
														"id"          => RT_THEMESLUG."_default_header_settings",
														"label"       => __("Default Header Settings",'rt_theme_admin'),
														"description" => esc_html__('In order to apply some part of the header related default settings of the selected header layout, you can use the button below. This tool is only useful when you switch to another header. To apply an entire skin as seen on the demo site, use the Styling Options > Pre-Made Skins','rt_theme_admin').'<br /><br /><span id="rt-header-defaults" class="button-secondary rt-skin-selector" tabindex="0">'.esc_html__('Apply defaults','rt_theme_admin').'</span>',
														"type"        => "rt_seperator"
													),

											),
							),

							array(
								'id'       => 'content_rows',
								'title'    => __("Content Rows", "rt_theme_admin"),
								'controls' => array(

													array(
														"id"          => RT_THEMESLUG."_default_content_row_width",
														"label"       => __("Default Content Holder Width",'rt_theme_admin'),
														"description" => __("Select a globally width for the content rows.",'rt_theme_admin'),
														"transport"   => "refresh",
														"choices"     => array(
																			"default" => __("Content Width","rt_theme_admin"),
																			"fullwidth" => __("Full Width","rt_theme_admin"),
																		),
														"type"    => "select",
														"default" => "default",
														"rt_skin" => true
													),


													array(
														"id"          => RT_THEMESLUG."_default_content_alignment",
														"label"       => __("Content Align",'rt_theme_admin'),
														"description" => __("Select a globally content alignment for the content rows. Works with only full width rows.",'rt_theme_admin'),
														"transport"   => "refresh",
														"choices"     => array(
																			"default" => __("Default","rt_theme_admin"),
																			"center" => __("Centered","rt_theme_admin"),
																		),
														"type"    => "select",
														"default" => "default",
														"rt_skin" => true
													),


													array(
														"id"          => RT_THEMESLUG."_overlapped_firt_row",
														"label"       => __("Overlapped First Row",'rt_theme_admin'),
														"description" => __("Makes the first row overlapped to the sub-header area. Works with only 'Content Width' rows.",'rt_theme_admin'),
														"transport"   => "refresh",
														"choices"     => array(
																			"true" => __("Enabled","rt_theme_admin"),
																			"false" => __("Disabled","rt_theme_admin"),
																		),
														"type"    => "select",
														"default" => "true",
														"rt_skin" => true
													),

											),
							),

							array(
								'id'       => 'body',
								'title'    => __("Body", "rt_theme_admin"),
								"description" => '<a class="highlight-section icon-flash" data-section-selector="body" href="#" title="'.__('Blink the body in the current page','rt_theme_admin').'"></a>'. __('Following settings will be applied to the page body. Remember if your have solid background color or image set for left and right sides, the body will be covered by them.',"rt_theme_admin"),
								'controls' => array(

													array(
														"id"          => RT_THEMESLUG."_body_seperator1",
														"label"       => "",
														"description" => __('Video Background','rt_theme_admin'),
														"type"        => "rt_seperator"
													),

													array(
														"id"          => RT_THEMESLUG."_background_video_mp4",
														"label"       => __("MP4 file",'rt_theme_admin'),
														"type"        => "number",
														"transport"   => "refresh",
														"default"     => "",
														"description" => __("MP4 File URL",'rt_theme_admin'),
														"type"        => "rt_media",
														"rt_skin"     => true
												 	),

													array(
														"id"          => RT_THEMESLUG."_background_video_webm",
														"label"       => __("WEBM file",'rt_theme_admin'),
														"type"        => "number",
														"transport"   => "refresh",
														"default"     => "",
														"description" => __("WEBM File URL",'rt_theme_admin'),
														"type"        => "rt_media",
														"rt_skin"     => true
													),

 													array(
														"id"          => RT_THEMESLUG."_body_seperator2",
														"label"       => "",
														"description" => __('Classic Background','rt_theme_admin'),
														"type"        => "rt_seperator"
													),


													array(
														"id"          => RT_THEMESLUG."_body_background_color",
														"label"       => __("Background Color",'rt_theme_admin'),
														"description" => "",
														"transport"   => "postMessage",
														"default"     => "#cccccc",
														"type"        => "color",
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_body_background_image_url",
														"label"       => __("Background Image",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"type"        => "rt_media",
														"default"     => "",
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_body_background_position",
														"label"       => __("Position",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"choices"     => array(
																			"right top"     => __("Right Top","rt_theme_admin"),
																			"right center"  => __("Right Center","rt_theme_admin"),
																			"right bottom"  => __("Right Bottom","rt_theme_admin"),
																			"left top"      => __("Left Top","rt_theme_admin"),
																			"left center"   => __("Left Center","rt_theme_admin"),
																			"left bottom"   => __("Left Bottom","rt_theme_admin"),
																			"center top"    => __("Center Top","rt_theme_admin"),
																			"center center" => __("Center Center","rt_theme_admin"),
																			"center bottom" => __("Center Bottom","rt_theme_admin"),
																		),
														"type" => "select",
														"rt_skin"   => true
													),

													array(
														"id"          => RT_THEMESLUG."_body_background_attachment",
														"label"       => __("Attachment",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"choices"     => array("scroll" =>__("Scroll","rt_theme_admin"), "fixed"  =>__("Fixed","rt_theme_admin")),
														"type"        => "radio",
														"default"     => "scroll",
														"rt_skin"   => true
													),

													array(
														"id"          => RT_THEMESLUG."_body_background_repeat",
														"label"       => __("Repeat",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"choices"     => array(
																		"repeat"       => __("Tile","rt_theme_admin"),
																		"repeat-x"     => __("Tile Horizontally","rt_theme_admin"),
																		"repeat-y"     => __("Tile Vertically","rt_theme_admin"),
																		"no-repeat"    => __("No Repeat","rt_theme_admin"),
																		),
														"type"    => "radio",
														"default" => "repeat",
														"rt_skin"   => true
													),

													array(
														"id"          => RT_THEMESLUG."_body_background_size",
														"label"       => __("Background Size",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"choices"     => array(
																		"auto auto" => __("Auto","rt_theme_admin"),
																		"cover" => __("Cover","rt_theme_admin"),
																		"contain" => __("Contain","rt_theme_admin"),
																		"100% auto" => __("100%","rt_theme_admin"),
																		"50% auto" => __("50%","rt_theme_admin"),
																		"25% auto" => __("25%","rt_theme_admin"),
																		),
														"default" => "auto auto",
														"type"    => "select",
														"rt_skin"   => true
													),

													array(
														"id"          => RT_THEMESLUG."_left_row_seperator",
														"label"       => "",
														"description" => __('Mobile Devices','rt_theme_admin'),
														"type"        => "rt_seperator"
													),

													array(
														"id"          => RT_THEMESLUG."_body_background_attachment_mobile",
														"label"       => __("Attachment",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"choices"     => array("scroll" =>__("Scroll","rt_theme_admin"), "fixed"  =>__("Fixed","rt_theme_admin")),
														"type"        => "radio",
														"default"     => "scroll",
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_body_seperator",
														"label"       => "",
														"description" => __('Body Margins','rt_theme_admin'),
														"type"        => "rt_seperator"
													),

													array(
														"id"          => RT_THEMESLUG."_body_margin_top",
														"label"       => __("Body Top Margin (px)",'rt_theme_admin'),
														"type"        => "number",
														"transport"   => "refresh",
														"default"     => "",
														"input_attrs" => array("min"=>0,"max"=>500),
														"rt_skin"     => true
												 	),

													array(
														"id"          => RT_THEMESLUG."_body_margin_bottom",
														"label"       => __("Body Bottom Margin (px)",'rt_theme_admin'),
														"type"        => "number",
														"transport"   => "refresh",
														"default"     => "",
														"input_attrs" => array("min"=>0,"max"=>500),
														"rt_skin"     => true
													)

											),
							),

							array(
								'id'       => 'left',
								'title'    => __("Left Side", "rt_theme_admin"),
								"description" => '<a class="highlight-section icon-flash" data-section-selector="#left_side" href="#" title="'.__('Blink the left side in the current page','rt_theme_admin').'"></a>'. __('Use following settings to customize the left side of your website.',"rt_theme_admin"),
								'controls' => array(

													array(
														"id"          => RT_THEMESLUG."_left_side_shadow",
														"label"       => __("Shadow",'rt_theme_admin'),
														"description" => "Add a shadow to the left side",
														"transport"   => "refresh",
														"default"     => "",
														"type"        => "checkbox",
														"rt_skin"   => true
													),

													array(
														"id"          => RT_THEMESLUG."_left_side_width",
														"label"       => __("Left Side Width (% Percent)",'rt_theme_admin'),
														"description" => __('Customize the widht of the left area. The default value is 30%. Please note: There is a minumum width for the sidebar which is 290px.','rt_theme_admin'),
														"type"        => "number",
														"transport"   => "refresh",
														"default"     => 30,
														"input_attrs" => array("min"=>10,"max"=>100),
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_left_side_content_align",
														"label"       => __("Left content alignment",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"choices"     => array(
																			"default" => __("Default","rt_theme_admin"),
																			"center"  => __("Center","rt_theme_admin"),
																		),
														"type"    => "select",
														"default" => "default",
														"rt_skin"   => true
													),

													array(
														"id"          => RT_THEMESLUG."_left_row_seperator_1",
														"label"       => "",
														"description" => __('Paddings','rt_theme_admin'),
														"type"        => "rt_seperator"
													),

													array(
														"id"          => RT_THEMESLUG."_left_top_padding",
														"label"       => __("Top Padding (px)",'rt_theme_admin'),
														"type"        => "number",
														"transport"   => "refresh",
														"default"     => 50,
														"input_attrs" => array("min"=>0,"max"=>500),
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_left_row_seperator_2",
														"label"       => "",
														"description" => __('Background','rt_theme_admin'),
														"type"        => "rt_seperator"
													),


													array(
														"id"          => RT_THEMESLUG."_left_background_color",
														"label"       => __("Background Color",'rt_theme_admin'),
														"description" => "",
														"transport"   => "postMessage",
														"default"     => "#222222",
														"type"        => "rt_color",
														"rt_skin"   => true
													),

													array(
														"id"          => RT_THEMESLUG."_left_background_image_url",
														"label"       => __("Background Image",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"type"        => "rt_media",
														"default"	=> "",
														"rt_skin"   => true
													),

													array(
														"id"          => RT_THEMESLUG."_left_background_parallax_effect",
														"label"       => __("Parallax Effect",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"default"     => "on",
														"type"        => "checkbox",
														"rt_skin"   => true
													),

													array(
														"id"          => RT_THEMESLUG."_left_background_position",
														"label"       => __("Position",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"choices"     => array(
																			"right top"     => __("Right Top","rt_theme_admin"),
																			"right center"  => __("Right Center","rt_theme_admin"),
																			"right bottom"  => __("Right Bottom","rt_theme_admin"),
																			"left top"      => __("Left Top","rt_theme_admin"),
																			"left center"   => __("Left Center","rt_theme_admin"),
																			"left bottom"   => __("Left Bottom","rt_theme_admin"),
																			"center top"    => __("Center Top","rt_theme_admin"),
																			"center center" => __("Center Center","rt_theme_admin"),
																			"center bottom" => __("Center Bottom","rt_theme_admin"),
																		),
														"type" => "select",
														"default" => "left top",
														"rt_skin"   => true
													),

													array(
														"id"          => RT_THEMESLUG."_left_background_repeat",
														"label"       => __("Repeat",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"choices"     => array(
																			"repeat"    => __("Tile","rt_theme_admin"),
																			"repeat-x"  => __("Tile Horizontally","rt_theme_admin"),
																			"repeat-y"  => __("Tile Vertically","rt_theme_admin"),
																			"no-repeat" => __("No Repeat","rt_theme_admin"),
																		),
														"type"    => "radio",
														"default" => "no-repeat",
														"rt_skin"   => true
													),

													array(
														"id"          => RT_THEMESLUG."_left_background_size",
														"label"       => __("Background Size",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"choices"     => array(
																			"auto auto" => __("Auto","rt_theme_admin"),
																			"cover"     => __("Cover","rt_theme_admin"),
																			"contain"   => __("Contain","rt_theme_admin"),
																			"100% auto" => __("100%","rt_theme_admin"),
																			"50% auto"  => __("50%","rt_theme_admin"),
																			"25% auto"  => __("25%","rt_theme_admin"),
																		),
														"default" => "cover",
														"type"    => "select",
														"rt_skin"   => true
													),

													array(
														"id"          => RT_THEMESLUG."_left_row_seperator_3",
														"label"       => "",
														"description" => __('Mobile Devices','rt_theme_admin'),
														"type"        => "rt_seperator"
													),

													array(
														"id"          => RT_THEMESLUG."_body_background_attachment_mobile",
														"label"       => __("Attachment",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"choices"     => array("scroll" =>__("Scroll","rt_theme_admin"), "fixed"  =>__("Fixed","rt_theme_admin")),
														"type"        => "radio",
														"default"     => "scroll",
														"rt_skin"     => true
													),

											),
							),

							array(
								'id'       => 'right',
								'title'    => __("Right Side", "rt_theme_admin"),
								"description" => '<a class="highlight-section icon-flash" data-section-selector="#right_side" href="#" title="'.__('Blink the right side in the current page','rt_theme_admin').'"></a>'. __('Use following settings to customize the right side of your website.',"rt_theme_admin"),
								'controls' => array(

													array(
														"id"          => RT_THEMESLUG."_right_top_padding",
														"label"       => __("Top Padding (px)",'rt_theme_admin'),
														"type"        => "number",
														"transport"   => "refresh",
														"default"     => 50,
														"input_attrs" => array("min"=>0,"max"=>500),
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_right_background_color",
														"label"       => __("Background Color",'rt_theme_admin'),
														"description" => "",
														"transport"   => "postMessage",
														"default"     => "",
														"type"        => "rt_color",
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_right_background_image_url",
														"label"       => __("Background Image",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"type"        => "rt_media",
														"default"	=> "",
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_right_background_position",
														"label"       => __("Position",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"choices"     => array(
																			"right top"     => __("Right Top","rt_theme_admin"),
																			"right center"  => __("Right Center","rt_theme_admin"),
																			"right bottom"  => __("Right Bottom","rt_theme_admin"),
																			"left top"      => __("Left Top","rt_theme_admin"),
																			"left center"   => __("Left Center","rt_theme_admin"),
																			"left bottom"   => __("Left Bottom","rt_theme_admin"),
																			"center top"    => __("Center Top","rt_theme_admin"),
																			"center center" => __("Center Center","rt_theme_admin"),
																			"center bottom" => __("Center Bottom","rt_theme_admin"),
																		),
														"type"    => "select",
														"rt_skin" => true
													),


													array(
														"id"          => RT_THEMESLUG."_right_background_attachment",
														"label"       => __("Attachment",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"choices"     => array("scroll" =>__("Scroll","rt_theme_admin"), "fixed"  =>__("Fixed","rt_theme_admin")),
														"type"        => "radio",
														"default"     => "scroll",
														"rt_skin"   => true
													),


													array(
														"id"          => RT_THEMESLUG."_right_background_repeat",
														"label"       => __("Repeat",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"choices"     => array(
																		"repeat"       => __("Tile","rt_theme_admin"),
																		"repeat-x"     => __("Tile Horizontally","rt_theme_admin"),
																		"repeat-y"     => __("Tile Vertically","rt_theme_admin"),
																		"no-repeat"    => __("No Repeat","rt_theme_admin"),
																		),
														"type"    => "radio",
														"default" => "repeat",
														"rt_skin"   => true
													),

													array(
														"id"          => RT_THEMESLUG."_right_background_size",
														"label"       => __("Background Size",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"choices"     => array(
																		"auto auto" => __("Auto","rt_theme_admin"),
																		"cover" => __("Cover","rt_theme_admin"),
																		"contain" => __("Contain","rt_theme_admin"),
																		"100% auto" => __("100%","rt_theme_admin"),
																		"50% auto" => __("50%","rt_theme_admin"),
																		"25% auto" => __("25%","rt_theme_admin"),
																		),
														"default" => "auto auto",
														"type"    => "select",
														"rt_skin"   => true
													),


											),
							),

							array(
								'id'       => 'main_header',
								'title'    => __("Header", "rt_theme_admin"),
								"description" => '<a class="highlight-section icon-flash" data-section-selector=".top-header" href="#" title="'.__('Blink main header in the current page. ','rt_theme_admin').'"></a>'. __('Use following settings to customize the header section of your website.',"rt_theme_admin"),
								'controls' => array(


													array(
														"id"          => RT_THEMESLUG."_sticky_header",
														"label"       => __("Sticky Header",'rt_theme_admin'),
														"description" =>  __("If checked the main header will stick to the top of the browser window while scrolling down through the page content.",'rt_theme_admin'),
														"transport"   => "refresh",
														"default"     => "",
														"type"        => "checkbox",
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_overlapped_header",
														"label"       => esc_html_x("Overlapped Header",'Admin Panel','rt_theme_admin'),
														"description" => esc_html_x("If checked the main header will be overlapped onto the next content.",'Admin Panel','rt_theme_admin'),
														"transport"   => "refresh",
														"default"     => false,
														"type"        => "checkbox",
														"rt_skin"     => true
													),


													array(
														"id"          => RT_THEMESLUG."_main_header_height",
														"label"       => __("Header Height (px)",'rt_theme_admin'),
														"type"        => "number",
														"transport"   => "refresh",
														"default"     => 100,
														"input_attrs" => array("min"=>60,"max"=>500),
														"rt_skin"     => true
													),


													array(
														"id"          => RT_THEMESLUG."_main_header_seperator_1",
														"label"       => __('Paddings','rt_theme_admin'),
														"type"        => "rt_subsection_heading"
													),

													array(
														"id"          => RT_THEMESLUG."_main_header_padding_top",
														"label"       => __("Top Padding (px)",'rt_theme_admin'),
														"type"        => "number",
														"transport"   => "refresh",
														"default"     => 40,
														"input_attrs" => array("min"=>0,"max"=>500),
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_main_header_padding_bottom",
														"label"       => __("Bottom Padding (px)",'rt_theme_admin'),
														"type"        => "number",
														"transport"   => "refresh",
														"default"     => 40,
														"input_attrs" => array("min"=>0,"max"=>500),
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_main_header_border_seperator",
														"label"       => __('Border','rt_theme_admin'),
														"type"        => "rt_subsection_heading"
													),

													array(
														"id"          => RT_THEMESLUG."_main_header_border_size",
														"label"       => __("Bottom Border (px)",'rt_theme_admin'),
														"type"        => "number",
														"transport"   => "refresh",
														"default"     => 0,
														"input_attrs" => array("min"=>0,"max"=>500),
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_main_header_border_color",
														"label"       => __("Bottom Border Color",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"default"     => "",
														"type"        => "rt_color",
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_main_header_element_border_color",
														"label"       => __("Element Divider Color",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"default"     => "",
														"type"        => "rt_color",
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_main_header_seperator_2",
														"label"       => __('Widths','rt_theme_admin'),
														"type"        => "rt_subsection_heading"
													),


													array(
														"id"          => RT_THEMESLUG."_main_header_row_background_width",
														"label"       => __("Header Bar Width",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"choices"     => array(
																			"fullwidth" => __("Full Width","rt_theme_admin"),
																			"default"   => __("Default","rt_theme_admin"),
																		),
														"type"    => "select",
														"default" => "fullwidth",
														"rt_skin" => true
													),

													array(
														"id"          => RT_THEMESLUG."_main_header_row_content_width",
														"label"       => __("Header Bar Content Width",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"choices"     => array(
																			"fullwidth" => __("Full Width","rt_theme_admin"),
																			"default"   => __("Default","rt_theme_admin"),
																		),
														"type"    => "select",
														"default" => "default",
														"rt_skin" => true
													),


													array(
														"id"          => RT_THEMESLUG."_main_header_seperator_3",
														"label"       => __('Header Background','rt_theme_admin'),
														"type"        => "rt_subsection_heading"
													),

													array(
														"id"          => RT_THEMESLUG."_main_header_row_bg_color",
														"label"       => __("Background Color",'rt_theme_admin'),
														"description" => "",
														"transport"   => "postMessage",
														"default"     => "#2a2a2a",
														"type"        => "rt_color",
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_main_header_row_bg_image",
														"label"       => __("Background Image",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"type"        => "rt_media",
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_main_header_row_bg_position",
														"label"       => __("Position",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"choices"     => array(
																			"right top"     => __("Right Top","rt_theme_admin"),
																			"right center"  => __("Right Center","rt_theme_admin"),
																			"right bottom"  => __("Right Bottom","rt_theme_admin"),
																			"left top"      => __("Left Top","rt_theme_admin"),
																			"left center"   => __("Left Center","rt_theme_admin"),
																			"left bottom"   => __("Left Bottom","rt_theme_admin"),
																			"center top"    => __("Center Top","rt_theme_admin"),
																			"center center" => __("Center Center","rt_theme_admin"),
																			"center bottom" => __("Center Bottom","rt_theme_admin"),
																		),
														"type"    => "select",
														"rt_skin" => true
													),


													array(
														"id"          => RT_THEMESLUG."_main_header_row_bg_attachment",
														"label"       => __("Attachment",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"choices"     => array("scroll" =>__("Scroll","rt_theme_admin"), "fixed"  =>__("Fixed","rt_theme_admin")),
														"type"        => "radio",
														"default"     => "scroll",
														"rt_skin"   => true
													),


													array(
														"id"          => RT_THEMESLUG."_main_header_row_bg_image_repeat",
														"label"       => __("Repeat",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"choices"     => array(
																		"repeat"       => __("Tile","rt_theme_admin"),
																		"repeat-x"     => __("Tile Horizontally","rt_theme_admin"),
																		"repeat-y"     => __("Tile Vertically","rt_theme_admin"),
																		"no-repeat"    => __("No Repeat","rt_theme_admin"),
																		),
														"type"    => "radio",
														"default" => "repeat",
														"rt_skin"   => true
													),

													array(
														"id"          => RT_THEMESLUG."_main_header_row_bg_size",
														"label"       => __("Background Size",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"choices"     => array(
																		"auto auto" => __("Auto","rt_theme_admin"),
																		"cover" => __("Cover","rt_theme_admin"),
																		"contain" => __("Contain","rt_theme_admin"),
																		"100% auto" => __("100%","rt_theme_admin"),
																		"50% auto" => __("50%","rt_theme_admin"),
																		"25% auto" => __("25%","rt_theme_admin"),
																		),
														"default" => "auto auto",
														"type"    => "select",
														"rt_skin"   => true
													),


													array(
														"id"          => RT_THEMESLUG."_main_header_seperator_4",
														"label"       => __('Sticky Header Background','rt_theme_admin'),
														"type"        => "rt_subsection_heading"
													),

													array(
														"id"          => RT_THEMESLUG."_sticky_header_bg_color",
														"label"       => __("Background Color",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"default"     => "",
														"type"        => "rt_color",
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_main_header_seperator_5",
														"label"       => __('Header Widgets','rt_theme_admin'),
														"type"        => "rt_subsection_heading"
													),

													array(
														"id"          => RT_THEMESLUG."_header_widgets_font_color",
														"label"       => __("Font Color",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"default"     => "#ffffff",
														"type"        => "rt_color",
														"rt_skin"     => true
													),

											),
							),

							array(
								'id'       => 'header',
								'title'    => __("Sub Header", "rt_theme_admin"),
								"description" => '<a class="highlight-section icon-flash" data-section-selector=".sub_page_header" href="#" title="'.__('Blink sub header (if used ) in the current page. ','rt_theme_admin').'"></a>'. __('Use following settings to customize the sub header section of your website.',"rt_theme_admin"),
								'controls' => array(


													array(
														"id"          => RT_THEMESLUG."_sub_header_style",
														"label"       => __("Style",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"choices"     => array(																			
																				"default-style" => __("Default","rt_theme_admin"),
																				"center-style"  => __("Centered","rt_theme_admin"),
																			),
														"type"    => "select",
														"default" => "",
														"rt_skin" => true
													),


													array(
														"id"          => RT_THEMESLUG."_hide_page_title",
														"label"       => __("Hide Page Titles",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"default"     => "",
														"type"        => "checkbox",
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_hide_breadcrumb_menu",
														"label"       => __("Hide Breadcrumb Menus",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"default"     => "",
														"type"        => "checkbox",
														"rt_skin"     => true
													),


													array(
														"id"          => RT_THEMESLUG."_header_row_seperator",
														"label"       => "",
														"description" => __('Sub Header Bar Styling','rt_theme_admin'),
														"type"        => "rt_seperator"
													),

													array(
														"id"          => RT_THEMESLUG."_header_padding_top",
														"label"       => __("Top Padding (px)",'rt_theme_admin'),
														"type"        => "number",
														"transport"   => "refresh",
														"default"     => 50,
														"input_attrs" => array("min"=>0,"max"=>500),
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_header_padding_bottom",
														"label"       => __("Bottom Padding (px)",'rt_theme_admin'),
														"type"        => "number",
														"transport"   => "refresh",
														"default"     => 70,
														"input_attrs" => array("min"=>0,"max"=>500),
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_header_shadows",
														"label"       => __("Shadow",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"default"     => "",
														"type"        => "checkbox",
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_header_row_background_width",
														"label"       => __("Width",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"choices"     => array(
																			"fullwidth" => __("Full Width","rt_theme_admin"),
																			"default"   => __("Default","rt_theme_admin"),
																		),
														"type"    => "select",
														"default" => "fullwidth",
														"rt_skin" => true
													),

													array(
														"id"          => RT_THEMESLUG."_header_row_font_color",
														"label"       => __("Page Title Font Color",'rt_theme_admin'),
														"description" => "",
														"transport"   => "postMessage",
														"default"     => "#555555",
														"type"        => "color",
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_header_row_background_width",
														"label"       => __("Width",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"choices"     => array(
																			"fullwidth" => __("Full Width","rt_theme_admin"),
																			"default"   => __("Default","rt_theme_admin"),
																		),
														"type"    => "select",
														"default" => "fullwidth",
														"rt_skin" => true
													),

													array(
														"id"          => RT_THEMESLUG."_header_row_bg_color",
														"label"       => __("Background Color",'rt_theme_admin'),
														"description" => "",
														"transport"   => "postMessage",
														"default"     => "rgba(255, 255, 255, 0.3)",
														"type"        => "rt_color",
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_header_row_bg_image",
														"label"       => __("Background Image",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"type"        => "rt_media",
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_header_row_bg_effect",
														"label"       => __("Parallax Effect",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"choices"     => array(
																			"parallax" => __("Enabled","rt_theme_admin"),
																			""         => __("Disabled","rt_theme_admin"),
																		),
														"type"    => "select",
														"default" => "fulwidth",
														"rt_skin" => true
													),

													array(
														"id"          => RT_THEMESLUG."_header_row_bg_position",
														"label"       => __("Position",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"choices"     => array(
																			"right top"     => __("Right Top","rt_theme_admin"),
																			"right center"  => __("Right Center","rt_theme_admin"),
																			"right bottom"  => __("Right Bottom","rt_theme_admin"),
																			"left top"      => __("Left Top","rt_theme_admin"),
																			"left center"   => __("Left Center","rt_theme_admin"),
																			"left bottom"   => __("Left Bottom","rt_theme_admin"),
																			"center top"    => __("Center Top","rt_theme_admin"),
																			"center center" => __("Center Center","rt_theme_admin"),
																			"center bottom" => __("Center Bottom","rt_theme_admin"),
																		),
														"type"    => "select",
														"rt_skin" => true
													),


													array(
														"id"          => RT_THEMESLUG."_header_row_bg_attachment",
														"label"       => __("Attachment",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"choices"     => array("scroll" =>__("Scroll","rt_theme_admin"), "fixed"  =>__("Fixed","rt_theme_admin")),
														"type"        => "radio",
														"default"     => "scroll",
														"rt_skin"   => true
													),


													array(
														"id"          => RT_THEMESLUG."_header_row_bg_image_repeat",
														"label"       => __("Repeat",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"choices"     => array(
																		"repeat"       => __("Tile","rt_theme_admin"),
																		"repeat-x"     => __("Tile Horizontally","rt_theme_admin"),
																		"repeat-y"     => __("Tile Vertically","rt_theme_admin"),
																		"no-repeat"    => __("No Repeat","rt_theme_admin"),
																		),
														"type"    => "radio",
														"default" => "repeat",
														"rt_skin"   => true
													),

													array(
														"id"          => RT_THEMESLUG."_header_row_bg_size",
														"label"       => __("Background Size",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"choices"     => array(
																		"auto auto" => __("Auto","rt_theme_admin"),
																		"cover" => __("Cover","rt_theme_admin"),
																		"contain" => __("Contain","rt_theme_admin"),
																		"100% auto" => __("100%","rt_theme_admin"),
																		"50% auto" => __("50%","rt_theme_admin"),
																		"25% auto" => __("25%","rt_theme_admin"),
																		),
														"default" => "auto auto",
														"type"    => "select",
														"rt_skin"   => true
													),


													array(
														"id"          => RT_THEMESLUG."_breadcrumb_seperator",
														"label"       => "",
														"description" => __('Breadcrumb Menu Styling','rt_theme_admin'),
														"type"        => "rt_seperator"
													),

													array(
														"id"          => RT_THEMESLUG."_breadcrumb_font_color",
														"label"       => __("Breadcrumb Font Color",'rt_theme_admin'),
														"description" => "",
														"transport"   => "postMessage",
														"default"     => "#999",
														"type"        => "color",
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_breadcrumb_link_color",
														"label"       => __("Breadcrumb Link Color",'rt_theme_admin'),
														"description" => "",
														"transport"   => "postMessage",
														"default"     => "#777",
														"type"        => "color",
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_breadcrumb_bg_color",
														"label"       => __("Breadcrumb Background Color",'rt_theme_admin'),
														"description" => "",
														"transport"   => "postMessage",
														"default"     => "rgba(255, 255, 255, 0.5)",
														"type"        => "rt_color",
														"rt_skin"     => true
													),

											),
							),

							array(
								'id'          => 'logobg',
								'title'       => __("Logo Box", "rt_theme_admin"),
								"description" => '<a class="highlight-section icon-flash" data-section-selector=".site-logo" href="#" title="'.__('Blink the body in the current page','rt_theme_admin').'"></a>'. __('The box that includes the logo image. Change the paddings to reduce or increase the white space around the logo image.','rt_theme_admin'),
								'controls'    => array(

													array(
														"id"          => RT_THEMESLUG."_logo_box_width",
														"label"       => __("Logo Maximum Width",'rt_theme_admin'),
														"type"        => "number",
														"transport"   => "refresh",
														"default"     => 300,
														"input_attrs" => array("min"=>0,"max"=>1000),
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_logo_box_height",
														"label"       => __("Logo Maximum Height",'rt_theme_admin'),
														"type"        => "number",
														"transport"   => "refresh",
														"default"     => 200,
														"input_attrs" => array("min"=>0,"max"=>1000),
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_logo_padding_t",
														"label"       => __("Top Padding (px)",'rt_theme_admin'),
														"type"        => "number",
														"transport"   => "refresh",
														"default"     => 40,
														"input_attrs" => array("min"=>0,"max"=>100),
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_logo_padding_b",
														"label"       => __("Bottom Padding (px)",'rt_theme_admin'),
														"type"        => "number",
														"transport"   => "refresh",
														"default"     => 40,
														"input_attrs" => array("min"=>0,"max"=>100),
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_logo_padding_l",
														"label"       => __("Left Padding (px)",'rt_theme_admin'),
														"type"        => "number",
														"transport"   => "refresh",
														"default"     => 20,
														"input_attrs" => array("min"=>0,"max"=>100),
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_logo_padding_r",
														"label"       => __("Right Padding (px)",'rt_theme_admin'),
														"type"        => "number",
														"transport"   => "refresh",
														"default"     => 20,
														"input_attrs" => array("min"=>0,"max"=>100),
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_logo_seperator_1",
														"label"       => "",
														"description" => __('Desktop View','rt_theme_admin'),
														"type"        => "rt_seperator"
													),

													array(
														"id"          => RT_THEMESLUG."_logo_background_color",
														"label"       => __("Background Color",'rt_theme_admin'),
														"description" => "",
														"transport"   => "postMessage",
														"default"     => "rgba( 0, 0, 0, 0.65 )",
														"type"        => "rt_color",
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_logo_bottom_border_color",
														"label"       => __("Bottom Border Color",'rt_theme_admin'),
														"description" => "",
														"transport"   => "postMessage",
														"default"     => "#2F2F2F",
														"type"        => "rt_color",
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_logo_font_color",
														"label"       => __("Font Color",'rt_theme_admin'),
														"description" => __('Color for text logos','rt_theme_admin'),
														"transport"   => "refresh",
														"default"     => "#fff",
														"type"        => "rt_color",
														"rt_skin"     => true
													),


													array(
														"id"          => RT_THEMESLUG."_logo_seperator_2",
														"label"       => "",
														"description" => __('Mobile View','rt_theme_admin'),
														"type"        => "rt_seperator"
													),

													array(
														"id"          => RT_THEMESLUG."_logo_background_color_mobile",
														"label"       => __("Background Color",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"default"     => "rgba( 0, 0, 0, 0.65 )",
														"type"        => "rt_color",
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_logo_bottom_border_color_mobile",
														"label"       => __("Bottom Border Color",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"default"     => "#2F2F2F",
														"type"        => "rt_color",
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_logo_font_color_mobile",
														"label"       => __("Font Color",'rt_theme_admin'),
														"description" => __('Color for text logos and the mobile menu icon','rt_theme_admin'),
														"transport"   => "refresh",
														"default"     => "#fff",
														"type"        => "rt_color",
														"rt_skin"     => true
													),
											),
							),

							array(
								'id'       => 'nav',
								'title'    => __("Main Navigation", "rt_theme_admin"),
								"description" => '<a class="highlight-section icon-flash" data-section-selector="#navigation,.header-right nav" href="#" title="'.__('Blink the main mavigation in the current page. ','rt_theme_admin').'"></a>'. __('Use following settings to customize your main navigation',"rt_theme_admin"),
								'controls' => array(


													array(
														"id"          => RT_THEMESLUG."_nav_seperator_1",
														"label"       => "",
														"description" => __('Top Level Menu Items','rt_theme_admin'),
														"type"        => "rt_seperator"
													),

													array(
														"id"          => RT_THEMESLUG."_nav_item_vertical_padding",
														"label"       => __("Item Vertical Padding (px)",'rt_theme_admin'),
														"type"        => "number",
														"transport"   => "refresh",
														"default"     => 10,
														"input_attrs" => array("min"=>0,"max"=>100),
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_nav_item_vertical_padding_sticky",
														"label"       => __("Item Vertical Padding (px) - Sticky Header",'rt_theme_admin'),
														"type"        => "number",
														"transport"   => "refresh",
														"default"     => 10,
														"input_attrs" => array("min"=>0,"max"=>100),
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_nav_item_horizontal_padding",
														"label"       => __("Item Horizontal Padding (px)",'rt_theme_admin'),
														"type"        => "number",
														"transport"   => "refresh",
														"default"     => 20,
														"input_attrs" => array("min"=>0,"max"=>100),
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_nav_item_background_color",
														"label"       => __("Menu Item Background Color",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"default"     => "rgba(0,0,0,0.9)",
														"type"        => "rt_color",
														"rt_skin"   => true
													),

													array(
														"id"          => RT_THEMESLUG."_nav_item_font_color",
														"label"       => __("Menu Item Font Color",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"default"     => "#ffffff",
														"type"        => "rt_color",
														"rt_skin"   => true
													),

													array(
														"id"          => RT_THEMESLUG."_nav_item_border_color",
														"label"       => __("Menu Item Border Color",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"default"     => "#2F2F2F",
														"type"        => "rt_color",
														"rt_skin"   => true
													),

													array(
														"id"          => RT_THEMESLUG."_nav_item_background_color_active",
														"label"       => __("Active Menu Item Background Color",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"default"     => "#181818",
														"type"        => "rt_color",
														"rt_skin"   => true
													),

													array(
														"id"          => RT_THEMESLUG."_nav_item_font_color_active",
														"label"       => __("Active Menu Item Font Color",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"default"     => "#ffffff",
														"type"        => "rt_color",
														"rt_skin"   => true
													),

													array(
														"id"          => RT_THEMESLUG."_nav_item_indicator_color_active",
														"label"       => __("Active Menu Item Indicator Color",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"default"     => "#2F2F2F",
														"type"        => "rt_color",
														"rt_skin"   => true
													),


													array(
														"id"          => RT_THEMESLUG."_nav_seperator_2",
														"label"       => "",
														"description" => __('Sub Level Menu Items','rt_theme_admin'),
														"type"        => "rt_seperator"
													),

													array(
														"id"          => RT_THEMESLUG."_sub_nav_item_vertical_padding",
														"label"       => __("Sub Item Vertical Padding (px)",'rt_theme_admin'),
														"type"        => "number",
														"transport"   => "refresh",
														"default"     => 10,
														"input_attrs" => array("min"=>0,"max"=>100),
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_sub_nav_item_horizontal_padding",
														"label"       => __("Sub Item Horizontal Padding (px)",'rt_theme_admin'),
														"type"        => "number",
														"transport"   => "refresh",
														"default"     => 20,
														"input_attrs" => array("min"=>0,"max"=>100),
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_sub_nav_item_background_color",
														"label"       => __("Sub Menu Item Background Color",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"default"     => "#2F2F2F",
														"type"        => "rt_color",
														"rt_skin"   => true
													),

													array(
														"id"          => RT_THEMESLUG."_sub_nav_item_font_color",
														"label"       => __("Sub Menu Item Font",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"default"     => "#aeaeae",
														"type"        => "rt_color",
														"rt_skin"   => true
													),

													array(
														"id"          => RT_THEMESLUG."_sub_nav_item_border_color",
														"label"       => __("Sub Menu Item Border Color",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"default"     => "#3a3a3a",
														"type"        => "rt_color",
														"rt_skin"   => true
													),

													array(
														"id"          => RT_THEMESLUG."_sub_nav_item_background_color_active",
														"label"       => __("Active Sub Menu Item Background Color",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"default"     => "#2a2a2a",
														"type"        => "rt_color",
														"rt_skin"   => true
													),

													array(
														"id"          => RT_THEMESLUG."_sub_nav_item_font_color_active",
														"label"       => __("Active Sub Menu Item Font Color",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"default"     => "#cacaca",
														"type"        => "rt_color",
														"rt_skin"   => true
													),

													array(
														"id"          => RT_THEMESLUG."_sub_nav_item_indicator_color_active",
														"label"       => __("Active Sub Menu Item Indicator Color",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"default"     => "#3d3d3d",
														"type"        => "rt_color",
														"rt_skin"   => true
													),

 													array(
														"id"          => RT_THEMESLUG."_nav_seperator_3",
														"label"		  => __('Mobile Menu','rt_theme_admin'),
														"type"        => "rt_seperator"
													),

													array(
														"id"          => RT_THEMESLUG."_mobile_nav_font_color",
														"label"       => __("Mobile Menu Font Color",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"default"     => "#dddddd",
														"type"        => "rt_color",
														"rt_skin"   => true
													),

													array(
														"id"          => RT_THEMESLUG."_mobile_nav_font_color_active",
														"label"       => __("Mobile Menu Active Font Color",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"default"     => "#777777",
														"type"        => "rt_color",
														"rt_skin"   => true
													),

													array(
														"id"          => RT_THEMESLUG."_mobile_nav_background_color",
														"label"       => __("Mobile Menu Background Color",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"default"     => "#2a2a2a",
														"type"        => "rt_color",
														"rt_skin"   => true
													),

													array(
														"id"          => RT_THEMESLUG."_mobile_nav_border_color",
														"label"       => __("Mobile Menu Border Color",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"default"     => "",
														"type"        => "rt_color",
														"rt_skin"   => true
													),

													array(
														"id"          => RT_THEMESLUG."_mobile_nav_active_border_color",
														"label"       => __("Mobile Menu Active Border Color",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"default"     => "",
														"type"        => "rt_color",
														"rt_skin"   => true
													),
											),
							),

							array(
								'id'       => 'topbar',
								'title'    => __("Top Bar", "rt_theme_admin"),
								"description" => '<a class="highlight-section icon-flash" data-section-selector=".top-bar href="#" title="'.__('Blink the top bar in the current page. ','rt_theme_admin').'"></a>'. __('Use the following settings to customize your top bar.',"rt_theme_admin"),
								'controls' => array(

													array(
														"id"          => RT_THEMESLUG."_top_bar_width",
														"label"       => __("Top Bar Width",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"choices"     => array(
																			"fullwidth" => __("Full Width","rt_theme_admin"),
																			"default"   => __("Default","rt_theme_admin"),
																		),
														"type"    => "select",
														"default" => "fullwidth",
														"rt_skin" => true
													),

													array(
														"id"          => RT_THEMESLUG."_top_bar_content_width",
														"label"       => __("Top Bar Content Width",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"choices"     => array(
																			"fullwidth" => __("Full Width","rt_theme_admin"),
																			"default"   => __("Default","rt_theme_admin"),
																		),
														"type"    => "select",
														"default" => "default",
														"rt_skin" => true
													),

													array(
														"id"          => RT_THEMESLUG."_top_bar_colors",
														"label"       => __('Color Set for Top Bar','rt_theme_admin'),
														"type"        => "rt_seperator"
													),


	 												array(
														"id"          => RT_THEMESLUG."_topbar_bg_color",
														"label"       => __("Background Color",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"default"     => "#151515",
														"type"        => "rt_color",
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_topbar_font_color",
														"label"       => __("Font Color",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"default"     => "#ffffff",
														"type"        => "rt_color",
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_topbar_link_color",
														"label"       => __("Link Color",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"default"     => "#ffffff",
														"type"        => "rt_color",
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_topbar_link_hover_color",
														"label"       => __("Link Hover Color",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"default"     => "#e6aa21",
														"type"        => "rt_color",
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_topbar_border_color",
														"label"       => __("Elements Border Color",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"default"     => "#333333",
														"type"        => "rt_color",
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_topbar_bottom_border_color",
														"label"       => __("Bottom Border Color",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"default"     => "#333333",
														"type"        => "rt_color",
														"rt_skin"     => true
													),


											),
							),


 							array(
								'id'       => 'top_shortcut_buttons',
								'title'    => __("Shortcut Buttons", "rt_theme_admin"),
								"description" => '<a class="highlight-section icon-flash" data-section-selector="#tools" href="#" title="'.__('Blink the shortcut buttons in the current page.','rt_theme_admin').'"></a>'. __('Use following settings to adjust the shortcode buttons and their drop-down menus',"rt_theme_admin"),
								'controls' => array(

 													array(
														"id"          => RT_THEMESLUG."_top_shortcut_buttons_seperator_1",
														"label"		  => __('Visibility','rt_theme_admin'),
														"type"        => "rt_seperator"
													),

													array(
														"id"          => RT_THEMESLUG."_top_shortcut_buttons_user",
														"label"       => __("Display User Login",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"default"     => "on",
														"type"        => "checkbox",
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_top_shortcut_buttons_cart",
														"label"       => __("Display Cart",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"default"     => "on",
														"type"        => "checkbox",
														"rt_skin"     => true
													),


													array(
														"id"          => RT_THEMESLUG."_top_shortcut_buttons_wpml",
														"label"       => __("Display WPML Languages",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"default"     => "on",
														"type"        => "checkbox",
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_top_shortcut_buttons_serch",
														"label"       => __("Display Search",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"default"     => "on",
														"type"        => "checkbox",
														"rt_skin"     => true
													),


													array(
														"id"          => RT_THEMESLUG."_top_shortcut_buttons_seperator_2",
														"label"       => __('A color set for only icons','rt_theme_admin'),
														"type"        => "rt_seperator"
													),

													array(
														"id"          => RT_THEMESLUG."_top_shortcut_buttons_background_color",
														"label"       => __("Icons Background Color",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"default"     => "#151515",
														"type"        => "rt_color",
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_top_shortcut_buttons_border_color",
														"label"       => __("Border Color",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"default"     => "#2F2F2F",
														"type"        => "rt_color",
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_top_shortcut_buttons_font_color",
														"label"       => __("Font Color",'rt_theme_admin'),
														"transport"   => "refresh",
														"default"     => "#fff",
														"type"        => "rt_color",
														"rt_skin"     => true
													),


													array(
														"id"          => RT_THEMESLUG."_top_shortcut_buttons_seperator_3",
														"label"       => __('Color Set for Drop Down Contents','rt_theme_admin'),
														"type"        => "rt_seperator"
													),


	 												array(
														"id"          => RT_THEMESLUG."_top_shortcut_buttons_content_bg_color",
														"label"       => __("Contents Background Color",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"default"     => "#151515",
														"type"        => "rt_color",
														"rt_skin"     => true
													),


													array(
														"id"          => RT_THEMESLUG."_top_shortcut_buttons_content_border_color",
														"label"       => __("Border Color",'rt_theme_admin'),
														"description" => "",
														"transport"   => "refresh",
														"default"     => "#2F2F2F",
														"type"        => "rt_color",
														"rt_skin"     => true
													),

													array(
														"id"          => RT_THEMESLUG."_top_shortcut_buttons_content_font_color",
														"label"       => __("Font Color",'rt_theme_admin'),
														"transport"   => "refresh",
														"default"     => "#fff",
														"type"        => "rt_color",
														"rt_skin"     => true
													),

											),
							),

			)
	);



if( ! function_exists("rtframework_create_color_set_options") ){
	/**
	 * Add additional controls to the footer colors
	 * @return array
	 */
	function rtframework_create_color_set_options( $options ){

		$color_list = array();

		//Color Schemas
		$color_list[".side-panel-holder"] = array(
			"id" => "side_panel",
			"label" => __("Side Panel","rt_theme_admin"),
			"description" => '<a class="highlight-section icon-flash" data-section-selector=".side-panel-holder" href="#" title="'.__('Blink sections which uses this color set','rt_theme_admin').'"></a>'. __('A color set that can be applied to any content rows or column.',"rt_theme_admin"),
			"colors" => array(

				"primary_color"         => array("color"=> "#e6aa21", "label" => __("Primary Color","rt_theme_admin")),
				"bg_color"              => array("color"=> "#222222", "label" => __("Background Color","rt_theme_admin")),
				"font_color"            => array("color"=> "#fff", "label" => __("Text Color","rt_theme_admin")),
				"secondary_font_color"  => array("color"=> "#888888", "label" => __("Secondary Text Color","rt_theme_admin")),
				"light_text_color"      => array("color"=> "#fff", "label" => __("Opposite Text Color","rt_theme_admin")),
				"link_color"            => array("color"=> "#fff", "label" => __("Link Color","rt_theme_admin")),
				"heading_color"         => array("color"=> "#fff", "label" => __("Heading Color","rt_theme_admin")),
				"border_color"          => array("color"=> "#3D3D3D", "label" => __("Border Color","rt_theme_admin")),
				"form_button_bg_color"  => array("color"=> "#2f2f2f", "label" => __("Form Button Background Color","rt_theme_admin")),
				"social_media_bg_color" => array("color"=> "#2f2f2f","label" => __("Social Media Icons Background Color","rt_theme_admin")),

			));

		$color_list[".default-style"] = array(
			"id" => "default",
			"label" => __("Color Set 1","rt_theme_admin"),
			"description" => '<a class="highlight-section icon-flash" data-section-selector=".default-style" href="#" title="'.__('Blink sections which uses this color set','rt_theme_admin').'"></a>'. __('A color set that can be applied to any content rows or column.',"rt_theme_admin"),
			"colors" => array(

				"primary_color"         => array("color"=> "#e6aa21", "label" => __("Primary Color","rt_theme_admin")),
				"bg_color"              => array("color"=> "#fff", "label" => __("Row Background Color","rt_theme_admin")),
				"font_color"            => array("color"=> "#666", "label" => __("Text Color","rt_theme_admin")),
				"secondary_font_color"  => array("color"=> "#999999", "label" => __("Secondary Text Color","rt_theme_admin")),
				"light_text_color"      => array("color"=> "#fff", "label" => __("Opposite Text Color","rt_theme_admin")),
				"link_color"            => array("color"=> "#e6aa21", "label" => __("Link Color","rt_theme_admin")),
				"heading_color"         => array("color"=> "#222", "label" => __("Heading Color","rt_theme_admin")),
				"border_color"          => array("color"=> "#E8E8E8", "label" => __("Border Color","rt_theme_admin")),
				"form_button_bg_color"  => array("color"=> "#bbb", "label" => __("Form Button Background Color","rt_theme_admin")),
				"social_media_bg_color" => array("color"=> "#bbb", "label" => __("Social Media Icons Background Color","rt_theme_admin")),
			));

		$color_list[".alt-style-1"] = array(
			"id" => "alt_style_1",
			"label" => __("Color Set 2","rt_theme_admin"),
			"description" => '<a class="highlight-section icon-flash" data-section-selector=".alt-style-1" href="#" title="'.__('Blink sections which uses this color set','rt_theme_admin').'"></a>'. __('A color set that can be applied to any content rows or column.',"rt_theme_admin"),
			"colors" => array(

				"primary_color"         => array("color"=> "#e6aa21", "label" => __("Primary Color","rt_theme_admin")),
				"bg_color"              => array("color"=> "#f4f4f4", "label" => __("Row Background Color","rt_theme_admin")),
				"font_color"            => array("color"=> "#666", "label" => __("Text Color","rt_theme_admin")),
				"secondary_font_color"  => array("color"=> "#999999", "label" => __("Secondary Text Color","rt_theme_admin")),
				"light_text_color"      => array("color"=> "#fff", "label" => __("Opposite Text Color","rt_theme_admin")),
				"link_color"            => array("color"=> "#e6aa21", "label" => __("Link Color","rt_theme_admin")),
				"heading_color"         => array("color"=> "#222", "label" => __("Heading Color","rt_theme_admin")),
				"border_color"          => array("color"=> "#e1e1e1", "label" => __("Border Color","rt_theme_admin")),
				"form_button_bg_color"  => array("color"=> "#bbb", "label" => __("Form Button Background Color","rt_theme_admin")),
				"social_media_bg_color" => array("color"=> "#bbb", "label" => __("Social Media Icons Background Color","rt_theme_admin")),
			));

		$color_list[".alt-style-2"] = array(
			"id" => "alt_style_2",
			"label" => __("Color Set 3","rt_theme_admin"),
			"description" => '<a class="highlight-section icon-flash" data-section-selector=".alt-style-2" href="#" title="'.__('Blink sections which uses this color set','rt_theme_admin').'"></a>'. __('A color set that can be applied to any content rows or column.',"rt_theme_admin"),
			"colors" => array(

				"primary_color"         => array("color"=> "#C59600", "label" => __("Primary Color","rt_theme_admin")),
				"bg_color"              => array("color"=> "#e1af00", "label" => __("Row Background Color","rt_theme_admin")),
				"font_color"            => array("color"=> "#fff", "label" => __("Text Color","rt_theme_admin")),
				"secondary_font_color"  => array("color"=> "#FFEAA9", "label" => __("Secondary Text Color","rt_theme_admin")),
				"light_text_color"      => array("color"=> "#fff", "label" => __("Opposite Text Color","rt_theme_admin")),
				"link_color"            => array("color"=> "#fff", "label" => __("Link Color","rt_theme_admin")),
				"heading_color"         => array("color"=> "#fff", "label" => __("Heading Color","rt_theme_admin")),
				"border_color"          => array("color"=> "#FED861", "label" => __("Border Color","rt_theme_admin")),
				"form_button_bg_color"  => array("color"=> "#FFEFBA", "label" => __("Form Button Background Color","rt_theme_admin")),
				"social_media_bg_color" => array("color"=> "#bbb","label" => __("Social Media Icons Background Color","rt_theme_admin")),
			));

		$color_list[".light-style"] = array(
			"id" => "light_style",
			"label" => __("Color Set 4","rt_theme_admin"),
			"description" => '<a class="highlight-section icon-flash" data-section-selector=".light-style" href="#" title="'.__('Blink sections which uses this color set','rt_theme_admin').'"></a>'. __('A color set that can be applied to any content rows or column.',"rt_theme_admin"),
			"colors" => array(

				"primary_color"         => array("color"=> "rgba(255,255,255,0.2)", "label" => __("Primary Color","rt_theme_admin")),
				"bg_color"              => array("color"=> "#1e1e1e", "label" => __("Row Background Color","rt_theme_admin")),
				"font_color"            => array("color"=> "#fff", "label" => __("Text Color","rt_theme_admin")),
				"secondary_font_color"  => array("color"=> "#fff", "label" => __("Secondary Text Color","rt_theme_admin")),
				"light_text_color"      => array("color"=> "#fff", "label" => __("Opposite Text Color","rt_theme_admin")),
				"link_color"            => array("color"=> "#fff", "label" => __("Link Color","rt_theme_admin")),
				"heading_color"         => array("color"=> "#fff", "label" => __("Heading Color","rt_theme_admin")),
				"border_color"          => array("color"=> "rgba(255, 255, 255, 0.17)", "label" => __("Border Color","rt_theme_admin")),
				"form_button_bg_color"  => array("color"=> "rgba(55, 55, 55, 0.78)", "label" => __("Form Button Background Color","rt_theme_admin")),
				"social_media_bg_color" => array("color"=> "#bbb", "label" => __("Social Media Icons Background Color","rt_theme_admin")),
			));

		$color_list[".sidebar-widgets"] = array(
			"id" => "widgets",
			"label" => __("Sidebar Elements","rt_theme_admin"),
			"description" => '<a class="highlight-section icon-flash" data-section-selector=".sidebar-widgets" href="#" title="'.__('Blink sidebar elements','rt_theme_admin').'"></a>'. __('Use following settings to customize the elements in the left sidebar except the navigation',"rt_theme_admin"),
			"colors" => array(

				"primary_color"         => array("color"=> "#e6aa21", "label" => __("Primary Color","rt_theme_admin")),
				"bg_color"              => array("color"=> "rgba(0,0,0,0.8)", "label" => __("Background Color","rt_theme_admin")),
				"font_color"            => array("color"=> "#fff", "label" => __("Text Color","rt_theme_admin")),
				"secondary_font_color"  => array("color"=> "#888888", "label" => __("Secondary Text Color","rt_theme_admin")),
				"light_text_color"      => array("color"=> "#fff", "label" => __("Opposite Text Color","rt_theme_admin")),
				"link_color"            => array("color"=> "#fff", "label" => __("Link Color","rt_theme_admin")),
				"heading_color"         => array("color"=> "#fff", "label" => __("Heading Color","rt_theme_admin")),
				"border_color"          => array("color"=> "#3D3D3D", "label" => __("Border Color","rt_theme_admin")),
				"form_button_bg_color"  => array("color"=> "#2f2f2f", "label" => __("Form Button Background Color","rt_theme_admin")),
				"social_media_bg_color" => array("color"=> "#2f2f2f","label" => __("Social Media Icons Background Color","rt_theme_admin")),

			));

		$color_list[".footer"] = array(
			"id" => "footer",
			"label" => __("Footer","rt_theme_admin"),
			"description" => __('Use following settings to customize the footer section of your website.',"rt_theme_admin"),
			"colors" => array(

				"primary_color"         => array("color"=> "rgba(255,255,255,0.2)", "label" => __("Primary Color","rt_theme_admin")),
				"bg_color"              => array("color"=> "#2a2a2a", "label" => __("Row Background Color","rt_theme_admin")),
				"font_color"            => array("color"=> "#707070", "label" => __("Text Color","rt_theme_admin")),
				"secondary_font_color"  => array("color"=> "#eaeaea", "label" => __("Secondary Text Color","rt_theme_admin")),
				"light_text_color"      => array("color"=> "#ffffff", "label" => __("Opposite Text Color","rt_theme_admin")),
				"link_color"            => array("color"=> "#aeaeae", "label" => __("Link Color","rt_theme_admin")),
				"heading_color"         => array("color"=> "#cccccc", "label" => __("Heading Color","rt_theme_admin")),
				"border_color"          => array("color"=> "#3c3c3c", "label" => __("Border Color","rt_theme_admin")),
				"form_button_bg_color"  => array("color"=> "#444444", "label" => __("Form Button Background Color","rt_theme_admin")),
				"social_media_bg_color" => array("color"=> "#393939", "label" => __("Social Media Icons Background Color","rt_theme_admin")),
			));

		//Create Color Sets
		foreach ($color_list as $seletor => $schema ) {

			$controls  =array();

			foreach ($schema["colors"] as $color_id => $color_values  ) {


				//transport exteptions
				$transport = "postMessage";

				if( $schema["id"] == "side_panel" ){
					$transport = "refresh";
				}

				array_push($controls, array(
						'id'        => RT_THEMESLUG.'_'.$schema["id"]."_".$color_id,
						'label'     => $color_values["label"],
						"transport" => $transport,
						"default"   => $color_values["color"],
						"type"      => "rt_color",
						"rt_skin"   => true
					)
				);

			}

			array_push($options["rt_color_schemas"]["sections"], array(
					'id'          => $schema["id"],
					'title'       => $schema["label"],
					'description' => $schema["description"],
					'controls'    => apply_filters("rtframework_color_controls_".$schema["id"], $controls )
				)
			);

		}

		return $options;
	}
}

add_filter( 'rtframework_customizer_options', 'rtframework_create_color_set_options', 10 );

if( ! function_exists("rtframework_add_new_footer_options") ){
	/**
	 * Add additional controls to the footer colors
	 * @return array
	 */
	function rtframework_add_new_footer_options( $controls ){

		array_unshift($controls,

				array(
					"id"          => RT_THEMESLUG."_footer_widget_layout",
					"label"       => esc_html__("Footer Widgets Layout",'rt_theme_admin'),
					"description" => esc_html__("Select and set the column layout of the footer widget area.",'rt_theme_admin'),
					"choices"     =>  array(
												"1" => "1/1",
												"2" => "1/2 - 1/2",
												"3" => "1/3 - 1/3 - 1/3",
												"4" => "1/4 - 1/4 - 1/4 - 1/4",
												"5" => "2/6 - 1/6 - 1/6",
												"6" => "1/2 - 1/4 - 1/4",
												"7" => "1/4 - 1/2 - 1/4",
												"8" => "1/4 - 1/4 - 1/2",
												"9" => "4/6 - 1/6 - 1/6",
												"10" => "2/3 - 1/3",
												"11" => "1/3 - 2/3"
							  				),
					"default"   => "3",
					"transport" => "refresh",
					"type"      => "select",
					"rt_skin"   => true
				),

				array(
					"id"          => RT_THEMESLUG."_footer_background_width",
					"label"       => esc_html__("Footer Background Width",'rt_theme_admin'),
					"description" => esc_html__('Select a pre-defined width for the footer background','rt_theme_admin'),
					"transport"   => "refresh",
					"choices"     => array(
										"default" => esc_html__("Default Width", "rt_theme_admin"),
										"fullwidth" => esc_html__("Full Width", "rt_theme_admin"),
									),
					"default" => "default",
					"type"    => "select",
					"rt_skin"   => true
				),

				array(
					"id"          => RT_THEMESLUG."_footer_content_width",
					"label"       => esc_html__("Footer Content Width",'rt_theme_admin'),
					"description" => esc_html__('Select a pre-defined width for the footer content','rt_theme_admin'),
					"transport"   => "refresh",
					"choices"     => array(
										"default" => esc_html__("Default Width", "rt_theme_admin"),
										"fullwidth" => esc_html__("Full Width", "rt_theme_admin"),
									),
					"default" => "default",
					"type"    => "select",
					"rt_skin"   => true
				),

				array(
					"id"          => RT_THEMESLUG."_footer_sticky",
					"label"       => __("Covered Footer",'rt_theme_admin'),
					"description" => __('Enable/Disable the sticky (covered) footer effect','rt_theme_admin'),
					"transport"   => "refresh",
					"choices"     => array(
										"fixed_footer" => __("Covered", "rt_theme_admin"),
										"" => __("Classic", "rt_theme_admin"),
									),
					"default" => "fixed_footer",
					"type"    => "select",
					"rt_skin"   => true
				),

				array(
					"id"          => RT_THEMESLUG."_footer_row_seperator",
					"label"       => "",
					"description" => __('A color set that used only for footer elements.','rt_theme_admin'),
					"type"        => "rt_seperator"
				)

		);

		return $controls;
	}
}
add_filter( 'rtframework_color_controls_footer', 'rtframework_add_new_footer_options', 20 );

if( ! function_exists("rtframework_add_new_side_panel_options") ){
	/**
	 * Add additional controls to the side panel colors
	 * @return array
	 */
	function rtframework_add_new_side_panel_options( $controls ){

		array_unshift($controls,


			array(
				"id"          => RT_THEMESLUG."_show_side_panel",
				"label"       => __("Display Side Panel",'rt_theme_admin'),
				"description" => "",
				"transport"   => "refresh",
				"default"     => "on",
				"type"        => "checkbox",
				"rt_skin"     => true
			)

		);

		return $controls;
	}
}
add_filter( 'rtframework_color_controls_side_panel', 'rtframework_add_new_side_panel_options', 20 );


if( ! function_exists("rtframework_add_new_sidebar_widget_options") ){
	/**
	 * Add additional controls to the sidebar widgets
	 * @return array
	 */
	function rtframework_add_new_sidebar_widget_options( $controls ){

		array_unshift($controls,


					array(
						"id"          => RT_THEMESLUG."_shortcut_buttons",
						"label"       => __("Shortcut Bar",'rt_theme_admin'),
						"description" => __('Select the location of the shortcut icon buttons buttons bar that includes; Search, WPML Languages, WooCommerce Login & Cart buttons.
											Some of these buttons will only be visible if the related plugins are installed.
											If WPML and WooCommerce are not installed, only a search field will be displayed','rt_theme_admin'),
						"transport"   => "refresh",
						"choices"     => array(
											"after_logo" => __("Append it after the logo","rt_theme_admin"),
											"after_nav" => __("Append it after the navigation","rt_theme_admin"),
											"no" => __("Do not display","rt_theme_admin"),
										),
						"default" => "after_nav",
						"type"    => "select"
					),


					array(
						"id"          => RT_THEMESLUG."_sidebar_elements_seperator_2",
						"label"       => "",
						"description" => __('A color set that used for sidebar elements only.','rt_theme_admin'),
						"type"        => "rt_seperator"
					)


		);

		return $controls;
	}
}
add_filter( 'rtframework_color_controls_widgets', 'rtframework_add_new_sidebar_widget_options', 20 );
