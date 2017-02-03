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
$aksi="modul/mod_stat/stat_act.php";
$site_hal = "20";
if(isset($_GET['s'])){
   $noS = $_GET['s'];
} else $noS = 1;

$offset = ($noS - 1) * $site_hal;
switch($_GET[act]){
  default:
      echo '<div id="main-wrapper">
    <div class="maxtable">
        <table>
            <tr>
                 <td>#</td>
                <td>Attacker</td>
                <td>Team</td>
				<td>Domain</td>
                <td style="width: 15px;">H</td>
                <td style="width: 15px;">M</td>
                <td style="width: 15px;">R</td>
                <td style="width: 15px;">S</td>
				<td style="width: 20px;">L</td>
                <td>Action</td>
            </tr>';
      
                $db->go("SELECT * FROM notify WHERE hacker = '$hacker' ORDER BY tanggal DESC LIMIT $offset,$site_hal");
				$no = 1;
				while ($archive = $db->fetchArray()) {

                    if (strlen($archive['url']) > 25) {
                        $url = substr($archive['url'], 0, 25) . "...";
                    } else {
                        $url = $archive['url'];
                    }
					
					if ($archive['home'] == '1') {
					$cekHome = 'H';
					} else {
					$cekHome = '';
					}
					
					if ($archive['type'] == '1' AND $archive['status'] == '0') {
					$cekSpecial = '<i class="icon-star"></i>';
					} else if ($archive['type'] == '0' AND $archive['status'] == '0') {
					$cekSpecial = '<i class="icon-thumbs-up"></i>';
					} else if ($archive['status'] == '1') {
					$cekSpecial = '<i class="icon-thumbs-down"></i>';
					}

					if ($archive['team'] == 'No Team') {
					$cekTeam = $archive['team'];
					} else {
					$cekTeam = "<a href='../team_".$archive['team']."-1.html' style='text-decoration:none'>".$archive['team']."</a>";
					}					
					
					if ($archive['mass'] == 1) {
					$cekMass = "M";
					} else {
					$cekMass = "";
					}
					
					if ($archive['domain'] > 1) {
					$cekRedeface = "R";
					} else {
					$cekRedeface = "";
					}
					
					if ($country_code = ($archive['country_id'])) {
					$cc = $country_code;
					$cn = ($dat['country_name']);
					} else if ($ip = $dat['serip']) {
					$ipdetail = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip={$ip}"));
					$cc = $ipdetail->geoplugin_countryCode;
					$cn = $ipdetail->geoplugin_countryName;
					}
               echo '
                    <tr>
                      <td>'.$no.'</td>
                      <td><a href="../attacker_'.$archive['hacker'].'-1.html">'.$archive['hacker'].'</a></td>
                      <td>'.$cekTeam.'</td>
                      <td><a href="'.$archive['url'].'">'.$url.'</td>
                      
					  <td>'.$cekHome.'</td>
					  <td>'.$cekMass.'</td>
					  <td>'.$cekRedeface.'</td>
				      <td>'.$cekSpecial.'</td>
					  <td><img src="../flags/'.$cc.'.png" alt="'.$cn.'"></td>
                      <td><a href="'.$aksi.'?module=archive&act=hapus&id='.$archive['id'].'" class="btn btn-danger btn-xs"><i class="icon-trash"></i> Delete</a>
                      </td>
                    </tr>
';
                  $no++;}
                echo '</table>
			</div>
		</div>
			<br/>
				<center>';
                                $db->go("SELECT COUNT(*) AS jumData FROM notify ORDER BY tanggal");
                                $archivea = $db->fetchArray();
                                
                                $jumData = $archivea['jumData'];
                                $jumPage = ceil($jumData/$site_hal);
                                // menampilkan link previous

                                if ($noS > 1) 
									echo  "<a class='csbutton small'  href='admin.php?module=archive&s=".($noS-1)."'><i class='icon-double-angle-left'></i> Prev</a>";
                                
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

                                // menampilkan link next

                                if ($noS < $jumPage) echo "<a class='csbutton small'  href='admin.php?module=archive&s=".($noS+1)."'>Next <i class='icon-double-angle-right'></i></a>";
                        echo '</center>
			</div><br />';
      break;
}
}
?>
