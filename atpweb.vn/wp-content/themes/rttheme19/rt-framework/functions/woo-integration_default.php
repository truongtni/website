<?php
/**
 * RT-THEME WooCommerce Integration
 *
 * Various Functions and hooks for WC
 *
 * @author 		RT-Themes
 * 
 */

global $woocommerce, $suffix;


//remove default css files
add_filter( 'woocommerce_enqueue_styles', 'remove_default_css_files' );

//remove wc lightbox
add_action( 'wp_enqueue_scripts', 'woo_remove_lightboxes', 99 );

//remove breadcrumb
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

//remove pagination
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 ); 

//remove woo sidebar
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10); 

//remove woo thumbs
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10); 
 
//remove single post titles
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );

//cross selles
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display' );

//upselle
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
add_action( 'woocommerce_after_single_product', 'woocommerce_upsell_display', 15 );

//related products
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
add_action( 'woocommerce_after_single_product', 'woocommerce_output_related_products', 20 );

//pagination
add_action( 'woocommerce_after_shop_loop', 'rt_woocommerce_pagination', 10 );
 
//add custom thumbs
add_action( 'woocommerce_before_shop_loop_item_title', 'rt_woocommerce_template_loop_product_thumbnail', 10);
 
//add to cart
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
add_action( 'rt_product_info_footer', 'woocommerce_template_loop_add_to_cart', 10 );  

//social share
add_action( 'woocommerce_single_product_summary', 'rt_woocommerce_template_single_sharing', 35); 

//related products limit filter
add_filter( 'woocommerce_output_related_products_args', 'rt_woo_related_products_limit' ); 

//define post per page
add_filter('loop_shop_per_page', 'rt_loop_shop_per_page');

//hide woocommerce page title
add_filter('woocommerce_show_page_title', 'rt_woocommerce_show_page_title');

// Cart total items count
add_filter('woocommerce_add_to_cart_fragments', 'cart_total_items');

//Product Search Form
add_filter('get_product_search_form', 'rt_get_product_search_form');

//Custom Loop Item Title
remove_action("woocommerce_shop_loop_item_title", "woocommerce_template_loop_product_title");
remove_action("woocommerce_before_shop_loop_item", "woocommerce_template_loop_product_link_open", 10);
remove_action("woocommerce_after_shop_loop_item", "woocommerce_template_loop_product_link_close", 5);
add_action("woocommerce_shop_loop_item_title", "rt_loop_item_title", 10);


//demo store message
remove_action( 'wp_footer', 'woocommerce_demo_store' );
add_action( 'rt_sub_page_header', 'woocommerce_demo_store', 10 ); 

//WC 3.0 galleries
add_action( 'template_redirect', 'rt_woo_supports' );

if ( ! function_exists( 'rt_woo_supports' ) ) {
	/**
	 * Add WooCommerce Gallery Support - 3.0
	 */
	function rt_woo_supports()
	{


		$disable_zoom = get_theme_mod( RT_THEMESLUG.'_woo_disable_zoom');
		$disable_lightbox = get_theme_mod( RT_THEMESLUG.'_woo_disable_lightbox');


		if( ! $disable_zoom ){
			add_theme_support( 'wc-product-gallery-zoom' );
		} 

		if( ! $disable_lightbox ){
			add_theme_support( 'wc-product-gallery-lightbox' );
		} 


		add_theme_support( 'wc-product-gallery-slider' );
	}
}


if ( ! function_exists( 'rt_loop_item_title' ) ) {
	/**
	 * Custom Loop Item Title
	 * @return output
	 */
	function rt_loop_item_title()
	{
		echo '<h5 class="clean_heading"><a href="'. get_the_permalink() .'">'. get_the_title() .'</a></h5>';
	
	}
}


if ( ! function_exists( 'remove_default_css_files' ) ) {
	/**
	 * Remove default woo css files
	 * @return $enqueue_styles
	 */
	function remove_default_css_files( $enqueue_styles )
	{
		unset( $enqueue_styles['woocommerce-general'] ); // Remove the gloss
		unset( $enqueue_styles['woocommerce-layout'] ); // Remove the layout
		//unset( $enqueue_styles['woocommerce-smallscreen'] ); // Remove the smallscreen optimisation
		return $enqueue_styles;
	}
}

if ( ! function_exists( 'woo_remove_lightboxes' ) ) {
	/**
	 * remove wc lightboxes
	 */
	function woo_remove_lightboxes() {

		// Styles
		wp_dequeue_style( 'woocommerce_prettyPhoto_css' );

		// Scripts
		wp_dequeue_script( 'prettyPhoto' );
		wp_dequeue_script( 'prettyPhoto-init' );
		wp_dequeue_script( 'fancybox' );
		wp_dequeue_script( 'enable-lightbox' );
	}
}  

if ( ! function_exists( 'get_woocommerce_page_title' ) ) {
	/**
	 * woocommerce_page_title function. 
	 *
	 * replace the get_woocommerce_page_title function
	 *
	 * @access public
	 * @return void
	 */
	function get_woocommerce_page_title() {

		if ( is_search() ) {
			$page_title = sprintf( __( 'Search Results: &ldquo;%s&rdquo;', 'woocommerce' ), get_search_query() );

			if ( get_query_var( 'paged' ) )
				$page_title .= sprintf( __( '&nbsp;&ndash; Page %s', 'woocommerce' ), get_query_var( 'paged' ) );

		} elseif ( is_tax() ) {

			$page_title = single_term_title( "", false );

		} elseif ( is_single() ) {

			$page_title = get_the_title();

		} else {

			$shop_page_id = wc_get_page_id( 'shop' );
			$page_title   = get_the_title( $shop_page_id );

		}

	    return apply_filters( 'woocommerce_page_title', $page_title );
	}
}

if ( ! function_exists( 'rt_woocommerce_pagination' ) ) {
	/**
	 * Pagination
	 * @return output rt_get_pagination()
	 */
	function rt_woocommerce_pagination(){
		global $wp_query;
		 
		if( $wp_query->max_num_pages > 1 ){
			rt_get_pagination( $wp_query );
		}
	}
}

if ( ! function_exists( 'rt_woocommerce_template_loop_product_thumbnail' ) ) {
	/**
	 * Product Thumbnail
	 *
	 * @return output 
	 */
	function rt_woocommerce_template_loop_product_thumbnail() {
		global $post, $woocommerce, $woo_product_layout, $rt_title, $product;
	 	
		$featured_image_id = ( has_post_thumbnail( $post->ID ) ) ? get_post_thumbnail_id( $post->ID ) : "";
		$featured_resize = get_theme_mod( RT_THEMESLUG.'_woo_image_resize');
		$featured_image_max_width = get_theme_mod( RT_THEMESLUG.'_woo_image_width');
		$featured_image_max_height = get_theme_mod( RT_THEMESLUG.'_woo_image_height');
		$featured_image_crop = get_theme_mod( RT_THEMESLUG.'_woo_image_crop');


		if( $featured_resize ){
			// thumbnail min width
			$w = ! empty( $featured_image_max_width ) ? $featured_image_max_width : rt_get_min_resize_size( $woo_product_layout );

			// thumbnail max height
			$h = ! empty( $featured_image_max_height ) ? $featured_image_max_height : 10000;

			//thumbnail output
			$thumbnail_image_output = ! empty( $featured_image_id ) ? get_resized_image_output( array( "image_url" => "", "image_id" => $featured_image_id, "w" => $w, "h" => $h, "crop" => $featured_image_crop ) ) : ""; 	

		}else{
			//thumbnail output
			$thumbnail_image_output = ! empty( $featured_image_id ) ? rt_get_image_output( array( "image_url" => "", "image_id" => $featured_image_id ) ) : ""; 						
		}


		if( ! empty( $thumbnail_image_output ) ) { 
			echo '<div class="featured_image">';
			echo '<a href="'.get_permalink().'" class="imgeffect link">'.$thumbnail_image_output.'</a>';
			echo '</div>';
		}


	}
}

if ( ! function_exists( 'rt_loop_shop_per_page' ) ) {
	/**
	 * Product Per Page
	 * Number of products displayed per page
	 * @return numberic woo_product_list_pager
	 */
	function rt_loop_shop_per_page() {
		$woo_product_list_pager = get_theme_mod(RT_THEMESLUG."_woo_list_pager");
		if($woo_product_list_pager!="" && is_numeric($woo_product_list_pager) ) {
			return  $woo_product_list_pager;
		}
	}
}

if ( ! function_exists( 'rt_woocommerce_show_page_title' ) ) {
	/**
	 * Remove WooCommerce show page title
	 * @return false
	 */
	function rt_woocommerce_show_page_title() {
		return false;
	}
}

if ( ! function_exists( 'rt_woo_related_products_limit' ) ) {
	/**
	 * WooCommerce Related Products Count
	 * --------------------------
	 *
	 * Change number of related products on product page
	 * Set your own value for 'posts_per_page'
	 *
	 */
	function rt_woo_related_products_limit() {
		global $product;
		$args['posts_per_page'] = 6;
		return $args;
	}
}

if ( ! function_exists( 'rt_woocommerce_template_single_sharing' ) ) {
	/**
	 * Add RT Social Share buttons to single product page
	 * @return output
	 */
	function rt_woocommerce_template_single_sharing() {
		global $layout;
		if ( $layout["share_buttons"] ){
			echo do_shortcode( apply_filters("rt_social_share_shortcode","[rt_social_media_share]") );	
		}
	}
}

if ( ! function_exists( 'cart_total_items' ) ) {
	/**
	 * Cart total items count
	 * @param  array $fragments
	 * @return html
	 */
	function cart_total_items( $fragments ) {
		global $woocommerce;
		ob_start(); 
		?>	
			<sub class="number <?php echo $woocommerce->cart->cart_contents_count == 0 ? "empty" : "";?>"><?php echo $woocommerce->cart->cart_contents_count;?></sub>
		<?php
		$fragments['#tools .cart .number'] = ob_get_clean();
		return $fragments;
	}
}

if ( ! function_exists( 'woocommerce_taxonomy_archive_description' ) ){
	/**
	 * Product Search Form
	 *
	 * Adds extra class name to the product search form
	 * @return [type] [description]
	 */
	function rt_get_product_search_form() {
		$form = '<form role="search" method="get" id="searchform" class="rt_form" action="' . esc_url( home_url( '/'  ) ) . '">
			<div>
				<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . __( 'Search for products', 'woocommerce' ) . '" />
				<input type="hidden" name="post_type" value="product" />
			</div>
		</form>';
		return $form;
	} 
}

if ( ! function_exists( 'woocommerce_taxonomy_archive_description' ) ) {

	/**
	 * Owerwrite orgnigal woocommerce archive descriptions
	 * Show an archive description on taxonomy archives
	 *
	 * @access public
	 * @subpackage	Archives
	 * @return void
	 */
	function woocommerce_taxonomy_archive_description() {
		if ( is_tax( array( 'product_cat', 'product_tag' ) ) && get_query_var( 'paged' ) == 0 ) {
			$description = apply_filters( 'the_content', term_description() );
			if ( $description ) {
				echo '<div class="term-description">' . $description . '</div>';
				echo '<hr class="style-four" />';
			}
		}
	}
}


if ( ! function_exists( 'rtframework_woo_image_style' ) ) {

	/**
	 * Owerwrite product-image.php depending the gallery style
	 *
	 * @return string $located
	 */
	function rtframework_woo_image_style($located, $template_name, $args, $template_path, $default_path){
		$rt_woo_image_style = get_theme_mod(RT_THEMESLUG."_woo_image_style");
	 	
		if( $template_name == "single-product/product-image.php" && $rt_woo_image_style == "theme" ){
			$template_name = "single-product/deprecated-product-image.php";
			$located = wc_locate_template( $template_name, $template_path, $default_path );
		}
		
		return $located;

	}
}

add_filter("wc_get_template","rtframework_woo_image_style",10,5);

?>