<?php
# 
# rt-theme
# post content for link post types in listing pages
# 
global $rt_post_values, $rt_blog_list_atts;
extract($rt_post_values);
extract($rt_blog_list_atts);
?> 

<!-- blog box-->
<article <?php post_class("loop")?> id="post-<?php the_ID(); ?>">
		
	
	<?php if( ! empty( $thumbnail_image_output )  ):?>
	<div class="featured_image featured_media">
		<?php 
 			printf('<a href="%2$s" target="_blank" class="imgeffect extlink lightbox_ featured_image" title="%3$s">%1$s</a>',$thumbnail_image_output, $post_format_link, get_the_title() );
		?>
		<span class="format-icon icon-link"></span>
	</div> 
	<?php endif;?>


	<?php if($show_date !== "false"):?><div class="date"><?php echo get_the_date(); ?></div><?php endif;?> 
	<div class="text entry-content">
		
		<!-- blog headline-->
		<h2 class="entry-title"><a href="<?php echo $permalink ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		<?php echo '<a href="'.$post_format_link.'"  class="the-link" target="_blank" title="'. __( 'Go to:', 'rt_theme' ) ."". $post_format_link.'">'.$post_format_link.'</a>'?>

			

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
