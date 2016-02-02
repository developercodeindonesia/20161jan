<?php
	include ('inc/sidebar.php');
?>
<div class="features_items"><!--features_items-->
	<h2 class="title text-center">Best Seller</h2>
	<?php
	$page   = new pagingBestseller;
	$batas  = 12;
	$posisi = $page->cariPosisi($batas);
	
	$pages=mysql_query("SELECT * FROM buku WHERE bestseller='Y' ORDER BY id_buku DESC LIMIT $posisi,$batas");
	while($p=mysql_fetch_array($pages)){
	?>
	<div class="col-sm-3">
		<div class="product-image-wrapper">
			<div class="single-products">
				<div class="productinfo text-center">
					<div class="batas"><img src="joimg/buku/s_<?php echo $p['gambar']; ?>" alt="<?php echo $p['judul']; ?>" /></div>
						<span class="hargaawala">Rp. <?php echo format_rupiah($p['harga']); ?>,-</span><br/>
						<span class="diskona">Diskon <?php echo $p['diskon']; ?>%</span><br/>
						<h2>Rp. <?php echo format_rupiah($p['harga']); ?>,-</h2>
					<p class="batasp"><?php echo $p['judul']; ?></p>
					<a href="<?php echo 'cart.php?mod=basket&act=add&id='.$p['id_buku']; ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
				</div>
				<div class="product-overlay">
					<a href="buku-<?php echo $p['id_buku']; ?>-<?php echo $p['judul_seo']; ?>.html">
					<div class="overlay-content">
						<h2>Rp. <?php echo format_rupiah($p['harga']); ?>,-</h2>
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
	$jmldata     = mysql_num_rows(mysql_query("SELECT * FROM buku WHERE bestseller='Y'"));
	$jmlhalaman  = $page->jumlah($jmldata, $batas);
	$linkHalaman = $page->navHalaman($_GET['hala'], $jmlhalaman); 
	?>
	<div class="pagingzi">
		<center><?php echo $linkHalaman; ?></center>
	</div>
</div><!--features_items-->