	<footer id="footer"><!--Footer-->
		<div class="footer-widget"  style="margin-bottom: 20px;">
			<div class="container">
				<div class="row">
					<div class="col-sm-3 hmax">
						<div class="single-widget">
							<h2>Support</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="profil-perlengkapan-pramuka-pmr-sekolah-pecinta-alam">Company Profile</a></li>
								<li><a href="artikel-perlengkapan-pramuka-pmr-sekolah-pecinta-alam">Artikel</a></li>
								<li><a href="kontak-kedai-perlengkapan-pramuka-pmr-sekolah-pecinta-alam">Contact Us</a></li>
								<li><a href="cara-pesan-perlengkapan-pramuka-pmr-sekolah-pecinta-alam">Cara Pesan</a></li>
								<li><a href="cara-pembayaran">Cara Pembayaran</a></li>
								<li><a href="download-perlengkapan-pramuka-pmr-sekolah-pecinta-alam">Download</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 hmax">
						<div class="single-widget">
							<h2>PAYMENT</h2>
							<ul class="nav nav-pills nav-stacked bank">
							<?php
							$kaos = mysql_query("SELECT * FROM mod_bank ORDER BY id_bank ASC");
							while($ka=mysql_fetch_array($kaos)){
							?>
								<li><table border="0">
									<tr>
										<td rowspan="4"><img src="joimg/banner/<?php echo $ka['gambar']; ?>" width='57px'></td>
									</tr><tr>
										<td><div class="namabank"><?php echo $ka['nama_bank']; ?></div></td>
									</tr><tr>
										<td><div class="norek"><?php echo $ka['no_rekening']; ?></div></td>
									</tr><tr>
										<td><div class="pemilik"><?php echo $ka['pemilik']; ?></div></td>
									</tr></table>
								</li>
							<?php
							}
							?>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 hmax">
						<div class="single-widget">
							<h2>SHIPPING</h2>
							<ul class="nav nav-pills nav-stacked">
							<?php
							$kaos = mysql_query("SELECT * FROM mod_kurir ORDER BY id_kurir");
							while($ka=mysql_fetch_array($kaos)){
							?>
								<li><img src="joimg/banner/<?php echo $ka['gambar']; ?>" width="70%"></li>
							<?php
							}
							?>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 hmax">
						<div class="single-widget">
							<h2>Contact</h2>
							<!--<?php
							$contaks = mysql_query("SELECT * FROM mod_page WHERE id_page=5");
							$contakss=mysql_fetch_array($contaks);
								echo "$contakss[isi]";
							?>-->
							<p>Gg. Lusi No. 25 Kauman, Kutosari, Kebumen<br />
                                ( Selatan Masjid Agung Kebumen<br /> + 100 m  )
                            <br/>
							<br />
							SMS/CALL: 081391071010</p>
							
							<h2>Sosial Media</h2>
							<ul class="nav nav-pills nav-stacked sosialmed">
							<?php
							$kaos = mysql_query("SELECT * FROM mod_sosial ORDER BY id");
							while($ka=mysql_fetch_array($kaos)){
							?>
								<li><a href="<?php echo $ka['link']; ?>" target="_blank"><img src="joimg/<?php echo $ka['gambar']; ?>" width="100%"></a></li>
							<?php
							}
							?>
							</ul>
							
							<h2>Yahoo Messenger</h2>
							<?php
							
							$sql = mysql_query("SELECT * FROM mod_ym");
							$cek = mysql_num_rows($sql);
							if($cek > 0){
								while($s=mysql_fetch_array($sql))
								{
									echo "
									<p align='left' class='ymCap _capitalize'>$s[nama]</p><p align='left' ><a href='ymsgr:sendIM?$s[username]' title='chat dengan $s[nama]'>
					             			 <img src='http://opi.yahoo.com/online?u=$s[username]&amp;m=g&amp;t=1' border='0' ></a> </p>";
								}
							} else { echo "tidak ada ym chat";}
							echo "</div>";
							?>
<!--<br><button type='button' class='purechat-button-expand'>Chat with us!</button>-->
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © <a href="http://scoutsyaelendra.com/">scoutsyaelendra 2015</a> | Developed by <span><a target="_blank" href="http://www.jogjasite.com">Jogjasite</a></span></p>
					<p class="pull-left"><?php include "stat.php";?></p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->