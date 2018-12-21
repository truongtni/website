	<?php global $rt_global_variables; ?>
	
	<?php get_template_part("top-bar") ?> 

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
			<div class="mobile-menu-button"><span></span><span></span><span></span></div>


			<div class="header-left">
				<?php
				/**
				 * rt_header_left hook 
				 * @hooked rtframework_second_main_navigation - 20
				 * @hooked rt_header_left_sideber - 30
				 * 
				 */
				do_action("rt_header_left"); 
				?>
			</div><!-- / end .header-left -->

			<div class="header-center">

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
				 * rt_after_logo hook
				 */
				do_action("rt_after_logo"); 
				?>

			</div><!-- / end .header-center -->

			<div class="header-right">
				<?php
				/**
				 * rt_header_right hook 
				 * @hooked rt_header_right_sideber - 10
				 * @hooked rtframework_main_navigation - 20
				 * @hooked rt_top_shortcut_buttons_s2 - 30
				 * 
				 */
				do_action("rt_header_right"); 
				?>
			</div><!-- / end .header-right -->

			<?php
			/**
			 * rt_after_header_elements hook
			 * @hooked rt_mobile_menu - 30
			 *
			 */
			do_action("rt_after_header_elements"); 
			?>

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