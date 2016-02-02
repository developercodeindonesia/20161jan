<?php
	include ('inc/sidebar.php');
?>
<div class="features_items"><!--features_items-->
	
	<?php
	$kat=mysql_query("SELECT * FROM kategori_buku WHERE id_kategori='$_GET[id]'");
	
	$k=mysql_fetch_array($kat);

	echo '<h2 class="title text-center">'.$k['nama_kategori'].'</h2>';

	$page   = new pagingKategori;
	$batas  = 12;
	$posisi = $page->cariPosisi($batas);
	
	$buk=mysql_query("SELECT * FROM buku WHERE id_kategori=$k[id_kategori] ORDER BY id_buku DESC LIMIT $posisi,$batas");
	$cek =mysql_num_rows($buk);
	if(!$cek){
		echo "<div class='rBox'><p>Belum ada buku</div>";
	}
	while($p=mysql_fetch_array($buk))
	{
	$disc     	= ($p['diskon']/100)*$p['harga'];
	$hrgadic    = $p['harga']-$disc;
	?>
	<div class="col-sm-3">
		<div class="product-image-wrapper">
			<div class="single-products">
				<div class="productinfo text-center">
					<div class="batas"><img src="joimg/buku/s_<?php echo $p['gambar']; ?>" alt="<?php echo $p['judul']; ?>" /></div>
						<span class="hargaawala">Rp. <?php echo format_rupiah($p['harga']); ?>,-</span><br/>
						<span class="diskona">Diskon <?php echo $p['diskon']; ?>%</span><br/>
						<h2>Rp. <?php echo format_rupiah($hrgadic); ?>,-</h2>
					<p class="batasp"><?php echo $p['judul']; ?></p>
					<a href="<?php echo 'cart.php?mod=basket&act=add&id='.$p['id_buku']; ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
				</div>
				<div class="product-overlay">
					<a href="buku-<?php echo $p['id_buku']; ?>-<?php echo $p['judul_seo']; ?>.html">
					<div class="overlay-content">
						<h2>Rp. <?php echo format_rupiah($hrgadic); ?>,-</h2>
						<p class="batasp"><?php echo $p['judul']; ?></p>
						<a href="<?php echo 'cart.php?mod=basket&act=add&id='.$p['id_buku']; ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
					</div>
					</a>
				</div>
					<?php if($p['new_release']=='Ya'){ ?>
					<img src="joimg/home/new.png" class="new" alt="">
					<?php } ?>
			</div>
			
		</div>
	</div>
	<?php
	}
	$jmldata     = mysql_num_rows(mysql_query("SELECT * FROM buku WHERE id_kategori=$k[id_kategori]"));
	$jmlhalaman  = $page->jumlah($jmldata, $batas);
	$linkHalaman = $page->navHalaman($_GET['halaman'], $jmlhalaman); 
	?>
	<div class="pagingzi">
		<center><?php echo $linkHalaman; ?></center>
	</div>
</div><!--features_items-->