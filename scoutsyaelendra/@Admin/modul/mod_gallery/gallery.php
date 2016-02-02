<?php
 if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_gallery/aksi_gallery.php";
switch($_GET['act']){
  // Tampil Gallery
  default:
    
    echo "<h2 class='hLine'>Gallery</h2>
          <input type=button class='butt' value='Tambah Gallery' onclick=\"window.location.href='?module=gallery&act=addGallery';\">
          <table class='list'>
          <thead>
			  <tr>
				<td class='center'>No.</td>
				<td class='center'>Gambar</td>
                <td class='center'>Judul</td>
				<td class='center'>Tanggal</td>
				<td colspan='2' class='center'>Aksi</td>
			  </tr>
		  </thead>";

	//paging
    $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
    $url = "?module=$_GET[module]&";
    $limit = 10;
    $startpoint = ($page * $limit) - $limit;     
    $table = "gallery";

    $tampil = mysql_query("SELECT * FROM gallery ORDER BY id_gallery DESC LIMIT {$startpoint}, {$limit}");
  
    $no = $startpoint+1;
    while($r=mysql_fetch_array($tampil)){
      //$tanggal=tgl_indo($r['tanggal']);
      echo "<tr><td>$no</td>
                <td class='left'><img src='../joimg/gallery/s_$r[gambar]'></td></td>
                    <td>$r[judul]</td>
                    <td>$r[tgl_posting]</td>
		            <td><a href=?module=gallery&act=editGallery&id=$r[id_gallery]><img src='images/add-icon.gif'></a></td> 
		            <td><a href=$aksi?module=gallery&act=del&id=$r[id_gallery]&nama_file=$r[gambar]><img src='images/hr.gif'></a></td>
		        </tr>";
      $no++;
    }
    echo "</table>";
	echo pagination($table,$limit,$page, $url);
 
    break;
  
  case "addGallery":
    echo "<h2 class='hLine'>Tambah Gallery</h2>
          <form method=POST action='$aksi?module=gallery&act=input' enctype='multipart/form-data'>
          <table class='list'>
          <tr>
			<td class='left'>Judul</td>
			<td class='left'><input type=text name='judul' size=60></td>
		  </tr>
		<tr>
			<td class='left'>Gambar</td>
			<td class='left'><input type=file name='fupload' size=40> <br />Tipe gambar harus JPG/JPEG dan ukuran lebar maks: 400 px</td>
		  </tr>
          <tr>
			<td colspan=2 class='left'>
			<input type=submit class='butt' value=Simpan>
            <input type=button class='butt' value=Batal onclick=self.history.back()></td>
		  </tr>
          </table></form>";
     break;
    
  case "editGallery":
    $edit = mysql_query("SELECT * FROM gallery WHERE id_gallery='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
   

    echo "<h2 class='hLine'>Edit Gallery</h2>
          <form method=POST enctype='multipart/form-data' action=$aksi?module=gallery&act=update>
          <input type=hidden name=id value=$r[id_gallery]>
          <table class='list'>
          <tr>
			<td class='left' width=100>Nama Event</td>
			<td class='left'><input type=text name='judul' size=60 value='$r[judul]'></td></tr>
		<tr>
      <tr>
      </tr>
			
		  </tr>
		   <tr>
			<td  class='left'>Gambar</td>
			<td  class='left'>  
			<img src='../joimg/gallery/s_$r[gambar]'></td>
		  </tr>
          <tr>
			<td  class='left'>Ganti Gbr</td>
			<td  class='left'><input type=file name='fupload' size=30> *)</td></tr>
          <tr><td colspan=2  class='left'>*) Apabila gambar tidak diubah, dikosongkan saja.</td></tr>
          <tr><td colspan=2  class='left'>
			<input type=submit class='butt' value=Update>
            <input type=button class='butt' value=Batal onclick=self.history.back()></td></tr>
         </table></form>";
    break;  
	
		
}//end switch

}//end if else
?>
