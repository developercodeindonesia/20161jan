<?php
	include ('inc/sidebar.php');
?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-70752162-1', 'auto');
  ga('send', 'pageview');

</script>
<div class="col-sm-9 padding-right">
	<div class="features_items"><!--features_items-->
		<h2 class="title text-center">Produk</h2>
		<?php
		$new_book = mysql_query("SELECT * FROM produk ORDER BY id_produk DESC LIMIT 8");
		while($p=mysql_fetch_array($new_book)){
		?>
		<div class="col-sm-3">
			<div class="product-image-wrapper">
				<div class="single-products">
					<div class="productinfo text-center">
						<div class="batas"><img  src="joimg/produk/<?php echo $p['gambar']; ?>" alt="<?php echo $p['judul']; ?>" /></div>
							<h2>Rp. <?php echo format_rupiah($p['harga']); ?>,-</h2>
						<p class="batasp"><?php echo $p['judul']; ?></p>
						<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
					</div>
					<div class="product-overlay">
						<a href="benda-devosi-<?php echo $p['id_produk']; ?>-<?php echo $p['judul_seo']; ?>.html">
						<div class="overlay-content">
							<h2>Rp. <?php echo format_rupiah($p['harga']); ?>,-</h2>
							<p class="batasp"><?php echo $p['judul']; ?></p>
							<a href="<?php echo 'cart.php?mod=basket&act=add&id='.$p['id_produk']; ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
						</div>
						</a>
					</div>
				</div>
				
			</div>
		</div>
		<?php
		}
		?>
		<div class="pagingzi">
			<div class="kananpojok">
			<a href="benda-devosi">Selengkapnya</a>
			</div>
		</div>
		
	</div><!--features_items-->
    



</div>