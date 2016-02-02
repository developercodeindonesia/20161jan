
<?php
session_start();
 if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_penerbit/aksi_penerbit.php";
switch($_GET['act']){
 default:
    echo "<h2 class='hLine'>Pengaturan Penerbit Buku</h2>
          <form method=POST action='$aksi?module=penerbit&act=input' enctype='multipart/form-data'>
			  <table class='list'>
			  <tr>
			  	<td valign='middle' colspan='3' class='left'>
				<input type='text' name='nama_penerbit' id='nama_penerbit' size='35' />
				<input type='submit' class='butt' title='Tambah Penerbit' value='[+]Penerbit' /></td>

				</td>
			  </tr>
			  </table>
		  </form>
		  
          <table class='list'>
          <thead>
			  <tr>
				<td class='center'>No.</td>
				<td class='left'>Nama Penerbit</td>
				<td class='center' colspan='2'>Aksi</td>
			  </tr>
		  </thead>";
		$sql=mysql_query("SELECT * FROM penerbit ORDER BY nama_penerbit");
		$no=1;
		while($s=mysql_fetch_array($sql))
		{
			echo "<tr><td width='25'>$no.</td>
                <td class='left'>$s[nama_penerbit]</td>
                <td width='35'>
						<a href=?module=penerbit&act=editPen&id=$s[id_penerbit] title='edit'><img src='images/add-icon.gif'></a> 
					</td>
		            <td width='35'><a href=$aksi?module=penerbit&act=del&id=$s[id_penerbit]><img src='images/hr.gif' title='Hapus'></a></td>

		        </tr>";
			$no++;
		}
    echo "</table>";
	break;
	
	case "addPen":
	 echo "<h2 class='hLine'>Tambah Penerbit</h2>
          <form method=POST action='$aksi?module=penerbit&act=input' enctype='multipart/form-data'>
          <table class='list'>
          <tr>
			<td width=100 class='left'>Nama Penerbit</td>
			<td class='left'><input type=text name='nama_penerbit' size=60></td>
		  </tr>
          <tr>
			<td colspan=2 class='left'>
			<input type=submit class='butt' value=Simpan>
            <input type=button class='butt' value=Batal onclick=self.history.back()></td>
		  </tr>
          </table></form>";
     break;

     case "editPen":
	 $edit = mysql_query("SELECT * FROM penerbit WHERE id_penerbit='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
    echo "<h2 class='hLine'>Edit Penerbit &raquo $r[nama_penerbit]</h2>
          <form method=POST enctype='multipart/form-data' action=$aksi?module=penerbit&act=update>
          <input type=hidden name=id value=$r[id_penerbit]>
          <table class='list'>";
	 echo "<tr>
	<td  class='left' valign='middle'>Nama Penerbit</td> 
	<td class='left'><input type=text name='nama_penerbit' size=60 value='$r[nama_penerbit]'> </td>
	</tr>";

	echo  "<tr>
			<td class='left' colspan=2>
			<input class='butt' type=submit value=Update>
            <input class='butt' type=button value=Batal onclick=self.history.back()></td></tr>
         </table></form>";
	break;
		
}//end switch

}//end if else
?>
