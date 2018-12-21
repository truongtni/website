<?php
/* 
* rt-theme product taxomony categories
*/
get_header();	
?>

<section id="search-results" >		

	<?php if ( have_posts() ) : 

		while ( have_posts() ) : the_post(); ?>

				<article class="search_result loop" id="post-<?php the_ID(); ?>"> 

					<div class="search-post-title">
						<span class="icon-right-hand"></span> <a href="<?php echo get_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a> 				 
					</div><!-- / end div  .post-title-holder -->

					<?php 
						$the_excerpt = rt_search_highlight( trim( get_search_query() ), get_the_excerpt() );
						echo $the_excerpt;
					?>

				</article>  

		<?php
		endwhile;

		rt_get_pagination( $wp_query );
		wp_reset_query();
		else : ?>

		<?php get_template_part( 'content', 'none' ); ?>
	<?php endif; ?>

</section><!-- / end section #search-results -->  

<?php get_footer(); ?>