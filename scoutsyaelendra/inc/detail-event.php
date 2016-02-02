
				<?php
				$kaos = mysql_query("SELECT * FROM event WHERE aktif='YA' AND id_event='$_GET[id]' ");
				$ka=mysql_fetch_array($kaos);
				?>
				<div class="col-sm-9">
					<div class="blog-post-area">
						<div class="single-blog-post">
							<h3><?php echo $ka['judul']; ?></h3>
							<div class="post-meta">
								<ul>
									<li><i class="fa fa-user"></i><?php echo $ka['oleh']; ?></li>
									<li><i class="fa fa-calendar"></i><?php echo $ka['tanggal']; ?></li>
								</ul>
							</div>
							<div style="width: 50%; float: left; margin-right: 20px;">
								<a href=""><img src="joimg/event/<?php echo $ka['gambar']; ?>" alt=""></a>
							</div>
							<?php echo $ka['isi']; ?>
						</div>
					</div><!--/blog-post-area-->
				</div>	