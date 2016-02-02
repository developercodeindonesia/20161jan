<?php
session_start();
 if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_preorder/aksi_preorder.php";
switch($_GET[act]){
  // Tampil Order
  default:
    echo "<form action=modul/mod_preorder/aksi_alldel.php method=POST>";
    echo "<h2 class='hLine'>Pre Order Masuk</h2>
          <table class='list'>
          <thead><tr><td class='center'>#</td>
              <td class='center'>No.Pre Order</td>
              <td class='center'>Nama Konsumen</td>
              <td class='center'>Pesanan</td>
              <td class='center'>Jumlah</td>
              <td class='center'>Tgl. Pre Order</td>
              <td class='center'>Aksi</td></tr></thead>";

    $p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);

    $tampil = mysql_query("SELECT * FROM preorders ORDER BY id_preorder DESC LIMIT $posisi,$batas");
    $no=0;
    while($r=mysql_fetch_array($tampil)){
      $pesanan=mysql_query("SELECT * FROM preorders_detil, buku 
                     WHERE preorders_detil.id_produk=buku.id_buku 
                     AND preorders_detil.id_preorder='$r[id_preorder]' ");
      $p=mysql_fetch_array($pesanan);

      $tanggal=tgl_indo($r[tgl_order]);	  
      echo "<tr><td><input type=checkbox name=cek[] value=$r[id_preorder] id=id$no></td>
	            <td >$r[id_preorder]</td>
                <td>$r[nama_kustomer]</td>
				        <td>$p[judul]</td>
                <td>$p[jumlah]</td>
                <td>$tanggal</td>
		            <td><a href=?module=preorder&act=detailorder&id=$r[id_preorder]><b>Baca</b></a> | 
		                <a href=$aksi?module=preorder&act=hapus&id=$r[id_preorder]><b>Hapus</b></a></td></tr>";
      $no++;
    }
	           
    echo "<tr><td colspan='4' class='left'>
<input type=radio name=pilih onClick='for (i=0;i<$no;i++){document.getElementById(\"id\"+i).checked=true;}'>Check All 
<input type=radio name=pilih onClick='for (i=0;i<$no;i++){document.getElementById(\"id\"+i).checked=false;}'>Uncheck All 

</td></tr>
<tr><td colspan='4' class='left'><input type=submit class='butt' value=Hapus></td>
</tr></table></form>";

    $jmldata = mysql_num_rows(mysql_query("SELECT * FROM preorders"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "<div class=paging>Hal: $linkHalaman</div><br>";
    break;
  
    
  case "detailorder":
    $edit = mysql_query("SELECT * FROM preorders WHERE id_preorder='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
    $tanggal=tgl_indo($r[tgl_order]);

    $pilihan_status = array('Batal','Lunas/Terkirim');
    $pilihan_order = '';
    foreach ($pilihan_status as $status) {
	   $pilihan_order .= "<option value=$status";
	   if ($status == $r[status_order]) {
		    $pilihan_order .= " selected";
	   }
	   $pilihan_order .= ">$status</option>\r\n";
    }

    echo "<h2 class='hLine'>Detail Pre Order</h2>
          <form method=POST action=$aksi?module=preorder&act=update>
          <input type=hidden name=id value=$r[id_preorder]>
          <table class='list'>
          <tr>
			<td class='left'>No. PreOrder</td>
			<td class='left'> : $r[id_preorder]</td>
		  </tr>
          <tr>
			<td class='left'>Tgl. & Jam PreOrder</td>
			<td class='left'> : $tanggal & $r[jam_order]</td></tr>
          
          </table></form>";

  // tampilkan rincian produk yang di order
  $sql2=mysql_query("SELECT * FROM preorders_detil, buku 
                     WHERE preorders_detil.id_produk=buku.id_buku 
                     AND preorders_detil.id_preorder='$_GET[id]'");
  
  echo "<table class='list'>
        <tr><th>Nama Produk</th><th>Jumlah</th><th>Harga Satuan</th><th>Sub Total</th></tr>";
  
  while($s=mysql_fetch_array($sql2)){
     // rumus untuk menghitung subtotal dan total	
    $subtotalberat = $s['berat'] * $s['jumlah']; 		
    $subtotal    = $s['harga'] * $s['jumlah'];
    $total       = $total + $subtotal;
    $subtotal_rp = format_rupiah($subtotal);    
    $total_rp    = format_rupiah($total);    
    $harga       = format_rupiah($s['harga']);

    echo "<tr>
		<td class='left _capitalize'>$s[judul]</td>
		<td>$s[jumlah]</td><td>Rp. $harga</td><td>Rp. $subtotal_rp</td></tr>";
  }
$sql2=mysql_query("SELECT * FROM preorders_detil, buku 
                     WHERE preorders_detil.id_produk=buku.id_buku 
                     AND preorders_detil.id_preorder='$_GET[id]'");
$s=mysql_fetch_array($sql2);
echo "<tr><td colspan=3 class='right'>Total : </td><td>Rp. <b>$total_rp</b></td></tr>
      </table>";

  // tampilkan data kustomer
  echo "<table class='list'>
        <tr><th colspan=2>Data Kustomer</th></tr>
        <tr>
			<td class='left'>Nama Pembeli</td>
			<td class='left'> : $r[nama_kustomer]</td></tr>
        <tr>
			<td class='left'>Alamat Pengiriman</td>
			<td class='left'> : $r[alamat]</td></tr>
        <tr>
			<td class='left'>No. Telpon/HP</td>
			<td class='left'> : $r[telepn]</td></tr>
        <tr>
			<td class='left'>Email</td>
			<td class='left'> : $r[email]</td></tr>
        </table>";
    
	
	case "kiriminvoice":        

    echo "<h2 class='hLine'>Kirim Data Pre Order</h2>
          <form method=POST action='?module=preorder&act=kirimemail'>
          <table>
          <tr><td>Kepada</td><td> : <input type=text name='email' size=30 value='$r[email]'></td></tr>
          <tr><td>Subjek</td><td> : <input type=text name='subjek' size=50 value='Data Pre Order'></td></tr>
          <tr><td>Pesan</td><td>
		  <textarea name='pesan' style='height: 450px;' id='jogmce'>	  
		  <p>Dengan ini, Kami sampaikan bahwa kami telah menerima permintaan preorder anda</p>
  -----------------------------------------------------------------------------------------------------------------------------------
		  <p>Detail:</p>
		  <p>No. Pre Order: $r[id_preorder]</p>
		  <p>Atas nama: $r[nama_kustomer]</p> 
		  <p>Alamat: $r[alamat]</p>
      <p>No. Telpon/HP: $r[telepn]</p>
      <p>Pesanan: $s[judul]</p>
      <p>Jumlah: $s[jumlah]</p>
      <p>Total Pesanan: <b>Rp $total_rp</b></p>
      Setelah stok buku tersebut kami miliki, kami akan segera menghubungi anda untuk memberitakan mengenai pembayaran pre order ini.
		  <p>Salam kami, Solusibuku</p>  
  ------------------------------------------------------------------------------------------------------------------------------------
  </textarea></td></tr>
          <tr><td colspan=2><input type='submit' value='Kirim' class='butt' />
                            <input type='button' class='butt' value='Batal' onclick=self.history.back()></td></tr>
          </table></form>";
     break;
    
  case "kirimemail":
    mail($_POST['email'],$_POST['subjek'],$_POST['pesan'],"From: admin@solusibuku.com");
    echo "<h2>Status Email</h2>
          <p>Email telah sukses terkirim ke tujuan</p>
          <p>[ <a href=javascript:history.go(-2)>Kembali</a> ]</p>";	 		  
    break;  
 }
}
?>
