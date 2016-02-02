<?php
include '../josys/koneksi.php';
$sql = mysql_query("SELECT * FROM mod_bank ORDER BY id_bank");
	$no=1;

	echo "<table class='tBank' width='400px' style='margin-left: 40px;'>";
while($s=mysql_fetch_array($sql))
{
	echo "
	<tr>
		<td class='_center numBox' width='20'>$no.</td>
		<td class='_left radioBox'> <input type='radio' value='$s[id_bank]' name='nobank' /><b>$s[nama_bank]</b></td></tr>
	<tr>
		<td></td>
		<td class='ketBox'>$s[keterangan]</td>
	</tr>
	<tr>
		<td></td>
		<td class='ketBox'>No.Rekening $s[no_rekening]</td>
	</tr>
	<tr>
		<td></td>
		<td class='ketBox'>A/n. $s[pemilik]</td>
	</tr>
	<tr><td colspan='2'></td></tr>";
$no++;
}
?>
