				<?php
				$sql = mysql_query("SELECT * FROM mod_page WHERE id_page='$_GET[id]' ");
				$ka=mysql_fetch_array($sql);
				?>
				<div class="col-sm-9">
					<div class="blog-post-area">
						<div class="single-blog-post">
						<h2 class="title text-center"><?php echo $ka['judul']; ?></h2>
							<?php echo $ka['isi']; ?><br>
							
							<?php

							if($_GET['id']==5){
								echo $ka['gambar'];
								echo "<br>";
								
								include "inc/contact.php"; 
							}
							?>
						</div>
					</div><!--/blog-post-area-->
				</div>	