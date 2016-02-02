<?php
session_start();
 if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
 echo "<script>window.alert('Untuk mengakses modul anda harus login!');window.location=('../../index.php');</script>";
}
else{
include "../../../josys/koneksi.php";
include "../../../josys/library.php";
include "../../../josys/fungsi_thumb.php";

$module=$_GET['module'];
$act=$_GET['act'];

// Hapus banner
if ($module=='banner' AND $act=='hapus'){

	$id = $_GET['id'];
	$gbr= $_GET['file'];

	$cek = mysql_fetch_array(mysql_query("SELECT gambar FROM mod_banner WHERE id_banner='$id'"));
	if($cek['gambar']!=''){
	mysql_query("DELETE FROM mod_banner WHERE id_banner='$id'");
    unlink("../../../joimg/banner/$cek[gambar]");   
    unlink("../../../joimg/banner/s_$cek[gambar]");
  } else { 
	mysql_query("DELETE FROM mod_banner WHERE id_banner='$id'");
	}
	
	header('location:../../media.php?module='.$module);
}

// Input banner
elseif ($module=='banner' AND $act=='input'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];
  $acak           = rand(000000,999999);
  $nama_file_unik = $acak.$nama_file; 
  
$banKat = $_POST['banKat']; 

  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    UploadBanner($nama_file_unik);
    mysql_query("INSERT INTO mod_banner(judul,
                                    url,
                                    tgl_posting,
                                    gambar) 
                            VALUES('$_POST[judul]',
                                   '$_POST[url]',
                                   '$tgl_sekarang',
                                   '$nama_file_unik')");
  }
  else{
    mysql_query("INSERT INTO mod_banner(judul,
                                    tgl_posting,
                                    url) 
                            VALUES('$_POST[judul]',
                                   '$tgl_sekarang',
                                   '$_POST[url]')");
  }
  header('location:../../media.php?module='.$module);
}

// Update banner
elseif ($module=='banner' AND $act=='update'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];
  $acak           = rand(000000,999999);
  $nama_file_unik = $acak.$nama_file; 
  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE mod_banner SET judul     = '$_POST[judul]',
                                   url       = '$_POST[url]'
                             WHERE id_banner = '$_POST[idbanner]'");
  }
  else{
    UploadBanner($nama_file_unik);
	$file=mysql_fetch_array(mysql_query("SELECT gambar FROM mod_banner WHERE id_banner='$_POST[idbanner]'"));
	//hapus foto dari folder
	  unlink("../../../joimg/banner/$file[gambar]");   
	  unlink("../../../joimg/banner/s_$file[gambar]"); 	  
    mysql_query("UPDATE mod_banner SET judul     = '$_POST[judul]',
                                   url       = '$_POST[url]',
                                   gambar    = '$nama_file_unik'   
                             WHERE id_banner = '$_POST[idbanner]'");
  }
  header('location:../../media.php?module='.$module);
}
}
?>
