<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#katbuku").change(function(){
		var kat = $("#katbuku").val();
		if(kat == '3'){
			$('#search').html("<select name='search' class='srcSelect _capitalize a' style='height:23px;font-size:9px;width:170px;'><?php $q=mysql_query("select * from penerbit ORDER BY nama_penerbit"); while($h=mysql_fetch_array($q)){?> <option value='<?php echo $h['id_penerbit'] ?>'><?php echo $h['nama_penerbit'] ?></option> <?php } ?></select>");
		}else if(kat == '4'){
			$('#search').html("<select name='search' class='srcSelect _capitalize a' style='height:23px;font-size:9px;width:170px;'><?php $q=mysql_query("select * from kategori_buku ORDER BY nama_kategori"); while($h=mysql_fetch_array($q)){?> <option value='<?php echo $h['id_kategori'] ?>'><?php echo $h['nama_kategori'] ?></option> <?php } ?></select>");		
		}else{
			$('#search').html("<input type='search' style='height:10px;font-size:9px;width:170px' class='itext' name='search' size='40' placeholder='Masukkan keyword'>");				
		}
	});
});
</script>
<style type="text/css">
    .a option {
        height: 20px;
    }
    </style>
<div id='kotakcari'>
<form method="post" action="media.php?module=buku&act=caribuku">
	<input type="search" style='height:25px;font-size:9px;width:170px'class='itext' name="search" size="40" placeholder="Masukkan keyword">
	<input type="submit" name="submit" value='Cari' title='Cari'>
</form>
</div>
<!--<script type="text/javascript">
$(document).ready(function(){
	$("#katbuku").change(function(){
		var kat = $("#katbuku").val();
		if(kat == '3'){
			$('#search').html("<select name='keyword'><option value='P01'>PENULIS SATU</option><option value='P02'>PENULIS DUA</option></select>");
		}else if(kat == '4'){
			$('#search').html("<select name='keyword'><option value='K01'>KATEGORI SATU</option><option value='K02'>KATEGORI DUA</option></select>");		
		}else{
			$('#search').html("<input type='search' name='search' size='40' placeholder='Masukkan keyword pencarian'>");				
		}
	});
});
</script>

<form method='POST' action='prosesCari'>
<input type='submit' class='ibutt' value='' title='Cari' />
<td id="search"><input name='search' class='itext' type='text' placeholder='Kata kunci atau judul buku...' /></td>
<?php 
	echo "<select name='katbuku' id='katbuku' class='srcSelect _capitalize'>";
	echo "<option value='0' selected> Cari berdasarkan </option>";
	echo "<option value='1'> Judul </option>";
	echo "<option value='2'> Penulis </option>";
	echo "<option value='3'> Penerbit </option>";
	echo "<option value='4'> Kategori </option>";
	echo "<option value='5'> ISBN </option>";
	echo "</select>";
?>
</form>-->