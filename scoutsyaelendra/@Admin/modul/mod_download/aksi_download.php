<?php
session_start();
include "../../../josys/koneksi.php";
include "../../../josys/library.php";
include "../../../josys/fungsi_thumb.php";

$module=$_GET['module'];
$act=$_GET['act'];
$folderimg="../../../joimg/berkas"; // Tempat upload file gambar

// Hapus Perusahaan Pengiriman
if ($module=='download' AND $act=='hapus'){
	$id  = $_GET['id'];
	$gbr = $_GET['file'];
	
	$cek = mysql_fetch_array(mysql_query("SELECT file FROM download WHERE id='$id'"));
	if($cek['file']!=''){
	mysql_query("DELETE FROM download WHERE id='$id'");
    unlink("../../../joimg/berkas/$_gbr");   
    unlink("../../../joimg/berkas/s_$gbr");
  } else { 
	mysql_query("DELETE FROM download WHERE id='$id'");
	}
	
	header('location:../../media.php?module='.$module);
}

// Input Perusahaan Pengiriman
elseif ($module=='download' AND $act=='input'){
  
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];
  $acak           = rand(000000,999999);
  $nama_file_unik = $acak.$nama_file; 

  // Apabila ada gambar yang diupload
	if (!empty($lokasi_file)){
    UploadBerkas($nama_file_unik);
    mysql_query("INSERT INTO download(nama,
                                    file) 
                            VALUES('$_POST[nama]',
                                   '$nama_file_unik')");
	}
	header('location:../../media.php?module='.$module);
}

// Update Perusahaan Pengiriman
elseif ($module=='download' AND $act=='update'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];
  $acak           = rand(000000,999999);
  $nama_file_unik = $acak.$nama_file; 
  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE download SET nama  ='$_POST[nama]'
                             WHERE id = '$_POST[id]'");
  }
  else{
    UploadBerkas($nama_file_unik);
  $file=mysql_fetch_array(mysql_query("SELECT file FROM download WHERE download='$_POST[id]'"));
  //hapus foto dari folder
    unlink("../../../joimg/banner/$file[gambar]");   
    unlink("../../../joimg/banner/s_$file[gambar]");    
    mysql_query("UPDATE download SET nama     = '$_POST[nama]',
                                   file   = '$nama_file_unik'   
                             WHERE id = '$_POST[id]'");
  }
  header('location:../../media.php?module='.$module);
}

?>
