<?php
include "config.php";

$id = $_GET['id'];
$id = explodedNoSqli($id);

$check = $db->go("SELECT content FROM notify WHERE id = '$id' ");
$content = @mysql_result($check,0,0);

echo $content;

?>