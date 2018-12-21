<?php
# 
# rt-theme
# post content for video post types in listing pages
# 
global $rt_post_values, $rt_blog_list_atts;
extract($rt_post_values);
extract($rt_blog_list_atts);
?> 

<!-- blog box-->
<article <?php post_class("loop")?> id="post-<?php the_ID(); ?>">
	
	<?php 
	//display featured image
	if( ! empty( $thumbnail_image_output ) && $video_usage_listing == "only_featured_image"  ): ?>

	<figure class="featured_image featured_media">
		<?php if( get_theme_mod( RT_THEMESLUG.'_use_lightbox') ):?>

			<?php 
				if( $video_mp4 ){
					printf('
						<div style="display:none;" id="%1$s">
							<video class="lg-video-object lg-html5" controls preload="none" poster="%4$s">
								<source src="%2$s" type="video/mp4" title="mp4">
								<source src="%3$s" type="video/webm" title="webm">
							</video>
						</div>
					','featured-image-'.get_the_ID(), $video_mp4, $video_webm, $featured_image_url);
				}			

				//create lightbox link
				do_action("create_lightbox_link",
					array(
						"id"             => 'featured-image-'.get_the_ID(), 		
						"data_html"      => $video_mp4 ? '#featured-image-'.get_the_ID() : "", 				
						'class'          => 'imgeffect video lightbox_ featured_image',
						'href'           => $video_mp4 ? "" : $external_video,
						'title'          => $title,
						'data_group'     => 'image_'.$featured_image_id, 
						'data_thumbnail' => $lightbox_thumbnail,
						'inner_content'  => $thumbnail_image_output			
					)
				);
			?>
			<span class="format-icon icon-videocam"></span>
		<?php else:?>
			<a href="<?php echo get_the_permalink(); ?>" title="<?php the_title(); ?>" class="featured_image imgeffect link"><?php echo $thumbnail_image_output;?></a>
		<?php endif;?>		
	</figure> 
	<?php endif;?>

	<?php 
	//display the video
	if( $video_usage_listing == "same" && ( $external_video || $video_mp4 ) ) : ?>
	<div class="featured_video featured_media">
		<?php
		//self hosted videos
		if( $video_mp4 ){
			do_action("create_media_output",
				array(
					'id' => 'video-'.get_the_ID(),
					'type' => "video",
					'file_mp4' => $video_mp4,
					'file_webm' => $video_webm,
					'poster'=> $featured_image_url
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


	<?php if($show_date !== "false"):?><div class="date"><?php echo get_the_date(); ?></div><?php endif;?> 
	<div class="text entry-content">

		<!-- blog headline-->
		<h2 class="entry-title"><a href="<?php echo $permalink ?>" rel="bookmark"><?php the_title(); ?></a></h2> 
			

		<?php 
			if( $use_excerpts !== "false" ){
				the_excerpt();
			}else{
				the_content( __( 'Continue reading', 'rt_theme' ) );
				wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'rt_theme' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) );
			}
		?>

		<?php 
			//post meta bar
			do_action( "post_meta_bar", array( "show_author"=> $show_author, "show_categories" => $show_categories, "show_comment_numbers" => $show_comment_numbers, "show_date" => $show_date) ); 
		?>
	</div> 

</article> 
<!-- / blog box-->