<script>
$(document).ready(function() {
	    
   	$('#kota').change(function() { 
		var k = $('#kota').val();
		$.ajax({
			type: 'GET',
			url: 'joinc/ongkir.php',
			data: 'k=' + k,
			dataType: 'html',
			beforeSend: function() {
				$('#ongkir').html('<img src="jolibs/images/loader.gif" />');	
			},
			success: function(response) {
				$('#ongkir').html(response);
			}
		});
    });

});
</script>

<?php
require_once "../josys/koneksi.php";
	$idp = $_GET['prop'];
	$idk = $_GET['kur'];
	$tampil=mysql_query("SELECT * FROM kota WHERE id_propinsi='$idp' AND id_kurir='$idk' ORDER BY nama_kota");
	$jml=mysql_num_rows($tampil);
	if($jml > 0){
		echo"
		<select id='kota' name='kota'>
		 <option value='0' selected>- Pilih Kota -</option>";
		 while($r=mysql_fetch_array($tampil)){
			 echo "<option value='$r[id_kota]'>$r[nama_kota] </option>";
		 }
		 echo "</select><div id='ongkir'></div>
			 
		";

	}else{
		echo "<p>Data Tidak Ada. Coba Jasa Pengiriman Lainnya</p>";
	}
?>
