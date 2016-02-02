<?php
//error_reporting(0);
  // Statistik user
  $ip      = $_SERVER['REMOTE_ADDR']; // Mendapatkan IP komputer user
  $tanggal = date("Y-m-d"); // Mendapatkan tanggal sekarang
  $waktu   = time(); // 

  // Mencek berdasarkan IPnya, apakah user sudah pernah mengakses hari ini 
  $s = mysql_query("SELECT * FROM statistik WHERE ip='$ip' AND tanggal='$tanggal'");
  // Kalau belum ada, simpan data user tersebut ke database
  if(mysql_num_rows($s) == 0){
    mysql_query("INSERT INTO statistik(ip, tanggal, hits, online) VALUES('$ip','$tanggal','1','$waktu')");
  } 
  else{
    mysql_query("UPDATE statistik SET hits=hits+1, online='$waktu' WHERE ip='$ip' AND tanggal='$tanggal'");
  }

  $pengunjung       = mysql_num_rows(mysql_query("SELECT * FROM statistik WHERE tanggal='$tanggal' GROUP BY ip"));
  $totalpengunjung  = mysql_result(mysql_query("SELECT COUNT(hits) FROM statistik"), 0); 
  $totalhits        = mysql_result(mysql_query("SELECT SUM(hits) FROM statistik"), 0); 
  $bataswaktu       = time() - 300;
  
  $hits=mysql_fetch_array(mysql_query("SELECT SUM(hits) as hitstoday FROM statistik WHERE tanggal='$tanggal' GROUP BY tanggal"));
  $online = mysql_num_rows(mysql_query("SELECT * FROM statistik WHERE online > '$bataswaktu'"));


?>
<div class="boxvisitor">
	<h2>Pengunjung Hari Ini</h2>
	<div class="box"><?php echo $pengunjung; ?><p>Pengunjung</p></div>
</div>
<div class="boxvisitor">
	<h2>Total Pengunjung</h2>
	<div class="box"><?php echo $totalpengunjung; ?><p>Pengunjung</p></div>
</div>
<div class="boxvisitor">
	<h2>Klik Hari Ini</h2>
	<div class="box"><?php echo $hits['hitstoday']; ?></div>
</div>
<div class="boxvisitor">
	<h2>Pengunjung Online</h2>
	<div class="box"><?php echo $online; ?><p>Pengunjung</p></div>
</div>
