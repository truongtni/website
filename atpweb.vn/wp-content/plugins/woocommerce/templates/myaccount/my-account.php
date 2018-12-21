<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();

/**
 * My Account navigation.
 * @since 2.6.0
 */
//do_action( 'woocommerce_account_navigation' ); ?>

<div class="woocommerce-MyAccount-content">
	<?php
		/**
		 * My Account content.
		 * @since 2.6.0
		 */
		//do_action( 'woocommerce_account_content' );
	?>

<?php
$current_user = wp_get_current_user();

if ( 0 == $current_user->ID ) {
    // Not logged in.
} else {

if($_POST['act']=='adddomain2'){
//thuc hien cac lenh...
unlink('w/'.$_REQUEST['linkweb'].'/.htaccess');
// Server credentials
$vst_hostname = vst_hostname;
$vst_username = vst_username;
$vst_password = vst_password;
$vst_returncode = 'yes';
$vst_command = 'v-add-domain';

// New Domain
$username = vst_username;
$domain = $_REQUEST['tenmien'];


// Prepare POST query
$postvars = array(
    'user' => $vst_username,
    'password' => $vst_password,
    'returncode' => $vst_returncode,
    'cmd' => $vst_command,
    'arg1' => $username,
    'arg2' => $domain
);
$postdata = http_build_query($postvars);

// Send POST query via cURL
$postdata = http_build_query($postvars);
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
    //secho "Domain has been successfuly created\n";
} else {
    //echo "Query returned error code: " .$answer. "\n";
}
//update option value1
$servername = DB_HOST;
$username = DB_USER;
if(USER_CHUNG=='no'){
	$username = DB_PREFIX_MORE.$_REQUEST['w'];
}
if(USER_CHUNG=='yes'){
	$mysql_username = DB_USER;
}
$password = DB_PASSWORD;
$dbname = DB_PREFIX_MORE.$_REQUEST['w'];

$url="http://".$_REQUEST['tenmien'];
$url3=$_REQUEST['tenmien'];



// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "UPDATE `".$dbname."`.`bz_options` SET `option_value` = '".$url."' WHERE `bz_options`.`option_name` ='siteurl'";

if ($conn->query($sql) === TRUE) {
    //echo "option1 ok</br>";
} else {
    //echo "Error: " . $sql . "<br>" . $conn->error;
}

///////////
$sql2 = "UPDATE `".$dbname."`.`bz_options` SET `option_value` = '".$url."' WHERE `bz_options`.`option_name` ='home'";

if ($conn->query($sql2) === TRUE) {
    //echo "option2 ok";
} else {
    //echo "Error: " . $sql2 . "<br>" . $conn->error;
}

///////////
$sql3 = "UPDATE `".$dbname."`.`bz_options` SET `option_value` = '".$url3."' WHERE `bz_options`.`option_name` ='blogname'";

if ($conn->query($sql3) === TRUE) {
    //echo "option3 ok";
} else {
    //echo "Error: " . $sql3 . "<br>" . $conn->error;
}
///////////
$sql4 = "UPDATE `".$dbname."`.`bz_options` SET `option_value` = '' WHERE `bz_options`.`option_name` ='blogdescription'";

if ($conn->query($sql4) === TRUE) {
    //echo "option3 ok";
} else {
    //echo "Error: " . $sql3 . "<br>" . $conn->error;
}

$conn->close();

////////////////////update list save demo

$servername_home = DB_HOST;
$username_home = DB_USER_CREATEWEB;
$password_home = DB_PASSWORD_CREATEWEB;
$dbname_home = DB_NAME_CREATEWEB;

// Create connection
$conn_home = new mysqli($servername_home, $username_home, $password_home, $dbname_home);
// Check connection
if ($conn_home->connect_error) {
    die("Connection failed: " . $conn_home->connect_error);
}

$sql_home = "UPDATE `wp_demokhachhang` SET `linkweb` = '".$_REQUEST['tenmien']."' , `loaiweb` = 'webrieng' WHERE `w` = '".$_REQUEST['w']."'; ";


if ($conn_home->query($sql_home) === TRUE) {
    //echo "New record created successfully";
} else {
    //echo "Error: " . $sql_home . "<br>" . $conn_home->error;
}

$conn_home->close();

//tao file .htaccess moi
$data1 = '
# BEGIN WordPress
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteBase /
RewriteRule ^index\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /index.php [L]
</IfModule>

# END WordPress
';
$fp = @fopen('w/'.$_REQUEST['linkweb'].'/.htaccess', "w");
  
// Ki?m tra file m? thĂ nh cĂ´ng khĂ´ng
if (!$fp) {
    //echo 'M? file khĂ´ng thĂ nh cĂ´ng';
}else{
	$data =$data1;
// Ghi file
    fwrite($fp, $data);
  
    // ÄĂ³ng file
    fclose($fp);

}

?>
	<?=BIZHOST_POINT_DOMAIN_TO_NEW_IP?>: <?=vst_hostname?><br />
    <?=BIZHOST_USE_WINSCP-TO_FOLDER?> /w/<?=$_REQUEST['linkweb']?> <?=BIZHOST_MOVE_DATA_TO_NEW_DOMAIN?> <?=$_REQUEST['tenmien']?><br /><br />
	Linkweb:<a href="https://<?=$_REQUEST['tenmien']?>" target="_blank">https://<?=$_REQUEST['tenmien']?></a><br />
	Finish!<br />
<?php }
if($_POST['act']=='adddomain'){?>
    <form action="" method="post">
    Your Domain :<br />
    <input name="tenmien" type="text" /><br /><br />

    <input name="" type="submit" value="Set domain name to run web" />
    <input name="linkweb" type="hidden" value="<?=$_REQUEST['linkweb']?>" />
    <input name="act" type="hidden" value="adddomain2" />
    <input name="w" type="hidden" value="<?=$_REQUEST['w']?>" />
    </form>
<?php	//echo 'add domain';
}else{
?>
<a href="<?=LINKWEB?>/"><strong>CREATE NEW WEBSITE</strong></a>
<?php
if(isset($_REQUEST['folderdelete'])){rmdir('w/'.$_REQUEST['folderdelete']);}
//xĂ³a website:
if($_POST['act']=='adddomain'){
 echo 'adddomain';
}
if($_POST['act']=='deleteweb'){?>
<?php
$bientam='';
//xoa trong bz_demokhachhang
$servername_demokhachhang = DB_HOST;
$username_demokhachhang = DB_USER_CREATEWEB;
$password_demokhachhang = DB_PASSWORD_CREATEWEB;
$dbname_demokhachhang = DB_NAME_CREATEWEB;

// Create connection

$conn_demokhachhang = new mysqli($servername_demokhachhang, $username_demokhachhang, $password_demokhachhang, $dbname_demokhachhang);
// Check connection
if ($conn_demokhachhang->connect_error) {
    die("Connection failed: " . $conn_demokhachhang->connect_error);
}

// sql to delete a record
$sql_demokhachhang ='';
$sql_demokhachhang = "DELETE FROM `wp_demokhachhang` WHERE `linkweb` = '".$_POST['linkweb']."' AND `idctv` = ".$current_user->ID."";
if ($current_user->ID==1) {
	$sql_demokhachhang = "DELETE FROM `wp_demokhachhang` WHERE `linkweb` = '".$_POST['linkweb']."'";
}

if ($conn_demokhachhang->query($sql_demokhachhang) === TRUE) {
	$bientam='ok';
    echo "";
} else {
    echo "Error deleting record: " . $conn_demokhachhang->error;
}

$conn_demokhachhang->close();
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

$sql = "UPDATE `wp_listdemo` SET `status` = 'notchange' WHERE `wp_listdemo`.`w` = '".$_POST['w']."'";

if ($conn->query($sql) === TRUE) {
    echo "";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>

<?php
$username = DB_USER;
if(USER_CHUNG=='no'){
	$username = DB_PREFIX_MORE.$_REQUEST['w'];
}
$mysqli = new mysqli(DB_HOST,$username , DB_PASSWORD, DB_PREFIX_MORE.$_POST['w']);
$mysqli->query('SET foreign_key_checks = 0');
if ($result = $mysqli->query("SHOW TABLES"))
{
    while($row = $result->fetch_array(MYSQLI_NUM))
    {
        $mysqli->query('DROP TABLE IF EXISTS '.$row[0]);
    }
}

$mysqli->query('SET foreign_key_checks = 1');
$mysqli->close();
?>

<br />
Delete web successfully Please click the link below to go back!<br />
<input name="goback" type="button" value="GOBACK" onclick="location.href='<?=LINKWEB?>/my-account/?folderdelete=<?=$_POST['linkweb']?>'">	
<br />
<br />
<?php
if($bientam=='ok'){
if($_POST['loaiweb']=='webrieng'){
///
}else{
	//xĂ³a thÆ° má»¥c source code
	$dir = 'w/'.$_POST['linkweb'];
	if($_POST['loaiweb']=='webrieng'){
		$dir ='../../'.$_POST['linkweb'].'/public_html/';
	}
	
	$di = new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS);
	$ri = new RecursiveIteratorIterator($di, RecursiveIteratorIterator::CHILD_FIRST);
	foreach ( $ri as $file ) {
		$file->isDir() ?  rmdir($file) : unlink($file);
	}
	return true;
}
}
?>	


<?php }else{
?>
<br />
<?php if($current_user->ID==1){
$servername = DB_HOST;
$username = DB_USER_CREATEWEB;
$password = DB_PASSWORD_CREATEWEB;
$dbname = DB_NAME_CREATEWEB;
$user_pass='';
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT user_pass FROM `wp_users` WHERE `ID` = 1 ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $user_pass = $row["user_pass"];
    }
} else {
    echo "0 results";
}
$conn->close();

	
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
$sql = "SELECT * FROM `wp_demokhachhang`  ORDER BY `id` DESC";
	$result = $conn->query($sql);
if ($result->num_rows > 0) {?>





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
		$loaiweb=$row["loaiweb"];
		
		$linkwebhienthi=LINKWEB.'/w/'.$row["linkweb"];
		if($loaiweb=='webrieng'){
			$linkwebhienthi='http://'.$row["linkweb"];
		}
		//echo $row["linkweb"].'<br>';?>
        
<?php 
$sql_thanhvien = "SELECT * FROM `wp_users` WHERE `ID` = '".$idthanhvien."'";
	$result_thanhvien = $conn->query($sql_thanhvien);
	while($row_thanhvien = $result_thanhvien->fetch_assoc()) {
			$email_thanhvien=$row_thanhvien["user_email"];
	}
?>

<tr <?php if($count%2==0){echo 'bgcolor="#F6F6F6"';}?>>
<td><?=$count?></td>
<td>
  <a href="<?=$linkwebhienthi?>" target="_blank"><?=str_replace("http://","",$linkwebhienthi);?></a>  <br />
  <?=$email_thanhvien?><br />
  <?php 
	if((time()-$date)/86400>3){ 
		echo '<font color="#FF0000"><strong>Expired</strong></font>'; 
	}else if((time()-$date)/86400>2){
		echo '<font color="#FF0000">01 day left</font>';
	}else if((time()-$date)/86400>1){
		echo '02 days left';
	}else if((time()-$date)/86400>0){
		echo '03 days left';
	}
	?>
  <br />
  <a href="/w/exportcodefull.php?linkweb=<?=$linkweb?>&w=<?=$w?>&t=<?=$user_pass?>">EXPORT_FULLCODE</a><br />
  <a href="/w/exportcode.php?linkweb=<?=$linkweb?>&w=<?=$w?>&t=<?=$user_pass?>">EXPORT_TEMPLATE CODE(wp-content)</a><br />
  <a href="/w/exportdata.php?linkweb=<?=$linkweb?>&w=<?=$w?>&t=<?=$user_pass?>">EXPORT_DATA</a><br />
<form action="" method="post">
	<input name="act" type="hidden" value="adddomain" />
    <input name="linkweb" type="hidden" value="<?=$linkweb?>" />
    <input name="w" type="hidden" value="<?=$w?>" />
    <input name="loaiweb" type="hidden" value="<?=$loaiweb?>" />
    <input name="bizhost" type="hidden" value="bizhost" />
    <input name="cauhinhtenmien" type="submit" value="ADD DOMAIN">
    </form>

  
</td>
<td>
  <form action="" method="post">
    <input name="linkweb" type="hidden" value="<?=$linkweb?>" />
    <input name="act" type="hidden" value="deleteweb" />
    <input name="w" type="hidden" value="<?=$w?>" />
    <input name="loaiweb" type="hidden" value="<?=$loaiweb?>" />
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

<?php } ?>

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
if ($result->num_rows > 0) {?>
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
		//echo $row["linkweb"].'<br>';?>

<tr <?php if($count%2==0){echo 'bgcolor="#F6F6F6"';}?>>
<td><?=$count?></td>
<td><a href="<?=LINKWEB?>/w/<?=$row["linkweb"]?>" target="_blank"><?=$row["linkweb"]?></a></td>
    
    <td>
    <form action="" method="post">
        <input name="linkweb" type="hidden" value="<?=$linkweb?>" />
        <input name="act" type="hidden" value="deleteweb" />
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


<?php } ?>



<?php }} }?>
</div>
