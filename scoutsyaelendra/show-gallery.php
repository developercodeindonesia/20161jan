<?php
require_once('josys/koneksi.php');
$id=$_POST['id'];
$sql="SELECT * FROM gallery WHERE id_gallery='".$id."'";
$result=mysql_query($sql);
$data=mysql_fetch_array($result);
?>
<div class="row">
    <img class="thumbnail img-responsive" src="joimg/gallery/<?php echo $data['gambar'] ?>"/>
</div>