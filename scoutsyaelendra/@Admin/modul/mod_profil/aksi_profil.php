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
if ($module=='profil' AND $act=='update'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];
  $isi=mysql_real_escape_string($_POST[isi_halaman]);
  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE mod_page SET judul  = '$_POST[judul]', 
                                          isi = '$isi'
                                    WHERE id_page  = '2'");
	
			header('location:../../media.php?module=profil');
		
  }
  else{
		UploadBanner($nama_file);

  $file=mysql_fetch_array(mysql_query("SELECT gambar FROM mod_page WHERE id_page='2'"));
  //hapus foto dari folder
    unlink("../../../joimg/banner/$file[gambar]");   
    unlink("../../../joimg/banner/s_$file[gambar]");   
		mysql_query("UPDATE mod_page SET judul  = '$_POST[judul]',
											  isi = '$isi',
											  gambar      = '$nama_file'   
										WHERE id_page  = '2'");
										
	
					header('location:../../media.php?module=profil');
			}
      }	

}
?>
