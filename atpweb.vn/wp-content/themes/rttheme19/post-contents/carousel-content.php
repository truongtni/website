<?php
# 
# rt-theme
# post content for standart post types in listing pages
# 
global $rt_post_values, $rt_blog_list_atts;
extract($rt_post_values);
extract($rt_blog_list_atts);
$post_format = get_post_format();
?> 

<!-- blog box-->
<article <?php post_class("loop")?> id="post-<?php the_ID(); ?>">
		
	
<?php if( ! empty( $thumbnail_image_output ) ):?>
	<?php if( $post_format != "aside" || $post_format != "link" ):?>
		<figure class="featured_image">
			<a href="<?php echo $permalink ?>" title="<?php the_title(); ?>" rel="bookmark"><?php echo $thumbnail_image_output; ?></a>
		</figure>  	
	<?php else:?>
		<figure class="featured_image">
			<?php echo $thumbnail_image_output; ?>
		</figure>  	
	<?php endif; ?>
<?php endif; ?>


	<?php if($show_date !== "false"):?>
		<div class="date"><?php echo get_the_date(); ?></div>
	<?php endif;?>

	<div class="text">

		<!-- blog headline-->
		<?php if( $post_format != "aside" ):?>
			<h5 class="clean_heading"><a href="<?php echo $permalink ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h5> 
		<?php else:?>
			<h5 class="clean_heading"><?php the_title(); ?></h5> 
		<?php endif; ?>

		<?php 
		if($excerpt_length>0){
			echo wp_html_excerpt(get_the_excerpt(),$excerpt_length,"...");
		}
		?>

		<?php 
			//post meta bar
			do_action( "post_meta_bar", array( "show_author"=> $show_author, "show_categories" => $show_categories, "show_comment_numbers" => $show_comment_numbers, "show_date" => $show_date) ); 			
		?>

	</div> 

</article> 
<!-- / blog box-->
