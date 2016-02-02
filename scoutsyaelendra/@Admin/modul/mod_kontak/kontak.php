<?php
session_start();
 if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
 echo "<script>window.alert('Untuk mengakses modul anda harus login!');window.location=('../../index.php');</script>";
}
else{
$aksi="modul/mod_kontak/aksi_kontak.php";
switch($_GET['act']){
  // Tampil Komentar/pesan
  default:
    $sql  = mysql_query("SELECT * FROM mod_page WHERE id_page='5'");
    $r    = mysql_fetch_array($sql);

	echo "
	<form method='POST' action='$aksi?module=hubungi&act=updateK'>
	<table class='list'>
		<tr><td class='left' colspan='2'>Konten Halaman Kontak: <input type='hidden' value='$r[id_page]' name='id' /></td></tr>
		<tr><td class='left'colspan='2'><textarea name='deskripsi' id='jogmce'>$r[isi]</textarea></td></tr>
		<tr><td class='left'>Peta</td><td class='left'><input type=text name='peta' size=60 value='$r[gambar]'>$r[gambar]</td></tr>
		<tr><td class='left' colspan='2'><input type='submit' class='butt' value='Update' /></td></tr>
	</table>
	</form>";
	
	//tampilkan data komentar pengunjung
	echo "<h2 class='hLine'>Pesan</h2>
		  <table class='list'><thead>
          <tr><td class='center'> no. </td>
          <td class='left'> nama </td>
		  <td class='left'> email </td>
          <td class='left'>url</td>
          <td class='left'>subjek</td>
          <td class='left' colspan='2'>tanggal</td>
          <td class='center'>Hapus</td></tr></thead><tbody>";
	
    $tampil = mysql_query("SELECT * FROM hubungi ORDER BY id DESC LIMIT 20");
	$no = $posisi+1;
    while ($r = mysql_fetch_array($tampil)){
    
	$tgl=tgl_indo($r['tanggal']);
	  
      echo "<tr><td class='left' width='25'>$no.</td>
                <td class='left'>$r[nama]</td>
				<td class='left'><a href title='klik ikon surat'>$r[email]</a></td>
                <td class='left'>$r[url]</td>
                <td class='left'>$r[subjek]</td>
				<td class='left' colspan='2'>$tgl</a>";
				
		if($r['status_baca']=='0')
		{ echo " <a href='$aksi?module=hubungi&act=baca&id=$r[id]&status=$r[status_baca]' title='Belum dibaca'> 
		<img style='padding:0; float:right;' src='images/mail_red.png' title='Baca Pesan' /> <font class='infoRed'>Belum dibaca </font></a></td>"; 
			} else { 
			echo " <a href='?module=hubungi&act=detail&id=$r[id]' title='Baca Pesan'><img style='padding:0; float:right;' src='images/mail_green.png' /> <font class='infoGreen'>Sudah dibaca </font></a></td>"; }
		
		echo "<td class='center'> <a href=$aksi?module=hubungi&act=hapus&id=$r[id]><img src='images/hr.gif' border='0' title='hapus' /></a>
                </td></tr>";
    $no++;
    }
    echo "</tbody></table>";
    break;  

	//detail komentar
	case "detail";
	
	$tampil = mysql_query("SELECT * FROM hubungi WHERE id='$_GET[id]'");
    $t      = mysql_fetch_array($tampil);
	$tgl = tgl_indo($t['tanggal']);
	
	echo "<h2 class='hLine'><a href='?module=$_GET[module]'>Message </a>&raquo; $t[nama] &raquo; $t[subjek]</h2>";
	echo "<form method=POST action='?module=$_GET[module]&act=kirimemail'>";
	echo "<table class='list'>";
		echo "<tr>
			<td width='180' class='left _capitalize'>name</td>
			<td class='left'><div class='msgBox'> $t[nama] <input type='hidden' name='nama' value='$t[nama]'></div></td>
		</tr>
		<tr>
			<td class='left _capitalize'>email</td>
			<td class='left'> <div class='msgBox'> $t[email] <input type='hidden' name='email' value='$t[email]'> </div></td>
		</tr>
		<tr>
			<td class='left _capitalize'>subject</td>
			<td class='left'><div class='msgBox'> $t[subjek] </div> </td>
		</tr>
		<tr>
			<td colspan='2' class='left vtop _capitalize'>message </td>
		</tr>
		<tr>
			<td colspan='2' class='left'><div class='msgBox'> $t[isi] </div> </td>
		</tr></table>
		
		<h2 class='hLine _capitalize'> Reply</h2>
		<table class='list'>
		<tr>
			<td colspan='2' class='left'>
			<p class='_capitalize'>name <input size='50' type='text' class='msgBox' value='Admin Solusi Buku' name='from_name'/> </p></td>
		</tr>
		<tr>
			<td colspan='2' class='left'>
			<p class='_capitalize'>email<input size='50' type='text' class='msgBox' value='no-reply@solusibuku.com' name='from_email' /> </p></td>
		</tr>
		<tr>
			<td class='center _capitalize'>subject</td>
			<td class='left vtop'> <input size='50' class='msgBox' type='text' value='Re: $t[subjek]' name='subjek' /> </td>
		</tr>
		<tr>
			<td colspan='2' class='td_text'>
				<textarea name='pesan' id='jogmce' style='width:100%; height: 200px;'>
				</textarea>
			</td>
		</tr>
		<tr>
			<td colspan='2' class='left'>
				<input class='butt' type='submit' value='Send' />
			</td>
		</tr>";
	echo "</table>";
	echo "</form>";
	break;
	
	//kirim reply email
	case "kirimemail":
    mail($_POST['email'],$_POST['subjek'],$_POST['pesan'],"From: info@solusibuku.com");
    echo "<script>window.alert('Pesan telah dikirim ke $_POST[email]');window.location=('media.php?module=hubungi');</script>"; 		  
    break;  
	
}

}//end else
?>
