<?php
/**
 * 
 * The template for displaying all pages
 *
 */
global $rt_sidebar_location;
get_header(); ?>

	<?php if ( have_posts() ) : ?> 

		<?php /* The loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>		
			

			<?php  
				/**
				 * get global post values
				 * @var $post
				 * @var array default atts
				 */
				$rt_portfolio_post_values = rt_get_portfolio_single_post_values( $post, array(  "layout" => "1/1",  "featured_image_max_height" => 1000, "featured_image_crop" => false, "show_share_buttons" => true, "featured_media_width" => "fullwidth" ));
			?>
			
			<?php
				/**
				 * Get the portfolio media 
				 * image gallery, video or audio
				 */
				get_template_part( '/portfolio-contents/media'); 
			?>

			<?php			
				// check if builder used in this post 
				$isbuilderactive = has_shortcode( get_the_content(), 'vc_row' ) || has_shortcode( get_the_content(), 'rt_row' ) ;

				/* open content container if builder not used */		
				do_action( "rt_content_container", array( "action"=>"start", "sidebar"=>$rt_global_variables['sidebar_position'], "class" => $rt_global_variables["default_content_row_width"], "echo" => $rt_global_variables['sidebar_position'] == "" && $isbuilderactive ? false : true, "overlap" => false ));

			?>

				<?php the_content(); ?>

				<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'rt_theme' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>			

			<?php 
				/* close content container if builder not used */		
				do_action("rt_content_container",array("action"=>"end", "sidebar"=>$rt_global_variables['sidebar_position'], "class" => $rt_global_variables["default_content_row_width"], "echo" => $rt_global_variables['sidebar_position'] == "" && $isbuilderactive ? false : true ));
			?>


			<?php
				/**
				 * Comments
				 */
				if( comments_open() ):
			?>
				
					<?php
						/* open content container for commments if builder is used */		 
						do_action( "rt_content_container", array( "action"=>"start", "sidebar"=>"", "class" => $rt_global_variables["default_content_row_width"], "echo" => $rt_global_variables['sidebar_position'] == "" && $isbuilderactive ? true : true ));
					?>

						<div class='entry commententry'>
							<?php comments_template(); ?>
						</div>

					<?php 
						/* close content container for commments if builder is used */		
						do_action("rt_content_container",array("action"=>"end", "sidebar"=>"", "class" => $rt_global_variables["default_content_row_width"], "echo" => $rt_global_variables['sidebar_position'] == "" && $isbuilderactive ? true : true ));
					?>

			<?php endif;?>

		<?php endwhile; ?>		

	<?php else : ?>
		<?php get_template_part( 'content', 'none' ); ?>
	<?php endif; ?>
 
<?php get_footer(); ?>