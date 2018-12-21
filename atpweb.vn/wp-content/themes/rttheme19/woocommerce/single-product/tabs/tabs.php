<?php
/**
 * Single Product tabs
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $layout;

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );


//icons that matches with callback nanems

$tab_icons =  array(
		"description" => "icon-doc-alt",
		"reviews" => "icon-chat-empty",
		"additional_information" => "icon-info"
	);



$tabs_style = "style-".$layout["content_style"];
$class = "";


//vertical nav align
$class .= $tabs_style == "style-2" ? " left" : "";
$class .= $tabs_style == "style-3" ? " right" : "";

//tab style
$tabs_style = $tabs_style == "style-1" ? "tab-style-1" : "tab-style-2";




if ( ! empty( $tabs ) ) : ?>
 
 	<div class="rt_tabs woo_tabs clearfix <?php echo esc_attr($class); ?> <?php echo esc_attr($tabs_style); ?>" data-tab-style="<?php echo esc_attr($tabs_style); ?>">

		<ul class="tab_nav hidden-xs">
			<?php 
				$tab_counter = 1;
				foreach ( $tabs as $key => $tab ){

					//active tabs
					$class = $tab_counter == 1 ? " active" : "";

					//tab icon
					$icon =  isset( $tab_icons[$key] ) ? '<span class="'.esc_attr($tab_icons[$key]).'"></span>' : "";

					//nav item
					printf ('<li class="tab_title %2$s" id="%1$s-title" data-tab-number="%5$s">%4$s%3$s</li>',
						$key, $class, apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ), $icon, $tab_counter );

					$tab_counter++;
				}
			?>
		</ul>
		

		<div class="tab_contents">

			<?php
				$tab_counter = 1;
				foreach ( $tabs as $key => $tab ){
					
					//active tabs
					$class = $tab_counter == 1 ? " active" : "";

					//output
					printf(
					'<div class="tab_content_wrapper animation %2$s" id="%1$s" data-tab-content="%5$s">
						<div id="%1$s-inline-title" class="tab_title visible-xs" data-tab-number="%5$s">%4$s%3$s</div>
					', "tab-".$key, $class, apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ), $icon, $tab_counter );	

						echo '<div class="tab_content">';
						call_user_func( $tab['callback'], $key, $tab ); 
						echo '</div>';
					echo '</div>';

					$tab_counter++;
				}					
 
			?>

		</div><!-- / .tab_contents -->
 

		</div><!-- / .rt_tabs -->
 
<?php endif; ?>