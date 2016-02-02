<script>
function validasi(form){
  if (form.nama.value == ""){
    alert("Anda belum mengisikan Nama.");
    form.nama.focus();
    return (false);
  }    
  if (form.alamat.value == ""){
    alert("Anda belum mengisikan Alamat.");
    form.alamat.focus();
    return (false);
  }
  if (form.telpon.value == ""){
    alert("Anda belum mengisikan Telpon.");
    form.telpon.focus();
    return (false);
  }
  if (form.email.value == ""){
    alert("Anda belum mengisikan Email.");
    form.email.focus();
    return (false);
  }
  if (form.jasa.value == 0){
    alert("Anda belum memilih jasa pengiriman barang.");
    form.jasa.focus();
    return (false);
  }
  if (form.kota.value == 0){
    alert("Anda belum mengisikan Kota.");
    form.kota.focus();
    return (false);
  }
  return (true);
}

</script>
<script>
$(document).ready(function() {
	$('#propinsi').change(function() { 
		var propinsi = $('#propinsi').val();
		var kurir = $('#jasa').val();
		$.ajax({
			type: 'GET',
			url: 'inc/kota.php',
			data: 'prop=' + propinsi+'&kur='+kurir,
			dataType: 'html',
			beforeSend: function() {
				$('#dakota').html('<img src="joimg/loader.gif" />');	
			},
			success: function(response) {
				$('#dakota').html(response);
			}
		});
    });
	$('#jasa').change(function() { 
		var propinsi = $('#propinsi').val();
		var kurir = $('#jasa').val();
		$.ajax({
			type: 'GET',
			url: 'inc/kota.php',
			data: 'prop=' + propinsi+'&kur='+kurir,
			dataType: 'html',
			beforeSend: function() {
				$('#dakota').html('<img src="joimg/loader.gif" />');	
			},
			success: function(response) {
				$('#dakota').html(response);
			}
		});
    });
    
   	$('#dakota').change(function() { 
		var k = $('#kota').val();
		$.ajax({
			type: 'GET',
			url: 'inc/ongkir.php',
			data: 'k=' + k,
			dataType: 'html',
			beforeSend: function() {
				$('#ongkir').html('<img src="joimg/loader.gif" />');	
			},
			success: function(response) {
				$('#ongkir').html(response);
			}
		});
    });

});
</script>
<?php
error_reporting(0);
switch($_GET['step']) {

	default:	
// Tampilkan produk-produk yang telah dimasukkan ke keranjang belanja
	$sid = session_id();
	$sql = mysql_query("SELECT * FROM orders_temp, produk WHERE id_session='$sid' AND orders_temp.id_produk=produk.id_produk");
	$ketemu=mysql_num_rows($sql);
	
	  
		echo "<div class='features_items' style='margin: 0px 20px 30px 20px;'><div class='col-sm-12'>
				<h2 class='title text-center'>Keranjang Belanja</h2>
			  <form method=post action='cart.php?mod=basket&act=update'>";
		
		echo "<table  class='prodCart' width='100%' border='1'>";
			echo "
				<table class='table table-condensed'>
				<thead>
					<tr class='cart_menu'>
			
					<td class='center'>No.</td>
					<td>Produk</td>
					<td>Judul</td>
					<td>Berat</td>
					<td>Jumlah</td>
					<td>Harga</td>
					<td colspan='2'>Sub Total</td>
					</thead>
				</tr><tbody>";
	$no=1;
	while($r=mysql_fetch_array($sql)){

		$disc        = ($r['diskon']/100)*$r['harga'];
		$hargadisc   = number_format(($r['harga']-$disc),0,",",".");
		$subtotal    = ($r['harga']-$disc) * $r['jumlah'];
		$total       = $total + $subtotal;  
		
		$subtotal_rp = format_rupiah($subtotal);
		$total_rp    = format_rupiah($total);
		$harga       = format_rupiah($r['harga']);
		
		
		   echo "
			<tr>
					<td class='vtop center'><b>$no.</b></td>
					<input type=hidden name=id[$no] value=$r[id_orders_temp]>
					<td class='center'><a href='produk-$r[id_produk]-$r[judul_seo].html' title='$p[judul]'>";
				  $eks=explode('.', $r['gambar']);
					error_reporting(E_PARSE);  
					if ($r['gambar']=='' OR $eks[1]=='' OR $eks[1]=='pdf'){
						echo "<img width=50 src='joimg/produk/no-foto.jpg' />";
					}
					else {
						echo "<img width=50 src='joimg/produk/$r[gambar]'  /></td>";
					}
					
			echo "	  <td valign='top'>$r[judul]</td>
				  <td>$r[berat]</td>
				  <td> <input type=text name='jml[$no]' value=$r[jumlah] size=1 onchange=\"this.form.submit()\" onkeypress=\"return harusangka(event)\" style='outline: 1px dotted;'> </td>
				  <td>$hargadisc</td>
				  <td>$subtotal_rp</td>
				  <td align=center><a href='cart.php?mod=basket&act=del&id=$r[id_orders_temp]'>
					<img src=joimg/kali.png border=0 title=Hapus></a>
				  </td>
			  </tr>";
		$no++; 
	  } 
		echo "<tr class='fBg'>
			<td colspan=6 class='right'><b>Total:</b></td>
			<td class='price' colspan='2' style='border-left: 1px solid #fff;'><b>Rp. $total_rp,-</b></td></tr>";
		echo "<tr>
				<td colspan='4'></td>
				<td colspan='4' class='right'>
				<a href='produk-perlengkapan-pramuka-pmr-sekolah-pecinta-alam'>
					<input class='butt' type='button' value='Back'></a>
				<a href='cart-step1'>
					<input class='butt' type='button' value='Checkout'></a>
				</td>
			</tr>";
		echo "</tbody></table>";
			  
		echo "<p class='pInfo' style='margin: 0px 40px;'>* Total harga di atas belum termasuk ongkos kirim yang akan dihitung saat <b>Selesai Belanja</b></p>";
		echo "</form></div></div>";             
	
	break;
	
	case "1":
	$sid = session_id();
	$sql = mysql_query("SELECT * FROM orders_temp, produk WHERE id_session='$sid' AND orders_temp.id_produk=produk.id_produk");
	$ketemu=mysql_num_rows($sql);
	if($ketemu < 1){
    echo "<script>window.alert('Keranjang Belanja masih kosong!');
        window.location=('index.php')</script>";
    }else{

	if(empty($_SESSION['leveluser']))
	{
	//proses belanja non-member
		/*
        echo "<div class='features_items' style='margin: 0px 20px 30px 20px;'><div class='col-sm-12'>";
		echo "<h2 class='title text-center'>Login</h2>";
		echo $SESSION['leveluser'];
        
		echo "<form method='POST' action='proses-login'>
				<table>";
				echo "<tr>
					<td class='left vmid'>Username</td>
					<td class='left'><input type='text' name='username' value='username' class='field' onBlur='if (jQuery(this).val() == &quot;&quot;) { jQuery(this).val(&quot;Email&quot;); }' onClick='jQuery(this).val(&quot;&quot;);' /></td>
				</tr>
				<tr>
					<td class='left'>Password</td>
					<td class='left'><input type='password' name='password' value='password' class='field' onBlur='if (jQuery(this).val() == &quot;&quot;) { jQuery(this).val(&quot;asdf1234&quot;); }' onClick='jQuery(this).val(&quot;&quot;);'></td>
				</tr>
				<tr>
					<td colspan='2' class='right'>
						<input type='submit' class='butt' value='login'>
					</td>
				</tr>";				
			echo "</table></form>";
			echo "<p class='pInfo'>Jika anda belum terdaftar sebagai member di Solusi Buku, silahkan <a href='register'><b>registrasi</b></a> terlebih dahulu. <a href='register'><input type='button' class='butt' value='register'></a></p>";
		echo "</div>";
	   */
		echo "<div class='clear'>";
			include "inc/data_belanja.php";
			echo "<table width='100%'>
					<tr><td class='right'>
					<i><small>Klik tombol proses jika anda ingin melanjutkan tanpa mendaftar.</small></i><a href='cart-step2'>
					<input class='butt' type='button' value='Proses'></a>
					</td></trs>
					</table>";
		echo "</div></div>";
		
	}
		else { 
	//proses belanja member
		//form data pembeli
			$sid = session_id();
		echo "<div class='features_items' style='margin: 0px 20px 30px 20px;'><div class='col-sm-12'>
			<h2 class='title text-center' style='margin-top: 30px;'>Data Pembeli</h2>";
		echo "<div class='cBoxL _columns _50'>";
	//form data pembeli
		echo "<form name=form action='prosesTrans' method='POST' onSubmit=\"return validasi(this)\">
		<table width=550>
		  <tr>
			<td>Nama</td>
			<td><input type=text name=nama size=30 /></td>
		  </tr>
		  <tr>
			<td valign='top'> Alamat Lengkap </td>
			<td>  <input type='text' name='alamat' style='width: 210px; height: 50px;'/></td>
		  </tr>
		  <tr>
			<td valign='top'> Kode Pos </td>
			<td>  <input type='text' name='kode'/></td>
		  </tr>
		  <tr>
			<td>Telpon/HP</td>
			<td>  <input type='text' name='telpon' /></td>
		  </tr>
		  <tr>
			<td> Email</td>
			<td>  <input type='text' name='email' /></td>
		  </tr>
		  <tr>
		  <td class='vmid'><span class='table4'>Jasa Pengiriman</td>
		  <td>  
			  <select name='jasa' id='jasa'>
			  <option value='0' selected>- Pilih Jenis Jasa Pengiriman -</option>";
			  
			  $tampil=mysql_query("SELECT * FROM mod_kurir ORDER BY nama_kurir");
			  while($r=mysql_fetch_array($tampil)){
				 echo "<option value='$r[id_kurir]'>$r[nama_kurir]</option>";
			  }
		  echo "</select></td></tr>
		  <tr>
			  <td class='vmid'>Propinsi Tujuan</td>
			  <td>
				<select id='propinsi' name='propinsi'>";
				$tampil=mysql_query("SELECT * FROM propinsi ORDER BY propinsi");
		        echo "<option value='0' selected>- Lokasi Pengiriman -</option>";
		        while($k=mysql_fetch_array($tampil))
		        {
					echo "<option value='$k[id]'>$k[propinsi]</option>";
				}
				echo "</select>
			  </td>
		  </tr>
		  <tr>
			  <td class='vmid'></td>
			  <td>
					<div id='dakota'></div>
			  </td>
		  
		  <tr><td colspan='2' height='10px'></td></tr>
		  <tr><td colspan='2' height='10px'>Pilih Bank Tujuan:</td></tr>";
		  include "inc/databank.php";
		 echo " <tr><td></td>
			<td>
			<input class='butt' type='submit' value='proses'></td></tr>
		</table>";
		echo "</div>";
		echo "<div class='cBoxR _columns'>";
			echo '<p>Login sebagai '.$_SESSION['namauser'].'.</p>';
			echo "<p>Silahkan lengkapi data disamping untuk memproses permintaan anda.</p>";
			echo "<a href='logout'>Logout</a>";
		echo "</div>";
		//data belanjaan
		echo "<div class='clear'>";
			include "inc/data_belanja.php";
		echo "</div>
		<div align='right'></div>";
		}
	}
	break;
	
	case "2":
		echo "<div class='features_items' style='margin: 0px 20px 30px 20px;'><div class='col-sm-12'>
			<h2 class='title text-center' style='margin-top: 30px;'>Data Pembeli</h2>";
		echo "<p class=' _capitalize'>pastikan anda mengisi data berikut dengan benar.</p>";
		//form data pembeli
		echo "<form name=form action='prosesTrans' method='POST' onSubmit=\"return validasi(this)\">
		<table width=550>
		  <tr>
			<td>Nama Lengkap </td>
			<td><input type=text name=nama size=30 /></td>
		  </tr>
		  <tr>
			<td valign='top'> Alamat Lengkap </td>
			<td>  <input type='text' name='alamat' style='width: 210px; height: 50px;'/></td>
		  </tr>
		  <tr>
			<td>Telpon/HP</td>
			<td>  <input type='text' name='telpon' /></td>
		  </tr>
		  <tr>
			<td> Email</td>
			<td>  <input type='text' name='email' /></td>
		  </tr>
		  <tr>
			  <td class='vmid'>Propinsi Tujuan</td>
			  <td>
				<select id='propinsi' name='propinsi'>";
				$tampil=mysql_query("SELECT * FROM propinsi ORDER BY propinsi");
		        echo "<option value='0' selected>- Lokasi Pengiriman -</option>";
		        while($k=mysql_fetch_array($tampil))
		        {
					echo "<option value='$k[id]'>$k[propinsi]</option>";
				}
				echo "</select>
			  </td>
		  </tr>
		  <tr>
		  <td class='vmid'><span class='table4'>Jasa Pengiriman</td>
		  <td>  
			  <select name='jasa' id='jasa'>
			  <option value='0' selected>- Pilih Jenis Jasa Pengiriman -</option>";
			  
			  $tampil=mysql_query("SELECT * FROM mod_kurir ORDER BY nama_kurir");
			  while($r=mysql_fetch_array($tampil)){
				 echo "<option value='$r[id_kurir]'>$r[nama_kurir]</option>";
			  }
		  echo "</select></td></tr>
		  <tr>
			  <td class='vmid'></td>
			  <td>
					<div id='dakota'></div>
			  </td>
		  
		  </tr>
			<tr><td colspan='2' height='10px'></td></tr>
		  <tr>
			<td></td>
			<td>
			<input class='butt' type='submit' value='proses'></td></tr>
		</table></div></div>";
		//data belanjaan
		include "inc/data_belanja.php";
	break;
	
}//end switch
?>