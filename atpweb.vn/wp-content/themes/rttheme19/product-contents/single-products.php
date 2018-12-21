<?php
/**
 * 
 * The template for displaying all single product posts
 *
 */
get_header(); ?>

	<?php if (have_posts()) : the_post(); ?> 

			<?php if ( ! post_password_required( get_the_ID() ) ) : ?> 

				<?php get_template_part( '/product-contents/single-products', 'content' ); ?>

			<?php else : ?>
				<?php the_content(); ?>
			<?php endif; ?>		
		
	<?php else : ?>
		<?php get_template_part( 'content', 'none' ); ?>
	<?php endif; ?>			 
 

<?php get_footer(); ?>