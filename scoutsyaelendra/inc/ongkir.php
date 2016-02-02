<?php
require_once "../josys/koneksi.php";
include "../josys/fungsi_rupiah.php";	
	$idk = $_GET['k'];
	$tampil=mysql_query("SELECT * FROM kota WHERE id_kota='$idk'");
	
	while($r=mysql_fetch_array($tampil)){
		$ongkir = format_rupiah($r['ongkos_kirim']);
		echo "<p>Ongkir : Rp. $ongkir/kg</p>";
	}
?>
