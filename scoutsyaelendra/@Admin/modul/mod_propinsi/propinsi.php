<?php
session_start();
 if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
	$aksi="modul/mod_propinsi/aksi_propinsi.php";
	switch($_GET['act']){
		default:
		echo "<h2 class='hLine'>Daftar Propinsi</h2>";
		echo "<form method='post' action='$aksi?module=propinsi&act=input'>
		<input type='text' name='propinsi' class='msgBox' size='35' placeholder='input propinsi' />
		<input type='submit' value='submit' class='butt' /></form>";
		echo "<table class='list'>
		<thead>
			<tr><td class='center' width='100'>No.</td>
				<td class='left'>Propinsi</td>
				<td class='center'>Aksi</td>
			</tr>
		</thead>";
		$tampil=mysql_query("SELECT * FROM propinsi ORDER BY propinsi ASC");
		$no=1;
		while($r=mysql_fetch_array($tampil))
		{
			echo "<tr><td class='center'>$no.</td>
			<td class='left'>
			 <form method='post' action='$aksi?module=propinsi&act=update'>
			  <input type='hidden' name='id' value='$r[id]' />
			  <input type='text' class='msgBox' name='propinsi' value='$r[propinsi]' size='25' /> <input type='submit' class='butt' value='update' />
			 </form>
			</td>
			<td width='45' class='center'><a title='delete' href='$aksi?module=propinsi&act=del&id=$r[id]'><img src='images/cross.gif' /></a></td></tr>";
			$no++;
		}
		echo "</table>";
		break;
		
		//add propinsi
		case "addProp":
		break;
		
		//edit propinsi
		case "editProp";
	}	
}
?>
