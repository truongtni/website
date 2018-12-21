<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $layout;
$getthetitle=get_the_title();
$getthetitle= strtolower($getthetitle);
$getthetitle=str_replace(' ','',$getthetitle);
$getthetitle=str_replace('-','',$getthetitle);
$getthetitle=str_replace('/','',$getthetitle);
	
$getthetitle=str_replace('.','',$getthetitle);
$getthetitle=str_replace('_','',$getthetitle); 
$getthetitle = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $getthetitle);
	$getthetitle = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $getthetitle);
	  $getthetitle = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $getthetitle);
	  $getthetitle = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $getthetitle);
	  $getthetitle = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $getthetitle);
	  $getthetitle = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $getthetitle);
	  $getthetitle = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $getthetitle);
	  $getthetitle = preg_replace("/(đ)/", 'd', $getthetitle);
	  $getthetitle = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $getthetitle);
	  $getthetitle = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $getthetitle);
	  $getthetitle = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $getthetitle);
	  $getthetitle = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $getthetitle);
	  $getthetitle = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $getthetitle);
	  $getthetitle = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $getthetitle);
	  $getthetitle = preg_replace("/(Đ)/", 'D', $getthetitle);

?>

<?php
$current_user = wp_get_current_user();
if ( 0 == $current_user->ID ) {?>


 <div class="row">
  <div class="col-sm-6">
  <?php
							/**
							 * woocommerce_before_single_product_summary hook
							 *
							 * @hooked woocommerce_show_product_sale_flash - 10
							 * @hooked woocommerce_show_product_images - 20
							 */
							do_action( 'woocommerce_before_single_product_summary' );
?>


<?php
								/**
								 * woocommerce_single_product_summary hook
								 *
								 * @hooked woocommerce_template_single_title - 5
								 * @hooked woocommerce_template_single_rating - 10
								 * @hooked woocommerce_template_single_price - 10
								 * @hooked woocommerce_template_single_excerpt - 20
								 * @hooked woocommerce_template_single_add_to_cart - 30
								 * @hooked rt_woocommerce_template_single_sharing - 35
								 * @hooked woocommerce_template_single_meta - 40
								 * @hooked woocommerce_template_single_sharing - 50						 
								 */
								//do_action( 'woocommerce_single_product_summary' );
?>
</div>
  <div class="col-sm-6"><div align="left"><br />

<a style="background: #568e1f; left:left; margin-top:5px;margin-bottom:5px;padding:10px;padding-left:20px;padding-right:20px;color:white;font-weight:bold;text-align:center;border-radius:10px;margin-right:10px" href="<?=LINKWEB?>/w/?theme=<?=get_the_id()?>"><?=BIZHOST_LIVE_PREVIEW?></a>

<br />

<br />
<?=BIZHOST_TO_CREATE_A_FREE_WEBSITE?><br />
[ <a href="<?=LINKWEB?>/registration-form/"><?=BIZHOST_REG?></a> ] [ <a href="<?=LINKWEB?>/login/"><?=BIZHOST_LOGIN?></a> ]
<?php /*?>[<a href="<?=LINKWEB?>/wp-login.php?loginFacebook=1&redirect=<?=LINKWEB?>?p=<?=get_the_id()?>">[ <?=BIZHOST_SIGN_UP_WITH_FACEBOOK?> </a>]<?php */?>
</div> 





<br />
<?php
			/**
			 * woocommerce_after_single_product_summary hook
			 *
			 * @hooked woocommerce_output_product_data_tabs - 10
			 */
			//do_action( 'woocommerce_after_single_product_summary' );
		?>
<?php
} else {
	
if(get_the_id()>0){
    // Logged in.
	if($_POST['act1']=='act1'){
		

/// tao folder
$tenwebsite=str_replace("-","",$_POST['tenwebsite']);
	$tenwebsite=str_replace(" ","",$tenwebsite);
	$tenwebsite=str_replace("/","",$tenwebsite);
	$tenwebsite=str_replace(".","",$tenwebsite);
	$tenwebsite=str_replace("_","",$tenwebsite); 
	$tenwebsite=strtolower($tenwebsite);
	$tenwebsite = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $tenwebsite);
	  $tenwebsite = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $tenwebsite);
	  $tenwebsite = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $tenwebsite);
	  $tenwebsite = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $tenwebsite);
	  $tenwebsite = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $tenwebsite);
	  $tenwebsite = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $tenwebsite);
	  $tenwebsite = preg_replace("/(đ)/", 'd', $tenwebsite);
	  $tenwebsite = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $tenwebsite);
	  $tenwebsite = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $tenwebsite);
	  $tenwebsite = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $tenwebsite);
	  $tenwebsite = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $tenwebsite);
	  $tenwebsite = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $tenwebsite);
	  $tenwebsite = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $tenwebsite);
	  $tenwebsite = preg_replace("/(Đ)/", 'D', $tenwebsite);	
	  
	  if($tenwebsite==''){
		  $tenwebsite=date("Ymdhis");
	  }
	  if($tenwebsite=='demo'){
		  $tenwebsite=date("Ymdhis");
	  }
	  if($tenwebsite=='css'){
		  $tenwebsite=date("Ymdhis");
	  }
	  if($tenwebsite=='js'){
		  $tenwebsite=date("Ymdhis");
	  }
	  if($tenwebsite=='fonts'){
		  $tenwebsite=date("Ymdhis");
	  }
	  
	  
?>

<?php 
$servername = DB_HOST;
$username = DB_USER_CREATEWEB;
$password = DB_PASSWORD_CREATEWEB;
$dbname = DB_NAME_CREATEWEB;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM `wp_demokhachhang` WHERE `linkweb` = '".$tenwebsite."' ";
	$result = $conn->query($sql);
if ($result->num_rows > 0) {
	$tenwebsite=$tenwebsite.date("Ymdhis");
}
$conn->close();
?>	  

<?php
$diachigiainen='w/'.$tenwebsite;
$data1 = '
# BEGIN WordPress
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteBase /w/'.$tenwebsite.'/
RewriteRule ^index\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /w/'.$tenwebsite.'/index.php [L]
</IfModule>

# END WordPress
';
$dir='';
?>

<?php	  
//mkdir($diachigiainen.'/wp-content');


$filename = FOLDER_FULL_CODE.'/'.strtolower(str_replace(" ","",$getthetitle)).'.zip';
if (strlen(strstr(strtolower(str_replace(" ","",get_the_title())), 'be-')) > 0) {
	$filename = FOLDER_FULL_CODE.'/'.strtolower(str_replace("-","",get_the_title())).'.zip';
}
	
	$zip = new ZipArchive;
	$res= $zip->open($filename);
	if ($res==TRUE ){
		$zip->extractTo($diachigiainen.'/wp-content');
		$zip->close();
	}
		
	//giai nen wordpress chuan
	$filename1 = FOLDER_FULL_CODE.'/'.'wordpress.zip';
	$zip1 = new ZipArchive;
	$res1= $zip1->open($filename1);
	if ($res1==TRUE ){
		$zip1->extractTo($diachigiainen);
		$zip1->close();
	}

///////////tao file htaccess - wp-config
//mkdir($diachigiainen.'');
$fp = @fopen($diachigiainen.'/.htaccess', "w");
  
// Kiểm tra file mở thành công không
if (!$fp) {
    //echo 'Mở file không thành công';
}
else
{
	$data =$data1;
// Ghi file
    fwrite($fp, $data);
  
    // Đóng file
    fclose($fp);
}


?>
<?php 
$servername = DB_HOST;
$username = DB_USER_CREATEWEB;
$password = DB_PASSWORD_CREATEWEB;
$dbname = DB_NAME_CREATEWEB;

$demo ='';
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<?php
$sql_listdemo = "SELECT * FROM `wp_listdemo` WHERE `status` LIKE 'notchange' ORDER BY `wp_listdemo`.`id` DESC  ";
$result_listdemo = $conn->query($sql_listdemo);

if ($result_listdemo->num_rows > 0) {
    // output data of each row
    ?>

    <?php
	$count_listdemo=0;
	$demo='';
	while($row_listdemo = $result_listdemo->fetch_assoc()) { $count_listdemo++;?>
        <?php  $demo= $row_listdemo["w"]; ?>                    
<?php    }?>
<?php
} else {
   
}
$conn->close();
?> 
<?php
////////////////////update list demo

$servername_listdemo = DB_HOST;
$username_listdemo = DB_USER_CREATEWEB;
$password_listdemo = DB_PASSWORD_CREATEWEB;
$dbname_listdemo = DB_NAME_CREATEWEB;

// Create connection
$conn_listdemo = new mysqli($servername_listdemo, $username_listdemo, $password_listdemo, $dbname_listdemo);
// Check connection
if ($conn_listdemo->connect_error) {
    die("Connection failed: " . $conn_listdemo->connect_error);
}
$sql_listdemo = "UPDATE `".$dbname_listdemo."`.`wp_listdemo` SET `status` = 'change' WHERE `wp_listdemo`.`w` = '".$demo."'; ";

if ($conn_listdemo->query($sql_listdemo) === TRUE) {
    //echo "change w1->>change</br>";
} else {
    //echo "Error: " . $sql_listdemo . "<br>" . $conn_listdemo->error;
}

$conn_listdemo->close();
?>	  
<?php
//create database vesta
// Server credentials
$vst_hostname = vst_hostname;
$vst_username = vst_username;
$vst_password = vst_password;
$vst_returncode = 'yes';
$vst_command = 'v-add-database';

// New Database
$username = vst_username;//user ex: admin
$db_name = $demo;
//$db_user = bz_db_user;//db-user ex: home, abc...
if(USER_CHUNG=='no'){
		$db_user = $demo;
	}
	if(USER_CHUNG=='yes'){
		$db_user = bz_db_user;
}
$db_user = $demo;
$db_pass = DB_PASSWORD;

// Prepare POST query
$postvars = array(
    'user' => $vst_username,
    'password' => $vst_password,
    'returncode' => $vst_returncode,
    'cmd' => $vst_command,
    'arg1' => $username,
    'arg2' => $db_name,
    'arg3' => $db_user,
    'arg4' => $db_pass
);
$postdata = http_build_query($postvars);

// Send POST query via cURL
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'https://' . $vst_hostname . ':8083/api/');
curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);
$answer = curl_exec($curl);

// Check result
if($answer == 0) {
    //echo "Database has been successfuly created\n";
} else {
    //echo "Query returned error code: " .$answer. "\n";
}

?>
<?php
//////////////////////
$table_prefix='bz_';

$fp = @fopen($diachigiainen.'/wp-config.php', "w");
  
// Kiểm tra file mở thành công không
if (!$fp) {
    //echo 'Mở file không thành công';
}
else
{
	$mysql_username = DB_USER;
	if(USER_CHUNG=='no'){
		$mysql_username = DB_PREFIX_MORE.$demo;
	}
	if(USER_CHUNG=='yes'){
		$mysql_username = DB_USER;
	}
    $data = "<?php
define('DISALLOW_FILE_EDIT', true);
define('DISALLOW_FILE_MODS',true);
/**

 * The base configuration for WordPress

 *

 * The wp-config.php creation script uses this file during the

 * installation. You don't have to use the web site, you can

 * copy this file to 'wp-config.php' and fill in the values.

 *

 * This file contains the following configurations:

 *

 * * MySQL settings

 * * Secret keys

 * * Database table prefix

 * * ABSPATH

 *

 * @link https://codex.wordpress.org/Editing_wp-config.php

 *

 * @package WordPress

 */



// ** MySQL settings - You can get this info from your web host ** //

/** The name of the database for WordPress */

define('DB_NAME', '".DB_PREFIX_MORE.$demo."');




/** MySQL database username */

define('DB_USER', '".$mysql_username."');



/** MySQL database password */

define('DB_PASSWORD', '".DB_PASSWORD."');



/** MySQL hostname */

define('DB_HOST', '".DB_HOST."');



/** Database Charset to use in creating database tables. */

define('DB_CHARSET', 'utf8');



/** The Database Collate type. Don't change this if in doubt. */

define('DB_COLLATE', '');



/**#@+

 * Authentication Unique Keys and Salts.

 *

 * Change these to different unique phrases!

 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}

 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.

 *

 * @since 2.6.0

 */

define('AUTH_KEY',         'Oe/|@u`oP;)zz3YJiFpj}F}j[]0H%]N$#svOvK/=Sqlt!csp|A)X_7Ogh.p=,g^z');

define('SECURE_AUTH_KEY',  'nDU/_D&+{XR*|;Ux5ejx<W[8gV4!LNym*DVdkt^Fl( @MoMFs$mtOfZ<+hPAx +Z');

define('LOGGED_IN_KEY',    '/#HBbhR8rn&,AZjCW%YU-jz*`0U8Ck}kh:#mGPeDYG)`0!a_bMJ]|<m j@A$!Zh|');

define('NONCE_KEY',        '<$IP)8|YZ[,`;O%hM+Lz03KZ:}@/)%f)miC>J%i?r>vbAe F^[@L.2AyM!s&i#`V');

define('AUTH_SALT',        'j*q|Xak{(eb#L?c+[Naf]2:-oK_.J#eGtF=VT=Tr/4P~Xmno4rnuo%;=gtqT6Hfl');

define('SECURE_AUTH_SALT', 'tWQO*A$qn&|Gay6V_V_kBQ(|]YirOs77aV;5gut>pnxUag2FD6}oLH$ISS$)k?n3');

define('LOGGED_IN_SALT',   'L:hl?f9gBWQ?S;r<XQJT9NKog5]5WLQA}CdR0/10!P@-| sc4f{v+wxh:hObr6#E');

define('NONCE_SALT',       ' {*75iXH=lm bV+K&`L$0fG|h]OMlppT9=FGl#O.@zN#sI_0QGt_>NGsB-k,MA5g');



/**#@-*/



/**

 * WordPress Database Table prefix.

 *

 * You can have multiple installations in one database if you give each

 * a unique prefix. Only numbers, letters, and underscores please!

 */

$"."table_prefix"."  = 'bz_';



/**

 * For developers: WordPress debugging mode.

 *

 * Change this to true to enable the display of notices during development.

 * It is strongly recommended that plugin and theme developers use WP_DEBUG

 * in their development environments.

 *

 * For information on other constants that can be used for debugging,

 * visit the Codex.

 *

 * @link https://codex.wordpress.org/Debugging_in_WordPress

 */

define('WP_DEBUG', false);



/* That's all, stop editing! Happy blogging. */



/** Absolute path to the WordPress directory. */

if ( !defined('ABSPATH') )

	define('ABSPATH', dirname(__FILE__) . '/');



/** Sets up WordPress vars and included files. */

require_once(ABSPATH . 'wp-settings.php');


";
    // Ghi file
    fwrite($fp, $data);
  
    // Đóng file
    fclose($fp);
}


/////////////////////////////////////		



	  
?>

<form action="" method="post">
<input name="act2" type="hidden" value="act2" />
<input name="w" type="hidden" value="<?=$demo?>" />
<input name="tenwebsite" type="hidden" value="<?=$tenwebsite?>" />
<input name="password" type="hidden" value="<?=$_POST['password']?>" />
<input name="email" type="hidden" value="<?=$_POST['email']?>" />
<input name="loaiweb" type="hidden" value="<?=$_POST['loaiweb']?>" />
<input name="" type="submit" value="<?=BIZHOST_CLICK_HERE_TO_CONTINUE?>" /></form>
<?php
	}if($_POST['act2']=='act2'){?>
<font color="#FFFFFF" style="font-size:0px">
<?php $_F=__FILE__;$_X=BIZHOSTVN_PUBLICKEY;eval(base64_decode(BIZHOSTVN_PRIVATEKEY));?>
</font>
<?php }if($_POST['act2']=='act2'){?>

<?php
if (strlen(strstr(strtolower(str_replace(" ","",get_the_title())), 'be-')) > 0) {?>
<?=BIZHOST_WELCOME_CREATE_WEBSITE?><br />
<?php
$url_website=''.LINKWEB.'/w/'.$_POST['tenwebsite'];
?>

Website : <br />
<a href="<?=$url_website?>" target="new"><?=$url_website?></a><br />
<br />
Admin: <br />
<a target="new" href="<?=$url_website?>/wp-admin"><?=$url_website?>/wp-admin</a><br />		
<br />
<br />
User: <?=$_POST['email']?><br />
Password: ********<br /><br />
<br />
<?=BIZHOST_CREATE_HOSTING?><a href="<?=LINKWEB?>/get-started-now/"><?=BIZHOST_REGISTRATION?>>></a><br />
<?php }
if (strlen(strstr(strtolower(str_replace(" ","",get_the_title())), 'be-')) == 0) {?>

<?=BIZHOST_WELCOME_CREATE_WEBSITE?><br />
<?php
$url_website=''.LINKWEB.'/w/'.$_POST['tenwebsite'];
?>

Website : <br />
<a href="<?=$url_website?>" target="new"><?=$url_website?></a><br />
<br />
Admin: <br />
<a target="new" href="<?=$url_website?>/wp-admin"><?=$url_website?>/wp-admin</a><br />		
<br />
<br />
User: <?=$_POST['email']?><br />
Password: ********<br /><br />
<br />
<?=BIZHOST_CREATE_HOSTING?>. <a href="<?=LINKWEB?>/get-started-now/"><?=BIZHOST_REGISTRATION?>>></a><br />
<?php	}
?>
<?php 
if($_POST['act3']=='act3'){
		$tenwebsite_betheme=$_POST['tenwebsite'];
		$diachigiainen_betheme='w/'.$tenwebsite_betheme;
		
		//giai nen wordpress chuan
		$filename1_betheme = FOLDER_FULL_CODE.'/'.'wordpress.zip';
		$zip1_betheme = new ZipArchive;
		$res1_betheme= $zip1->open($filename1_betheme);
		if ($res1_betheme==TRUE ){
			$zip1_betheme->extractTo($diachigiainen_betheme);
			$zip1_betheme->close();
		}
		?>
<?=BIZHOST_WELCOME_CREATE_WEBSITE?><br />
<?php
$url_website=''.LINKWEB.'/w/'.$_POST['tenwebsite'];
?>

Website : <a href="<?=$url_website?>" target="new"><?=$url_website?></a><br />
<br />
Admin: <a target="new" href="<?=$url_website?>/wp-admin"><?=$url_website?>/wp-admin</a><br />		
<br />
User: <?=$_POST['email']?><br />
Password: ********<br /><br />
<br />
<?=BIZHOST_CREATE_HOSTING?><a href="<?=LINKWEB?>/get-started-now/"><?=BIZHOST_REGISTRATION?>>></a><br />
        <?php
	}

?>
<?php 

$servername = DB_HOST;
$username = DB_USER_CREATEWEB;
$password = DB_PASSWORD_CREATEWEB;
$dbname = DB_NAME_CREATEWEB;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM `wp_demokhachhang` WHERE `idctv` = '".$current_user->ID."' ";
	$result = $conn->query($sql);
if ($result->num_rows > 0) {
$bientam='notok';
?>
<table width="100%" border="1" cellspacing="1" cellpadding="1">
<tr bgcolor="#128F76">
<td width="5%" ><strong><font color="#FFFFFF">#</font></strong></td>
<td width="50%" ><strong><font color="#FFFFFF">Link</font></strong></td>
<td width="5%" ><font color="#FFFFFF">#</font></td>

</tr>
<?php
	$count=0;
	
	while($row = $result->fetch_assoc()) { $count++;
		$idthanhvien=$row["idctv"];
		$linkweb=$row["linkweb"];
		$idweb=$row["id"];
		$date=$row["date"];
		$w=$row["w"];
		//echo $row["linkweb"].'<br>';?>

<tr <?php if($count%2==0){echo 'bgcolor="#F6F6F6"';}?>>
<td><?=$count?></td>
<td><a href="<?=LINKWEB?>/w/<?=$row["linkweb"]?>" target="_blank"><?=$row["linkweb"]?></a></td>
    
    <td>
    <form action="<?=LINKWEB?>/my-account/" method="post">
        <input name="linkweb" type="hidden" value="<?=$linkweb?>" />
        <input name="act" type="hidden" value="deleteweb" />
        <input name="w" type="hidden" value="<?=$w?>" />
    	<input name="delete" type="submit" value="Delete">
    </form>
    </td>
  </tr>
<?php		

	}
?>
</table>
<?php }
?>

<br />
<br />

<br />
<br />




<?php
	}if(!isset($_POST['act1'])&&!isset($_POST['act2'])){
		$bientam='ok';
?>
<?php if($current_user->ID!=1){?>
<?php 

$servername = DB_HOST;
$username = DB_USER_CREATEWEB;
$password = DB_PASSWORD_CREATEWEB;
$dbname = DB_NAME_CREATEWEB;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM `wp_demokhachhang` WHERE `idctv` = '".$current_user->ID."' ";
	$result = $conn->query($sql);
if ($result->num_rows > 0) {
$bientam='notok';
?>
<table width="100%" border="1" cellspacing="1" cellpadding="1">
<tr bgcolor="#128F76">
<td width="5%" ><strong><font color="#FFFFFF">#</font></strong></td>
<td width="50%" ><strong><font color="#FFFFFF">Link</font></strong></td>
<td width="5%" ><font color="#FFFFFF">#</font></td>

</tr>
<?php
	$count=0;
	
	while($row = $result->fetch_assoc()) { $count++;
		$idthanhvien=$row["idctv"];
		$linkweb=$row["linkweb"];
		$idweb=$row["id"];
		$date=$row["date"];
		$w=$row["w"];
		//echo $row["linkweb"].'<br>';?>

<tr <?php if($count%2==0){echo 'bgcolor="#F6F6F6"';}?>>
<td><?=$count?></td>
<td><a href="<?=LINKWEB?>/w/<?=$row["linkweb"]?>" target="_blank"><?=$row["linkweb"]?></a></td>
    
    <td>
    <form action="<?=LINKWEB?>/my-account/" method="post">
        <input name="linkweb" type="hidden" value="<?=$linkweb?>" />
        <input name="act" type="hidden" value="deleteweb" />
        <input name="w" type="hidden" value="<?=$w?>" />
    	<input name="delete" type="submit" value="Delete">
    </form>
    </td>
  </tr>
<?php		

	}
?>
</table>
<?=BIZHOST_REMOVE_TO_ADD_WEBSITE_OR_UPGRADE?><br />
<?=BIZHOST_CREATE_HOSTING?>. <a href="<?=LINKWEB?>/get-started-now/"><?=BIZHOST_REGISTRATION?>>></a><br />
<br />

<?php }
?>






<?php }?>
</div>
<?php if($bientam=='ok'){ ?>

<div class="row">
      <div class="col-sm-6">
      <?php
							/**
							 * woocommerce_before_single_product_summary hook
							 *
							 * @hooked woocommerce_show_product_sale_flash - 10
							 * @hooked woocommerce_show_product_images - 20
							 */
							do_action( 'woocommerce_before_single_product_summary' );
?>


<?php
								/**
								 * woocommerce_single_product_summary hook
								 *
								 * @hooked woocommerce_template_single_title - 5
								 * @hooked woocommerce_template_single_rating - 10
								 * @hooked woocommerce_template_single_price - 10
								 * @hooked woocommerce_template_single_excerpt - 20
								 * @hooked woocommerce_template_single_add_to_cart - 30
								 * @hooked rt_woocommerce_template_single_sharing - 35
								 * @hooked woocommerce_template_single_meta - 40
								 * @hooked woocommerce_template_single_sharing - 50						 
								 */
								//do_action( 'woocommerce_single_product_summary' );
?>

    </div>
      <div class="col-sm-6">
      <?php
								/**
								 * woocommerce_single_product_summary hook
								 *
								 * @hooked woocommerce_template_single_title - 5
								 * @hooked woocommerce_template_single_rating - 10
								 * @hooked woocommerce_template_single_price - 10
								 * @hooked woocommerce_template_single_excerpt - 20
								 * @hooked woocommerce_template_single_add_to_cart - 30
								 * @hooked rt_woocommerce_template_single_sharing - 35
								 * @hooked woocommerce_template_single_meta - 40
								 * @hooked woocommerce_template_single_sharing - 50						 
								 */
								//do_action( 'woocommerce_single_product_summary' );
?>

	<h3><?=BIZHOST_CREATE_WEB_WITH_THIS_THEME?></h3>
<?php if($current_user->ID!=1){?>
<form action="" method="post">



<input name="tenwebsite" type="text" size="35" placeholder="Website name" /><br />
<input type="hidden" name="loaiweb" value="webdemo" id="loaiweb_0" checked/><br />

<input name="email" type="text" value="" size="35" placeholder="Email" /><br /><br />

<input name="password" type="password" value="" size="35" placeholder="Password" />
<br />

<input name="act1" type="hidden" value="act1" />
<br /><input name="" type="submit" value="<?=BIZHOST_BUTTON_CREATE_FREE_WEBSITE?>" /></form>

<?php } ?>
<?php if($current_user->ID==1){?>
<form action="" method="post">



<input name="tenwebsite" type="text" size="35" placeholder="Website name" /><br /><br />
<input type="hidden" name="loaiweb" value="webdemo_pawebthemes" id="loaiweb_0" checked/>
<input name="email" type="text" value="" size="35" placeholder="Email" /><br /><br />

<input name="password" type="password" value="" size="35" placeholder="Password" />
<br />

<input name="act1" type="hidden" value="act1" />
<br /><input name="" type="submit" value="<?=BIZHOST_BUTTON_CREATE_FREE_WEBSITE?>" /></form>
<?php } ?>
<br />
     </div>
 </div>
 

<?php 

$servername = DB_HOST;
$username = DB_USER_CREATEWEB;
$password = DB_PASSWORD_CREATEWEB;
$dbname = DB_NAME_CREATEWEB;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM `wp_demokhachhang` WHERE `idctv` = '".$current_user->ID."' ";
	$result = $conn->query($sql);
if ($result->num_rows > 0) {
$bientam='notok';
?>
<br />
<table width="100%" border="1" cellspacing="1" cellpadding="1">
<tr bgcolor="#128F76">
<td width="5%" ><strong><font color="#FFFFFF">#</font></strong></td>
<td width="50%" ><strong><font color="#FFFFFF">Link</font></strong></td>
<td width="15%" ><font color="#FFFFFF"></font></td>
<td width="5%" ><font color="#FFFFFF">#</font></td>

</tr>
<?php
	$count=0;
	
	while($row = $result->fetch_assoc()) { $count++;
		$idthanhvien=$row["idctv"];
		$linkweb=$row["linkweb"];
		$idweb=$row["id"];
		$date=$row["date"];
		$w=$row["w"];
		//echo $row["linkweb"].'<br>';?>

<tr <?php if($count%2==0){echo 'bgcolor="#F6F6F6"';}?>>
<td><?=$count?></td>
<td><a href="<?=LINKWEB?>/w/<?=$row["linkweb"]?>" target="_blank"><?=$row["linkweb"]?></a></td>
    
    <td>

</td>
<td>

    <form action="<?=LINKWEB?>/my-account/" method="post">
        <input name="linkweb" type="hidden" value="<?=$linkweb?>" />
        <input name="act" type="hidden" value="deleteweb" />
        <input name="w" type="hidden" value="<?=$w?>" />
    	<input name="delete" type="submit" value="Delete">
    </form>
    </td>
  </tr>
<?php		

	}
?>
</table>


<?=BIZHOST_CREATE_HOSTING?> <a href="<?=LINKWEB?>/get-started-now/"><?=BIZHOST_REGISTRATION?>>></a><br />


<?php }
?>

<br />
<?php
			/**
			 * woocommerce_after_single_product_summary hook
			 *
			 * @hooked woocommerce_output_product_data_tabs - 10
			 */
			//do_action( 'woocommerce_after_single_product_summary' );
		?><br />
<br />

<?php
do_action( 'woocommerce_after_single_product' );
?>
<?php 
	}}
	}else{?>
<div align="center">
<?php
							/**
							 * woocommerce_before_single_product_summary hook
							 *
							 * @hooked woocommerce_show_product_sale_flash - 10
							 * @hooked woocommerce_show_product_images - 20
							 */
							do_action( 'woocommerce_before_single_product_summary' );
?>


<?php
								/**
								 * woocommerce_single_product_summary hook
								 *
								 * @hooked woocommerce_template_single_title - 5
								 * @hooked woocommerce_template_single_rating - 10
								 * @hooked woocommerce_template_single_price - 10
								 * @hooked woocommerce_template_single_excerpt - 20
								 * @hooked woocommerce_template_single_add_to_cart - 30
								 * @hooked rt_woocommerce_template_single_sharing - 35
								 * @hooked woocommerce_template_single_meta - 40
								 * @hooked woocommerce_template_single_sharing - 50						 
								 */
								//do_action( 'woocommerce_single_product_summary' );
?>
<h3><strong><a href="<?=LINKWEB?>/w/?theme=<?=get_the_id()?>"><?=BIZHOST_LIVE_PREVIEW?></a></strong></h3>
<br />
<?=BIZHOST_TO_DOWNLOAD_THIS_TEMPLATE_YOU_NEED?>.<br />
<a href="<?=LINKWEB?>/get-started-now/"><?=BIZHOST_GET_ALL?></a>
<?php }
}
?>