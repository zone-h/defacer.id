<?php
/* ./Port22 a.k.a سفياني محمد ( Muhammad Supiani).
Special Thanks : Allah SWT, My Parents And Family, Risman Effendi (defacerid.com), & Bp. Syams Ideris
*/
  session_start();
  include '../../../inc/config.php';
  if(explodedKhususAdmin()){explodedRedirect('index.php');}

$module=$_GET[module];
$act=$_GET[act];

// Delete Hacker
if ($module=='hacker' AND $act=='hapus'){
  $db->go("DELETE FROM hacker WHERE id ='$_GET[id]'");
  $db->go("UPDATE team SET member = member - 1");
  
  explodedTambahPesan('Attacker Has Been Deleted.');
  explodedRedirect('../../admin.php?module='.$module);
}
// Delete Team
if ($module=='team' AND $act=='delete'){
  $db->go("DELETE FROM team WHERE team ='$_GET[team]'");
  explodedTambahPesan('Attacker Has Been Deleted.');
  explodedRedirect('../../admin.php?module='.$module.'&act=team');
}
?>
