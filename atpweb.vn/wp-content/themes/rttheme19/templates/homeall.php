<?php
/*
* Template Name: homeall
*/
?>
<?php get_header(); ?>

<div  class="content_row row vc_row wpb_row vc_row-fluid default-style fullwidth" style="background-color: #0096d5;">
	
	<div class="content_row_wrapper  default" >
	<div class="vc_col-sm-12 wpb_column vc_column_container" >
		<div class="wpb_wrapper">
			
	<div class="wpb_text_column wpb_content_element ">
		<div class="wpb_wrapper">
			<h3 style="text-align: center;"><span style="color: #ffffff;">Hỗ trợ nhiệt tình. Sử dụng đơn giản!</span><br />
<span style="color: #ffffff;"> Giải pháp phù hợp với yêu cầu của bạn</span><br />
<span style="color: #ffffff;"> Chỉ với 3 phút bạn sẽ biết được có nên hợp tác với chúng tôi hay không.</span></h3>

		</div>
	</div>


		</div>
	</div>

</div>
</div>
<div  class="content_row row vc_row wpb_row vc_row-fluid default-style fullwidth" style="background-color: #FFFFFF;">
	
	<div class="content_row_wrapper  default" >
	<div class="vc_col-sm-12 wpb_column vc_column_container" >
		<div class="wpb_wrapper">
			
	<div class="wpb_text_column wpb_content_element ">
		<div class="rt_heading_wrapper style-4">
			<h4 class="rt_heading  style-4" > THIẾT KẾ CHUYÊN NGHIỆP, HIỆN ĐẠI </h4>
			<div class="wpb_wrapper">
<p style="text-align: center;">Chuyên nghiệp, tận tình để tạo ra những trải nghiệm tốt về chất lượng dịch vụ trong mắt khách hàng.</p>
</div>
		</div>
	</div>


		</div>
	</div>

</div>
</div>
<div class="container">
  <div class="row">
 <?php
    $vnkings = new WP_Query(array(
    'post_type'=>'product',
    'post_status'=>'publish',
    'tax_query' => array(
      array(
          'taxonomy' => 'product_cat',
          'field' => 'id',
          'terms' => '53'
      )
    ),
    'orderby' => 'menu_order+title',
    'order' => 'desc',
    'posts_per_page'=> '999'));
    ?>
 
<?php 
$i=0; 
while ($vnkings->have_posts()) : $vnkings->the_post(); $i++;

?>

	<div class="col-sm-3" style="min-height: 298px;">
       <p id="hHQljLa"><a href="<?=LINKWEB?>/w/?theme=<?=get_the_id()?>"><?php the_post_thumbnail("medium",array( "title" => get_the_title(),"alt" => get_the_title() ));?></a></p>
<p class="button">
    <a href="<?=LINKWEB?>/w/?theme=<?=get_the_id()?>">Demo</a>
    <a href="<?php the_permalink() ;?>">Tạo web</a>
    </p>
<p style="text-align: center;"><?php the_title() ;?></p>

	 </div>

<?php		
if($i%4==0){?>
	</div>
</div>
<div class="container">
  <div class="row">
<?php }
	endwhile ; wp_reset_query() ;
?>

    
  </div>
</div>

<?php get_footer(); ?>