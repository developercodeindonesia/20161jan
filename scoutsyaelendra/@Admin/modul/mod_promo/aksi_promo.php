<?php
session_start();
include "../../../josys/koneksi.php";
include "../../../josys/library.php";

$module=$_GET['module'];
$act=$_GET['act'];

// Hapus produk
if ($module=='promo' AND $act=='del'){
	mysql_query("DELETE FROM promo WHERE id_promo='$_GET[id]'");
	header('location:../../media.php?module='.$module);
}

// Input produk
elseif ($module=='promo' AND $act=='input')
{  
	mysql_query("INSERT INTO promo(nama,
							alamat,
							noidentitas,
							no_telpon,
							judul_buku,
							nama_toko,
							no_struk,
							publish,
							tanggal) 
					VALUES('$_POST[nama]',
						   '$_POST[alamat]',
						   '$_POST[noidentitas]',
						   '$_POST[no_telpon]',
						   '$_POST[judul_buku]',
						   '$_POST[nama_toko]',
						   '$_POST[no_struk]',
						   '$_POST[publish]',
						   '$isi',
						   now() )");
	header('location:../../media.php?module='.$module);
}

// Update produk
elseif ($module=='promo' AND $act=='update')
{
    mysql_query("UPDATE promo SET nama = '$_POST[nama]',
                                    alamat = '$_POST[alamat]',
                                    noidentitas = '$_POST[noidentitas]',
                                    no_telpon = '$_POST[no_telpon]',
                                    judul_buku = '$_POST[judul_buku]',
									nama_toko = '$_POST[nama_toko]',
									no_struk = '$_POST[no_struk]',
									publish = '$_POST[publish]'
                             WHERE id_promo   = '$_POST[id]'");
    echo "UPDATE promo SET nama = '$_POST[nama]',
                                    alamat = '$_POST[alamat]',
                                    noidentitas = '$_POST[noidentitas]',
                                    no_telpon = '$_POST[no_telpon]',
                                    judul_buku = '$_POST[judul_buku]',
									nama_toko = '$_POST[nama_toko]',
									no_struk = '$_POST[no_struk]',
									publish = '$_POST[publish]'
                             WHERE id_promo   = '$_POST[id]'";
	//header('location:../../media.php?module='.$module);
  
}

?>
