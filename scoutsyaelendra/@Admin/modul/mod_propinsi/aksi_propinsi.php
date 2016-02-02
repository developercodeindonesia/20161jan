<?php
include "../../../josys/koneksi.php";
include "../../../josys/fungsi_seo.php";
include "../../../josys/fungsi_input.php";

$module=$_GET['module'];
$act=$_GET['act'];

// Hapus
if ($module=='propinsi' AND $act=='del'){
  mysql_query("DELETE FROM propinsi WHERE id='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input
elseif ($module=='propinsi' AND $act=='input'){
  $prop = cleanInput($_POST['propinsi']);
  $prop_seo = seo_title($prop);
  mysql_query("INSERT INTO propinsi(propinsi,propinsi_seo) VALUES('$prop','$prop_seo')");
  header('location:../../media.php?module='.$module);
}

// Update
elseif ($module=='propinsi' AND $act=='update'){
  $id = $_POST['id'];
  $prop 	= $_POST['propinsi'];
  $prop_seo = seo_title($prop);
  mysql_query("UPDATE propinsi SET propinsi = '$prop', propinsi_seo = '$prop_seo' WHERE id = '$id'");
  header('location:../../media.php?module='.$module);
}
?>
