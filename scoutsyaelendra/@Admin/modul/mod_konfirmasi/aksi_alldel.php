<?php
session_start();
include "../../../josys/koneksi.php";


$cek=$_POST['cek'];
$jumlah=count($cek);
    
  for($i=0;$i<$jumlah;$i++){
  mysql_query("DELETE FROM mod_konfirmasi WHERE id='$cek[$i]'");
  }
  header('location:../../media.php?module=konfirmasi');
?>
