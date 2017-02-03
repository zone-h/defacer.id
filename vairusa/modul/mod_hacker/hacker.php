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
$aksi="modul/mod_hacker/hacker_act.php";
$limit = "20";
if(isset($_GET['s'])){
   $noS = $_GET['s'];
} else $noS = 1;

$offset = ($noS - 1) * $limit;
switch($_GET[act]){
	
  case "team":
      echo '<div id="main-wrapper">
				<div class="maxtable">
					<table>
						<tr>
							<td style="width: 40px;">#</td>
							<td>Attacker</td>
							<td style="width: 120px;">Home</td>
							<td style="width: 120px;">Onhold</td>
							<td style="width: 120px;">Special</td>
							<td style="width: 120px;">Total</td>
							<td style="width: 70px;">Action</td>
						</tr>';
      
                $db->go("SELECT * FROM team ORDER BY tot_deface DESC LIMIT $offset,$limit");
                $no = 1;
                while($team = $db->fetchArray()){
               echo '<tr>
                      <td>'.$no.'</td>
                      <td><a href="../team_'.$team['team'].'">'.$team['team'].'</a></td>
                      <td>'.$team['home'].'</td>
                      <td>'.$team['onhold'].'</td>
                      <td>'.$team['special'].'</td>
                      <td>'.$team['tot_deface'].'</td>
                      <td><a href="'.$aksi.'?module=team&act=delete&id='.$team['team'].'">Delete</a>
                      </td>
                    </tr>';
                  $no++;}
      echo '	</table>
			</div>
		</div>
			<br/>
				<center>';
				$db->go("SELECT COUNT(*) AS jumData FROM team");
					$data = $db->fetchArray();
                                
					$jumData = $data['jumData'];
					$jumPage = ceil($jumData/$limit);

					for($page = 1; $page <= $jumPage; $page++)
							{
                              if ((($page >= $noS - 3) && ($page <= $noS + 3)) || ($page == 1) || ($page == $jumPage))
                            {
                              if (($showPage == 1) && ($page != 2))  
								  echo "";
                              if (($showPage != ($jumPage - 1)) && ($page == $jumPage))
								  echo "";
                              if ($page == $noPage) echo "<a class='csbutton small'>".$page."</a>";
                              else 
								  echo " <a class='csbutton small' href='admin.php?module=hacker&s=".$page."'>".$page."</a>";
                              $showPage = $page;
                            }
                            }

      echo '	</center>
			</div><br />';
      break;
	
  default:
      echo '<div id="main-wrapper">
				<div class="maxtable">
					<table>
						<tr>
							<td style="width: 40px;">#</td>
							<td>Attacker</td>
							<td style="width: 120px;">Home</td>
							<td style="width: 120px;">Onhold</td>
							<td style="width: 120px;">Special</td>
							<td style="width: 120px;">Total</td>
							<td style="width: 70px;">Action</td>
						</tr>';
      
                $db->go("SELECT * FROM hacker ORDER BY deface DESC LIMIT $offset,$limit");
                $no = 1;
                while($hacker = $db->fetchArray()){
               echo '<tr>
                      <td>'.$no.'</td>
                      <td><a href="../attacker_'.$hacker['id'].'">'.$hacker['hacker'].'</a></td>
                      <td>'.$hacker['home'].'</td>
                      <td>'.$hacker['onhold'].'</td>
                      <td>'.$hacker['special'].'</td>
                      <td>'.$hacker['deface'].'</td>
                      <td><a href="'.$aksi.'?module=hacker&act=hapus&id='.$hacker['id'].'">Delete</a>
                      </td>
                    </tr>';
                  $no++;}
      echo '	</table>
			</div>
		</div>
			<br/>
				<center>';
				$db->go("SELECT COUNT(*) AS jumData FROM hacker");
					$data = $db->fetchArray();
                                
					$jumData = $data['jumData'];
					$jumPage = ceil($jumData/$limit);

					for($page = 1; $page <= $jumPage; $page++)
							{
                              if ((($page >= $noS - 3) && ($page <= $noS + 3)) || ($page == 1) || ($page == $jumPage))
                            {
                              if (($showPage == 1) && ($page != 2))  
								  echo "";
                              if (($showPage != ($jumPage - 1)) && ($page == $jumPage))
								  echo "";
                              if ($page == $noPage) echo "<a class='csbutton small'>".$page."</a>";
                              else 
								  echo " <a class='csbutton small' href='admin.php?module=hacker&s=".$page."'>".$page."</a>";
                              $showPage = $page;
                            }
                            }

      echo '	</center>
			</div><br />';
      break;
				  }
	}
?>
