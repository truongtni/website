<?php
/* 
* rt-theme archive
*/

$term = get_queried_object();
$description = isset($term->description) ? $term->description : ""; 

get_header();
?>

	<?php if( is_author() ){
		get_template_part("author","bio");
	}	 	
	?>					

	<?php 
		if ( have_posts() ){
			do_action( "blog_post_loop", $wp_query, array("layout_style"=>"grid","list_layout"=>"1/2","more"=>1));			
		}else{				
			get_template_part( 'content', 'none' );
		}
	?>


<?php get_footer(); ?>