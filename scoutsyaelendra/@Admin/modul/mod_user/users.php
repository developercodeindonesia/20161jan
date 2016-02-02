<?php
if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

$aksi="modul/mod_user/aksi_users.php";
switch($_GET['act']){
  // Tampil User
  default:
    if ($_SESSION['idadmin']=='1'){
      $tampil = mysql_query("SELECT * FROM admin ORDER BY username");
		echo "<h2 class='hLine'>Pengaturan User</h2>
		<input class='butt' type=button value='Tambah User' onclick=\"window.location.href='?module=user&act=tambahuser';\">";
		echo "<table class='list'>
			  <thead><tr><td class='center'>No.</td><td class='center'>Username</td><td class='center'>Nama Lengkap</td><td class='center'>Email</td><td class='center'>No.Telp/HP</td><td class='center'>Level</td><td class='center'>Blokir</td><td class='center' colspan='2'>Aksi</td></tr></thead>"; 
		$no=1;
		while ($r=mysql_fetch_array($tampil)){
			
		   echo "<tr><td>$no.</td>
				 <td>$r[username]</td>
				 <td>$r[nama_lengkap]</td>
					 <td><a href=mailto:$r[email]>$r[email]</a></td>
					 <td>$r[no_telp]</td>
           <td>$r[level]</td>
					 <td align=center>";
					 if($r['blokir']=='N')
					 { 
						 echo "<a title='Blokir $r[nama_lengkap]' href='$aksi?module=user&act=blokir&status=$r[blokir]&id=$r[id_session]'><b class='bGreen'>Tidak</b></a>"; 
						 } else {
								echo "<a title='Aktifkan $r[nama_lengkap]' href='$aksi?module=user&act=blokir&status=$r[blokir]&id=$r[id_session]'><b class='bRed'>Ya</b></a>";
							 }
					 echo "</td>
				 <td><a href=?module=user&act=edituser&id=$r[id_session]><img src=images/add-icon.gif></a></td>";
			if ($r['id']!='1'){
				 echo"<td><a href=$aksi?module=user&act=hapus&id=$r[id_session]><img src='images/hr.gif' /></a></td>";
			}
				 echo"</tr>";
		  $no++;
		}
		echo "</table>";
    }
    else{
      $tampil=mysql_query("SELECT * FROM admin WHERE username='$_SESSION[namaadmin]'");
	 echo "<h2 style='padding:5px;'>Pengaturan User</h2>";
		echo "<table class='list'>
			  <tr><td>No.</td><td>Username</td><td>Nama Lengkap</td><td>Email</td><td>No.Telp/HP</td><td>Blokir</td><td>Aksi</td></tr>"; 
		$no=1;
		while ($r=mysql_fetch_array($tampil)){
		   echo "<tr><td>$no.</td>
				 <td>$r[username]</td>
				 <td>$r[nama_lengkap]</td>
					 <td><a href=mailto:$r[email]>$r[email]</a></td>
					 <td>$r[no_telp]</td>
					 <td align=center>";
					 if($r['blokir']=='N')
					 { 
						 echo "<b class='bGreen'>Tidak</b>"; 
						 } else {
								echo "<b class='bRed'>Ya</b>";
							 }
					 echo "</td>
				 <td><a href=?module=user&act=edituser&id=$r[id_session]><img src=images/add-icon.gif></a></td></tr>";
		  $no++;
		}
		echo "</table>";
    }
    break;
  
  case "tambahuser":
    if ($_SESSION['leveladmin']=='admin'){
    echo "<h2 style='padding:5px;'>Tambah User</h2>
          <form method=POST action='$aksi?module=user&act=input'>
          <table class='list'>
          <tr><td class='left'>Username</td>     <td  class='left'> : <input type=text name='username'></td></tr>
          <tr><td  class='left'>Password</td>     <td  class='left'> : <input type=text name='password'></td></tr>
          <tr><td  class='left'>Nama Lengkap</td> <td  class='left'> : <input type=text name='nama_lengkap' size=30></td></tr>  
          <tr><td  class='left'>E-mail</td>       <td  class='left'> : <input type=text name='email' size=30></td></tr>
          <tr><td  class='left'>No.Telp/HP</td>   <td  class='left'> : <input type=text name='no_telp' size=20></td></tr>
          <tr><td  class='left' colspan=2><input class='butt' type=submit value=Simpan>
                            <input class='butt' type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    }
    else{
      echo "Anda tidak berhak mengakses halaman ini.";
    }
     break;
    
	
  case "edituser":
    $edit=mysql_query("SELECT * FROM admin WHERE id_session='$_GET[id]'");
    $r=mysql_fetch_array($edit);

		echo "<h2 style='padding:5px;'>Edit Data User &raquo; $r[nama_lengkap]</h2>
			  <form method=POST action=$aksi?module=user&act=update>
			  <input type=hidden name=id value='$r[id]'>
			  <table class='list'>
			  <tr><td class='left'>Username</td>     <td  class='left'> : <input type=text name='username' value='$r[username]' ></td></tr>
			  <tr><td class='left'>Password</td>     <td  class='left'> : <a href='media.php?module=user&act=editpassword&id=$r[id_session]'>Ubah Password</a></td></tr>
			  <tr><td class='left'>Nama Lengkap</td> <td  class='left'> : <input type=text name='nama_lengkap' size=30  value='$r[nama_lengkap]'></td></tr>
			  <tr><td class='left'>E-mail</td>       <td  class='left'> : <input type=text name='email' size=30 value='$r[email]'></td></tr>
			  <tr><td class='left'>No.Telp/HP</td>   <td  class='left'> : <input type=text name='no_telp' size=30 value='$r[no_telp]'></td></tr>";
		
		if ($_SESSION['idadmin']=='1'){
			if ($r['blokir']=='N'){
			  echo "<tr><td class='left'>Blokir</td>     
			  <td class='left'> : <input type=radio name='blokir' value='Y'> Ya   
			  <input type=radio name='blokir' value='N' checked> N </td></tr>";
			}
			else{
			  echo "<tr><td class='left'>Blokir</td>    
			  <td class='left'> : <input type=radio name='blokir' value='Y' checked> Y  
			  <input type=radio name='blokir' value='N'>Tidak</td></tr>";
			}
		}
		echo "<tr><td class='left' colspan=2>*) Apabila password tidak diubah, dikosongkan saja.</td></tr>
			  <tr><td class='left' colspan=2><input class='butt' type=submit value=Update>
								<input class='butt' type=button value=Batal onclick=self.history.back()></td></tr>
			  </table></form>";     
    break;  
	
	
	case "editpassword":
    $edit=mysql_query("SELECT * FROM admin WHERE id_session='$_GET[id]'");
    $r=mysql_fetch_array($edit);

		echo "<h2 style='padding:5px;'>Edit Data User &raquo; $r[nama_lengkap]</h2>
			  <form method=POST action=$aksi?module=user&act=updatepswd>
			  <input type=hidden name=id value='$r[id]'>
			  <table class='list'>
			  <tr><td class='left'>Username</td>     <td  class='left'> : <input type=text name='username' value='$r[username]' readonly></td></tr>
			  <tr><td class='left'>Password Lama</td>     <td  class='left'> : <input type=password name='pswd_lama' required></td></tr>
			  <tr><td class='left'>Password Baru</td>     <td  class='left'> : <input type=password name='pswd_baru' required></td></tr>
			  <tr><td class='left'>Ulangi Password Baru</td>     <td  class='left'> : <input type=password name='pswd_baru_ulang' required></td></tr>
			  ";
		
		echo "
			  <tr><td class='left' colspan=2><input class='butt' type=submit value=Update>
								<input class='butt' type=button value=Batal onclick=self.history.back()></td></tr>
			  </table></form>";     
    break;  
}
}
?>
