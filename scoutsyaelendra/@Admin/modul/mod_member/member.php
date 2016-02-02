<?php
if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

$aksi="modul/mod_member/aksi_member.php";
switch($_GET['act']){
  // Tampil User
  default:
    if ($_SESSION['leveladmin']=='admin'){
      $tampil = mysql_query("SELECT * FROM users ORDER BY username");
		echo "<h2 class='hLine'>Pengaturan Member</h2>";
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
						 echo "<a title='Blokir $r[nama_lengkap]' href='$aksi?module=member&act=blokir&status=$r[blokir]&id=$r[username]'><b class='bGreen'>Tidak</b></a>"; 
						 } else {
								echo "<a title='Aktifkan $r[nama_lengkap]' href='$aksi?module=member&act=blokir&status=$r[blokir]&id=$r[username]'><b class='bRed'>Ya</b></a>";
							 }
					 echo "</td>
				 <td><a href=?module=member&act=editmember&id=$r[username]><img src=images/add-icon.gif></a></td>
				 <td><a href=$aksi?module=member&act=hapus&id=$r[username]><img src='images/hr.gif' /></a></td>
				 </tr>";
		  $no++;
		}
		echo "</table>";
    }
    else{
      $tampil=mysql_query("SELECT * FROM users 
                           WHERE username='$_SESSION[namaadmin]'");
	 echo "<h2 style='padding:5px;'>Pengaturan Member</h2>";
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
				 <td><a href=?module=member&act=editmember&id=$r[id_session]><img src=images/add-icon.gif></a></td></tr>";
		  $no++;
		}
		echo "</table>";
    }
    break;
  
  case "tambahmember":
    if ($_SESSION['leveladmin']=='admin'){
    echo "<h2 style='padding:5px;'>Tambah Member</h2>
          <form method=POST action='$aksi?module=member&act=input'>
          <table class='list'>
          <tr><td class='left'>Username</td>     <td  class='left'> : <input type=text name='username'></td></tr>
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
    
  case "editmember":
    $edit=mysql_query("SELECT * FROM users WHERE username='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    if ($_SESSION['leveladmin']=='admin'){
    echo "<h2 style='padding:5px;'>Edit Data Member &raquo; $r[nama_lengkap]</h2>
          <form method=POST action=$aksi?module=member&act=update>
          <input type=hidden name=id value='$r[username]'>
          <table class='list'>
          <tr><td class='left'>Username</td>     <td  class='left'> : <input type=text name='username' value='$r[username]' disabled> **)</td></tr>
          <tr><td class='left'>Nama Lengkap</td> <td  class='left'> : <input type=text name='nama_lengkap' size=30  value='$r[nama_lengkap]'></td></tr>
		  <tr><td class='left'>E-mail</td>       <td  class='left'> : <input type=text name='email' size=30 value='$r[email]'></td></tr>
          <tr><td class='left'>No.Telp/HP</td>   <td  class='left'> : <input type=text name='no_telp' size=30 value='$r[no_telp]'></td></tr>";

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
    
    echo "
          <tr><td class='left' colspan=2><input class='butt' type=submit value=Update>
                            <input class='butt' type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";     
    }
    else{
    echo "<h2>Edit User</h2>
          <form method=POST action=$aksi?module=member&act=update>
          <input type=hidden name=id value='$r[username]'>
          <input type=hidden name=blokir value='$r[blokir]'>
          <table>
          <tr><td>Username</td>     <td> : <input type=text name='username' value='$r[username]' disabled> **)</td></tr>
          <tr><td>Password</td>     <td> : <input type=text name='password'> *) </td></tr>
          <tr><td>Nama Lengkap</td> <td> : <input type=text name='nama_lengkap' size=30  value='$r[nama_lengkap]'></td></tr>
          <tr><td>E-mail</td>       <td> : <input type=text name='email' size=30 value='$r[email]'></td></tr>
          <tr><td>No.Telp/HP</td>   <td> : <input type=text name='no_telp' size=30 value='$r[no_telp]'></td></tr>";    
    echo "<tr><td colspan=2>*) Apabila password tidak diubah, dikosongkan saja.<br />
                            **) Username tidak bisa diubah.</td></tr>
          <tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";     
    }
    break;  
}
}
?>