<?php error_reporting(E_PARSE); 
	?><?php
// Bagian Home
if ($_GET['module']=='home'){
  if ($_SESSION['leveladmin']=='admin'){
	echo "<div class='box-header clear'>
        <p>Hai <b>$_SESSION[namalengkapadmin]</b>, selamat datang di halaman Administrator.<br />
        Anda bisa mengisi pesan selamat datang di home melalui teks area di bawah ini, jangan lupa klik tombol update untuk menyimpan konten pesan.<br />
        Gunakan menu di sidebar kiri anda untuk mengelola konten website, atau anda bisa mulai dengan membaca info singkat penggunaan <b>modul <a href='?module=modul'>disini</a></b>  </p><p><a href='Panduan Administrator Website tokorohanionline.doc' target='_blank'>Download Panduan Website</a></p><hr /></div>";
	echo "<div class='box-body clear'>";
	include "modul/beranda/index.php";
  echo " </div>";
  }
  elseif ($_SESSION['leveladmin']=='user'){
  echo "<div class='box-header clear'>
		<h2>Selamat Datang</h2>
		</div>
		<div class='box-body clear'>
          <p>Hai <b>$_SESSION[namalengkapadmin]</b>, selamat datang di halaman Administrator<br> 
          Silahkan klik menu pilihan yang berada di sebelah kiri untuk mengelola website. </p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>


          <p align=right>Login : $hari_ini, ";
  echo tgl_indo(date("Y m d")); 
  echo " | "; 
  echo date("H:i:s");
  echo " WIB</p>";
  echo "</div>";
 	}
}

//home-slideshow
elseif($_GET['module']=='slider'){
	if($_SESSION['leveladmin']=='admin')
	{
		include "modul/mod_slider/slider.php";
	}
}

//home-member
elseif($_GET['module']=='member'){
		include "modul/mod_member/member.php";
}

//home-slideshow
elseif($_GET['module']=='slider2'){
	if($_SESSION['leveladmin']=='admin')
	{
		include "modul/mod_slider2/slider2.php";
	}
}
//promo2
elseif($_GET['module']=='promo2'){
	if($_SESSION['leveladmin']=='admin')
	{
		include "modul/mod_promo2/promo2.php";
	}
}
//promo
elseif($_GET['module']=='promo'){
	if($_SESSION['leveladmin']=='admin')
	{
		include "modul/mod_promo/promo.php";
	}
}

//main menu
elseif($_GET['module']=='menu'){
	if($_SESSION['leveladmin']=='admin')
	{
		include "modul/mod_menu/menu.php";
	}
}

//user
elseif($_GET['module']=='user'){
	if($_SESSION['leveladmin']=='admin')
	{
		include "modul/mod_user/users.php";
	}
}

elseif($_GET['module']=='resensi'){
	if($_SESSION['leveladmin']=='admin')
	{
		include "modul/mod_resensi/resensi.php";
	}
}

//mod banner
elseif($_GET['module']=='banner'){
	if($_SESSION['leveladmin']=='admin')
	{
		include "modul/mod_banner/banner.php";
	}
}

elseif($_GET['module']=='banner2'){
	if($_SESSION['leveladmin']=='admin')
	{
		include "modul/mod_banner2/banner2.php";
	}
}


//mod ym chat
elseif($_GET['module']=='ym'){
	if($_SESSION['leveladmin']=='admin')
	{
		include "modul/mod_ym/ym.php";
	}
}

//halaman
elseif($_GET['module']=='page'){
	if($_SESSION['leveladmin']=='admin')
	{
		include "modul/mod_page/page.php";
	}
}

elseif($_GET['module']=='profil'){
	if($_SESSION['leveladmin']=='admin')
	{
		include "modul/mod_profil/profil.php";
	}
}

elseif($_GET['module']=='propinsi'){
	if($_SESSION['leveladmin']=='admin')
	{
		include "modul/mod_propinsi/propinsi.php";
	}
}

elseif($_GET['module']=='konfirmasi'){
	if($_SESSION['leveladmin']=='admin')
	{
		include "modul/mod_konfirmasi/konfirmasi.php";
	}
}

//modul
elseif($_GET['module']=='modul'){
	if($_SESSION['leveladmin']=='admin')
	{
		include "modul/mod_modul/modul.php";
	}
}

//mod hubungi
elseif($_GET['module']=='hubungi'){
	if($_SESSION['leveladmin']=='admin')
	{
		include "modul/mod_kontak/kontak.php";
	}
}

//mod produk
elseif($_GET['module']=='produk')
{
	if($_SESSION['leveladmin']=='admin')
	{
		include "modul/mod_produk/produk.php";
	}
}

elseif($_GET['module']=='event')
{
	if($_SESSION['leveladmin']=='admin')
	{
		include "modul/mod_event/event.php";
	}
}

elseif($_GET['module']=='gallery')
{
	if($_SESSION['leveladmin']=='admin')
	{
		include "modul/mod_gallery/gallery.php";
	}
}

//mod author
elseif($_GET['module']=='author')
{
	if($_SESSION['leveladmin']=='admin')
	{
		include "modul/mod_author/author.php";
	}
}


//mod testi
elseif($_GET['module']=='testi')
{
	if($_SESSION['leveladmin']=='admin')
	{
		include "modul/mod_testi/testi.php";
	}
}

//mod download
elseif($_GET['module']=='download')
{
	if($_SESSION['leveladmin']=='admin')
	{
		include "modul/mod_download/download.php";
	}
}

//mod bank
elseif($_GET['module']=='bank')
{
	if($_SESSION['leveladmin']=='admin')
	{
		include "modul/mod_bank/bank.php";
	}
}

//mod subkategori
elseif($_GET['module']=='subkategori')
{
	if($_SESSION['leveladmin']=='admin')
	{
		include "modul/mod_subkategori/subkategori.php";
	}
}

//mod order
elseif($_GET['module']=='order')
{
	if($_SESSION['leveladmin']=='admin')
	{
		include "modul/mod_order/order.php";
	}
}

//mod preorder
elseif($_GET['module']=='preorder')
{
	if($_SESSION['leveladmin']=='admin')
	{
		include "modul/mod_preorder/preorder.php";
	}
}

//mod kurir
elseif($_GET['module']=='kurir')
{
	if($_SESSION['leveladmin']=='admin')
	{
		include "modul/mod_kurir/kurir.php";
	}
}

// Bagian Kota/Ongkos Kirim
elseif ($_GET['module']=='ongkoskirim'){
  if ($_SESSION['leveladmin']=='admin'){
    include "modul/mod_ongkoskirim/ongkoskirim.php";
  }
}

// Bagian Kota/Ongkos Kirim
elseif ($_GET['module']=='member'){
  if ($_SESSION['leveladmin']=='admin'){
    include "modul/mod_member/member.php";
  }
}

//sosial media
elseif($_GET['module']=='sosmed'){
	if($_SESSION['leveladmin']=='admin')
	{
		include "modul/mod_sosial/sosial.php";
	}
}


//artikel
elseif($_GET['module']=='artikel'){
	if($_SESSION['leveladmin']=='admin')
	{
		include "modul/mod_artikel/artikel.php";
	}
}

//sosial media
elseif($_GET['module']=='title'){
	if($_SESSION['leveladmin']=='admin')
	{
		include "modul/mod_title/title.php";
	}
}

//sosial media
elseif($_GET['module']=='description'){
	if($_SESSION['leveladmin']=='admin')
	{
		include "modul/mod_description/description.php";
	}
}

//sosial media
elseif($_GET['module']=='keyword'){
	if($_SESSION['leveladmin']=='admin')
	{
		include "modul/mod_keyword/keyword.php";
	}
}
// Apabila modul tidak ditemukan
else{
  echo "<p><b>not found!</b></p>";
}
?>