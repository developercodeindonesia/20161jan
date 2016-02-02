<?php
session_start();
 if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
  echo "<script>window.alert('Session Expired!');window.location=('../')";
}
else{
$aksi="modul/mod_menu/aksi_menu.php";
switch($_GET['act']){
  // Tampil Menu Utama
  default:
    echo "<h2 class='hLine'>Pengaturan Link Menu</h2>
          <input class='butt' type=button value='Tambah Menu' 
          onclick=\"window.location.href='?module=menu&act=add';\">
          <table class='list'>
          <tr><td>No.</td><td>Nama Menu</td><td>Link</td><td>Urutan</td><td>Aktif</td><td colspan='2'>Aksi</td></tr>"; 
    $tampil=mysql_query("SELECT * FROM mainmenu ORDER BY urutan") or die(mysql_error());
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
		
		echo "<tr><td>$no</td>
             <td class='left'>$r[nama_menu]</td>
             <td  class='left'>$r[link]</td>
             <td  class='left'>$r[urutan]</td>";
		echo"<td>";
			
			if($r['aktif']=='Y')
			{ echo "<b style='color:green;'>Ya</b>"; }
			else { echo "<b style='color:red;'>Tidak</b>"; }
		
		echo "</td>
			<td>
			 <a href=?module=menu&act=editmenu&id=$r[id_main]><img src=images/add-icon.gif></a>
            </td>
			 <td>
			 <a href=$aksi?module=menu&act=hapus&id=$r[id_main]><img src=images/cross.gif></a>
             </td></tr>";
      $no++;
    }
    echo "</table>";
    echo "<div id=paging></div><br />";
    break;
  
  // Form Tambah Menu Utama
  case "add":
    echo "<h2 style='padding:10px 5px;'>Tambah Menu Utama</h2>
          <form method=POST action='$aksi?module=menu&act=input'>
          <table class='list'>
          <tr>
			<td width='70' class='left'>Nama Menu</td>
			<td class='left'> : <input type=text name='nama_menu'></td></tr>
          <tr>
			<td class='left'>Link</td>
			<td  class='left'> : <input type=text name='link'></td></tr>
          <tr>
          <tr>
			<td class='left'>Urutan</td>
			<td  class='left'> : <input type=text name='urutan' size='10'></td></tr>
		  <td colspan=2 class='left'>
			<input class='butt' type=submit name=submit value=Simpan>
            <input class='butt' type=button value=Batal onclick=self.history.back()>
		  </td>
		  </tr>
          </table></form>";
     break;
  
  // Form Edit Menu Utama
  case "editmenu":
    $edit=mysql_query("SELECT * FROM mainmenu WHERE id_main='$_GET[id]'");
    $r=mysql_fetch_array($edit);
    
	echo "<h2 class='hLine'> Edit Menu </h2>
          <form method=POST action=$aksi?module=menu&act=update>
          <input type=hidden name=id value='$r[id_main]'>
          <table class='list'>
          <tr>
			  <td class='left'>Nama Menu</td>
			  <td class='left' valign='middle'><input type=text name='nama_menu' value='$r[nama_menu]' size='55' /></td>
		  </tr>
		  
          <tr>
		  <td class='left'>Link</td>
		  <td class='left'><input type=text name='link' value='$r[link]' size='55' /></td></tr>
		  <tr>
			  <td class='left'>urutan</td>
			  <td class='left' valign='middle'><input type=text name='urutan' value='$r[urutan]' size='10' /></td>
		  </tr>";
    if ($r['aktif']=='Y'){
      echo "<tr><td class='left'>Aktif</td> 
			<td class='left'>
				<input type=radio name='aktif' value='Y' checked>Y  
                <input type=radio name='aktif' value='N'> N</td></tr>";
    }
    else{
      echo "<tr><td class='left'>Aktif</td> 
				<td class='left'>
				<input type=radio name='aktif' value='Y'>Y  
                <input type=radio name='aktif' value='N' checked>N</td></tr>";
    }

    echo "<tr><td class='left' colspan=2>
			<input class='butt' type=submit value=Update>
            <input class='butt' type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;  
}
}
?>
