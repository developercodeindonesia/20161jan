
<li><a href='media.php?module=order'><b>Order</b></a></li>
<li><a href='media.php?module=konfirmasi'><b>Konfirmasi</b></a></li>
<!--<li><a href='media.php?module=member'><b>Member</b></a></li> -->
<?php  
//menu          
$sql=mysql_query("SELECT * FROM modul WHERE aktif='Y' AND menu='modul' ORDER BY nama_modul ASC");
	while($s=mysql_fetch_array($sql))
	{  
		echo "<li><a href='$s[link]'><b>$s[nama_modul]</b></a></li>";
	}	
	echo "</li>";