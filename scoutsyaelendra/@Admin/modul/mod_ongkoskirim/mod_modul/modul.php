<?php
session_start();
 if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_modul/aksi_modul.php";
switch($_GET['act']){
  // Tampil Modul
  default:
    echo "<table class='list'><thead> 
          <tr>
          <td class='left'>no</td>
          <td class='left'>nama modul</td>
          <td class='left'>keterangan</td>
          </tr></thead><tbody>";
    $tampil=mysql_query("SELECT * FROM modul ORDER BY id_modul");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
      echo "
			<tr><td width='25'>$no.</td>
            <td class='left'><a href='$r[link]'>$r[nama_modul]</a></td>
			<td class='left'>$r[static_content] <a href=$r[link] title='Kelola modul $r[nama_modul]'><img src=images/add-icon.gif title='Kelola modul $r[nama_modul]'/></a></td>
			</tr><tbody>";
            $no++;
    }
    echo "</table>";
    break;

  case "tambahmodul":
    echo "<h2>Tambah Modul</h2>
          <form method=POST action='$aksi?module=modul&act=input'>
          <table class='list'><tbody>
          <tr><td class='left'>Nama Modul</td> <td> : <input type=text name='nama_modul'></td></tr>
          <tr><td class='left'>Link</td>       <td> : <input type=text name='link' size=30></td></tr>
          <tr><td class='left'>Publish</td>    <td> : <input type=radio name='publish' value='Y' checked>Y  
                                         <input type=radio name='publish' value='N'> N</td></tr>
          <tr><td class='left'>Aktif</td>      <td> : <input type=radio name='aktif' value='Y' checked>Y  
                                         <input type=radio name='aktif' value='N'> N</td></tr>
          <tr><td class='left'>Status</td>     <td> : <input type=radio name='status' value='admin' checked>admin 
                                         <input type=radio name='status' value='user'>user</td></tr>
          <tr><td class='left' colspan=2><input type=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </tbody></table></form>";
     break;
 
  case "editmodul":
    $edit = mysql_query("SELECT * FROM modul WHERE id_modul='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2>Edit Modul</h2>
          <form method=POST action=$aksi?module=modul&act=update>
          <input type=hidden name=id value='$r[id_modul]'>
          <table  class='list'><tbody>
          <tr><td class='left'>Nama Modul</td>     <td class='left'> : <input type=text name='nama_modul' value='$r[nama_modul]'></td></tr>
          <tr><td class='left'>Link</td>     <td class='left'> : <input type=text name='link' size=30 value='$r[link]'></td></tr>";
    if ($r[publish]=='Y'){
      echo "<tr><td class='left'>Publish</td> <td class='left'> : <input type=radio name='publish' value='Y' checked>Y  
                                        <input type=radio name='publish' value='N'> N</td></tr>";
    }
    else{
      echo "<tr><td class='left'>Publish</td> <td class='left'> : <input type=radio name='publish' value='Y'>Y  
                                        <input type=radio name='publish' value='N' checked>N</td></tr>";
    }
    if ($r[aktif]=='Y'){
      echo "<tr><td class='left'>Aktif</td> <td class='left'> : <input type=radio name='aktif' value='Y' checked>Y  
                                      <input type=radio name='aktif' value='N'> N</td></tr>";
    }
    else{
      echo "<tr><td class='left'>Aktif</td> <td class='left'> : <input type=radio name='aktif' value='Y'>Y  
                                      <input type=radio name='aktif' value='N' checked>N</td></tr>";
    }
    if ($r[status]=='user'){
      echo "<tr><td class='left'>Status</td> <td class='left'> : <input type=radio name='status' value='user' checked>user  
                                       <input type=radio name='status' value='admin'> admin</td></tr>";
    }
    else{
      echo "<tr><td class='left'>Status</td> <td class='left'> : <input type=radio name='status' value='user'>user  
                                       <input type=radio name='status' value='admin' checked>admin</td></tr>";
    }
    echo "<tr><td class='left'>Urutan</td>       <td class='left'> : <input type=text name='urutan' size=1 value='$r[urutan]'></td></tr>
          <tr><td class='left' colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </tbody></table></form>";
    break;  
}
}
?>
