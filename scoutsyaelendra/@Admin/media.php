<?php
session_start();
//error_reporting(0);
if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
  echo "<link href='css/screen.css' rel='stylesheet' type='text/css'><link href='css/reset.css' rel='stylesheet' type='text/css'>
 <center>Anda harus login dulu <br>";
  echo "<a href=index.php><b>LOGIN</b></a></center>";
}
else{
include "../josys/koneksi.php";
include "../josys/library.php";
include "../josys/fungsi_indotgl.php";
include "../josys/fungsi_indotgl2.php";
include "../josys/fungsi_combobox.php";
include "../josys/fungsi_autolink.php";
include "../josys/fungsi_rupiah.php";
include "../josys/class_paging.php";
include "../josys/paging.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SCOUTSYAELENDRA ADMINISTRATOR</title>
<link rel="stylesheet" href="css/reset.css" type="text/css"/>
<link rel="stylesheet" href="css/screen.css" type="text/css"/>
	<link href="css/pagination.css" rel="stylesheet" type="text/css" />
	<link href="css/grey.css" rel="stylesheet" type="text/css" />
<!--[if IE 7]>
	<link rel="stylesheet" type="text/css" href="css/ie7.css" />
<![endif]-->	
<script type="text/javascript" src="js/jquery.js"></script>
<script src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery.visualize.js"></script>
<script src="../tinymcpuk/jscripts/tiny_mce/tiny_mce.js" type="text/javascript"></script>
<script src="../tinymcpuk/jscripts/tiny_mce/jogmce.js" type="text/javascript"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><style type="text/css">
<!--
a:link {
	color: #666666;
}
a:hover {
	color: #666666;
}
-->
</style>
<link rel="shortcut icon" href="../joimg/favicon.ico" />
<script src="js/autocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="js/autocomplete.css">
<script type="text/javascript">
                $(document).ready(
                        function()
                        {      
                                $("#kateg").autocomplete("produk_list.php", {width: 250});
                               
                        });
        </script>

</head>
<body>
<div class="sidebar">
<div class="logo clear">
				<span class="title"></span>	
</div>
	<div class="menu _uppercase">
          <ul>
            <li><a href="?module=home">MENU UTAMA</a>
                <ul>
                  <?php include "menu.php"; ?>
                </ul>
            </li>
			<li>
				<a href="#">Modul Web</a>
				<ul>
					<?php include "menu2.php"; ?>
				</ul>
			</li>
			<li>
				<a href="#">Admin Web</a>
				<ul>
					<li><a href='?module=user'><b>Admin</b></a></li>
					<li><a href='?module=title'><b>Title</b></a></li>
					<li><a href='?module=description'><b>Description</b></a></li>
					<li><a href='?module=keyword'><b>Keyword</b></a></li>
				</ul>
			</li>
          </ul>
    </div>
</div>
	
	<div class="main"> <!-- *** mainpage layout *** -->
		<div class="main-wrap">
			<div class="header clear">
				<ul class="links clear">
				<li><strong>Selamat Datang <?php echo $_SESSION['namalengkapadmin']; ?></strong>&nbsp;:&nbsp;</li>
				<li><a href="../" target="_blank">View Website</a><img src="images/view.gif" alt="" class="icon" /></li>
				<li><a href="logout.php"><img src="images/out.gif" alt="" class="icon" /> <span class="text">Logout</span></a></li>
				</ul>
			</div>
			
			<div class="page clear">			
				<!-- CONTENT BOXES -->			
				<div class="content-box">
					<div style='padding:10px;'>
					<?php include "content.php"; ?>
					</div>
				</div> <!-- end of content-box -->

				<div class="clear">
					<!-- end of content-box -->
				</div><!-- end of page -->
				
				<div class="footer clear">
					<span class="copy"><strong>© <?php echo date('Y'); ?> Copyright Scoutsyaelendra 2015   | Developed by JogjaSite.com </span>
				</div>
			</div>
		</div>
	</div>


</body>
</html>
<?php
}
?>
