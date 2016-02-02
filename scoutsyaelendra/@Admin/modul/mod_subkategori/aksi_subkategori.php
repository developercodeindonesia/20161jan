<?php
session_start();
include "../../../josys/koneksi.php";
include "../../../josys/library.php";
include "../../../josys/fungsi_thumb.php";
include "../../../josys/fungsi_seo.php";

$module=$_GET['module'];
$act=$_GET['act'];
$act=$_GET['act'];


if($module=='subkategori' AND $act=='del')
{
	mysql_query("DELETE FROM sub_kategori WHERE id_sub_kategori='$_GET[id]'");

	header('location:../../media.php?module='.$module);
}
	

elseif($module=='subkategori' AND $act=='input')
{ 
	if(empty($_POST['nama']))
  {
	echo "<script>window.alert('Nama Kategori harus diisi !!');
            window.location=('../../media.php?module=subkategori')</script>";
  } else 
	{
		$judul_seo 	= seo_title(trim($_POST['nama']));
		mysql_query("INSERT INTO sub_kategori(id_kategori, nama, nama_seo, status) 
								 VALUES('$_POST[id_kategori]','$_POST[nama]','$judul_seo','$_POST[status]')");
		
		header('location:../../media.php?module='.$module);
	}
}
	
elseif($module=='subkategori' AND $act=='update')
{
	
	$judul_seo = seo_title(trim($_POST['nama']));
	mysql_query("UPDATE sub_kategori SET nama = '$_POST[nama]',
											id_kategori = '$_POST[id_kategori]',
											nama_seo = '$judul_seo'
											WHERE id_sub_kategori ='$_POST[id]'");
											
	header('location:../../media.php?module='.$module);
}

?>