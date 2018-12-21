<?php
/**
 * RT-Theme Social Media Icons Widget
 *
 * @author RT-Themes
 * @version 1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'Social_Media_Icons_Widget' ) ) :

class Social_Media_Icons_Widget extends WP_Widget {

	function __construct() {
		$opts =array(
					'classname' 	=> 'widget_social_media_icons',
					'description' 	=> __( 'Displays your social media icons.', 'rt_theme_admin' )
				);

		parent::__construct('social_media_icons', '['. RT_THEMENAME.']   '.__('Social Media Icons', 'rt_theme_admin'), $opts);
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		echo $before_widget;
		echo rt_social_media(); 
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		return ;
	}

	function form( $instance ) {

?>
		<p><?php _e("This widget displays your social media icons. Go to Appearence -> Customize / Social Media Options to manage your social media links.", 'rt_theme_admin')?></p>
		
<?php } } 

endif;
register_widget('Social_Media_Icons_Widget');
?>