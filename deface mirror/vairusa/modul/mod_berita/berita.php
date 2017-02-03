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
$aksi="modul/mod_berita/berita_act.php";
switch($_GET[act]){
  // Tampil Menu Utama
  case "tambahberita":
  	echo '<div id="main-wrapper">
    <center>
    <div style="float: left; font-size: 19px; text-align: center; width: 100%; color: #08c; margin-top: 1%; ">		
                      <form action="'.$aksi.'?module=berita&act=tambah" enctype="multipart/form-data" method="post" role="form">
					  
					  
								<label>Title</label>
								<br>		
								<input type="text" class="box" placeholder="Title" name="title">
								<br>
								<br>
								<label>Content</label>
								<br>
								<textarea type="text" id="newsform" class="box" placeholder="Content" name="content" rows="4"></textarea>
								<br>
								<br>
								<label>Image</label>
								<br>
                                <input type="file" class="box" placeholder="Title" name="image">
								<br>
								<br>
                                <label>Author</label>
								<br>
                                <input type="text" class="box" name="author" placeholder="Author">
								<br><br>
                        <input type="submit" value="          Add News          " class="button">
                        <a href="admin.php?module=berita"><input type="submit" value="          Cancel          " class="button"></a>
                                 </form>
        </div>
    </center>
            </div>';
    break;
  
  // Form Edit Berita
  case "editberita":
    $id = $_GET['id'];
    $db->go("SELECT * FROM `news` WHERE `id` = $id");
    $data = $db->fetchArray();

    echo '<div id="main-wrapper">
	<h2>Edit News</h2>
    <center>
    <div style="float: left; font-size: 19px; text-align: center; width: 100%; color: #08c; margin-top: 1%; ">	
                      <form action="'.$aksi.'?module=berita&act=update" enctype="multipart/form-data" method="post" role="form">
                        <input type="hidden" name="id" value="'.$data['id'].'"/>
                             <label>Title</label>
								<br>
                              <input type="text" class="box" placeholder="Judul" name="title" value="'.(isset($data['title'])? $data['title']:"").'">
                           <br>
								<br>
                            
                              <label>Content</label>
							  <br>
                              <textarea type="text" id="newsform" class="box" name="content" rows="4">'.(isset($data['content'])? $data['content']:"").'</textarea>
                             
                           
								<br>
								<br>
								<label>Image</label>
								<br>
                                <input type="file" class="box" name="image" value="'.(isset($data['image'])? $data['image']:"").'">
                            <br><br>
                                <label>Author</label>
								<br>
                                <input type="text" class="box" name="author" placeholder="Author" value="'.(isset($data['author'])? $data['author']:"").'">
                           <br><br>
                        <input type="submit" value="          Update News          " class="button">
                        <a href="admin.php?module=berita"><input type="submit" value="          Cancel          " class="button"></a>
                      </form>
        </div>
    </center>
            </div>';
    break;
  default:
      echo '<div id="main-wrapper">
                <div class="maxtable">
                <table>
                    <tr>
                      <td style="width: 40px;">#</td>
                      <td>Title</td>
                      <td>Author</td>
                      <td style="width: 150px;">Date</td>
                      <td style="width: 150px;">Action</td>
                    </tr>';
                $db->go("SELECT * FROM news ORDER BY tanggal DESC LIMIT 20");
                $no = 1;
                while($berita = $db->fetchArray()){
               echo '
                    <tr>
                      <td>'.$no.'</td>
                      <td><a href="../news.php?id='.$berita['id'].'">'.$berita['title'].'</a></td>
                      <td>'.$berita['author'].'</td>
                      <td>'.$berita['tanggal'].'</td>
                      <td>
						  <a href="?module=berita&act=editberita&id='.$berita['id'].'" class="btn btn-success btn-xs"><i class="icon-edit"></i> Edit</a> |
                          <a href="'.$aksi.'?module=berita&act=hapus&id='.$berita['id'].'" class="btn btn-danger btn-xs"><i class="icon-trash"></i> Delete</a>
						  
                      </td>
                    </tr>
                 ';
                  $no++;}
                echo '</table>
    </div>
</div>
	<br/>
	<center>';
                $site_hal = "20";
                if(isset($_GET['s'])){
                    $noS = $_GET['s'];
                } else $noS = 1;

                $offset = ($noS - 1) * $site_hal;
                                $db->go("SELECT COUNT(*) AS jumData FROM news");
                                $data = $db->fetchArray();
                                
                                $jumData = $data['jumData'];
                                $jumPage = ceil($jumData/$site_hal);

                                for($page = 1; $page <= $jumPage; $page++)
                                {
                                         if ((($page >= $noS - 4) && ($page <= $noS + 4)) || ($page == 1) || ($page == $jumPage))
                                         {
                                            if (($showPage == 1) && ($page != 2)) 
												echo "";
                                            if (($showPage != ($jumPage - 1)) && ($page == $jumPage))  
												echo "";
                                            if ($page == $noPage)
												echo "<a class='csbutton small'>".$page."</a>";
                                            else
												echo "<a class='csbutton small' href='admin.php?module=berita&s=".$page."'>".$page."</a>";
                                            $showPage = $page;
                                         }
                                }

                        echo '	</center>
</div><br />
';
      break;
}
}
?>
