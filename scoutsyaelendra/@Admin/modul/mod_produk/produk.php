<?php
session_start();
 if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_produk/aksi_produk.php";
switch($_GET['act']){
  // Tampil Produk
  default:
    echo "<h2 class='hLine'>Pengaturan Produk</h2>
          <input type=button class='butt' value='Tambah Produk' onclick=\"window.location.href='?module=produk&act=addProduk';\">";
    echo "<div class='srcBox'>
			<div id='kotakcari'>
			<form method='post' action='media.php?module=buku&act=caribuku'>
				<input type='search' style='height:25px;font-size:14px;width:200px'class='itext' name='search' size='40' placeholder='Masukkan Nama Produk'>
				<input type='submit' name='submit' value='Cari' title='Cari'>
			</form>
			</div>
		</div>";
	echo "<table class='list'>
          <thead>
			  <tr>
				<td class='center'>No.</td>
				<td class='center'>Nama Produk</td>
				<td class='center'>Kategori Produk</td>
				<td class='center'>Sub Kategori Produk</td>
				<td class='center'>Stok</td>
				<td class='center'>Tgl.Update</td>
				<td colspan='2' class='center'>Aksi</td>
			  </tr>
		  </thead>";

	//paging
    $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
    $url = "?module=$_GET[module]&";
    $limit = 10;
    $startpoint = ($page * $limit) - $limit;     
    $table = "produk";
	
	if(isset($_GET['page'])){
		$ahpage = "&hpage=$_GET[page]";
	}else if(empty($_GET['page'])){
		$ahpage = "";
	}
	
    $tampil = mysql_query("SELECT * FROM produk WHERE id_kategori!=46 AND id_kategori!=47 ORDER BY id_produk DESC LIMIT {$startpoint}, {$limit}");
  
    $no = $startpoint+1;
    while($r=mysql_fetch_array($tampil)){
		$sub=mysql_fetch_array(mysql_query("SELECT * FROM sub_kategori WHERE id_sub_kategori='$r[id_sub_kategori]'"));
				
      $tanggal=tgl_indo($r['tgl_terbit']);
	  
      $tgl_update=tgl_indo($r['tgl_update']);
      $tgl_indo2=tgl_indo2($r['tgl_update']);
      $harga=format_rupiah($r['harga']);
      echo "<tr><td>$no</td>
                <td class='left'>$r[judul]</td>";
				
               echo "<td class='left'>";
				
				$kat=mysql_query("SELECT * FROM kategori_produk WHERE id_kategori='$r[id_kategori]'");
				$k=mysql_fetch_array($kat);
			    echo "$k[nama_kategori]";
			   echo "</td>";
                echo "<td align=center>$sub[nama]</td>";
                echo "<td align=center>$r[stok]</td>";
                echo "<td>$tgl_indo2</td>
		            <td><a href=?module=produk&act=editProduk&id=$r[id_produk]$ahpage><img src='images/add-icon.gif'></a></td> 
		            <td><a href=$aksi?module=produk&act=del&id=$r[id_produk]&nama_file=$r[gambar]$ahpage><img src='images/hr.gif'></a></td>
		        </tr>";
      $no++;
    }
    echo "</table>";
	echo pagination($table,$limit,$page, $url);
 
    break;
/*	
  case "caribuku":
  
    $kata = $_POST['search'];
    echo "<h2 class='hLine'>Cari Produk Buku</h2><p style='color:red; font-style: italic;'>Jika setelah produk di update terjadi error, tekan F5 pada keyboard ";
	echo "<span style='margin-bottom: 20px; height: 50px;'></span>";
    echo "<div class='srcBox2'>
			<div id='kotakcari2'>
			<form method='post' action='media.php?module=buku&act=caribuku'>
				<input type='search' style='height:25px;font-size:14px;width:200px'class='itext' name='search' size='40' placeholder='Masukkan Judul Buku'>
				<input type='submit' name='submit' value='Cari' title='Cari'>
			</form>
			</div>
		</div>";
	echo "<table class='list'>
          <thead>
			  <tr>
				<td class='center'>No.</td>
				<td class='center'>Judul Buku</td>
				<td class='center'>Kategori Buku</td>
				<td class='center'>Best Seller</td>
				<td class='center'>Stok</td>
				<td class='center'>Tgl.Terbit</td>
				<td colspan='2' class='center'>Aksi</td>
			  </tr>
		  </thead>";

    $tampil = mysql_query("SELECT * FROM buku WHERE id_kategori!=46 AND id_kategori!=47 AND judul like '%$kata%' ");
  
    $no = $startpoint+1;
	
	if(isset($_GET['page'])){
		$ahpage = "&hpage=$_GET[page]";
	}else if(empty($_GET['page'])){
		$ahpage = "";
	}
    while($r=mysql_fetch_array($tampil)){
      $tanggal=tgl_indo($r['tgl_terbit']);
      $harga=format_rupiah($r['harga']);
      echo "<tr><td>$no</td>
                <td class='left'>$r[judul]</td>";
				
               echo "<td class='left'>";
				
				$kat=mysql_query("SELECT * FROM kategori_buku WHERE id_kategori='$r[id_kategori]'");
				$k=mysql_fetch_array($kat);
			    echo "$k[nama_kategori]";
			   
			   echo "</td>";
				if($r['bestseller']=='Y'){
				echo "<td align=center>Yes</td>";
				}else{
				echo "<td align=center>No</td>";
				}
                echo "<td align=center>$r[stok]</td>
                <td>$tanggal</td>
		            <td><a href=?module=buku&act=editBook&id=$r[id_buku]$ahpage><img src='images/add-icon.gif'></a></td> 
		            <td><a href=$aksi?module=buku&act=del&id=$r[id_buku]&nama_file=$r[gambar]$ahpage><img src='images/hr.gif'></a></td>
		        </tr>";
      $no++;
    }
    echo "</table>";
 
    break;
  */
  case "addProduk":
  ?>
  

		<script type="text/javascript" src="../js/jquery-1.9.1.min.js"></script>
		
		<script type="text/javascript">
			$(document).ready(function(){
			//apabila terjadi event onchange terhadap object <select id=comboPropinsi>
			$("#id_kategori").change(function(){
			var prop = $("#id_kategori").val();
			$.ajax({
			url: "modul/mod_produk/ajax.php",
			data: "op=generatecontent&prop="+prop,
			cache: false,
			success: function(msg){
			//jika data sukses diambil dari server kita tampilkan
			//di <select id=comboKabupaten>
			$("#id_sub_kategori").html(msg);
			}
			});
			});
			});
		</script>
<?php
    echo "<h2 class='hLine'>Tambah Produk</h2>
          <form method=POST action='$aksi?module=produk&act=input' enctype='multipart/form-data'>
          <table class='list'>
          <tr>
			<td class='left'>Nama Poduk</td>
			<td class='left'><input type=text name='nama_produk' size=60></td>
		  </tr>";
		  
          echo "<tr>
			<td class='left'>Kategori</td>
			<td class='left'>";
	//kategori buku		
            $tampil=mysql_query("SELECT * FROM kategori_produk WHERE hapus='Ya' ORDER BY nama_kategori");
            $cek=mysql_num_rows($tampil);
				if($cek<='0'){ 
					echo "<b style='color:red;'>Belum ada Kategori Produk!</b>
					<input type=button class='butt' value='Tambahkan Kategori' onclick=\"window.location.href='?module=produk&act=addCat';\">";
				} else {
							echo "<select name='id_kategori' id='id_kategori'><option value=0 selected>--- Pilih Kategori ---</option>";
							
							while($r=mysql_fetch_array($tampil))
							{
								echo "<option value=$r[id_kategori]>$r[nama_kategori]</option>";				
							}
							echo "</select>";
						}
    echo "</td></tr>";
	echo "
			<tr>
				<td class='left'>Sub Category</label></td>
				<td class='left'>
					<select id='id_sub_kategori' name='id_sub_kategori' >
						<option value ='' selected>Tidak Ada Sub Kategori</option>
					</select>
				</td>
			</tr>";

	echo "<tr>
			<td class='left'>Harga</td>
			<td class='left'>Rp.<input type=text name='harga' size=25> *<i>Tanpa tanda titik (.), cth; 55000</i></td></tr>
		  <tr>
			<td class='left'>Diskon</td>
			<td class='left'><input type='text' name='diskon' size='15' /> *<i>Tanpa tanda persen(%), cth;10 atau 5 atau 25, dst</i>
		  </tr>
		  <tr>
			<td class='left'>Stok</td>
			<td class='left'><input type=text name='stok' size=10></td>
		  </tr>
		  <tr>
			<td class='left'>Berat</td>
			<td class='left'><input type=text name='berat' size=10> (kilogram)</td>
		  </tr>
          <tr>
			<td class='left'>Deskripsi</td>
			<td>  <br />Jika Textarea tidak muncul, harap hapus Cookies / History Browser anda
<br><textarea id='jogmce' name='deskripsi' style='width: 100%; height: 350px;'></textarea></td></tr>
          <tr>
			<td class='left'>Gamba r</td>
			<td class='left'><input type=file name='fupload' size=40> <br />Tipe gambar harus JPG/JPEG dan ukuran minimal : 340px <br>Sebelum menguplod gambar harap perhatikan nama gambar/photo, nama tidak boleh mengandung karakter khusus seperti '#, *, $, @, !, +, [, ], dll'</td>
		  </tr>

          <tr>
			<td colspan=2 class='left'>
			<input type=submit class='butt' value=Simpan>
            <input type=button class='butt' value=Batal onclick=self.history.back()></td>
		  </tr>
          </table></form>";
     break;

  case "editProduk":
  ?>
		<script type="text/javascript" src="../js/jquery-1.9.1.min.js"></script>
		
		<script type="text/javascript">
			$(document).ready(function(){
			//apabila terjadi event onchange terhadap object <select id=comboPropinsi>
			$("#id_kategori").change(function(){
			var prop = $("#id_kategori").val();
			$.ajax({
			url: "modul/mod_produk/ajax.php",
			data: "op=generatecontent&prop="+prop,
			cache: false,
			success: function(msg){
			//jika data sukses diambil dari server kita tampilkan
			//di <select id=comboKabupaten>
			$("#id_sub_kategori").html(msg);
			}
			});
			});
			});
		</script>
	
	<?php
    $edit = mysql_query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
    $tgl  = explode("-", $r['tgl_terbit']);
    $tanggal = $tgl[2];
    $bulan 	= $tgl[1];
    $tahun = $tgl[0];

    echo "<h2 class='hLine'>Edit Detail Produk</h2>
          <form method=POST enctype='multipart/form-data' action=$aksi?module=produk&act=update>
          <input type=hidden name=id value=$r[id_produk]>
		  <input type='hidden' name='hpage' value='$_GET[hpage]'>
          <table class='list'>
          <tr>
			<td class='left' width=100>Nama Produk</td>
			<td class='left'><input type=text name='nama_produk' size=60 value='$r[judul]'></td></tr>			
          <tr>
			<td class='left' width=100>Best Seller</td>
			<td class='left'>";
			if($r['bestseller']=='Y'){
				echo"<input type=radio name='bestseller' value='Y' checked> Ya";
				echo"<input type=radio name='bestseller' value='N'> No";
			}else{
				echo"<input type=radio name='bestseller' value='Y'> Ya";
				echo"<input type=radio name='bestseller' value='N' checked> No";
			}
			echo"&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp; *<i>Best Seller yang tampil di halaman home dan menu best seller di sidebar website</i></td></tr>	
          <tr>
			<td class='left' width=100>Just Arrived</td>
			<td class='left'>";
			if($r['new_release']=='Ya'){
				echo"<input type=radio name='new_release' value='Ya' checked> Ya";
				echo"<input type=radio name='new_release' value='No'> No";
			}else{
				echo"<input type=radio name='new_release' value='Ya'> Ya";
				echo"<input type=radio name='new_release' value='No' checked> No";
			}
			echo"&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp; *<i>just arrived yang tampil di halaman home dan menu just arrived sidebar website</i></td></tr>
      
	
         <tr>
			<td class='left'>Kategori</td>
			<td class='left'><select name='id_kategori' id='id_kategori'>";
		
		//kategori buku
          $tampil=mysql_query("SELECT * FROM kategori_produk WHERE hapus='Ya' ORDER BY nama_kategori ASC");
          if ($r['id_kategori']==0){
            echo "<option value=0 selected>- Pilih Kategori -</option>";
          }   

          while($w=mysql_fetch_array($tampil)){
            if ($r['id_kategori']==$w['id_kategori']){
              echo "<option value=$w[id_kategori] selected>$w[nama_kategori]</option>";
            }
            else{
              echo "<option value=$w[id_kategori]>$w[nama_kategori]</option>";
            }
          }
	
	echo "<tr>
				<td class='left'>Sub Category</label></td>
				<td class='left'>
					<select id='id_sub_kategori' name='id_sub_kategori' >";
					
					$tampils=mysql_query("SELECT * FROM sub_kategori WHERE id_sub_kategori=$r[id_sub_kategori]");
					$sub=mysql_fetch_array($tampils);
						echo "<option value ='$sub[id_sub_kategori]' selected>$sub[nama]</option>";
				echo"</select>
				</td>
			</tr>";

    echo "<tr>
			<td class='left'>Harga</td>
			<td  class='left'><input type=text name='harga' value=$r[harga] size='10' /> *<i>Tanpa tanda titik (.), cth; 55000</i></td>
		  </tr>
		  <tr>
			<td class='left'>Diskon</td>
			<td class='left'><input type='text' name='diskon' value='$r[diskon]' size='8' /> *<i>Tanpa tanda persen(%), cth;10 atau 5 atau 25, dst</td>
		  </tr> 
		  <tr>
			<td  class='left'>Stok</td> 
			<td  class='left'><input type=text name='stok' value=$r[stok] size=8 /></td></tr>
		  <tr>
			<td class='left'>Berat</td>
			<td class='left'><input type=text name='berat' size='10' value='$r[berat]' /> (kilogram)</td>
		  </tr>
		  <tr>
			<td  class='left'>Sinopsis</td>
			<td><br />Jika Textarea tidak muncul, harap hapus Cookies / History Browser anda
<br> <textarea name='deskripsi' id='jogmce' style='width: 100%px; height: 350px;'>$r[deskripsi]</textarea></td>
		  </tr>
          <tr>
			<td  class='left'>Gambar</td>
			<td  class='left'>  
			<img src='../joimg/produk/s_$r[gambar]'><br>Tipe gambar harus JPG/JPEG dan ukuran minimal : 340px <br>Sebelum menguplod gambar harap perhatikan nama gambar/photo, nama tidak boleh mengandung karakter khusus seperti '#, *, $, @, !, +, [, ], dll'</td>
		  </tr>
          <tr>
			<td  class='left'>Ganti Gbr</td>
			<td  class='left'><input type=file name='fupload' size=30> *)</td></tr>
          <tr><td colspan=2  class='left'>*) Apabila gambar tidak diubah, dikosongkan saja.</td></tr>
          <tr><td colspan=2  class='left'>
			<input type=submit class='butt' value=Update>
            <input type=button class='butt' value=Batal onclick=self.history.back()></td></tr>
         </table></form>";
    break;  
//======================================================================================================================================================================
    
    
    //show category disini
	case "addCat":
	echo "<h2 class='hLine'>Kategori Produk</h2>";
	echo "<form method='POST' action='$aksi?module=produk&act=inputCat'>
			<table class='list'><tr>
			<td valign='middle' colspan='3' class='left'>
			<input type='text' name='judul' size='35' />
			<input type='submit' class='butt' title='Tambah Kategori' value='[+]Kategori' /></td>
			</tr></table></form>";
		
		$sql = mysql_query("SELECT * FROM kategori_produk WHERE hapus='Ya' ORDER BY nama_kategori");
		$no =1;
		echo "<table class='list'>
		<tr><td width='70'>No.</td> <td>Nama Kategori</td> <td colspan='2'>Aksi</td></tr>";
		while($s=mysql_fetch_array($sql)){
		  echo "<tr><td>$no.</td>
					<td class='left'>$s[nama_kategori]</td>
					<td width='50'>
						<a href=?module=produk&act=editCat&id=$s[id_kategori] title='edit'><img src='images/add-icon.gif'></a> 
					</td>
					<td width='50'>
						<a href='$aksi?module=produk&act=hapusCat&id=$s[id_kategori]' title='hapus'><img src='images/cross.gif'></a>
					</td>
					</tr>";
		  $no++;
		}
		echo "</table>";
	break;

	case "editCat":
	$edit = mysql_query("SELECT * FROM kategori_produk WHERE id_kategori='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
    echo "<h2 class='hLine'>Edit Kategori &raquo $r[nama_kategori]</h2>
          <form method=POST enctype='multipart/form-data' action=$aksi?module=produk&act=updateCat>
          <input type=hidden name=id value=$r[id_kategori]>
          <table class='list'>";
	 echo "<tr>
	<td  class='left' valign='middle'>Nama Kategori</td> 
	<td class='left'><input type=text name='judul' size=60 value='$r[nama_kategori]'> </td>
	</tr>";

	echo  "<tr>
			<td class='left' colspan=2>
			<input class='butt' type=submit value=Update>
            <input class='butt' type=button value=Batal onclick=self.history.back()></td></tr>
         </table></form>";
	break;
		
}//end switch

}//end if else
?>