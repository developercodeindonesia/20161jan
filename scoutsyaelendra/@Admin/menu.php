<li><a href='?module=home'><b>home</b></a></li>
<li><a href='media.php?module=page'><b>Page</b></a></li>
<li><a href='media.php?module=hubungi'><b>Hubungi</b></a></li>
<li><a href='?module=artikel'><b>Artikel</b></a></li>
<li><a href='?module=event'><b>Event</b></a></li>
<li><a href='?module=gallery'><b>Gallery</b></a></li>
<li><a href='media.php?module=produk'><b>Produk</b></a></li>
<li><a href='media.php?module=produk&act=addCat'><b>Kategori Produk</b></a></li>
<li><a href='media.php?module=subkategori'><b>Sub Kategori Produk</b></a></li>
<?php  
//menu          
$sql=mysql_query("SELECT * FROM modul WHERE aktif='Y' AND menu='utama' ORDER BY id_modul ASC");
	while($s=mysql_fetch_array($sql))
	{  
		echo "<li><a href='$s[link]'><b>$s[nama_modul]</b></a></li>";
	}	
		
	echo "</li>";
