<?php
# 
# rt-theme
# loop item for portfolio custom posts
# image post format
#
global $rt_item_width; 


$short_data = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'_short_data', true); 		
$position = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'_position', true); 	
$long_data = get_the_content();
$permalink = ! empty( $long_data ) ? get_permalink() : "" ;
?>

 
<?php if ( ! post_password_required() ) : ?>
<div <?php post_class("loop")?> id="person-<?php the_ID(); ?>">	
	<?php if ( has_post_thumbnail() ) : ?>
	<div class="person_image">
		<div class="person_image_wrapper">
			<?php
			// Create thumbnail image
			$thumbnail_image_output = get_resized_image_output( array( "image_url" => "", "image_id" => get_post_thumbnail_id(), "w" => rt_get_min_resize_size( $rt_item_width ), "h" => 100000, "crop" => "" ) ); 	
			?>

			<?php if( $permalink ) : ?>
				<a href="<?php echo $permalink;?>"><?php echo $thumbnail_image_output;?></a>
			<?php else:?>
				<?php echo $thumbnail_image_output;?>
			<?php endif;?>			
		</div>
	</div>
	<?php endif;?>

	<?php if( $permalink ) : ?>
		<h5 class="person_name"><a href="<?php echo $permalink;?>"><?php the_title();?></a></h5>
	<?php else:?>
		<h5 class="person_name"><?php the_title();?></h5>
	<?php endif;?>

	<?php if(! empty( $position )) : ?>
		<span class="position"><?php echo $position;?></span>
	<?php endif;?>

	<div class="profile">
		<?php echo $short_data; ?>
	</div> 

	<?php do_action("rt_staff_media_links",$post->ID); ?>	
</div>
<?php endif;?>