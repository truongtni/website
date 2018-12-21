<?php
/**
 * The template for displaying single product content
 *
 * @author 		RT-Themes
 * 
 */

//get global post values
extract( rt_get_product_single_post_values( $post ) ) ;
?>

<div class="row border_grid <?php echo $content_width != "1/1" ? 'fixed_heights' : '';?> single-products" itemscope itemtype="http://schema.org/Product">
	
		<div class="product-summary col <?php echo rt_column_class( $content_width ) ?> col-xs-12">

				<?php
				/**
				 * Force this row to be 1/1 when content_width (tabs) is not 1/1
				 * if content_width is 1/1 make the columns 12/5 (slider) to 12/7 (short info)
				 */
				?>
				<div class="row <?php echo $content_width == "1/1" ? 'fixed_heights' : '';?> ">
					
					<?php if( $content_width == "1/1" ): ?>
						<div class="col col-sm-6 col-xs-12">
					<?php else:?>
						<div class="col col-sm-12 col-xs-12">
					<?php endif;?>

							<?php 
								/**
								 * call the product slider 
								 */
								
								//carousel atts
								$carousel_atts = array(  
									"id"         => $post->ID."-product-image-carosel", 
									"item_width" => 1, 
									"class"      => "product-image-carosel rt-image-carousel",
									"nav"        => "true",
									"dots"       => "false",
									"autoplay"   => "true",
									"itemprop"   => "true",
									"timeout"    => 7500
								);

								echo rt_create_image_carousel(
											apply_filters('product-showcase-single-carousel', array("rt_gallery_images" => $gallery_images, "column_width" => "6/12", "carousel_atts" => $carousel_atts, "w" => "", "h" => "") )
										);

							?> 

					<?php if( $content_width == "1/1" ): ?>
						</div><!-- end .col -->
						<div class="col col-sm-6 col-xs-12">
					<?php endif;?>

							<?php 

								/**
								 * call product price 
								 * 
								 * @hooked in /rt-framework/functions/theme_functions.php
								 */
								if ( $display_price !== "false" ){
									// call product price - hooked in /rt-framework/functions/theme_functions.php
									do_action( "rt_product_price", array( "regular_price" => $regular_price, "sale_price" => $sale_price ) );
								}

								/**
								 * short description
								 */
								$short_desc = do_shortcode( $short_desc );
								echo ! empty( $short_desc ) ? sprintf( '<p itemprop="description">%s</p>', $short_desc ) : "" ;

								/**
								 * Social Share buttons
								 */
								echo $share_buttons !== "false" ? do_shortcode( apply_filters("rt_social_share_shortcode","[rt_social_media_share]") ) : "";
						
								/**
								 * product meta
								 */
								echo '<div class="product_meta">';
								//SKU
								echo ! empty( $sku ) ? sprintf( '<span class="sku_wrapper"><span class="sku"><b>%s:</b> %s  </span></span> ', __('SKU','rt_theme'), $sku ) : "" ;
								//categories 
								echo '<span class="posted_in">' . get_the_term_list( $post->ID, 'product_categories', '<b>'._n('Category','Categories', count( get_the_terms( $post->ID , 'product_categories') ),'rt_theme') .':</b> ', ', ', '' ) . '</span>' ; 
								echo '</div>';
							 
							?>

							<meta itemprop="name" content="<?php echo get_the_title();?>">
							<meta itemprop="url" content="<?php echo get_permalink();?>"> 
							<span itemprop="offers" itemscope itemtype="http://schema.org/Offer"><meta itemprop="price" content="<?php echo $sale_price;?>"></span>
					</div><!-- end .col -->	

				</div><!-- end .row -->


		</div><!-- end .col -->	



<?php if( $content_width == "1/1" ): ?>
</div>
<div class="row product_content_row">
<?php endif;?>

			<div class="col <?php echo rt_column_class( $slider_width ) ?>  col-xs-12">

			<?php 
				/**
				 *
				 *	Product details
				 * 
				 */

				//check if tabbed page
				if( $tabbed_page ){

					
					if( $content_style != "4" ){ // Tabular style
				
						//tabs style
						$tabs_style = "style-".$content_style;

						// Main content - General Details Tab	
						$tabular_content =  $content ? sprintf('[rt_tab id="tab-general-details" title="%2$s" icon_name="icon-doc-alt"]%1$s[/rt_tab]', $content, __('General Details','rt_theme') ) : "";

						// Free Tabs	
						for($i=0; $i<$tab_count+1; $i++){ 
							$tab_icon = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'free_tab_'.$i.'_icon', true);
							$tab_name = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'free_tab_'.$i.'_title', true);
							$tab_content = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'free_tab_'.$i.'_content', true);

							if ( ! empty( $tab_name ) ){
								$tabular_content .=  sprintf('[rt_tab id="tab-%1$s" title="%2$s" icon_name="%3$s"]%4$s[/rt_tab]', $i, $tab_name, $tab_icon, $tab_content );
							}
						}

						// Attached Documents 		 	 
						$tabular_content .=  $attached_documents ? sprintf('[rt_tab id="tab-attached-documents" title="%2$s" icon_name="icon-docs"]%1$s[/rt_tab]', get_attached_documents( $attached_documents ), __('Documents','rt_theme') ) : "";


						// Comments 		
						$tabular_content .=  comments_open() ? sprintf('[rt_tab id="tab-comments" title="%2$s" icon_name="icon-chat-empty"]%1$s[/rt_tab]', "[rt_get_commnets_template]", __('Comments','rt_theme')) : "";

						//related products
						if ( is_array( $related_products ) ){
							
							$related_products_item_width = get_theme_mod(RT_THEMESLUG."_related_product_layout");
							$related_products_crop = get_theme_mod(RT_THEMESLUG."_related_product_image_crop");
							$related_products_shortcode = '[product_box ids="'.implode($related_products,',').'" id="related-products" list_layout="'.$related_products_item_width.'" layout_style="grid" pagination="false" list_orderby="date" list_order="DESC" display_titles="true" display_descriptions="true" display_price="true" featured_image_resize="true" featured_image_max_width="480" featured_image_max_height="480" featured_image_crop="'.$related_products_crop.'" item_per_page="50"]';

							$tabular_content .=  sprintf('[rt_tab id="tab-related-products" title="%2$s" icon_name="icon-link"]%1$s[/rt_tab]', $related_products_shortcode, __('Related Products','rt_theme')); 

						}


						// Create final shortcode
						$tabular_content = '[rt_tabs id="single-product-details" tabs_style="'.$tabs_style.'"]'.$tabular_content.'[/rt_tabs]';

						// Run created shortcode
						echo apply_filters("the_content",$tabular_content);

					
					}else{ // Accordion style

						// Main content - General Details Tab	
						$accordion_content =  $content ? sprintf('[rt_accordion_content id="accordion-general-details" title="%2$s" icon_name="icon-doc-alt"]%1$s[/rt_accordion_content]',  apply_filters('the_content', $content), __('General Details','rt_theme') ) : "";

						// Free Tabs	
						for($i=0; $i<$tab_count+1; $i++){ 
							$tab_icon = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'free_tab_'.$i.'_icon', true);
							$tab_name = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'free_tab_'.$i.'_title', true);
							$tab_content = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'free_tab_'.$i.'_content', true);

							if ( ! empty( $tab_name ) ){
								$accordion_content .=  sprintf('[rt_accordion_content id="accordion-%1$s" title="%2$s" icon_name="%3$s"]%4$s[/rt_accordion_content]', $i, $tab_name, $tab_icon, $tab_content );
							}
						}

						// Attached Documents 		 	 
						$accordion_content .=  $attached_documents ? sprintf('[rt_accordion_content title="'.__('Documents','rt_theme').'" icon_name="icon-docs"]%s[/rt_accordion_content]', get_attached_documents($attached_documents)) : "";


						// Comments 		
						$accordion_content .=  comments_open() ? sprintf('[rt_accordion_content title="'.__('Comments','rt_theme').'" icon_name="icon-chat-empty"]%s[/rt_accordion_content]', "[rt_get_commnets_template]") : "";

						//related products
						if ( is_array( $related_products ) ){
							
							$related_products_item_width = get_theme_mod(RT_THEMESLUG."_related_product_layout");
							$related_products_crop = get_theme_mod(RT_THEMESLUG."_related_product_image_crop");
							$related_products_shortcode = '[product_box ids="'.implode($related_products,',').'" id="related-products" list_layout="'.$related_products_item_width.'" layout_style="grid" pagination="false" list_orderby="date" list_order="DESC" display_titles="true" display_descriptions="true" display_price="true" featured_image_resize="true" featured_image_max_width="480" featured_image_max_height="480" featured_image_crop="'.$related_products_crop.'" item_per_page="50"]';

							$accordion_content .=  sprintf('[rt_accordion_content title="'.__('Related Products','rt_theme').'" icon_name="icon-link"]%s[/rt_accordion_content]', $related_products_shortcode);							
						}

						// Create final shortcode
						$accordion_content = '[rt_accordion id="single-product-details" style="icons" first_one_open="true"]'.$accordion_content.'[/rt_accordion]';


						// Run created shortcode
						echo apply_filters("the_content",$accordion_content);
					}								

				}else{
					echo apply_filters('the_content',$content);  	
					comments_template();
				}
			?>

		</div><!-- end .col -->	

</div><!-- end .row.border_grid-->
