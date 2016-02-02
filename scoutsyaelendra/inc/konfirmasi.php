
	<h2 class="title text-center">Konfirmasi Pembayaran</h2>
	
	<section id="form" style="margin-top: 0px;"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<div class="signup-form"><!--sign up form-->
						<form action="prosesKonf" method="POST">
							<label>No. Order</label>
							<input type="text" name="no" required/>
							<label>Bank Asal</label>
							<input type="text" name="bankasal" required/>
							<label>No. Rekening</label>
							<input type="text" name="norek" required/>
							<label>Atas Nama</label>
							<input type="text" name="an" required/>
							<label>Tanggal Transfer</label><br>
							<div style="margin-left: 50px; margin-bottom: 20px;">
							<label>Tanggal</label>
							<?php
							//combobox tanggal
							echo "<select name='tgl'>";
							for ($tgl=1; $tgl<=31; $tgl++){
							   echo "<option value=\"".$tgl."\">".$tgl."</item>";
							}
							echo "</select>";
							echo "<label>Bulan</label>";
							//combobox bulan
							echo "<select name=\"bln\">";
							for ($bln=1; $bln<=12; $bln++){
								echo "<option value=\"".$bln."\">".$bln."</option>";
							}
							echo "</select>";
						   
							echo "<label>Tahun</label>";
							//combobox tahun
							echo "<select name=\"thn\">";
							for ($thn=2015; $thn>=2010; $thn--){
								echo "<option value=\"".$thn."\">".$thn."</option>";
							}
							echo "</select>"; 
							?>
							</div>
							<label>Jumlah transfer</label>
							<input type="text" name="jml" required/>
							<i>Penulisan tanpa tanda titik; cth: 55000</i><br><br>
							
							<label>Dikirim ke Bank</label>
							<input type="text" name="bank" required/>
							
							
							
							<img class='captcha' src='captcha.php' />
							<input type='text' name='kode' onclick='this.select()' placeholder='Masukan kode...' /> 
							<button type="submit" class="btn btn-default">Submit</button>
						</form>
		
						<br><p>- Selain menggunakan form di atas, konfirmasi pembayaran juga dapat dilakukan melalui email atau telpon yang ada di kontak website kami.</p>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	