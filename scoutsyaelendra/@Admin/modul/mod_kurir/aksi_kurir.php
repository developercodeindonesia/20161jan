<?php
session_start();
include "../../../josys/koneksi.php";
include "../../../josys/library.php";
include "../../../josys/fungsi_thumb.php";

$module=$_GET['module'];
$act=$_GET['act'];
$folderimg="../../../joimg/"; // Tempat upload file gambar

// Hapus Perusahaan Pengiriman
if ($module=='kurir' AND $act=='hapus'){
	$id  = $_GET['id'];
	$gbr = $_GET['file'];
	
	$cek = mysql_fetch_array(mysql_query("SELECT gambar FROM mod_kurir WHERE id_kurir='$id'"));
	if($cek['gambar']!=''){
	mysql_query("DELETE FROM mod_kurir WHERE id_kurir='$id'");
    unlink("../../../joimg/banner/$_gbr");   
    unlink("../../../joimg/banner/s_$gbr");
  } else { 
	mysql_query("DELETE FROM mod_kurir WHERE id_kurir='$id'");
	}
	
	header('location:../../media.php?module='.$module);
}

// Input Perusahaan Pengiriman
elseif ($module=='kurir' AND $act=='input'){
  
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];
  $acak           = rand(000000,999999);
  $nama_file_unik = $acak.$nama_file; 

  // Apabila ada gambar yang diupload
	if (!empty($lokasi_file)){
    UploadBanner($nama_file_unik);
    mysql_query("INSERT INTO mod_kurir(nama_kurir,
                                    url,
                                    gambar) 
                            VALUES('$_POST[nama]',
                                  '$_POST[url]',
                                   '$nama_file_unik')");
	}
	header('location:../../media.php?module='.$module);
}

// Update Perusahaan Pengiriman
elseif ($module=='kurir' AND $act=='update'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];
  $acak           = rand(000000,999999);
  $nama_file_unik = $acak.$nama_file; 
  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE mod_kurir SET nama_kurir  ='$_POST[nama]',
                                      url = '$_POST[url]'
                             WHERE id_kurir = '$_POST[id]'");
  }
  else{
    UploadBanner($nama_file_unik);
  $file=mysql_fetch_array(mysql_query("SELECT gambar FROM mod_kurir WHERE id_kurir='$_POST[id]'"));
  //hapus foto dari folder
    unlink("../../../joimg/banner/$file[gambar]");   
    unlink("../../../joimg/banner/s_$file[gambar]");    
    mysql_query("UPDATE mod_kurir SET nama_kurir     = '$_POST[nama]',
                                    url = '$_POST[url]',
                                   gambar    = '$nama_file_unik'   
                             WHERE id_kurir = '$_POST[id]'");
  }
  header('location:../../media.php?module='.$module);
}

?>
