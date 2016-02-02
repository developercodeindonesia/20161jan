<?php
session_start();
include "../../../josys/koneksi.php";
include "../../../josys/library.php";
include "../../../josys/fungsi_thumb.php";
include "../../../josys/fungsi_seo.php";

$module=$_GET['module'];
$act=$_GET['act'];

// Hapus produk
if ($module=='artikel' AND $act=='del'){
  $data=mysql_fetch_array(mysql_query("SELECT gambar FROM cetak_murah WHERE id_cetak='$_GET[id]'"));
  if($data['gambar']!='') {
	
	//hapus foto dari folder
	unlink("../../../joimg/artikel/$_GET[nama_file]");
	unlink("../../../joimg/artikel/s_$_GET[nama_file]");
	
	mysql_query("DELETE FROM artikel WHERE id_cetak='$_GET[id]'");
	header('location:../../media.php?module='.$module);
  
  } 
	else {

	mysql_query("DELETE FROM cetak_murah WHERE id_cetak='$_GET[id]'");
	header('location:../../media.php?module='.$module);

	}
 
}

// Input Artikel
elseif ($module=='artikel' AND $act=='input')
{
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 
  $isi=mysql_real_escape_string($_POST['deskripsi']);
  
  $produk_seo      = seo_title(trim($_POST['judul']));
  // Apabila ada gambar yang diupload
	if(empty($_POST['judul']))
	{
			echo "<script>window.alert('Judul harus diisi');
            window.location(history.back(-1))</script>";
	}
	  
		else 
		{
			UploadArtikel($nama_file_unik);
			mysql_query("INSERT INTO cetak_murah(judul,
                                    tanggal, 
                                    judul_seo,
                                    isi,
                                    oleh,
                                    gambar) 
                            VALUES('$_POST[judul]',
                                   now(),
                                   '$produk_seo',
                                   '$isi',
                                   '$_POST[oleh]',
                                   '$nama_file_unik')");
            header('location:../../media.php?module='.$module);
        }
}

// Update produk
elseif ($module=='artikel' AND $act=='update')
{
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 
  $isi=mysql_real_escape_string($_POST['deskripsi']);

  $produk_seo      = seo_title(trim($_POST['judul']));
  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE artikel SET judul = '$_POST[judul]',
                                  oleh = '$_POST[oleh]',
                                  judul_seo = '$produk_seo',
                                  isi = '$isi'
                             WHERE id_artikel   = '$_POST[id]'");
    header('location:../../media.php?module='.$module);
  }
  else{
	
	$data=mysql_fetch_array(mysql_query("SELECT gambar FROM artikel WHERE id_artikel ='$_POST[id]'"));
	if($data['gambar']!='') {
	
	//hapus foto dari folder
	unlink("../../../joimg/artikel/$data[gambar]");
	unlink("../../../joimg/artikel/s_$data[gambar]");
	
    UploadArtikel($nama_file_unik);
    mysql_query("UPDATE artikel SET judul = '$_POST[judul]',
                                  oleh = '$_POST[oleh]',
                                  judul_seo = '$produk_seo',
                                    isi = '$isi',
                                   gambar      = '$nama_file_unik'   
                             WHERE id_artikel   = '$_POST[id]'");
    header('location:../../media.php?module='.$module);
    }
    else {
		    UploadArtikel($nama_file_unik);
			mysql_query("UPDATE artikel SET judul = '$_POST[judul]',
                                    judul_seo = '$produk_seo',
                                    oleh = '$_POST[oleh]',
                                    isi = '$isi',
                                   gambar      = '$nama_file_unik'   
                             WHERE id_artikel   = '$_POST[id]'");
			header('location:../../media.php?module='.$module);
			}
  }
}



?>
