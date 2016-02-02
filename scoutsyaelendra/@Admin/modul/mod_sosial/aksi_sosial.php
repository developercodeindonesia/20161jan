<?php
include "../../../josys/koneksi.php";
include "../../../josys/library.php";
include "../../../josys/fungsi_thumb.php";

$module=$_GET['module'];
$act=$_GET['act'];

// Hapus 
if ($module='sosmed' AND $act=='hapus'){
  mysql_query("DELETE FROM mod_sosial WHERE id='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input
elseif ($module='sosmed' AND $act=='input'){

	if(empty($_POST['judul']))
	{
			echo"<script>window.alert('Ups! Judul masih kosong');
				window.location=('../../media.php?module=sosmed&act=tambahsosial')</script>";
	}
	else
	{	
			$lokasi_file = $_FILES['fupload']['tmp_name'];
			$nama_file   = $_FILES['fupload']['name'];
			$tipe_file   = $_FILES['fupload']['type'];
			
			$acak           = rand(000000,999999);
			$nama_file_unik = $acak.$nama_file; 
			
			$fileName	= preg_replace('#[^a-z.0-9]#i', '', $nama_file);
			$splitName	= explode(".", $fileName);
			$fileExt	= end($splitName);
			
			$judul 	= $_POST['judul'];
			$url	= $_POST['url'];
			
			//jika tidak ada file yang diupload
			if(empty($lokasi_file))
			{
				echo "<script>window.alert('Ups! gambar masih kosong');
				window.location=('../../media.php?module=sosmed&act=tambahsosial')</script>";
			}
			
			//jika ada foto yang diupload, tipe file harus jpeg atau png
			else if(!preg_match("/.(jpg|png)$/i", $fileName))
			{
				echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG atau *.PNG');
					window.location=('../../media.php?module=sosmed&act=tambahsosial')</script>";
				unlink ($lokasi_file);
				exit();
			}
			
			//jika semua kondisi terpenuhi, upload data
			UploadSosial($nama_file_unik);
			mysql_query("INSERT INTO mod_sosial (nama, link, gambar) 
											VALUES 	('$judul', '$url', '$nama_file_unik')");
												 
			echo "<script>window.alert('Data terkirim ke database. $_POST[judul] | $nama_file_unik');
			window.location=('../../media.php?module=sosmed')</script>";
		
	}
}

// Update 
elseif ($module='sosmed' AND $act=='update')
{
  
	$lokasi_file = $_FILES['fupload']['tmp_name'];
	$nama_file   = $_FILES['fupload']['name'];
	$acak           = rand(000000,999999);
	$nama_file_unik = $acak.$nama_file; 
	
	$fileName	= preg_replace('#[^a-z.0-9]#i', '', $nama_file);
	$splitName	= explode(".", $fileName);
	$fileExt	= end($splitName);
				
	$judul 	= $_POST['judul'];
	$url	= $_POST['url'];
	$idsosial = $_POST['idsosial'];
  
    // Apabila gambar tidak diganti
	if (empty($lokasi_file))
	{
	
		mysql_query("UPDATE mod_sosial SET nama   = '$judul',
									   link   = '$url'  
								 WHERE id     = '$idsosial'");
		echo "<script>window.alert('Data telah diupdate.');window.location=('../../media.php?module=sosmed&act=editsosial&id={$idsosial}');</script>";
	}
	//jika gambar diganti
	else 
	{
	//jika ada foto yang diupload, tipe file harus jpeg atau png
		if(!preg_match("/.(jpg|png)$/i", $fileName))
		{
			echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG atau *.PNG');window.location=('../../media.php?module=sosmed&act=tambahsosial')</script>";
			unlink ($lokasi_file);
			exit();
		}
		else 
		{
			//cek gambar di database
			$data=mysql_fetch_array(mysql_query("SELECT gambar FROM sosial WHERE id='$idsosial'"));
			if ($data['gambar'] !='')
			{
			//hapus gambar dari database 
				mysql_query("DELETE gambar FROM mod_sosial WHERE id='$idsosial'");
			//hapus gambar dari folder 	
				unlink("../../../joimg/{$data[gambar]}");   
			}
			
			//jika semua kondisi terpenuhi, upload data
				UploadSosial($nama_file_unik);
				mysql_query("UPDATE mod_sosial SET 	   nama  			 = '$judul',
												   link 			 = '$url',  
												   gambar		     = '$nama_file_unik'   
												   WHERE id    = '$idsosial'");
												   
				echo "<script>window.alert('Data terkirim ke database. $_POST[judul] | $nama_file_unik');
				window.location=('../../media.php?module=sosmed')</script>";
		}
	}
}
?>
