<?php
/*
* Template Name: homeall8
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
//$query = new WP_Query( array( 'paged' => 6 ) );   // page number 6
    $vnkings = new WP_Query(array(
    'post_type'=>'product',
    'post_status'=>'publish',
    'paged' => 8,
    'tax_query' => array(
      array(
          'taxonomy' => 'product_cat',
          'field' => 'id',
          'terms' => '53'
      )
    ),
    'orderby' => 'menu_order+title',
    'order' => 'desc',
    'posts_per_page'=> '48'));
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
<center><div style="display: inline-block;">
  <a style="color: black;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
    transition: background-color .3s;
    border: 1px solid #ddd;
    margin: 0 4px;" href="<?=LINKWEB?>/">&laquo;</a>
  <a style="color: black;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
    transition: background-color .3s;
    border: 1px solid #ddd;
    margin: 0 4px;" href="<?=LINKWEB?>/templates1">1</a>
  <a style="color: black;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
    transition: background-color .3s;
    border: 1px solid #ddd;
    margin: 0 4px;" href="<?=LINKWEB?>/templates2">2</a>
  <a style="color: black;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
    transition: background-color .3s;
    border: 1px solid #ddd;
    margin: 0 4px;" href="<?=LINKWEB?>/templates3">3</a>
  <a style="color: black;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
    transition: background-color .3s;
    border: 1px solid #ddd;
    margin: 0 4px;" href="<?=LINKWEB?>/templates4">4</a>
  <a style="color: black;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
    transition: background-color .3s;
    border: 1px solid #ddd;
    margin: 0 4px;" href="<?=LINKWEB?>/templates5">5</a>
  <a style="color: black;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
    transition: background-color .3s;
    border: 1px solid #ddd;
    margin: 0 4px;" href="<?=LINKWEB?>/templates6">6</a>
  <a style="color: black;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
    transition: background-color .3s;
    border: 1px solid #ddd;
    margin: 0 4px;" href="<?=LINKWEB?>/templates7">7</a>
  <a style="color: black;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
    transition: background-color .3s;
    border: 1px solid #ddd;
    margin: 0 4px;background-color: #4CAF50;
    color: white;
    border: 1px solid #4CAF50;" href="<?=LINKWEB?>/templates8">8</a>
  <a style="color: black;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
    transition: background-color .3s;
    border: 1px solid #ddd;
    margin: 0 4px;" href="<?=LINKWEB?>/templates8">&raquo;</a>
</div><br><br><br><br></center>
<?php get_footer(); ?>