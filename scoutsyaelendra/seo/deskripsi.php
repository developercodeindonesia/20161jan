<?php
$sql=mysql_query("SELECT * FROM mod_page WHERE id_page = '10' ");
$s=mysql_fetch_array($sql);

$default = trim($s['isi']) ;
		
		if($_GET['module']=='home')
	{
		echo "$default";
	}
	
	else if($_GET['module']=='detailproduk')
	{
		$sql = mysql_query("select * from produk where id_produk='$_GET[id]'");
		$j   = mysql_fetch_array($sql);
		echo "$j[isi]".$default;
	}
	
	else if($_GET['module']=='detailartikel')
	{
		$sql = mysql_query("select * from berita where id_berita='$_GET[id]'");
		$j   = mysql_fetch_array($sql);
		echo "$j[isi_berita]".$default;
	}
	
	else {
	
		echo "$default";
	}
		
?>