<?php
#-----------------------------------------
#	RT-Theme shortcode_helper.php
#-----------------------------------------
 

class rt_shortcode_helper{

	public $shortcode_list = array();

	public function __construct()
	{
		$this->start();
	} 

	#
	#	Init
	#
	public function start() { 

			if(is_admin()){
				// add shortcode helper menu & editor button
				add_action( 'wp_before_admin_bar_render', array(&$this, "custom_toolbar") , 999 );		
				add_filter( 'tiny_mce_version', array(&$this, "refresh_editor") );
				add_filter( 'init', array(&$this, "rt_theme_shortcode_button") );
			}
	}

	#
	#	Add Toolbar Menu
	#
 
	public function custom_toolbar() {

		if ( ! class_exists("RTTheme") ){
			return;
		}
				
		global $wp_admin_bar;


		$args = array(
			'id'     => 'rt_shortcode_helper_button',
			'title'  => '<div><span class="ab-icon"></span>'._x( 'Shortcodes', 'Admin Panel', 'rt_theme_admin' ) .'</div>',		
			'group'  => false 
		);

		$wp_admin_bar->add_menu( $args ); 
	}

	#
	#	Add shortcode button to editor
	#
 
	public function rt_theme_shortcode_button() {

		if ( ! class_exists("RTTheme") ){
			return;
		}

		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
			return;

		// Add only in Rich Editor mode
		if ( get_user_option('rich_editing') == 'true') {
			add_filter("mce_external_plugins", array(&$this,'rt_theme_add_shortcode_tinymce_plugin'));
			add_filter('mce_buttons', array(&$this,'rt_theme_register_shortcode_button'));
		}
	}


	#
	#	Register editor buttons
	#
 
	public function rt_theme_register_shortcode_button($buttons) {
		array_push($buttons, "", "rt_themeshortcode");
		return $buttons;
	}

	#
	#	Load the js file
	#

	public function rt_theme_add_shortcode_tinymce_plugin($plugin_array) {
		$plugin_array['rt_themeshortcode'] = RT_THEMEURI . '/rt-framework/admin/js/editor_buttons.js';
		return $plugin_array;
	}


	#
	#	Refresh the editor 
	#
	public function refresh_editor($ver) {
		$ver += 3;
		return $ver;
	}

	#
	#	Shortcode List & Helper Menu
	#
	public function create_shortcode_list() {   

		if ( ! class_exists("RTTheme") ){
			return;
		}

		$this->create_shortcode_array();

		//create UI
		$output = $tab_names_output = $tab_contents_output = $group_id = $parameters = "";

		foreach ( $this->shortcode_list as $shortcode_id => $shortcode_arg  ) {		

			//group name 
			$group_name = isset( $shortcode_arg["group_name"] ) ? $shortcode_arg["group_name"] : "";

			//group id 
			$group_id = isset( $shortcode_arg["group_name"] ) ? $shortcode_id : $group_id;

			//the shortcode format
		 	$shortcode_arg["parameters"] = isset(  $shortcode_arg["parameters"] ) ?  $shortcode_arg["parameters"] : "";
			$the_shortcode_format = empty( $group_name) ? $this->create_shortcode_format( $shortcode_id, $shortcode_arg["parameters"] ) : "";

 
			if( ! isset( $shortcode_arg["subline"] ) || $shortcode_arg["subline"] == false ){
	 
				if( empty( $group_name ) ) {

						//create tab panels
						$tab_names_output .= sprintf('
								<li class="%3$s">	
									<a href="#shorcode-%2$s">
										%1$s
									</a>
								</li>
						', $shortcode_arg["name"], $shortcode_id, $group_id );				

						$this_tab_content = '';

						//this tab output format
						$this_tab_content_format = ' <h3><span class="icon-code-outline icon"></span> %1$s </h3> <p class="description"> %2$s <span class="pformat">%5$s</span></p> %3$s %4$s ';

						//description
						$shortcode_arg["description"] = isset( $shortcode_arg["description"] ) ? $shortcode_arg["description"] : "";

						//output for the main shortcode				
						$this_tab_content .= sprintf($this_tab_content_format, $shortcode_arg["name"], $shortcode_arg["description"], $parameters, $this->create_parameters( $shortcode_arg["parameters"] ), htmlspecialchars($the_shortcode_format)  );				

						//sub shorcode 
						if( isset( $shortcode_arg["content"] ) ){
							if( ! empty( $shortcode_arg["content"]["shortcode_id"] ) ){
								$sub_shortcode_id = $shortcode_arg["content"]["shortcode_id"];			
								$sub_shortcode_parameters = isset(  $this->shortcode_list[$sub_shortcode_id]["parameters"] ) ? $this->shortcode_list[$sub_shortcode_id]["parameters"] : "";
								$the_sub_shortcode_format = $this->create_shortcode_format( $sub_shortcode_id, $sub_shortcode_parameters ) ;//the shortcode format
								$this_tab_content .= sprintf($this_tab_content_format, $this->shortcode_list[$sub_shortcode_id]["name"], $this->shortcode_list[$sub_shortcode_id]["description"], $parameters, $this->create_parameters( $sub_shortcode_parameters ), $the_sub_shortcode_format );				

							}
						}			

						// shortcode example 
						$example_code = isset( $this->shortcode_examples[$shortcode_id] ) ? $this->shortcode_examples[$shortcode_id] : "" ;
						$example_code_output = "";

							if( ! empty( $example_code ) ){
								if( is_array( $example_code ) ){
									foreach ($example_code as $desc => $code) {			
										
										$code = preg_replace('/\t+/', '', $code);

										$example_code_output .= sprintf('
												<h3><span class="icon-info icon"></span> %1$s </h3>
												<textarea>%2$s</textarea>
												<input type="button" class="button insert_to_editor" value="insert to editor">
											', $desc, $code );
									}						
								}
							}else{						
								$example_code_output = sprintf('
									<h3><span class="icon-info icon"></span> %1$s </h3> <textarea>%2$s</textarea> <input type="button" class="button insert_to_editor"  value="insert to editor">', 
									__( 'Example', 'rt_theme_admin' ), $this->create_shortcode_example( $shortcode_id, $shortcode_arg["parameters"] ) );				
							}

						//add to the output
						$tab_contents_output .= sprintf('
								<div id="shorcode-%1$s" class="ui-tabs-panel">
									<table>
										<tr>
											<td>%2$s</td>
											<td>
												%3$s
											</td>
										</tr>
									</table>
								</div>
						', $shortcode_id, $this_tab_content,  $example_code_output);				

				}else{

					//group start
					$tab_names_output .= sprintf('
						<div class="group_name"><span class="%2$s icon"></span>%1$s</div>
					', $group_name, $shortcode_arg["group_icon"] );
 
				}
				
			}
		}

		$output  = sprintf( '

			<div id="rttheme_shortcode_helper" class="rt_modal">
				
				<div class="window_bar">
					<div class="title">'.  __( 'Theme Shortcodes', 'rt_theme_admin' ) .'</div>

					<div class="rt_modal_close rt_modal_control"><span class="icon-cancel"></span></div>
				</div>

				<div class="modal_content">

					<div class="rt_tabs vertical_tabs">
						<ul class="ui-tabs-nav">
							%1$s
						</ul>
						%2$s
					</div>

				</div>

			</div>
			', $tab_names_output, $tab_contents_output );
 		
 		echo "<link rel='stylesheet' id='admin-bar-css'  href='".rt_locate_media_file( "/css/fontello/css/fontello.css" )."' type='text/css' media='all' />";
		echo $output;
	}


	#
	#	Shortcode Parameter Guide
	#
	
	private function create_parameters( $parameters = array() ){
		
		$output = "";

		if( is_array( $parameters ) ){

			foreach ($parameters as $parameter ) {

				$option_list = $default_value = $value = "";
				$heading = $description = $param_name = $default_value = $option_list = $dependency = "";

				extract( $parameter );

				$heading = isset( $heading ) && ! empty( $heading ) ? $heading.". " : "";

				$dependency = isset( $dependency ) && ! empty( $dependency ) ? "<br /><u>Dependency</u>: ". $dependency["element"]. "=" . implode(",", $dependency["value"] ) : "";

				//parameter option list
				if( is_array( $value ) ){

					foreach ($value as $key => $value) {
						$option_list .=  '<span class="poptionname rt_clean_copy">'. $key .'</span>' . $value .'<br />' ;
					}

					$option_list = sprintf(' <li><span class="poptions">%1$s</span> %2$s  </li> ',  __('Options','rt_theme_admin'), $option_list );
				}

				//default value
				if( isset( $default_value ) && $default_value != "" ){

				$default_value = sprintf(' <li><span class="pdefault">%1$s</span> :  <span class="poptionname rt_clean_copy">%2$s</span>  </li> ',  __('Default Value','rt_theme_admin'), $default_value );
				}

				//paramater list
				$output .= sprintf('
									<li>
										
										<span class="pname">%1$s : </span>

											<ul>					
												<li><p class="pdescription"> %2$s </p></li>											
												%3$s
												%4$s
											</ul>

									</li>
								', 

								$param_name, $heading."".$description."".$dependency, $default_value, $option_list
							);

				$heading = $description = $param_name = $default_value = $option_list = $dependency = "";
			}

		}

		if ( ! empty( $output ) ) {
			return '
				<h3><span class="icon-cog icon"></span>'. __('Parameters','rt_theme_admin') .'</h3>
				<ul class="parameters">'
					.$output.'
				</ul>';
		}

	}


	#
	#	Create Shortocde Format
	#
	
	private	function create_shortcode_format( $shortcode_id, $parameters ){
		
		$output = $parameters_output = "";

		//createa paramater format
		if( is_array( $parameters ) ){
			foreach ($parameters as $paramater ) {
				$parameters_output .= sprintf(' %1$s=""', $paramater["param_name"] ); 
			}
		}

		//the shortcode
		if( $this->shortcode_list[$shortcode_id]["close"] == false ){
			$output = sprintf('[%1$s%2$s]',$shortcode_id, $parameters_output);
		}else{
			$this->shortcode_list[$shortcode_id]["content"]["text"] = isset( $this->shortcode_list[$shortcode_id]["content"]["text"] ) ? $this->shortcode_list[$shortcode_id]["content"]["text"] : "";
			$output = sprintf('[%1$s%2$s]%3$s[/%1$s]',$shortcode_id, $parameters_output, $this->shortcode_list[$shortcode_id]["content"]["text"]);
		}
			
		return $output;

	}



	#
	#	Create Shortocde Example
	#
	
	private	function create_shortcode_example( $shortcode_id, $parameters ){
		
		$output = $parameters_output = "";

		//createa paramater format
		if( is_array( $parameters ) ){
			foreach ($parameters as $paramater ) {
				$paramater["default_value"] = isset( $paramater["default_value"] ) ? $paramater["default_value"] : "";
				$parameters_output .= sprintf(' %1$s="%2$s"', $paramater["param_name"], $paramater["default_value"] ); 
			}
		}

		//shortcode content
		if( $this->shortcode_list[$shortcode_id]["close"] == true ){
 	
 			$sub_shortcode_id = isset( $this->shortcode_list[$shortcode_id]["content"] ) && isset( $this->shortcode_list[$shortcode_id]["content"]["shortcode_id"] ) ? $this->shortcode_list[$shortcode_id]["content"]["shortcode_id"] : "" ;

			if( ! empty( $sub_shortcode_id ) ) {
				$shorcode_content = $this->create_shortcode_example( $sub_shortcode_id, $this->shortcode_list[$sub_shortcode_id]["parameters"] ) ;
			}else{
				$shorcode_content = $this->shortcode_list[$shortcode_id]["content"]["text"];
			}

		}


		//the shortcode
		if( $this->shortcode_list[$shortcode_id]["close"] == false ){
			$output = sprintf('[%1$s%2$s]',$shortcode_id, $parameters_output);
		}else{
			$output = sprintf('[%1$s%2$s]%3$s[/%1$s]',$shortcode_id, $parameters_output, $shorcode_content);
		}
			
		return $output;

	}


	public function create_shortcode_array(){

		$this->shortcode_list = array(

				/* format

					"shortcode_name" => array(
						"name"=> '',
						"subline" => '',
						"id"=> '',
						"description"=> '',
						"open" => '',
						"close" => '',	
						"content" => array(
										"shortcode_id" => '',
										"text" => ''
									),						
						"parameters" => array(
											array(
												"param_name" => '',
												"description"=> '',
												"default_value" => '',
												"value" => array(),
											),
										),
					),

				*/
	 


			/*
				Group Name
			*/
			"group-1" => array(
				"group_name"=> __('Layout Elements','rt_theme_admin'),
				"group_icon"=> "icon-code-1",
			),

					/*
						Columns Holder
					*/			
					"rt_cols" => array(

						"name"=> __('Columns','rt_theme_admin'),
						"description"=> __('Columns holder shortcode. Column shortcode must be placed inside this shortcode.','rt_theme_admin'),
						"subline" => false,
						"open" => true,
						"close" => true,
						"content" => array(
										"shortcode_id" => 'rt_column',
										"text" => ''
									),
						"parameters" => array()
					),

					/*
						Column
					*/			
					"rt_col" => array(

						"name"=> __('Column','rt_theme_admin'),
						"description"=> __('Display a column.','rt_theme_admin'),
						"subline" => true,
						"open" => true,
						"close" => true,
						"content" => array(
										"shortcode_id" => '',
										"text" => 'text'
									),
						"parameters" => array(
											array(
												"param_name" => 'width',
												"description"=> 'Width',
												"default_value" => 'one',
												"value" => array(
																		"1/12" => __('1/12 Column','rt_theme_admin'),
																		"2/12" => __('2/12 Columns','rt_theme_admin'),
																		"3/12" => __('3/12 Columns','rt_theme_admin'),
																		"4/12" => __('4/12 Columns','rt_theme_admin'),
																		"5/12" => __('5/12 Columns','rt_theme_admin'),
																		"6/12" => __('6/12 Columns','rt_theme_admin'),
																		"7/12" => __('7/12 Columns','rt_theme_admin'),
																		"8/12" => __('8/12 Columns','rt_theme_admin'),
																		"9/12" => __('9/12 Columns','rt_theme_admin'),
																		"10/12" => __('10/12 Columns','rt_theme_admin'),
																		"11/12" => __('11/12 Columns','rt_theme_admin'),
																		"12/12" => __('12/12 Columns','rt_theme_admin'),
																	),
											),
										),				
					),

			/*
				Posts
			*/
			"group-2" => array(
				"group_name"=> __('Posts','rt_theme_admin'),
				"group_icon"=> "icon-code-1",
			),

					/*
						Blog Posts
					*/
					"blog_box" => array(
						"name"=> __('Blog Posts','rt_theme_admin'),
						"subline" => '',
						"id"=> 'blog_box',
						"description"=> __('Displays blog posts with selected parameters','rt_theme_admin'),
						"open" => true,
						"close" => false,	
						"content" => array(
										"shortcode_id" => '',
										"text" => ''
									),						
						"parameters" => array(

											array(
												'param_name'  => 'id',
												'description' => __('Unique ID', 'rt_theme_admin' ),
											),

											array(
												'param_name'  => 'class',
												'description' => __('CSS Class Name', 'rt_theme_admin' ),
											),

											array(
												"param_name" => 'list_layout',
												"description"=> __('Column layout for the list','rt_theme_admin'),
												"default_value" => '1/1',
												"value" => array(
																			"1/6" => "1/6 columns", 
																			"1/4" => "1/4 columns",
																			"1/3" => "1/3 columns",
																			"1/2" => "1/2 columns",
																			"1/1" => "1/1 column"												
																	),
											),

											array(
												'param_name'  => 'layout_style',
												'heading'     => __( 'Layout Style', 'rt_theme_admin' ),
												"description" => __("Design of the layout",'rt_theme_admin'),
												"default_value" => 'grid',
												"value"       => array(
																			"grid" => __("Grid","rt_theme_admin"),
																			"masonry" => __("Masonry","rt_theme_admin"),
																		)
											),

											array(
												'param_name'  => 'use_excerpts',
												'heading'     => __("Excerpts", "rt_theme_admin"),
												"description" => __("As default the full blog content will be displayed for this list.  Enable this option to minify the content automatically by using WordPress's excerpt option.  You can keep disabled and split your content manually by using <a href=\"http://en.support.wordpress.com/splitting-content/more-tag/\">The More Tag</a>",'rt_theme_admin'),
												'type'        => 'dropdown',
												"default_value" => 'true',
												"value"       => array(
																	'true' => __('Yes','rt_theme_admin'),
																	'false' => __('No','rt_theme_admin'),
																),
											),

											array(
												"param_name" => 'pagination',
												"description"=> __('Splits the list into pages.','rt_theme_admin'),
												"default_value" => 'false',
												"value" => array(
																		"true" => __('True','rt_theme_admin'),
																		"false" => __('False','rt_theme_admin'),
																	),
											),

											array(
												'param_name'  => 'ajax_pagination',
												'description' => __( 'Enable ajax pagination (load more). Works with Masonry layout_style only', 'rt_theme_admin' ),
												'type'        => 'checkbox',
												"value"       => "true",
												"dependency"  => array(
																	"element" => "pagination",
																	"value" => array("true")
																),	
											),

											array(
												"param_name" => 'list_orderby',
												"description"=> __('Sorts the posts by this parameter','rt_theme_admin'),
												"default_value" => 'date',
												"value" => array(
																		'author'=>__('Author','rt_theme_admin'),
																		'date'=>__('Date','rt_theme_admin'),
																		'title'=>__('Title','rt_theme_admin'),
																		'modified'=>__('Modified','rt_theme_admin'),
																		'ID'=>__('ID','rt_theme_admin'),
																		'rand'=>__('Randomized','rt_theme_admin'),
																	),
											),	

											array(
												"param_name" => 'list_order',
												"description"=> __("Designates the ascending or descending order of the list_orderby parameter",'rt_theme_admin'),
												"default_value" => 'DESC',
												"value" => array(
																		'ASC'=>__('Ascending','rt_theme_admin'),
																		'DESC'=>__('DESC','rt_theme_admin'), 
																	),
											),				

											array(
												"param_name" => 'item_per_page',
												"description"=> __("Amount of post per page",'rt_theme_admin'),
												"default_value" => '9'
											),

											array(
												"param_name" => 'categories',
												"description"=> __("Category id's seperated by comma. Leave blank to list all categories.",'rt_theme_admin'),
												"default_value" => ''
											),



											array(
												'param_name'  => 'show_date',
												'heading'     => __("Display Date", "rt_theme_admin"),
												'type'        => 'dropdown',
												"default_value" => 'true',
												"value"       => array(
																		'true' => __('Yes','rt_theme_admin'),
																		'false' => __('No','rt_theme_admin'),
																),
												'group'       => __('Post Meta', 'rt_theme_admin')
											),

											array(
												'param_name'  => 'show_author',
												'heading'     => __("Display Post Author", "rt_theme_admin"),
												'type'        => 'dropdown',
												"default_value" => 'true',
												"value"       => array(
																		'true' => __('Yes','rt_theme_admin'),
																		'false' => __('No','rt_theme_admin'),
																),
												'group'       => __('Post Meta', 'rt_theme_admin')
											),

											array(
												'param_name'  => 'show_categories',
												'heading'     => __("Display Categories", "rt_theme_admin"),
												'type'        => 'dropdown',
												"default_value" => 'true',
												"value"       => array(
																		'true' => __('Yes','rt_theme_admin'),
																		'false' => __('No','rt_theme_admin'),
																),
												'group'       => __('Post Meta', 'rt_theme_admin')
											),

											array(
												'param_name'  => 'show_comment_numbers',
												'heading'     => __("Display Comment Numbers", "rt_theme_admin"),
												'type'        => 'dropdown',
												"default_value" => 'true',
												"value"       => array(
																		'true' => __('Yes','rt_theme_admin'),
																		'false' => __('No','rt_theme_admin'),
																),
												'group'       => __('Post Meta', 'rt_theme_admin')
											),


											array(
												'param_name'  => 'featured_image_resize',
												'heading'     => __( 'Resize Featured Images', 'rt_theme_admin' ),
												'description' => __('Enable "Image Resize" to resize or crop the featured images automatically. These settings will be overwrite the global settings. Please note, since the theme is reponsive the images cannot be wider than the column they are in. Leave values "0" to use theme defaults.', 'rt_theme_admin' ),
												'type'        => 'dropdown',
												"default_value" => 'true',
												"value"       => array(
																		"true" => __("Enabled","rt_theme_admin"),
																		"false" => __("Disabled","rt_theme_admin")
																	),
												'group' => __('Featured Images', 'rt_theme_admin')
											),

											array(
												'param_name'  => 'featured_image_max_width',
												'heading'     => __('Featured Image Max Width', 'rt_theme_admin' ),
												'type'        => 'textfield',
												'default_value'       => "0",
												"dependency"  => array(
																	"element" => "featured_image_resize",
																	"value" => array("true")
																),
												'group' => __('Featured Images', 'rt_theme_admin')
											),

											array(
												'param_name'  => 'featured_image_max_height',
												'heading'     => __('Featured Image Max Height', 'rt_theme_admin' ),
												'type'        => 'textfield',
												'default_value'   => "0",
												"dependency"  => array(
																	"element" => "featured_image_resize",
																	"value" => array("true")
																),
												'group' => __('Featured Images', 'rt_theme_admin')
											),

											array(
												'param_name'  => 'featured_image_crop',
												'heading'     => __( 'Crop Featured Images', 'rt_theme_admin' ),
												'type'        => 'dropdown',
												"value"       => array(
																		"true" => __("Enabled","rt_theme_admin"),
																		"false" => __("Disabled","rt_theme_admin")
																),
												'default_value'  => "false",
												"dependency"  => array(
																	"element" => "featured_image_resize",
																	"value" => array("true")
																),								
												'group' => __('Featured Images', 'rt_theme_admin')
											),

										),
					),

					/*
						Portfolio Posts
					*/ 
					"portfolio_box" => array(
						"name"=> __('Portfolio Posts','rt_theme_admin'),
						"subline" => '',
						"id"=> 'portfolio_box',
						"description"=> __('Displays porfolio posts with selected parameters','rt_theme_admin'),
						"open" => true,
						"close" => false,	
						"content" => array(
										"shortcode_id" => '',
										"text" => ''
									),						
						"parameters" => array(


											array(
												'param_name'  => 'id',
												'description' => __('Unique ID', 'rt_theme_admin' ),
											),

											array(
												'param_name'  => 'class',
												'description' => __('CSS Class Name', 'rt_theme_admin' ),
											),

											array(
												"param_name" => 'list_layout',
												"description"=> __('Column layout for the list','rt_theme_admin'),
												"default_value" => '1/4',
												"value" => array(
																			"1/6" => "1/6 columns", 
																			"1/4" => "1/4 columns",
																			"1/3" => "1/3 columns",
																			"1/2" => "1/2 columns",
																			"1/1" => "1/1 column"												
																	),
											),

											array(
												'param_name'  => 'layout_style',
												'heading'     => __( 'Layout Style', 'rt_theme_admin' ),
												"description" => __("Design of the layout",'rt_theme_admin'),
												"default_value" => 'grid',
												"value"       => array(
																			"grid" => __("Grid","rt_theme_admin"),
																			"masonry" => __("Masonry","rt_theme_admin"),
																		)
											),

											array(
												'param_name'  => 'item_style',
												'heading'     => __( 'Item Style', 'rt_theme_admin' ),
												"description" => __("Select a style for the portfolio item in listing pages & categories.",'rt_theme_admin'),
												'type'        => 'dropdown',
												"value"       => array(
																	"style-1" => __("Style 1 - Info under the featured image","rt_theme_admin"),
																	"style-2" => __("Style 2 - Info embedded to the featured image ","rt_theme_admin")
																)
											),

											array(
												'param_name'  => 'filterable',
												'heading'     => __( 'Filter Navigation', 'rt_theme_admin' ),
												"description" => __("Displays a filter navigation that contains categories of the posts of the list.",'rt_theme_admin'),
												'type'        => 'dropdown',
												"value"       => array(
																	'true'  => __('Yes','rt_theme_admin'),
																	'false'  => __('No','rt_theme_admin')
																),
											),

											array(
												"param_name" => 'pagination',
												"description"=> __('Splits the list into pages.','rt_theme_admin'),
												"default_value" => 'false',
												"value" => array(
																		"true" => __('True','rt_theme_admin'),
																		"false" => __('False','rt_theme_admin'),
																	),
											),

											array(
												'param_name'  => 'ajax_pagination',
												'description' => __( 'Enable ajax pagination (load more). Works with Masonry layout_style only', 'rt_theme_admin' ),
												'type'        => 'checkbox',
												"value"       => "true",
												"dependency"  => array(
																	"element" => "pagination",
																	"value" => array("true")
																),	
											),



											array(
												"param_name" => 'list_orderby',
												"description"=> __('Sorts the posts by this parameter','rt_theme_admin'),
												"default_value" => 'date',
												"value" => array(
																		'author'=>__('Author','rt_theme_admin'),
																		'date'=>__('Date','rt_theme_admin'),
																		'title'=>__('Title','rt_theme_admin'),
																		'modified'=>__('Modified','rt_theme_admin'),
																		'ID'=>__('ID','rt_theme_admin'),
																		'rand'=>__('Randomized','rt_theme_admin'),
																	),
											),	

											array(
												"param_name" => 'list_order',
												"description"=> __("Designates the ascending or descending order of the list_orderby parameter",'rt_theme_admin'),
												"default_value" => 'DESC',
												"value" => array(
																		'ASC'=>__('Ascending','rt_theme_admin'),
																		'DESC'=>__('DESC','rt_theme_admin'), 
																	),
											),				

											array(
												"param_name" => 'item_per_page',
												"description"=> __("Amount of post per page",'rt_theme_admin'),
												"default_value" => '9'
											),

											array(
												"param_name" => 'categories',
												"description"=> __("Category id's seperated by comma. Leave blank to list all categories.",'rt_theme_admin'),
												"default_value" => ''
											),

											array(
												"param_name" => 'ids',
												"description"=> __("Product id's seperated by comma. Leave blank to list all products.",'rt_theme_admin'),
												"default_value" => ''
											),				

											array(
												'param_name'  => 'featured_image_resize',
												'heading'     => __( 'Resize Featured Images', 'rt_theme_admin' ),
												'description' => __('Enable "Image Resize" to resize or crop the featured images automatically. These settings will be overwrite the global settings. Please note, since the theme is reponsive the images cannot be wider than the column they are in. Leave values "0" to use theme defaults.', 'rt_theme_admin' ),
												'type'        => 'dropdown',
												"default_value" => 'true',
												"value"       => array(
																		"true" => __("Enabled","rt_theme_admin"),
																		"false" => __("Disabled","rt_theme_admin")
																	),
												'group' => __('Featured Images', 'rt_theme_admin')
											),

											array(
												'param_name'  => 'featured_image_max_width',
												'heading'     => __('Featured Image Max Width', 'rt_theme_admin' ),
												'type'        => 'textfield',
												'default_value'       => "0",
												"dependency"  => array(
																	"element" => "featured_image_resize",
																	"value" => array("true")
																),
												'group' => __('Featured Images', 'rt_theme_admin')
											),

											array(
												'param_name'  => 'featured_image_max_height',
												'heading'     => __('Featured Image Max Height', 'rt_theme_admin' ),
												'type'        => 'textfield',
												'default_value'   => "0",
												"dependency"  => array(
																	"element" => "featured_image_resize",
																	"value" => array("true")
																),
												'group' => __('Featured Images', 'rt_theme_admin')
											),

											array(
												'param_name'  => 'featured_image_crop',
												'heading'     => __( 'Crop Featured Images', 'rt_theme_admin' ),
												'type'        => 'dropdown',
												"value"       => array(
																		"true" => __("Enabled","rt_theme_admin"),
																		"false" => __("Disabled","rt_theme_admin")
																),
												'default_value'  => "false",
												"dependency"  => array(
																	"element" => "featured_image_resize",
																	"value" => array("true")
																),								
												'group' => __('Featured Images', 'rt_theme_admin')
											),


										),
					),

					/*
						Product Posts
					*/ 
					"product_box" => array(
						"name"=> __('Product Posts','rt_theme_admin'),
						"subline" => '',
						"id"=> 'product_box',
						"description"=> __('Displays product posts with selected parameters','rt_theme_admin'),
						"open" => true,
						"close" => false,	
						"content" => array(
										"shortcode_id" => '',
										"text" => ''
									),						
						"parameters" => array(


											array(
												'param_name'  => 'id',
												'description' => __('Unique ID', 'rt_theme_admin' ),
											),

											array(
												'param_name'  => 'class',
												'description' => __('CSS Class Name', 'rt_theme_admin' ),
											),

											array(
												"param_name" => 'list_layout',
												"description"=> __('Column layout for the list','rt_theme_admin'),
												"default_value" => '1/4',
												"value" => array(
																			"1/6" => "1/6 columns", 
																			"1/4" => "1/4 columns",
																			"1/3" => "1/3 columns",
																			"1/2" => "1/2 columns",
																			"1/1" => "1/1 column"												
																	),
											),


											array(
												'param_name'  => 'layout_style',
												'heading'     => __( 'Layout Style', 'rt_theme_admin' ),
												"description" => __("Design of the layout",'rt_theme_admin'),
												"default_value" => 'grid',
												"value"       => array(
																			"grid" => __("Grid","rt_theme_admin"),
																			"masonry" => __("Masonry","rt_theme_admin"),
																		)
											),

											
											array(
												"param_name" => 'pagination',
												"description"=> __('Splits the list into pages.','rt_theme_admin'),
												"default_value" => 'false',
												"value" => array(
																		"true" => __('True','rt_theme_admin'),
																		"false" => __('False','rt_theme_admin'),
																	),
											),

											array(
												'param_name'  => 'ajax_pagination',
												'description' => __( 'Enable ajax pagination (load more). Works with Masonry layout_style only', 'rt_theme_admin' ),
												'type'        => 'checkbox',
												"value"       => "true",
												"dependency"  => array(
																	"element" => "pagination",
																	"value" => array("true")
																),	
											),

											array(
												"param_name" => 'list_orderby',
												"description"=> __('Sorts the posts by this parameter','rt_theme_admin'),
												"default_value" => 'date',
												"value" => array(
																		'author'=>__('Author','rt_theme_admin'),
																		'date'=>__('Date','rt_theme_admin'),
																		'title'=>__('Title','rt_theme_admin'),
																		'modified'=>__('Modified','rt_theme_admin'),
																		'ID'=>__('ID','rt_theme_admin'),
																		'rand'=>__('Randomized','rt_theme_admin'),
																	),
											),	

											array(
												"param_name" => 'list_order',
												"description"=> __("Designates the ascending or descending order of the list_orderby parameter",'rt_theme_admin'),
												"default_value" => 'DESC',
												"value" => array(
																		'ASC'=>__('Ascending','rt_theme_admin'),
																		'DESC'=>__('DESC','rt_theme_admin'), 
																	),
											),				

											array(
												"param_name" => 'item_per_page',
												"description"=> __("Amount of post per page",'rt_theme_admin'),
												"default_value" => '9'
											),

											array(
												"param_name" => 'categories',
												"description"=> __("Category id's seperated by comma. Leave blank to list all categories.",'rt_theme_admin'),
												"default_value" => ''
											),

											array(
												"param_name" => 'ids',
												"description"=> __("Product id's seperated by comma. Leave blank to list all products.",'rt_theme_admin'),
												"default_value" => ''
											),			
		 
											array(
												"param_name" => 'display_titles',
												"description"=> __("Display titles",'rt_theme_admin'),
												"default_value" => 'true',
												"value"       => array(
																		'true' => __('Yes','rt_theme_admin'),
																		'false' => __('No','rt_theme_admin'),
																),
											),

											array(
												"param_name" => 'display_descriptions',
												"description"=> __("Display descriptions.",'rt_theme_admin'),
												"default_value" => 'true',
												"value"       => array(
																		'true' => __('Yes','rt_theme_admin'),
																		'false' => __('No','rt_theme_admin'),
																),
											),

											array(
												"param_name" => 'display_price',
												"description"=> __("Display price",'rt_theme_admin'),
												"default_value" => 'true',
												"value"       => array(
																		'true' => __('Yes','rt_theme_admin'),
																		'false' => __('No','rt_theme_admin'),
																),
											), 

											array(
												'param_name'  => 'featured_image_resize',
												'heading'     => __( 'Resize Featured Images', 'rt_theme_admin' ),
												'description' => __('Enable "Image Resize" to resize or crop the featured images automatically. These settings will be overwrite the global settings. Please note, since the theme is reponsive the images cannot be wider than the column they are in. Leave values "0" to use theme defaults.', 'rt_theme_admin' ),
												'type'        => 'dropdown',
												"default_value" => 'true',
												"value"       => array(
																		"true" => __("Enabled","rt_theme_admin"),
																		"false" => __("Disabled","rt_theme_admin")
																	),
												'group' => __('Featured Images', 'rt_theme_admin')
											),

											array(
												'param_name'  => 'featured_image_max_width',
												'heading'     => __('Featured Image Max Width', 'rt_theme_admin' ),
												'type'        => 'textfield',
												'default_value'       => "0",
												"dependency"  => array(
																	"element" => "featured_image_resize",
																	"value" => array("true")
																),
												'group' => __('Featured Images', 'rt_theme_admin')
											),

											array(
												'param_name'  => 'featured_image_max_height',
												'heading'     => __('Featured Image Max Height', 'rt_theme_admin' ),
												'type'        => 'textfield',
												'default_value'   => "0",
												"dependency"  => array(
																	"element" => "featured_image_resize",
																	"value" => array("true")
																),
												'group' => __('Featured Images', 'rt_theme_admin')
											),

											array(
												'param_name'  => 'featured_image_crop',
												'heading'     => __( 'Crop Featured Images', 'rt_theme_admin' ),
												'type'        => 'dropdown',
												"value"       => array(
																		"true" => __("Enabled","rt_theme_admin"),
																		"false" => __("Disabled","rt_theme_admin")
																),
												'default_value'  => "false",
												"dependency"  => array(
																	"element" => "featured_image_resize",
																	"value" => array("true")
																),								
												'group' => __('Featured Images', 'rt_theme_admin')
											),
										),
					),

					/*
						Product Categories
					*/ 
					"rt_product_categories" => array(
						"name"=> __('Product Categories','rt_theme_admin'),
						"subline" => '',
						"id"=> 'rt_product_categories',
						"desc"=> __('Displays product categories with selected parameters','rt_theme_admin'),
						"open" => true,
						"close" => false,	
						"content" => array(
										"shortcode_id" => '',
										"text" => ''
									),						
						"parameters" => array(
		 

											array(
												"param_name" => 'id',
												"description"=> __("Custom HTML id paramater",'rt_theme_admin'),
												"default_value" => ''
											),										

											array(
												"param_name" => 'class',
												"description"=> __("Custom CSS class name",'rt_theme_admin'),
												"default_value" => ''
											),								

											array(
												'param_name'  => 'list_layout',
												'heading'     => __( 'Layout', 'rt_theme_admin' ),
												"description" => __("Column layout for the list",'rt_theme_admin'),
												'type'        => 'dropdown',
												"value"       => array(
																	"1/6" => "1/6", 
																	"1/4" => "1/4",
																	"1/3" => "1/3",
																	"1/2" => "1/2",
																	"1/1" => "1/1"
																)
											),

											array(
												'param_name'  => 'layout_style',
												'heading'     => __( 'Layout Style', 'rt_theme_admin' ),
												"description" => __("Design of the layout",'rt_theme_admin'),
												'type'        => 'dropdown',
												"value"       => array(
																	__("Grid","rt_theme_admin") => "grid",
																	__("Masonry","rt_theme_admin") => "masonry" 
																)
											),

											array(
												"param_name" => 'orderby',
												"description"=> __('Sorts the categories by this parameter','rt_theme_admin'),
												"default_value" => 'id',
												"possible_values" => array(
																		'id'    => __('ID','rt_theme_admin'),
																		'name'  => __('Name','rt_theme_admin'),
																		'slug'  => __('Slug','rt_theme_admin'),
																		'count' => __('Count','rt_theme_admin')																
																	),
											),	
											array(
												"param_name" => 'order',
												"description"=> __("Designates the ascending or descending order of the orderby parameter",'rt_theme_admin'),
												"default_value" => 'DESC',
												"possible_values" => array(
																		'asc'=>__('Ascending','rt_theme_admin'),
																		'desc'=>__('Descending','rt_theme_admin'), 
																	),
											),		

											array(
												"param_name" => 'ids',
												"description"=> __("Product category id's splitted by comma. Leave blank to list all products categories.",'rt_theme_admin'),
												"default_value" => ''
											),
		 
											array(
												"param_name" => 'parent',
												"description"=> __("Parent category id. Lists only the subcategories of the parent category id",'rt_theme_admin'),
												"default_value" => ''
											),

											array(
												"param_name" => 'image_max_height',
												"description"=> __("Maximum image height for the category thumbnails. Leaave blank for defaults.",'rt_theme_admin'),
												"default_value" => '',
											),

											array(
												"param_name" => 'crop',
												"description"=> __("Crop category thumbnails. Crops the images according the 'image_max_height' value.",'rt_theme_admin'),
												"default_value" => '',
												"possible_values" => array(
																		''=>__('leave blank for false','rt_theme_admin'),
																		'true'=>__('True','rt_theme_admin'), 
																	),
											),

											array(
												"param_name" => 'display_titles',
												"description"=> __("Display titles",'rt_theme_admin'),
												"default_value" => 'true',
												"possible_values" => array(
																		''=>__('leave blank for false','rt_theme_admin'),
																		'true'=>__('True','rt_theme_admin'), 
																	),
											),

											array(
												"param_name" => 'display_descriptions',
												"description"=> __("Display descriptions.",'rt_theme_admin'),
												"default_value" => 'true',
												"possible_values" => array(
																		''=>__('leave blank for false','rt_theme_admin'),
																		'true'=>__('True','rt_theme_admin'), 
																	),
											),

											array(
												"param_name" => 'display_thumbnails',
												"description"=> __("Display thumbnails.",'rt_theme_admin'),
												"default_value" => 'true',
												"possible_values" => array(
																		''=>__('leave blank for false','rt_theme_admin'),
																		'true'=>__('True','rt_theme_admin'), 
																	),
											),

										),
					),

					/*
						Woo Product Posts
					*/ 
					"woo_products" => array(
						"name"=> __('WooCommerce Products','rt_theme_admin'),
						"subline" => '',
						"id"=> 'woo_products',
						"description"=> __('Displays woocommerce products with selected parameters','rt_theme_admin'),
						"open" => true,
						"close" => false,	
						"content" => array(
										"shortcode_id" => '',
										"text" => ''
									),						
						"parameters" => array(

											array(
												'param_name'  => 'id',
												'description' => __('Unique ID', 'rt_theme_admin' ),
											),

											array(
												'param_name'  => 'class',
												'description' => __('CSS Class Name', 'rt_theme_admin' ),
											),

											array(
												"param_name" => 'list_layout',
												"description"=> __('Column layout for the list','rt_theme_admin'),
												"default_value" => '1/4',
												"value" => array(
																			"1/6" => "1/6 columns", 
																			"1/4" => "1/4 columns",
																			"1/3" => "1/3 columns",
																			"1/2" => "1/2 columns",
																			"1/1" => "1/1 column"												
																	),
											),

											array(
												"param_name" => 'pagination',
												"description"=> __('Splits the list into pages.','rt_theme_admin'),
												"default_value" => 'false',
												"value" => array(
																		"true" => __('True','rt_theme_admin'),
																		"false" => __('False','rt_theme_admin'),
																	),
											),

											array(
												"param_name" => 'list_orderby',
												"description"=> __('Sorts the posts by this parameter','rt_theme_admin'),
												"default_value" => 'date',
												"value" => array(
																		'author'=>__('Author','rt_theme_admin'),
																		'date'=>__('Date','rt_theme_admin'),
																		'title'=>__('Title','rt_theme_admin'),
																		'modified'=>__('Modified','rt_theme_admin'),
																		'ID'=>__('ID','rt_theme_admin'),
																		'rand'=>__('Randomized','rt_theme_admin'),
																	),
											),	

											array(
												"param_name" => 'list_order',
												"description"=> __("Designates the ascending or descending order of the list_orderby parameter",'rt_theme_admin'),
												"default_value" => 'DESC',
												"value" => array(
																		'ASC'=>__('Ascending','rt_theme_admin'),
																		'DESC'=>__('DESC','rt_theme_admin'), 
																	),
											),			

											array(
												"param_name" => 'item_per_page',
												"description"=> __("Amount of post per page",'rt_theme_admin'),
												"default_value" => '9'
											),

											array(
												"param_name" => 'categories',
												"description"=> __("Category slug names seperated by comma. Leave blank to list all categories.",'rt_theme_admin'),
												"default_value" => ''
											),

											array(
												"param_name" => 'ids',
												"description"=> __("Product id's seperated by comma. Leave blank to list all products.",'rt_theme_admin'),
												"default_value" => ''
											),			

										),
					),
					
					/*
						Staff Posts
					*/ 
					"staff_box" => array(
						"name"=> __('Team Posts','rt_theme_admin'),
						"subline" => '',
						"id"=> 'staff_box',
						"description"=> __('Displays team posts with selected parameters','rt_theme_admin'),
						"open" => true,
						"close" => false,	
						"content" => array(
										"shortcode_id" => '',
										"text" => ''
									),						
						"parameters" => array(


											array(
												'param_name'  => 'id',
												'description' => __('Unique ID', 'rt_theme_admin' ),
											),

											array(
												'param_name'  => 'class',
												'description' => __('CSS Class Name', 'rt_theme_admin' ),
											),

											array(
												"param_name" => 'list_layout',
												"description"=> __('Column layout for the list','rt_theme_admin'),
												"default_value" => '1/4',
												"value" => array(
																			"1/6" => "1/6 columns", 
																			"1/4" => "1/4 columns",
																			"1/3" => "1/3 columns",
																			"1/2" => "1/2 columns",
																			"1/1" => "1/1 column"												
																	),
											),

											array(
												"param_name" => 'pagination',
												"description"=> __('Splits the list into pages.','rt_theme_admin'),
												"default_value" => 'false',
												"value" => array(
																		"true" => __('True','rt_theme_admin'),
																		"false" => __('False','rt_theme_admin'),
																	),
											),

											array(
												"param_name" => 'list_orderby',
												"description"=> __('Sorts the posts by this parameter','rt_theme_admin'),
												"default_value" => 'date',
												"value" => array(
																		'author'=>__('Author','rt_theme_admin'),
																		'date'=>__('Date','rt_theme_admin'),
																		'title'=>__('Title','rt_theme_admin'),
																		'modified'=>__('Modified','rt_theme_admin'),
																		'ID'=>__('ID','rt_theme_admin'),
																		'rand'=>__('Randomized','rt_theme_admin'),
																	),
											),	
											
											array(
												"param_name" => 'list_order',
												"description"=> __("Designates the ascending or descending order of the list_orderby parameter",'rt_theme_admin'),
												"default_value" => 'DESC',
												"value" => array(
																		'ASC'=>__('Ascending','rt_theme_admin'),
																		'DESC'=>__('DESC','rt_theme_admin'), 
																	),
											),								
																			
											array(
												"param_name" => 'ids',
												"description"=> __("Team id's seperated by comma. Leave blank to list all.",'rt_theme_admin'),
												"default_value" => ''
											),									

										),
					),

					/*
						Testimonials Posts
					*/ 

					"testimonial_box" => array(
						"name"=> __('Testimonials Posts','rt_theme_admin'),
						"subline" => '',
						"id"=> 'testimonial_box',
						"description"=> __('Displays Testimonial posts with selected parameters','rt_theme_admin'),
						"open" => true,
						"close" => false,	
						"content" => array(
										"shortcode_id" => '',
										"text" => ''
									),						
						"parameters" => array(


											array(
												'param_name'  => 'id',
												'description' => __('Unique ID', 'rt_theme_admin' ),
											),

											array(
												'param_name'  => 'class',
												'description' => __('CSS Class Name', 'rt_theme_admin' ),
											),

											array(
												"param_name" => 'list_layout',
												"description"=> __('Column layout for the list','rt_theme_admin'),
												"default_value" => '1/1',
												"value" => array(
																			"1/6" => "1/6 columns", 
																			"1/4" => "1/4 columns",
																			"1/3" => "1/3 columns",
																			"1/2" => "1/2 columns",
																			"1/1" => "1/1 column"												
																	),
											),

				 							array(
												'param_name'  => 'style',
												'heading'     => __( 'Style', 'rt_theme_admin' ),
												'type'        => 'dropdown',
												"default_value" => 'left',
												"value"       => array(
																	"left" => __("Left Aligned Text","rt_theme_admin"),
																	"center" => __("Centered Small Text ","rt_theme_admin"),
																	"center big" => __("Centered Big Text ","rt_theme_admin"),
																),
											),

											
											array(
												'param_name'  => 'client_images',
												'heading'     => __( 'Display Client Images', 'rt_theme_admin' ),
												'type'        => 'dropdown',
												"default_value" => 'true',
												"value" => array(
																		"true" => __('True','rt_theme_admin'),
																		"false" => __('False','rt_theme_admin'),
																	),			
											),

											array(
												"param_name" => 'pagination',
												"description"=> __('Splits the list into pages.','rt_theme_admin'),
												"default_value" => 'false',
												"value" => array(
																		"true" => __('True','rt_theme_admin'),
																		"false" => __('False','rt_theme_admin'),
																	),
											),

											array(
												"param_name" => 'list_orderby',
												"description"=> __('Sorts the posts by this parameter','rt_theme_admin'),
												"default_value" => 'date',
												"value" => array(
																		'author'=>__('Author','rt_theme_admin'),
																		'date'=>__('Date','rt_theme_admin'),
																		'title'=>__('Title','rt_theme_admin'),
																		'modified'=>__('Modified','rt_theme_admin'),
																		'ID'=>__('ID','rt_theme_admin'),
																		'rand'=>__('Randomized','rt_theme_admin'),
																	),
											),	
											array(
												"param_name" => 'list_order',
												"description"=> __("Designates the ascending or descending order of the list_orderby parameter",'rt_theme_admin'),
												"default_value" => 'DESC',
												"value" => array(
																		'ASC'=>__('Ascending','rt_theme_admin'),
																		'DESC'=>__('DESC','rt_theme_admin'), 
																	),
											),																							
											array(
												"param_name" => 'ids',
												"description"=> __("Testimonial id's splitted by comma. Leave blank to list all.",'rt_theme_admin'),
												"default_value" => ''
											),		

											array(
												"param_name" => 'categories',
												"description"=> __("Category id's seperated by comma. Leave blank to list all categories.",'rt_theme_admin'),
												"default_value" => ''
											),
																				
											array(
												"param_name" => 'item_per_page',
												"description"=> __("Amount of post per page",'rt_theme_admin'),
												"default_value" => '9'
											),
											
											array(
												"param_name" => 'pagination',
												"description"=> __('Splits the list into pages.','rt_theme_admin'),
												"default_value" => 'false',
												"value" => array(
																		"true" => __('True','rt_theme_admin'),
																		"false" => __('False','rt_theme_admin'),
																	),
											),
										),
					),


					/*
						Product Carousel
					*/ 
					"product_carousel" => array(
						"name"=> __('Product Carousel','rt_theme_admin'),
						"subline" => '',
						"id"=> 'product_carousel',
						"description"=> __('Displays product posts with selected parameters as a carousel','rt_theme_admin'),
						"open" => true,
						"close" => false,	
						"content" => array(
										"shortcode_id" => '',
										"text" => ''
									),						
						"parameters" => array(


											array(
												'param_name'  => 'id',
												'description' => __('Unique ID', 'rt_theme_admin' ),
											),

											array(
												'param_name'  => 'class',
												'description' => __('CSS Class Name', 'rt_theme_admin' ),
											),

											array(
												"param_name" => 'list_layout',
												"description"=> __('Column layout for the list','rt_theme_admin'),
												"default_value" => '1/3',
												"value" => array(
																			"1/6" => "1/6 columns", 
																			"1/4" => "1/4 columns",
																			"1/3" => "1/3 columns",
																			"1/2" => "1/2 columns",
																			"1/1" => "1/1 column"												
																	),
											),

											array(
												"param_name" => 'max_item',
												"description"=> __("Amount of post to display",'rt_theme_admin'),
												"default_value" => '100'
											),

											array(
												'param_name'  => 'nav',
												'heading'     => __( 'Navigation Arrows', 'rt_theme_admin' ),
												"default_value" => 'true',
												'type'        => 'dropdown',
												"value"       => array(
																		"true" => __("Enabled","rt_theme_admin"),
																		"false" => __("Disabled","rt_theme_admin")												
																	)						
											),

											array(
												'param_name'  => 'dots',
												'heading'     => __( 'Navigation Dots', 'rt_theme_admin' ),
												'type'        => 'dropdown',
												"default_value" => 'true',
												"value"       => array(
																		"true" => __("Enabled","rt_theme_admin"),
																		"false" => __("Disabled","rt_theme_admin")												
																	)						
											),

											array(
												'param_name'  => 'autoplay',
												'heading'     => __( 'Auto Play', 'rt_theme_admin' ),
												'type'        => 'dropdown',
												"value"       => array(												
																		"true" => __("Enabled","rt_theme_admin"),
																		"false" => __("Disabled","rt_theme_admin")				
																)						
											),

											array(
												'param_name'  => 'timeout',
												'heading'     => __('Auto Play Speed (ms)', 'rt_theme_admin' ),
												'type'        => 'rt_number',
												'value'       => "",
												"description" => __("Auto play speed value in milliseconds. For example; set 5000 for 5 seconds",'rt_theme_admin'),
												"dependency"  => array(
																		"element" => "autoplay",
																		"value" => array("true")
																	),
											),

											array(
												"param_name" => 'categories',
												"description"=> __("Category id's splitted by comma. Leave blank to list all categories.",'rt_theme_admin'),
												"default_value" => ''
											),
											array(
												"param_name" => 'ids',
												"description"=> __("Product id's splitted by comma. Leave blank to list all products.",'rt_theme_admin'),
												"default_value" => ''
											),									

				
											array(
												"param_name" => 'list_orderby',
												"description"=> __('Sorts the posts by this parameter','rt_theme_admin'),
												"default_value" => 'date',
												"value" => array(
																		'author'=>__('Author','rt_theme_admin'),
																		'date'=>__('Date','rt_theme_admin'),
																		'title'=>__('Title','rt_theme_admin'),
																		'modified'=>__('Modified','rt_theme_admin'),
																		'ID'=>__('ID','rt_theme_admin'),
																		'rand'=>__('Randomized','rt_theme_admin'),
																	),
											),	
											array(
												"param_name" => 'list_order',
												"description"=> __("Designates the ascending or descending order of the list_orderby parameter",'rt_theme_admin'),
												"default_value" => 'DESC',
												"value" => array(
																		'ASC'=>__('Ascending','rt_theme_admin'),
																		'DESC'=>__('DESC','rt_theme_admin'), 
																	),
											),										

											array(
												"param_name" => 'display_titles',
												"description"=> __("Display titles",'rt_theme_admin'),
												"default_value" => 'true',
												"value"       => array(
																		'true' => __('Yes','rt_theme_admin'),
																		'false' => __('No','rt_theme_admin'),
																),
											),

											array(
												"param_name" => 'display_descriptions',
												"description"=> __("Display descriptions.",'rt_theme_admin'),
												"default_value" => 'true',
												"value"       => array(
																		'true' => __('Yes','rt_theme_admin'),
																		'false' => __('No','rt_theme_admin'),
																),
											),

											array(
												"param_name" => 'display_price',
												"description"=> __("Display price",'rt_theme_admin'),
												"default_value" => 'true',
												"value"       => array(
																		'true' => __('Yes','rt_theme_admin'),
																		'false' => __('No','rt_theme_admin'),
																),
											), 

											array(
												'param_name'  => 'featured_image_max_width',
												'heading'     => __('Featured Image Max Width', 'rt_theme_admin' ),
												'type'        => 'textfield',
												'default_value'       => "0",
												"dependency"  => array(
																	"element" => "featured_image_resize",
																	"value" => array("true")
																),
												'group' => __('Featured Images', 'rt_theme_admin')
											),

											array(
												'param_name'  => 'featured_image_max_height',
												'heading'     => __('Featured Image Max Height', 'rt_theme_admin' ),
												'type'        => 'textfield',
												'default_value'   => "0",
												"dependency"  => array(
																	"element" => "featured_image_resize",
																	"value" => array("true")
																),
												'group' => __('Featured Images', 'rt_theme_admin')
											),

											array(
												'param_name'  => 'featured_image_crop',
												'heading'     => __( 'Crop Featured Images', 'rt_theme_admin' ),
												'type'        => 'dropdown',
												"value"       => array(
																		"true" => __("Enabled","rt_theme_admin"),
																		"false" => __("Disabled","rt_theme_admin")
																),
												'default_value'  => "false",
												"dependency"  => array(
																	"element" => "featured_image_resize",
																	"value" => array("true")
																),								
												'group' => __('Featured Images', 'rt_theme_admin')
											),


										),
					),



					/*
						WC Product Carousel
					*/ 
					"woo_product_carousel" => array(
						"name"=> __('WooCommerce Product Carousel','rt_theme_admin'),
						"subline" => '',
						"id"=> 'woo_product_carousel',
						"description"=> __('Displays product posts with selected parameters as a carousel','rt_theme_admin'),
						"open" => true,
						"close" => false,	
						"content" => array(
										"shortcode_id" => '',
										"text" => ''
									),						
						"parameters" => array(


											array(
												'param_name'  => 'id',
												'description' => __('Unique ID', 'rt_theme_admin' ),
											),

											array(
												"param_name" => 'list_layout',
												"description"=> __('Column layout for the list','rt_theme_admin'),
												"default_value" => '1/3',
												"value" => array(
																			"1/6" => "1/6 columns", 
																			"1/4" => "1/4 columns",
																			"1/3" => "1/3 columns",
																			"1/2" => "1/2 columns",
																			"1/1" => "1/1 column"												
																	),
											),

											array(
												"param_name" => 'max_item',
												"description"=> __("Amount of post to display",'rt_theme_admin'),
												"default_value" => '10'
											),

											array(
												'param_name'  => 'nav',
												'heading'     => __( 'Navigation Arrows', 'rt_theme_admin' ),
												"default_value" => 'true',
												'type'        => 'dropdown',
												"value"       => array(
																		"true" => __("Enabled","rt_theme_admin"),
																		"false" => __("Disabled","rt_theme_admin")												
																	)						
											),

											array(
												'param_name'  => 'dots',
												'heading'     => __( 'Navigation Dots', 'rt_theme_admin' ),
												'type'        => 'dropdown',
												"default_value" => 'true',
												"value"       => array(
																		"true" => __("Enabled","rt_theme_admin"),
																		"false" => __("Disabled","rt_theme_admin")												
																	)						
											),

											array(
												'param_name'  => 'autoplay',
												'heading'     => __( 'Auto Play', 'rt_theme_admin' ),
												'type'        => 'dropdown',
												"value"       => array(												
																		"true" => __("Enabled","rt_theme_admin"),
																		"false" => __("Disabled","rt_theme_admin")				
																)						
											),

											array(
												'param_name'  => 'timeout',
												'heading'     => __('Auto Play Speed (ms)', 'rt_theme_admin' ),
												'type'        => 'rt_number',
												'value'       => "",
												"description" => __("Auto play speed value in milliseconds. For example; set 5000 for 5 seconds",'rt_theme_admin'),
												"dependency"  => array(
																		"element" => "autoplay",
																		"value" => array("true")
																	),
											),

											array(
												"param_name" => 'categories',
												"description"=> __("Category id's splitted by comma. Leave blank to list all categories.",'rt_theme_admin'),
												"default_value" => ''
											),
											array(
												"param_name" => 'ids',
												"description"=> __("Product id's splitted by comma. Leave blank to list all products.",'rt_theme_admin'),
												"default_value" => ''
											),									

				
											array(
												"param_name" => 'list_orderby',
												"description"=> __('Sorts the posts by this parameter','rt_theme_admin'),
												"default_value" => 'date',
												"value" => array(
																		'author'=>__('Author','rt_theme_admin'),
																		'date'=>__('Date','rt_theme_admin'),
																		'title'=>__('Title','rt_theme_admin'),
																		'modified'=>__('Modified','rt_theme_admin'),
																		'ID'=>__('ID','rt_theme_admin'),
																		'rand'=>__('Randomized','rt_theme_admin'),
																	),
											),	
											array(
												"param_name" => 'list_order',
												"description"=> __("Designates the ascending or descending order of the list_orderby parameter",'rt_theme_admin'),
												"default_value" => 'DESC',
												"value" => array(
																		'ASC'=>__('Ascending','rt_theme_admin'),
																		'DESC'=>__('DESC','rt_theme_admin'), 
																	),
											),										

										),
					),
					/*
						Portfolio Carousel
					*/ 
					"portfolio_carousel" => array(
						"name"=> __('Portfolio Carousel','rt_theme_admin'),
						"subline" => '',
						"id"=> 'product_carousel',
						"description"=> __('Displays portfolio posts with selected parameters as a carousel','rt_theme_admin'),
						"open" => true,
						"close" => false,	
						"content" => array(
										"shortcode_id" => '',
										"text" => ''
									),						
						"parameters" => array(

											array(
												'param_name'  => 'id',
												'description' => __('Unique ID', 'rt_theme_admin' ),
											),

											array(
												'param_name'  => 'class',
												'description' => __('CSS Class Name', 'rt_theme_admin' ),
											),

											array(
												"param_name" => 'list_layout',
												"description"=> __('Column layout for the list','rt_theme_admin'),
												"default_value" => '1/3',
												"value" => array(
																			"1/6" => "1/6 columns", 
																			"1/4" => "1/4 columns",
																			"1/3" => "1/3 columns",
																			"1/2" => "1/2 columns",
																			"1/1" => "1/1 column"												
																	),
											),

											array(
												'param_name'  => 'item_style',
												'heading'     => __( 'Item Style', 'rt_theme_admin' ),
												"description" => __("Select a style for the portfolio item in listing pages & categories.",'rt_theme_admin'),
												'type'        => 'dropdown',
												"default_value" => 'style-1',
												"value"       => array(
																	"style-1" => __("Style 1 - Info under the featured image","rt_theme_admin"),
																	"style-2" => __("Style 2 - Info embedded to the featured image ","rt_theme_admin")
																)
											),

											array(
												"param_name" => 'max_item',
												"description"=> __("Amount of post to display",'rt_theme_admin'),
												"default_value" => '100'
											),

											array(
												'param_name'  => 'nav',
												'heading'     => __( 'Navigation Arrows', 'rt_theme_admin' ),
												"default_value" => 'true',
												'type'        => 'dropdown',
												"value"       => array(
																		"true" => __("Enabled","rt_theme_admin"),
																		"false" => __("Disabled","rt_theme_admin")												
																	)						
											),

											array(
												'param_name'  => 'dots',
												'heading'     => __( 'Navigation Dots', 'rt_theme_admin' ),
												'type'        => 'dropdown',
												"default_value" => 'true',
												"value"       => array(
																		"true" => __("Enabled","rt_theme_admin"),
																		"false" => __("Disabled","rt_theme_admin")												
																	)						
											),

											array(
												'param_name'  => 'autoplay',
												'heading'     => __( 'Auto Play', 'rt_theme_admin' ),
												'type'        => 'dropdown',
												"value"       => array(												
																		"true" => __("Enabled","rt_theme_admin"),
																		"false" => __("Disabled","rt_theme_admin")				
																)						
											),

											array(
												'param_name'  => 'timeout',
												'heading'     => __('Auto Play Speed (ms)', 'rt_theme_admin' ),
												'type'        => 'rt_number',
												'value'       => "",
												"description" => __("Auto play speed value in milliseconds. For example; set 5000 for 5 seconds",'rt_theme_admin'),
												"dependency"  => array(
																		"element" => "autoplay",
																		"value" => array("true")
																	),
											),

											array(
												"param_name" => 'categories',
												"description"=> __("Category id's seperated by comma. Leave blank to list all categories.",'rt_theme_admin'),
												"default_value" => ''
											),
											array(
												"param_name" => 'ids',
												"description"=> __("Product id's seperated by comma. Leave blank to list all products.",'rt_theme_admin'),
												"default_value" => ''
											),									

				
											array(
												"param_name" => 'list_orderby',
												"description"=> __('Sorts the posts by this parameter','rt_theme_admin'),
												"default_value" => 'date',
												"value" => array(
																		'author'=>__('Author','rt_theme_admin'),
																		'date'=>__('Date','rt_theme_admin'),
																		'title'=>__('Title','rt_theme_admin'),
																		'modified'=>__('Modified','rt_theme_admin'),
																		'ID'=>__('ID','rt_theme_admin'),
																		'rand'=>__('Randomized','rt_theme_admin'),
																	),
											),	
											array(
												"param_name" => 'list_order',
												"description"=> __("Designates the ascending or descending order of the list_orderby parameter",'rt_theme_admin'),
												"default_value" => 'DESC',
												"value" => array(
																		'ASC'=>__('Ascending','rt_theme_admin'),
																		'DESC'=>__('DESC','rt_theme_admin'), 
																	),
											),										

											array(
												'param_name'  => 'featured_image_max_width',
												'heading'     => __('Featured Image Max Width', 'rt_theme_admin' ),
												'type'        => 'textfield',
												'default_value'       => "0",
												"dependency"  => array(
																	"element" => "featured_image_resize",
																	"value" => array("true")
																),
												'group' => __('Featured Images', 'rt_theme_admin')
											),

											array(
												'param_name'  => 'featured_image_max_height',
												'heading'     => __('Featured Image Max Height', 'rt_theme_admin' ),
												'type'        => 'textfield',
												'default_value'   => "0",
												"dependency"  => array(
																	"element" => "featured_image_resize",
																	"value" => array("true")
																),
												'group' => __('Featured Images', 'rt_theme_admin')
											),

											array(
												'param_name'  => 'featured_image_crop',
												'heading'     => __( 'Crop Featured Images', 'rt_theme_admin' ),
												'type'        => 'dropdown',
												"value"       => array(
																		"true" => __("Enabled","rt_theme_admin"),
																		"false" => __("Disabled","rt_theme_admin")
																),
												'default_value'  => "false",
												"dependency"  => array(
																	"element" => "featured_image_resize",
																	"value" => array("true")
																),								
												'group' => __('Featured Images', 'rt_theme_admin')
											),
										),	
					),

					/*
						Posts Carousel
					*/ 
					"blog_carousel" => array(
						"name"=> __('Blog Posts Carousel','rt_theme_admin'),
						"subline" => '',
						"id"=> 'blog_carousel',
						"description"=> __('Displays posts with selected parameters as a carousel','rt_theme_admin'),
						"open" => true,
						"close" => false,	
						"content" => array(
										"shortcode_id" => '',
										"text" => ''
									),						
						"parameters" => array(


												array(
													'param_name'  => 'id',
													'description' => __('Unique ID', 'rt_theme_admin' ),
												),

												array(
													'param_name'  => 'class',
													'description' => __('CSS Class Name', 'rt_theme_admin' ),
												),

												array(
													"param_name" => 'list_layout',
													"description"=> __('Column layout for the list','rt_theme_admin'),
													"default_value" => '1/3',
													"value" => array(
																				"1/6" => "1/6 columns", 
																				"1/4" => "1/4 columns",
																				"1/3" => "1/3 columns",
																				"1/2" => "1/2 columns",
																				"1/1" => "1/1 column"												
																		),
												),


												array(
													'param_name'  => 'use_excerpts',
													'heading'     => __("Excerpts", "rt_theme_admin"),
													"description" => __("As default the full blog content will be displayed for this list.  Enable this option to minify the content automatically by using WordPress's excerpt option.  You can keep disabled and split your content manually by using <a href=\"http://en.support.wordpress.com/splitting-content/more-tag/\">The More Tag</a>",'rt_theme_admin'),
													'type'        => 'dropdown',
													"default_value" => 'true',
													"value"       => array(
																		'true' => __('Yes','rt_theme_admin'),
																		'false' => __('No','rt_theme_admin'),
																	),
												),

												array(
													"param_name" => 'excerpt_length',
													"description"=> __("Excerpt Length",'rt_theme_admin'),
													"default_value" => '100'
												),


												array(
													"param_name" => 'max_item',
													"description"=> __("Amount of post to display",'rt_theme_admin'),
													"default_value" => '10'
												),

												array(
													'param_name'  => 'nav',
													'heading'     => __( 'Navigation Arrows', 'rt_theme_admin' ),
													"default_value" => 'true',
													'type'        => 'dropdown',
													"value"       => array(
																			"true" => __("Enabled","rt_theme_admin"),
																			"false" => __("Disabled","rt_theme_admin")												
																		)						
												),

												array(
													'param_name'  => 'dots',
													'heading'     => __( 'Navigation Dots', 'rt_theme_admin' ),
													'type'        => 'dropdown',
													"default_value" => 'true',
													"value"       => array(
																			"true" => __("Enabled","rt_theme_admin"),
																			"false" => __("Disabled","rt_theme_admin")												
																		)						
												),

												array(
													'param_name'  => 'autoplay',
													'heading'     => __( 'Auto Play', 'rt_theme_admin' ),
													'type'        => 'dropdown',
													"value"       => array(												
																			"true" => __("Enabled","rt_theme_admin"),
																			"false" => __("Disabled","rt_theme_admin")				
																	)						
												),

												array(
													'param_name'  => 'timeout',
													'heading'     => __('Auto Play Speed (ms)', 'rt_theme_admin' ),
													'type'        => 'rt_number',
													'value'       => "",
													"description" => __("Auto play speed value in milliseconds. For example; set 5000 for 5 seconds",'rt_theme_admin'),
													"dependency"  => array(
																			"element" => "autoplay",
																			"value" => array("true")
																		),
												),

												array(
													"param_name" => 'categories',
													"description"=> __("Category id's seperated by comma. Leave blank to list all categories.",'rt_theme_admin'),
													"default_value" => ''
												),
												array(
													"param_name" => 'ids',
													"description"=> __("Product id's seperated by comma. Leave blank to list all products.",'rt_theme_admin'),
													"default_value" => ''
												),									

					
												array(
													"param_name" => 'list_orderby',
													"description"=> __('Sorts the posts by this parameter','rt_theme_admin'),
													"default_value" => 'date',
													"value" => array(
																			'author'=>__('Author','rt_theme_admin'),
																			'date'=>__('Date','rt_theme_admin'),
																			'title'=>__('Title','rt_theme_admin'),
																			'modified'=>__('Modified','rt_theme_admin'),
																			'ID'=>__('ID','rt_theme_admin'),
																			'rand'=>__('Randomized','rt_theme_admin'),
																		),
												),	
												array(
													"param_name" => 'list_order',
													"description"=> __("Designates the ascending or descending order of the list_orderby parameter",'rt_theme_admin'),
													"default_value" => 'DESC',
													"value" => array(
																			'ASC'=>__('Ascending','rt_theme_admin'),
																			'DESC'=>__('DESC','rt_theme_admin'), 
																		),
												),										

												array(
													'param_name'  => 'show_date',
													'heading'     => __("Display Date", "rt_theme_admin"),
													'type'        => 'dropdown',
													"default_value" => 'true',
													"value"       => array(
																			'true' => __('Yes','rt_theme_admin'),
																			'false' => __('No','rt_theme_admin'),
																	),
													'group'       => __('Post Meta', 'rt_theme_admin')
												),

												array(
													'param_name'  => 'show_author',
													'heading'     => __("Display Post Author", "rt_theme_admin"),
													'type'        => 'dropdown',
													"default_value" => 'true',
													"value"       => array(
																			'true' => __('Yes','rt_theme_admin'),
																			'false' => __('No','rt_theme_admin'),
																	),
													'group'       => __('Post Meta', 'rt_theme_admin')
												),

												array(
													'param_name'  => 'show_categories',
													'heading'     => __("Display Categories", "rt_theme_admin"),
													'type'        => 'dropdown',
													"default_value" => 'true',
													"value"       => array(
																			'true' => __('Yes','rt_theme_admin'),
																			'false' => __('No','rt_theme_admin'),
																	),
													'group'       => __('Post Meta', 'rt_theme_admin')
												),

												array(
													'param_name'  => 'show_comment_numbers',
													'heading'     => __("Display Comment Numbers", "rt_theme_admin"),
													'type'        => 'dropdown',
													"default_value" => 'true',
													"value"       => array(
																			'true' => __('Yes','rt_theme_admin'),
																			'false' => __('No','rt_theme_admin'),
																	),
													'group'       => __('Post Meta', 'rt_theme_admin')
												),

												array(
													'param_name'  => 'featured_image_max_width',
													'heading'     => __('Featured Image Max Width', 'rt_theme_admin' ),
													'type'        => 'textfield',
													'default_value'       => "0",
													"dependency"  => array(
																		"element" => "featured_image_resize",
																		"value" => array("true")
																	),
													'group' => __('Featured Images', 'rt_theme_admin')
												),

												array(
													'param_name'  => 'featured_image_max_height',
													'heading'     => __('Featured Image Max Height', 'rt_theme_admin' ),
													'type'        => 'textfield',
													'default_value'   => "0",
													"dependency"  => array(
																		"element" => "featured_image_resize",
																		"value" => array("true")
																	),
													'group' => __('Featured Images', 'rt_theme_admin')
												),

												array(
													'param_name'  => 'featured_image_crop',
													'heading'     => __( 'Crop Featured Images', 'rt_theme_admin' ),
													'type'        => 'dropdown',
													"value"       => array(
																			"true" => __("Enabled","rt_theme_admin"),
																			"false" => __("Disabled","rt_theme_admin")
																	),
													'default_value'  => "false",
													"dependency"  => array(
																		"element" => "featured_image_resize",
																		"value" => array("true")
																	),								
													'group' => __('Featured Images', 'rt_theme_admin')
												),

										),
					),

					/*
						Testimonials Carousel
					*/  

					"testimonial_carousel" => array(
						"name"=> __('Testimonials Carousel','rt_theme_admin'),
						"subline" => '',
						"id"=> 'testimonial_carousel',
						"description"=> __('Displays Testimonial posts with selected parameters as a caroulel','rt_theme_admin'),
						"open" => true,
						"close" => false,	
						"content" => array(
										"shortcode_id" => '',
										"text" => ''
									),						
						"parameters" => array(

											array(
												'param_name'  => 'id',
												'description' => __('Unique ID', 'rt_theme_admin' ),
											),

											array(
												"param_name" => 'list_layout',
												"description"=> __('Column layout for the list','rt_theme_admin'),
												"default_value" => '1/3',
												"value" => array(
																			"1/6" => "1/6 columns", 
																			"1/4" => "1/4 columns",
																			"1/3" => "1/3 columns",
																			"1/2" => "1/2 columns",
																			"1/1" => "1/1 column"												
																	),
											),

											array(
												"param_name" => 'max_item',
												"description"=> __("Amount of post to display",'rt_theme_admin'),
												"default_value" => '10'
											),

				 							array(
												'param_name'  => 'style',
												'heading'     => __( 'Style', 'rt_theme_admin' ),
												'type'        => 'dropdown',
												"default_value" => 'left',
												"value"       => array(
																	"left" => __("Left Aligned Text","rt_theme_admin"),
																	"center" => __("Centered Small Text ","rt_theme_admin"),
																	"center big" => __("Centered Big Text ","rt_theme_admin"),
																),
											),

											array(
												'param_name'  => 'client_images',
												'heading'     => __( 'Display Client Images', 'rt_theme_admin' ),
												'type'        => 'dropdown',
												"default_value" => 'true',
												"value" => array(
																		"true" => __('True','rt_theme_admin'),
																		"false" => __('False','rt_theme_admin'),
																	),			
											),

											array(
												'param_name'  => 'nav',
												'heading'     => __( 'Navigation Arrows', 'rt_theme_admin' ),
												"default_value" => 'true',
												'type'        => 'dropdown',
												"value"       => array(
																		"true" => __("Enabled","rt_theme_admin"),
																		"false" => __("Disabled","rt_theme_admin")												
																	)						
											),

											array(
												'param_name'  => 'dots',
												'heading'     => __( 'Navigation Dots', 'rt_theme_admin' ),
												'type'        => 'dropdown',
												"default_value" => 'true',
												"value"       => array(
																		"true" => __("Enabled","rt_theme_admin"),
																		"false" => __("Disabled","rt_theme_admin")												
																	)						
											),

											array(
												'param_name'  => 'autoplay',
												'heading'     => __( 'Auto Play', 'rt_theme_admin' ),
												'type'        => 'dropdown',
												"value"       => array(												
																		"true" => __("Enabled","rt_theme_admin"),
																		"false" => __("Disabled","rt_theme_admin")				
																)						
											),

											array(
												'param_name'  => 'timeout',
												'heading'     => __('Auto Play Speed (ms)', 'rt_theme_admin' ),
												'type'        => 'rt_number',
												'value'       => "",
												"description" => __("Auto play speed value in milliseconds. For example; set 5000 for 5 seconds",'rt_theme_admin'),
												"dependency"  => array(
																		"element" => "autoplay",
																		"value" => array("true")
																	),
											),

											array(
												"param_name" => 'categories',
												"description"=> __("Category id's seperated by comma. Leave blank to list all categories.",'rt_theme_admin'),
												"default_value" => ''
											),
											array(
												"param_name" => 'ids',
												"description"=> __("Product id's seperated by comma. Leave blank to list all products.",'rt_theme_admin'),
												"default_value" => ''
											),									

				
											array(
												"param_name" => 'list_orderby',
												"description"=> __('Sorts the posts by this parameter','rt_theme_admin'),
												"default_value" => 'date',
												"value" => array(
																		'author'=>__('Author','rt_theme_admin'),
																		'date'=>__('Date','rt_theme_admin'),
																		'title'=>__('Title','rt_theme_admin'),
																		'modified'=>__('Modified','rt_theme_admin'),
																		'ID'=>__('ID','rt_theme_admin'),
																		'rand'=>__('Randomized','rt_theme_admin'),
																	),
											),	
											array(
												"param_name" => 'list_order',
												"description"=> __("Designates the ascending or descending order of the list_orderby parameter",'rt_theme_admin'),
												"default_value" => 'DESC',
												"value" => array(
																		'ASC'=>__('Ascending','rt_theme_admin'),
																		'DESC'=>__('DESC','rt_theme_admin'), 
																	),
											),										

											array(
												"param_name" => 'display_titles',
												"description"=> __("Display titles",'rt_theme_admin'),
												"default_value" => 'true',
												"value"       => array(
																		'true' => __('Yes','rt_theme_admin'),
																		'false' => __('No','rt_theme_admin'),
																),
											),

											array(
												"param_name" => 'display_descriptions',
												"description"=> __("Display descriptions.",'rt_theme_admin'),
												"default_value" => 'true',
												"value"       => array(
																		'true' => __('Yes','rt_theme_admin'),
																		'false' => __('No','rt_theme_admin'),
																),
											),

											array(
												"param_name" => 'display_price',
												"description"=> __("Display price",'rt_theme_admin'),
												"default_value" => 'true',
												"value"       => array(
																		'true' => __('Yes','rt_theme_admin'),
																		'false' => __('No','rt_theme_admin'),
																),
											), 
						
										),
					),


					/*
						Image Carousel
					*/  

					"rt_image_carousel" => array(
						"name"=> __('Image Carousel','rt_theme_admin'),
						"subline" => '',
						"id"=> 'rt_image_carousel',
						"description"=> __('Displays selected images as a carousel','rt_theme_admin'),
						"open" => true,
						"close" => false,	
						"content" => array(
										"shortcode_id" => '',
										"text" => ''
									),						
						"parameters" => array(

													array(
														'param_name'  => 'images',
														'heading'     => __('Images', 'rt_theme_admin' ),
														'description' => __('Type image IDs for the carousel', 'rt_theme_admin' ),
														'type'        => 'attach_images'
													),

													array(
														'param_name'  => 'carousel_layout',
														'heading'     => __( 'Carousel Layout', 'rt_theme_admin' ),
														"description" => __("Visible image count for each slide",'rt_theme_admin'),
														'type'        => 'dropdown',
														'default_value' => "4",
														"value"       => array(
																			"1" => "1",
																			"2" => "2",													
																			"3" => "3",													
																			"4" => "4",													
																			"5" => "5",													
																			"6" => "6",													
																			"7" => "7",													
																			"8" => "8",													
																			"9" => "9", 
																			"10" => "10"
																		)
													),

													array(
														'param_name'  => 'img_width',
														'heading'     => __('Max Image Width', 'rt_theme_admin' ),
														'description' => __('Set an maximum width value for the carousel images. Note: Remember that the carousel width will be fluid.', 'rt_theme_admin' ),
														'type'        => 'rt_number',
														'default_value' => "490",
														'value'       => ''
													),

													array(
														'param_name'  => 'img_height',
														'heading'     => __('Max Image Height', 'rt_theme_admin' ),
														'description' => __('Set an maximum height value for the carousel images.', 'rt_theme_admin' ),
														'type'        => 'rt_number',
														'default_value' => "490",
														'value'       => ''
													),

													array(
														'param_name'  => 'crop',
														'heading'     => __( 'Crop Images', 'rt_theme_admin' ),
														'type'        => 'dropdown',
														'default_value' => "true",
														"value"       => array(
																				"true" => __("Enabled","rt_theme_admin"),
																				"false" => __("Disabled","rt_theme_admin")
																		),
													),

													array(
														'param_name'  => 'links',
														'heading'     => _x('Item Links', 'Admin Panel','rt_theme_admin' ),
														'type'        => 'dropdown',
														"value"       => array(
																			"image" => _x("Orginal Images",'Admin Panel','rt_theme_admin') ,
																			"custom" => _x("Custom Links",'Admin Panel','rt_theme_admin') 
																		),
														'save_always' => true
													),

													array(
														'param_name'  => 'custom_links',
														'heading'     => _x( 'Custom Links', 'Admin Panel','rt_theme_admin' ),
														'description' => _x("Enter links for each image. The links must be seperated by comma.",'Admin Panel','rt_theme_admin'),
														'type'        => 'exploded_textarea',
														"dependency"  => array(
																				"element" => "links",
																				"value" => array("custom")
																			),								
													),

													array(
														'param_name'  => 'link_target',
														'heading'     => _x('Link Target', 'Admin Panel','rt_theme_admin' ),
														'type'        => 'dropdown',
														"value"       => array(
																			"_self" => _x("Same Tab", 'Admin Panel','rt_theme_admin'),
																			"_blank" => _x("New Tab", 'Admin Panel','rt_theme_admin'), 
																		),
														"dependency"  => array(
																				"element" => "links",
																				"value" => array("custom")
																			),											
														'save_always' => true
													),

													array(
														'param_name'  => 'lightbox',
														'heading'     => __( 'Open Orginal Images in Lightbox', 'rt_theme_admin' ),
														'type'        => 'dropdown',
														'default_value' => "true",
														"value"       => array(
																				"true" => __("Enabled","rt_theme_admin"),
																				"false" => __("Disabled","rt_theme_admin")
																		),
													),

													array(
														'param_name'  => 'nav',
														'heading'     => __( 'Navigation Arrows', 'rt_theme_admin' ),
														"default_value" => 'true',
														'type'        => 'dropdown',
														"value"       => array(
																				"true" => __("Enabled","rt_theme_admin"),
																				"false" => __("Disabled","rt_theme_admin")												
																			)						
													),

													array(
														'param_name'  => 'dots',
														'heading'     => __( 'Navigation Dots', 'rt_theme_admin' ),
														'type'        => 'dropdown',
														"default_value" => 'true',
														"value"       => array(
																				"true" => __("Enabled","rt_theme_admin"),
																				"false" => __("Disabled","rt_theme_admin")												
																			)						
													),

													array(
														'param_name'  => 'autoplay',
														'heading'     => __( 'Auto Play', 'rt_theme_admin' ),
														'type'        => 'dropdown',
														"value"       => array(												
																				"true" => __("Enabled","rt_theme_admin"),
																				"false" => __("Disabled","rt_theme_admin")				
																		)						
													),

													array(
														'param_name'  => 'timeout',
														'heading'     => __('Auto Play Speed (ms)', 'rt_theme_admin' ),
														'type'        => 'rt_number',
														'value'       => "",
														"description" => __("Auto play speed value in milliseconds. For example; set 5000 for 5 seconds",'rt_theme_admin'),
														"dependency"  => array(
																				"element" => "autoplay",
																				"value" => array("true")
																			),
													),

													array(
														'param_name'  => 'margin',
														'heading'     => __('Item Margin', 'rt_theme_admin' ),
														'description' => __('Set a value for the margin between carousel items. Default is 15px', 'rt_theme_admin' ),
														'type'        => 'rt_number',
														'default_value' => "15",
														'value'       => ''
													),


													array(
														'param_name'  => 'id',
														'heading'     => __('ID', 'rt_theme_admin' ),
														'description' => __('Unique ID', 'rt_theme_admin' ),
														'type'        => 'textfield',
														'value'       => ''
													),

													array(
														'param_name'  => 'class',
														'heading'     => __('Class', 'rt_theme_admin' ),
														'description' => __('CSS Class Name', 'rt_theme_admin' ),
														'type'        => 'textfield'
													),
						
										),
					),

					/*
						Latest News
					*/  

					"rt_latest_news" => array(
						"name"=> __('Latest News','rt_theme_admin'),
						"subline" => '',
						"id"=> 'rt_latest_news',
						"description"=> __('Displays blog posts with latest news style','rt_theme_admin'),
						"open" => true,
						"close" => false,	
						"content" => array(
										"shortcode_id" => '',
										"text" => ''
									),						
						"parameters" => array(


					 							array(
													'param_name'  => 'style',
													'heading'     => __( 'Style', 'rt_theme_admin' ),
													'type'        => 'dropdown',
													'default_value' => "1",
													"value"       => array(
																				'1' => __('Style 1 - Big Dates','rt_theme_admin'),
																				'2' => __('Style 2- Featured Images','rt_theme_admin'), 
																			),
												),

												array(
													'param_name'  => 'id',
													'heading'     => __('ID', 'rt_theme_admin' ),
													'description' => __('Unique ID', 'rt_theme_admin' ),
													'type'        => 'textfield',
													'value'       => ''
												),

												array(
													'param_name'  => 'max_item',
													'heading'     => __('Amount of item to display', 'rt_theme_admin' ),
													'type'        => 'rt_number',
													'default_value' => "10",
													'value'       => '10',
												),


												array(
													'param_name'  => 'excerpt_length',
													'heading'     => __('Excerpt Length', 'rt_theme_admin' ),
													'type'        => 'rt_number',
													'default_value' => "100",
													'value'       => '100',
												),

												array(
													"param_name" => 'list_orderby',
													"description"=> __('Sorts the posts by this parameter','rt_theme_admin'),
													"default_value" => 'date',
													"value" => array(
																			'author'=>__('Author','rt_theme_admin'),
																			'date'=>__('Date','rt_theme_admin'),
																			'title'=>__('Title','rt_theme_admin'),
																			'modified'=>__('Modified','rt_theme_admin'),
																			'ID'=>__('ID','rt_theme_admin'),
																			'rand'=>__('Randomized','rt_theme_admin'),
																		),
												),	

												array(
													"param_name" => 'list_order',
													"description"=> __("Designates the ascending or descending order of the list_orderby parameter",'rt_theme_admin'),
													"default_value" => 'DESC',
													"value" => array(
																			'ASC'=>__('Ascending','rt_theme_admin'),
																			'DESC'=>__('DESC','rt_theme_admin'), 
																		),
												),				

												array(
													'param_name'  => 'categories',
													'heading'     => __( 'Categories', 'rt_theme_admin' ),
													"description"=> __("Category id's seperated by comma. Leave blank to list all categories.",'rt_theme_admin'),
													'type'        => 'dropdown_multi',
												),


												/* Featured Images */
												array(
													'param_name'  => 'image_width',
													'heading'     => __('Featured Image Max Width', 'rt_theme_admin' ),
													'type'        => 'textfield',
													'default_value' => "250",
													"dependency"  => array(
																		"element" => "style",
																		"value" => array("2")
																	)
												),

												array(
													'param_name'  => 'image_height',
													'heading'     => __('Featured Image Max Height', 'rt_theme_admin' ),
													'type'        => 'textfield',
													'default_value' => "250",
													"dependency"  => array(
																		"element" => "style",
																		"value" => array("2")
																	)
												),


										),
					),
			/*
				Images
			*/
			"group-3" => array(
				"group_name"=> __('Media & Sliders','rt_theme_admin'),
				"group_icon"=> "icon-code-1",
			),

					/*
						Photo Gallery Holder
					*/			
					"rt_image_gallery" => array(

						"name"=> __('Photo Gallery','rt_theme_admin'),
						"description"=> __('Holder shortcode for image gallery.','rt_theme_admin'),
						"subline" => false,
						"id"=> 'rt_image_gallery',
						"open" => true,
						"close" => true,
						"content" => array(
										"shortcode_id" => 'rt_gal_item',
										"text" => ''
									),
						"parameters" => array(

											array(
												'param_name'  => 'id',
												'heading'     => __('ID', 'rt_theme_admin' ),
												'description' => __('Unique ID', 'rt_theme_admin' ),
												'type'        => 'textfield',
												'value'       => ''
											),

											array(
												'param_name'  => 'class',
												'heading'     => __('Class', 'rt_theme_admin' ),
												'description' => __('CSS Class Name', 'rt_theme_admin' ),
												'type'        => 'textfield'
											),		

											array(
												"param_name" => 'list_layout',
												"description"=> __('Column Width','rt_theme_admin'),
												"default_value" => '1/4', 
												"value" => array(
																			"1/6" => "1/6 columns", 
																			"1/4" => "1/4 columns",
																			"1/3" => "1/3 columns",
																			"1/2" => "1/2 columns",
																			"1/1" => "1/1 column"												
																	),
											),

											array(
												'param_name'  => 'crop',
												'heading'     => __('Crop', 'rt_theme_admin' ),
												'type'        => 'checkbox',
												"default_value" => 'false',										
												"value"       => array(
																		'true' => __('Yes','rt_theme_admin'),
																		'false' => __('No','rt_theme_admin'),
																),
											),
											
											array(
												'param_name'  => 'tooltips',
												'heading'     => __('Tooltips', 'rt_theme_admin' ),
												'type'        => 'checkbox',
												"default_value" => 'true',										
												"value"       => array(
																		'true' => __('Yes','rt_theme_admin'),
																		'false' => __('No','rt_theme_admin'),
																),
											),
									
										),
					),

					/*
						Photo gallery images
					*/			
					"rt_gal_item" => array(

						"name"=> __('Image','rt_theme_admin'),
						"description"=> __('Displays a gallery item.','rt_theme_admin'),
						"subline" => true,
						"id"=> 'rt_gal_item',
						"open" => true,
						"close" => true,
						"content" => array(
										"shortcode_id" => '',
										"text" => 'Description of the image'
									),
						"parameters" => array(
				
						 							array(
														'param_name'  => 'image_id',
														'heading'     => __('Image', 'rt_theme_admin' ),
														'description' => __('Image ID', 'rt_theme_admin' ),
														'type'        => 'attach_image',
														'holder'      => 'img',
													),
						 
													array(
														'param_name'  => 'title',
														'heading'     => __( 'Title', 'rt_theme_admin' ),
														'description' => '',
														'type'        => 'textfield',
														'holder'      => 'h4',
													),

													//link
													array(
														'param_name'  => 'action',
														'heading'     => __('Action', 'rt_theme_admin' ),
														'type'        => 'dropdown',
														"default_value" => 'lightbox',
														'value'       => array(
																				"lightbox" => __("Open orginal image in a lightbox", "rt_theme_admin"), 
																				"custom_link" => __("Link the thumbnail to the custom link", "rt_theme_admin"), 
																				"no_link" => __("No link", "rt_theme_admin"), 
																		), 
													),

													//link
													array(
														'param_name'  => 'custom_link',
														'heading'     => __('Custom Link', 'rt_theme_admin' ),
														'type'        => 'textfield',
														'value'       => '',
														"dependency"  => array(
																		"element" => "action",
																		"value" => array("custom_link")
														),									
													),
						 
													array(
														'param_name'  => 'link_target',
														'heading'     => __('Link Target', 'rt_theme_admin' ),
														'type'        => 'dropdown',
														"value"       => array(
																			"_self" => __("Same Tab", "rt_theme_admin"),
																			"_blank" => __("New Tab", "rt_theme_admin")
																		),
														"dependency"  => array(
																		"element" => "action",
																		"value" => array("custom_link")	
														),						
													),	


													array(
														'param_name'  => 'id',
														'heading'     => __('ID', 'rt_theme_admin' ),
														'description' => __('Unique ID', 'rt_theme_admin' ),
														'type'        => 'textfield',
														'value'       => ''
													),

													array(
														'param_name'  => 'class',
														'heading'     => __('Class', 'rt_theme_admin' ),
														'description' => __('CSS Class Name', 'rt_theme_admin' ),
														'type'        => 'textfield'
													),

										),				
					),


					/*
						Image Slider Holder
					*/						

					"rt_slider" => array(

						"name"=> __('Content Slider','rt_theme_admin'),
						"description"=> __('Holder shortcode for photo slider.','rt_theme_admin'),
						"subline" => false,
						"id"=> 'rt_slider',
						"open" => true,
						"close" => true,
						"content" => array(
										"shortcode_id" => 'rt_slide',
										"text" => ''
									),
						"parameters" => array(


											array(
												'param_name'  => 'min_height',
												'heading'     => __('Minimum Slider Height (px)', 'rt_theme_admin' ),
												'description' => __('Slider minimum height value to be applied for big screens only. For mobile device screens, the height will be calculated automatically depended the cotent of each slide.', 'rt_theme_admin' ),
												"default_value" => '400', 
											),

											array(
												'param_name'  => 'autoplay',
												'heading'     => __('Autoplay', 'rt_theme_admin' ),
												"default_value" => 'false',
												"value" => array(
																		"true" => __('True','rt_theme_admin'),
																		"false" => __('False','rt_theme_admin'),
																	),						
											),

											array(
												'param_name'  => 'parallax',
												'heading'     => __('Parallax Effect', 'rt_theme_admin' ),
												"default_value" => 'false',
												"value" => array(
																		"true" => __('True','rt_theme_admin'),
																		"false" => __('False','rt_theme_admin'),
																	),										
											),

											array(
												'param_name'  => 'timeout',
												'heading'     => __('Timeout', 'rt_theme_admin' ),
												'description' => __('Timeout value for each slide. Default is 5000 (equal 5sec)', 'rt_theme_admin' ),
												"default_value" => '5000', 
											),

										),
					),

					/*
						Slides
					*/			
					"rt_slide" => array(

						"name"=> __('Slide','rt_theme_admin'),
						"description"=> __('Adds slide to the slider.','rt_theme_admin'),
						"subline" => true,
						"id"=> 'rt_slide',
						"open" => true,
						"close" => true,
						"content" => array(
										"shortcode_id" => '',
										"text" => '<h2>Slide Caption</h2><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>'
									),
						"parameters" => array(
				


					 							array(
													'param_name'  => 'class',
													'heading'     => __('Class', 'rt_theme_admin' ),
													'description' => __('CSS Class Name', 'rt_theme_admin' ),
													'type'        => 'textfield',
													'group' => __('Slide Content', 'rt_theme_admin')
												),


												array(
													'param_name'  => 'content_color_schema',
													'heading'     => __( 'Content Color Scheme', 'rt_theme_admin' ),
													'description' => __( 'Select a color scheme for the column. Please note the background color of the scheme will not be applied.', 'rt_theme_admin' ),
													'type'        => 'dropdown',
													'default_value'  => 'default-style',
													"value"       => array(
																			"global-style"  => __("Global", "rt_theme_admin"),
																			"default-style" => __("Color Set 1", "rt_theme_admin"),
																			"alt-style-1"   => __("Color Set 2 ", "rt_theme_admin"),
																			"alt-style-2"   => __("Color Set 3 ", "rt_theme_admin"),
																			"light-style"   => __("Color Set 4", "rt_theme_admin"),
																	),
													'group' => __('Slide Content', 'rt_theme_admin')

												),

												array(
													'param_name'  => 'content_bg_color',
													'heading'     => __( 'Content Background Color', 'rt_theme_admin' ),
													'description' => '',
													'type'        => 'colorpicker',
													'default_value'  => '#fffff',
													'group'       => __('Slide Content', 'rt_theme_admin')
												),

												array(
													'param_name'  => 'content_wrapper_width',
													'heading'     => __('Content Wrapper Width', 'rt_theme_admin' ),
													'description' => __( 'Select a pre-defined width for the row content', 'rt_theme_admin' ),
													'type'        => 'dropdown',
													"value"       => array(
																		"default" => __("Default Width", "rt_theme_admin"),
																		"fullwidth" => __("Full Width", "rt_theme_admin"),
																	),	
													'group'       => __('Slide Content', 'rt_theme_admin')
												),

												array(
													'param_name'  => 'content_width',
													'heading'     => __('Content Width (percent)', 'rt_theme_admin' ),
													'description' => __('Width of the content block. For mobile device screens, this value will be calculated automatically depends the screen width.', 'rt_theme_admin' ),
													'type'        => 'rt_number',
													'default_value'       => '40',
													'group'       => __('Slide Content', 'rt_theme_admin')
												),

												array(
													'param_name'  => 'content_align',
													'heading'     => __('Content Align', 'rt_theme_admin' ),
													'description' => __('Select a position for the content block. For mobile device screens, the content block will be aligned to the center automatically', 'rt_theme_admin' ),
													'type'        => 'dropdown',
													"value"       => array(		
																		"right" => __("Right","rt_theme_admin"),
																		"left" => __("Left","rt_theme_admin"),
																		"center" => __("Center","rt_theme_admin"),
																	),
													'group' => __('Slide Content', 'rt_theme_admin')
												),

												array(
													'param_name'  => 'top_margin',
													'heading'     => __('Top Margin (px)', 'rt_theme_admin' ),
													'description' => __('Height of the space between top of the slide and the content block. For mobile device screens, this value will be calculated automatically depends the screen height.', 'rt_theme_admin' ),
													'type'        => 'rt_number',
													'group'       => __('Slide Content', 'rt_theme_admin')
												),

												array(
													'param_name'  => 'link',
													'heading'     => __('Link', 'rt_theme_admin' ),
													'type'        => 'textfield',
													'value'       => '',
													'group'       => __('Link', 'rt_theme_admin')
												),

												array(
													'param_name'  => 'link_target',
													'heading'     => __('Link Target', 'rt_theme_admin' ),
													'type'        => 'dropdown',
													"value"       => array(
																		"_self" => __("Same Tab", "rt_theme_admin"),
																		"_blank" => __("New Tab", "rt_theme_admin"),
																	),
													'group'       => __('Link', 'rt_theme_admin')
												),		

					 							array(
													'param_name'  => 'link_title',
													'heading'     => __('Link Title', 'rt_theme_admin' ),
													'description' => __('Text for the title attribute', 'rt_theme_admin' ),
													'type'        => 'textfield',
													'group'       => __('Link', 'rt_theme_admin')
												),

												/**
												 * Background Options
												 */
												array(
													'param_name'  => 'bg_color',
													'heading'     => __( 'Background Color', 'rt_theme_admin' ),
													'description' => '',
													'type'        => 'colorpicker',
													'group'       => __('Background Options', 'rt_theme_admin')
												),


												array(
													'param_name'  => 'bg_image',
													'heading'     => __('Background Image ID.', 'rt_theme_admin' ),
													'description' => __('Set an image ID for the slider background', 'rt_theme_admin' ),
													'type'        => 'attach_image',
													'group'       => __('Background Options', 'rt_theme_admin')
												),
					 
												array(
													'param_name'  => 'bg_image_repeat',
													'heading'     => __( 'Background Repeat', 'rt_theme_admin' ),
													'description' => __( 'Select and set repeat mode direction for the background image.', 'rt_theme_admin' ),
													'type'        => 'dropdown',
													"value"       => array(		
																				"no-repeat" => __("No Repeat","rt_theme_admin"),
																				"repeat"    => __("Tile","rt_theme_admin"),
																				"repeat-x"  => __("Tile Horizontally","rt_theme_admin"),
																				"repeat-y"  => __("Tile Vertically","rt_theme_admin"),
																	),
													'group'       => __( 'Background Options', 'rt_theme_admin' ),
																
												),

												array(
													'param_name'  => 'bg_size',
													'heading'     => __( 'Background Image Size', 'rt_theme_admin' ),
													'description' => __( 'Select and set size / coverage behaviour for the background image.', 'rt_theme_admin' ),
													'type'        => 'dropdown', 
													"value"       => array(		
																				"cover"     => __("Cover","rt_theme_admin"),
																				"auto auto" => __("Auto","rt_theme_admin"),
																				"contain"   => __("Contain","rt_theme_admin"),
																				"100% auto" => __("100%","rt_theme_admin"),
																				"50% auto"  => __("50%","rt_theme_admin"),
																				"25% auto"  => __("25%","rt_theme_admin"),
																	),	
													'group'       => __( 'Background Options', 'rt_theme_admin' ),

												),

												array(
													'param_name'  => 'bg_position',
													'heading'     => __( 'Background Position', 'rt_theme_admin' ),
													'description' => __( 'Select a positon for the background image.', 'rt_theme_admin' ),
													'type'        => 'dropdown', 
													"value"       => array(		
																				"right top"     => __("Right Top","rt_theme_admin"),
																				"right center"  => __("Right Center","rt_theme_admin"),
																				"right bottom"  => __("Right Bottom","rt_theme_admin"),
																				"left top"      => __("Left Top","rt_theme_admin"),
																				"left center"   => __("Left Center","rt_theme_admin"),
																				"left bottom"   => __("Left Bottom","rt_theme_admin"),
																				"center top"    => __("Center Top","rt_theme_admin"),
																				"center center" => __("Center Center","rt_theme_admin"),
																				"center bottom" => __("Center Bottom","rt_theme_admin"),
																	),	
													'group'       => __( 'Background Options', 'rt_theme_admin' ),

												),

										),				
					),


					/*
						Video Embed
					*/			
					"rt_embed" => array(

						"name"=> __('Video Embed','rt_theme_admin'),
						"description"=> __('This shortcodes embeds a video from YouTube and Vimeo in a responsive layout. Just the put the video url between the shorcode.','rt_theme_admin'),
						"subline" => false,
						"id"=> 'rt_embed',
						"open" => true,
						"close" => false,
						"content" => array(
										"shortcode_id" => '',
										"text" => ''
									),
						"parameters" => array(
				
										),				
					),

			/*
				Contents
			*/
			"group-4" => array(
				"group_name"=> __('Contents','rt_theme_admin'),
				"group_icon"=> "icon-code-1",
			),

					/*
						Icon Lists
					*/						

					"rt_icon_list" => array(

						"name"=> __('Icon Lists','rt_theme_admin'),
						"description"=> __('Holder shortcode for icon lists','rt_theme_admin'),
						"subline" => false,
						"id"=> 'rt_icon_list',
						"open" => true,
						"close" => true,
						"content" => array(
										"shortcode_id" => 'rt_icon_list_line',
										"text" => ''
									),
						"parameters" => array(


												array(
													'param_name'  => 'list_style',
													'heading'     => __('List Style', 'rt_theme_admin' ),
													'type'        => 'dropdown',
													'description' => __('Select a list style', 'rt_theme_admin' ),
													"value"       => array(
																		"style-1" => __("Default Icons", "rt_theme_admin"),
																		"style-2" => __("Light Icons", "rt_theme_admin"),
																		"style-3" => __("Boxed Icons", "rt_theme_admin"),
																		"style-4" => __("Big Icons", "rt_theme_admin"),
																	),
												), 

												array(
													'param_name'  => 'id',
													'heading'     => __('ID', 'rt_theme_admin' ),
													'description' => __('Unique ID', 'rt_theme_admin' ),
													'type'        => 'textfield',
													'value'       => ''
												),

												array(
													'param_name'  => 'class',
													'heading'     => __('Class', 'rt_theme_admin' ),
													'description' => __('CSS Class Name', 'rt_theme_admin' ),
													'type'        => 'textfield'
												),


										),
					),

					/*
						Icon list line
					*/			
					"rt_icon_list_line" => array(

						"name"=> __('List line','rt_theme_admin'),
						"description"=> __('Adds a line to the list.','rt_theme_admin'),
						"subline" => true,
						"id"=> 'rt_icon_list_line',
						"open" => true,
						"close" => true,
						"content" => array(
										"shortcode_id" => '',
										"text" => 'Content'
									),
						"parameters" => array(
				
												array(
													'param_name'  => 'icon_name',
													'heading'     => __('Icon', 'rt_theme_admin' ),
													'description' => __('Icon name.', 'rt_theme_admin' ),
													'type'        => 'textfield',
													'class'       => 'icon_selector',
												),

												array(
													'param_name'  => 'id',
													'heading'     => __('ID', 'rt_theme_admin' ),
													'description' => __('Unique ID', 'rt_theme_admin' ),
													'type'        => 'textfield',
													'value'       => ''
												),

												array(
													'param_name'  => 'class',
													'heading'     => __('Class', 'rt_theme_admin' ),
													'description' => __('CSS Class Name', 'rt_theme_admin' ),
													'type'        => 'textfield'
												),

										),				
					),
		 
					/*
						Tabs
					*/				

					"rt_tabs" => array(

						"name"=> __('Tabs','rt_theme_admin'),
						"description"=> __('Holder shortcode for tabs.','rt_theme_admin'),
						"subline" => false,
						"id"=> 'rt_tabs',
						"open" => true,
						"close" => true,
						"content" => array(
										"shortcode_id" => 'rt_tab',
										"text" => ''
									),
						"parameters" => array(

											array(
												'param_name'  => 'tabs_style',
												'heading'     => __('Tab Style', 'rt_theme_admin' ),
												'type'        => 'dropdown',
												"value"       => array(
																			"style-1" => __("Horizontal Tabs", "rt_theme_admin"),
																			"style-2" => __("Left Vertical Tabs", "rt_theme_admin"),
																			"style-3" => __("Right Vertical Tabs", "rt_theme_admin"),
																		),
											),

											array(
												'param_name'  => 'id',
												'heading'     => __('ID', 'rt_theme_admin' ),
												'description' => __('Unique ID', 'rt_theme_admin' ),
												'type'        => 'textfield',
												'value'       => ''
											),

											array(
												'param_name'  => 'class',
												'heading'     => __('Class', 'rt_theme_admin' ),
												'description' => __('CSS Class Name', 'rt_theme_admin' ),
												'type'        => 'textfield'
											),

										),
					),

					/*
						tab content
					*/			
					"rt_tab" => array(

						"name"=> __('Tab','rt_theme_admin'),
						"description"=> __('The tab content.','rt_theme_admin'),
						"subline" => true,
						"id"=> 'rt_tab',
						"open" => true,
						"close" => true,
						"content" => array(
										"shortcode_id" => '',
										"text" => 'Content'
									),
						"parameters" => array(

											array(
												'param_name'  => 'title',
												'heading'     => __('Title', 'rt_theme_admin' ),
												'description' => __('Tab Title', 'rt_theme_admin' ),
												'type'        => 'textfield',
												'value'       => __( 'Tab Title', 'rt_theme_admin' ),
											),
											
											array(
												'param_name'  => 'icon_name',
												'heading'     => __('Tab Icon', 'rt_theme_admin' ),
												'description' => __('Click inside the field to select an icon or type the icon name', 'rt_theme_admin' ),
												'type'        => 'textfield',
												'class'       => 'icon_selector',
											),

											array(
												'param_name'  => 'id',
												'heading'     => __('ID', 'rt_theme_admin' ),
												'description' => __('Unique ID', 'rt_theme_admin' ),
												'type'        => 'textfield',
												'value'       => ''
											),

											array(
												'param_name'  => 'class',
												'heading'     => __('Class', 'rt_theme_admin' ),
												'description' => __('CSS Class Name', 'rt_theme_admin' ),
												'type'        => 'textfield'
											),

										),				
					),


					/*
						Accordions
					*/						

					"rt_accordion" => array(

						"name"=> __('Accordion','rt_theme_admin'),
						"description"=> __('Holder shortcode for accordions.','rt_theme_admin'),
						"subline" => false,
						"id"=> 'rt_accordion',
						"open" => true,
						"close" => true,
						"content" => array(
										"shortcode_id" => 'rt_accordion_content',
										"text" => ''
									),
						"parameters" => array(

											array(
												"param_name" => 'style',
												"description"=> 'Style',
												"default_value" => 'numbered',
												"value" => array(
																		"numbered" => "Numbered",
																		"icons" => "With Icons",
																		"only_captions" => "Captions Only"
																	),										
											),
		 
											array(
												"param_name" => 'first_one_open',
												"description"=> __('First one open','rt_theme_admin'),
												"default_value" => 'false',
												"value" => array(
																		"true" => __('True','rt_theme_admin'),
																		"false" => __('False','rt_theme_admin')
																	),										
											),									
											
											array(
												'param_name'  => 'id',
												'heading'     => __('ID', 'rt_theme_admin' ),
												'description' => __('Unique ID', 'rt_theme_admin' ),
												'type'        => 'textfield',
												'value'       => ''
											),

											array(
												'param_name'  => 'class',
												'heading'     => __('Class', 'rt_theme_admin' ),
												'description' => __('CSS Class Name', 'rt_theme_admin' ),
												'type'        => 'textfield'
											),
										),
					),


					/*
						Accordion content
					*/			
					"rt_accordion_content" => array(
						"name"=> __('Pane','rt_theme_admin'),
						"description"=> __('Adds another pane to the accordion content.','rt_theme_admin'),
						"subline" => true,
						"id"=> 'rt_accordion_content',
						"open" => true,
						"close" => true,
						"content" => array(
										"shortcode_id" => '',
										"text" => 'Content'
									),
						"parameters" => array(

											array(
												"param_name" => 'title',
												"description"=> 'Title',
												"default_value" => '',
											),

											array(
												"param_name" => 'icon_name',
												"description"=> __('Icon name.','rt_theme_admin'),
												"default_value" => '',
											),

											array(
												'param_name'  => 'id',
												'heading'     => __('ID', 'rt_theme_admin' ),
												'description' => __('Unique ID', 'rt_theme_admin' ),
												'type'        => 'textfield',
												'value'       => ''
											),

											array(
												'param_name'  => 'class',
												'heading'     => __('Class', 'rt_theme_admin' ),
												'description' => __('CSS Class Name', 'rt_theme_admin' ),
												'type'        => 'textfield'
											),

										),				
					),


					/*
						Pricing Tables
					*/						

					"rt_pricing_table" => array(

						"name"=> __('Pricing Table','rt_theme_admin'),
						"description"=> __('Holder shortcode for pricing table.','rt_theme_admin'),
						"subline" => false,
						"id"=> 'rt_pricing_table',
						"open" => true,
						"close" => true,
						"content" => array(
										"shortcode_id" => 'rt_table_column',
										"text" => ''
									),
						"parameters" => array(

											array(
												"param_name" => 'style',
												"description"=> 'Style',
												"default_value" => 'service',
												"value" => array(
																		"service" => "Service",
																		"compare" => "Compare",
																	),										
											),

											array(
												'param_name'  => 'id',
												'heading'     => __('ID', 'rt_theme_admin' ),
												'description' => __('Unique ID', 'rt_theme_admin' ),
												'type'        => 'textfield',
												'value'       => ''
											),

											array(
												'param_name'  => 'class',
												'heading'     => __('Class', 'rt_theme_admin' ),
												'description' => __('CSS Class Name', 'rt_theme_admin' ),
												'type'        => 'textfield'
											),

										),
					),


					/*
						Pricing Table Columns
					*/			
					"rt_table_column" => array(
						"name"=> __('Table Column','rt_theme_admin'),
						"description"=> __('Adds a column to the table. Use HTML ul lists to create cells.','rt_theme_admin'),
						"subline" => true,
						"id"=> 'rt_table_column',
						"open" => true,
						"close" => true,
						"content" => array(
										"shortcode_id" => '',
										"text" => ' <code>'.htmlentities("
										<ul>
											<li>....</li>
											<li>....</li>
											<li>....</li>
										</ul>
										") .'</code>'
									),

						"parameters" => array(

											array(
												"param_name" => 'caption',
												"description"=> 'Caption',
												"default_value" => '',
											),

											array(
												"param_name" => 'price',
												"description"=> 'Price',
												"default_value" => '',
											),

											array(
												"param_name" => 'info',
												"description"=> 'Info text',
												"default_value" => '',
											),

											array(
												"param_name" => 'style',
												"description"=> __('Icon name.','rt_theme_admin'),
												"default_value" => '',
												"value" => array(
																		""   => "Default",
																		"highlight"  => "Highlighted column",
																	),		


											),

											array(
												'param_name'  => 'id',
												'heading'     => __('ID', 'rt_theme_admin' ),
												'description' => __('Unique ID', 'rt_theme_admin' ),
												'type'        => 'textfield',
												'value'       => ''
											),

											array(
												'param_name'  => 'class',
												'heading'     => __('Class', 'rt_theme_admin' ),
												'description' => __('CSS Class Name', 'rt_theme_admin' ),
												'type'        => 'textfield'
											),

										),				
					),


					/*
						Content Box With Featured Image
					*/			

					"content_box" => array(
						"name"=> __('Content Box With Featured Image','rt_theme_admin'),
						"description"=> __('Creates a styled content box with an image','rt_theme_admin'),
						"subline" => false,
						"id"=> 'content_box',
						"open" => true,
						"close" => true,
						"content" => array(
										"shortcode_id" => '',
										"text" => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur euismod enim a metus adipiscing aliquam. Vestibulum in vestibulum lorem.</p>'
									),

						"parameters" => array(

											array(
												'param_name'  => 'id',
												'heading'     => __('ID', 'rt_theme_admin' ),
												'description' => __('Unique ID', 'rt_theme_admin' ),
												'type'        => 'textfield',
												'value'       => ''
											),

											array(
												'param_name'  => 'class',
												'heading'     => __('Class', 'rt_theme_admin' ),
												'description' => __('CSS Class Name', 'rt_theme_admin' ),
												'type'        => 'textfield'
											),

											array(
												'param_name'  => 'featured_image',
												'heading'     => __('Featured Image', 'rt_theme_admin' ),
												'description' => __('Image ID', 'rt_theme_admin' ),
												'type'        => 'attach_image',
												'holder'      => 'img'
											),

											array(
												'param_name'  => 'heading',
												'heading'     => __( 'Heading', 'rt_theme_admin' ),
												'description' => '',
												'type'        => 'textfield',
												'holder'      => 'div',
												'value'       => __( 'Box Heading', 'rt_theme_admin' ),
												'holder'      => 'h4',
											), 

											array(
												'param_name'  => 'heading_size',
												'heading'     => __( 'Heading Size', 'rt_theme_admin' ),
												'description' => __( 'Select the size of the heading tag', 'rt_theme_admin' ),
												'type'        => 'dropdown',
												'default_value' => "h4",
												"value"       => array(
																	"h1" => "h1", 
																	"h2" => "h2", 
																	"h3" => "h3", 
																	"h4" => "h4", 
																	"h5" => "h5", 
																	"h6" => "h6", 
																),
											),

											array(
												'param_name'  => 'style',
												'heading'     => __( 'Box Style', 'rt_theme_admin' ),
												'description' => __( 'Select a box style', 'rt_theme_admin' ),
												'type'        => 'dropdown',
												'default_value' => "style-1",
												"value"       => array(
																		"style-1" => __("Style One", "rt_theme_admin"),
																		"style-2" => __("Style Two", "rt_theme_admin"),
																	),
												'group'       => 'Box Style',
											),

											array(
												'param_name'  => 'image_mask_color',
												'heading'     => __( 'Image Mask Color', 'rt_theme_admin' ),
												'description' => __( 'Select a mask color for the image. Leave blank for the default color.', 'rt_theme_admin' ),
												'type'        => 'colorpicker',
												'group'       => 'Box Style',
												"dependency"  => array(
																"element" => "style",
																"value" => array("style-2")
												),											
											),

											array(
												'param_name'  => 'text_align',
												'heading'     => __( 'Text Align', 'rt_theme_admin' ),
												'type'        => 'dropdown',
												'group'       => 'Box Style',
												'default_value' => "left",
												"value"       => array(
																			"left" => __("Left", "rt_theme_admin"),
																			"right" => __("Right", "rt_theme_admin"),
																			"center" => __("Center", "rt_theme_admin"),
																	),
												"dependency"  => array(
																"element" => "style",
																"value" => array("style-1")
												),								
											),

											array(
												'param_name'  => 'text_color',
												'heading'     => __( 'Text Color', 'rt_theme_admin' ),
												'description' => __( 'Select a mask color for the image. Leave blank for the default color.', 'rt_theme_admin' ),
												'type'        => 'colorpicker',
												'group'       => 'Box Style',
												"dependency"  => array(
																"element" => "style",
																"value" => array("style-2")
												),											
											),

											array(
												'param_name'  => 'link',
												'heading'     => __('Link', 'rt_theme_admin' ),
												'type'        => 'textfield',
												'value'       => '',
												'group'       => 'Link'
											),

											array(
												'param_name'  => 'link_text',
												'heading'     => __('Link Text', 'rt_theme_admin' ),
												'type'        => 'textfield',
												'value'       => '',
												'group'       => 'Link'
											),

											array(
												'param_name'  => 'link_target',
												'heading'     => __('Link Target', 'rt_theme_admin' ),
												'type'        => 'dropdown',
												"value"       => array(
																	"_self" => __("Same Tab", "rt_theme_admin"),
																	"_blank" => __("New Tab", "rt_theme_admin"),
																),
												'group'       => 'Link'
											),										
		 
										),				
					),

					/*
						Content Box With Icon
					*/			


					"content_icon_box" => array(
						"name"=> __('Content Box With Icon','rt_theme_admin'),
						"description"=> __('Creates a styled content box with an icon','rt_theme_admin'),
						"subline" => false,
						"id"=> 'content_icon_box',
						"open" => true,
						"close" => true,
						"content" => array(
										"shortcode_id" => '',
										"text" => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur euismod enim a metus adipiscing aliquam. Vestibulum in vestibulum lorem.</p>'
									),

						"parameters" => array(

												array(
													'param_name'  => 'id',
													'heading'     => __('ID', 'rt_theme_admin' ),
													'description' => __('Unique ID', 'rt_theme_admin' ),
													'type'        => 'textfield',
													'value'       => ''
												),

												array(
													'param_name'  => 'class',
													'heading'     => __('Class', 'rt_theme_admin' ),
													'description' => __('CSS Class Name', 'rt_theme_admin' ),
													'type'        => 'textfield'
												),

												array(
													'param_name'  => 'heading',
													'heading'     => __( 'Heading', 'rt_theme_admin' ),
													'description' => '',
													'type'        => 'textfield',
													'holder'      => 'div',
													'value'       => __( 'Box Heading', 'rt_theme_admin' ),
													'holder'      => 'h4',
												), 

												array(
													'param_name'  => 'heading_size',
													'heading'     => __( 'Heading Size', 'rt_theme_admin' ),
													'description' => __( 'Select the size of the heading tag', 'rt_theme_admin' ),
													'type'        => 'dropdown',
													'default_value' => "h4",
													"value"       => array(
																		"h1" => "h1", 
																		"h2" => "h2", 
																		"h3" => "h3", 
																		"h4" => "h4", 
																		"h5" => "h5", 
																		"h6" => "h6", 
																	),
												),

												array(
													'param_name'  => 'icon_name',
													'heading'     => __('Icon', 'rt_theme_admin' ),
													'description' => __('Icon name.', 'rt_theme_admin' ),
													'type'        => 'textfield',
													'class'       => 'icon_selector',
												),

												array(
													'param_name'  => 'icon_style',
													'heading'     => __( 'Icon Style', 'rt_theme_admin' ),
													'description' => __( 'Select an Icon Style', 'rt_theme_admin' ),
													'type'        => 'dropdown',
													'default_value' => "style-1",
													"value"       => array(
																			"style-1" => __("Style One", "rt_theme_admin"),
																			"style-2" => __("Style Two", "rt_theme_admin"),
																			"style-3" => __("Style Three", "rt_theme_admin"),
																		),
													'group'       => 'Box Style',
												),

												array(
													'param_name'  => 'icon_position',
													'heading'     => __( 'Icon Position', 'rt_theme_admin' ),
													'type'        => 'dropdown',
													'group'       => 'Box Style',
													'default_value' => "left",
													"value"       => array(
																				"left" => __("Left", "rt_theme_admin"),
																				"right" => __("Right", "rt_theme_admin"),
																				"center" => __("Center", "rt_theme_admin"),
																		),	
												),


												array(
													'param_name'  => 'text_color',
													'heading'     => __( 'Text Color', 'rt_theme_admin' ),
													'description' => __( 'Select a mask color for the image. Leave blank for the default color.', 'rt_theme_admin' ),
													'type'        => 'colorpicker',
													'group'       => 'Box Style',
													"dependency"  => array(
																	"element" => "style",
																	"value" => array("style-2")
													),											
												),

												array(
													'param_name'  => 'link',
													'heading'     => __('Link', 'rt_theme_admin' ),
													'type'        => 'textfield',
													'value'       => '',
													'group'       => 'Link'
												),

												array(
													'param_name'  => 'link_text',
													'heading'     => __('Link Text', 'rt_theme_admin' ),
													'type'        => 'textfield',
													'value'       => '',
													'group'       => 'Link'
												),

												array(
													'param_name'  => 'link_target',
													'heading'     => __('Link Target', 'rt_theme_admin' ),
													'type'        => 'dropdown',
													"value"       => array(
																		"_self" => __("Same Tab", "rt_theme_admin"),
																		"_blank" => __("New Tab", "rt_theme_admin"),
																	),
													'group'       => 'Link'
												),										
		 
										),				
					),
		 

					/*
						Chained Contents Holder
					*/						

					"rt_chained_contents" => array(

						"name"=> __('Chained Contents','rt_theme_admin'),
						"description"=> __('Chained contents holder','rt_theme_admin'),
						"subline" => false,
						"id"=> 'rt_chained_contents',
						"open" => true,
						"close" => true,
						"content" => array(
										"shortcode_id" => 'rt_chained_content',
										"text" => ''
									),
						"parameters" => array(

											array(
												'param_name'  => 'id',
												'heading'     => __('ID', 'rt_theme_admin' ),
												'description' => __('Unique ID', 'rt_theme_admin' ),
												'type'        => 'textfield',
												'value'       => ''
											),

											array(
												'param_name'  => 'class',
												'heading'     => __('Class', 'rt_theme_admin' ),
												'description' => __('CSS Class Name', 'rt_theme_admin' ),
												'type'        => 'textfield'
											),

											array(
												'param_name'  => 'style',
												'heading'     => __('Style', 'rt_theme_admin' ),
												'type'        => 'dropdown',
												'description' => __('Select a style', 'rt_theme_admin' ),
												'value'       => array(
																		"1" => __("Small Icons", "rt_theme_admin"),
																		"2" => __("Small Numbers", "rt_theme_admin"), 
																		"3" => __("Big Icons", "rt_theme_admin"),
																		"4" => __("Big Numbers", "rt_theme_admin"),
																),
											),

											array(
												'param_name'  => 'start_from',
												'heading'     => __( 'Start Number', 'rt_theme_admin' ),
												'description' => __( 'Set a start number for the list. e.g. set 1 to have 1,2,3,.. list', 'rt_theme_admin' ),
												'type'        => 'rt_number',
												'value'      => 1,
												"dependency"  => array(
																		"element" => "style",
																		"value" => array("2","4")
																	),
											),						

											array(
												'param_name'  => 'align',
												'heading'     => __('Number/Icon Align', 'rt_theme_admin' ),
												'type'        => 'dropdown',
												'value'       => array(
																			"left" => __("Left", "rt_theme_admin"),
																			"right" => __("Right", "rt_theme_admin"), 
																),
											),
		 
										),
					),


					/*
						Chained Content
					*/			


					"rt_chained_content" => array(

						"name"=> __('Chained Content','rt_theme_admin'),
						"description"=> __('Adds a new content block to the chained content group','rt_theme_admin'),
						"subline" => true,
						"id"=> 'rt_chained_content',
						"open" => true,
						"close" => true,
						"content" => array(
										"shortcode_id" => '',
										"text" => 'Content'
									),
						"parameters" => array(
				
												array(
													'param_name'  => 'icon_name',
													'heading'     => __('Icon', 'rt_theme_admin' ),
													'description' => __('Click inside the field to select an icon or type the icon name', 'rt_theme_admin' ),
													'type'        => 'textfield',
													'class'       => 'icon_selector',
												),

												array(
													'param_name'  => 'title',
													'heading'     => __( 'Title', 'rt_theme_admin' ),
													'description' => '',
													'type'        => 'textfield',
													'holder'      => 'h4',
												),

												array(
													'param_name'  => 'id',
													'heading'     => __('ID', 'rt_theme_admin' ),
													'description' => __('Unique ID', 'rt_theme_admin' ),
													'type'        => 'textfield',
													'value'       => ''
												),

												array(
													'param_name'  => 'class',
													'heading'     => __('Class', 'rt_theme_admin' ),
													'description' => __('CSS Class Name', 'rt_theme_admin' ),
													'type'        => 'textfield'
												),

										),				
					),

					/*
						Timelines
					*/			

					"rt_timeline" => array(

						"name"=> __('Timeline Events','rt_theme_admin'),
						"description"=> __('Timeline holder','rt_theme_admin'),
						"subline" => false,
						"id"=> 'rt_timeline',
						"open" => true,
						"close" => true,
						"content" => array(
										"shortcode_id" => 'rt_tl_event',
										"text" => ''
									),
						"parameters" => array(

											array(
												'param_name'  => 'id',
												'heading'     => __('ID', 'rt_theme_admin' ),
												'description' => __('Unique ID', 'rt_theme_admin' ),
												'type'        => 'textfield',
												'value'       => ''
											),

											array(
												'param_name'  => 'class',
												'heading'     => __('Class', 'rt_theme_admin' ),
												'description' => __('CSS Class Name', 'rt_theme_admin' ),
												'type'        => 'textfield'
											),
		 
		 
										),
					),

					/*
						Chained Content
					*/			


					"rt_tl_event" => array(

						"name"=> __('Event','rt_theme_admin'),
						"description"=> __('Adds a new event to the timeline','rt_theme_admin'),
						"subline" => true,
						"id"=> 'rt_tl_event',
						"open" => true,
						"close" => true,
						"content" => array(
										"shortcode_id" => '',
										"text" => 'Content'
									),
						"parameters" => array(
							
												array(
													'param_name'  => 'title',
													'heading'     => __( 'Title', 'rt_theme_admin' ),
													'description' => '',
													'type'        => 'textfield',
													'holder'      => 'h4',
												),

												array(
													'param_name'  => 'day',
													'heading'     => __('Event Day', 'rt_theme_admin' ),
													'description' => __('Day', 'rt_theme_admin' ),
													'type'        => 'textfield',
													'class'       => 'icon_selector',
												),

												array(
													'param_name'  => 'month',
													'heading'     => __('Event Month', 'rt_theme_admin' ),
													'description' => __('Month', 'rt_theme_admin' ),
													'type'        => 'textfield',
													'class'       => 'icon_selector',
												),

												array(
													'param_name'  => 'year',
													'heading'     => __('Event Year', 'rt_theme_admin' ),
													'description' => __('Year', 'rt_theme_admin' ),
													'type'        => 'textfield',
													'class'       => 'icon_selector',
												),

												array(
													'param_name'  => 'id',
													'heading'     => __('ID', 'rt_theme_admin' ),
													'description' => __('Unique ID', 'rt_theme_admin' ),
													'type'        => 'textfield',
													'value'       => ''
												),

												array(
													'param_name'  => 'class',
													'heading'     => __('Class', 'rt_theme_admin' ),
													'description' => __('CSS Class Name', 'rt_theme_admin' ),
													'type'        => 'textfield'
												),

										),				
					),

			/*
				Elements
			*/
			"group-5" => array(
				"group_name"=> __('Elements','rt_theme_admin'),
				"group_icon"=> "icon-code-1",
			),


					/*
						Contact Form
					*/			
					"contact_form" => array(
						"name"=> __('Contact Form','rt_theme_admin'),
						"subline" => '',
						"id"=> 'contact_form',
						"description"=> __('Calls the contact form','rt_theme_admin'),
						"open" => true,
						"close" => true,	
						"content" => array(
										"shortcode_id" => '',
										"text" => 'Contact form description text'
									),					
						"parameters" => array(
											array(
												"param_name" => 'email',
												"description"=> __('The contact form will be submited to this email.','rt_theme_admin'),
												"default_value" => '', 
											),
											array(
												"param_name" => 'title',
												"description"=> __('Title','rt_theme_admin'),
												"default_value" => '', 
											),		
											array(
												"param_name" => 'security',
												"description"=> __('security','rt_theme_admin'),
												"default_value" => 'true', 
												"value" => array(
																		"true" => __('True','rt_theme_admin'),
																		"false" => __('False','rt_theme_admin'),
																	),										
											),				

											array(
												'param_name'  => 'id',
												'heading'     => __('ID', 'rt_theme_admin' ),
												'description' => __('Unique ID', 'rt_theme_admin' ),
												'type'        => 'textfield',
												'value'       => ''
											),

											array(
												'param_name'  => 'class',
												'heading'     => __('Class', 'rt_theme_admin' ),
												'description' => __('CSS Class Name', 'rt_theme_admin' ),
												'type'        => 'textfield'
											),

										),
					),


					/*
						Horizontal Line
					*/			
					"rt_divider" => array(

						"name"=> __('Horizontal Line','rt_theme_admin'),
						"description"=> __('Horizontal line shortcode','rt_theme_admin'),
						"id"=> 'rt_divider',
						"subline" => false,
						"open" => true,
						"close" => true, 					
						"parameters" => array(
													array(
														"param_name" => 'style',
														"description"=> __('Style','rt_theme_admin'),
														"default_value" => 'style-1',
														"value" => array(
																				"style-1" => __("Style One - Three Circle", "rt_theme_admin"),
																				"style-2" => __("Style Two - Small Left Aligned Line", "rt_theme_admin"),
																				"style-3" => __("Style Three - With Down Arrow", "rt_theme_admin"),
																				"style-4" => __("Style Four - Classic One Line", "rt_theme_admin"),
																				"style-5" => __("Style Five - Double Line", "rt_theme_admin"),
																				"style-6" => __("Style Six - Small Center Aligned Line", "rt_theme_admin"),
																			),
													),
													array(
														'param_name'  => 'margin_top',
														'heading'     => __( 'Margin Top', 'rt_theme_admin' ),
														'description' => __( 'Set margin top value (px) Default is 40px', 'rt_theme_admin' ),
														'type'        => 'rt_number',
													),

													array(
														'param_name'  => 'margin_bottom',
														'heading'     => __( 'Margin Bottom', 'rt_theme_admin' ),
														'description' => __( 'Set margin bottom value (px) Default is 40px', 'rt_theme_admin' ),
														'type'        => 'rt_number',
													),	

													array(
														'param_name'  => 'id',
														'heading'     => __('ID', 'rt_theme_admin' ),
														'description' => __('Unique ID', 'rt_theme_admin' ),
														'type'        => 'textfield',
														'value'       => ''
													),

													array(
														'param_name'  => 'class',
														'heading'     => __('Class', 'rt_theme_admin' ),
														'description' => __('CSS Class Name', 'rt_theme_admin' ),
														'type'        => 'textfield'
													),
											),
					),

					/*
						Pullquote
					*/			
					"pullquote" => array(

						"name"=> __('Pullquote','rt_theme_admin'),
						"description"=> __('Pullquote shortcode','rt_theme_admin'),
						"subline" => false,
						"open" => true,
						"id"=> 'pullquote',
						"close" => true, 					
						"parameters" => array(
											array(
												"param_name" => 'align',
												"description"=> __('Alignment','rt_theme_admin'),
												"default_value" => 'left',
												"value" => array(
																		"left" => __('Left ','rt_theme_admin'),
																		"Right" => __('Right','rt_theme_admin'), 														
																	),
											),
										),
					),

					/*
						Pullquote
					*/			
					"rt_quote" => array(

						"name"=> __('Qoute','rt_theme_admin'),
						"description"=> __('Quote shortcode','rt_theme_admin'),
						"subline" => false,
						"id"=> 'rt_quote',
						"open" => true,
						"close" => true, 					
						"content" => array(
										"shortcode_id" => '',
										"text" => 'Content Text'
									),								
						"parameters" => array(


												array(
													'param_name'  => 'name',
													'heading'     => __('Name', 'rt_theme_admin' ),
													'type'        => 'textfield',
													'value'       => ''
												),

												array(
													'param_name'  => 'position',
													'heading'     => __('Position', 'rt_theme_admin' ),
													'type'        => 'textfield',
													'value'       => ''
												),

												array(
													'param_name'  => 'link',
													'heading'     => __('Link', 'rt_theme_admin' ),
													'type'        => 'textfield',
													'value'       => ''
												),

												array(
													'param_name'  => 'link_title',
													'heading'     => __('Link Title', 'rt_theme_admin' ),
													'type'        => 'dropdown',
													'type'        => 'textfield'
												),		

												array(
													'param_name'  => 'id',
													'heading'     => __('ID', 'rt_theme_admin' ),
													'description' => __('Unique ID', 'rt_theme_admin' ),
													'type'        => 'textfield',
													'value'       => ''
												),

												array(
													'param_name'  => 'class',
													'heading'     => __('Class', 'rt_theme_admin' ),
													'description' => __('CSS Class Name', 'rt_theme_admin' ),
													'type'        => 'textfield'
												),

										),
					),

					/*
						Google maps
					*/						

					"google_maps" => array(

						"name"=> __('Google Maps','rt_theme_admin'),
						"description"=> __('Holder shortcode for google maps.','rt_theme_admin'),
						"subline" => false,
						"id"=> 'google_maps',
						"open" => true,
						"close" => true,
						"content" => array(
										"shortcode_id" => 'location',
										"text" => ''
									),
						"parameters" => array(

											array(
												"param_name" => 'height',
												"description"=> 'Height of the map.',
												"default_value" => '', 
											),

											array(
												"param_name" => 'zoom',
												"description"=> 'Zoom level. Works only with single map location.',
												"default_value" => '3', 
											),									

										),
					),

					/*
						Map Locations
					*/			
					"location" => array(

						"name"=> __('Map Location','rt_theme_admin'),
						"description"=> __('Adds locations to the map.','rt_theme_admin'),
						"subline" => true,
						"id"=> 'location',
						"open" => true,
						"close" => true,
						"content" => array(
										"shortcode_id" => '',
										"text" => 'Location description'
									),
						"parameters" => array(
				
											array(
												"param_name" => 'title',
												"description"=> 'Location name',
												"default_value" => '',
											),						
											array(
												"param_name" => 'lat',
												"description"=> 'Latitude',
												"default_value" => '',
											),
											array(
												"param_name" => 'lon',
												"description"=> 'Longitude',
												"default_value" => '',
											),
										),				
					),

					/*
						Social Media Icons
					*/						
					"rt_social_media_icons" => array(

						"name"=> __('Social Media Icons','rt_theme_admin'),
						"description"=> __('Displays the social media icons list that created by using <a href="?page=rt_social_options">Social Media Options</a> of the theme.','rt_theme_admin'),
						"subline" => false,
						"id"=> 'rt_social_media_icons',
						"open" => true,
						"close" => false,
						"content" => array(
										"shortcode_id" => '',
										"text" => ''
									)
					),

					/*
						Social Share Icons
					*/						
					"rt_social_media_share" => array(

						"name"=> __('Social Media Share','rt_theme_admin'),
						"description"=> __('Display social media share links with icons','rt_theme_admin'),
						"subline" => false,
						"id"=> 'rt_social_media_share',
						"open" => true,
						"close" => false,
						"content" => array(
										"shortcode_id" => '',
										"text" => ''
									)
					),



					/*
						Icons
					*/						

					"icon" => array(

						"name"=> __('Icons','rt_theme_admin'),
						"description"=> __('Displays an icon. Click the "<span class="icon-rocket"></span>Icons" link top of the page to find an icon name. ','rt_theme_admin'),
						"subline" => false,
						"id"=> 'icon',
						"open" => true,
						"close" => false,
						"content" => array(
										"shortcode_id" => '',
										"text" => ''
									),
						"parameters" => array(


												array(
													'param_name'  => 'icon_name',
													'heading'     => __('Icon Name', 'rt_theme_admin' ),
													'description' => __('Click inside the field to select an icon or type the icon name', 'rt_theme_admin' ),
													'type'        => 'textfield',
													'class'       => 'icon_selector'
												),


												array(
													'param_name'  => 'align',
													'heading'     => __( 'Text Align', 'rt_theme_admin' ),
													'type'        => 'dropdown',
													"value"       => array(
																		"" => __("Default", "ava"),
																		"left" => __("Left", "ava"),
																		"right" => __("Right", "ava"),
																		"center" => __("Center", "ava"),
																	),
													'save_always' => true
												),

												array(
													'param_name'  => 'color_type',
													'heading'     => _x( 'Icon Color', 'Admin Panel','rt_theme_admin' ),
													'type'        => 'dropdown',
													"value"       => array(
																		"text" => _x("Text Color", 'Admin Panel','rt_theme_admin'), 
																		"primary" => _x("Primary Color", 'Admin Panel','rt_theme_admin'), 
																		"custom" => _x("Custom Color", 'Admin Panel','rt_theme_admin'), 
																	),
													'save_always' => true
												),

												array(
													'param_name'  => 'color',
													'heading'     => _x('Custom Icon Color', 'Admin Panel','rt_theme_admin' ),
													'type'        => 'colorpicker',
													"dependency"  => array(
																	"element" => "color_type",
																	"value" => array("custom")
													),											
												),

												array(
													'param_name'  => 'background_color',
													'heading'     => _x('Custom Background Color', 'Admin Panel','rt_theme_admin' ),
													'type'        => 'colorpicker',
													"dependency"  => array(
																	"element" => "color_type",
																	"value" => array("custom")
													),											
												),

												array(
													'param_name'  => 'font_size',
													'heading'     => _x('Custom Icon Size (px)', 'Admin Panel','rt_theme_admin' ),
													'type'        => 'rt_number'								
												),

												array(
													'param_name'  => 'border_color',
													'heading'     => _x('Border Color', 'Admin Panel','rt_theme_admin' ),
													'type'        => 'colorpicker'				
												),

												array(
													'param_name'  => 'border_width',
													'heading'     => _x('Border Width (px,%)', 'Admin Panel','rt_theme_admin' ),
													'type'        => 'rt_number'							
												),

												array(
													'param_name'  => 'border_radius',
													'heading'     => _x('Border Radius (px,%)', 'Admin Panel','rt_theme_admin' ),
													'type'        => 'rt_number'							
												),

												array(
													'param_name'  => 'id',
													'heading'     => _x('ID', 'Admin Panel','rt_theme_admin' ),
													'description' => _x('Unique ID', 'Admin Panel','rt_theme_admin' ),
													'type'        => 'textfield',
													'value'       => ''
												),

												array(
													'param_name'  => 'class',
													'heading'     => _x('Class', 'Admin Panel','rt_theme_admin' ),
													'description' => _x('CSS Class Name', 'Admin Panel','rt_theme_admin' ),
													'type'        => 'textfield'
												),


												array(
													'param_name'  => 'margin_top',
													'heading'     => _x( 'Margin Top', 'Admin Panel','rt_theme_admin' ),
													'description' => _x( 'Set margin top value (px,%)', 'Admin Panel','rt_theme_admin' ),
													'type'        => 'rt_number',
													'group'       => _x( 'Margins', 'Admin Panel','rt_theme_admin' ),
												),

												array(
													'param_name'  => 'margin_bottom',
													'heading'     => _x( 'Margin Bottom', 'Admin Panel','rt_theme_admin' ),
													'description' => _x( 'Set margin bottom value (px,%)', 'Admin Panel','rt_theme_admin' ),
													'type'        => 'rt_number',
													'group'       => _x( 'Margins', 'Admin Panel','rt_theme_admin' ),
												),

												array(
													'param_name'  => 'margin_left',
													'heading'     => _x( 'Margin Left', 'Admin Panel','rt_theme_admin' ),
													'description' => _x( 'Set margin left value (px,%)', 'Admin Panel','rt_theme_admin' ),
													'type'        => 'rt_number',
													'group'       => _x( 'Margins', 'Admin Panel','rt_theme_admin' ),
												),

												array(
													'param_name'  => 'margin_right',
													'heading'     => _x( 'Margin Right', 'Admin Panel','rt_theme_admin' ),
													'description' => _x( 'Set margin right value (px,%)', 'Admin Panel','rt_theme_admin' ),
													'type'        => 'rt_number',
													'group'       => _x( 'Margins', 'Admin Panel','rt_theme_admin' ),
												),	


												array(
													'param_name'  => 'padding_top',
													'heading'     => _x( 'Padding Top', 'Admin Panel','rt_theme_admin' ),
													'description' => _x( 'Set padding top value (px,%)', 'Admin Panel','rt_theme_admin' ),
													'type'        => 'rt_number',
													'group'       => _x( 'Paddings', 'Admin Panel','rt_theme_admin' ),
												),

												array(
													'param_name'  => 'padding_bottom',
													'heading'     => _x( 'Padding Bottom', 'Admin Panel','rt_theme_admin' ),
													'description' => _x( 'Set padding bottom value (px,%)', 'Admin Panel','rt_theme_admin' ),
													'type'        => 'rt_number',
													'group'       => _x( 'Paddings', 'Admin Panel','rt_theme_admin' ),
												),

												array(
													'param_name'  => 'padding_left',
													'heading'     => _x( 'Padding Left', 'Admin Panel','rt_theme_admin' ),
													'description' => _x( 'Set padding left value (px,%)', 'Admin Panel','rt_theme_admin' ),
													'type'        => 'rt_number',
													'group'       => _x( 'Paddings', 'Admin Panel','rt_theme_admin' ),
												),

												array(
													'param_name'  => 'padding_right',
													'heading'     => _x( 'Padding Right', 'Admin Panel','rt_theme_admin' ),
													'description' => _x( 'Set padding right value (px,%)', 'Admin Panel','rt_theme_admin' ),
													'type'        => 'rt_number',
													'group'       => _x( 'Paddings', 'Admin Panel','rt_theme_admin' ),
												),	


										),								

					),


					/*
						ToolTips
					*/						

					"tooltip" => array( 

						"name"=> __('ToolTips','rt_theme_admin'),
						"description"=> __('Displays a tooltip text when hover the item that inside the brackets.','rt_theme_admin'),
						"subline" => false,
						"id"=> 'tooltip',
						"open" => true,
						"close" => true,
						"content" => array(
										"shortcode_id" => '',
										"text" => 'Content text'
									),
						"parameters" => array(

											array(
												"param_name" => 'text',
												"description"=> 'ToolTip Text',
												"default_value" => 'Tooltip Text',
											),

											array(
												"param_name" => 'link',
												"description"=> 'Link (url)',
												"default_value" => '',
											),

											array(
												"param_name" => 'target',
												"description"=> __('Link Target','rt_theme_admin'),
												"default_value" => '',
												"value" => array(
																		"_self" => __('Same Window','rt_theme_admin'),
																		"_blank" => __('New Window','rt_theme_admin'),
																	),
											),	

											array(
												"param_name" => 'placement',
												"description"=> __('ToolTip placement','rt_theme_admin'),
												"default_value" => 'top',
												"value" => array(
																		"left" => __('left','rt_theme_admin'),
																		"bottom" => __('bottom','rt_theme_admin'),
																		"right" => __('right','rt_theme_admin'),
																		"top" => __('top','rt_theme_admin'),																
																	),
											),	

										),								

					),

					/*
						Counter
					*/						

					"rt_counter" => array( 

						"name"=> __('Animated Number','rt_theme_admin'),
						"description"=> __('Displays an animated number','rt_theme_admin'),
						"subline" => false,
						"id"=> 'rt_counter',
						"open" => true,
						"close" => true,
						"content" => array(
										"shortcode_id" => '',
										"text" => 'Number Description'
									),
						"parameters" => array(

													array(
														'param_name'  => 'id',
														'heading'     => __('ID', 'rt_theme_admin' ),
														'description' => __('Unique ID', 'rt_theme_admin' ),
														'type'        => 'textfield',
														'value'       => ''
													),

													array(
														'param_name'  => 'number',
														'heading'     => __('Number', 'rt_theme_admin' ),
														'type'        => 'rt_number',
														'value'       => '99',
														'holder'      => 'h2',
													), 

										),								

					),

					/*
						Info Box
					*/						

					"info_box" => array( 

						"name"=> __('Info Box','rt_theme_admin'),
						"description"=> __('Creates an info box','rt_theme_admin'),
						"subline" => false,
						"id"=> 'info_box',
						"open" => true,
						"close" => true,
						"content" => array(
										"shortcode_id" => '',
										"text" => 'Content text'
									),
						"parameters" => array( 

											array(
												"param_name" => 'style',
												"description"=> __('Box style','rt_theme_admin'),
												"default_value" => 'info',
												"value" => array(
																		"info" => __('Info','rt_theme_admin'),
																		"announcement" => __('Announcement','rt_theme_admin'),
																		"ok" => __('OK','rt_theme_admin'),
																		"attention" => __('Attention','rt_theme_admin'),
																	),
											),	

											array(
												'param_name'  => 'id',
												'heading'     => __('ID', 'rt_theme_admin' ),
												'description' => __('Unique ID', 'rt_theme_admin' ),
												'type'        => 'textfield',
												'value'       => ''
											),

											array(
												'param_name'  => 'class',
												'heading'     => __('Class', 'rt_theme_admin' ),
												'description' => __('CSS Class Name', 'rt_theme_admin' ),
												'type'        => 'textfield'
											),

										),								

					),


					/*
						Buttons
					*/			

					"button" => array(
						"name"=> __('Button','rt_theme_admin'),
						"description"=> __('Creates button.','rt_theme_admin'),
						"subline" => false,
						"id"=> 'button',
						"open" => true,
						"close" => false,
						"content" => array(
										"shortcode_id" => '',
										"text" => ''
									),
						"parameters" => array(


											/* button */
											array(
												'param_name'  => 'button_text',
												'heading'     => __('Button Text', 'rt_theme_admin' ),
												'type'        => 'textfield',
												'value'       => '',
												'default_value' => 'Button Text',
												'holder'      => 'span'
											),

											array(
												'param_name'  => 'button_size',
												'heading'     => __( 'Button Size', 'rt_theme_admin' ),
												'type'        => 'dropdown',
												'default_value' => 'small',
												"value"       => array(
																			"small" => __("Small", "rt_theme_admin"),
																			"medium" => __("Medium", "rt_theme_admin"),
																			"big" => __("Big", "rt_theme_admin"),
																		),
											),

											array(
												'param_name'  => 'button_style',
												'heading'     => __( 'Button Style', 'rt_theme_admin' ),
												'type'        => 'dropdown',
												'default_value' => 'default',
												"value"       => array(
																	"default" => __("Default Flat", "rt_theme_admin"),
																	"color" => __("Colored Flat", "rt_theme_admin"),
																),
											),

											array(
												'param_name'  => 'button_icon',
												'heading'     => __('Button Icon', 'rt_theme_admin' ),
												'type'        => 'textfield',
												'value'       => '',
											),

											array(
												'param_name'  => 'button_align',
												'heading'     => __( 'Button Align', 'rt_theme_admin' ),
												'type'        => 'dropdown',
												"value"       => array(
																			"" => __("Default", "rt_theme_admin"),
																			"left" => __("Left", "rt_theme_admin"),
																			"right" => __("Right", "rt_theme_admin"),
																			"center" => __("Center", "rt_theme_admin"),
																),
											),	

											array(
												'param_name'  => 'button_link',
												'heading'     => __('Link', 'rt_theme_admin' ),
												'type'        => 'textfield',
												'value'       => '',
											),

											array(
												'param_name'  => 'link_open',
												'heading'     => __('Link Target', 'rt_theme_admin' ),
												'type'        => 'dropdown',
												'default_value' => '_self',
												"value"       => array(
																			"_self" => __("Same Tab", "rt_theme_admin"),
																			"_blank" => __("New Tab", "rt_theme_admin"), 
																		),
											),

											array(
												'param_name'  => 'href_title',
												'heading'     => __('Link Title', 'rt_theme_admin' ),
												'type'        => 'dropdown',
												'type'        => 'textfield',
											),		

											array(
												'param_name'  => 'id',
												'heading'     => __('ID', 'rt_theme_admin' ),
												'description' => __('Unique ID', 'rt_theme_admin' ),
												'type'        => 'textfield',
												'value'       => ''
											),

											array(
												'param_name'  => 'class',
												'heading'     => __('Class', 'rt_theme_admin' ),
												'description' => __('CSS Class Name', 'rt_theme_admin' ),
												'type'        => 'textfield'
											),

										),				
					),


					/*
						Banners
					*/			

					"banner" => array(
						"name"=> __('Banner','rt_theme_admin'),
						"description"=> __('Creates banners.','rt_theme_admin'),
						"subline" => false,
						"id"=> 'banner_box',
						"open" => true,
						"close" => true,
						"content" => array(
										"shortcode_id" => '',
										"text" => 'Banner Text'
									),
						"parameters" => array(

												array(
													'param_name'  => 'id',
													'heading'     => __('ID', 'rt_theme_admin' ),
													'description' => __('Unique ID', 'rt_theme_admin' ),
													'type'        => 'textfield',
													'value'       => ''
												),

												array(
													'param_name'  => 'class',
													'heading'     => __('Class', 'rt_theme_admin' ),
													'description' => __('CSS Class Name', 'rt_theme_admin' ),
													'type'        => 'textfield'
												),


												/* button */

												array(
													'param_name'  => 'button_text',
													'heading'     => __('Button Text', 'rt_theme_admin' ),
													'type'        => 'textfield',
													'value'       => '',
													'default_value' => 'Button Text',
													'group'       => 'Button'
												),

												array(
													'param_name'  => 'button_size',
													'heading'     => __( 'Button Size', 'rt_theme_admin' ),
													'type'        => 'dropdown',
													'default_value' => 'small',
													"value"       => array(
																				"small" => __("Small", "rt_theme_admin"),
																				"medium" => __("Medium", "rt_theme_admin"),
																				"big" => __("Big", "rt_theme_admin"),
																			),
												),

												array(
													'param_name'  => 'button_style',
													'heading'     => __( 'Button Style', 'rt_theme_admin' ),
													'type'        => 'dropdown',
													'default_value' => 'default',
													"value"       => array(
																		"default" => __("Default Flat", "rt_theme_admin"),
																		"color" => __("Colored Flat", "rt_theme_admin"),
																	),
												),
													
												array(
													'param_name'  => 'button_icon',
													'heading'     => __('Icon', 'rt_theme_admin' ),
													'type'        => 'textfield',
													'value'       => '',
													'group'       => 'Button'
												),

												array(
													'param_name'  => 'button_link',
													'heading'     => __('Link', 'rt_theme_admin' ),
													'type'        => 'textfield',
													'value'       => '',
													'group'       => 'Button'
												),

												array(
													'param_name'  => 'link_open',
													'heading'     => __('Link Target', 'rt_theme_admin' ),
													'type'        => 'dropdown',
													'default_value' => '_self',
													"value"       => array(
																				"_self" => __("Same Tab", "rt_theme_admin"),
																				"_blank" => __("New Tab", "rt_theme_admin"), 
																			),
												),										

												array(
													'param_name'  => 'href_title',
													'heading'     => __('Link Title', 'rt_theme_admin' ),
													'type'        => 'dropdown',
													'type'        => 'textfield',
													'group'       => 'Button'
												),		
										

										),				
					),


					/*
						Heading 
					*/			

					"rt_heading" => array(
						"name"=> __('Heading','rt_theme_admin'),
						"description"=> __('Creates a styled heading','rt_theme_admin'),
						"subline" => false,
						"id"=> 'rt_heading',
						"open" => true,
						"close" => true,
						"content" => array(
										"shortcode_id" => '',
										"text" => 'Heading Text'
									),
						"parameters" => array(

													array(
														'param_name'  => 'style',
														'heading'     => __( 'Style', 'rt_theme_admin' ),
														'description' => __( 'Select a style', 'rt_theme_admin' ),
														'type'        => 'dropdown',
														'default_value' => 'style-1',
														"value"       => array(
																					"style-1" => __("Style One - ( w/ a short thin line below )", "rt_theme_admin"),
																					"style-2" => __("Style Two - ( w/ an arrow points the heading )", "rt_theme_admin"),
																					"style-3" => __("Style Three - ( w/ lines before and after )", "rt_theme_admin"),
																					"style-4" => __("Style Four - ( w/ a thin line below and punchline - centered ) ", "rt_theme_admin"), 
																					"style-5" => __("Style Five - ( w/ a thin line below and punchline - left aligned ) ", "rt_theme_admin"),
																					"style-6" => __("Style Six - ( w/ a line after - left aligned )  ", "rt_theme_admin"), 
																					"style-7" => __("Style Seven - (centered) ", "rt_theme_admin"),
																					"" => __("No-Style", "rt_theme_admin"),
																				),
													),

													array(
														'param_name'  => 'punchline',
														'heading'     => __('Punchline', 'rt_theme_admin' ),
														'description' => __('Optional puchline text', 'rt_theme_admin' ),
														'type'        => 'textfield',
														"dependency"  => array(
																		"element" => "style",
																		"value" => array("style-4","style-5")
														),										
													),


													array(
														'param_name'  => 'size',
														'heading'     => __( 'Size', 'rt_theme_admin' ),
														'description' => __( 'Select the size of the heading tag', 'rt_theme_admin' ),
														'type'        => 'dropdown',
														'default_value' => 'h1',
														"value"       => array(
																			"h1" => "H1", 
																			"h2" => "H2", 
																			"h3" => "H3", 
																			"h4" => "H4", 
																			"h5" => "H5", 
																			"h6" => "H6", 
																		),
													),

													array(
														'param_name'  => 'icon_name',
														'heading'     => __('Icon Name', 'rt_theme_admin' ),
														'description' => __('Click inside the field to select an icon or type the icon name', 'rt_theme_admin' ),
														'type'        => 'textfield',
														'class'       => 'icon_selector'
													),



													array(
														'param_name'  => 'font_color_type',
														'heading'     => _x( 'Font Color', 'Admin Panel','rt_theme_admin' ),
														'type'        => 'dropdown',
														"value"       => array(
																			"" => _x("Default Heading Color", 'Admin Panel','rt_theme_admin'),
																			"custom" => _x("Custom Color", 'Admin Panel','rt_theme_admin'),
																			"primary" => _x("Primary Color", 'Admin Panel','rt_theme_admin'),
																		),
														'save_always' => true
													),

													array(
														'param_name'  => 'font_color',
														'heading'     => _x('Custom Font Color', 'Admin Panel','rt_theme_admin' ),
														'type'        => 'colorpicker',
														"dependency"  => array(
																		"element" => "font_color_type",
																		"value" => array("custom")
														),											
													),

													array(
														'param_name'  => 'font_size',
														'heading'     => _x('Custom Font Size (px)', 'Admin Panel','rt_theme_admin' ),
														'type'        => 'rt_number'
													),

													array(
														'param_name'  => 'line_height',
														'heading'     => _x('Custom Line Height (px)', 'Admin Panel','rt_theme_admin' ),
														'type'        => 'rt_number'
													),
													
													array(
														'param_name'  => 'letter_spacing',
														'heading'     => _x('Custom Letter Spacing (px)', 'Admin Panel','rt_theme_admin' ),
														'type'        => 'rt_number'
													),

													array(
														'param_name'  => 'id',
														'heading'     => __('ID', 'rt_theme_admin' ),
														'description' => __('Unique ID', 'rt_theme_admin' ),
														'type'        => 'textfield',
														'value'       => ''
													),

													array(
														'param_name'  => 'class',
														'heading'     => __('Class', 'rt_theme_admin' ),
														'description' => __('CSS Class Name', 'rt_theme_admin' ),
														'type'        => 'textfield'
													),
										),				
					),


					/*
						Space
					*/			
					"space_box" => array(
						"name"=> __('Space','rt_theme_admin'),
						"subline" => '',
						"id"=> 'space_box',
						"description"=> __('Puts a space.','rt_theme_admin'),
						"open" => true,
						"close" => false,	
						"content" => array(
										"shortcode_id" => '',
										"text" => ''
									),					
						"parameters" => array(
											array(
												"param_name" => 'id',
												"description"=> __('unique id','rt_theme_admin'),
												"default_value" => '', 
											),
											array(
												"param_name" => 'height',
												"description"=> __('Height value (do not include px, number only)','rt_theme_admin'),
												"default_value" => ''
											),									
										),
					),


					/*
						Highlights
					*/			
					"rt_highlight" => array(
						"name"=> __('Highlight','rt_theme_admin'),
						"subline" => '',
						"id"=> 'rt_highlight',
						"description"=> __('Highlights a text','rt_theme_admin'),
						"open" => true,
						"close" => true,	
						"content" => array(
										"shortcode_id" => '',
										"text" => 'Text'
									),					
						"parameters" => array(
												array(
													"param_name" => 'style',
													"description"=> __('Style','rt_theme_admin'),
													"default_value" => 'style-1',
													"value" => array(
																			"style-1" => __('Style 1','rt_theme_admin'),
																			"style-2" => __('Style 2','rt_theme_admin'),
																		),
												),								
										),
					),


					/*
						scrollto
					*/			
					"rt_scroll" => array(
						"name"=> __('Animated Scroll Links','rt_theme_admin'),
						"subline" => '',
						"id"=> 'rt_scroll',
						"description"=> __('Adds a link to the content between the brackets that scrolls to the target ID with animation when clicked.','rt_theme_admin'),
						"open" => true,
						"close" => true,	
						"content" => array(
										"shortcode_id" => '',
										"text" => 'Text'
									),					
						"parameters" => array(
												array(
													"param_name" => 'target',
													"description"=> __('ID of the target. Example "target" do not use "#" hash tags.','rt_theme_admin'),
													"default_value" => '',
												),		

												array(
													"param_name" => 'title',
													"description"=> __('Link title','rt_theme_admin'),
													"default_value" => '',
												),																			

												array(
													'param_name'  => 'class',
													'heading'     => __('Class', 'rt_theme_admin' ),
													'description' => __('CSS Class Name', 'rt_theme_admin' ),
													'type'        => 'textfield'
												),												
										),
					),


				);


				//example shortcodes
				$this->shortcode_examples = array(
		 
					 
					/*
						Columns
					*/			
					"rt_cols" => array(
						__('Two Columns Example','rt_theme_admin') => '
						[rt_cols]
							
							[rt_col width="6/12"]
								Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
							[/rt_col]

							[rt_col width="6/12"]
								Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
							[/rt_col]

						[/rt_cols]
						',

						__('Three Columns Example','rt_theme_admin') => '
						[rt_cols]

							[rt_col width="4/12"]
								Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
							[/rt_col]					

							[rt_col width="4/12"]
								Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
							[/rt_col]

							[rt_col width="4/12"]
								Lorem ipsum dolor sit amet, consectetuer adipiscing elit. 
							[/rt_col]

						[/rt_cols]
						',				

						),

					/*
						Columns
					*/			
					"rt_pricing_table" => array(
						__('Pricing Table Example','rt_theme_admin') => '
						[rt_pricing_table style="service"]
						[rt_table_column caption="BASIC PACKAGE" price="$19" info="yearly plan"]
						<ul>
							<li>[tooltip text="Tooltip Text"]Description With Tooltip[/tooltip]</li>
							<li>10 MB Max File Size</li>
							<li>1 GHZ CPU</li>
							<li>256 MB Memory</li>
							<li>[button button_link="#" button_text="BUY NOW" button_size="medium" button_icon="icon-basket"]</li>
						</ul>
						[/rt_table_column]

						[rt_table_column caption="PRO PACKAGE" price="49$" info="yearly plan" style="highlight"]
						<ul>
							<li>[tooltip text="Tooltip Text"]Description With Tooltip[/tooltip]</li>
							<li>20 MB Max File Size</li>
							<li>2 GHZ CPU</li>
							<li>512 MB Memory</li>
							<li>[button button_link="#" button_text="BUY NOW" button_size="medium" button_icon="icon-basket"]</li>
						</ul>
						[/rt_table_column]

						[rt_table_column caption="DEVELOPER PACKAGE" price="$109" info="monthly plan"]
						<ul>
							<li>[tooltip text="Tooltip Text"]Description With Tooltip[/tooltip]</li>
							<li>200 MB Max File Size</li>
							<li>3 GHZ CPU</li>
							<li>1000 MB Memory</li>
							<li>[button button_link="#" button_text="BUY NOW" button_size="medium" button_icon="icon-basket"]</li>
						</ul>
						[/rt_table_column]
						[/rt_pricing_table]
						',				

						__('Compare Table Example','rt_theme_admin') => '
						[rt_pricing_table style="compare"]
						[rt_table_column style="features"]
						<ul>
							<li>Use Tooltips</li>
							<li>Use Icons</li>
							<li>CPU</li>
							<li>Memory</li>
						</ul>
						[/rt_table_column]

						[rt_table_column caption="BASIC PACKAGE" price="$19" info="yearly plan"]
						<ul>
							<li>[tooltip text="Tooltip Text"][icon name="icon-info-circled"][/tooltip]</li>
							<li>[icon name="icon-cancel"]</li>
							<li>[icon name="icon-cancel"]</li>
							<li>256 MB Memory</li>
							<li>[button button_link="#" button_text="BUY NOW" button_size="small" button_icon="icon-basket"]</li>
						</ul>
						[/rt_table_column]

						[rt_table_column caption="START PACKAGE" price="49$" info="yearly plan" style="highlight"]
						<ul>
							<li>[tooltip text="Tooltip Text"][icon name="icon-info-circled"][/tooltip]</li>
							<li>[icon name="icon-ok"]</li>
							<li>[icon name="icon-ok"]</li>
							<li>512 MB Memory</li>
							<li>[button button_link="#" button_text="BUY NOW" button_size="small" button_icon="icon-basket"]</li>
						</ul>
						[/rt_table_column]

						[rt_table_column caption="PRO PACKAGE" price="109$" info="monthly plan"]
						<ul>
							<li>[tooltip text="Tooltip Text"][icon name="icon-info-circled"][/tooltip]</li>
							<li>[icon name="icon-ok"]</li>
							<li>[icon name="icon-ok"]</li>
							<li>1000 MB Memory</li>
							<li>[button button_link="#" button_text="BUY NOW" button_size="small" button_icon="icon-basket"]</li>
						</ul>
						[/rt_table_column]
						[/rt_pricing_table]
						',				
						),



					/*
						Photo Gallery
					*/			
					"rt_image_gallery" => array(
						__('Example 1','rt_theme_admin') => '
						[rt_image_gallery list_layout="1/4" crop="true" tooltips="true"]
							[rt_gal_item action="lightbox" link_target="_self" image_id="THE-IMAGE-ID" title="Title"]Optional caption text[/rt_gal_item]
							[rt_gal_item action="lightbox" custom_link="" link_target="_self" id="" image_id="THE-IMAGE-ID" title="Title"]Optional caption text[/rt_gal_item]
							[rt_gal_item action="lightbox" custom_link="" link_target="_self" id="" image_id="THE-IMAGE-ID" title="Title"]Optional caption text[/rt_gal_item]
							[rt_gal_item action="lightbox" custom_link="" link_target="_self" id="" image_id="THE-IMAGE-ID" title="Title"]Optional caption text[/rt_gal_item]
						[/rt_image_gallery]
						',				

						),

					/*
						Photo slider
					*/			
					"rt_slider" => array(
						__('Example 1','rt_theme_admin') => '
						[rt_slider min_height="400" autoplay="" parallax="" timeout="5000"]					
							[rt_slide content_color_schema="default-style" content_wrapper_width="default" content_width="40" content_align="right" link_target="_self" bg_image_repeat="no-repeat" bg_size="cover" bg_position="right top" content_bg_color="#ffffff" bg_image=""]
								<h2>Slide Caption</h2>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
							[/rt_slide]
							[rt_slide content_color_schema="default-style" content_wrapper_width="default" content_width="40" content_align="right" link_target="_self" bg_image_repeat="no-repeat" bg_size="cover" bg_position="right top" content_bg_color="#ffffff" bg_image=""]
								<h2>Slide Caption</h2>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
							[/rt_slide]
						[/rt_slider]
						',				

						),			


					/*
						Google Maps
					*/			
					"google_maps" => array(
						__('Example With 3 Locations','rt_theme_admin') => '
						[google_maps height="300"]
							[location title="Eiffel Tower" lat="48.8582285" lon="2.2943877000000157"]Location description for Eiffel Tower[/location]
							[location title="Big Ben" lat="51.5007046" lon="-0.12457480000000487"]Location description for Big Ben[/location]
							[location title="Leaning Tower of Pisa" lat="43.722952" lon="10.396596999999929"]Location description for Pisa Tower[/location]
						[/google_maps]
						',				

						),			

					/*
						Icon List
					*/			
					"rt_icon_list" => array(
						__('Example With 3 lines','rt_theme_admin') => '
							[rt_icon_list list_style="style-1" id=""]
								[rt_icon_list_line icon_name="icon-address"]63739 street lorem ipsum City, Country[/rt_icon_list_line]
								[rt_icon_list_line icon_name="icon-phone"]+1 123 312 32 23[/rt_icon_list_line]
								[rt_icon_list_line icon_name="icon-mobile"]+1 123 312 32 24[/rt_icon_list_line]
								[rt_icon_list_line icon_name="icon-mail-1"]info@company.com[/rt_icon_list_line]
							[/rt_icon_list]
						',				

						),			

					/*
						Tabs
					*/			
					"rt_tabs" => array(
						__('Example With 3 tabs','rt_theme_admin') => '
						[rt_tabs tabs_style="style-1" id=""]

							[rt_tab title="Tab 1" tab_id=""]
								I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.
							[/rt_tab]

							[rt_tab title="Tab 2" tab_id=""]
								I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.
							[/rt_tab]

						[/rt_tabs]
						',				

						__('Vertical Tabs Example','rt_theme_admin') => '
						[rt_tabs tabs_style="style-3" id=""]

							[rt_tab title="Tab 1" tab_id=""]
								I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.
							[/rt_tab]

							[rt_tab title="Tab 2" tab_id=""]
								I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.
							[/rt_tab]
							
						[/rt_tabs]
						',

						),		

		 
					/*
						Accordions
					*/			
					"rt_accordion" => array(
						__('Example With 3 panes','rt_theme_admin') => '

						[rt_accordion style="icons" first_one_open="true"]

							[rt_accordion_content title="Pane 1 Title" icon_name="icon-home"]
							Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
							[/rt_accordion_content]

							[rt_accordion_content title="Pane 2 Title" icon_name="icon-pin"]
							Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
							[/rt_accordion_content]

							[rt_accordion_content title="Pane 3 Title" icon_name="icon-ok"]
							Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
							[/rt_accordion_content]

						[/rt_accordion]
						',				

						),		
					

					/*
						pullquote
					*/			
					"pullquote" => array(
						__('Example','rt_theme_admin') => '

						[pullquote align="left"]
							<p>
							Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
							</p>
						[/pullquote]
						',				

						),		


					/*
						video_embed
					*/			
					"rt_embed" => array(
						__('Example','rt_theme_admin') => '[rt_embed]http://www.youtube.com/watch?v=utUPth77L_o[/rt_embed]',				
						
						),		

					/*
						rt_chained_contents
					*/			
					"rt_chained_contents" => array(
						__('Example','rt_theme_admin') => '
							[rt_chained_contents style="1" align="left" id=""]
								[rt_chained_content icon_name="icon-rocket" title="Content 1"]<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>[/rt_chained_content]
								[rt_chained_content icon_name="icon-home" title="Content 2"]<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>[/rt_chained_content]
							[/rt_chained_contents]
						',				
						
						),		
		 
		 			/*
						rt_timeline
					*/			
					"rt_timeline" => array(
						__('Example','rt_theme_admin') => '
							[rt_timeline id=""]
								[rt_tl_event day="01" month="January" year="2015" title="Title"]<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum non dolor ultricies, porttitor justo non, pretium mi.</p>[/rt_tl_event]
								[rt_tl_event day="01" month="February" year="2015" title="Title"]<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum non dolor ultricies, porttitor justo non, pretium mi.</p>[/rt_tl_event]
								[rt_tl_event day="01" month="March" year="2015" title="Title"]<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum non dolor ultricies, porttitor justo non, pretium mi.</p>[/rt_tl_event]
							[/rt_timeline]
						',				
						
						),		

			);


	}

}


new rt_shortcode_helper;