<?php
include ('inc/sidebar.php');
?>
<div class="col-sm-9">          
	   
	   <div id="myCarousel" class="carousel slide">
                 <!-- Indicators -->       
                
                <div class="carousel-inner">
                    
                    <div class="item active">
                        <blockquote>
                          <p> adalah hal yang bena</p>
                          <small>Jonathan Samuel Lumentut 
						  </small>
                        </blockquote>
                    </div>
                      <?php
                    $testi=mysql_query("SELECT * FROM testi limit 5");
                    while($row_testi=mysql_fetch_array($testi)){
                     ?>    
                     <div class="item">
                        <blockquote>
                          <p> <?php echo $row_testi['pesan']; ?></p>
                          <small><?php echo $row_testi['nama']; ?>
						  </small>
                        </blockquote>
                    </div>
                     <?php
                      }
                     ?>
                                          
                </div> 
              
               <div class="carousel-controls">
                  <a class="carousel-control left" href="#myCarousel" data-slide="prev"><span class="fa fa-angle-double-left"></span></a>
                  <a class="carousel-control right" href="#myCarousel" data-slide="next"><span class="fa fa-angle-double-right"></span></a>
              </div>
            </div><!-- End Carousel -->  
       <?php
                //     }
                     ?>
    </div>