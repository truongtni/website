<?php

if( ! function_exists("rt_product_shortcode") ){
	/**
	 * Product Posts	
	 * @param  array $atts 
	 * @param  string $content
	 * @return output
	 */
	function rt_product_shortcode( $atts = array(), $content = null ) { 

		ob_start();	
		do_action( "rt_product_post_loop", array(), $atts); //hooked in theme_functions.php 
		$output_string = ob_get_contents();
		ob_end_clean(); 

		return $output_string;		
	}
}

add_shortcode('product_box', 'rt_product_shortcode'); 