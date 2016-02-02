<?php
require_once('josys/koneksi.php');
$sql = mysql_query("SELECT * FROM modul WHERE id_modul='47'");
$s=mysql_fetch_array($sql);

$default = trim($s['static_content']) ;
echo "$default";
?>