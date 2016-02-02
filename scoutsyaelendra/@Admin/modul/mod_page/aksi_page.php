<?php
session_start();
 if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../josys/koneksi.php";
include "../../../josys/library.php";
include "../../../josys/fungsi_thumb.php";

$module=$_GET['module'];
$act=$_GET['act'];

// Hapus halaman statis
if ($module=='page' AND $act=='hapus'){
  $data=mysql_fetch_array(mysql_query("SELECT gambar FROM mod_page WHERE id_page='$_GET[id]'"));
  if ($data['gambar']!=''){
     mysql_query("DELETE FROM mod_page WHERE id_page='$_GET[id]'");
  }
  else{
     mysql_query("DELETE FROM mod_page WHERE id_page='$_GET[id]'");
  }
  header('location:../../media.php?module='.$module);
}

// Input halaman statis
elseif ($module=='page' AND $act=='input'){
  $isi=mysql_real_escape_string($_POST[isi_halaman]);

    mysql_query("INSERT INTO mod_page(judul,
                                    isi,
                                    tgl_posting) 
                            VALUES('$_POST[judul]',
                                   '$isi',
                                   '$tgl_sekarang')");
	header('location:../../media.php?module='.$module);
}

// Update halaman statis
elseif ($module=='page' AND $act=='update'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file   = $_FILES['fupload']['name'];
  $pagekat = $_POST['pageKat'];
  $isi=mysql_real_escape_string($_POST[isi_halaman]);
  
  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE mod_page SET judul  = '$_POST[judul]', 
                                          isi = '$isi'
                                    WHERE id_page  = '$_POST[id]'");
	if ($_POST['id']=='1'){
		header('location:../../media.php?module=home');
	}
		else {
			header('location:../../media.php?module=page&act=edit&id='.$_POST[id]);
		}
  }
  else{
		UploadImagePage($nama_file);
		mysql_query("UPDATE mod_page SET judul  = '$_POST[judul]',
											  isi = '$isi',
											  gambar      = '$nama_file'   
										WHERE id_page  = '$_POST[id]'");
										
		if ($_POST['id']=='1'){
				header('location:../../media.php?module=home');
			}
				else {
					header('location:../../media.php?module=page&act=edit&id='.$_POST[id]);
				}
	  }

}



}//end if-else
?>
