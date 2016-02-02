
<?php
session_start();
 if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_kurir/aksi_kurir.php";
switch($_GET['act']){
 default:
    echo "<h2 class='hLine'>Pengaturan kurir</h2>
          <input type=button class='butt' value='Tambah Kurir' onclick=\"window.location.href='?module=kurir&act=addKur';\">
          
		  
          <table class='list'>
          <thead>
			  <tr>
				<td class='center'>No.</td>
				<td class='center'>Jasa Pengiriman</td>
				<td class='center'>Logo</td>
				<td class='center' colspan='2'>Aksi</td>
			  </tr>
		  </thead>";
		$sql=mysql_query("SELECT * FROM mod_kurir ORDER BY nama_kurir DESC");
		$no=1;
		while($s=mysql_fetch_array($sql))
		{
			echo "<tr><td width='25'>$no.</td>
                <td class='center'>$s[nama_kurir]</td>
                <td class='center'><img src='../joimg/banner/s_$s[gambar]' width='50' /></td>
                <td width='35'>
						<a href=?module=kurir&act=editKur&id=$s[id_kurir] title='edit'><img src='images/add-icon.gif'></a> 
					</td>
		            <td width='35'><a href=$aksi?module=kurir&act=hapus&id=$s[id_kurir]><img src='images/hr.gif' title='Hapus'></a></td>

		        </tr>";
			$no++;
		}
    echo "</table>";
	break;
	
	case "addKur":
	 echo "<h2 class='hLine'>Tambah Kurir</h2>
          <form method=POST action='$aksi?module=kurir&act=input' enctype='multipart/form-data'>
          <table class='list'>
          <tr>
			<td width=100 class='left'>Jasa Pengiriman</td>
			<td class='left'><input type=text name='nama' size=60></td>
		  </tr>
		  <tr>
			<td width=100 class='left'>URL</td>
			<td class='left'><input type=text name='url' size=60></td>
		  </tr>
		  <tr>
			<td width=100 class='left'>Logo</td>
			<td class='left'><input type=file name='fupload' size=80></td>
		  </tr>
		  <tr>
			<td colspan=2 class='left'>
			<input type=submit class='butt' value=Simpan>
            <input type=button class='butt' value=Batal onclick=self.history.back()></td>
		  </tr>
          </table></form>";
     break;

     case "editKur":
	 $edit = mysql_query("SELECT * FROM mod_kurir WHERE id_kurir='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
    echo "<h2 class='hLine'>Edit Jasa Pengiriman &raquo $r[nama_kurir]</h2>
          <form method=POST enctype='multipart/form-data' action=$aksi?module=kurir&act=update>
          <input type=hidden name=id value='$r[id_kurir]'>
          <table class='list'>";
	 echo "<tr>
	<td  class='left' valign='middle'>Jasa Pengiriman</td> 
	<td class='left'><input type=text name='nama' size=60 value='$r[nama_kurir]'> </td>
	</tr>
	<tr>
			<td width=100 class='left'>URL</td>
			<td class='left'><input type=text name='url' size=60 value='$r[url]'></td>
		  </tr>
	 <tr>
			<td width=100 class='left'>Logo</td>
			<td valign='top' class='left'> <img src='../joimg/banner/s_$r[gambar]' height='50'/></td>
              </tr>
              <tr>
                <td class='left'>Ganti Logo</td>
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
