
		<div class="features_items"><!--features_items-->
			<h2 class="title text-center">Download</h2>
			
			<div class="col-sm-12">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">No.</td>
							<td class="total">Nama Dokumen</td>
							<td class="total">Download</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
				<?php
					$i = 1;
					$q=mysql_query("SELECT * FROM download");
					while ($r=mysql_fetch_array($q)){
				?>
						<tr>
							<td class="cart_price">
								<p><?php echo "$i"; ?></p>
							</td>
							<td class="cart_price">
								<p><?php echo "$r[nama]";?></p>
							</td>
							<td class="cart_price">
								<p><a href="joimg/berkas/<?php echo "$r[file]"; ?>" download><input type='button' class='butt' value='Download'></a></p>
							</td>
						</tr>
				<?php
					$i++;
					}
				?>
					</tbody>
				</table>
			</div>
		</div>