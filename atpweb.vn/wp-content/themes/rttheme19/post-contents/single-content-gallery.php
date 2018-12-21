<?php
# 
# rt-theme
# single post content for gallery post types
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
	/*
	*
	* Multiple Image
	*
	*/

	if( is_array( $gallery_images ) && count( $gallery_images ) > 0 ){

		if( $gallery_usage == "slider" ){ //create sldier from the images ?>
			<section class="slideshow featured_media">
				<?php
					// Get image slider
					do_action("rt_create_image_carousel",
						array(
							"id"  => 'post-carousel-'.get_the_ID(),   
							"crop" => $slider_images_crop, 
							"h"	 => $slider_images_max_height,
							"rt_gallery_images" => $gallery_images,
							"column_width" => $layout,
							"carousel_atts" => array( 
												"id"          => 'post-single-gallery-'.get_the_ID(),  
												"item_width"  => 1, 
												"class"       => "post-carousel rt-image-carousel",
												"dots"        => "false",
												"nav"         => "true"
											)
						)
					);
				?>
				<span class="format-icon icon-picture"></span>
			</section> 

		<?php }else{  //create photo gallery from the images ?>

			<section class="photo-gallery featured_media">
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
			</section>

		<?php
		}

	}

	?> 

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
