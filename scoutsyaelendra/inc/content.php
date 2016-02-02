<?php 
if($_GET['module']=='home') { 
	include("inc/home.php");
 }

elseif($_GET['module']=='testimonial') {
	include("inc/testimonial.php"); 
}

elseif($_GET['module']=='event') {
    include ('inc/sidebar.php');
	include("inc/event.php"); 
}

elseif($_GET['module']=='detail-event') {
    include ('inc/sidebar.php');
	include("inc/detail-event.php"); 
}

elseif($_GET['module']=='kontak') {
	include("inc/kontak.php"); 
}

elseif($_GET['module']=='gallery') {
	include("inc/gallery.php"); 
}

elseif($_GET['module']=='allProduk') {
	include("inc/produk_all.php"); 
}

elseif($_GET['module']=='detailproduk') {
	include ('inc/sidebar.php');
	include("inc/detailproduk.php"); 
}

elseif($_GET['module']=='kategori') {
	include("inc/kategori.php"); 
}

elseif($_GET['module']=='sub-kategori') {
	include("inc/sub-kategori.php"); 
}

elseif($_GET['module']=='download') {
	include ('inc/sidebar.php');
	include("inc/download.php"); 
}

elseif($_GET['module']=='artikel') {
	include ('inc/sidebar.php');
	include("inc/artikel.php"); 
}

elseif($_GET['module']=='detail-artikel') {
	include ('inc/sidebar.php');
	include("inc/detail-artikel.php"); 
}

elseif($_GET['module']=='staticcontent') {
	include ('inc/sidebar.php');
	include("inc/staticcontent.php"); 
}

elseif($_GET['module']=='promosi') {
	include("inc/promosi.php"); 
}

elseif($_GET['module']=='login') {
	include("inc/login.php"); 
}

elseif($_GET['module']=='prosesReg') {
	//validasi
	$nama 			= trim($_POST['username']);
	$password  		= md5($_POST['password']);
	$nama_lengkap 	= trim($_POST['nama_lengkap']);
	$email 			= trim($_POST['email']);
	$telp			= trim($_POST['no_telp']);
	
	$kar1=strstr($_POST['email'], "@");
	$kar2=strstr($_POST['email'], ".");

	if (empty($nama) || empty($password) || empty($nama_lengkap) || empty($email) || empty($telp)){
	  echo "<script>window.alert('Data yang Anda isikan belum lengkap');window.location=('javascript:history.go(-1)');</script>";
	
	}
	elseif (!ereg("[a-z|A-Z]","$_POST[nama_lengkap]")){
	  echo "<script>window.alert('Nama tidak boleh berupa simbol atau angka');window.location=('javascript:history.go(-1)');</script>";
	}
	elseif (!ereg("[0-9]","$_POST[no_telp]")){
	  echo "<script>window.alert('Telpon tidak boleh berupa huruf');window.location=('javascript:history.go(-1)');</script>";
	}
	elseif (strlen($kar1)==0 OR strlen($kar2)==0){
	  echo "<script>window.alert('Format email tidak valid');window.location=('javascript:history.go(-1)');</script>";
	}
	else{
	
		function antiinjection($data){
		  $filter_sql = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
		  return $filter_sql;
		}
		
		$nama 			= antiinjection($_POST['username']);
		$password 		= antiinjection(md5($_POST['password']));
		$nama_lengkap 	= antiinjection($_POST['nama_lengkap']);
		$email			= antiinjection($_POST['email']);
		$telp			= antiinjection($_POST['no_telp']);
		
		if(!empty($_POST['kode']))
		{
			if($_POST['kode']==$_SESSION['captcha_session'])
			{
				// Mengatasi input komentar tanpa spasi
				$split_text = explode(" ",$pesan);
				$split_count = count($split_text);
				$max = 100;

				for($i = 0; $i <= $split_count; $i++)
				{
					if(strlen($split_text[$i]) >= $max)
					{
						for($j = 0; $j <= strlen($split_text[$i]); $j++)
						{
								$char[$j] = substr($split_text[$i],$j,1);
								if(($j % $max == 0) && ($j != 0))
								{
									$v_text .= $char[$j] . ' ';
								} else {
									$v_text .= $char[$j];
									}
							}
					} else {
						  $v_text .= " " . $split_text[$i] . " ";
							}
				}

				$sql = mysql_query("INSERT INTO users (username,password,nama_lengkap,email,no_telp,level,blokir) 
								VALUES('$nama','$password','$nama_lengkap','$email','$telp','member','N')");

				echo "<script>window.alert('Registrasi berhasil. Terimakasih.');window.location=('login.html');</script>";
			} else {
					echo "<script>window.alert('Kode captcha tidak cocok!');window.location=('javascript:history.go(-1)');</script>";
				}
		} else {
			echo "<script>window.alert('Anda belum memasukan kode captcha!');window.location=('javascript:history.go(-1)');</script>";
		}
	}
	
}


//proses form login
elseif($_GET['module']=='proses-login')
{
	function anti_injection($data){
	  $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
	  return $filter;
	}

	$username = anti_injection($_POST['username']);
	$pass     = anti_injection(md5($_POST['password']));

	// pastikan username dan password adalah berupa huruf atau angka.
	if (!ctype_alnum($username) OR !ctype_alnum($pass)){
		echo "<div class='mCont _columns'>";
		echo "<div style='padding: 0 10px; line-height:20px;'>
		<a href='javascript:history.go(-1)'><b>Ulangi Sekali Lagi</b></a> </div></td>";
		echo "</div>";

	}
	else{
	$login=mysql_query("SELECT * FROM users WHERE username='$username' AND password='$pass' AND blokir='N'");
	$ketemu=mysql_num_rows($login);
	$r=mysql_fetch_array($login);

	// Apabila username dan password ditemukan
	if ($ketemu > 0){
		session_start();
		$_SESSION['namauser']     = $r['username'];
		$_SESSION['namalengkap']  = $r['nama_lengkap'];
		$_SESSION['passuser']     = $r['password'];
		$_SESSION['leveluser']    = $r['level'];

		$sid_lama = session_id();
		
		session_regenerate_id();

		$sid_baru = session_id();

	  mysql_query("UPDATE users SET id_session='$sid_baru' WHERE username='$username'");
	  header('location:cart');
	}
	else{
	  echo "<script>window.alert('Username atau Password Salah');window.location=('javascript:history.go(-1)');</script>";
	}}	
}

elseif($_GET['module']=='belanja') {
	include("inc/belanja.php"); 
}

//proses form transaksi
elseif($_GET['module']=='form_transaksi')
{

		
	echo "<div class='features_items' style='margin: 0px 20px 30px 20px;'>
		<div class='col-sm-12'>";

	$kar1=strstr($_POST['email'], "@");
	$kar2=strstr($_POST['email'], ".");

	if (empty($_POST['nama']) || empty($_POST['alamat']) || empty($_POST['telpon']) || empty($_POST['email']) || empty($_POST['kota'])){
	  echo "<script>window.alert('Data yang anda isikan belum lengkap!');window.location=('javascript:history.go(-1)');</script>";
	}
	elseif (!ereg("[a-z|A-Z]","$_POST[nama]")){
	  echo "<script>window.alert('Nama tidak valid!');window.location=('javascript:history.go(-1)');</script>";
	}
	elseif (strlen($kar1)==0 OR strlen($kar2)==0){
	  echo "<script>window.alert('Email tidak valid!');window.location=('javascript:history.go(-1)');</script>";
	}
	else{

	// fungsi untuk mendapatkan isi keranjang belanja
	function isi_keranjang(){
		$isikeranjang = array();
		$sid = session_id();
		$sql = mysql_query("SELECT * FROM orders_temp WHERE id_session='$sid'");
		
		while ($r=mysql_fetch_array($sql)) {
			$isikeranjang[] = $r;
		}
		return $isikeranjang;
	}

	$tgl_skrg = date("Ymd");
	$jam_skrg = date("H:i:s");

	// simpan data pemesanan 
	mysql_query("INSERT INTO orders(nama_kustomer, alamat, telpon, email, tgl_order, jam_order, id_kota,kodepos,id_bank) 
				 VALUES('$_POST[nama]','$_POST[alamat]','$_POST[telpon]','$_POST[email]','$tgl_skrg','$jam_skrg','$_POST[kota]','$_POST[kode]','$_POST[nobank]')");
	  
	// mendapatkan nomor orders
	$id_orders=mysql_insert_id();
	$nobank=$_POST[nobank];
	$bank = mysql_fetch_array(mysql_query("SELECT * FROM mod_bank WHERE id_bank='$nobank'"));
	// panggil fungsi isi_keranjang dan hitung jumlah produk yang dipesan
	$isikeranjang = isi_keranjang();
	$jml          = count($isikeranjang);

	// simpan data detail pemesanan  
	for ($i = 0; $i < $jml; $i++){
	  mysql_query("INSERT INTO orders_detail(id_orders, id_produk, jumlah) 
				   VALUES('$id_orders',{$isikeranjang[$i]['id_produk']}, {$isikeranjang[$i]['jumlah']})");
	}
	  
	// setelah data pemesanan tersimpan, hapus data pemesanan di tabel pemesanan sementara (orders_temp)
	for ($i = 0; $i < $jml; $i++) {
	  mysql_query("DELETE FROM orders_temp WHERE id_orders_temp = {$isikeranjang[$i]['id_orders_temp']}");
	}
	
	  echo "<h2 class='title text-center' style='margin-top: 30px;'>Proses Pemesanan Selesai</h2>";

			  echo "<div class='rBox'><div class='prod_box_big'>
				<div class='top_prod_box_big'></div>
			<div class='center_prod_box_big'>            
			  <div class='details_big_cari'>
		  
		  <div><p>Terimakasih telah berbelanja bersama kami.</p>
				<p>Berikut ini adalah ringkasan informasi yang kami terima</p>
		  <table>
		  <tr><td><p>Nama           </td><td><p> : <b>$_POST[nama]</b></p> </td></tr>
		  <tr><td><p>Alamat Lengkap </td><td><p> : $_POST[alamat], $_POST[kode] </p></td></tr>
		  <tr><td><p>Telpon         </td><td><p> : $_POST[telpon] </p></td></tr>
		  <tr><td><p>E-mail         </td><td><p> : $_POST[email] </p></td></tr></table><br />
		  
		  <p>Nomor Order: <b> <span class='table6'>$id_orders</b><br /><br />";

		  $daftarproduk=mysql_query("SELECT * FROM orders_detail,produk 
									 WHERE orders_detail.id_produk=produk.id_produk 
									 AND id_orders='$id_orders'");

	echo "<table width='100%' border=0 cellpadding=0 cellspacing=1 align=center>
			<tr align=center height=23>
				<th><p>No.</th>
				<th><p>Nama Produk</th>
				<th><p>Berat(Kg)</th>
				<th><p>Qty</th>
				<th><p>Harga</th>
				<th><p>Sub Total</th></tr>";
		  
	$pesan="Terimakasih telah melakukan pemesanan online di toko kami<br /><br />  
			Nama: $_POST[nama] <br />
			Alamat: $_POST[alamat] <br/>
			Telpon: $_POST[telpon] <br /><hr />
			
			Nomor Order: $id_orders <br />
			Data order Anda adalah sebagai berikut: <br /><br />";
			
	$pesan2="Pesanan Masuk<br /><br />  
			Nama: $_POST[nama] <br />
			Alamat: $_POST[alamat] <br/>
			Telpon: $_POST[telpon] <br /><hr />
			
			Nomor Order: $id_orders <br />
			Data ordernya adalah sebagai berikut: <br /><br />";
			
	$no=1;
	while ($d=mysql_fetch_array($daftarproduk)){
	   $subtotalberat = $d['berat'] * $d['jumlah']; // total berat per item produk 
	   $totalberat  = $totalberat + $subtotalberat; // grand total berat all produk yang dibeli

	  
		$disc        = ($d['diskon']/100)*$d['harga'];
		$hargadisc   = number_format(($d['harga']-$disc),0,",","."); 
		$subtotal    = ($d['harga']-$disc) * $d['jumlah'];

	   $total       = $total + $subtotal;
	   $subtotal_rp = format_rupiah($subtotal);    
	   $total_rp    = format_rupiah($total);    
	   $harga       = format_rupiah($d['harga']);

	   echo "<tr>
		<td class='center'><p>$no.</td>
		<td><p>$d[judul]</td>
		<td class='center'><p>$d[berat]</td>
		<td class='center'><p>$d[jumlah]</td>
		<td><p>$harga,-</td><td><p> $subtotal_rp,-</td></tr>";

	   $pesan.="$d[jumlah] buah buku berjudul $d[judul] -> Rp. $harga (diskon $d[diskon]%)-> Subtotal: Rp. $subtotal_rp <br />";
	   $pesan2.="$d[jumlah] buah buku berjudul $d[judul] -> Rp. $harga (diskon $d[diskon]%)-> Subtotal: Rp. $subtotal_rp <br />";
	   $no++;
	}

	$ongkos=mysql_fetch_array(mysql_query("SELECT ongkos_kirim FROM kota WHERE id_kota='$_POST[kota]'"));
	$ongkoskirim1=$ongkos['ongkos_kirim'];
	$ongkoskirim = $ongkoskirim1 * ceil($totalberat);

	$grandtotal    = $total + $ongkoskirim; 

	$ongkoskirim_rp = format_rupiah($ongkoskirim);
	$ongkoskirim1_rp = format_rupiah($ongkoskirim1); 
	$grandtotal_rp  = format_rupiah($grandtotal);  

	$pesan.="<br /><br /><p>Total : Rp. $total_rp,-
			 <br /><p>Ongkos Kirim untuk Tujuan Kota Anda : Rp. $ongkoskirim1_rp/Kg 
			 <br /><p>Total Berat : $totalberat Kg
			 <br /><p>Total Ongkos Kirim  : Rp. $ongkoskirim_rp		 
			 <br /><p>Total : Rp. $grandtotal_rp,-
			 <br /><br /><p>Silahkan lakukan pembayaran ke Bank $bank[nama_bank] no.rekening $bank[no_rekening] a.n $bank[pemilik] sebanyak Total yang tercantum, ";

	$pesan2.="<br /><br /><p>Total : Rp. $total_rp,-
			 <br /><p>Ongkos : Rp. $ongkoskirim1_rp/Kg 
			 <br /><p>Total Berat : $totalberat Kg
			 <br /><p>Total Ongkos Kirim  : Rp. $ongkoskirim_rp		 
			 <br /><p>Total : Rp. $grandtotal_rp,-
			 <br /><br /><p>Akan dibayarkan ke Bank $bank[nama_bank] no.rekening $bank[no_rekening] a.n $bank[pemilik] ";

	mysql_query("UPDATE orders set ongkir='$ongkoskirim' where id_orders='$id_orders' ");

	$subjek="Pemesanan Online Solusi Buku";
	$subjek2="Pesanan Online Solusi Buku";

	$mailadmin=mysql_fetch_array(mysql_query("SELECT email FROM admin where id='1' "));

	// Kirim email dalam format HTML
	$dari = "From: $mailadmin[email] \n";
	$dari .= "Content-type: text/html \r\n";

	$kustomer = "From: $_POST[email] \n";
	$kustomer .= "Content-type: text/html \r\n";

	//kirim email dari admin ke kustomer
	mail($_POST['email'],$subjek,$pesan,$dari);


		
		// Kirim email ke pengelola toko online
		mail("$mailadmin[email]",$subjek2,$pesan2,$kustomer);

	echo "<tr><td colspan=5 align=right><p>Total : Rp. </td><td align=right><p><b>$total_rp</b></td></tr>
			<tr><td colspan=5 align=right><p>Ongkir : Rp. </td><td align=right><p><b>$ongkoskirim1_rp</b></td></tr>
			<tr><td colspan=5 align=right><p>Total Berat : </td><td align=right><p><b>$totalberat Kg</b></td></tr>
			<tr><td colspan=5 align=right><p>Ongkir total: Rp. </td><td align=right><p><b>$ongkoskirim_rp</b></td></tr>
		  <tr><td colspan=5 align=right><p>Grand Total : Rp. </td><td align=right><p><b>$grandtotal_rp</b></td></tr>
		  </table>";
	echo "<br /><br /><br /><br /><p>- Data order dan nomor rekening transfer akan dikirim ke email Anda . <br />
	 - Silahkan lakukan pembayaran ke <b>Bank $bank[nama_bank] no.rekening $bank[no_rekening] a.n $bank[pemilik] </b>sebanyak Rp <b>$grandtotal_rp</b><br>
				   - Apabila Anda tidak melakukan pembayaran dalam 3 hari, maka data order Anda akan terhapus (transaksi batal)<br>
				   - Catat no. order anda!</p><br />  

				  </div>
			  </div>    
			  </div>
				<div class='bottom_prod_box_big10'></div>
			  </div>";    
			  
	}
	echo "</div></div>";

}

elseif($_GET['module']=='konfirmasi') {
	include ('inc/sidebar.php');
	include("inc/konfirmasi.php"); 
}

elseif($_GET['module']=='formkonfirmasi') {
	$bank_asal 		 = trim($_POST['bankasal']);
	$no_order  		 = trim($_POST['no']);
	$no_rekening  	 = trim($_POST['norek']);
	$atas_nama  	 = trim($_POST['an']);
	$jumlah_transfer = trim($_POST['jml']);
	$bank_tujuan 	 = trim($_POST['bank']);
	
	$tgl_transfer = $_POST['thn']."-".$_POST['bln']."-".$_POST['tgl'];
	// sesuaikan tanggal dengan format MYSQL(thn-bln-tgl)
	//validasi
	if (empty($no_order)){
	echo "<script>window.alert('Anda belum mengisikan No.Order');window.location=('javascript:history.go(-1)');</script>";
	}
	elseif(empty($jumlah_transfer)){
	echo "<script>window.alert('Anda belum mengisikan Jumlah Transfer');window.location=('javascript:history.go(-1)');</script>";
	}
	else{
	
		if(!empty($_POST['kode']))
		{
				
			if($_POST['kode']==$_SESSION['captcha_session'])
			{

				// Mengatasi input komentar tanpa spasi
				$split_text = explode(" ",$pesan);
				$split_count = count($split_text);
				$max = 100;

				for($i = 0; $i <= $split_count; $i++)
				{
					if(strlen($split_text[$i]) >= $max)
					{
						for($j = 0; $j <= strlen($split_text[$i]); $j++)
						{
								$char[$j] = substr($split_text[$i],$j,1);
								if(($j % $max == 0) && ($j != 0))
								{
									$v_text .= $char[$j] . ' ';
								} else {
									$v_text .= $char[$j];
									}
							}
					} else {
						  $v_text .= " " . $split_text[$i] . " ";
							}
				}

				$sql =  mysql_query("INSERT INTO mod_konfirmasi (no_order,no_rekening,jumlah_transfer,nama_pengirim,bank_asal,bank_tujuan,tgl_transfer,tgl_konfirmasi) 
								VALUES('$no_order','$no_rekening','$jumlah_transfer','$atas_nama','$bank_asal','$bank_tujuan','$tgl_transfer',CURDATE())");

				echo "<script>window.alert('Konfirmasi anda kami terima. Terimakasih.');window.location=('home');</script>";
			} else {
					echo "<script>window.alert('Kode captcha tidak cocok!');window.location=('javascript:history.go(-1)');</script>";
				}
		} else {
			echo "<script>window.alert('Anda belum memasukan kode captcha!');window.location=('javascript:history.go(-1)');</script>";
		}
	}

}


elseif($_GET['module']=='search') {
	include("inc/search.php"); 
}

elseif($_GET['module']=='new-release') {
	include("inc/new-release.php"); 
}

elseif($_GET['module']=='best-seller') {
	include("inc/best-seller.php"); 
}

elseif($_GET['module']=='404') {
	include("404.html"); 
}
 ?>