<?php
/* 
* rt-theme author bio 
*/
?>
<div class="author-info info_box margin-b40 margin-t40">

	<div class="author-avatar">
		<?php echo get_avatar( get_the_author_meta( 'user_email' ), 80 ); ?>
	</div>
	<div class="author-description">
		<span class="author-title"><?php printf( __( 'About %s', 'rt_theme' ), get_the_author() ); ?></span>
		<div class="author-bio">
			<?php the_author_meta( 'description' ); ?>
		</div>
	</div>
</div>