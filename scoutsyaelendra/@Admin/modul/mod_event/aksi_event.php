<?php
session_start();
include "../../../josys/koneksi.php";
include "../../../josys/library.php";
include "../../../josys/fungsi_thumb.php";
include "../../../josys/fungsi_seo.php";

$module=$_GET['module'];
$act=$_GET['act'];

// Hapus produk
if ($module=='event' AND $act=='del'){
  $data=mysql_fetch_array(mysql_query("SELECT gambar FROM event WHERE id_event='$_GET[id]'"));
  if($data['gambar']!='') {
	
	//hapus foto dari folder
	unlink("../../../joimg/event/$_GET[nama_file]");
	unlink("../../../joimg/event/s_$_GET[nama_file]");
	
	mysql_query("DELETE FROM event WHERE id_event='$_GET[id]'");
	header('location:../../media.php?module='.$module);
  
  } 
	else {

	mysql_query("DELETE FROM event WHERE id_event='$_GET[id]'");
	header('location:../../media.php?module='.$module);

	}
 
}

// Input produk
elseif ($module=='event' AND $act=='input')
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
			UploadEvent($nama_file_unik);
			mysql_query("INSERT INTO event(judul,
                                    tanggal, 
                                    judul_seo,
                                    isi,
                                    oleh,
                                    gambar,
                                    aktif) 
                            VALUES('$_POST[judul]',
                                   now(),
                                   '$produk_seo',
                                   '$isi',
                                   '$_POST[oleh]',
                                   '$nama_file_unik',
                                   'Ya')");
            header('location:../../media.php?module='.$module);
        }
}

// Update produk
elseif ($module=='event' AND $act=='update')
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
    mysql_query("UPDATE event SET judul = '$_POST[judul]',
                                  oleh = '$_POST[oleh]',
                                  judul_seo = '$produk_seo',
                                  isi = '$isi'
                             WHERE id_event   = '$_POST[id]'");
    header('location:../../media.php?module='.$module);
  }
  else{
	
	$data=mysql_fetch_array(mysql_query("SELECT gambar FROM event WHERE id_event ='$_POST[id]'"));
	if($data['gambar']!='') {
	
	//hapus foto dari folder
	unlink("../../../joimg/event/$data[gambar]");
	unlink("../../../joimg/event/s_$data[gambar]");
	
    UploadEvent($nama_file_unik);
    mysql_query("UPDATE event SET judul = '$_POST[judul]',
                                  oleh = '$_POST[oleh]',
                                  judul_seo = '$produk_seo',
                                    isi = '$isi',
                                   gambar      = '$nama_file_unik'   
                             WHERE id_event   = '$_POST[id]'");
    header('location:../../media.php?module='.$module);
    }
    else {
		    UploadEvent($nama_file_unik);
			mysql_query("UPDATE event SET judul = '$_POST[judul]',
                                    judul_seo = '$produk_seo',
                                    oleh = '$_POST[oleh]',
                                    isi = '$isi',
                                   gambar      = '$nama_file_unik'   
                             WHERE id_event   = '$_POST[id]'");
			header('location:../../media.php?module='.$module);
			}
  }
}



?>
