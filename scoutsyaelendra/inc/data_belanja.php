<?php
// Tampilkan produk-produk yang telah dimasukkan ke keranjang belanja
	$sid = session_id();
	$sql = mysql_query("SELECT * FROM orders_temp, produk WHERE id_session='$sid' AND orders_temp.id_produk=produk.id_produk");
	$ketemu=mysql_num_rows($sql);
	
	  
		echo "
				<h2 class='title text-center' style='margin-top: 30px; float:left;'>Keranjang Belanja</h2>
			  <form method=post action='cart.php?mod=basket&act=update'>";
		
		echo "<table  class='prodCart' width='100%'>";
			echo "<tr><thead>
					<td class='center'>No.</td>
					<td>Produk</td>
					<td>Judul</td>
					<td>Berat</td>
					<td>Jumlah</td>
					<td>Harga</td>
					<td colspan='2'>Sub Total</td>
					</thead>
				</tr><tbody>";
	$no=1;
	while($r=mysql_fetch_array($sql)){

		$disc        = ($r['diskon']/100)*$r['harga'];
		$hargadisc   = number_format(($r['harga']-$disc),0,",",".");
		$subtotal    = ($r['harga']-$disc) * $r['jumlah'];
		$total       = $total + $subtotal;  
		
		$subtotal_rp = format_rupiah($subtotal);
		$total_rp    = format_rupiah($total);
		$harga       = format_rupiah($r['harga']);
		
		
		   echo "
			<tr>
					<td class='vtop center'><b>$no.</b></td>
					<input type=hidden name=id[$no] value=$r[id_orders_temp]>
				  <td class='center'><a href='produk-$r[id_produk]-$r[judul_seo].html' title='$p[judul]'>";
					$eks=explode('.', $r['gambar']);
					error_reporting(E_PARSE);  
					if ($r['gambar']=='' OR $eks[1]=='' OR $eks[1]=='pdf'){
						echo "<img width=50 src='joimg/produk/no-foto.jpg' />";
					}
					else {
						echo "<img width=50 src='joimg/produk/s_$r[gambar]'  /></td>";
					}
			echo "	  <td valign='top'>$r[judul]</td>
				  <td>$r[berat]</td>
				  <td> <input type=text name='jml[$no]' value=$r[jumlah] size=1 onchange=\"this.form.submit()\" onkeypress=\"return harusangka(event)\" style='outline: 1px dotted;'> </td>
				  <td>$hargadisc</td>
				  <td>$subtotal_rp</td>
				  <td align=center><a href='cart.php?mod=basket&act=del&id=$r[id_orders_temp]'>
					<img src=joimg/kali.png border=0 title=Hapus></a>
				  </td>
			  </tr>";
		$no++; 
	  } 
		echo "<tr class='fBg'>
			<td colspan=6 class='right'><b>Total:</b></td>
			<td class='price' colspan='2' style='border-left: 1px solid #fff;'><b>Rp. $total_rp,-</b></td></tr>";
		echo "</tbody></table>";
		echo "</form>";             
	
?>