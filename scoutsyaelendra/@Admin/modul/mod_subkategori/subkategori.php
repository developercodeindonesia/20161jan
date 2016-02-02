<?php
session_start();
 if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_subkategori/aksi_subkategori.php";
switch($_GET['act']){
  // Tampil Produk
  default:
    echo "<h2 class='hLine'>Sub Kategori Produk</h2>
          <input type=button class='butt' value='Tambah Sub Kategori' onclick=\"window.location.href='?module=subkategori&act=addBook';\">";
    echo "<div class='srcBox'>
		</div>";
	echo "<table class='list'>
          <thead>
			  <tr>
				<td class='center'>No.</td>
				<td class='center'>Kategori Produk</td>
				<td class='center'>Judul Sub Kategori Produk</td>
				<td class='center'>Status</td>
				<td colspan='2' class='center'>Aksi</td>
			  </tr>
		  </thead>";
	
    $tampil = mysql_query("SELECT * FROM sub_kategori ORDER BY id_sub_kategori DESC");
  
    $no = $startpoint+1;
    while($r=mysql_fetch_array($tampil)){
      echo "<tr><td>$no</td>";
				
               echo "<td class='left'>";
				
				$kat=mysql_query("SELECT * FROM kategori_produk WHERE id_kategori='$r[id_kategori]'");
				$k=mysql_fetch_array($kat);
			    echo "$k[nama_kategori]";
			   
			   echo "</td>";
                echo "<td class='left'>$r[nama]</td>";
                echo "<td class='left'>$r[status]</td>";
                echo "
		            <td><a href=?module=subkategori&act=editBook&id=$r[id_sub_kategori]><img src='images/add-icon.gif'></a></td> 
		            <td><a href=$aksi?module=subkategori&act=del&id=$r[id_sub_kategori]><img src='images/hr.gif'></a></td>
		        </tr>";
      $no++;
    }
    echo "</table>";
 
    break;
	
  case "addBook":
    echo "<h2 class='hLine'>Tambah Sub Kategori Produk</h2>
          <form method=POST action='$aksi?module=subkategori&act=input' enctype='multipart/form-data'>
          <table class='list'>
          <tr>
			<td class='left'>Judul</td>
			<td class='left'><input type=text name='nama' size=60></td>
		  </tr>";
		  
          echo "<tr>
			<td class='left'>Kategori</td>
			<td class='left'>";
	//kategori buku		
            $tampil=mysql_query("SELECT * FROM kategori_produk WHERE hapus='Ya' ORDER BY nama_kategori");
            $cek=mysql_num_rows($tampil);
			echo "<select name='id_kategori'><option value=0 selected>--- Pilih Kategori ---</option>";
			
			while($r=mysql_fetch_array($tampil))
			{
				echo "<option value=$r[id_kategori]>$r[nama_kategori]</option>";				
			}
			echo "</select>";
    echo "</td></tr>
		  <tr>
			<td class='left'>Status</td>
			<td class='left'>
				<select name='status'>
					<option value='Aktif'>Aktif</option>
					<option value='Tidak Aktif'>Tidak Aktif</option>
				</select>
			</td>
		  </tr>

          <tr>
			<td colspan=2 class='left'>
			<input type=submit class='butt' value=Simpan>
            <input type=button class='butt' value=Batal onclick=self.history.back()></td>
		  </tr>
          </table></form>";
     break;
    
  case "editBook":
    $edit = mysql_query("SELECT * FROM sub_kategori WHERE id_sub_kategori='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2 class='hLine'>Edit Sub Kategori</h2>
          <form method=POST enctype='multipart/form-data' action=$aksi?module=subkategori&act=update>
          <input type=hidden name=id value=$r[id_sub_kategori]>
          <table class='list'>		
          <tr>
			<td class='left'>Kategori</td>
			<td class='left'><select name='id_kategori'>";
		
		//kategori buku
          $tampil=mysql_query("SELECT * FROM kategori_produk WHERE hapus='Ya' ORDER BY nama_kategori ASC");
          if ($r['id_kategori']==0){
            echo "<option value=0 selected>- Pilih Kategori -</option>";
          }   

          while($w=mysql_fetch_array($tampil)){
            if ($r['id_kategori']==$w['id_kategori']){
              echo "<option value=$w[id_kategori] selected>$w[nama_kategori]</option>";
            }else{
              echo "<option value=$w[id_kategori]>$w[nama_kategori]</option>";
            }
          }
		 echo"
          <tr>
			<td class='left' width=200>Nama Sub Kategori</td>
			<td class='left'><input type=text name='nama' size=60 value='$r[nama]'></td></tr>	
			
          <tr><td colspan=2  class='left'>
			<input type=submit class='butt' value=Update>
            <input type=button class='butt' value=Batal onclick=self.history.back()></td></tr>
         </table></form>";
    break;  
		
}//end switch

}//end if else
?>