<?php
#-----------------------------------------
#	RT-Theme admin.php
#	version: 1.0
#-----------------------------------------

#
#	Admin Class
#

class RTThemeAdmin extends RTTheme{

	private $panel_pages = array(); 
	private $admin_notices = array();

	function admin_init(){ 

		//admin notices 
		add_action('admin_notices', array(&$this,'rt_admin_notices')); 	
 
		//Theme Version
		$this->rt_get_theme_version();

		//Load Admin Functions
		$this->load_admin_functions();

		//Load Scripts
		add_action('admin_enqueue_scripts', array(&$this,'load_admin_scripts'));
		
		//Load Styles
		add_action('admin_enqueue_scripts', array(&$this,'load_admin_styles'));	 
	} 


	#
	#	Admin notices
	#
	function rt_admin_notices(){  

		if( is_array( $this->admin_notices ) ){
			foreach ( $this->admin_notices as $key => $value) {
				echo '<div id="notice" class="'.sanitize_html_class($value["type"]).'"><p>'.$value["text"].'</p></div>';
			}
		}
	}   


	#
	#	Load Admin Functions
	#
	function load_admin_functions() {			
	}
 
 
	#
	#	Load Admin Scripts
	#

	function load_admin_scripts(){
		global $pagenow;

		$theme_data = rt_get_theme();
		$theme_version = $theme_data->get("Version");

		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('jquery-ui-droppable');
		wp_enqueue_script('jquery-ui-draggable'); 
		wp_enqueue_script('jquery-ui-tabs'); 
		wp_enqueue_script('jquery-ui-widget');
		wp_enqueue_script('jquery-ui-mouse');  
		wp_enqueue_script('jquery-effects-core');  
		wp_enqueue_script('jquery-effects-scale');  
		wp_enqueue_script('jquery-effects-fade');  
		wp_enqueue_script('jquery-effects-highlight');  
		wp_enqueue_script('jquery-effects-transfer');  
		wp_enqueue_script('jquery-ui-button');  


		if( $pagenow == "edit-tags.php" || $pagenow == "term.php" ){
			if(function_exists( 'wp_enqueue_media' ) ){
				wp_enqueue_media();
			}else{
				wp_enqueue_style('thickbox');
				wp_enqueue_script('media-upload');
				wp_enqueue_script('thickbox');
			}
		}

		
		wp_enqueue_script('jquery-custom-select', RT_THEMEADMINURI.'/js/jquery.customselect.min.js',"",$theme_version);		
		wp_enqueue_script('spectrum', RT_THEMEADMINURI . '/js/spectrum/spectrum.min.js',"",$theme_version); 
		wp_enqueue_script('jquery-tools', RT_THEMEADMINURI . '/js/rangeinput.min.js',"",$theme_version);
		wp_enqueue_script('jquery-amselect', RT_THEMEADMINURI . '/js/jquery.asmselect.min.js',"",$theme_version);  

		$min_extention = get_theme_mod(RT_THEMESLUG.'_optimize_css') ? ".min" : "";
		
		wp_enqueue_script('admin-scripts', RT_THEMEADMINURI . '/js/script'.$min_extention.'.js','',$theme_version,true);

		$rt_variables=array( 
				"reset_theme" => __('Are you sure that you want reset the theme settings? ','rt_theme_admin'),
				"delete_image" => __('Are you sure that you want remove this image? ','rt_theme_admin'),
				"delete_font" => __('Are you sure that you want remove this font? ','rt_theme_admin'),
				"theme_slug" => RT_THEMESLUG
				);		

		wp_localize_script( 'jquery', 'rt_variables', $rt_variables );

	}

	#
	#	Load Admin Styles
	#
	
	function load_admin_styles(){
		global $pagenow;

		$theme_data = rt_get_theme();
		$theme_version = $theme_data->get("Version");		
				
		if( ! get_theme_mod(RT_THEMESLUG.'_optimize_css') ){
			wp_enqueue_style('admin-style', RT_THEMEADMINURI . '/css/admin.css', "", $theme_version);   
		}else{
			wp_enqueue_style('admin-style', RT_THEMEADMINURI . '/css/admin.min.css', "", $theme_version);   
		}

		wp_enqueue_style('spectrum-style', RT_THEMEADMINURI . '/js/spectrum/spectrum.css', "", $theme_version); 

		if( $pagenow == "post.php" || $pagenow == "post-new.php" || $pagenow == "customize.php" ){
			wp_enqueue_style('fontello', RT_THEMEURI . '/css/fontello/css/fontello.css', "", $theme_version);		
		}
	}

	/**
	 * Get Theme Version 
	 *
	 * Returns the version number of the orginal theme
	 * 
	 * @return string version number
	 */
	function rt_get_theme_version(){ 

		$rt_theme_data = wp_get_theme(); 

		if( is_child_theme() ){
			$rt_theme_data = $rt_theme_data->parent(); 			
		}
		
		return $this->version = $rt_theme_data['Version'];
	}

	#
	#	Get Current Post Type
	#	 
 
	function get_current_post_type() {
		global $post, $typenow, $current_screen;
		
		if($post && $post->post_type) {
			return $post->post_type;
		}elseif($typenow) {
			return $typenow;
		}elseif($current_screen && $current_screen->post_type) {
			return $current_screen->post_type;
		}elseif(isset($_REQUEST['post_type'])) {
			return sanitize_key( $_REQUEST['post_type'] );
		}elseif(isset($_GET['post'])) {
			$thispost = get_post($_GET['post']);
			return $thispost->post_type;
		} else {
			return "post";
		}
	}

}
?>
