<?php

session_start();
include "../../../josys/koneksi.php";

$module=$_GET['module'];
$act=$_GET['act'];

if ($module=='preorder' AND $act=='hapus'){
  mysql_query("DELETE FROM preorders WHERE id_preorder='$_GET[id]'"); 
  header('location:../../media.php?module='.$module);
 }
elseif ($module=='preorder' AND $act=='update'){
   // Update stok barang saat transaksi sukses (Lunas)
   if ($_POST['status_order']=='Lunas/Terkirim'){ 
    
      // Update status order
      mysql_query("UPDATE preorders SET status_order='$_POST[status_order]' where id_preorder='$_POST[id]'");
      header('location:../../media.php?module='.$module);
      }	  
	  elseif($_POST['status_order']=='Batal'){
	  
      // Update status order
      mysql_query("UPDATE preorders SET status_order='$_POST[status_order]' where id_preorder='$_POST[id]'");	  
	  header('location:../../media.php?module='.$module);
	  }
 else{
     mysql_query("UPDATE preorders SET status_order='$_POST[status_order]' where id_preorder='$_POST[id]'");
     header('location:../../media.php?module='.$module);
     }
}
?>


