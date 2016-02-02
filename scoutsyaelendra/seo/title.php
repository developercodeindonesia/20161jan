<?php

$sql=mysql_query("SELECT * FROM mod_page WHERE id_page = '8' ");
$s=mysql_fetch_array($sql);

$default = trim($s['isi']) ;


	if($_GET['module']=='home')
	{
		echo "$default";
	}
	
	else if($_GET['module']=='profil')
	{
		echo "Profil | $default";
	}
	
	else if($_GET['module']=='privacy')
	{
		echo "Privacy & Policy | $default";
	}
	
	else if($_GET['module']=='allProduk')
	{
		echo "Produk | $default";
	}
	
	else if($_GET['module']=='detailProduk')
	{
		$edit=mysql_query("SELECT * FROM mod_news WHERE id_news='$_GET[id]' ");
		$r=mysql_fetch_array($edit);
		
		echo "$r[judul] | $default";
	}
	
	else if($_GET['module']=='allGallery')
	{
		echo "Gallery | $default";
	}
	
	else if($_GET['module']=='detailGallery')
	{
		$kat=mysql_query("SELECT * FROM album WHERE id_album = '$_GET[id]'");
		$k=mysql_fetch_array($kat);
		
		echo "Gallery $k[judul] | $default";
	}
	
	
	else {
	
		echo "$default";
	}

?>
