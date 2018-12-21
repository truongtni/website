<form method="get"  action="<?php echo home_url(); ?>/"  class="wp-search-form rt_form">
	<ul>
		<li><input type="text" class='search showtextback' placeholder="<?php _e("search", "rt_theme"); ?>" name="s" /><span class="icon-search-1"></span></li>
	</ul>
	<?php if( defined( "ICL_LANGUAGE_CODE" ) ) : ?><input type="hidden" name="lang" value="<?php echo(ICL_LANGUAGE_CODE); ?>"/><?php endif;?>
</form>