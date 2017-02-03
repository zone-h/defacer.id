<?php
session_start();
@ini_set('output_buffering',0); // Meminimalkan Buffer
@ini_set('display_errors', 0); // Menyembunyikan Pesan Error
include('inc/config.php');
$hacker = explodedNoSqli($_POST['hacker']);
$team = explodedNoSqli($_POST['team']);
$poc = explodedNoSqli($_POST['poc']);
$regip = $_SERVER[REMOTE_ADDR];
$max = 50;
$textarea = $_POST['url'];
$lines = explode("\n",$textarea);
$count = count($lines, ENT_QUOTES );
	if ($count > $max) {
		echo("<br /><a><i class='fa fa-warning'></i> ERROR : </a>  <b> Max $max URL At One Time ( Total : $count URL ) </b> <br />");
	} else {
	$d=$count;
	}
	// Untuk Looping Site Menggunakan FOR
	for ($i=1;$i<=$d;$i++){ 
	$a=trim($lines[$i-1]);
	$url=$a;
	// Untuk Menggabungkan Site Dengan Http(s)
	if (!preg_match('#^http(s)?://#', $url)) {
    $url = 'http://' . $url;
	}
	// Untuk Memisah URL Menjadi Domain
$urlParts = parse_url($url);
$domain = preg_replace('/^www\./', '', $urlParts['host']);

	// Untuk Cek Site Apakah Sudah Ada Di DB
$db->go("SELECT * FROM notify WHERE domain = '$domain'");
$cekDomain = $db->numRows();

	if ($cekDomain > 0) {
		echo("<a href='$url'><i class='fa fa-thumbs-down'></i> ERROR : $url</a> REASON : Added During Last Year<br />");

	// Untuk Cek Url
	} else {  
    $wrapper = fopen('php://temp', 'r+');
    $crl = curl_init();
    $ch = curl_init($url);
	$sr = curl_init();
	
    curl_setopt($crl, CURLOPT_TIMEOUT, "30");
    curl_setopt($crl, CURLOPT_URL, "$url");
    curl_setopt($crl, CURLOPT_HEADER, 0);
    curl_setopt($crl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_VERBOSE, true);
    curl_setopt($ch, CURLOPT_STDERR, $wrapper);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($sr, CURLOPT_URL, "$url");
	curl_setopt($sr, CURLOPT_HEADER, true);
	curl_setopt($sr, CURLOPT_RETURNTRANSFER, true);
	
    $content = addslashes(curl_exec($crl));
    $result = curl_exec($ch);
	$server = curl_exec($sr);
    
	curl_close($crl);
    curl_close($ch);
	curl_close($sr);
    
	$ips = get_curl_remote_ips($wrapper);
    fclose($wrapper);

	// Untuk Cek IP Site
    $ip = end($ips);
	// Untuk Cek Data Site : Nama & ID
	$ipdetail = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip={$ip}"));
    $countryName = $ipdetail->geoplugin_countryName;
    $countryCode = $ipdetail->geoplugin_countryCode;
	// Cek Server
	preg_match_all('/(^|\r\n\r\n)(HTTP\/)/', $server, $matches, PREG_OFFSET_CAPTURE);
	if (preg_match('|^Server:\s+(.+)|', preg_split("/\r?\n/", substr($server, $matches[2][count($matches[2]) - 1][1], strpos($server, "\r\n\r\n", $matches[2][count($matches[2]) - 1][1]) - $matches[2][count($matches[2]) - 1][1])), $m)) {
	$server = $m[1];
	}
	// Untuk Filter 
	if (cek_url($url)) {
		echo("<a href='$url'><i class='fa fa-warning'></i> DENIED : $url</a> REASON : XSS, Fake Root, Or Fake Subdomain<br />");
	} else if (cek_akses($content)) {
		echo("<a href='$url'><i class='fa fa-thumbs-down'></i>  ERROR : $url</a> REASON : Not Found<br />");
	} else if (cek_konten(strtolower($content))) {
		echo("<a href='$url'><i class='fa fa-thumbs-down'></i>  ERROR : $url</a> REASON : Hasn't Been Defaced <br />");
	} else { 
	// Function Check Special
	if (cek_special($url)) {
    $special = "0"; // Biasa
	} else {
	$special = "1"; // Special
	}
	// Untuk Cek Apakah Sitenya Ditebas Index Atau Bukan
    $getHome = parse_url($url, PHP_URL_PATH);
    if($getHome == "/" || $getHome== "/index.php" || $getHome == "/index.html" || $getHome == "/index.htm" || $getHome == "" ) {
     $resultHome = "1"; // Home
    } else {
     $resultHome = "0"; // Path
    }
	// Untuk Cek Apakah Site Dihack Oleh Notifier, Kalau Bukan Maka Masuk Onhold Archive
	if (strpos(StrTolower($content), StrTolower($hacker))) {
	$onhold = "0"; // Archive
	} else {
	$onhold = "1"; // Onhold
	}

	// Untuk Cek Apakah IP Sudah Ada Di DB, Apabila Belum Maka '0' 
	$db->go("SELECT * FROM notify WHERE serip = '$ip'");
 	$cekMass = $db->fetchArray();
	if ($cekMass['serip'] == $ip) {
  	$mass = "1"; // Mass
 	} else {
  	$mass = "0"; // Single
  	}
	// Cek Domain yang Mirip, Bila Ada Maka Redeface = 1
	$db->go("SELECT * FROM notify WHERE domain LIKE '$domain'");
 	$cekRedeface = $db->numRows();
	
	if ($cekRedeface > 0) {
  	$redeface = "1"; // Redeface
 	} else {
  	$redeface = "0"; // Verawan :v
  	}
	// Untuk Cek Team & Attacker Dari Strip Tags Atau Empty
	if((strstr($team, " ") == $team) or (strstr($team, "-") == $team)) {
	$team = "No Team";
	} else {
	$team = $team;
	}
	if (strstr($hacker, " ") == $hacker) {
	$hacker = "No Attacker";
	} else {
	$hacker = $hacker;
	}
	// Menyederhanakan Server
	if (strstr(StrToLower($server), StrToLower('Microsoft'))){
	    $resultServer = "Microsoft";
	} else if (strstr(StrToLower($server), StrToLower('Apache'))){
	    $resultServer = "Apache";
	} else if (strstr(StrToLower($server), StrToLower('Nginx'))){
	    $resultServer = "Nginx";
	} else if (strstr(StrToLower($server), StrToLower('Litespeed'))){
	    $resultServer = "Litespeed";
	} else if (strstr(StrToLower($server), StrToLower('ATS'))){
	    $resultServer = "ATS";
	} else if (strstr(StrToLower($server), StrToLower('Cloudflare'))){
	    $resultServer = "Cloudflare";
	} else if (strstr(StrToLower($server), StrToLower('Lighttpd'))){
	    $resultServer = "Lighttpd";
	} else { 
		$resultServer = "Unknown";
	}
	// Untuk Menginsert Kedalam DB Apabila Syarat Diatas Sudah Terpenuhi
	$query = $db->go("INSERT INTO notify (id, hacker, team, poc, url, domain, country_id, country_name, server, content, tanggal, type, status, home, mass, redeface, regip, serip) VALUES(NULL, '$hacker', '$team', '$poc', '$url', '$domain', '$countryCode', '$countryName', '$resultServer', '$content', now(), '$special', '$onhold','$resultHome', '$mass', '$redeface','$regip','$ip') ");
	// Untuk Cek Attacker Memiliki Team Atau Tidak
    $db->go("SELECT * FROM hacker WHERE hacker = '$hacker'");
    $cekHacker = $db->numRows();
    $data = $db->fetchArray();
    // Untuk Cek Apakah Team Yang Di Input Sudah Ada
    if ((StrToLower($data['team']) == StrToLower($team))) {
    $addTeam = "0";
    } else {
    $addTeam = "1"; 
    }
	// Untuk Menginsert Data, Apabila Sudah Ada Maka Hanya Diupdate DB nya
	if ($cekHacker > 0){ 
		$query2 = $db->go("UPDATE hacker SET deface = deface + 1 , special = special + " . ($special == "1" ? "'1'" : "'0'") . ", onhold = onhold + " . ($onhold == "1" ? "'1'" : "'0'") . ", home = home + " . ($resultHome == "1" ? "'1'" : "'0'") . " WHERE hacker = '$hacker'");
	} else { 
	$query2 = $db->go("INSERT INTO hacker (id, hacker, team, deface, special, onhold, home) VALUES('', '$hacker', '$team', '1', '$special', '$onhold', '$resultHome')");
	}  
	// Untuk Cek Team Sudah Sesuai Atau Tidak, Bila Team Diisi 'SPASI' Maka Didefinisikan Sebagai 'NO TEAM' Kemudian Di Insert Ke DB Bila Tidak Ada, Atau Bila Sudah Ada Maka Hanya Diupdate DB nya
    $db->go("SELECT * FROM team WHERE team = '$team'");
    $team_s = $db->numRows();

    if ($team_s > 0) {
        $query3 = $db->go("UPDATE team SET member = member + " . ($addTeam == "1" ? "'1'" : "'0'") . ", home = home + " . ($resultHome == "1" ? "'1'" : "'0'") . ", tot_deface = tot_deface + 1 , special = special + " . ($special == "1" ? "'1'" : "'0'") . ", onhold = onhold + " . ($onhold == "1" ? "'1'" : "'0'") . " WHERE team = '$team'");
    } else {
        $query3 = $db->go("INSERT INTO team (team, special, onhold, home, member, tot_deface) VALUES('$team', '$special', '$onhold', '$resultHome', '$addTeam', '1') ");
    }
	// Untuk Allert Apakah Data Sudah Sukses Masuk Ke DB Atau Tidak
	if ($query && $query2 && $query3){
       echo("<a href='$url'><i class='fa fa-thumbs-up'></i> SUCCESS : $url</a><br />");
       } else {
       echo("<a href='$url'><i class='fa fa-thumbs-down'></i> ERROR : $url</a><br />");
    }
	}
	}
	}