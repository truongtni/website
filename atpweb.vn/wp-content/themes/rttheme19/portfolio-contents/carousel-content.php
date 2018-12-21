<?php
/**
 * The template for displaying portfolio content within a carousel
 *
 * @author 		RT-Themes
 * 
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


global $rt_portfolio_post_values, $rt_portfolio_list_atts;
extract($rt_portfolio_post_values);
extract($rt_portfolio_list_atts);
?> 

<!-- portfolio box-->
<div <?php post_class("loop " .$item_style. " ". $portfolio_format)?> id="portfolio-<?php the_ID(); ?>">

	<?php 

		//title output
		$title_output = $permalink ? sprintf('<h5 class="clean_heading"><a href="%s" target="%s" rel="bookmark">%s</a></h5>',$permalink,$target,$title) : sprintf('<h5>%s</h5>',$title) ;

		//shor desc output
		$desc_output = ! empty( $short_desc ) ? sprintf( '<p>%s</p>', $short_desc ) : "" ;


		//create lightbox links
		switch ( $portfolio_format ) {
			case 'video':
			 
				$video_url = !empty( $external_video ) ? $external_video : $video_mp4;

				if( $video_mp4 ){
					printf('
						<div style="display:none;" id="%1$s">
							<video class="lg-video-object lg-html5" controls preload="none" poster="%4$s">
								<source src="%2$s" type="video/mp4" title="mp4">
								<source src="%3$s" type="video/webm" title="webm">
							</video>
						</div>
					','video-'.get_the_ID(), $video_mp4, $video_webm, $featured_image_url);
				}

				$lightbox_link = rt_create_lightbox_link( array( 'class'=> 'video lightbox_', 'href'=> $video_mp4 ? "" : $video_url, 'title'=> __('Play Video','rt_theme'), 'data_group'=> 'image_'.$featured_image_id, 'data_title'=> $title, 'data_thumbnail' => $lightbox_thumbnail, "data_html" => $video_mp4 ? '#video-'.get_the_ID() : "", 'echo'=> false) ); 

				break;

			case 'audio':

				if( $audio_mp3 ){
					printf('
						<div style="display:none;" id="%1$s">
							<audio class="lg-video-object lg-html5" controls preload="none">
								<source src="%2$s" type="video/mp4" title="mp4">
								<source src="%3$s" type="video/webm" title="webm">
							</audio>
						</div>
					','audio-'.get_the_ID(), $audio_mp3, $audio_ogg);
				}	

				$lightbox_link = rt_create_lightbox_link( array( 'class'=> 'audio lightbox_', 'href'=> "", 'title'=> __('Play Audio','rt_theme'), 'data_group'=> 'image_'.$featured_image_id, 'data_title'=> $title, 'data_thumbnail' => $lightbox_thumbnail, "data_html" => $audio_mp3 ? '#audio-'.get_the_ID() : "", 'echo'=> false) ); 
				
				break;
						
			default:
				
				$lightbox_link = rt_create_lightbox_link( array( 'class'=> 'zoom lightbox_', 'href'=> $featured_image_url, 'title'=> __('Enlarge Image','rt_theme'), 'data_group'=> 'image_'.$featured_image_id, 'data_title'=> $title, 'data_thumbnail' => $lightbox_thumbnail, 'echo'=> false) ); 

				break;
		}

		//lightbox disabled?
		$lightbox_link = $disable_lightbox ? "" : $lightbox_link;

		//create action buttons
		$action_buttons = rt_action_buttons(array( "lightbox_link" => $lightbox_link, "link" => $permalink, "title" => $title, "external_link" => $external_link, "target" => $target, "echo" => false));


		//output
		if( $item_style == "style-1" ){

			printf('

				<figure class="featured_image">
					%1$s
					<div class="overlay">%2$s</div>
				</figure>

				<section class="text">
					%3$s
					%4$s
				</section> 

			', $thumbnail_image_output, $action_buttons, $title_output, $desc_output );

		}else{
			printf('

				<figure class="featured_image">
					%1$s				
				</figure>

				<div class="overlay">

					<section class="text">
						%3$s
						%4$s
						%2$s
					</section> 	

				</div>

			', $thumbnail_image_output, $action_buttons, $title_output, $desc_output );
		}

	?>

</div> 
<!-- / portfolio box-->
