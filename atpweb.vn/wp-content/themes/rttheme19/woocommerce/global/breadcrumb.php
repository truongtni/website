<?php
/**
 * Shop breadcrumb
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 * @see         woocommerce_breadcrumb()
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $breadcrumb ) {

	echo $wrap_before;

	foreach ( $breadcrumb as $key => $crumb ) {

		echo $before;

		if ( ! empty( $crumb[1] ) && sizeof( $breadcrumb ) !== $key + 1 ) {
			echo '<a href="' . esc_url( $crumb[1] ) . '" property="item" typeof="WebPage"><span property="name">' . esc_html( $crumb[0] ) . '</span></a>';
		} else {
			echo '<span property="name">'. esc_html( $crumb[0] ).'</span>';
		}

		echo '<meta property="position" content="'. ( $key + 2 ) .'">' ;

		if ( sizeof( $breadcrumb ) !== $key + 1 ) {
			echo $delimiter;
		}

		echo $after;
		
	}

	echo $wrap_after;

}