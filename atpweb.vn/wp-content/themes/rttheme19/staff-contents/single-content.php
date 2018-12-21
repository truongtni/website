<?php
/**
 * 
 * template for displaying staff detail page
 *
 */
global $rt_sidebar_location;
get_header(); ?>
 
<?php if ( have_posts() ) : ?> 
	<div <?php post_class("single")?> id="person-<?php the_ID(); ?>">	
			<?php /* The loop */ ?>
			
			<?php while ( have_posts() ) : the_post(); ?>		
				
				<?php if ( has_post_thumbnail() && ! post_password_required() ) : 

					// Create thumbnail image
					$thumbnail_image_output = get_resized_image_output( array( "image_url" => "", "image_id" => get_post_thumbnail_id(), "w" => 300, "h" => 100000, "crop" => "" ) ); 
				?>								
					<div class="entry-thumbnail alignleft">
						<?php echo $thumbnail_image_output; ?>
						<?php do_action("rt_staff_media_links",$post->ID); ?>
					</div>
				<?php endif; ?>		
				
				<?php the_content(); ?>

				
				<?php echo ! has_post_thumbnail() ?  '<div class="staff-single-media-links aligncenter">'.rt_staff_media_links(get_the_ID()).'</div>' : "" ; ?>

				<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'rt_theme' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>			
			<?php endwhile; ?>		
	</div>
<?php else : ?>
	<?php get_template_part( 'content', 'none' ); ?>
<?php endif; ?>

<?php get_footer(); ?>