<?php

if( ! function_exists("rt_social_media_share") ){
	/**
	 * Social Media Share Shortcode
	 * 
	 * @global class $post 
	 * 
	 * @param  array $atts
	 * @param  string $content
	 * @return string $output
	 */
	function rt_social_media_share( $atts = array(), $content = null ) {
	 
		global $post;


		//Available Social Media Icons
		$rt_social_share_list =apply_filters("rt_social_media_list",array(  
					"Email"       => array("icon_name" => "mail", "url" => "mailto:?body=[URL]", "popup" => false ), 
					"Twitter"     => array("icon_name" => "twitter", "url" => "http://twitter.com/home?status=[TITLE]+[URL]", "popup" => true ), 
					"Facebook"    => array("icon_name" => "facebook", "url" => "http://www.facebook.com/sharer/sharer.php?u=[URL]&amp;title=[TITLE]", "popup" => true ), 
					"Google +"    => array("icon_name" => "gplus", "url" => "https://plus.google.com/share?url=[URL]", "popup" => true ), 
					"Pinterest"   => array("icon_name" => "pinterest", "url" => "http://pinterest.com/pin/create/bookmarklet/?media=[MEDIA]&amp;url=[URL]&amp;is_video=false&amp;description=[TITLE]", "popup" => true ), 
					"Tumblr"      => array("icon_name" => "tumblr", "url" => "http://tumblr.com/share?url=[URL]&amp;title=[TITLE]", "popup" => true ), 
					"Linkedin"    => array("icon_name" => "linkedin", "url" => "http://www.linkedin.com/shareArticle?mini=true&amp;url=[URL]&amp;title=[TITLE]&amp;source=", "popup" => true ),   
					//"StumbleUpon" => array("icon_name" => "stumbleupon", "url" => "http://www.stumbleupon.com/submit?url=[URL]&amp;title=[TITLE]", "popup" => true ), 
					//"Evernote"    => array("icon_name" => "evernote", "url" => "http://www.evernote.com/clip.action?url=[URL]&amp;title=[TITLE]", "popup" => true ), 
					"Vkontakte"   => array("icon_name" => "vkontakte", "url" => "http://vkontakte.ru/share.php?url=[URL]", "popup" => true ), 
					//"Delicious"   => array("icon_name" => "delicious", "url" => "http://del.icio.us/post?url=[URL]&amp;title=[TITLE]]&amp;notes=", "popup" => true ),	
					//"Reddit"	  => array("icon_name" => "reddit", "url" => "http://www.reddit.com/submit?url=[URL]&amp;title=[TITLE]", "popup" => true )
			));



		$title = urlencode(get_the_title( $post->ID ));
		$permalink = urlencode(get_the_permalink( $post->ID ));
		$image = urlencode(rt_get_attachment_image_src(get_post_thumbnail_id( $post->ID )));
		$output = "";

		foreach ($rt_social_share_list as $key => $value){

				$value["url"] = str_replace("[URL]", $permalink, $value["url"] );
				$value["url"] = str_replace("[TITLE]", $title, $value["url"] );
				$value["url"] = str_replace("[MEDIA]", $image, $value["url"] );
	 
				$output .= '<li class="'.$value["icon_name"].'">';
				$output .= $value["popup"] ?
							'<a class="icon-'.$value["icon_name"].' " href="#" data-url="'. $value["url"] .'" title="'. $key .'">':
							'<a class="icon-'.$value["icon_name"].' " href="'. $value["url"] .'" title="'. $key .'">';			
				$output .= '<span>'. $key .'</span>';

				$output .= '</a>';
				$output .= '</li>';
		}

	 
		return  '
		<div class="social_share_holder">
		<div class="share_text"><span class="icon-share">'.__("Share","rt_theme").'</span></div>
		<ul class="social_media">'.$output.'</ul>
		</div>';
	}
}

add_shortcode('rt_social_media_share', 'rt_social_media_share');