<?php
session_start();
 if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_bank/aksi_bank.php";
switch($_GET[act]){
  // Tampil Bank
  default:
    echo "<h2 class='hLine'>Rekening Bank Pembayaran</h2 class='hLine'>
          <input type=button class=butt value='Tambah Rekening Bank' onclick=location.href='?module=bank&act=tambahbank'>
          <table class='list'>
          <tr><th class='center'>No.</th><th>Nama Bank</th><th>Nomer Rekening</th><th class='center'>Nama Pemilik</th><th  colspan='2' class='center'>Aksi</th></tr>";
    $tampil=mysql_query("SELECT * FROM mod_bank ORDER BY id_bank DESC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
      echo "<tr><td>$no.</td>
                <td class='left'><img src='../joimg/banner/$r[gambar]'></td>
                <td class='left'>$r[no_rekening]</td>
                <td class='left'>$r[pemilik]</td>
                <td width='20'><a href=?module=bank&act=editbank&id=$r[id_bank]><img src='images/add-icon.gif' title='edit' /></a></td>
	             <td width='20'><a href=$aksi?module=bank&act=hapus&id=$r[id_bank]&file=$r[gambar]><img src='images/hr.gif' title='Hapus'></a></td>
		        </tr>";
    $no++;
    }
    echo "</table>";
    break;
  
  case "tambahbank":
    echo "<h2 class='hLine'>Tambah Rekening Bank</h2 class='hLine'>
          <form method=POST action='$aksi?module=bank&act=input' enctype='multipart/form-data'>
          <table class='list'>
          <tr>
			<td class='left'>Nama Bank</td>
			<td class='left'>  : <input type=text name='nama_bank' size=30></td></tr>
          <tr>
			<td class='left'>No. Rekening</td>
			<td class='left'>   : <input type=text name='no_rekening' size='50'></td></tr>
          <tr>
			<td class='left'>Nama Pemilik</td>
			<td class='left'>   : <input type=text name='pemilik' size='50'></td></tr>          
          <tr>
			<td class='left'>Ganti Gambar</td>
			<td class='left'> : <input type=file name='fupload' size=40></td></tr>
		  <tr>
			<td class='left' colspan='2'>* lebar maksimal gambar 200px. Format; *.jpeg/jpg, *.png, *.gif</td>
		  </tr>
          <tr>
			<td class='left' colspan=2>
				<input type=submit class=butt value=Simpan>
                <input type=button class=butt value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;
    
  case "editbank":
    $edit = mysql_query("SELECT * FROM mod_bank WHERE id_bank='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2 class='hLine'>Edit Rekening Bank</h2 class='hLine'>
          <form method=POST enctype='multipart/form-data' action=$aksi?module=bank&act=update>
          <input type=hidden name=id value=$r[id_bank]>
          <table class='list'>
          <tr>
			<td class='left'>Nama Bank</td>
			<td class='left'>     : <input type=text name='nama_bank' size=30 value='$r[nama_bank]'></td></tr>
          <tr>
			<td class='left'>No. Rekening</td>
			<td class='left'>      : <input type=text name='no_rekening' size=50 value='$r[no_rekening]'></td></tr>
          <tr>
			<td class='left'>Nama Pemilik</td>
			<td class='left'>      : <input type=text name='pemilik' size=50 value='$r[pemilik]'></td></tr>
          <tr>
			<td class='left'>Gambar</td>
			<td class='left'>    : <img src='../joimg/banner/$r[gambar]'></td></tr>
          <tr>
			<td class='left'>Ganti Gambar</td>
			<td class='left'> : <input type=file name='fupload' size=30> *)</td></tr>
          <tr>
			<td class='left' colspan=2>*) Apabila gambar tidak diubah, dikosongkan saja.</td></tr>
          <tr>
			<td class='left' colspan=2><input type=submit class=butt value=Update>
                            <input type=button class=butt value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;  
}
}
?>
