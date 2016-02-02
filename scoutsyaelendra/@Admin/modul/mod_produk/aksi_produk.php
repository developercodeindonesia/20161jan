<?php
session_start();
include "../../../josys/koneksi.php";
include "../../../josys/library.php";
include "../../../josys/fungsi_thumb.php";
include "../../../josys/fungsi_seo.php";

$module=$_GET['module'];
$act=$_GET['act'];
$act=$_GET['act'];

// Hapus produk
if ($module=='produk' AND $act=='del'){

  $data=mysql_fetch_array(mysql_query("SELECT gambar FROM produk WHERE id_produk='$_GET[id]'"));
  if($data['gambar']!='') {
	
	//hapus foto dari folder
	unlink("../../../joimg/produk/$data[gambar]");
	unlink("../../../joimg/produk/s_$data[gambar]");
	
	mysql_query("DELETE FROM produk WHERE id_produk='$_GET[id]'");
	header('location:../../media.php?module='.$module);
	//echo "<script>window.history.go(-2);</script>";
  
  } 
	else {

	mysql_query("DELETE FROM produk WHERE id_produk='$_GET[id]'");
	header('location:../../media.php?module='.$module);
//echo "<script>window.history.go(-2);</script>";
	}
 
}

// Input produk
elseif ($module=='produk' AND $act=='input')
{   

  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(000000,999999);
  $nama_file_unik = $acak.$nama_file; 
  $isi=mysql_real_escape_string($_POST['deskripsi']);
  $produk_seo     = seo_title(trim($_POST['nama_produk']));

  // Apabila ada gambar yang diupload
	if(empty($_POST['nama_produk']))
	{
			echo "<script>window.alert('Nama Produk harus diisi!');
            window.location(history.back(-1))</script>";
	}elseif(empty($_POST['id_kategori'])){
			echo "<script>window.alert('Anda Belum mengisi kategori!');
            window.location=('../../media.php?module=produk&act=addBook')</script>";
	}else{
			UploadProduk($nama_file_unik);
			mysql_query("INSERT INTO produk (judul,
                                    judul_seo,
                                    deskripsi,
                                    bestseller,
                                    new_release,
                                    id_kategori,
                                    id_sub_kategori,
                                    harga,
									diskon,
									berat,
									stok,
                                    tgl_update,
                                    gambar) 
                            VALUES('$_POST[nama_produk]',
                                   '$produk_seo',
                                   '$isi
                                   ',
                                   '$_POST[bestseller]',
                                   '$_POST[new_release]',
                                   '$_POST[id_kategori]',
                                   '$_POST[id_sub_kategori]',
                                   '$_POST[harga]',
								   '$_POST[diskon]',
								   '$_POST[berat]',
								   '$_POST[stok]',
                                   now(),
                                   '$nama_file_unik')");
                      
           
		header('location:../../media.php?module='.$module);
			
       }
}

// Update produk
elseif ($module=='produk' AND $act=='update')
{
  
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(000000,999999);
  $nama_file_unik = $acak.$nama_file; 
  $isi=mysql_real_escape_string($_POST['deskripsi']);

  $produk_seo      = seo_title(trim($_POST['nama_produk']));

  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE produk SET judul = '$_POST[nama_produk]',
                                    judul_seo = '$produk_seo',
                                    id_kategori = '$_POST[id_kategori]',
                                    id_sub_kategori = '$_POST[id_sub_kategori]',
                                    bestseller = '$_POST[bestseller]',
                                    new_release = '$_POST[new_release]',
                                    harga = '$_POST[harga]',
									diskon = '$_POST[diskon]',
									berat = '$_POST[berat]',
									stok = '$_POST[stok]',
                                    deskripsi = '$isi',
                                    tgl_update = now()
                             WHERE id_produk   = '$_POST[id]'");
  
    header('location:../../media.php?module='.$module);
	//echo "<script>window.history.go(-2);</script>";
  } else{
	
	$data=mysql_fetch_array(mysql_query("SELECT gambar FROM produk WHERE id_produk ='$_POST[id]'"));
	if($data['gambar']!='') {
	
	//hapus foto dari folder
	unlink("../../../joimg/produk/$data[gambar]");
	unlink("../../../joimg/produk/s_$data[gambar]");
	
    UploadProduk($nama_file_unik);
    mysql_query("UPDATE produk SET judul = '$_POST[nama_produk]',
                                    judul_seo = '$produk_seo',
                                    id_kategori = '$_POST[id_kategori]',
                                    id_sub_kategori = '$_POST[id_sub_kategori]',
                                    bestseller = '$_POST[bestseller]',
                                    new_release = '$_POST[new_release]',
                                    harga = '$_POST[harga]',
									diskon = '$_POST[diskon]',
									berat = '$_POST[berat]',
									stok = '$_POST[stok]',
                                    deskripsi = '$isi',
                                    tgl_update = now(),
                                    gambar    = '$nama_file_unik'   
                             WHERE id_produk   = '$_POST[id]'");
    header('location:../../media.php?module='.$module);
			//echo "<script>window.history.go(-2);</script>";
    }  else {
		  UploadProduk($nama_file_unik);
		mysql_query("UPDATE produk SET judul = '$_POST[nama_produk]',
                                    judul_seo = '$produk_seo',
                                    bestseller = '$_POST[bestseller]',
                                    new_release = '$_POST[new_release]',
                                    id_kategori = '$_POST[id_kategori]',
                                    id_sub_kategori = '$_POST[id_sub_kategori]',
                                    harga = '$_POST[harga]',
									diskon = '$_POST[diskon]',
									berat = '$_POST[berat]',
									stok = '$_POST[stok]',
                                    deskripsi = '$isi',
                                    tgl_update = now(),
                                   gambar      = '$nama_file_unik'   
                             WHERE id_produk   = '$_POST[id]'");
        echo $sql;
                             
                             
			header('location:../../media.php?module='.$module);
			
			//echo "<script>window.history.go(-2);</script>";
	}
  }   
}

//hapus kategori
elseif($module=='produk' AND $act=='hapusCat')
{
	mysql_query("DELETE FROM kategori_produk WHERE id_kategori='$_GET[id]'");

	header('location:../../media.php?module='.$module.'&act=addCat');
}
	
//input kategori
elseif($module=='produk' AND $act=='inputCat')
{ 
	if(empty($_POST['judul']))
  {
	echo "<script>window.alert('Nama KATEGORI harus diisi !!');
            window.location=('../../media.php?module=produk&act=addCat')</script>";
  } else 
	{
		$judul_seo 	= seo_title(trim($_POST['judul']));
		mysql_query("INSERT IGNORE INTO kategori_produk(nama_kategori, kategori_seo, hapus) 
								 VALUES('$_POST[judul]','$judul_seo', 'Ya')");
		header('location:../../media.php?module='.$module.'&act=addCat');
	}
}
	
//update kategori
elseif($module=='produk' AND $act=='updateCat')
{
	
	$judul_seo = seo_title(trim($_POST['judul']));
	mysql_query("UPDATE kategori_produk SET nama_kategori = '$_POST[judul]',
											kategori_seo = '$judul_seo'
											WHERE id_kategori ='$_POST[id]'");
	header('location:../../media.php?module='.$module.'&act=addCat');
}

?>