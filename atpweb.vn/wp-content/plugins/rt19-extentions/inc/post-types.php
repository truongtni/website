<?php
/**
 * RT-Theme Custom Posts
 * 
 * Create custom posts
 *
 * @author 	RT-Themes
 * @since   1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'RT_Custom_Posts' ) ) {

	/**
	 * RT_Custom_Posts Class
	 */
	class RT_Custom_Posts{

		/**
		 * Default Slug Names
		 */
		public $default_product_slug; 
		public $default_product_categories_slug;
		public $default_portfolio_slug; 
		public $default_portfolio_categories_slug;
		public $default_testimonial_categories_slug;
		public $default_team_slug; 

		/**
		 * Construct
		 */
		public function __construct() {

			add_action( 'init', array(&$this,'portfolio'), 10);
			add_action( 'init', array(&$this,'products'), 10);			
			add_action( 'init', array(&$this,'team'), 10);
			add_action( 'init', array(&$this,'testimonials'), 10);


			add_action( 'init', array(&$this,'is_product_showcase_active'), 10);
			add_action( 'init', array(&$this,'is_portfolio_active'), 10);
			add_action( 'init', array(&$this,'is_team_active'), 10);
			add_action( 'init', array(&$this,'is_testimonials_active'), 10);

			add_action( 'edited_product_categories', array(&$this,'save_taxonomy_custom_meta'), 10, 2 );  
			add_action( 'create_product_categories', array(&$this,'save_taxonomy_custom_meta'), 10, 2 ); 

			add_action( 'product_categories_add_form_fields', array(&$this,'rt_taxonomy_add_new_meta_field'), 10, 2 );
			add_action( 'product_categories_edit_form_fields', array(&$this,'rt_taxonomy_edit_meta_field'), 10, 2 );

			if( is_admin()){

				if ( class_exists( 'Woocommerce' ) ) {
					add_action('admin_init', array(&$this,'check_woo_permalink_conflicts')); 
				}

				add_filter('admin_init', array(&$this,'permalink_settings'), 10); 	
				add_filter('admin_init', array(&$this,'save_permalink_settings'), 10); 	

				add_filter('manage_portfolio_posts_columns', array(&$this,'ui_columns_head'), 10); 	
				add_filter('manage_products_posts_columns', array(&$this,'ui_columns_head'), 10); 	
				add_filter('manage_staff_posts_columns', array(&$this,'ui_columns_head'), 10); 	 
				add_filter('manage_testimonial_posts_columns', array(&$this,'ui_columns_head'), 10); 	 

				add_action('manage_portfolio_posts_custom_column', array(&$this,'ui_columns_content'), 10, 2);
				add_action('manage_products_posts_custom_column', array(&$this,'ui_columns_content'), 10, 2);
				add_action('manage_staff_posts_custom_column', array(&$this,'ui_columns_content'), 10, 2);
				add_action('manage_testimonial_posts_custom_column', array(&$this,'ui_columns_content'), 10, 2);

			}

		}


		/**
		 * Portfolio
		 */
		function portfolio(){
			
			if( ! $this->is_portfolio_active() ){
				return ;
			}

			// Default Slug Names			
			$this->default_portfolio_slug              = _x( "project-details", 'URL slug', 'rt_theme' );  // singular portfolio item
			$this->default_portfolio_categories_slug   = _x( "portfolio", 'URL slug', 'rt_theme' );		// portfolio categories 			

			// Slug Names			
			$portfolio_slug              = get_option(RT_EXTENSIONS_SLUG."_portfolio_single_slug"); 		// singular portfolio item
			$portfolio_categories_slug   = get_option(RT_EXTENSIONS_SLUG."_portfolio_category_slug");		// portfolio categories 
			

			//Labels
			$labels = array(
				'name'               => __('Portfolio', 'rt_theme_admin'),
				'singular_name'      => __('Portfolio', 'rt_theme_admin'),
				'add_new'            => __('Add New', 'rt_theme_admin'),
				'add_new_item'       => __('Add New portfolio item', 'rt_theme_admin'),
				'edit_item'          => __('Edit Portfolio Item', 'rt_theme_admin'),
				'new_item'           => __('New Portfolio Item', 'rt_theme_admin'),
				'view_item'          => __('View Portfolio Item', 'rt_theme_admin'),
				'search_items'       => __('Search Portfolio Item', 'rt_theme_admin'),
				'not_found'          => __('No portfolio item found', 'rt_theme_admin'),
				'not_found_in_trash' => __('No portfolio item found in Trash', 'rt_theme_admin'), 
				'parent_item_colon'  => ''
			);
			
			//Args
			$args = array(
				'labels'              => $labels,
				'public'              => true,
				'publicly_queryable'  => true,
				'exclude_from_search' => false,
				'show_ui'             => true, 
				'query_var'           => true,
				'can_export'          => true,
				'show_in_nav_menus'   => true,		
				'capability_type'     => 'post',
				'hierarchical'        => false, 
				'menu_position'       => null, 
				'rewrite'             => array( 'slug' => ! empty($portfolio_slug) ? $portfolio_slug : $this->default_portfolio_slug, 'with_front' => true, 'pages' => true, 'feeds'=>false ), 
				'menu_icon'           => "dashicons-portfolio",
				'supports'            => array('title','editor','author','comments','thumbnail','revisions')
			);
			
			register_post_type('portfolio', apply_filters("portfolio_post_type_args",$args));
			
			// Portfolio Categories
			$labels = array(
				'name'              => __( 'Portfolio Categories', 'rt_theme_admin'),
				'singular_name'     => __( 'Portfolio Category', 'rt_theme_admin'),
				'search_items'      => __( 'Search Portfolio Category', 'rt_theme_admin'),
				'all_items'         => __( 'All Portfolio Categories', 'rt_theme_admin'),
				'parent_item'       => __( 'Parent Portfolio Category', 'rt_theme_admin'),
				'parent_item_colon' => __( 'Parent Portfolio Category:', 'rt_theme_admin'),
				'edit_item'         => __( 'Edit Portfolio Category', 'rt_theme_admin'), 
				'update_item'       => __( 'Update Portfolio Category', 'rt_theme_admin'),
				'add_new_item'      => __( 'Add New Portfolio Category', 'rt_theme_admin'),
				'new_item_name'     => __( 'New Portfolio Category', 'rt_theme_admin'),
			); 	
			
			register_taxonomy('portfolio_categories',array('portfolio'), apply_filters("portfolio_tax_args",array(
				'hierarchical'      => true,
				'labels'            => $labels,
				'show_ui'           => true,
				'query_var'         => false,
				'show_admin_column' => true,
				'_builtin'          => false,
				'paged'             => true,
				'rewrite'           => array('slug'=> ! empty($portfolio_categories_slug) ? $portfolio_categories_slug : $this->default_portfolio_categories_slug ,'with_front'=>false),
			)));
		}	

		/**
		 * Products
		 */
		function products(){

			if( ! $this->is_product_showcase_active() ){
				return ;
			}

			// Default Slug Names			
			$this->default_product_slug              = _x( "product-details", 'URL slug', 'rt_theme' ); 		// singular product item
			$this->default_product_categories_slug   = _x( "products", 'URL slug', 'rt_theme' );		// product categories 			

			// Slug Names			
			$product_slug              = get_option(RT_EXTENSIONS_SLUG."_product_single_slug"); 		// singular product item
			$product_categories_slug   = get_option(RT_EXTENSIONS_SLUG."_product_category_slug");		// product categories 

			//Labels
			$labels = array(
				'name'               => __('Product Showcase', 'rt_theme_admin'),
				'singular_name'      => __('Product', 'rt_theme_admin'),
				'add_new'            => __('Add New',  'rt_theme_admin'),
				'add_new_item'       => __('Add New Product Item', 'rt_theme_admin'),
				'edit_item'          => __('Edit Product Item', 'rt_theme_admin'),
				'new_item'           => __('New Product Item', 'rt_theme_admin'),
				'view_item'          => __('View Product Item', 'rt_theme_admin'),
				'search_items'       => __('Search Product Item', 'rt_theme_admin'),
				'not_found'          => __('No Product Item found', 'rt_theme_admin'),
				'not_found_in_trash' => __('No product item found in trash', 'rt_theme_admin'), 
				'parent_item_colon'  => ''
			);

			//Args 
			$args = array(
				'labels'              => $labels,
				'public'              => true,
				'publicly_queryable'  => true,
				'exclude_from_search' => false,
				'show_ui'             => true, 
				'query_var'           => true,
				'can_export'          => true,
				'show_in_nav_menus'   => true,		
				'capability_type'     => 'post',
				'menu_position'       => null, 
				'hierarchical'        => false,  
				'rewrite'             => array( 'slug' => ! empty($product_slug) ? $product_slug : $this->default_product_slug, 'with_front' => true, 'pages' => true, 'feeds'=>false ), 
				'menu_icon'           => "dashicons-store",
				'supports'            => array('title','editor','author','comments','thumbnail','revisions')
			);
			
			register_post_type('products', apply_filters("products_post_type_args",$args));
			
			// Product Categories
			$labels = array(
				'name'              => __( 'Product Categories', 'rt_theme_admin'),
				'singular_name'     => __( 'Product Category', 'rt_theme_admin'),
				'search_items'      => __( 'Search Product Category' , 'rt_theme_admin'),
				'all_items'         => __( 'All Product Categories' , 'rt_theme_admin'),
				'parent_item'       => __( 'Parent Product Category' , 'rt_theme_admin'),
				'parent_item_colon' => __( 'Parent Product Category:' , 'rt_theme_admin'),
				'edit_item'         => __( 'Edit Product Category' , 'rt_theme_admin'), 
				'update_item'       => __( 'Update Product Category' , 'rt_theme_admin'),
				'add_new_item'      => __( 'Add New Product Category' , 'rt_theme_admin'),
				'new_item_name'     => __( 'New Product Category' , 'rt_theme_admin'),
			); 	
			

			register_taxonomy('product_categories',array('products'), apply_filters("products_tax_args",array(
				'hierarchical'      => true,
				'labels'            => $labels,
				'show_ui'           => true,
				'query_var'         => false,
				'show_admin_column' => true,
				'_builtin'          => false,
				'paged'             => true,
				'rewrite'           => array('slug'=> ! empty($product_categories_slug) ? $product_categories_slug : $this->default_product_categories_slug ,'with_front'=>false),
			)));
		
		}	 

		/**
		 * Team
		 */
		function team(){

			if( ! $this->is_team_active() ){
				return ;
			}

			// Default Slug Names			
			$this->default_team_slug  = _x( "team", 'URL slug', 'rt_theme' );  

			// Slug Names			
			$team_slug              = get_option(RT_EXTENSIONS_SLUG."_team_single_slug"); 

			//Labels
			$labels = array(
				'menu_name'          => __('Team', 'rt_theme_admin'),
				'name'               => __('Team', 'rt_theme_admin'),
				'singular_name'      => __('Team', 'rt_theme_admin'),
				'add_new'            => __('Add New Member', 'rt_theme_admin'),
				'add_new_item'       => __('Add New Member', 'rt_theme_admin'),
				'edit_item'          => __('Edit Member', 'rt_theme_admin'),
				'new_item'           => __('New Member', 'rt_theme_admin'),
				'view_item'          => __('View Member', 'rt_theme_admin'),
				'search_items'       => __('Search for Member', 'rt_theme_admin'),
				'not_found'          => __('No member found', 'rt_theme_admin'),
				'not_found_in_trash' => __('No member found in Trash', 'rt_theme_admin'), 
				'parent_item_colon'  => ''
			);
			
			//Args
			$args = array(
				'labels'              => $labels,
				'public'              => true,
				'publicly_queryable'  => true,
				'exclude_from_search' => true,
				'show_ui'             => true, 
				'query_var'           => false,
				'can_export'          => true,
				'show_in_nav_menus'   => false,		
				'capability_type'     => 'post',
				'menu_position'       => null, 
				'rewrite'             => array( 'slug' => ! empty($team_slug) ? $team_slug : $this->default_team_slug, 'with_front' => true, 'pages' => true, 'feeds'=>false ), 
				'menu_icon'           => "dashicons-groups",
				'supports'            => array('title','editor','thumbnail','revisions')
			);
			
			register_post_type('staff', apply_filters("team_post_type_args",$args));
		 
		}	 				 

		/**
		 * Testimonials
		 */
		function testimonials(){

			if( ! $this->is_testimonials_active() ){
				return ;
			}

			// Default Slug Names			
			$this->default_testimonial_categories_slug   = _x( "testimonials", 'URL slug', 'rt_theme' );		// testimonial categories 			

			// Slug Names			
			$testimonial_categories_slug   = get_option(RT_EXTENSIONS_SLUG."_testimonial_category_slug");		// testimonial categories 
			

			//Labels
			$labels = array(
				'menu_name'          => __('Testimonials', 'rt_theme_admin'),
				'name'               => __('Testimonials', 'rt_theme_admin'),
				'singular_name'      => __('Testimonial', 'rt_theme_admin'),
				'add_new'            => __('Add New', 'rt_theme_admin'),
				'add_new_item'       => __('Add New Testimonial', 'rt_theme_admin'),
				'edit_item'          => __('Edit Testimonial', 'rt_theme_admin'),
				'new_item'           => __('New Testimonial', 'rt_theme_admin'),
				'view_item'          => __('View Testimonial', 'rt_theme_admin'),
				'search_items'       => __('Search Testimonial', 'rt_theme_admin'),
				'not_found'          => __('No testimonial found', 'rt_theme_admin'),
				'not_found_in_trash' => __('No testimonial found in Trash', 'rt_theme_admin'), 
				'parent_item_colon'  => ''
			);
			
			//Args
			$args = array(
				'labels'              => $labels,
				'public'              => false,
				'publicly_queryable'  => true,
				'exclude_from_search' => true,
				'show_ui'             => true, 
				'query_var'           => true,
				'can_export'          => true,
				'hierarchical'        => false,
				'show_in_nav_menus'   => false,		
				'capability_type'     => 'post',
				'menu_position'       => null, 
				'menu_icon'           => "dashicons-format-quote",
				'supports'            => array('title','thumbnail','revisions')
			);


			register_post_type('testimonial', apply_filters("testimonial_post_type_args",$args));

			// Testimonial Categories
			$labels = array(
				'name'              => __( 'Testimonial Categories', 'rt_theme_admin'),
				'singular_name'     => __( 'Testimonial Category', 'rt_theme_admin'),
				'search_items'      => __( 'Search Testimonial Category' , 'rt_theme_admin'),
				'all_items'         => __( 'All Testimonial Categories' , 'rt_theme_admin'),
				'parent_item'       => __( 'Parent Testimonial Category' , 'rt_theme_admin'),
				'parent_item_colon' => __( 'Parent Testimonial Category:' , 'rt_theme_admin'),
				'edit_item'         => __( 'Edit Testimonial Category' , 'rt_theme_admin'), 
				'update_item'       => __( 'Update Testimonial Category' , 'rt_theme_admin'),
				'add_new_item'      => __( 'Add New Testimonial Category' , 'rt_theme_admin'),
				'new_item_name'     => __( 'New Testimonial Category' , 'rt_theme_admin'),
			); 	
			

			register_taxonomy('testimonial_categories',array('testimonial'), apply_filters("testimonial_tax_args",array(
				'hierarchical'      => true,
				'labels'            => $labels,
				'show_ui'           => true,
				'query_var'         => false,
				'show_in_nav_menus' => false,
				'show_admin_column' => true,
				'_builtin'          => false,
				'paged'             => true,
				'rewrite'           => array('slug'=> ! empty($testimonial_categories_slug) ? $testimonial_categories_slug : $this->default_testimonial_categories_slug ,'with_front'=>false),
			)));

		}		

		/**
		 * Is Product Showcase Active
		 * @return boolean
		 */
		public static function is_product_showcase_active( ){
			return apply_filters("product_showcase_active",true);
		}

		/**
		 * Is Portfolio Active
		 * @return boolean
		 */
		public static function is_portfolio_active( ){
			return apply_filters("portfolio_active",true);
		}

		/**
		 * Is Team Active
		 * @return boolean
		 */
		public static function is_team_active( ){
			return apply_filters("team_active",true);
		}

		/**
		 * Is Testimonials Active
		 * @return boolean
		 */
		public static function is_testimonials_active( ){
			return apply_filters("testimonials_active",true);
		}


		/**
		 * UI Columns - ID
		 * @param  array $defaults  
		 * @return $defaults
		 */
		function ui_columns_head($defaults) { 
			$defaults['rt-id-column'] = 'ID';
			return $defaults;
		}

		/**
		 * UI Columns - Content
		 * @param  string $column_name 
		 * @param  string $post_ID 
		 * @return $post_ID
		 */
		function ui_columns_content($column_name, $post_ID) { 
			echo $post_ID;
		}


		/**
		 * Permalink Settings
		 */
		public function permalink_settings() {
			
			if( ! $this->is_product_showcase_active() && ! $this->is_portfolio_active() && ! $this->is_team_active() ){
				return ;
			}

			add_settings_section( 'rttheme-custom-permalinks', __( 'Custom Post Base Paths', 'rt_theme_admin' ), array( $this, 'custom_permalinks_section' ), 'permalink' );

			// products
			if( $this->is_product_showcase_active() ){
				
				add_settings_field(
					'rttheme_products_category_slug',
					__( 'Product showcase category base', 'rt_theme_admin' ),
					array( $this, 'rttheme_products_category_slug_input' ),
					'permalink',
					'rttheme-custom-permalinks'
				);

				add_settings_field(
					'rttheme_products_single_page_slug',
					__( 'Product showcase single page base', 'rt_theme_admin' ),
					array( $this, 'rttheme_products_single_page_slug_input' ),
					'permalink',
					'rttheme-custom-permalinks'
				);

			}

			// portfolio
			if( $this->is_portfolio_active() ){
				add_settings_field(
					'rttheme_portfolio_category_slug',
					__( 'Portfolio category base', 'rt_theme_admin' ),
					array( $this, 'rttheme_portfolio_category_slug_input' ),
					'permalink',
					'rttheme-custom-permalinks'
				);

				add_settings_field(
					'rttheme_portfolio_single_page_slug',
					__( 'Portfolio single page base', 'rt_theme_admin' ),
					array( $this, 'rttheme_portfolio_single_page_slug_input' ),
					'permalink',
					'rttheme-custom-permalinks'
				);
			}

			// team
			if( $this->is_team_active() ){
				add_settings_field(
					'rttheme_team_single_page_slug',
					__( 'Team single page base', 'rt_theme_admin' ),
					array( $this, 'rttheme_team_single_page_slug_input' ),
					'permalink',
					'rttheme-custom-permalinks'
				);
			}

			// testimonail categories
			if( $this->is_testimonials_active() ){
				add_settings_field(
					'rttheme_testimonial_category_slug',
					__( 'Testimonials category base', 'rt_theme_admin' ),
					array( $this, 'rttheme_testimonial_category_slug_input' ),
					'permalink',
					'rttheme-custom-permalinks'
				);
			}

		}

		/**
		 * Custom Permalinks Section
		 */
		public function custom_permalinks_section() {
			echo wpautop( __( 'These settings control the permalinks used for Product Showcase, Portfolio and Team custom post types.', 'rt_theme_admin' ) );
		}

		/**
		 * Product category base input
		 * @return html
		 */
		public function rttheme_products_category_slug_input() {
			$base = esc_attr(get_option( RT_EXTENSIONS_SLUG."_product_category_slug" ));
			?>
				<input name="rttheme_products_category_slug" type="text" class="regular-text code" value="<?php echo $base;?>" placeholder="<?php echo $this->default_product_categories_slug; ?>" />
			<?php
		}

		/**
		 * Product single page base input
		 * @return html
		 */
		public function rttheme_products_single_page_slug_input() {
			$base = esc_attr(get_option( RT_EXTENSIONS_SLUG."_product_single_slug" ));
			?>
				<input name="rttheme_products_single_page_slug" type="text" class="regular-text code" value="<?php echo $base;?>" placeholder="<?php echo $this->default_product_slug; ?>" />
			<?php
		}


		/**
		 * Portfolio category base input
		 * @return html
		 */
		public function rttheme_portfolio_category_slug_input() {
			$base = esc_attr(get_option( RT_EXTENSIONS_SLUG."_portfolio_category_slug" ));
			?>
				<input name="rttheme_portfolio_category_slug" type="text" class="regular-text code" value="<?php echo $base;?>" placeholder="<?php echo $this->default_portfolio_categories_slug; ?>" />
			<?php
		}

		/**
		 * Portfolio single page base input
		 * @return html
		 */
		public function rttheme_portfolio_single_page_slug_input() {
			$base = esc_attr(get_option( RT_EXTENSIONS_SLUG."_portfolio_single_slug" ));
			?>
				<input name="rttheme_portfolio_single_page_slug" type="text" class="regular-text code" value="<?php echo $base;?>" placeholder="<?php echo $this->default_portfolio_slug; ?>" />
			<?php
		}

		/**
		 * Team single page base input
		 * @return html
		 */
		public function rttheme_team_single_page_slug_input() {
			$base = esc_attr(get_option( RT_EXTENSIONS_SLUG."_team_single_slug" ));
			?>
				<input name="rttheme_team_single_page_slug" type="text" class="regular-text code" value="<?php echo $base;?>" placeholder="<?php echo $this->default_team_slug; ?>" />
			<?php
		}

		/**
		 * Testimonial category base input
		 * @return html
		 */
		public function rttheme_testimonial_category_slug_input() {
			$base = esc_attr(get_option( RT_EXTENSIONS_SLUG."_testimonial_category_slug" ));
			?>
				<input name="rttheme_testimonial_category_slug" type="text" class="regular-text code" value="<?php echo $base;?>" placeholder="<?php echo $this->default_testimonial_categories_slug; ?>" />
			<?php
		}		

		/**
		 * Save permalink settings
		 */
		public function save_permalink_settings() {
			if ( ! current_user_can( "edit_theme_options" ) ){
				return;
			}

			if ( isset( $_POST['rttheme_products_category_slug'] ) ) {
				update_option( RT_EXTENSIONS_SLUG."_product_category_slug", esc_attr($_POST['rttheme_products_category_slug']) );
			}

			if ( isset( $_POST['rttheme_products_single_page_slug'] ) ) {
				update_option( RT_EXTENSIONS_SLUG."_product_single_slug", esc_attr($_POST['rttheme_products_single_page_slug']) );
			}

			if ( isset( $_POST['rttheme_portfolio_category_slug'] ) ) {
				update_option( RT_EXTENSIONS_SLUG."_portfolio_category_slug", esc_attr($_POST['rttheme_portfolio_category_slug']) );
			}

			if ( isset( $_POST['rttheme_portfolio_single_page_slug'] ) ) {
				update_option( RT_EXTENSIONS_SLUG."_portfolio_single_slug", esc_attr($_POST['rttheme_portfolio_single_page_slug']) );
			}

			if ( isset( $_POST['rttheme_team_single_page_slug'] ) ) {
				update_option( RT_EXTENSIONS_SLUG."_team_single_slug", esc_attr($_POST['rttheme_team_single_page_slug']) );
			}

			if ( isset( $_POST['rttheme_testimonial_category_slug'] ) ) {
				update_option( RT_EXTENSIONS_SLUG."_testimonial_category_slug", esc_attr($_POST['rttheme_testimonial_category_slug']) );
			}			
		}


		/**
		 * Check Possible WooCommerce Slug Conflict
		 */
		function check_woo_permalink_conflicts(){

			//Slugnames
			$rt_theme_product_slug =  esc_attr(get_option( RT_EXTENSIONS_SLUG."_product_single_slug" ));
			$rt_theme_product_category_slug =  esc_attr(get_option( RT_EXTENSIONS_SLUG."_product_category_slug" ));
			$rt_theme_product_slug =  ! empty($rt_theme_product_slug) ? $rt_theme_product_slug : $this->default_product_slug;
			$rt_theme_product_category_slug =  ! empty($rt_theme_product_category_slug) ? $rt_theme_product_category_slug : $this->default_product_categories_slug;

			$woocommerce_permalinks = get_option( 'woocommerce_permalinks' );
			$woo_product_slug = is_array($woocommerce_permalinks) && isset( $woocommerce_permalinks["product_base"] ) && ! empty( $woocommerce_permalinks["product_base"] ) ? str_replace("/","",$woocommerce_permalinks["product_base"]) : "product";
			$woo_category_slug =  is_array($woocommerce_permalinks) && isset( $woocommerce_permalinks["category_base"] ) && ! empty( $woocommerce_permalinks["category_base"] ) ? str_replace("/","",$woocommerce_permalinks["category_base"]) : "product-category";

			//check woocommerce product slugname with rt-theme product slugname 
			if(	( $rt_theme_product_slug == $woo_product_slug ) ||  ( empty($woo_product_slug) && $rt_theme_product_slug == "product" ) ) {
				add_action('admin_notices', array(&$this,'woo_product_base_notice'));
			}
		 
			//check woocommerce category slugname with rt-theme category slugname 
			if(	( $rt_theme_product_category_slug == $woo_category_slug ) || ( empty($woo_category_slug) && $rt_theme_product_category_slug == "product-category" ) ) {
				add_action('admin_notices', array(&$this,'woo_category_base_notice'));
			}
		}
	
		/**
		 * Conflict Notice For WooCommerce Product Slug
		 * @return html
		 */
		function woo_product_base_notice(){ 
			echo '<div class="error"> 
					<p>
					<br />
					<H3>ERROR : Slugname conflict resulting in a 404 on Woocommerce product categories</H3><br />
					Two custom post types are using the same slugname which are WooCommerce and '.RT_THEMENAME.' Product Showcase. <br />
					<br />
					Go to Settings->Permalinks and change the "Product showcase single page base" or "Custom Base" under "Product permalink base" section to another one.
					</p>
				</div>';
		}

		/**
		 * Conflict Notice For WooCommerce Product Categories Slug
		 * @return html
		 */
		function woo_category_base_notice(){ 		
			echo '<div class="error"> 
					<p>
					<br />
					<H3>ERROR : Slugname conflict resulting in a 404 on Woocommerce product categories</H3><br />
					Two custom post types are using the same slugname which are WooCommerce and '.RT_THEMENAME.' Product Showcase. <br />
					<br />
					Go to Settings->Permalinks and change the "Product showcase category base" or "Product category base" to another one. 
					</p>
				</div>';
		}



		/**
		 * Add upload image field to product categories
		 * @return html
		 */
		function rt_taxonomy_add_new_meta_field() {
			?>
			<div class="form-field rt-category-image">
				<label for="rt_product_category_image"><?php _e( 'Category Thumbnail','rt_theme_admin'); ?></label>

				<div class="upload">
					<input name="term_meta[product_category_image]" id="rt_product_category_image" class="upload_field" type="hidden" data-customize-setting-link="rt_product_category_image" autocomplete="off">
					<button class="button icon-upload rttheme_image_upload_button" type="button" data-inputid="rt_product_category_image"><?php _e('Upload','rt_theme_admin'); ?></button>
				</div>

				<div class="uploaded_file taxonomy" data-holderid="rt_product_category_image">
					<img class="loadit" data-image="rt_product_category_image" src="">
					<span class="icon-cancel delete_single" data-inputid="rt_product_category_image" title="<?php _e("remove image","rt_theme_admin"); ?>"></span>
				</div>
			</div>
		<?php
		} 
		
		/**
		 * Edit upload image field to product categories
		 * @return html
		 */
		function rt_taxonomy_edit_meta_field($term) {
		 
			// put the term ID into a variable
			$t_id = $term->term_id;
		 
			// retrieve the existing value(s) for this meta field. This returns an array
			$term_meta = get_option( "taxonomy_$t_id" ); ?>
			<tr class="form-field rt-category-image">
			<th scope="row" valign="top"><label for="term_meta[custom_term_meta]"><?php _e( 'Category Thumbnail', 'rt_theme_admin' ); ?></label></th>
				<td>

					<?php 
						//get the attachment image
						$cat_image_id = esc_attr( $term_meta['product_category_image'] ) ? esc_attr( $term_meta['product_category_image'] ) : "";
					?>
					<div class="upload">
						<input name="term_meta[product_category_image]" id="rt_product_category_image" class="upload_field" type="hidden" data-customize-setting-link="rt_product_category_image" autocomplete="off" value="<?php echo $cat_image_id ?>">
						<button class="button icon-upload rttheme_image_upload_button" type="button" data-inputid="rt_product_category_image"><?php _e('Upload','rt_theme_admin'); ?></button>
					</div>

					<?php
						$cat_image_url = "";
						
						if( $cat_image_id ){
							$get_cat_image = wp_get_attachment_image_src( $cat_image_id, "thumbnail" );
							$cat_image_url = is_array( $get_cat_image ) ? $get_cat_image[0] : "";
						}

						echo ! empty( $cat_image_url ) ? '<div class="uploaded_file visible taxonomy" data-holderid="rt_product_category_image">' : '<div class="uploaded_file taxonomy" data-holderid="rt_product_category_image">' ;
						echo '<img class="loadit" data-image="rt_product_category_image" src="'.$cat_image_url.'">';
						echo '<span class="icon-cancel delete_single" data-inputid="rt_product_category_image" title="'. __("remove image","rt_theme_admin") .'"></span>';
						echo '</div>';
					
					?>
				</td>
			</tr>


		<?php
		}		

		/**
		 * Save upload image field to product categories
		 * @return void
		 */
		function save_taxonomy_custom_meta( $term_id ) {

			if ( ! current_user_can( "edit_theme_options" ) ){
				return;
			}

			if ( isset( $_POST['term_meta'] ) ) {
				$t_id = $term_id;
				$term_meta = get_option( "taxonomy_$t_id" );
				$cat_keys = array_keys( $_POST['term_meta'] );
				foreach ( $cat_keys as $key ) {
					if ( isset ( $_POST['term_meta'][$key] ) ) {
						$term_meta[$key] = $_POST['term_meta'][$key];
					}
				}
				// Save the option array.
				update_option( "taxonomy_$t_id", $term_meta );
			}
		}  

	}

}

new RT_Custom_Posts();
?>