<div class="col-sm-3" style="margin-bottom: 20px;">
	<div class="left-sidebar">
	
	
	<div class="left-sidebar">
		<h2>Category</h2>
		<div class="panel-group category-products" id="accordian"><!--category-productsr-->
			
			
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title newss"><a href="just-arrived" style="color: black;font-weight: bold;">Produk Baru</a></h4>
				</div>
			</div>
            <!--
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title newss2"><a href="best-seller" style="color: black;font-weight: bold;">Produk Pramuka</a></h4>
				</div>
			</div>
            -->
		<?php
	
		$kateg=mysql_query("SELECT * FROM kategori_produk WHERE hapus='Ya' ORDER BY id_kategori ASC");
		while($k=mysql_fetch_array($kateg)){
			$sql = mysql_query("SELECT id_sub_kategori FROM sub_kategori WHERE id_kategori='$k[id_kategori]' ");
			$ketemu=mysql_num_rows($sql);
			
			if($ketemu<=0){
		?>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title"><a href="<?php echo "$k[id_kategori]-kategori-$k[kategori_seo]"; ?>"><?php echo $k['nama_kategori']; ?></a></h4>
				</div>
			</div>
		<?php
			}else{
		?>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordian" href="#<?php echo $k['kategori_seo']; ?>">
							<span class="badge pull-right"><i class="fa fa-plus"></i></span>
							<?php echo $k['nama_kategori']; ?>
						</a>
					</h4>
				</div>
				<div id="<?php echo $k['kategori_seo']; ?>" class="panel-collapse collapse">
					<div class="panel-body">
						<ul>
						<?php
						$subka=mysql_query("SELECT * FROM sub_kategori WHERE id_kategori='$k[id_kategori]' ORDER BY nama ASC");
						while($sub=mysql_fetch_array($subka)){
						?>
							<li><a href="<?php echo "$sub[id_sub_kategori]-sub-kategori-$sub[nama_seo]"; ?>"><?php echo $sub['nama']; ?></a></li>
						<?php
						}
						?>
						</ul>
					</div>
				</div>
			</div>
		<?php
			}
		}
		?>
	
	
		<?php
		$banner=mysql_query("SELECT * FROM mod_banner ORDER BY id_banner ASC");
		while($bann=mysql_fetch_array($banner)){
		?>
		<div class="shipping text-center"><!--shipping-->
			<a href="<?php echo $bann['url']; ?>" target="_blank"><img src="joimg/banner/<?php echo $bann['gambar']; ?>" alt="<?php echo $bann['judul']; ?>" title="<?php echo $bann['judul']; ?>"/></a>
		</div><!--/shipping-->
		<?php
		}
		?>
	</div>
</div>
</div>
</div>