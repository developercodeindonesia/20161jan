<?php
	$sql=mysql_query("SELECT * FROM mod_page WHERE id_page = '9' ");
	$s=mysql_fetch_array($sql);
	$cek = mysql_num_rows($sql);

	echo $s['isi']; 
?>