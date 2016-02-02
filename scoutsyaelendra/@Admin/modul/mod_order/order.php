<?php
session_start();
 if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_order/aksi_order.php";
switch($_GET[act]){
  // Tampil Order
  default:
    echo "<form action=modul/mod_order/aksi_alldel.php method=POST>";
    echo "<h2 class='hLine'>Order Masuk</h2>
          <table class='list'>
          <thead>
          <tr><td class='center'>#</td><td class='center'>No.Order</td><td class='center'>Nama Konsumen</td><td class='center'>Tgl. Order</td><td class='center'>Jam</td><td class='center'>Status</td><td class='center'>Aksi</td></tr></thead>";

    $p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);

    $tampil = mysql_query("SELECT * FROM orders ORDER BY id_orders DESC LIMIT $posisi,$batas");
    $no=0;
    while($r=mysql_fetch_array($tampil)){
      $tanggal=tgl_indo($r[tgl_order]);	  
      echo "<tr><td><input type=checkbox name=cek[] value=$r[id_orders] id=id$no></td>
	            <td >$r[id_orders]</td>
                <td>$r[nama_kustomer]</td>
				<td>$tanggal</td>
                <td>$r[jam_order]</td>
                <td>$r[status_order]</td>
		            <td><a href=?module=order&act=detailorder&id=$r[id_orders]><b>Baca</b></a> | 
		                <a href=$aksi?module=order&act=hapus&id=$r[id_orders]><b>Hapus</b></a></td></tr>";
      $no++;
    }
	           
    echo "<tr><td colspan='7' class='left'>
<input type=radio name=pilih onClick='for (i=0;i<$no;i++){document.getElementById(\"id\"+i).checked=true;}'>Check All 
<input type=radio name=pilih onClick='for (i=0;i<$no;i++){document.getElementById(\"id\"+i).checked=false;}'>Uncheck All 

</td></tr>
<tr><td colspan='7' class='left'><input type=submit class='butt' value=Hapus></td>
</tr></table></form>";

    $jmldata = mysql_num_rows(mysql_query("SELECT * FROM orders"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "<div class=paging>Hal: $linkHalaman</div><br>";
    break;
  
    
  case "detailorder":
    $edit = mysql_query("SELECT * FROM orders WHERE id_orders='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
	
	$kota=mysql_fetch_array(mysql_query("SELECT * FROM kota,propinsi WHERE kota.id_kota='$r[id_kota]' AND kota.id_propinsi=propinsi.id"));
    $tanggal=tgl_indo($r['tgl_order']);

    $pilihan_status = array('Batal','Lunas/Terkirim');
    $pilihan_order = '';
    foreach ($pilihan_status as $status) {
	   $pilihan_order .= "<option value=$status";
	   if ($status == $r[status_order]) {
		    $pilihan_order .= " selected";
	   }
	   $pilihan_order .= ">$status</option>\r\n";
    }

    echo "<h2 class='hLine'>Detail Order</h2>
          <form method=POST action=$aksi?module=order&act=update>
          <input type=hidden name=id value=$r[id_orders]>
          <table class='list'>
          <tr>
			<td class='left'>No. Order</td>
			<td class='left'> : $r[id_orders]</td>
		  </tr>
          <tr>
			<td class='left'>Tgl. & Jam Order</td>
			<td class='left'> : $tanggal & $r[jam_order]</td></tr>
          <tr>
			<td class='left'>Status Order</td>
			<td class='left'>: <select name=status_order>$pilihan_order</select>
				<input class='butt' type='submit' value='Ubah Status'></td></tr>
          </table></form>";

  // tampilkan rincian produk yang di order
  $sql2=mysql_query("SELECT * FROM orders_detail, buku 
                     WHERE orders_detail.id_produk=buku.id_buku 
                     AND orders_detail.id_orders='$_GET[id]'");
  
  echo "<table class='list'>
        <tr><th>Nama Produk</th><th>Jumlah</th><th>Harga Satuan</th><th>Sub Total</th></tr>";
  
  while($s=mysql_fetch_array($sql2)){
    
    // rumus untuk menghitung subtotal dan total	
    $subtotalberat = $s['berat'] * $s['jumlah']; // total berat per item produk
	$totalberat   = $totalberat + $subtotalberat; // grand total berat all produk yang dibeli 		
    
    if($s['diskon']!=''){
   		$diskon       = ($s['diskon']/100)*$s['harga'];
    	$harga_diskon = $s['harga']-$diskon;
    	//harga setelah potongan diskon
    	$harga    = format_rupiah($harga_diskon);
    	$subtotal = $harga_diskon * $s['jumlah'];
    }
    else { 
    	$harga    = format_rupiah($s['harga']);
    	$subtotal = $s['harga'] * $s['jumlah']; 
    } 
    
    $total       = $total + $subtotal;
    $subtotal_rp = format_rupiah($subtotal);    
    $total_rp    = format_rupiah($total);    

    echo "<tr>
		<td class='left _capitalize'>$s[judul]</td>
		<td>$s[jumlah]</td>
		<td>Rp. $harga</td>
		<td class='right'>Rp. $subtotal_rp</td></tr>";
  }

  $ongkos=mysql_fetch_array(mysql_query("SELECT * FROM kota,orders WHERE orders.id_kota=kota.id_kota AND orders.id_orders='$_GET[id]'"));
  
	//hitung total ongkos kirim | 
	$kelipatan_tetap = $ongkos['kelipatan_tetap'];
	$ongkir_tetap = $ongkos['ongkos_kirim'];
		
	// n: nilai kelipatan harga
	if($total<=$kelipatan_tetap) {
		$cost = $ongkir_tetap;
		$grandtotal = $total+$cost;
	}else{ 
		$total_per_kelipatan = $total/$kelipatan_tetap;
		$n = sprintf("%2.1f",$total_per_kelipatan);
		$n_bulat = ceil($n);
		$cost = $ongkir_tetap*$n_bulat;
		$grandtotal = $total+$cost;
	}

  $cost_rp = format_rupiah($cost);
  $okr = $grandtotal + $r['ongkir'];
  $grandtotal_rp  = format_rupiah($okr); 
  //$grandtotal_rp  = format_rupiah($grandtotal); 
  $ongkir_tetap_rp   = format_rupiah($ongkir_tetap);    

echo "<tr>
		<td colspan=3 class='right'>Total : </td>
			<td class='right'>Rp. <b>$total_rp</b></td></tr>
      <tr>
		<td colspan=3 class='right'>Ongkos Kirim Tujuan Kota Pembeli :</td>
			<td class='center'>Rp. <b>$ongkir_tetap_rp | $kota[propinsi] - $kota[nama_kota]</b></td></tr>
	  <tr>
		<td colspan=3 class='right'>Total Berat Barang: </td>
			<td class='right'><b>$totalberat kilogram</b></td></tr>
      <tr>
		<td colspan=3 class='right'>Ongkos Kirim :</td>
			<td class='right'>Rp. <b>$r[ongkir]</b></td></tr>      
      <tr>
		<td colspan=3 class='right'>Grand Total : </td>
			<td class='right'>Rp. <b>$grandtotal_rp</b></td></tr>
      </table>";

	  //get bank
	  $bank =mysql_fetch_array(mysql_query("SELECT * FROM mod_bank WHERE id_bank='$r[id_bank]'"));
  // tampilkan data kustomer
  echo "<table class='list'>
        <tr><th colspan=2>Data Kustomer</th></tr>
        <tr>
			<td class='left' width='200'>Nama Pembeli</td>
			<td class='left'> : $r[nama_kustomer]</td></tr>
        <tr>
			<td class='left'>Alamat Pengiriman</td>
			<td class='left'> : $r[alamat]</td></tr>
		<tr>
			<td class='left'>Kode pos</td>
			<td class='left'> : $r[kodepos]</td></tr>
        <tr>
			<td class='left'>No. Telpon/HP</td>
			<td class='left'> : $r[telpon]</td></tr>
        <tr>
			<td class='left'>Email</td>
			<td class='left'> : $r[email]</td></tr>
		<tr>
			<td class='left' valign='top'>Bank Pembayaran</td>
			<td class='left'> <p> $bank[nama_bank]<br /> $bank[keterangan]<br /> A/n. $bank[pemilik] <br /> No.rekening $bank[no_rekening]</p></td></tr>
        </table>";
    
	
	case "kiriminvoice":

	$mailadmin=mysql_fetch_array(mysql_query("SELECT email FROM admin where id='1' "));
    echo "<h2 class='hLine'>Kirim Faktur Pembelian</h2>
          <form method=POST action='?module=order&act=kirimemail'>
          <table class='list'>
          <tr>
			<td class='left'>Dari</td>
			<td class='left'> : <input type=text name='emailFrom' size=30 value='$mailadmin[email]'></td></tr>
          <tr>
			<td class='left'>Kepada</td>
			<td class='left'> : <input type=text name='email' size=30 value='$r[email]'></td></tr>
          <tr>
			<td class='left'>Subjek</td>
			<td class='left'> : <input type=text name='subjek' size=50 value='Faktur Pembelian'></td></tr>
          <tr><td class='left'>Pesan</td><td>
		  <textarea name='pesan' style='height: 450px;' id='jogmce'>	  
		  <p>Dengan ini, Kami sampaikan bahwa kami telah menerima pembayaran order, dan pesanan anda telah kami kirim.</p>
  --------------------------------------------------------------------------------------
		  <p>Detail:</p>
		  <p>No. Order: $r[id_orders]</p>
		  <p>Atas nama: $r[nama_kustomer]</p> 
		  <p>Total pembayaran sebesar <b> Rp. $grandtotal_rp </b></p>
		  <p>Alamat pengiriman: $r[alamat]</p>
		  <p>Terima kasih telah belanja di Toko Online kami...</p>
		  <p>Salam kami,</p>  
  --------------------------------------------------------------------------------------
		<table>
        <tr><th colspan='2' align='left'>Data Kustomer</th></tr>
        <tr>
			<td class='left'>Nama Pembeli</td>
			<td class='left'> : $r[nama_kustomer]</td></tr>
        <tr>
			<td class='left'>Alamat Pengiriman</td>
			<td class='left'> : $r[alamat]</td></tr>
		<tr>
			<td class='left'>Kode pos</td>
			<td class='left'> : $r[kodepos]</td></tr>
        <tr>
			<td class='left'>No. Telpon/HP</td>
			<td class='left'> : $r[telpon]</td></tr>
        <tr>
			<td class='left'>Email</td>
			<td class='left'> : $r[email]</td></tr>
		<tr>
			<td class='left'>Bank pembayaran</td>
			<td class='left'> <p> $bank[nama_bank]<br /> $bank[keterangan]<br /> A/n. $bank[pemilik] <br /> No.rekening $bank[no_rekening]</p></td></tr>
        </table>
		<table>
		<tr><th colspan='4' align='left'>Data Belanja</th></tr>
		<tr>
		<td colspan=3 class='right'>Total : </td>
			<td class='right'>Rp. <b>$total_rp</b></td></tr>
      <tr>
		<td colspan=3 class='right'>Ongkos Kirim Tujuan Kota Pembeli :</td>
			<td class='center'>Rp. <b>$ongkir_tetap_rp | $kota[propinsi]- $kota[nama_kota]</b></td></tr>
	  <tr>
		<td colspan=3 class='right'>Total Berat Barang: </td>
			<td class='right'><b>$totalberat kg</b></td></tr>
      <tr>
		<td colspan=3 class='right'>Total Ongkos Kirim : </td>
			<td class='right'>Rp. <b>$r[ongkir]</b></td></tr>      
      <tr>
		<td colspan=3 class='right'>Grand Total : </td>
			<td class='right'>Rp. <b>$grandtotal_rp</b></td></tr>
      </table>
  </textarea></td></tr>
          <tr><td class='left' colspan=2><input type='submit' value='Kirim' class='butt' />
                            <input type='button' class='butt' value='Batal' onclick=self.history.back()></td></tr>
          </table></form>";
		  
	//email stock	  
	
	echo "<h2 class='hLine'>Kirim Konfirmasi Stock Produk</h2>
          <form method=POST action='?module=order&act=kirimstock'>
          <table class='list'>
          <tr>
			<td class='left'>Dari</td>
			<td class='left'> : <input type=text name='emailFrom' size=30 value='$mailadmin[email]'></td></tr>
          <tr>
			<td class='left'>Kepada</td>
			<td class='left'> : <input type=text name='email' size=30 value='$r[email]'></td></tr>
          <tr>
			<td class='left'>Subjek</td>
			<td class='left'> : <input type=text name='subjek' size=50 value='Konfirmasi Stock Ketersediaan Produk (Solusibuku.com)'></td></tr>
          <tr><td class='left'>Pesan</td><td>
		  <textarea name='pesan' style='height: 450px;' id='jogmce2'>	  
			<p>Selamat (Siang/Pagi), Kami telah menerima detail order judul buku ... stock ada. Silahkan melanjutkan transaksi pembayaran. <br /> Solusibuku.com</p>
  
			</textarea></td></tr>
          <tr><td class='left' colspan=2><input type='submit' value='Kirim' class='butt' />
                            <input type='button' class='butt' value='Batal' onclick=self.history.back()></td></tr>
          </table></form>";
	
     break;
    
  case "kirimemail":
  
	$sendFor = $_POST['email'];
	$subjek	 = $_POST['subjek'];
	$pesan   = $_POST['pesan'];
	
	//kirim email dgn format html
	$headers  = "From: ". strip_tags($_POST['emailFrom'])."\r\n";
	$headers .= "CC: admin@solusibuku.com\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	// Kirim email ke kustomer
	mail($sendFor,$subjek,$pesan,$headers);

	/*** // Kirim email ke pengelola toko online
	mail("admin@solusibuku.com",$subjek,$pesan,$sendFrom); ***/
	
    echo "<h2>Status Email</h2>
          <p>Email telah sukses terkirim ke tujuan</p>
          <p>[ <a href=javascript:history.go(-2)>Kembali</a> ]</p>";	 		  
    break;  
    
  case "kirimstock":
  
	$sendFor = $_POST['email'];
	$subjek	 = $_POST['subjek'];
	$pesan   = $_POST['pesan'];
	
	//kirim email dgn format html
	$headers  = "From: ". strip_tags($_POST['emailFrom'])."\r\n";
	$headers .= "CC: admin@solusibuku.com\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	// Kirim email ke kustomer
	mail($sendFor,$subjek,$pesan,$headers);

	/*** // Kirim email ke pengelola toko online
	mail("admin@solusibuku.com",$subjek,$pesan,$sendFrom); ***/
	
    echo "<h2>Status Email</h2>
          <p>Email telah sukses terkirim ke tujuan</p>
          <p>[ <a href=javascript:history.go(-2)>Kembali</a> ]</p>";	 		  
    break;  
 }
}
?>