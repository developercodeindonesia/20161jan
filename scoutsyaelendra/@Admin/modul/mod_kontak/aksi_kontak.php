<?php
session_start();
 if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
 echo "<script>window.alert('Untuk mengakses modul anda harus login!');window.location=('../../index.php');</script>";
}
else{
include "../../../josys/koneksi.php";
include "../../../josys/fungsi_seo.php";

$module=$_GET['module'];
$act=$_GET['act'];

//update status baca
if($module=='hubungi' AND $act=='baca'){
	
	$idpesan = $_GET['id'];
	$status	 = $_GET['status'];
	
	if($status=='0') 
	{ 
		$statusNow = '1'; 
		mysql_query("UPDATE hubungi SET status_baca='$statusNow' WHERE id='$idpesan' ");
		echo "<script>window.location=('../../media.php?module=hubungi&act=detail&id={$idpesan}');</script>";
	} else { 
		$statusNow = '0'; 
		mysql_query("UPDATE hubungi SET status_baca='$statusNow' WHERE id='$idpesan' ");
		echo "<script>window.location=('../../media.php?module=hubungi&act=detail&id={$idpesan}');</script>";
	}
}

//update konten kontak
if($module=='hubungi' AND $act=='updateK'){
	$isi 	= $_POST['deskripsi'];
	$id		= $_POST['id'];
	mysql_query("UPDATE mod_page SET isi = '$isi',
									gambar= '$_POST[peta]'
									 WHERE id_page  = '$id'");
	header('location:../../media.php?module='.$module);
}

if($module=='hubungi' AND $act=='hapus'){
	mysql_query("DELETE FROM hubungi WHERE id='$_GET[id]'");
	header('location:../../media.php?module='.$module);
}


}
?>
