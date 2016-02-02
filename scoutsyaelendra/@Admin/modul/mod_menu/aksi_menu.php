<?php
session_start();
 if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../josys/koneksi.php";
include "../../../josys/fungsi_seo.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus komentar
if ($module=='menu' AND $act=='hapus'){
  mysql_query("DELETE FROM mainmenu WHERE id_main='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}
// Input menu utama
if ($module=='menu' AND $act=='input'){
  mysql_query("INSERT INTO mainmenu(nama_menu,link,urutan) VALUES('$_POST[nama_menu]','$_POST[link]','$_POST[urutan]')");
  header('location:../../media.php?module='.$module);
}

// Update menu utama
elseif ($module=='menu' AND $act=='update'){
  mysql_query("UPDATE mainmenu SET nama_menu='$_POST[nama_menu]', id_parent='$_POST[parent]', link='$_POST[link]', aktif='$_POST[aktif]',
				urutan='$_POST[urutan]'
               WHERE id_main = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
}
?>
