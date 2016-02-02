<?php
session_start();
 if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_title/aksi_title.php";
switch($_GET['act'])
{
  // Tampil Halaman Statis
  default:
    
    $edit = mysql_query("SELECT * FROM modul WHERE id_modul='46'");
    $r    = mysql_fetch_array($edit);
    echo "<h2 style='padding: 5px;'>Edit Tittle</h2>
          <form method=POST enctype='multipart/form-data' action=$aksi?module=title&act=update>
          <input type=hidden name=id value=$r[id_modul]>
          <table class='list'>";
    echo "<tr>
	<td  class='left' valign='middle' width=70>Judul</td> 
	<td class='left'> : <input type=text name='judul' size=60 value='$r[nama_modul]' disabled> </td>
	</tr>";	
	
	echo "<tr>
		<td>Isi Halaman</td>   
		<td> <textarea name='isi' style='width:100%; height:400px;'>$r[static_content]</textarea></td>
	</tr>
	<tr>
			<td class='left' colspan=2>
			<input class='butt' type=submit value=Update>
            <input class='butt' type=button value=Batal onclick=self.history.back()></td></tr>
         </table></form>";
    break; 

}//end switch

}//end if-else
?>
