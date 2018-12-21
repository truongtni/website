<?php
/**
 * 
 * The template for displaying all pages
 *
 */
get_header(); ?>

	<?php if ( have_posts() ) : ?> 

		<?php /* The loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>		
			
			<?php 
			/* check if builder used */
			$isbuilderactive = has_shortcode( get_the_content(), 'vc_row' ) || has_shortcode( get_the_content(), 'rt_row' ) ;
			
			/* open content container if builder not used */		
			do_action( "rt_content_container", array( "action"=>"start", "sidebar"=>$rt_global_variables['sidebar_position'], "class" => $rt_global_variables["default_content_row_width"], "echo" => $rt_global_variables['sidebar_position'] == "" && $isbuilderactive ? false : true , "overlap" => apply_filters( "rt_content_overlap", true ) ) );
			?>

				<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
				<div class="entry-thumbnail">
					<?php the_post_thumbnail(); ?>
				</div>
				<?php endif; ?>			
				
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
				if( get_theme_mod( RT_THEMESLUG.'_allow_page_comments' ) && comments_open() ):
			?>
					<?php
						/* open content container for commments if builder is used */		
						do_action( "rt_content_container", array( "action"=>"start", "class" => $rt_global_variables["default_content_row_width"], "overlap" => false ,"echo" => true ) );
					?>

						<div class='entry commententry'>
							<?php comments_template(); ?>
						</div>

					<?php 
						/* close content container for commments if builder is used */		
						do_action( "rt_content_container", array( "action"=>"end", "overlap" => false ,"echo" => true ) );
					?>

			<?php endif;?>


		<?php endwhile; ?>		

	<?php else : ?>
		<?php get_template_part( 'content', 'none' ); ?>
	<?php endif; ?>
 
<?php get_footer(); ?>