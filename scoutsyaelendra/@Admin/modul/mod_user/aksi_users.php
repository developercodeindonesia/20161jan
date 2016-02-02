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

// Input user
if ($module=='user' AND $act=='input'){
  $pass=md5($_POST['password']);
  mysql_query("INSERT INTO admin(username,
                                 password,
                                 nama_lengkap,
                                 email,
                                 no_telp,
                                 level,
                                 id_session) 
	                       VALUES('$_POST[username]',
                                '$pass',
                                '$_POST[nama_lengkap]',
                                '$_POST[email]',
                                '$_POST[no_telp]',
                                'admin',
                                '$pass')");
  header('location:../../media.php?module='.$module);
}

//blokir user
if ($module=='user' AND $act=='blokir'){

	if($_GET['status']=='N')
	{ 
	  mysql_query("UPDATE admin SET blokir = 'Y' WHERE id_session='$_GET[id]'"); 
	  header('location:../../media.php?module='.$module);
	}
	else { 
			mysql_query("UPDATE admin SET blokir = 'N' WHERE id_session='$_GET[id]'"); 
			header('location:../../media.php?module='.$module);
			}

}

// Update user
elseif ($module=='user' AND $act=='update'){
	if($_POST['id']==1){$lvl = "admin"; $blok = "blokir         = '$_POST[blokir]',";}else{$lvl = "pengelola"; $blok = "blokir         = 'N',";}
	
    mysql_query("UPDATE admin SET nama_lengkap   = '$_POST[nama_lengkap]',
                                  username       = '$_POST[username]',
                                  email          = '$_POST[email]',
                                  $blok
                                  no_telp        = '$_POST[no_telp]'  
                           WHERE  id		     = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}


elseif ($module=='user' AND $act=='updatepswd'){
    $r=mysql_fetch_array(mysql_query("SELECT * FROM admin WHERE id='$_POST[id]'"));
	$pswd_lama = md5($_POST['pswd_lama']);
	
	if($pswd_lama!=$r['password']){
		echo "<script>window.alert('Password Lama Anda Salah!');
		window.location(history.back(-1))</script>";
	}elseif($_POST['pswd_baru']!=$_POST['pswd_baru_ulang']){
		echo "<script>window.alert('Password Baru dan Ulangi Password Baru Tidak Sama!');
		window.location(history.back(-1))</script>";
	}else{
		$pswd_baru = md5($_POST['pswd_baru']);
		
		mysql_query("UPDATE admin SET password = '$pswd_baru' WHERE  id = '$_POST[id]'");
		
		echo "<script>alert('Password Berhasil Diubah'); window.location = '../../media.php?module=user'</script>";
	}
	
}
if($module=='user' AND $act=='hapus'){
  mysql_query("DELETE FROM admin WHERE id_session='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}
}
?>
