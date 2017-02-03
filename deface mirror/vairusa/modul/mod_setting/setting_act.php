<?php
/* ./Port22 a.k.a سفياني محمد ( Muhammad Supiani).
Special Thanks : Allah SWT, My Parents And Family, Risman Effendi (defacerid.com), & Bp. Syams Ideris
*/
  session_start();
  include '../../../inc/config.php';
  if(explodedKhususAdmin()){explodedRedirect('index.php');}

$module=$_GET[module];
$act=$_GET[act];
 
$password = str_rot13(base64_encode(sha1(md5(base64_encode(md5(sha1(md5($_POST['passwd']))))))));
$retype = str_rot13(base64_encode(sha1(md5(base64_encode(md5(sha1(md5($_POST['retype']))))))));
$sec_key = base64_encode(md5(sha1(str_rot13($_POST['sec_key']))));

// Update Profile
if ($module=='setting' AND $act=='updateuser'){
	if ($password != $retype) {
	  explodedTambahPesan("Password Not Match");
      explodedRedirect('../../admin.php?module='.$module.'&act=profile');
} else
	  $db->go("UPDATE uadmin SET fname = '$_POST[fname]', uname = '$_POST[uname]', password = '$password', email = '$_POST[email]' WHERE id = 1");
      explodedTambahPesan("Profile Has Been Updated");
      explodedRedirect('../../admin.php?module='.$module.'&act=profile');
}
// Update Main Setting
elseif ($module == 'setting' AND $act == 'updatesetting'){
      $db->go("UPDATE setting SET title = '$_POST[title]', subtitle = '$_POST[subtitle]', description = '$_POST[description]', keyword = '$_POST[keyword]', contact_email = '$_POST[contact_email]'  WHERE id = 1");
      explodedTambahPesan("Settings Has Been Updated");
      explodedRedirect('../../admin.php?module='.$module);
}


// Update Advanced Setting
elseif ($module == 'setting' AND $act == 'updateadvanced'){
      $db->go("UPDATE setting SET max_submit = '$_POST[max_submit]', paging = '$_POST[paging]', sec_key = '$sec_key' WHERE id = 1");
      explodedTambahPesan("Settings Has Been Updated");
      explodedRedirect('../../admin.php?module='.$module.'&act=advanced');
}
?>
