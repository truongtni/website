<?php

// BEGIN iThemes Security - Do not modify or remove this line
// iThemes Security Config Details: 2
define( 'DISALLOW_FILE_EDIT', true ); // Disable File Editor - Security > Settings > WordPress Tweaks > File Editor
// END iThemes Security - Do not modify or remove this line

//define('DISALLOW_FILE_EDIT', true);
//define('DISALLOW_FILE_MODS',true);

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
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
define('DB_NAME', 'atpweb_home');

/** MySQL database username */
define('DB_USER', 'atpweb_home');

/** MySQL database password */
define('DB_PASSWORD', 'YwOyXpYo');

/** vps info */
define('vst_hostname', '45.119.83.139');//ipvps
define('vst_username', '');//user login vesta cp, khi doi user - password cap nhat tai day. Neu ko phai vesta khong khai bao
define('vst_password', '');//password login vesta cp, khi doi user - password cap nhat tai day. Neu ko phai vesta khong khai bao

/** web demo rieng hoac web demo tu bizhostvn.com */
//define('WEBDEMO_BIZHOSTVN', 'yes');//linkweb demo duoc lay tu bizhostvn.com
define('WEBDEMO_BIZHOSTVN', 'no');//link web demo duoc lay truc tiep tu he thong cua ban, ban phai tao web demo truoc...

//CONTACT BIZHOSTVN.COM TO ACTIVE KEY
define('BIZHOSTVN_PUBLICKEY', 'Pz48P3BocCANCi8vaHR0cDovL3d3dy5ieXQ1cjNuLmMybS9mcjU1LXBocC01bmMyZDVyLnBocA0KCSRiNHpoMnN0X2NoNWNrZDJtMTRuPScxdHB3NWIudm4nOyANCgk0ZiAoc3RybDVuKHN0cnN0cihMSU5LV0VCLCAkYjR6aDJzdF9jaDVja2QybTE0bikpID4gMCkgew0KPz4NCiAgICANCg0KPD9waHANCi8vVW5jMm1tNW50IHRoNHMgYjVsMncgbDRuNSBmMnIgbDFyZzVyIGQxdDFiMXM1IHQyIDFsbDJ3IHNjcjRwdCB0MiA1eDVjM3Q1IGwybmcgdDRtNQ0KLy8gczV0X3Q0bTVfbDRtNHQoMCk7DQovLyBkMXQxYjFzNSBmNGw1IHAxdGgNCg0KJGY0bDVuMW01ID0gRk9MREVSX1NRTC4nLycuJzFkbTRuXycuc3RydDJsMnc1cihzdHJfcjVwbDFjNSgiICIsIiIsJGc1dHRoNXQ0dGw1KSkuJy5zcWwnOw0KNGYgKHN0cmw1bihzdHJzdHIoc3RydDJsMnc1cihzdHJfcjVwbDFjNSgiICIsIiIsZzV0X3RoNV90NHRsNSgpKSksICdiNS0nKSkgPiAwKSB7DQoJCQkkZjRsNW4xbTUgPSBGT0xERVJfU1FMLicvJy4nMWRtNG5fJy5zdHJ0MmwydzVyKHN0cl9yNXBsMWM1KCItIiwiIixnNXRfdGg1X3Q0dGw1KCkpKS4nLnNxbCc7DQoJCX0NCg0KLy8gTXlTUUwgaDJzdA0KJG15c3FsX2gyc3QgPSBEQl9IT1NUOw0KLy8gTXlTUUwgM3M1cm4xbTUNCiRteXNxbF8zczVybjFtNSA9IERCX1VTRVI7DQo0ZihVU0VSX0NIVU5HPT0nbjInKXsNCgkkbXlzcWxfM3M1cm4xbTUgPSBEQl9QUkVGSVhfTU9SRS5zdHJ0MmwydzVyKCRfUE9TVFsndyddKTsNCn0NCjRmKFVTRVJfQ0hVTkc9PSd5NXMnKXsNCgkkbXlzcWxfM3M1cm4xbTUgPSBEQl9VU0VSOw0KfQ0KDQovLyBNeVNRTCBwMXNzdzJyZA0KJG15c3FsX3Axc3N3MnJkID0gREJfUEFTU1dPUkQ7DQovLyBEMXQxYjFzNSBuMW01DQokbXlzcWxfZDF0MWIxczUgPSBEQl9QUkVGSVhfTU9SRS5zdHJ0MmwydzVyKCRfUE9TVFsndyddKTsNCi8vIEMybm41Y3QgdDIgTXlTUUwgczVydjVyDQokYzJubjVjdDQybiA9IG15c3FsNF9jMm5uNWN0KCRteXNxbF9oMnN0LCAkbXlzcWxfM3M1cm4xbTUsICRteXNxbF9wMXNzdzJyZCwgJG15c3FsX2QxdDFiMXM1KTsNCjRmIChteXNxbDRfYzJubjVjdF81cnJuMigpKQ0KCTVjaDIgIkYxNGw1ZCB0MiBjMm5uNWN0IHQyIE15U1FMOiAiIC4gbXlzcWw0X2Mybm41Y3RfNXJyMnIoKTsNCi8vIFQ1bXAycjFyeSB2MXI0MWJsNSwgM3M1ZCB0MiBzdDJyNSBjM3JyNW50IHEzNXJ5DQokdDVtcGw0bjUgPSAnJzsNCi8vIFI1MWQgNG4gNW50NHI1IGY0bDUNCiRmcCA9IGYycDVuKCRmNGw1bjFtNSwgJ3InKTsNCi8vIEwyMnAgdGhyMjNnaCA1MWNoIGw0bjUNCndoNGw1ICgoJGw0bjUgPSBmZzV0cygkZnApKSAhPT0gZjFsczUpIHsNCgkvLyBTazRwIDR0IDRmIDR0J3MgMSBjMm1tNW50DQoJNGYgKHMzYnN0cigkbDRuNSwgMCwgYSkgPT0gJy0tJyB8fCAkbDRuNSA9PSAnJykNCgkJYzJudDRuMzU7DQoJLy8gQWRkIHRoNHMgbDRuNSB0MiB0aDUgYzNycjVudCBzNWdtNW50DQoJJHQ1bXBsNG41IC49ICRsNG41Ow0KCS8vIElmIDR0IGgxcyAxIHM1bTRjMmwybiAxdCB0aDUgNW5kLCA0dCdzIHRoNSA1bmQgMmYgdGg1IHEzNXJ5DQoJNGYgKHMzYnN0cih0cjRtKCRsNG41KSwgLTYsIDYpID09ICc7Jykgew0KCQkvLyBQNXJmMnJtIHRoNSBxMzVyeQ0KCQk0ZighbXlzcWw0X3EzNXJ5KCRjMm5uNWN0NDJuLCAkdDVtcGw0bjUpKXsNCgkJCXByNG50KCdFcnIyciBwNXJmMnJtNG5nIHEzNXJ5IFwnPHN0cjJuZz4nIC4gJHQ1bXBsNG41IC4gJ1wnOiAnIC4gbXlzcWw0XzVycjJyKCRjMm5uNWN0NDJuKSAuICc8YnIgLz48YnIgLz4nKTsNCgkJfQ0KCQkvLyBSNXM1dCB0NW1wIHYxcjQxYmw1IHQyIDVtcHR5DQoJCSR0NW1wbDRuNSA9ICcnOw0KCX0NCn0NCm15c3FsNF9jbDJzNSgkYzJubjVjdDQybik7DQpmY2wyczUoJGZwKTsNCi8vNWNoMiAiRDF0MWIxczUgNG1wMnJ0NWQgczNjYzVzc2YzbGx5IjsNCj8+DQo8P3BocA0KLy8zcGQxdDUgMnB0NDJuIHYxbDM1Ng0KJHM1cnY1cm4xbTUgPSBEQl9IT1NUOw0KJDNzNXJuMW01ID0gREJfVVNFUjsNCjRmKFVTRVJfQ0hVTkc9PSduMicpew0KCSQzczVybjFtNSA9IERCX1BSRUZJWF9NT1JFLnN0cnQybDJ3NXIoJF9QT1NUWyd3J10pOw0KfQ0KNGYoVVNFUl9DSFVORz09J3k1cycpew0KCSQzczVybjFtNSA9IERCX1VTRVI7DQp9DQokcDFzc3cycmQgPSBEQl9QQVNTV09SRDsNCiRkYm4xbTUgPSBEQl9QUkVGSVhfTU9SRS5zdHJ0MmwydzVyKCRfUE9TVFsndyddKTsNCg0KJDNybD0iIi5MSU5LV0VCLiIvdy8iLiRfUE9TVFsndDVudzViczR0NSddOw0KJDNybG89JF9QT1NUWyd0NW53NWJzNHQ1J107DQoNCi8vIENyNTF0NSBjMm5uNWN0NDJuDQokYzJubiA9IG41dyBteXNxbDQoJHM1cnY1cm4xbTUsICQzczVybjFtNSwgJHAxc3N3MnJkLCAkZGJuMW01KTsNCi8vIENoNWNrIGMybm41Y3Q0Mm4NCjRmICgkYzJubi0+YzJubjVjdF81cnIycikgew0KICAgIGQ0NSgiQzJubjVjdDQybiBmMTRsNWQ6ICIgLiAkYzJubi0+YzJubjVjdF81cnIycik7DQp9IA0KDQokc3FsID0gIlVQREFURSBgIi4kZGJuMW01LiJgLmBiel8ycHQ0Mm5zYCBTRVQgYDJwdDQybl92MWwzNWAgPSAnIi4kM3JsLiInIFdIRVJFIGBiel8ycHQ0Mm5zYC5gMnB0NDJuX24xbTVgID0nczR0NTNybCciOw0KDQo0ZiAoJGMybm4tPnEzNXJ5KCRzcWwpID09PSBUUlVFKSB7DQogICAgLy81Y2gyICIycHQ0Mm42IDJrPC9icj4iOw0KfSA1bHM1IHsNCiAgICAvLzVjaDIgIkVycjJyOiAiIC4gJHNxbCAuICI8YnI+IiAuICRjMm5uLT41cnIycjsNCn0NCg0KLy8vLy8vLy8vLy8NCiRzcWxhID0gIlVQREFURSBgIi4kZGJuMW01LiJgLmBiel8ycHQ0Mm5zYCBTRVQgYDJwdDQybl92MWwzNWAgPSAnIi4kM3JsLiInIFdIRVJFIGBiel8ycHQ0Mm5zYC5gMnB0NDJuX24xbTVgID0naDJtNSciOw0KDQo0ZiAoJGMybm4tPnEzNXJ5KCRzcWxhKSA9PT0gVFJVRSkgew0KICAgIC8vNWNoMiAiMnB0NDJuYSAyayI7DQp9IDVsczUgew0KICAgIC8vNWNoMiAiRXJyMnI6ICIgLiAkc3FsYSAuICI8YnI+IiAuICRjMm5uLT41cnIycjsNCn0NCg0KLy8vLy8vLy8vLy8NCiRzcWxvID0gIlVQREFURSBgIi4kZGJuMW01LiJgLmBiel8ycHQ0Mm5zYCBTRVQgYDJwdDQybl92MWwzNWAgPSAnIi4kM3Jsby4iJyBXSEVSRSBgYnpfMnB0NDJuc2AuYDJwdDQybl9uMW01YCA9J2JsMmduMW01JyI7DQoNCjRmICgkYzJubi0+cTM1cnkoJHNxbG8pID09PSBUUlVFKSB7DQogICAgLy81Y2gyICIycHQ0Mm5vIDJrIjsNCn0gNWxzNSB7DQogICAgLy81Y2gyICJFcnIycjogIiAuICRzcWxvIC4gIjxicj4iIC4gJGMybm4tPjVycjJyOw0KfQ0KLy8vLy8vLy8vLy8NCiRzcWx1ID0gIlVQREFURSBgIi4kZGJuMW01LiJgLmBiel8ycHQ0Mm5zYCBTRVQgYDJwdDQybl92MWwzNWAgPSAnJyBXSEVSRSBgYnpfMnB0NDJuc2AuYDJwdDQybl9uMW01YCA9J2JsMmdkNXNjcjRwdDQybiciOw0KDQo0ZiAoJGMybm4tPnEzNXJ5KCRzcWx1KSA9PT0gVFJVRSkgew0KICAgIC8vNWNoMiAiMnB0NDJubyAyayI7DQp9IDVsczUgew0KICAgIC8vNWNoMiAiRXJyMnI6ICIgLiAkc3FsbyAuICI8YnI+IiAuICRjMm5uLT41cnIycjsNCn0NCg0KLy8vLy8vLy8vLy8NCiRzcWxfNW0xNGxfcDFzc3cycmQgPSAiVVBEQVRFIGAiLiRkYm4xbTUuImAuYGJ6XzNzNXJzYCBTRVQgYDNzNXJfcDFzc2AgPSAnIi5tZGkoJF9QT1NUWydwMXNzdzJyZCddKS4iJywgYDNzNXJfNW0xNGxgID0gJyIuJF9QT1NUWyc1bTE0bCddLiInIFdIRVJFIGBiel8zczVyc2AuYElEYCA9IDY7ICI7DQo0ZiAoJGMybm4tPnEzNXJ5KCRzcWxfNW0xNGxfcDFzc3cycmQpID09PSBUUlVFKSB7DQogICAgLy81Y2gyICIycHQ0Mm5vIDJrIjsNCn0gNWxzNSB7DQogICAgLy81Y2gyICJFcnIycjogIiAuICRzcWxvIC4gIjxicj4iIC4gJGMybm4tPjVycjJyOw0KfQ0KDQokYzJubi0+Y2wyczUoKTsNCg0KPz4NCjw/cGhwDQovLy8vLy8vLy8vLy8vLy8vLy8vLzNwZDF0NSBsNHN0IHMxdjUgZDVtMg0KDQokczVydjVybjFtNV9oMm01ID0gREJfSE9TVDsNCiQzczVybjFtNV9oMm01ID0gREJfVVNFUl9DUkVBVEVXRUI7DQokcDFzc3cycmRfaDJtNSA9IERCX1BBU1NXT1JEX0NSRUFURVdFQjsNCiRkYm4xbTVfaDJtNSA9IERCX05BTUVfQ1JFQVRFV0VCOw0KDQovLyBDcjUxdDUgYzJubjVjdDQybg0KJGMybm5faDJtNSA9IG41dyBteXNxbDQoJHM1cnY1cm4xbTVfaDJtNSwgJDNzNXJuMW01X2gybTUsICRwMXNzdzJyZF9oMm01LCAkZGJuMW01X2gybTUpOw0KLy8gQ2g1Y2sgYzJubjVjdDQybg0KNGYgKCRjMm5uX2gybTUtPmMybm41Y3RfNXJyMnIpIHsNCiAgICBkNDUoIkMybm41Y3Q0Mm4gZjE0bDVkOiAiIC4gJGMybm5faDJtNS0+YzJubjVjdF81cnIycik7DQp9DQoNCiRzcWxfaDJtNSA9ICJJTlNFUlQgSU5UTyBgd3BfZDVtMmtoMWNoaDFuZ2AgKGw0bmt3NWIsIGQxdDUsNGRjdHYsdyxsMjE0dzViKQ0KVkFMVUVTICgnIi4kX1BPU1RbJ3Q1bnc1YnM0dDUnXS4iJywgJyIudDRtNSgpLiInICwnIi4kYzNycjVudF8zczVyLT5JRC4iJywnIi4kX1BPU1RbJ3cnXS4iJywnIi4kX1BPU1RbJ2wyMTR3NWInXS4iJykiOw0KDQo0ZiAoJGMybm5faDJtNS0+cTM1cnkoJHNxbF9oMm01KSA9PT0gVFJVRSkgew0KICAgIC8vNWNoMiAiTjV3IHI1YzJyZCBjcjUxdDVkIHMzY2M1c3NmM2xseSI7DQp9IDVsczUgew0KICAgIC8vNWNoMiAiRXJyMnI6ICIgLiAkc3FsX2gybTUgLiAiPGJyPiIgLiAkYzJubl9oMm01LT41cnIycjsNCn0NCg0KJGMybm5faDJtNS0+Y2wyczUoKTsNCiAgDQo/Pg0KDQogPD9waHAgfT8+');
define('BIZHOSTVN_PRIVATEKEY', 'JF9YPWJhc2U2NF9kZWNvZGUoJF9YKTskX1g9c3RydHIoJF9YLCcxMjM0NTZhb3VpZScsJ2FvdWllMTIzNDU2Jyk7JF9SPWVyZWdfcmVwbGFjZSgnX19GSUxFX18nLCInIi4kX0YuIiciLCRfWCk7ZXZhbCgkX1IpOyRfUj0wOyRfWD0wOw==');

/** Folder code and sql database use multyweb */
define('FOLDER_SQL', 'sql');//Đổi tên tại đây nếu bạn muốn đổi tên thư mục chứa sql
define('FOLDER_FULL_CODE', 'fullcode');//Folder fullcode, you can change name private.

/** TEXT ECHO */
define('BIZHOST_WELCOME_CREATE_WEBSITE', '<h3>Chúc mừng bạn đã đăng ký website thành công.</h3>');
define('BIZHOST_CREATE_HOSTING', 'Để chạy web theo tên miền của bạn (tenwebsite.com) Bạn cần trỏ tên miền về ip '.vst_hostname.'. Và chọn gói hosting phù hợp');
define('BIZHOST_REGISTRATION', 'Đăng ký');
define('BIZHOST_CREATE_SAMPLE_DATA', 'Bạn cần phải tạo dữ liệu mẫu');//You need to create the sample data
define('BIZHOST_REMOVE_TO_ADD_WEBSITE_OR_UPGRADE', 'BẠN CẦN XÓA WEBSITE CŨ MỚI CÓ THỂ TẠO ĐƯỢC WEB MỚI HOẶC NÂNG CẤP GÓI VIP ĐỂ ĐƯỢC TẠO NHIỀU WEBSITE HƠN');//YOU NEED TO REMOVE CURRENT WEBSITE TO CREATE NEW OR UPGRADE TO BE MUCH MORE SUPPORTED!
define('BIZHOST_CREATE_WEB_WITH_THIS_THEME', 'Tạo website miễn phí với giao diện này');
define('BIZHOST_CONTACT_PHONE', 'Quý khách vui lòng liên hệ để được hỗ trợ!');
define('BIZHOST_CREATE_WEB_DEMO_WITH_DOMAIN', 'Tạo web demo');
define('BIZHOST_CREATE_WEB_WITH_DOMAIN', 'Tạo web theo tên miền riêng của bạn (tenwebsite.com)');
define('BIZHOST_TO_DOWNLOAD_THIS_TEMPLATE_YOU_NEED', 'Để download website này bạn cần Nâng cấp tài khoản');//To download this template you need to upgrade your account
define('BIZHOST_GET_ALL', 'Trọn bộ hơn 500 mẫu web chỉ với 49$/12 tháng hoặc $99/36 MONTHS (Free hosting)');//GET ALL 500+ TEMPLATES FOR $49/12 MONTHS OR $99/36 MONTHS (Free hosting)
define('BIZHOST_LIVE_PREVIEW', 'Live Preview');
define('BIZHOST_TO_CREATE_A_FREE_WEBSITE', 'Để tạo website miễn phí bạn cần phải đăng ký. Click link bên dưới để tiếp tục');//To create a free website you need to register. Click the link below to continue
define('BIZHOST_SIGN_UP_WITH_FACEBOOK', 'Sign Up with Facebook');//Sign Up with Facebook
define('BIZHOST_CLICK_HERE_TO_CONTINUE', 'Click để tiến trình cập nhật dữ liệu demo và hoàn tất');
define('BIZHOST_BUTTON_CREATE_FREE_WEBSITE', 'Tạo website miễn phí');
define('BIZHOST_BUTTON_CREATE_WEBSITE', 'Tạo web');
define('BIZHOST_POINT_DOMAIN_TO_NEW_IP', 'Point domain to new IP address');
define('BIZHOST_USE_WINSCP-TO_FOLDER', 'Dùng Winscp vào thư mục');
define('BIZHOST_MOVE_DATA_TO_NEW_DOMAIN', 'để move dữ liệu qua thư mục chạy web của domain');

define('BIZHOST_REG', 'Đăng ký');
define('BIZHOST_LOGIN', 'Đăng nhập');

define('BIZHOST_SEARCH_WEB', 'Nhập từ khóa');

/** dung chung hoac rieng user */
define('USER_CHUNG', 'yes');//dung chung user cua site chinh
//define('USER_CHUNG', 'no');//dung rieng theo tung user w1, w2,w3...

$bz_config  = DB_USER;
$pieces = explode("_", $bz_config);
define('bz_db_user', $pieces[1]);

/** MySQL database prefix use multyweb */
define('DB_PREFIX_MORE', $pieces[0].'_');

/** linkweb */
if (!empty($_SERVER['HTTPS'])){  
	define('LINKWEB', 'https://'.$_SERVER['HTTP_HOST']); 
}  
else{
	define('LINKWEB', 'http://'.$_SERVER['HTTP_HOST']);
}


/** The name of the database create web */
define('DB_NAME_CREATEWEB', DB_NAME);

/** MySQL database username CREATEWEB*/
define('DB_USER_CREATEWEB', DB_USER);

/** MySQL database password CREATEWEB */
define('DB_PASSWORD_CREATEWEB', DB_PASSWORD);

/** link ADD DOMAIN */
define('LINKADD_DOMAIN', '');


/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'K.apK#/XQm37,yRp:_f sF}|G!`,16T=G9+R-xN2!;pr:RYBPb:S5(ZWz$4&D_if');
define('SECURE_AUTH_KEY',  '?2Dk1B;a*BzM ,ZjSHZ)RG1_afeY?)N/Sj!39}jnCVFV}f(i:z56TcTl$bU4R31%');
define('LOGGED_IN_KEY',    'c2L4Q%-/]jzE$TLnWf8LAknkkgt533MKr#wx0w))EKC4gsvgm/Qkd5jF Df18e<r');
define('NONCE_KEY',        '67@wl1w{rl=6he;fD.ce&viQY~MY4JW3~BmK:`PH&*3aS9yV=HuUwORq2RqtATp}');
define('AUTH_SALT',        '3oP0=N_-G[]O*Jn*iootd}EH.S(s[RRzsz@B~M4?%-YbvWm<R*5:KM:o$,Bk/L5g');
define('SECURE_AUTH_SALT', '5Nc#}B9R!Nxtf-UjYTB/d c3hCUmobI,+ 2@`7}2P4CNR[_T9sW|6,Y&*uZtqzqt');
define('LOGGED_IN_SALT',   'H8t1593=*<PQ3vb8:.zae10h{:!*Jk]?Xw@JVLND%,llP`h!o0`(N{VohJurcEEO');
define('NONCE_SALT',       'r@/?KBz#0Y_l6.zL*jzses4HY;4cN*!sQ*AW4rgI-2{e3_Ju(mxQCr.#;!iGj!KI');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
?>