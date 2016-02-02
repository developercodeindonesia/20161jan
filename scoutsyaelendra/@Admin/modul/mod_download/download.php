
<?php
 if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_download/aksi_download.php";
switch($_GET['act']){
 default:
    echo "<h2 class='hLine'>Pengaturan Download</h2>
          <input type=button class='butt' value='Tambah File' onclick=\"window.location.href='?module=download&act=addD';\">
          
		  
          <table class='list'>
          <thead>
			  <tr>
				<td class='center'>No.</td>
				<td class='center'>Judul</td>
				<td class='center'>Nama File</td>
				<td class='center' colspan='2'>Aksi</td>
			  </tr>
		  </thead>";
		$sql=mysql_query("SELECT * FROM download ORDER BY nama DESC");
		$no=1;
		while($s=mysql_fetch_array($sql))
		{
			echo "<tr><td width='25'>$no.</td>
                <td class='center'>$s[nama]</td>
                <td class='center'>$s[file]</td>
                <td width='35'>
						<a href=?module=download&act=editD&id=$s[id] title='edit'><img src='images/add-icon.gif'></a> 
					</td>
		            <td width='35'><a href=$aksi?module=download&act=hapus&id=$s[id]><img src='images/hr.gif' title='Hapus'></a></td>

		        </tr>";
			$no++;
		}
    echo "</table>";
	break;
	
	case "addD":
	 echo "<h2 class='hLine'>Tambah File</h2>
          <form method=POST action='$aksi?module=download&act=input' enctype='multipart/form-data'>
          <table class='list'>
          <tr>
			<td width=100 class='left'>Nama</td>
			<td class='left'><input type=text name='nama' size=60></td>
		  </tr>
		  <tr>
			<td width=100 class='left'>File</td>
			<td class='left'><input type=file name='fupload' size=80></td>
		  </tr>
		  <tr>
			<td colspan=2 class='left'>
			<input type=submit class='butt' value=Simpan>
            <input type=button class='butt' value=Batal onclick=self.history.back()></td>
		  </tr>
          </table></form>";
     break;

     case "editD":
	 $edit = mysql_query("SELECT * FROM download WHERE id='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
    echo "<h2 class='hLine'>Edit File &raquo $r[nama]</h2>
          <form method=POST enctype='multipart/form-data' action=$aksi?module=download&act=update>
          <input type=hidden name=id value='$r[id]'>
          <table class='list'>";
	 echo "<tr>
	<td  class='left' valign='middle'>Nama</td> 
	<td class='left'><input type=text name='nama' size=60 value='$r[nama]'> </td>
	</tr>
	 <tr>
			<td width=100 class='left'>File</td>
			<td valign='top' class='left'> $r[file]</td>
              </tr>
              <tr>
                <td class='left'>Ganti File</td>
                <td valign='top' class='left'> <input type=file name='fupload' size=50></td>
              </tr>
		 </tr>
		";

	echo  "<tr>
			<td class='left' colspan=2>
			<input class='butt' type=submit value=Update>
            <input class='butt' type=button value=Batal onclick=self.history.back()></td></tr>
         </table></form>";
	break;
		
}//end switch

}//end if else
?>
