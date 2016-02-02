


	
<div class="container">
  <div class="row">
  <div class="col-sm-12">
    <h1>Gallery</h1>
    <div class="row">
    <?php
    $gal=mysql_query("SELECT * FROM gallery  ORDER BY id_gallery DESC LIMIT 12");
    while($data=mysql_fetch_array($gal)){
    ?>
      <div class="col-lg-3 col-sm-4 col-xs-6"><a class="edit-record" data-id="<?php echo $data['id_gallery']; ?>" href="#"><img class="thumbnail img-responsive" src="joimg/gallery/s_<?php echo $data['gambar']; ?>"></a></div>
    <?php
    }
    ?>
     </div>
    </div>
    </div>
</div>

<div class="modal" id="myModal" role="dialog">
  <div class="modal-dialog">
  <div class="modal-content">
	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		<h3 class="modal-title"></h3>
	</div>
	<div class="modal-body">
		<div id="modalCarousel" class="carousel">
 
          <div class="carousel-inner">
         
          </div>
          
          <a class="carousel-control left" href="#modaCarousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
          <a class="carousel-control right" href="#modalCarousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
          
        </div>
	</div>
	<div class="modal-footer">
		<button class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
   </div>
  </div>
</div>
