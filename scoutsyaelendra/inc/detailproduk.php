	<?php
	$page=mysql_query("SELECT * FROM produk WHERE id_produk=$_GET[id]");
	$p=mysql_fetch_array($page);
	
	$disc     	= ($p['diskon']/100)*$p['harga'];
	$hrgadic    = $p['harga']-$disc;
	//$harga 		= format_rupiah($disc);
	?>
				<div class="col-sm-9 padding-right">
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<img src="joimg/produk/<?php echo $p['gambar']; ?>" alt="" />
							</div>
						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
							<?php if($p['new_release']=='Ya'){ ?>
								<img src="joimg/product-details/new.jpg" class="newarrival" alt="" />
							<?php } ?>
								<h2><?php echo $p['judul']; ?></h2>		
								<p><div class='addthis_toolbox addthis_default_style'>
									<a class='addthis_button_preferred_1'></a>
									<a class='addthis_button_preferred_2'></a>
									<a class='addthis_button_preferred_3'></a>
									<a class='addthis_button_preferred_4'></a>
									<a class='addthis_button_compact'></a>
									<a class='addthis_counter addthis_bubble_style'></a>
								</div>
								<script type='text/javascript' src='http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4f8aab4674f1896a'></script></p>
		  
								<span>
									<span class="hargaawal">Rp. <?php echo format_rupiah($p['harga']); ?>,-</span><br/>
									<span class="diskon">Diskon <?php echo $p['diskon']; ?>%</span><br/>
									<span class="hrgadic">Rp. <?php echo format_rupiah($hrgadic); ?>,-</span>
									<a href="<?php echo 'cart.php?mod=basket&act=add&id='.$p['id_produk']; ?>">
									<button type="button" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</button>
									</a>
								</span>
								<h4>Sinopsis<h4>
								<div class="sinopsis"><?php echo $p['deskripsi']; ?></div>
								<br>
								<h4>Detail Buku</h4>
								<table class="detailbuku">
										<tr>
										<td>Berat</td><td>:</td><td><?php echo $p['berat']; ?> kilogram</td>
									</tr>
								</table>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
					
					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#details" data-toggle="tab">Buku Terkait</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="details" >
							<?php
							if($p['id_sub_kategori']!=0){
								$f=mysql_query("SELECT * FROM produk WHERE id_produk!='$p[id_produk]' AND id_sub_kategori='$p[id_sub_kategori]' ORDER BY id_produk DESC LIMIT 4");
							}else{
								$f=mysql_query("SELECT * FROM produk WHERE id_produk!='$p[id_produk]' AND id_kategori='$p[id_kategori]' ORDER BY id_produk DESC LIMIT 4");
							}
							while ($q=mysql_fetch_array($f)) {
							?>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<a href="buku-<?php echo $q['id_produk']; ?>-<?php echo $q['judul_seo']; ?>.html">
											<div class="productinfo text-center">
											<?php
											$eks=explode('.', $q['gambar']);
											error_reporting(E_PARSE);  
											if ($q['gambar']=='' OR $eks[1]=='' OR $eks[1]=='pdf'){
												echo "<div class='batas'><img class='catImg' src='joimg/no-foto.jpg' border='0' width='110px' /></div>";
											}
											else {
												echo "<div class='batas'><img src='joimg/produk/s_$q[gambar]' alt='$q[judul]' /></div>";
											}
											?>
												<h2>Rp. <?php echo $q['harga']; ?>,-</h2>
												<p><?php echo $q['judul']; ?></p>
											</div>
											</a>
										</div>
									</div>
								</div>
							<?php } ?>
							</div>
							
						</div>
					</div><!--/category-tab-->
					
				</div>