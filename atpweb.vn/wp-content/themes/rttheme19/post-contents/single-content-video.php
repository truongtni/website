<?php
# 
# rt-theme
# single post content for video post types
# 
global $rt_post_values, $rt_global_variables;
extract($rt_post_values);
?> 

<article <?php post_class("single")?> id="post-<?php the_ID(); ?>">
	
	<?php if( ! empty( $thumbnail_image_output ) && $featured_image_single_page ):?>
	<section class="featured_image featured_media">
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
		<span class="format-icon icon-pencil"></span>
	</section> 
	<?php endif;?>
	
	<?php 
	//display the video
	if( $external_video || $video_mp4 ) : ?>
	<section class="featured_video featured_media">
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
	</section> 		
	<?php endif;?>

	<section class="post-title-holder row">

			<?php if($show_share_buttons):?>
				<div class="col col-sm-7 col-xs-12">
			<?php else:?>
				<div class="col col-sm-12 col-xs-12">
			<?php endif;?>

				<?php if( $show_date !== "false" ):?><section class="date"><?php the_date(); ?></section><?php endif;?>
				<!-- blog headline--> 
				<?php printf('<%2$s class="entry-title">%1$s</%2$s>', get_the_title(), $rt_global_variables["heading_tag"] ) ?>
			
			<?php if($show_share_buttons):?>
				</div> 
				<div class="col col-sm-5 col-xs-12">
				<?php 
					//Social Share buttons
					echo do_shortcode( apply_filters("rt_social_share_shortcode","[rt_social_media_share]") );
				?>
			<?php endif;?>		
			</div><!-- / .col --> 

	</section>

	<div class="text entry-content">		
		<!-- content--> 
		<?php the_content(); ?>

		<!-- pagination--> 
		<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'rt_theme' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>

		<!-- updated--> 
		<span class="updated hidden"><?php echo the_modified_date();?></span>
	</div> 



	<?php 
		//post meta bar
		do_action( "post_meta_bar", array( "show_author"=> $show_author, "show_categories" => $show_categories, "show_comment_numbers" => $show_comment_numbers, "show_date" => $show_date, "show_tags" => $show_tags) ); 
	?>

</article> 