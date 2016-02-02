<?php
session_start();
 if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../josys/koneksi.php";

$module=$_GET['module'];
$act=$_GET['act'];

// Input member
if ($module=='member' AND $act=='input'){
  mysql_query("INSERT INTO users(username,
                                 nama_lengkap,
                                 email, 
                                 no_telp
                                 ) 
	                       VALUES('$_POST[username]',
                                '$_POST[nama_lengkap]',
                                '$_POST[email]',
                                '$_POST[no_telp]')");
  header('location:../../media.php?module='.$module);
}

//blokir member
if ($module=='member' AND $act=='blokir'){

	if($_GET['status']=='N')
	{ 
	  mysql_query("UPDATE users SET blokir = 'Y' WHERE username='$_GET[id]'"); 
	  header('location:../../media.php?module='.$module);
	}
	else { 
			mysql_query("UPDATE users SET blokir = 'N' WHERE username='$_GET[id]'"); 
			header('location:../../media.php?module='.$module);
			}

}

// Update member
elseif ($module=='member' AND $act=='update'){
    mysql_query("UPDATE users SET 
                                 nama_lengkap    = '$_POST[nama_lengkap]',
                                 email           = '$_POST[email]',  
                                 blokir          = '$_POST[blokir]',  
                                 no_telp         = '$_POST[no_telp]'  
                           WHERE username      = '$_POST[id]'");
	
	header('location:../../media.php?module='.$module);
}
if($module=='member' AND $act=='hapus'){
  mysql_query("DELETE FROM users WHERE username='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}
}
?>
