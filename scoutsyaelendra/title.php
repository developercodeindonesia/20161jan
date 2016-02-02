<?php
$sql = mysql_query("SELECT * FROM modul WHERE id_modul='46'");
$s=mysql_fetch_array($sql);

$default = trim($s['static_content']) ;
echo $default;
?>