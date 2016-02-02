<?php
 if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_event/aksi_event.php";
switch($_GET['act']){
  // Tampil Produk
  default:
    echo "<h2 class='hLine'>Event</h2>
          <input type=button class='butt' value='Tambah Event Baru' onclick=\"window.location.href='?module=event&act=addEvent';\">
          <table class='list'>
          <thead>
			  <tr>
				<td class='center'>No.</td>
				<td class='center'>Nama Event</td>
				<td class='center'>Tanggal</td>
				<td colspan='2' class='center'>Aksi</td>
			  </tr>
		  </thead>";

	//paging
    $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
    $url = "?module=$_GET[module]&";
    $limit = 10;
    $startpoint = ($page * $limit) - $limit;     
    $table = "event";

    $tampil = mysql_query("SELECT * FROM event ORDER BY id_event DESC LIMIT {$startpoint}, {$limit}");
  
    $no = $startpoint+1;
    while($r=mysql_fetch_array($tampil)){
      $tanggal=tgl_indo($r['tanggal']);
      echo "<tr><td>$no</td>
                <td class='left'>$r[judul]</td>
                <td>$r[tanggal]</td>
		            <td><a href=?module=event&act=editEvent&id=$r[id_event]><img src='images/add-icon.gif'></a></td> 
		            <td><a href=$aksi?module=event&act=del&id=$r[id_event]&nama_file=$r[gambar]><img src='images/hr.gif'></a></td>
		        </tr>";
      $no++;
    }
    echo "</table>";
	echo pagination($table,$limit,$page, $url);
 
    break;
  
  case "addEvent":
    echo "<h2 class='hLine'>Tambah Event</h2>
          <form method=POST action='$aksi?module=event&act=input' enctype='multipart/form-data'>
          <table class='list'>
          <tr>
			<td class='left'>Nama Event</td>
			<td class='left'><input type=text name='judul' size=60></td>
		  </tr>
          <tr>
          <td class='left'>Oleh</td>
          <td class='left'><input type=text name='oleh' size=60 value='$r[oleh]'></td>
          </tr>
		  <tr>
			<td class='left'>Deskripsi</td>  
			<td><textarea id='jogmce' name='deskripsi' style='width: 100%; height: 350px;'></textarea></td></tr>
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
    
  case "editEvent":
    $edit = mysql_query("SELECT * FROM event WHERE id_event='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
   

    echo "<h2 class='hLine'>Edit Detail Event</h2>
          <form method=POST enctype='multipart/form-data' action=$aksi?module=event&act=update>
          <input type=hidden name=id value=$r[id_event]>
          <table class='list'>
          <tr>
			<td class='left' width=100>Nama Event</td>
			<td class='left'><input type=text name='judul' size=60 value='$r[judul]'></td></tr>
		<tr>
      <tr>
      <td class='left'>Oleh</td>
      <td class='left'><input type=text name='oleh' size=60 value='$r[oleh]'></td>
      </tr>
			<td  class='left'>Deskripsi</td>
			<td> <textarea name='deskripsi' id='jogmce' style='width: 100%px; height: 350px;'>$r[isi]</textarea></td>
		  </tr>
		   <tr>
			<td  class='left'>Gambar</td>
			<td  class='left'>  
			<img src='../joimg/event/s_$r[gambar]'></td>
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
