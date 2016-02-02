<?php
	//start session
	ob_start();
	session_start();
	//error_reporting(0);
	//require system files
	include "josys/koneksi.php";
	include "josys/library.php";
	include "josys/fungsi_rupiah.php";
	include "josys/fungsi_indotgl.php";
	include "josys/fungsi_pagingzi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="">
    <title><?php include "title.php"; ?></title>
	<meta name="keywords" content="<?php include "keyword.php"; ?>">
	<meta name="description" content="<?php include "diskripsi.php"; ?>">    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
    	
    <link rel="shortcut icon" href="joimg/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
	
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/price-range.js"></script>
	<script src="js/jquery.prettyPhoto.js"></script>
	<script src="js/main.js"></script>
	
	<!-- Slider -->
    <link href="js/slider/themes/1/js-image-slider.css" rel="stylesheet" type="text/css" />
    <script src="js/slider/themes/1/js-image-slider.js" type="text/javascript"></script>
	<!-- Slider -->
	
	<style>
	#slider{
		background-size: 100% 300px;
	}
	</style>
	
</head><!--/head-->

<body>
	
	<?php
		include ('inc/header.php');
	?>
	
	<section>
		<div class="container">
			<div class="row">
<?php
	include ('inc/sidebar.php');
?>
<div class="features_items"><!--features_items-->
	<h2 class="title text-center">Search</h2>
	<?php
	$kata = $_GET['kata'];

	$page   = new pagingSearchs;
	$batas  = 12;
	$posisi = $page->cariPosisi($batas);
	

$query_table	= "SELECT kategori_produk.nama_kategori, produk.* FROM kategori_produk, produk WHERE kategori_produk.nama_kategori LIKE '%".$kata."%' OR produk.judul LIKE '%".$kata."%' LIMIT $posisi,$batas";
//echo $query_table; exit;
$sql = mysql_query("$query_table");
$ketemu=mysql_num_rows($sql);
	
if($ketemu<<0){
	
	$pages=mysql_query("$query_table");
	
	while($p=mysql_fetch_array($pages)){
	?>
	<div class="col-sm-3">
		<div class="product-image-wrapper">
			<div class="single-products">
				<div class="productinfo text-center">
					<div class="batas"><img src="joimg/produk/s_<?php echo $p['gambar']; ?>" alt="<?php echo $p['judul']; ?>" /></div>
						<span class="hargaawala">Rp. <?php echo format_rupiah($p['harga']); ?>,-</span><br/>
						<span class="diskona">Diskon <?php echo $p['diskon']; ?>%</span><br/>
						<h2>Rp. <?php echo format_rupiah($p['harga']); ?>,-</h2>
					<p class="batasp"><?php echo $p['judul']; ?></p>
					<a href="<?php echo 'cart.php?mod=basket&act=add&id='.$p['id_produk']; ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
				</div>
				<div class="product-overlay">
					<a href="produk-<?php echo $p['id_produk']; ?>-<?php echo $p['judul_seo']; ?>.html">
					<div class="overlay-content">
						<h2>Rp. <?php echo format_rupiah($p['harga']); ?>,-</h2>
						<p class="batasp"><?php echo $p['judul']; ?></p>
						<a href="<?php echo 'cart.php?mod=basket&act=add&id='.$p['id_produk']; ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
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

		$querytable	= "SELECT kategori_produk.nama_kategori, produk.* FROM kategori_produk, produk WHERE kategori_produk.nama_kategori LIKE '%".$kata."%'";
	
	
	$jmldata     = mysql_num_rows(mysql_query("$querytable"));
	$jmlhalaman  = $page->jumlah($jmldata, $batas);
	$linkHalaman = $page->navHalaman($_GET['halaman'], $jmlhalaman); 
	
	?>
	<div class="pagingzi">
		<center><?php echo $linkHalaman; ?></center>
	</div>
<?php
}else{
	echo '<br><br><h2 class="title text-center">Tidak Ada Produk</h2>';
}
?>
	
</div><!--features_items-->

			</div>
		</div>
	</section>
	
	<?php
		include ('inc/footer.php');
	?>
	
</body>
</html>