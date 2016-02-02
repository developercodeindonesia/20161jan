<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="">
    <title><?php include "title.php"; ?></title>
	<meta name="keywords" content="<?php include "keyword.php"; ?>">
	<meta name="description" content="<?php include "diskripsi.php"; ?>">   
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
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
	
	<?php if($_GET['module'] == 'home'){?>
		<section id="slider_old" style="background-size: 100% 300px;"><!--slider-->
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div id="slider" style="background-size: 100% 300px;">
						<?php
						$slider = mysql_query("SELECT * FROM mod_slider ORDER BY id_slider ASC");
						while($sliders=mysql_fetch_array($slider)){
						?>
							<img src="joimg/slider/<?php echo $sliders['gambar']; ?>" alt="<?php echo $sliders['judul']; ?>" width="100%" style="width: 100% height: 380px;" />
						<?php
						} 
						?>
						</div>
					</div>
				</div>
			</div>
		</section><!--/slider-->
	<?php
	}
	?>
  	<section>
  
		<div class="container">
			<div class="row"> 
				<?php
					include ('inc/content.php');
				?>
			</div>
		</div> 
	</section>
	
	<?php
		include ('inc/footer.php');
	?>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
        <script>
        $(function(){
            $(document).on('click','.edit-record',function(e){
                e.preventDefault();
                $("#myModal").modal('show');
                $.post('show-gallery.php',
                    {id:$(this).attr('data-id')},
                    function(html){
                        $(".modal-body").html(html);
                    }   
                );
            });
        });
        </script>
     

</body>
</html>