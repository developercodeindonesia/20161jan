<?php
 if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_konfirmasi/aksi_konfirmasi.php";
	switch($_GET['act']){
		// Tampil konfirmasi
		default:
		echo "<h2 class='hLine'>Konfirmasi Masuk</h2>";
		 echo "<form action=modul/mod_konfirmasi/aksi_alldel.php method=POST>";
		echo "<table class='list'>
		<thead><tr>
		<td class='center'>#</td>
		<td class='center'>No.Order</td>
		<td class='center'>Nama Pengirim</td>
		<td class='center'>Tanggal Transfer</td>
		<td class='center'>Tanggal Konfirmasi</td>
		<td class='center' colspan='2'>aksi</td>
		</tr></thead>";
		
		$p      = new Paging;
		$batas  = 10;
		$posisi = $p->cariPosisi($batas);

		$tampil = mysql_query("SELECT * FROM mod_konfirmasi ORDER BY id DESC LIMIT $posisi,$batas");
		$no=0;
		while($t=mysql_fetch_array($tampil)){
			$tgl_transfer= tgl_indo($t['tgl_transfer']);
			$tgl_konfirmasi = tgl_indo($t['tgl_konfirmasi']);
				echo "<tr><td><input type=checkbox name=cek[] value=$t[id] id=id$no></td>
				<td>$t[no_order]</td>
				<td>$t[nama_pengirim]</td>
				<td>$tgl_transfer</td>
				<td>$tgl_konfirmasi</td>
				<td><a href='?module=konfirmasi&act=detail&id=$t[id]'><img src='images/add-icon.gif' title='detail' /></a></td>
				<td><a href='$aksi?module=konfirmasi&act=del&id=$t[id]'><img src='images/hr.gif' title='hapus' /></a></td>
				</tr>";
			$no++;
		}
		echo "<tr><td colspan='7' class='left'>
		<input type=radio name=pilih onClick='for (i=0;i<$no;i++){document.getElementById(\"id\"+i).checked=true;}'>Check All 
		<input type=radio name=pilih onClick='for (i=0;i<$no;i++){document.getElementById(\"id\"+i).checked=false;}'>Uncheck All 
		</td></tr>
		<tr><td colspan='7' class='left'><input type=submit class='butt' value=Hapus></td>";
		echo "</table>";
		echo "</form>";
		break;
		
		case "detail":
		$edit = mysql_query("SELECT * FROM mod_konfirmasi WHERE id='$_GET[id]'");
		$r    = mysql_fetch_array($edit);
		//format rupiah
		$jumlah_transfer=format_rupiah(($r['jumlah_transfer']));
		//format tanggal
		$tgl_konfirmasi = tgl_indo($r['tgl_konfirmasi']);
		$tgl_transfer = tgl_indo($r['tgl_transfer']);
		$tgl_konfirmasi = tgl_indo($r['tgl_konfirmasi']);
		echo "<h2 class='hLine'><a href='?module=konfirmasi'>Konfirmasi</a> &raquo; Detail</h2>";
		echo "<table class='list'>";
		echo "<tr><td class='right' colspan='2'>$tgl_konfirmasi</td></tr>
			<tr><td class='left' width='120'>No. Order</td><td class='left'><div class='msgBox'>$r[no_order]</div></td></tr>
			<tr><td class='left'>Nama Pengirim</td><td class='left'><div class='msgBox'>$r[nama_pengirim]</div></td></tr>
			<tr><td class='left'>Bank Asal</td><td class='left'><div class='msgBox _uppercase'>$r[bank_asal]</div></td></tr>
			<tr><td class='left'>No.Rekening</td><td class='left'><div class='msgBox _uppercase'>$r[no_rekening]</div></td></tr>
			<tr><td class='left'>Bank Tujuan</td><td class='left'><div class='msgBox _uppercase'>$r[bank_tujuan]</div></td></tr>
			<tr><td class='left'>Jumlah Transfer</td><td class='left'><div class='msgBox'>Rp. $jumlah_transfer,-</div></td></tr>
			<tr><td class='left'>Tanggal Transfer</td><td class='left'><div class='msgBox'>$tgl_transfer</div></td></tr>
			<tr><td class='left'>Tanggal Konfirmasi</td><td class='left'><div class='msgBox'>$tgl_konfirmasi</div></td></tr>
			";
		//cek modul order, jika nomor order ada tampilkan link detail order
		$order = mysql_fetch_array(mysql_query("SELECT * FROM orders WHERE id_orders='$r[no_order]'"));
		echo "<tr><td class='left' colspan='2'>";
		if(!$order){ echo "<p style='color:red;'>Error! Tidak ditemukan order dengan nomor: $r[no_order] <br />Tidak ada detail order.</p>"; }
		else { echo "&raquo; <a href='?module=order&act=detailorder&id=$order[id_orders]' title='lihat detail order' target='_blank'>Detail Order</a>"; } 
		echo "</td></tr>";
		echo "</table>";
		break;
	} //end switch
}
?>
