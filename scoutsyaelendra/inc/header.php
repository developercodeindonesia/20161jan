	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
					<!--
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> (0274) </a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> info@tokorohanionline.com</a></li>
							</ul>
						</div>
					-->
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<div style="float: left;">
									<li class="menuatas"><a href="profil-perlengkapan-pramuka-pmr-sekolah-pecinta-alam">&nbsp;Profil | </a></li>
									<li class="menuatas"><a href="event-perlengkapan-pramuka-pmr-sekolah-pecinta-alam">&nbsp;Event | </a></li>
									<li class="menuatas"><a href="testinomi-perlengkapan-pramuka-pmr-sekolah-pecinta-alam">&nbsp;Testimoni | </a></li>
									<li class="menuatas"><a href="download-perlengkapan-pramuka-pmr-sekolah-pecinta-alam">&nbsp;Download </a></li>
								</div>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-5" style="margin-left: -15px;">
						<div class="logo pull-left">
							<a href="perlengkapan-pramuka"><img src="joimg/home/logo_scoutsyaelendra.png" alt="Toko Rohani Online" width="100%"/></a>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li><a href="konfirmasi"><i class="glyphicon glyphicon-import"></i> Konfirmasi Pembayaran</a></li>
								<li><a href="cart-step1"><i class="fa fa-crosshairs"></i> Checkout</a></li>
								<li><a href="cart"><i class="fa fa-shopping-cart"></i> Cart</a></li>
							<?php //if(isset($_SESSION['namalengkap'])){ ?>
						<!--		<li><a href="logout.php"><i class="fa fa-lock"></i> Logout</a></li> -->
							<?php // }else{ ?>
							<!--	<li><a href="login.html"><i class="fa fa-lock"></i> Login</a></li> -->
							<?php //} ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9 bgk">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="perlengkapan-pramuka" class="active">Home</a></li>
								<li><a href="produk-perlengkapan-pramuka-pmr-sekolah-pecinta-alam">Produk</a></li>
								<li><a href="cara-pesan-perlengkapan-pramuka-pmr-sekolah-pecinta-alam">Cara Pesan</a></li>
								<li><a href="kontak-kedai-perlengkapan-pramuka-pmr-sekolah-pecinta-alam">Kontak Kami</a></li>
                                <li><a href="foto-perlengkapan-pramuka-pmr-sekolah-pecinta-alam">Gallery</a></li>
								<li><a href="artikel-perlengkapan-pramuka-pmr-sekolah-pecinta-alam">Artikel</a></li>
							</ul>
						</div>
					</div>
					<div class="formkhusus1">
					<div class="col-sm-3 col-xs-12 ">
						<div class="search_box pull-right">
						<form action="search.php" method="GET" class="fz">
							<input type="text" placeholder="Search" name="kata"/>
						</form>
						</div>
					</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
		
		<div class="formkhusus">
		<section>
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<form action="" method="POST" class="fz">
							<select name="kat">
								<option value="judul">Judul</option>
								<option value="penulis">Penulis</option>
								<option value="kategori">Kategori</option>
							</select>
							<input type="text" placeholder="Search"/>
						</form>
					</div>
				</div>
			</div>
		</div>
		</section>
		</div>
		</div>
		
	</header><!--/header-->