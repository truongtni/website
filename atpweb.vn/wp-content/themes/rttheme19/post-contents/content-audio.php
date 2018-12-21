<?php
# 
# rt-theme
# post content for audio post types in listing pages
# 
global $rt_post_values, $rt_blog_list_atts;
extract($rt_post_values);
extract($rt_blog_list_atts);
?> 

<!-- blog box-->
<article <?php post_class("loop")?> id="post-<?php the_ID(); ?>">
		
	
	<?php 
	//display featured image
	if( ! empty( $thumbnail_image_output ) && $audio_usage_listing == "only_featured_image"  ): ?>
	<figure class="featured_image featured_media">
		<?php if( get_theme_mod( RT_THEMESLUG.'_use_lightbox') ):?>
		<?php 

			if( $audio_mp3 ){
				printf('
					<div style="display:none;" id="%1$s">
						<audio class="lg-video-object lg-html5" controls preload="none">
							<source src="%2$s" type="video/mp4" title="mp4">
							<source src="%3$s" type="video/webm" title="webm">
						</audio>
					</div>
				','featured-image-'.get_the_ID(), $audio_mp3, $audio_ogg);
			}	

			//create lightbox link
			do_action("create_lightbox_link",
				array(
					"id"             => 'featured-image-'.get_the_ID(), 
					'class'          => 'imgeffect audio lightbox_ featured_image',
					"data_html"      => $audio_mp3 ? '#featured-image-'.get_the_ID() : "", 	
					'href'           => "",
					'data_group'     => 'image_'.$featured_image_id,
					'title'          => $title,													
					'data_thumbnail' => $lightbox_thumbnail,
					'inner_content'  => $thumbnail_image_output		
				)
			);
		?>
		<span class="format-icon icon-note"></span>
		<?php else:?>
			<a href="<?php echo get_the_permalink(); ?>" title="<?php the_title(); ?>" class="featured_image imgeffect link"><?php echo $thumbnail_image_output;?></a>
		<?php endif;?>				
	</figure> 
	<?php endif;?>

	<?php 
	//display the audio
	if( $audio_usage_listing == "same" && $audio_mp3 ) : ?>
	<div class="featured_audio featured_media">

		<?php
		//self hosted audio
		do_action("create_media_output",
			array(
				'id' => 'audio-'.get_the_ID(),
				'type' => "audio",
				'file_mp3' => $audio_mp3,
				'file_oga' => $audio_ogg,
				'poster'=> $featured_image_url					
			)
		);
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