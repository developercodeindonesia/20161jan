<?php
include "../../../josys/koneksi.php";
include "../../../josys/fungsi_thumb.php";

$module=$_GET[module];
$act=$_GET[act];

// Update keyword
if ($module=='keyword' AND $act=='update'){
  
  
  
    mysql_query("UPDATE modul SET 	static_content 	= '".mysql_real_escape_string($_POST[isi])."'
                            WHERE id_modul  = '$_POST[id]'");
	
	
  header('location:../../media.php?module='.$module);
}



?>