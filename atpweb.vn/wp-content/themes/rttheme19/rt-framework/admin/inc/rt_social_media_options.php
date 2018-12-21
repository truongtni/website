<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * RT-Theme Social Media Options
 */

$this->options["rt_social_media_options"] = array(

		'title' => __("Social Media Options", "rt_theme_admin"), 
		'description' => "", 
		'priority' => 8,
		'sections' => array(									

								/*
								array(
									'id'       => 'visibility',
									'title'    => __("Visibility", "rt_theme_admin"), 
									'controls' => array( 
														array(
															"id"        => RT_THEMESLUG."_social_media",															
															"label"     => __("Display the icons in the website",'rt_theme_admin'),
															"default"   => "on",
															"transport" => "refresh", 
															"type"      => "checkbox"
														),												
												),
								),	

								*/
					)

		);


$rt_social_media_icons = $this->rt_social_media_icons;
ksort( $rt_social_media_icons );

//add all icons within a seperate section
foreach ($rt_social_media_icons as $key => $value) {

	switch ($key) {
		case 'Email':
			$msgdesc=__("Enter a URL to your contact page or your email address.",'rt_theme_admin');
			break;
		
		case 'Skype':
			$msgdesc=__("Enter a skype address. <strong>Syntax</strong> : 'skype:skypeid?call' or 'skype:phonenumber?call'.",'rt_theme_admin');	
			break;

		case 'RSS':
			$msgdesc= __("Enter a valid URL (http or https) to the RSS-feed. <strong>For example</strong>  http://yourwebsite.com/feed/ ",'rt_theme_admin');
			break;

		default:
			$msgdesc= __("Enter the URL that you want to link the icon <strong>For example</strong>  http://social-media-site.com/your-name/ ",'rt_theme_admin');
			break;
	}

	array_push($this->options["rt_social_media_options"]["sections"], array(
			'id'       => $value,
			'title'    => $key." ".__("Options", "rt_theme_admin"), 
			'controls' => array( 
								array(
									"id"          => RT_THEMESLUG."_".$value,										
									"label"       => __("Link (URL)",'rt_theme_admin'),
									"default"     => "",
									"description" => $msgdesc,
									"type"        => "text"
								),															
								array(
									"id"      => RT_THEMESLUG."_".$value."_text",											
									"label"   => __("Hover Text",'rt_theme_admin'),
									"default" => "",
									"type"    => "text"
								),										
								array(
									'id'      => RT_THEMESLUG."_".$value."_target",						
									'label'   => __("Link Target",'rt_theme_admin'),
									'type'    => 'select',
									"default" => "",
									'choices' =>  array('_blank'=>'New Window','_self'=>'Same Window'),
								),													
						),
		)
	);

}