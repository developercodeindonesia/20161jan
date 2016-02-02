<?php
$q = strtolower($_GET['q']);
if (!$q) return;

	$sql=mysql_query("SELECT * FROM kategori WHERE nama_kategori like '%$q%'");
	while($s=mysql_fetch_array($sql))
	{
		$list_kat = $s['nama_kategori'];
		echo "$list_kat \n";
	}
?>