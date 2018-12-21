<?php
#-----------------------------------------
#	RT-Theme sidebar.php
#	version: 1.0
#-----------------------------------------

#
#	Sidebar Class
#
if ( ! class_exists("RTThemeSidebar")){

	class RTThemeSidebar extends RTTheme{
	 	
		public $rt_sidebars               = array();
		private $rt_user_created_sidebars = array();
		private $rt_disabled_sidebars     = array();
		public $rt_sidebar_descriptions   = array();
		public $rt_active_sidebars        = array(); 

		#
		# Construct
		#	 
		function __construct() {

			//sidebar descriptions	
			$this->rt_sidebar_descriptions = array( 
					"sidebar-for-footer-column-1"    => __("Widget Area : Sidebar for Footer (column 1). Go to the Theme Customizer / Styling Options / Footer and make sure this column is enabled with 'Footer Widgets Layout' option.", 'rt_theme_admin'),
					"sidebar-for-footer-column-2"    => __("Widget Area : Sidebar for Footer (column 2). Go to the Theme Customizer / Styling Options / Footer and make sure this column is enabled with 'Footer Widgets Layout' option.", 'rt_theme_admin'),
					"sidebar-for-footer-column-3"    => __("Widget Area : Sidebar for Footer (column 3). Go to the Theme Customizer / Styling Options / Footer and make sure this column is enabled with 'Footer Widgets Layout' option.", 'rt_theme_admin'),
					"sidebar-for-footer-column-4"    => __("Widget Area : Sidebar for Footer (column 4). Go to the Theme Customizer / Styling Options / Footer and make sure this column is enabled with 'Footer Widgets Layout' option.", 'rt_theme_admin'),
					"common-sidebar"                 => __("Widget Area : Common Sidebar Widget area. Widgets dropped in the Common Sidebar container will show in every page/post.", 'rt_theme_admin'),	
					"sidebar-for-pages"              => __("Widget Area : Sidebar for Pages. Widgets dropped in this container, will show in every page when a sidebar available.", 'rt_theme_admin'),			
					"sidebar-for-topbar-left"        => __("Widget Area for the left side of the top bar. This widget area supports only 'Text', 'Social Media Icons' and 'Custom Menu' widgets and it will be hid in small screens. Do not use the title of the widget.", 'rt_theme_admin'),			
					"sidebar-for-topbar-right"       => __("Widget Area for the right side of the top bar. This widget area supports only 'Text', 'Social Media Icons' and 'Custom Menu' widgets and it will be hid in small screens. Do not use the title of the widget.", 'rt_theme_admin'),								
					"sidebar-for-header-left"        => __("Widget Area for the left side of the header. This widget area supports only 'Text', 'Social Media Icons' and 'Custom Menu' widgets and it will be hid in small screens. Do not use the title of the widget.", 'rt_theme_admin'),			
					"sidebar-for-header-right"       => __("Widget Area for the right side of the header. This widget area supports only 'Text', 'Social Media Icons' and 'Custom Menu' widgets and it will be hid in small screens. Do not use the title of the widget.", 'rt_theme_admin'),																				
					"sidebar-for-side-panel"         => __("Widget Area : Sidebar for Side Panel. Widgets dropped in this container, will show in the side panel when available.", 'rt_theme_admin'),	
					"sidebar-for-portfolio"          => __('Widget Area : Sidebar for Portfolio. Widgets will be displayed in all portfolio categories and single portfolio item pages.' , 'rt_theme_admin'),
					"sidebar-for-portfolios"         => __("Widget Area : Sidebar for Single Portfolio Item. Widgets dropped in this Sidebar container will show in every single portfolio page when the page-layout is set to a sidebar layout.", 'rt_theme_admin'),			
					"sidebar-all-products"           => __('Widget Area : Sidebar for Products. Widgets will be displayed in all product categories and product detail pages.', 'rt_theme_admin'),
					"sidebar-for-product"            => __("Widget Area : Sidebar for Single Product Item. Widgets dropped in this Sidebar container will show in every single product page when the page-layout is set to a sidebar layout.", 'rt_theme_admin'),			
					"sidebar-for-product-categories" => __("Widget Area : Sidebar for Product Categories. Widgets dropped in this Sidebar container will show in every product category page when the page-layout is set to a sidebar layout.", 'rt_theme_admin'),
					"sidebar-for-blog"               => __('Widget Area : Sidebar for Blog. Widgets will be displayed in all blog categories and single post pages.', 'rt_theme_admin'),		
					"sidebar-for-blog-categories"    => __("Widget Area : Sidebar for Blog Categories. Widgets will be displayed in all blog categories.", 'rt_theme_admin'),
					"sidebar-for-single"             => __("Widget Area : Sidebar for Single Post. Widgets will be displayed in all single post pages.", 'rt_theme_admin'),
					"sidebar-for-search"             => __('Widget Area : Sidebar for Search Results', 'rt_theme_admin'),
					"sidebar-for-archive"            => __('Widget Area : Sidebar for Archives', 'rt_theme_admin'),
					"sidebar-for-tags"               => __('Widget Area : Sidebar for Tags', 'rt_theme_admin'),			
					"woo-commerce-contents"          => __('Widget Area : Sidebar for WooCommerce. Widgets dropped in this Sidebar container will show in WooCommerce related pages when the page-layout is set to a sidebar layout.', 'rt_theme_admin'),
			);

			//default sidebars	
			$this->rt_sidebars = array( 
				"sidebar-for-footer-column-1"    => __("Footer (Column 1)", 'rt_theme_admin'),
				"sidebar-for-footer-column-2"    => __("Footer (Column 2)", 'rt_theme_admin'),
				"sidebar-for-footer-column-3"    => __("Footer (Column 3)", 'rt_theme_admin'),
				"sidebar-for-footer-column-4"    => __("Footer (Column 4)", 'rt_theme_admin'),
				"common-sidebar"                 => __("Common Sidebar", 'rt_theme_admin'),	
				"sidebar-for-pages"              => __("Pages", 'rt_theme_admin'),
				"sidebar-for-header-left"        => __("Header (Left)", 'rt_theme_admin'),			
				"sidebar-for-header-right"       => __("Header (Right)", 'rt_theme_admin'),							
				"sidebar-for-topbar-left"        => __("Top Bar (Left)", 'rt_theme_admin'),			
				"sidebar-for-topbar-right"       => __("Top Bar (Right)", 'rt_theme_admin'),			
				"sidebar-for-side-panel"         => __("Side Panel", 'rt_theme_admin'),			
				"sidebar-for-portfolio"          => __("Portfolio", 'rt_theme_admin'),
				"sidebar-for-portfolios"         => __("Single Portfolio Item", 'rt_theme_admin'),	
				"sidebar-all-products"           => __("Products", 'rt_theme_admin'),
				"sidebar-for-product"            => __("Single Product Item", 'rt_theme_admin'),			
				"sidebar-for-product-categories" => __("Product Categories", 'rt_theme_admin'),
				"sidebar-for-blog"               => __("Blog", 'rt_theme_admin'),			
				"sidebar-for-blog-categories"    => __("Blog Categories", 'rt_theme_admin'),
				"sidebar-for-single"             => __("Blog Single Post", 'rt_theme_admin'),
				"sidebar-for-search"             => __("Search Results", 'rt_theme_admin'),
				"woo-commerce-contents"          => __("WooCommerce", 'rt_theme_admin'),
				"sidebar-for-archive"            => __("Archives", 'rt_theme_admin'),
				"sidebar-for-tags"               => __("Tags", 'rt_theme_admin'),
			);



	  		$this->rt_active_sidebars = array_merge_recursive( $this->rt_sidebars, $this->rt_user_created_sidebars );


	  		foreach ($this->rt_active_sidebars as $rt_sidebarID => $sidebarName ) { 
	  			if( ! $this->is_enabled_sidebar($rt_sidebarID) ){  
	  				unset($this->rt_active_sidebars[$rt_sidebarID]);
	  			}
	  		}
	

	 		//Remove WooCommerce Related Sidebars if it has not been installed
			if ( ! class_exists( 'Woocommerce' ) ) {
				unset($this->rt_active_sidebars["woo-commerce-contents"]);
			}

	 		//Remove top bar related sidebars from the layouts that has no top bar option 
	 		global $wp_customize;

			if ( ( get_theme_mod(RT_THEMESLUG.'_layout') == "layout1" || get_theme_mod(RT_THEMESLUG.'_layout') == "layout2" ) && ! isset( $wp_customize) ) {
				unset($this->rt_active_sidebars["sidebar-for-topbar-left"]);
				unset($this->rt_active_sidebars["sidebar-for-topbar-right"]);
				unset($this->rt_active_sidebars["sidebar-for-header-right"]);
			}

			if ( get_theme_mod(RT_THEMESLUG.'_layout') != "layout4" && ! isset( $wp_customize) ) {
				unset($this->rt_active_sidebars["sidebar-for-header-left"]);
			}

	 		//register sidebars
			add_action('widgets_init',array(&$this,'register_sidebars'));

	 		//show widgetes
			add_action('widgets_init',array(&$this,'call_display_sidebars'));
	 	}


		#
		# Register Sidebars
		#
		function register_sidebars(){
			foreach ($this->rt_active_sidebars as $rt_sidebarID => $sidebarName) {  
				$this->register_sidebar($rt_sidebarID,$sidebarName); 
			} 
		}

		#
		# Register Sidebar
		#
		function register_sidebar($rt_sidebarID,$sidebarName){ 
			
				$description = ( isset( $this->rt_sidebar_descriptions[$rt_sidebarID] ) ) ? $this->rt_sidebar_descriptions[$rt_sidebarID] : __('User created sidebar', 'rt_theme_admin'); 
			 
				if(//footer widgets
					$rt_sidebarID=="sidebar-for-footer-column-1" ||
					$rt_sidebarID=="sidebar-for-footer-column-2" ||
					$rt_sidebarID=="sidebar-for-footer-column-3" ||
					$rt_sidebarID=="sidebar-for-footer-column-4" ||
					$rt_sidebarID=="sidebar-for-footer-column-5" 
				){
					register_sidebar(array(
						'id'            => $rt_sidebarID,
						'name'          => $sidebarName,
						'before_widget' => '<div id="%1$s" class="footer_widget widget %2$s">',
						'description'   => $description,
						'after_widget'  => '</div>',
						'before_title'  => '<h5>',
						'after_title'   => '</h5>',
					));							

				}elseif(//header widgets
					$rt_sidebarID=="sidebar-for-header-left" ||
					$rt_sidebarID=="sidebar-for-header-right"
				){
					register_sidebar(array(
						'id'            => $rt_sidebarID,
						'name'          => $sidebarName,
						'before_widget' => '<div id="%1$s" class="header-widget widget %2$s">',
						'description'   => $description,
						'after_widget'  => '</div>',
						'before_title'  => '<h5>',
						'after_title'   => '</h5>',
					));	


				}elseif(//topbar widgets
					$rt_sidebarID=="sidebar-for-topbar-left" ||
					$rt_sidebarID=="sidebar-for-topbar-right"
				){
					register_sidebar(array(
						'id'            => $rt_sidebarID,
						'name'          => $sidebarName,
						'before_widget' => '<div id="%1$s" class="topbar-widget widget %2$s">',
						'description'   => $description,
						'after_widget'  => '</div>',
						'before_title'  => '<h5>',
						'after_title'   => '</h5>',
					));	

				}else{
					register_sidebar(array(
						'id'            => $rt_sidebarID,
						'name'          => $sidebarName,
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'description'   => $description,
						'after_widget'  => '</div>',
						'before_title'  => '<h5>',
						'after_title'   => '</h5>',
					));					
				} 
		} 

		#
		# Display Sidebars
		#
	 	
	 	function call_display_sidebars(){
	 		add_filter('rt_load_widgets',array(&$this,'display_sidebars'));
	 	}

		function display_sidebars(){
			global $post, $rt_global_variables;

			$post_id = isset( $post ) && isset( $post->ID ) ? $post->ID : "" ;
			$post_type = isset( $post->post_type ) ? $post->post_type : "" ; 

			// Get user custom sidebar list
			if(is_singular()){
				$user_custom_sidebar_list = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'_custom_sidebar_locations[]', true );

				if( is_array( $user_custom_sidebar_list )  && ! empty( $user_custom_sidebar_list ) ){

					foreach ($user_custom_sidebar_list as $key => $custom_sidebar_id ) {
						dynamic_sidebar($custom_sidebar_id);
					}

					return;
				}
			}

			// WooCommerce
			if ( class_exists( 'Woocommerce' ) ) {		
				if(is_woocommerce() || is_cart() || is_account_page() || is_checkout() ){ 
					dynamic_sidebar('woo-commerce-contents');
					$WooCommercePage = "TRUE";
				}
			}		 
	 
	 		// Call Search Sidebar
			if( is_search() && $this->is_enabled_sidebar('sidebar-for-search') ){  
				dynamic_sidebar('sidebar-for-search');  
				dynamic_sidebar('common-sidebar');
				return false;
			}   
			
			// Page Sidebar
			if( ! rt_is_theme_page() && ! is_front_page() && is_page() && $this->is_enabled_sidebar('sidebar-for-pages') ){ dynamic_sidebar('sidebar-for-pages'); } 

			// Portfolio Sidebar - all portfolio contents
			if( rt_is_portfolio_page() && $this->is_enabled_sidebar('sidebar-for-portfolio') ) { dynamic_sidebar('sidebar-for-portfolio'); }

			// Portfolio Sidebar - single portfolio item
			if( is_single() && $post_type=='portfolio' && $this->is_enabled_sidebar('sidebar-for-portfolio') ) { dynamic_sidebar('sidebar-for-portfolios'); }

			// Product Sidebar - all product contents 
			if( rt_is_product_page() && $this->is_enabled_sidebar('sidebar-all-products') ) { dynamic_sidebar('sidebar-all-products'); }
			
			// Product Sidebar - single products 
			if(is_single() && $post_type=='products' && $this->is_enabled_sidebar('sidebar-for-products') ){ dynamic_sidebar('sidebar-for-product'); }

			// Product Sidebar Listings
			if( $post_id == $rt_global_variables['rt_productpage'] || get_query_var('taxonomy')=="product_categories" && $this->is_enabled_sidebar('sidebar-for-product-categories') ){ dynamic_sidebar('sidebar-for-product-categories'); }

			// Blog All
			if( rt_is_blog_page() && !isset($WooCommercePage) && $this->is_enabled_sidebar('sidebar-for-blog') ){ dynamic_sidebar('sidebar-for-blog'); }

			// Blog Single
			if(is_single() && $post->post_type=='post' && $this->is_enabled_sidebar('sidebar-for-single') ){ dynamic_sidebar('sidebar-for-single'); }

			// Blog Categories
			if(is_category()  && !isset($WooCommercePage) && $this->is_enabled_sidebar('sidebar-for-blog-categories') ){ dynamic_sidebar('sidebar-for-blog-categories'); }

			// Archives 
			if(is_archive() && get_query_var('taxonomy')=="" && !isset($WooCommercePage) && ! is_category() && $this->is_enabled_sidebar('sidebar-for-archive')){ dynamic_sidebar('sidebar-for-archive'); } 

			// Tags archives
			if(is_tag() && !isset($WooCommercePage) && $this->is_enabled_sidebar('sidebar-for-tags')){ dynamic_sidebar('sidebar-for-tags'); }

			// Common Sidebar - For all site
			if( $this->is_enabled_sidebar('common-sidebar') ){ dynamic_sidebar('common-sidebar'); }
		}

		#
		# count sidebar items
		#
		function count_sidebar_items($id){		
			$get_sidebar_items   = wp_get_sidebars_widgets();		
			$count_sidebar_items = count($get_sidebar_items[$id]);		
			return $count_sidebar_items;
		}

		#
		# widgetized home page layout class
		#
		public function home_page_layout_class($params) {
			 
			global $rt_widget_num,$rt_home_contents_count,$rt_box_width,$rt_sidebarID,$rt_tempID;  

			$fixed_row = $fixed_row_end = $column_class = ""; 
			$layout_names =  array("5"=>"five","4"=>"four","3"=>"three","2"=>"two","1"=>"one");

			if($params[0]['id'] == $rt_sidebarID){			

				//which one
				$id=$params[0]['id'];
		
				//item count in the sidebar
		 		$widget_item_count = $this->count_sidebar_items($id);
				
				if($rt_tempID!=$params[0]['id']) {
					//temp sidebar id
					$rt_tempID = $id;
					$rt_home_contents_count=0;
				}

				// Widget class
				$class = array();
				
				// Home page class 
				if($id==$rt_sidebarID):
				    $rt_home_contents_count++;
				    $rt_widget_num=$rt_home_contents_count; 
				endif;

				//first and last classes
				if( $rt_widget_num==1 || fmod( $rt_widget_num, $rt_box_width )==1 || $rt_box_width==1 ):
					$column_class = 'first'; 
				elseif(fmod($rt_widget_num,$rt_box_width) == 0):
					$column_class = 'last'; 
				endif;


				//fixed rows			
				if($column_class == 'first') $fixed_row = '<div class="row clearfix">';
				if($column_class == 'last' || $rt_box_width==1 || $widget_item_count==$rt_widget_num)  $fixed_row_end = '</div>';


				$box_layout = isset( $layout_names[$rt_box_width] ) ? $layout_names[$rt_box_width] : "one";
	 
				$params[0]['before_widget'] = $fixed_row .''.  $params[0]['before_widget'];
				$params[0]['before_widget'] = str_replace('box_layout', $box_layout, $params[0]['before_widget']);
				$params[0]['before_widget'] = str_replace('column_class', $column_class, $params[0]['before_widget']);
				$params[0]['after_widget']  = $params[0]['after_widget'] .''. $fixed_row_end .'';
			}
			
		
			return $params;
		}


		#
		# Fix class name of footer widgets that added via template builder
		#
		public function fix_footer_widgets_class($params) {
			  
			$params[0]['before_widget'] =  str_replace('clearfix', 'footer clearfix', $params[0]['before_widget']);
			$params[0]['before_title']  =  str_replace('<span class="icon-right-open title_icon"></span>', '', $params[0]['before_title']);
			return $params;
		}
	 

		#
		# checks if given sidebar is a default sidebar
		#	 
		private function is_default_sidebar( $rt_sidebarID ){  
			return array_key_exists( $rt_sidebarID, $this->rt_sidebars );
		}


		#
		# checks if the sidebar is enabled
		#	  
		private function is_enabled_sidebar( $rt_sidebarID ){  
			
			if ( array_key_exists( $rt_sidebarID, $this->rt_disabled_sidebars ) ){
				return false;
			}else{
				return true;
			}
		}

		#
		# create a sidebar location in db
		#	 
		public function create_sidebar( $rt_sidebarID, $sidebarName ){  
			
	 		//user created sidebars
	 		$rt_user_created_sidebars = get_option(RT_THEMESLUG.'_rt_user_created_sidebars');

	 		//sidebar name
	 		$sidebarName = ! empty( $sidebarName ) ? $sidebarName : "New Sidebar";

	 		//new sidebar
			$new_sidebar = array( $rt_sidebarID => $sidebarName );

			if ( is_array( $rt_user_created_sidebars ) ){			 
				$new_list = array_merge( $rt_user_created_sidebars, $new_sidebar );
			}else{
				$new_list = $new_sidebar;
			}

			update_option(RT_THEMESLUG.'_rt_user_created_sidebars', $new_list);
		}	


		#
		# update sidebar
		#
		public function update_sidebar( $rt_sidebarID, $sidebarName ){  
			
	 		//user created sidebars
	 		$rt_user_created_sidebars = get_option(RT_THEMESLUG.'_rt_user_created_sidebars');

	 		//sidebar name
	 		$sidebarName = ! empty( $sidebarName ) ? $sidebarName : "Sidebar".$rt_sidebarID ;

	 		//new sidebar
			$new_sidebar = array( $rt_sidebarID => $sidebarName );

			$rt_user_created_sidebars[ $rt_sidebarID ] = $sidebarName;
	  
			update_option(RT_THEMESLUG.'_rt_user_created_sidebars', $rt_user_created_sidebars);
	 
		}		

		#
		# disable / enable sidebar
		#
		public function enable_sidebar( $rt_sidebarID, $visibility = "enable" ){  
	 
	 		//disabled sidebars
	 		$rt_disabled_sidebars = is_array( get_option( RT_THEMESLUG.'_rt_disabled_sidebars' ) ) ? get_option( RT_THEMESLUG.'_rt_disabled_sidebars' ) : array() ;

			if( $visibility == "enable" ){
				unset($rt_disabled_sidebars[$rt_sidebarID]);
				echo __('Sidebar enabled successfully', 'rt_theme_admin');	  
			}else{
			 	$rt_disabled_sidebars[ $rt_sidebarID ] = 1;
				echo __('Sidebar disabled successfully', 'rt_theme_admin');	   
			} 
	    
			update_option(RT_THEMESLUG.'_rt_disabled_sidebars', $rt_disabled_sidebars);
	 
		}

		#
		# delete sidebar
		#
		public function delete_sidebar( $rt_sidebarID ){  
	 
	 		//user created sidebars
	 		$rt_user_created_sidebars = get_option(RT_THEMESLUG.'_rt_user_created_sidebars');

			unset($rt_user_created_sidebars[$rt_sidebarID]);
			
			update_option(RT_THEMESLUG.'_rt_user_created_sidebars', $rt_user_created_sidebars);
	 
	 		echo __('Sidebar deleted successfully', 'rt_theme_admin');	  
		}	
	}

}
?>