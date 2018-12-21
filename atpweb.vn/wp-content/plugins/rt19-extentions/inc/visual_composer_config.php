<?php
#-----------------------------------------
#	RT-Theme visual_composer_config.php
#-----------------------------------------


	#
	#  VC Templates Directory
	#	
	vc_set_shortcodes_templates_dir( RT_EXTENSIONS_PATH . 'vc_templates' );

	#
	#	Disable  VC FrontEnd Editor
	#	
	vc_disable_frontend();

	#
	#	Set as a theme bundle
	#		
	add_action( 'vc_before_init', 'rt_set_as_theme' );
	function rt_set_as_theme() {
		vc_set_as_theme($disable_updater = true);
	}

	#
	#	Enable VC as default for post types in the array
	#	
	function rt_vc_set_default_editor_post_types() {
		$list = array(
			'page',
			'portfolio',
			//'post',
			//'products'
		);
		vc_set_default_editor_post_types($list);
	}

	add_action( 'init', 'rt_vc_set_default_editor_post_types' );

	#
	#	Remove VC Shortcodes
	#	
	function rt_remove_vc_shortcodes() {

		//vc_remove_element( 'vc_column_text' );
		//vc_remove_element( 'vc_separator' );
		//vc_remove_element( 'vc_text_separator' );
		//vc_remove_element( 'vc_message' );
		//vc_remove_element( 'vc_facebook' );
		//vc_remove_element( 'vc_tweetmeme' );
		//vc_remove_element( 'vc_googleplus' );
		//vc_remove_element( 'vc_pinterest' );
		//vc_remove_element( 'vc_toggle' );
		//vc_remove_element( 'vc_single_image' );
		//vc_remove_element( 'vc_gallery' );
		//vc_remove_element( 'vc_images_carousel' );
		//vc_remove_element( 'vc_tabs' );
		//vc_remove_element( 'vc_tour' );
		//vc_remove_element( 'vc_accordion' );
		//vc_remove_element( 'vc_posts_grid' );
		//vc_remove_element( 'vc_carousel' );
		//vc_remove_element( 'vc_posts_slider' );
		//vc_remove_element( 'vc_widget_sidebar' );
		//vc_remove_element( 'vc_button' );
		//vc_remove_element( 'vc_cta_button' );
		//vc_remove_element( 'vc_video' );
		//vc_remove_element( 'vc_gmaps' );
		//vc_remove_element( 'vc_raw_html' );
		//vc_remove_element( 'vc_raw_js' );
		//vc_remove_element( 'vc_flickr' );
		//vc_remove_element( 'vc_progress_bar' );
		//vc_remove_element( 'vc_pie' );
		//vc_remove_element( 'contact-form-7' );
		//vc_remove_element( 'rev_slider_vc' );
		//vc_remove_element( 'vc_wp_search' );
		//vc_remove_element( 'vc_wp_meta' );
		//vc_remove_element( 'vc_wp_recentcomments' );
		//vc_remove_element( 'vc_wp_calendar' );
		//vc_remove_element( 'vc_wp_pages' );
		//vc_remove_element( 'vc_wp_tagcloud' );
		//vc_remove_element( 'vc_wp_custommenu' );
		//vc_remove_element( 'vc_wp_text' );
		//vc_remove_element( 'vc_wp_posts' );
		//vc_remove_element( 'vc_wp_links' );
		//vc_remove_element( 'vc_wp_categories' );
		//vc_remove_element( 'vc_wp_archives' );
		//vc_remove_element( 'vc_wp_rss' );
		//vc_remove_element( 'vc_button2' );
		//vc_remove_element( 'vc_cta_button2' );

	}

	add_action( 'init', 'rt_remove_vc_shortcodes' );

	#
	#	Removes params from a Visual Composer Module
	#	
	function rt_vc_remove_param( $module="", $params=array()) {

		foreach ($params as $param) {
			vc_remove_param($module, $param);
		}

		return true;
	}	

	#
	#	Adds params to a Visual Composer Module
	#	
	function rt_vc_add_param( $modules=array(), $params=array()) {

		foreach ($modules as $module) {
			vc_add_param($module, $params);
		}

	}	

	#
	#	Add RT Shortcodes to VC
	#	
	function rt_add_vc_shortcodes() { 

		$module_list = array(
			"row",
			"column",
			"heading",
			"content_box",
			"content_icon_box",
			"tab",
			"accordion",
			"banner",
			"button",
			"pricing_table",
			"compare_table",
			"divider",
			"icon_lists",
			"chained_contents",
			"timeline",
			"image_gallery", 
			"blog",
			"slider",
			"blog_carousel",
			"google_maps",
			"contact_form",
			"info_box",
			"counter",
			"latest_news",
			"quote",
			"image_carousel",
			"retina_image",
			"icon"
		);


		//check woocommerce
		if ( class_exists( 'Woocommerce' ) ) {
			array_push($module_list, 'woo_products'); 
			array_push($module_list, 'woo_product_carousel'); 			
		}

		if ( class_exists( 'RT_Custom_Posts' ) ) {

			if( RT_Custom_Posts::is_portfolio_active() ){
				array_push($module_list, 'portfolio'); 
				array_push($module_list, 'portfolio_carousel'); 
			}

			if( RT_Custom_Posts::is_product_showcase_active() ){
				array_push($module_list, 'products'); 
				array_push($module_list, 'product_carousel'); 	
				array_push($module_list, 'product_categories'); 	
			}

			if( RT_Custom_Posts::is_testimonials_active() ){
				array_push($module_list, 'testimonials'); 
				array_push($module_list, 'testimonial_carousel'); 	
			}

			if( RT_Custom_Posts::is_team_active() ){
				array_push($module_list, 'staff_box'); 	
			}

		}

		foreach ($module_list as $module_name) {
			include(RT_EXTENSIONS_PATH . "/inc/editor/".$module_name.".php");
		}

	}

	add_action( 'init', 'rt_add_vc_shortcodes' );
	
 	
 	#
	#	Add RT Shortcodes params
	#	
	function rt_vc_add_shortcode_param() { 

		if ( ! defined( 'WPB_VC_VERSION' ) ) {
			return;
		}

		if (version_compare(WPB_VC_VERSION,"5.0","<")){
			add_shortcode_param( 'rt_vc_description', 'rt_vc_description_function' );
			add_shortcode_param( 'dropdown_multi', 'rt_vc_multiple_select_forrms', plugins_url( 'editor/multiple-select.js', __FILE__ ) ) ;
			add_shortcode_param( 'rt_number', 'rt_vc_multiple_number_inputs', plugins_url( 'editor/numbers.js', __FILE__ ) ) ;
			add_shortcode_param( 'rt_separator', 'rt_vc_separator') ;
		}else{
			vc_add_shortcode_param( 'rt_vc_description', 'rt_vc_description_function' );
			vc_add_shortcode_param( 'dropdown_multi', 'rt_vc_multiple_select_forrms', plugins_url( 'editor/multiple-select.js', __FILE__ ) ) ;
			vc_add_shortcode_param( 'rt_number', 'rt_vc_multiple_number_inputs', plugins_url( 'editor/numbers.js', __FILE__ ) ) ;
			vc_add_shortcode_param( 'rt_separator', 'rt_vc_separator') ;			
		}

	}
	add_action( 'vc_before_init', 'rt_vc_add_shortcode_param' );

	/**
	 * Creates a standalone description area that allows html 
	 * @param  [string] $param
	 * @param  [string] $param_value
	 * @return [html]  $param_line
	 */
	function rt_vc_description_function( $settings, $value ) {
		$param_line = '<p>'.$settings["default"].'</p>';
		return $param_line;
	}
	


	/**
	 * Creates multiple select forms for VC 
	 * @param  [string] $param
	 * @param  [string] $param_value
	 * @return [html]  $param_line
	 */
	function rt_vc_multiple_select_forrms( $param, $param_value ) {
		$css_option = vc_get_dropdown_option( $param, $param_value );


		$param_line = '<select multiple name="' . $param['param_name'] . '" class="wpb_vc_param_value wpb-input wpb-select rt-multi-select ' . $param['param_name'] . ' ' . $param['type'] . ' ' . $css_option . '" data-option="' . $css_option . '">';
		$selected_values = ! is_array( $param_value ) ? explode(",", $param_value ) : $param_value;

		foreach ( $param['value'] as $text_val => $val ) {
			if ( is_numeric( $text_val ) && ( is_string( $val ) || is_numeric( $val ) ) ) {
				$text_val = $val;
			}
			$text_val = __( $text_val, "js_composer" );
			$selected = '';

			if ( in_array($val, $selected_values) ) {
				$selected = ' selected="selected"';
			}

			$param_line .= '<option class="' . $val . '" value="' . $val . '"' . $selected . '>' . htmlspecialchars( $text_val ) . '</option>';
		}
		$param_line .= '</select>';

		return $param_line;
	}
	


	/**
	 * Creates number input forms for VC 
	 * @param  [string] $param
	 * @param  [string] $param_value
	 * @return [html]  $param_line
	 */
	function rt_vc_multiple_number_inputs( $param, $param_value ) {

		$value = __( $param_value, "js_composer" );
		$value = htmlspecialchars( $value );
		$param_line = '<input name="' . $param['param_name'] . '" class="rt-number wpb_vc_param_value wpb-textinput ' . $param['param_name'] . ' ' . $param['type'] . '" type="text" value="' . $value . '"/>';

		return $param_line;
	}
	


	/**
	 * Creates separator for VC 
	 * @param  [string] $param
	 * @param  [string] $param_value
	 * @return [html]  $param_line
	 */
	function rt_vc_separator( $param ) {
		
		$output = '<div class="rt-seperator">'; 
		$output .= '<h5 class="rt-vc-separator">'.$param['rt-heading'].'</h5>';
		$output .= '<p class="rt-vc-desc">'.$param['rt-desc'].'</p>';
		$output .= '</div>'; 

		return $output;
	}
	
?>