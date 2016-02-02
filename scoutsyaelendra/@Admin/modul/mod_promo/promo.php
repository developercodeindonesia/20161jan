<?php
session_start();
 if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_promo/aksi_promo.php";
switch($_GET['act']){
  // Tampil Produk
  default:
    echo "<h2 class='hLine'>Promo</h2>";

	echo "<table class='list'>
          <thead>
			  <tr>
				<td class='center'>No.</td>
				<td class='center'>Nama</td>
				<td class='center'>Judul Buku</td>
				<td class='center'>Nama Toko</td>
				<td class='center'>No. Struk</td>
				<td class='center'>Dilihat</td>
				<td class='center'>Tanggal</td>
				<td colspan='2' class='center'>Aksi</td>
			  </tr>
		  </thead>";

	//paging
    $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
    $url = "?module=$_GET[module]&";
    $limit = 10;
    $startpoint = ($page * $limit) - $limit;     
    $table = "promo";

    $tampil = mysql_query("SELECT * FROM promo ORDER BY tanggal DESC LIMIT {$startpoint}, {$limit}");
  
    $no = $startpoint+1;
    while($r=mysql_fetch_array($tampil)){
      $tgl_indo2=tgl_indo2($r['tanggal']);
      echo "<tr><td>$no</td>
                <td class='left'>$r[nama]</td>
                <td class='left'>$r[judul_buku]</td>
                <td class='left'>$r[nama_toko]</td>
                <td class='left'>$r[no_struk]</td>";
				if($r['publish']=='Y'){
				echo "<td class='left'>Yes</td>";
				}else{
				echo "<td class='left'>No</td>";					
				}			
            echo"<td class='left'>$tgl_indo2</td>
				";
                echo "
		            <td><a href=?module=promo&act=editPromo&id=$r[id_promo]><img src='images/add-icon.gif'></a></td> 
		            <td><a href=$aksi?module=promo&act=del&id=$r[id_promo]&nama_file=$r[gambar]><img src='images/hr.gif'></a></td>
		        </tr>";
      $no++;
    }
    echo "</table>";
	echo pagination($table,$limit,$page, $url);
 
    break;
    
  case "editPromo":
    $edit = mysql_query("SELECT * FROM promo WHERE id_promo='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2 class='hLine'>Edit Detail Promo</h2>
          <form method=POST enctype='multipart/form-data' action=$aksi?module=promo&act=update>
          <input type=hidden name=id value=$r[id_promo]>
          <table class='list'>
          <tr>
			<td class='left' width=100>Nama</td>
			<td class='left'><input type=text name='nama' size=60 value='$r[nama]'></td></tr>		
          <tr>
			<td class='left'>Alamat</td>
			<td  class='left'><textarea name='alamat' style='width: 100%; height: 250px;'>$r[alamat]</textarea> </td>
		  </tr>
		  <tr>
			<td class='left'>No. Identitas</td>
			<td class='left'><input type='text' name='noidentitas' value='$r[noidentitas]' size='35' /></td>
		  </tr> 
		  <tr>
			<td  class='left'>No Telpon</td> 
			<td  class='left'><input type=text name='no_telpon' value=$r[no_telpon] size=35 /></td></tr>
		  <tr>
			<td class='left'>Judul Buku</td>
			<td class='left'><input type=text name='judul_buku' size='35' value='$r[judul_buku]' /></td>
		  </tr>
		  <tr>
			<td class='left'>Nama Toko</td>
			<td class='left'><input type='text' name='nama_toko' size='35' value='$r[nama_toko]' /></td>
		  </tr>
		  <tr>
			<td class='left'>No Struk</td>
			<td class='left'><input type=text name='no_struk' size='35' value='$r[no_struk]'></td>
		  </tr>
		  <tr>
			<td  class='left'>Struk / Bukti Pembelian</td>
			<td><img src='../joimg/promo/$r[gambar]'></td>
		  </tr>
		  <tr>
			<td class='left'>Dilihat</td>
			<td>";				
				if($r['publish']=='Y'){
					echo "<input type='radio' name='publish' value='Y' checked>Yes";
					echo "<input type='radio' name='publish' value='N'>No";
				}else{
					echo "<input type='radio' name='publish' value='Y'>Yes";
					echo "<input type='radio' name='publish' value='N' checked>No";
				}
		echo "</td>
		  </tr>
          <tr><td colspan=2  class='left'>
			<input type=submit class='butt' value=Update>
            <input type=button class='butt' value=Batal onclick=self.history.back()></td></tr>
         </table></form>";
    break;  
}//end switch

}//end if else
?>
