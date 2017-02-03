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
  $db->go("DELETE FROM notify WHERE id ='$_GET[id]'");
  explodedTambahPesan('Notify Has Been Deleted.');
  explodedRedirect('../../admin.php?module='.$module);
}
?>
