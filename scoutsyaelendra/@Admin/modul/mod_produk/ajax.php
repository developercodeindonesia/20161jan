<?php
include('../../../josys/koneksi.php');

	$prop = $_GET['prop'];
	
	if($prop==0) { //jika user memilih propinsi jawa barat
	echo "-- Silakan Pilih Sub Kategori --";
	}else{
		/* 
			echo "<option value='0'>$prop</option>";
		 */
		$awe=mysql_query("SELECT * FROM sub_kategori WHERE id_kategori='$prop' ORDER BY nama ASC");
		$r = mysql_num_rows($awe);
		if($r != 0){
			while($a=mysql_fetch_array($awe)){
				echo"<option value='$a[id_sub_kategori]'>$a[nama]</option>";		
			} 
		} else {
			echo "<option value='0'> Belum Ada Sub Kategori!</option>";
		}
	}
?>