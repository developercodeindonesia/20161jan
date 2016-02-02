				<div class="col-sm-9">
					<div class="blog-post-area">
						<h2 class="title text-center">Artikel</h2>
						
						<?php
						$page   = new pagingCetakMurah;
						$batas  = 5;
						$posisi = $page->cariPosisi($batas);
						$kaos = mysql_query("SELECT * FROM event WHERE aktif='YA' ORDER BY id_event DESC LIMIT $posisi,$batas");
						while($ka=mysql_fetch_array($kaos)){
						?>
						<div class="single-blog-post">
							<h3><?php echo $ka['judul']; ?></h3>
							<div class="post-meta">
								<ul>
									<li><i class="fa fa-user"></i><?php echo $ka['oleh']; ?></li>
									<li><i class="fa fa-calendar"></i><?php echo $ka['tanggal']; ?></li>
								</ul>
							</div>
							<div class="imgkaos">
								<a href="cetak-murah-<?php echo $ka['id_event']; ?>"><img src="joimg/event/s_<?php echo $ka['gambar']; ?>" alt=""></a>
							</div>
							<?php echo $ka['isi']; ?><br>
							<a class="btn btn-primary" href="detail-event-scoutsyaelendra-<?php echo $ka['id_event']; ?>">Read More</a>
						</div>
						<?php
						}
                        
						$jmldata     = mysql_num_rows(mysql_query("SELECT * FROM event WHERE aktif='YA'"));
						$jmlhalaman  = $page->jumlah($jmldata, $batas);
						$linkHalaman = $page->navHalaman($_GET['halaman'], $jmlhalaman); 
						?>
						<div class="pagingzi" style="margin-top: 20px;">
							<center><?php echo $linkHalaman; ?></center>
						</div>
					</div>
				</div>