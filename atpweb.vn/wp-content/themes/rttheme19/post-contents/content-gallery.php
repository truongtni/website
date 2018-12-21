<?php
# 
# rt-theme
# post content for gallery post types in listing pages
# 
global $rt_post_values, $rt_blog_list_atts;
extract($rt_post_values);
extract($rt_blog_list_atts);
?> 

<!-- blog box-->
<article <?php post_class("loop")?> id="post-<?php the_ID(); ?>">
		
	
	<?php if( ! empty( $thumbnail_image_output ) && $gallery_usage_listing == "only_featured_image" ):?>
	<figure class="featured_image featured_media">
		<?php if( get_theme_mod( RT_THEMESLUG.'_use_lightbox') ):?>
		<?php 
			//create lightbox link
			do_action("create_lightbox_link",
				array(
					"id"             => 'featured-image-'.get_the_ID(), 
					'class'          => 'imgeffect zoom lightbox_ featured_image',
					'href'           => $featured_image_url,
					'title'          =>  $title,
					'data_group'     => 'image_'.$featured_image_id, 
					'data_thumbnail' => $lightbox_thumbnail,
					'inner_content'  => $thumbnail_image_output
				)
			);
		?>
		<span class="format-icon icon-picture"></span>
		<?php else:?>
			<a href="<?php echo get_the_permalink(); ?>" title="<?php the_title(); ?>" class="featured_image imgeffect link"><?php echo $thumbnail_image_output;?></a>
		<?php endif;?>			
	</figure> 
	<?php endif;?>

	<?php
	/*
	*
	* Multiple Image
	*
	*/

	if( is_array( $gallery_images ) && count( $gallery_images ) > 0 && (  $gallery_usage_listing == "same" )  ){

		if( $gallery_usage == "slider" ){ //create sldier from the images ?>
			<figure class="slideshow featured_media">
				<?php
					// Get image slider
					do_action("rt_create_image_carousel",
						array(
							"id"  => 'post-carousel-'.get_the_ID(),   
							"crop" => $slider_images_crop, 
							"h"	 => $slider_images_max_height,
							"rt_gallery_images" => $gallery_images,
							"column_width" => $list_layout,
							"carousel_atts" => array( 
												"id"          => 'post-single-gallery-'.get_the_ID(),  
												"item_width"  => 1, 
												"class"       => "post-carousel",
												"dots"        => "false",
												"nav"         => "true"
											)
						)
					);
				?>
				<span class="format-icon icon-picture"></span>
			</figure> 

		<?php }else{  //create photo gallery from the images ?>

			<figure class="photo-gallery featured_media">
				<?php

					// Get image gallery
					do_action("create_photo_gallery",
						array( 
							"slider_id"      => 'post-single-gallery-'.get_the_ID(),  
							"crop"           => true, 	    
							'image_ids'      => $gallery_images, 
							"lightbox"       => true,
							"captions"       => true,
							"item_width"     => "1/4",
							"layout_style"   => "grid"
						)
					);
				?>
			</figure>

		<?php
		}

	}

	?> 



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