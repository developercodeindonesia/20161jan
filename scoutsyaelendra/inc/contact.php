<?php
	if( ($_GET['module']=='staticcontent') AND (isset($_POST['aksi'])) ){
				$nama 		= trim($_POST['nama']);
				$email		= trim($_POST['email']);
				$subjek		= trim($_POST['subjek']);
				$message 	= trim($_POST['message']);

				if(empty($nama)) {
					echo'<div class="box info-box">Nama Required</div>';
					echo'<a href="javascript:history.go(-1)"><b>Try Again</b><br/>';
					$err = TRUE;
				}
				if(empty($email)) {
					echo'<div class="box info-box">Email Required</div>';
					echo'<a href="javascript:history.go(-1)"><b>Try Again</b><br/>';
					$err = TRUE;
				}
				if(empty($subjek)) {
					echo'<div class="box info-box">Subject Required</div>';
					echo'<a href="javascript:history.go(-1)"><b>Try Again</b><br/>';
					$err = TRUE;
				}
				if(empty($message)) {
					echo'<div class="box info-box">Message Required</div>';
					echo'<a href="javascript:history.go(-1)"><b>Try Again</b><br/>';
					$err = TRUE;
				}
				if(isset($err)) {
					echo'<a href="javascript:history.go(-1)"><b>Try Again</b><br/>';
				} elseif(empty($err)) {
					if(!empty($_POST['kode'])) {
						if($_POST['kode']==$_SESSION['captcha_session']) {	
						

							$welcome = mysql_query("SELECT extra FROM mod_page WHERE id_page='5'");
							$w=mysql_fetch_array($welcome);
							
							$pesan.="<br /><br /><p>Name : $nama
									 <br /><p>Email : $email
									 <br /><p>Subject : $subjek
									 <br /><p>Message : $message
									 ";

							$subjek="Message From Website Maesindo";

							// Kirim email dalam format HTML
							$dari = "From: $email \n";
							$dari .= "Content-type: text/html \r\n";

							//mail($_POST['email'],$subjek,$pesan,$dari);

							//mail("$w[extra]", $subjek, $pesan, $dari );
							
												
							mysql_query("INSERT INTO hubungi(nama, email, subjek, isi, tanggal, status) 
										 VALUES('$_POST[nama]','$_POST[email]', '$_POST[subjek]', '$_POST[message]', now(), 'Belum Dibaca')");
										 
							echo "<script>alert('Thank For contact us. We will immediately respond.'); window.location = 'kontak-us'</script>";
						} else {							
							echo "<script>alert('Wrong Capcah Code'); window.location = 'kontak-us'</script>";
						}
					} else {
							echo "<script>alert('You have not entered Capcah Code'); window.location = 'kontak-us'</script>";
					}
				}			
	}else{;
				
				?>

				<br><br><br>
	    		<div class="col-sm-12">
	    			<div class="contact-form">
	    				<h2 class="title text-center">Contact Form</h2>
	    				<div class="status alert alert-success" style="display: none"></div>
				    	<form id="main-contact-form" class="contact-form row" name="contact-form" method="post" action="kontak-us">
							<input type="hidden" name="aksi" value="input">
				            <div class="form-group col-md-6">
				                <input type="text" name="nama" class="form-control" required="required" placeholder="Name">
				            </div>
				            <div class="form-group col-md-6">
				                <input type="email" name="email" class="form-control" required="required" placeholder="Email">
				            </div>
				            <div class="form-group col-md-12">
				                <input type="text" name="subjek" class="form-control" required="required" placeholder="Subject">
				            </div>
				            <div class="form-group col-md-12">
				                <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Your Message Here"></textarea>
				            </div>  
				            <div class="form-group col-md-12">
				                <img class='captcha' src='captcha.php' /><input name='kode' onclick='this.select()' placeholder='Enter Code...' type="text"/>
				            </div>                        
				            <div class="form-group col-md-12">
				                <input type="submit" name="submit" class="btn btn-primary pull-right" value="Submit">
				            </div>
				        </form>
	    			</div>
	    		</div>							
		<?php } ?>			