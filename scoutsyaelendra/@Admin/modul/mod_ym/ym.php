<?php
$aksi="modul/mod_ym/aksi_ym.php";
switch($_GET[act]){
  // Tampil YM
  default:
    echo "<h2 class='hLine'>Yahoo Messenger Status</h2>
          <input type=button class=butt value='Tambahkan User' 
          onclick=\"window.location.href='?module=ym&act=tambahym';\">
          <table class='list'>
          <thead>
			<tr><td class='center'>No.</td><td class='center'>Nama</td><td class='center'>Username</td><td class='center' colspan='2'>Aksi</td></tr></thead>"; 
    $tampil=mysql_query("SELECT * FROM mod_ym ORDER BY id DESC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr>
    			 <td>$no.</td>
				 <td class='left'>$r[nama]</td>
				 <td class='left'>$r[username]</td>
				 <td width='45'><a href=?module=ym&act=editym&id=$r[id]><img src='images/add-icon.gif' title='edit' /></a></td>
				 <td width='45'><a href=$aksi?module=ym&act=hapus&id=$r[id]><img src='images/hr.gif' title='hapus' /></a></td>
			 </tr>";
      $no++;
    }
    echo "</table>";
	echo "";
    break;
  
  // Form Tambah YM
  case "tambahym":
    echo "<h2 class='hLine'>Tambah User Yahoo Messenger</h2>
          <form method=POST action='$aksi?module=ym&act=input'>
          <table class='list'>
          <tr>
			<td class='left'>Nama</td>
			<td class='left'> : <input type=text name='nama'></td></tr>
		  <tr>
			<td class='left'>Username</td>
			<td class='left'> : <input type=text name='username'></td></tr>
          <tr>
			<td class='left' colspan=2>
				<input type=submit name=submit class=butt value=Simpan>
                <input type=button class=butt value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;
  
  // Form Edit YM  
  case "editym":
    $edit=mysql_query("SELECT * FROM mod_ym WHERE id='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2 class='hLine'>Edit Yahoo Messenger</h2>
          <form method=POST action=$aksi?module=ym&act=update>
          <input type=hidden name=id value='$r[id]'>
          <table>
          <tr><td>Nama</td><td> : <input type=text name='nama' value='$r[nama]'></td></tr>
		  <tr><td>Username</td><td> : <input type=text name='username' value='$r[username]'></td></tr>
          <tr><td colspan=2><input type=submit class=butt value=Update>
                            <input type=button class=butt value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;  
}
?>
