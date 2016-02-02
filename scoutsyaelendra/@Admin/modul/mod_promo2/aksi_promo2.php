<?php
session_start();
 if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../josys/koneksi.php";
include "../../../josys/library.php";
include "../../../josys/fungsi_thumb.php";

$module=$_GET['module'];
$act=$_GET['act'];

// Hapus halaman statis
if ($module=='promo2' AND $act=='update'){

  $isi=mysql_real_escape_string($_POST['isi_halaman']);
  // Apabila gambar tidak diganti
    mysql_query("UPDATE mod_page SET judul  = '$_POST[judul]', 
                                          isi = '$isi'
                                    WHERE id_page  = '15'");
	
	header('location:../../media.php?module=promo2');
}
}
?>