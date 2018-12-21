	<?php global $rt_global_variables; ?>

	<!-- left side -->
	<?php
		//shadow
		$shadow = get_theme_mod( RT_THEMESLUG.'_left_side_shadow' ) != "" ? "shadow" : ""; 
	?>		

	<div id="left_side" class="fixed_position scroll classic active <?php echo esc_attr( $shadow ) ?>" data-parallax-effect="<?php echo esc_attr($rt_global_variables["page_left_parallax_effect"]) ?>">
		<!-- left side background --><div class="left-side-background-holder"><div class="left-side-background"></div></div>


		<?php
			//content align
			$side_content_align = get_theme_mod( RT_THEMESLUG.'_left_side_content_align' ) == "center" ? ' class="centered-contents"' : ""; 
		?>		
		<!-- side contents -->
		<div id="side_content"<?php echo $side_content_align?> data-position-y="0">

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

			<?php
			/**
			 * rt_before_navigation hook
			 *
			 * @hooked rt_display_shortcut_buttons - 1
			 */
			do_action("rt_before_navigation"); 
			?>

			<!-- navigation holder -->
			<div class="navigation_holder side-element">

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
					<?php echo $main_menu; //wp menu?> 
				<?php endif;?>
					
			</div><!-- / end .navigation_holder -->
	
			<?php
			/**
			 * rt_after_navigation hook
			 *
			 * @hooked rt_display_shortcut_buttons - 1
			 */
			do_action("rt_after_navigation"); 
			?>

            <!-- widgets holder -->
            <div class="widgets_holder side-element sidebar-widgets">
    			<?php get_sidebar(); ?>
            </div><!-- / end .widgets_holder -->

			<?php
			/**
			 * rt_after_sidebar_widgets hook
			 */
			do_action("rt_after_sidebar_widgets"); 
			?>


		</div><!-- / end #side_content -->


 	</div><!-- / end #left_side -->



	<!-- right side -->
	<div id="right_side" data-scrool-top="">

		<div id="top_bar" class="clearfix">

			<!-- top bar -->
			
				<div class="top_bar_container">    

		 			<!-- mobile logo -->
					<div id="mobile-logo" class="site-logo">

						<!-- mobile menu button -->
						<div class="mobile-menu-button icon-menu"></div>

						<!-- logo holder -->
						<div class="logo-holder">
							<?php
							/**
							 * rt_logo hook
							 * @hooked rt_logo_output - 10
							 */
							do_action("rt_logo"); 
							?>
						</div><!-- / end .logo-holder -->
					</div><!-- / end #mobile-logo -->


				</div><!-- / end div .top_bar_container -->    
			
		</div><!-- / end section #top_bar -->    

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
			 * Start Content Container
			 * @hooked rt_content_container
			 */	
			do_action("rt_content_container", array("action"=>"start", "echo" => ! rt_is_composer_allowed(), "class" => $rt_global_variables["default_content_row_width"], "overlap" => apply_filters( "rt_content_overlap", false ) ) );
		?>

		<?php 		
			/**
			 * Hooks For Before Main Content
			 */	
			do_action("rt_before_main_content");
		?>		