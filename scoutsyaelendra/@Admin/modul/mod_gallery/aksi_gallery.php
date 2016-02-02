<?php
session_start();
include "../../../josys/koneksi.php";
include "../../../josys/library.php";
include "../../../josys/fungsi_thumb.php";
include "../../../josys/fungsi_seo.php";

$module=$_GET['module'];
$act=$_GET['act'];

// Hapus produk
if ($module=='gallery' AND $act=='del'){
  $data=mysql_fetch_array(mysql_query("SELECT gambar FROM event WHERE id_gallery='$_GET[id]'"));
  if($data['gambar']!='') {
	
	//hapus foto dari folder
	unlink("../../../joimg/gallery/$_GET[nama_file]");
	unlink("../../../joimg/gallery/s_$_GET[nama_file]");
	
	mysql_query("DELETE FROM gallery WHERE id_gallery='$_GET[id]'");
	header('location:../../media.php?module='.$module);
  
  } 
	else {

	mysql_query("DELETE FROM gallery WHERE id_gallery='$_GET[id]'");
	header('location:../../media.php?module='.$module);

	}
 
}

// Input produk
elseif ($module=='gallery' AND $act=='input')
{
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 
 // $isi=mysql_real_escape_string($_POST['deskripsi']);
  
  //$produk_seo      = seo_title(trim($_POST['judul']));
  // Apabila ada gambar yang diupload
	if(empty($_POST['judul']))
	{
			echo "<script>window.alert('Judul harus diisi');
            window.location(history.back(-1))</script>";
	}
	  
		else 
		{
			UploadGallery($nama_file_unik);  //nganggo nfunction cateak broooww
			mysql_query("INSERT INTO gallery
            
                            VALUES('','$_POST[judul]',
                                   '$nama_file_unik',
                                   now())");
            header('location:../../media.php?module='.$module);
        }
}

// Update produk
elseif ($module=='gallery' AND $act=='update')
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
    mysql_query("UPDATE gallery SET judul = '$_POST[judul]'
                                      WHERE id_gallery   = '$_POST[id]'");
    header('location:../../media.php?module='.$module);
  }
  else{
	
	$data=mysql_fetch_array(mysql_query("SELECT gambar FROM gallery WHERE id_gallery ='$_POST[id]'"));
	if($data['gambar']!='') {
	
	//hapus foto dari folder
	unlink("../../../joimg/gallery/$data[gambar]");
	unlink("../../../joimg/gallery/s_$data[gambar]");
	
    UploadGallery($nama_file_unik);
    mysql_query("UPDATE gallery SET judul = '$_POST[judul]',
                                   gambar      = '$nama_file_unik'   
                             WHERE id_gallery   = '$_POST[id]'");
    header('location:../../media.php?module='.$module);
    }
    else {
		    UploadGallery($nama_file_unik);
			mysql_query("UPDATE gallery SET judul = '$_POST[judul]',
                                   gambar      = '$nama_file_unik'   
                             WHERE id_gallery   = '$_POST[id]'");
			header('location:../../media.php?module='.$module);
			}
  }
}



?>
