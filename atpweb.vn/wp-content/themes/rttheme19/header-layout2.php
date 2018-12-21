	<?php global $rt_global_variables; ?>


		<?php
			//main header holder (background) width	 		
			$main_header_width = "";

			if( isset( $post ) && is_singular() ){
				$main_header_width = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'_main_header_row_background_width', true );
			}

			if( empty( $main_header_width ) || $main_header_width == "global" ){
				$main_header_width =  get_theme_mod( RT_THEMESLUG.'_main_header_row_background_width' ); 
			}

			//still can be empty for some cases 
			if( empty( $main_header_width ) ){
				$main_header_width = "fullwidth";
			}
		 
		 	//sticky header
			$sticky_header =  get_theme_mod( RT_THEMESLUG.'_sticky_header' ) ? "sticky" : "";

		?>		

	<header class="top-header <?php echo sanitize_html_class($main_header_width); ?> <?php echo sanitize_html_class($sticky_header); ?>">

		<?php
			//header content width	 	
			$header_content_width =  get_theme_mod( RT_THEMESLUG.'_main_header_row_content_width' ) == "fullwidth" ? "fullwidth" : "default"; 
		?>		

		<div class="header-elements <?php echo sanitize_html_class($header_content_width); ?>">
		
			<!-- mobile menu button -->
			<div class="mobile-menu-button icon-menu"></div>

			<?php
			/**
			 * rt_before_logo hook
			 */
			do_action("rt_before_logo"); 
			?>

			<!-- logo -->
			<div id="logo" class="site-logo">
				<?php
				/**
				 * rt_logo hook
				 * @hooked rt_logo_output - 10
				 */
				do_action("rt_logo"); 
				?>
			</div><!-- / end #logo -->

			<div class="header-right">
				<?php
				/**
				 * rt_before_navigation hook
				 *
				 * @hooked rt_display_shortcut_buttons - 1
				 */
				do_action("rt_before_navigation"); 
				?>		

				<!-- navigation holder -->
				<?php
					//call the main navigation

					$custom_main_menu = "";

					if( isset( $post ) && is_singular() ){
						$custom_main_menu = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'_custom_main_menu', true );
					}

					if ( $custom_main_menu != "" ){ // check if the current post has a custom menu

						$menuVars = array(
							'menu'            => $custom_main_menu,
							'menu_id'         => "navigation",
							'class'           => "menu",
							'echo'            => false,
							'container'       => '', 
							'container_class' => '',
							'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							'container_id'    => 'navigation_bar', 
							'theme_location'  => 'rt-theme-main-navigation',
							'walker'          => new RT_Menu_Class_Walker
						);

					}elseif ( has_nav_menu( 'rt-theme-main-navigation' ) ){ // check if user created a custom menu and assinged to the rt-theme's location

						$menuVars = array(
							'menu_id'         => "navigation",
							'class'           => "menu",
							'echo'            => false,
							'container'       => '', 
							'container_class' => '',
							'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							'container_id'    => 'navigation_bar', 
							'theme_location'  => 'rt-theme-main-navigation',
							'walker'          => new RT_Menu_Class_Walker
						);
						
					}else{
						
						$menuVars = array(
							'menu'            => __('Main Navigation','rt_theme_admin'),  
							'menu_id'         => "navigation",
							'class'           => "menu",
							'echo'            => false,
							'container'       => '',  
							'container_class' => '' ,
							'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							'container_id'    => 'navigation_bar',  
							'theme_location'  => 'rt-theme-main-navigation',
							'walker'          => new RT_Menu_Class_Walker
						);		
					}

					$main_menu=wp_nav_menu($menuVars);
				?>    

				<?php if( ! empty( $main_menu ) ):?>
					<nav>
						<?php echo $main_menu; //wp menu?> 
					</nav>
				<?php endif;?>
		
				<?php
				/**
				 * rt_after_navigation hook
				 *
				 * @hooked rt_display_shortcut_buttons - 1
				 */
				do_action("rt_after_navigation"); 
				?>

			</div><!-- / end .header-right -->

		</div>
	</header>



	<!-- main contents -->
	<div id="main_content">

	<?php 

		/**
		 * Get sub page header
		 * @hooked rt_sub_page_header_function
		 */
		do_action( "rt_sub_page_header");

	?>

	<?php 		
		/**
		 * Get page container
		 * @hooked rt_content_container
		 */	
		do_action("rt_content_container", array("action"=>"start", "sidebar"=>$rt_global_variables['sidebar_position'],"echo" => ! rt_is_composer_allowed(), "class" => $rt_global_variables["default_content_row_width"], "overlap" => apply_filters( "rt_content_overlap", false ) ) );
	?>

	<?php 		
		/**
		 * Hooks For Before Main Content
		 */	
		do_action("rt_before_main_content");
	?>			