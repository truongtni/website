<?php
# 
# rt-theme
# porfolio media output for image/gallery portfolio type
# 
global $rt_portfolio_post_values, $rt_global_variables;

extract($rt_portfolio_post_values);
?> 

<?php
	if( ! $no_featured_media ){
		/* open content container for commments if builder is used */		

		$overlap = apply_filters( "rt_content_overlap", true );
		$padding = $overlap == true || ($gallery_usage == "slider" && $rt_global_variables["hide_page_title"] && $rt_global_variables["hide_breadcrumb_menu"]) ? "nopadding" : "";

		do_action( "rt_content_container", array( "action"=>"start", "overlap" => $overlap, "echo" => true, "fullwidth" => $featured_media_width, "class" => $gallery_usage != "gallery" ? "portfolio-media ".$padding : "portfolio-media", "wrapper_class" => $padding, "col_class" => $gallery_usage != "gallery" ? $padding : "" ) );
	}
?>

		<?php
		/*
		*
		* Featured Image
		*
		*/
		if( ! empty( $thumbnail_image_output ) && ! $hide_featured_image_single_page ):?>

		<div class="featured_image">
			<?php 
				//create lightbox link
				do_action("create_lightbox_link",
					array(
						'class'          => 'imgeffect zoom lightbox_ featured_image',
						'href'           => $featured_image_url,
						'title'          => __('Enlarge Image','rt_theme'),
						'data_group'     => 'image_'.$featured_image_id,
						'data_title'     => $title,
						'data_thumbnail' => $lightbox_thumbnail,
						'inner_content'  => $thumbnail_image_output
					)
				);
			?>
		</div> 
		<?php endif;?>

		<?php
		/*
		*
		* Multiple Images
		*
		*/
		if( is_array( $gallery_images ) && count( $gallery_images ) > 0 ){

			if( $gallery_usage == "slider" ){ //create sldier from the images ?>
				<div class="slideshow">
					<?php
						// Get image slider
						do_action("rt_create_image_carousel",
							array(
								"id"  => 'portfolio-carousel-'.get_the_ID(),   
								"crop" => $gallery_images_crop, 
								"w"	 => $featured_media_width == "fullwidth" ? 3000 : "",
								"h"	 => $gallery_images_crop ? $gallery_images_max_height : 3000,
								"rt_gallery_images" => $gallery_images,
								"column_width" => $layout,
								"carousel_atts" => array( 
													"id"          => 'portfolio-single-gallery-'.get_the_ID(),  
													"item_width"  => 1, 
													"class"       => "post-carousel rt-image-carousel",
													"dots"        => "false",
													"nav"         => "true"
												)
							)
						);
					?>
				</div> 

			<?php }else{  //create photo gallery from the images ?>

				<div class="photo-gallery">
					<?php

						// Get image gallery
						do_action("create_photo_gallery",
							array( 
								"slider_id"      => 'portfolio-single-gallery-'.get_the_ID(),  
								"crop"           => $gallery_images_crop, 	    
								'image_ids'      => $gallery_images, 
								"h"              => $gallery_images_max_height,
								"lightbox"       => true,
								"captions"       => true,
								"item_width"     => $gallery_layout,
								"layout_style"   => "grid"
							)
						);
					?>
				</div>

			<?php
			}
		}
		?> 

		<?php 
		/*
		*
		* Video
		*
		*/
		if( $external_video || $video_mp4 ) : ?>
		<div class="featured_video">
			<?php
			//self hosted videos
			if( $video_mp4 ){
				do_action("create_media_output",
					array(
						'id' => 'video-'.get_the_ID(),
						'type' => "video",
						'file_mp4' => $video_mp4,
						'file_webm' => $video_webm,
						'poster'=> ! empty( $video_poster_img) ? $video_poster_img : $featured_image_url
					)
				);
			}

			//external videos
			if ($external_video){
				 
				if( strpos($external_video, 'youtube')  ) { //youtube
					echo '<div class="video-container embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="//www.youtube.com/embed/'.rt_find_tube_video_id($external_video).'" allowfullscreen></iframe></div>';
				}
				
				if( strpos($external_video, 'vimeo')  ) { //vimeo
					echo '<div class="video-container embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="//player.vimeo.com/video/'.rt_find_tube_video_id($external_video).'?color=d6d6d6&title=0&amp;byline=0&amp;portrait=0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';
				}			
			}
			?>
		</div> 		
		<?php endif;?>


		<?php 
		/*
		*
		* Audio
		*
		*/
		if( $audio_mp3 ) : ?>
		<div class="featured_audio">

			<?php
			//self hosted audio
			do_action("create_media_output",
				array(
					'id' => 'audio-'.get_the_ID(),
					'type' => "audio",
					'file_mp3' => $audio_mp3,
					'file_oga' => $audio_ogg
				)
			);
			?>
		</div> 		
		<?php endif;?>

<?php
	if( ! $no_featured_media ){
		/* close content container */
		do_action( "rt_content_container", array( "action"=>"end",  "echo" => true  ) );
	}
?>