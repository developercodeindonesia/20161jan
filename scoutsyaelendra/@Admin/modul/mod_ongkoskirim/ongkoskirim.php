<?php
session_start();
 if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_ongkoskirim/aksi_ongkoskirim.php";
switch($_GET['act']){
  // Tampil Ongkos Kirim
  default:
    echo "<h2 class='hLine'>Ongkos Kirim</h2>
          <input type=button class='butt' value='Tambah Ongkos Kirim' 
          onclick=\"window.location.href='?module=ongkoskirim&act=tambahongkoskirim';\">";
    echo "<div class='srcBox3'>
			<div id='kotakcari3'>
			<form method='post' action='media.php?module=ongkoskirim&act=pencarian'>
				<input type='search' style='height:25px;font-size:14px;width:200px'class='itext' name='search' size='40' placeholder='Masukkan Masukkan Nama Kota'>
				<input type='submit' name='submit' value='Cari' title='Cari'>
			</form>
			</div>
		</div>
          <table class='list'>
          <thead>
			<tr><td class='center'>No.</td>
				<td class='center'>Nama Kota</td>
				<td class='center'>Propinsi</td>
				<td class='center'>Jasa Pengiriman</td>
				<td class='center'>Ongkos Kirim</td>
				<td class='center'>Aksi</td>
			</tr></thead>"; 

	//paging
    $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
    $url = "?module=$_GET[module]&";
    $limit = 10;
    $startpoint = ($page * $limit) - $limit;     
    $table = "kota";
	
	if(isset($_GET['page'])){
		$ahpage = "&hpage=$_GET[page]";
	}else if(empty($_GET['page'])){
		$ahpage = "";
	}
	
    $tampil=mysql_query("SELECT * FROM kota,mod_kurir where kota.id_kurir=mod_kurir.id_kurir ORDER BY mod_kurir.nama_kurir,kota.id_kota DESC LIMIT {$startpoint}, {$limit}");
    $no = $startpoint+1;
    while ($r=mysql_fetch_array($tampil))
    {
		//get propinsi
		$p=mysql_fetch_array(mysql_query("SELECT * FROM propinsi WHERE id='$r[id_propinsi]'"));
       $ongkos = format_rupiah($r['ongkos_kirim']);
       echo "<tr>
			<td>$no.</td>
            <td class='left'>$r[nama_kota]</td>
			<td class='left'>$p[propinsi]</td>            
	     <td>$r[nama_kurir]</td>
             <td align=left>$ongkos</td>
             <td><a href=?module=ongkoskirim&act=editongkoskirim&id=$r[id_kota]><b>Edit</b></a> | 
	               <a href=$aksi?module=ongkoskirim&act=hapus&id=$r[id_kota]><b>Hapus</b></a>
             </td></tr>";
      $no++;
    }
    echo "</table>";
	echo pagination($table,$limit,$page, $url);
    break;
	
	
  case "pencarian":
    echo "<h2 class='hLine'>Ongkos Kirim</h2><p style='color:red; font-style: italic;'>Jika setelah produk di update terjadi error, tekan F5 di keyboard </p>
          <input type=button class='butt' value='Tambah Ongkos Kirim' 
          onclick=\"window.location.href='?module=ongkoskirim&act=tambahongkoskirim';\">";
    echo "<div class='srcBox'>
			<div id='kotakcari'>
			<form method='post' action='media.php?module=ongkoskirim&act=pencarian'>
				<input type='search' style='height:25px;font-size:14px;width:200px'class='itext' name='search' size='40' placeholder='Masukkan Nama Kota'>
				<input type='submit' name='submit' value='Cari' title='Cari'>
			</form>
			</div>
		</div>
          <table class='list'>
          <thead>
			<tr><td class='center'>No.</td>
				<td class='center'>Nama Kota</td>
				<td class='center'>Propinsi</td>
				<td class='center'>Jasa Pengiriman</td>
				<td class='center'>Ongkos Kirim</td>
				<td class='center'>Aksi</td>
			</tr></thead>"; 
    $tampil=mysql_query("SELECT * FROM kota where nama_kota like '%$_POST[search]%' ");
    $no=1;
    while ($r=mysql_fetch_array($tampil))
    {
		$ongkir=format_rupiah($r['ongkos_kirim']);
		//get propinsi
		$propinsi=mysql_fetch_array(mysql_query("SELECT * FROM propinsi WHERE id='$r[id_propinsi]'"));
	   
		//get kurir
		$kurir=mysql_fetch_array(mysql_query("SELECT * FROM mod_kurir WHERE id_kurir='$r[id_kurir]'"));
	   
       echo "<tr>
			<td>$no.</td>
            <td class='left'>$r[nama_kota]</td>
			<td class='left'>$propinsi[propinsi]</td>            
			<td>$kurir[nama_kurir]</td>
             <td align=left>$ongkir</td>
             <td><a href=?module=ongkoskirim&act=editongkoskirim&id=$r[id_kota]><b>Edit</b></a> | 
	               <a href=$aksi?module=ongkoskirim&act=hapus&id=$r[id_kota]><b>Hapus</b></a>
             </td></tr>";
      $no++;
	 }
    echo "</table>";
    break;
  
  // Form Tambah Ongkos Kirim
  case "tambahongkoskirim":
    echo "<h2 class='hLine'>Tambah Ongkos Kirim</h2>
          <form method=POST action='$aksi?module=ongkoskirim&act=input'>
          <table class='list'>";
    
    //get propinsi
    echo " <tr>
			<td class='left'>Propinsi</td>
			<td class='left'> : 
          <select name='propinsi'>
            <option value='' selected>- Pilih Propinsi -</option>";
            $tampil=mysql_query("SELECT * FROM propinsi ORDER BY propinsi ASC");
            while($r=mysql_fetch_array($tampil)){
                echo "<option value=$r[id]>$r[propinsi]</option>";
    }
    echo"</select></td></tr>";
    echo "<tr>
			<td class='left'>Nama Kota</td>
			<td class='left'> : <input type=text name='nama_kota' class='msgBox' size='35' /></td></tr>
          <tr>
			<td class='left'>Ongkos Kirim</td>
			<td class='left'> : <input type=text name='ongkos_kirim' size='35' class='msgBox'> <i>Tanpa tanda titik(.) cth; 55000 </i> </td>
		  </tr>
		  <tr>
			<td class='left'>Jasa Pengiriman</td>
			<td class='left'> : 
          <select name='perusahaan'>
            <option value='' selected>- Pilih Jasa Pengiriman -</option>";
            $tampil=mysql_query("SELECT * FROM mod_kurir ORDER BY nama_kurir");
            while($r=mysql_fetch_array($tampil)){
                echo "<option value=$r[id_kurir]>$r[nama_kurir]</option>";
            }
    echo "</select></td></tr>
          <tr>
			<td class='left' colspan='2'>
				<input type=submit name=submit class='butt' value=Simpan>
                <input type=button class='butt' value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;
  
  // Form Edit Ongkos Kirim
  case "editongkoskirim":
    $edit=mysql_query("SELECT * FROM kota,mod_kurir where kota.id_kurir=mod_kurir.id_kurir AND kota.id_kota='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2 class='hLine'>Edit Ongkos Kirim</h2>
          <form method=POST action=$aksi?module=ongkoskirim&act=update>
          <input type=hidden name=id value='$r[id_kota]'>
          <table clas='list'>
          <tr>
			<td class='left'>Nama Kota</td>
			<td class='left'> : <input type=text name='nama_kota' value='$r[nama_kota]'></td></tr>
          <tr>
			<td class='left'>Ongkos Kirim</td>
			<td class='left'> : <input type=text name='ongkos_kirim' value='$r[ongkos_kirim]' size=7></td></tr>
          <tr>
			<td class='left'>Jasa Pengiriman</td>
			<td class='left'> : 
          <select name='perusahaan'>
            <option value=$r[id_kurir]>$r[nama_kurir]</option>";
            $tampil=mysql_query("SELECT * FROM mod_kurir ORDER BY nama_kurir");
            while($r2=mysql_fetch_array($tampil)){
                echo "<option value=$r2[id_kurir]>$r2[nama_kurir]</option>";
            }
    echo "</select></td></tr>
	  <tr><td colspan=2><input type=submit class='butt' value=Update>
                            <input type=button class='butt' value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;  
}
}
?>