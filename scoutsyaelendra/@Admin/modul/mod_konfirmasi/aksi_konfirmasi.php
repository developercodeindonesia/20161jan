<?php
include "../../../josys/koneksi.php";

$module=$_GET['module'];
$act=$_GET['act'];

if ($module=='konfirmasi' AND $act=='del'){
  mysql_query("DELETE FROM mod_konfirmasi WHERE id='$_GET[id]'"); 
  header('location:../../media.php?module='.$module);
 }
?>



