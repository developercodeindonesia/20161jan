
	
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<form action="proses-login" method="POST">
							<input type="text" placeholder="username" name="username"/>
							<input type="password" placeholder="Password" name="password"/>
							<button type="submit" class="btn btn-default">Login</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<form action="prosesReg" method="POST">
							<input type="text" placeholder="Name" name="nama_lengkap" required/>
							<input type="text" placeholder="Username" name="username" required/>
							<input type="email" placeholder="Email Address" name="email" required/>
							<input type="password" placeholder="Password" name="password" required/>
							<input type="phone" placeholder="Phone" name="no_telp" required/>
							
							<img class='captcha' src='captcha.php' />
							<input type='text' name='kode' onclick='this.select()' placeholder='Masukan kode...' /> 
							<button type="submit" class="btn btn-default">Signup</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	