<!DOCTYPE html>
<html lang="en">
<?php
include_once('head_file.php'); 
?>

<body style="background-color:#ffffff">
		<div class="container">
		<div class="row">
					
			<div class="row">
				<div class="login-box">
					<div class="icons">
						<a href="index.html"><i class="halflings-icon home"></i></a>
						<a href="#"><i class="halflings-icon cog"></i></a>
					</div>
					<h2>Login to your account</h2>
					
					<?php echo form_open('admin_login');?>

					<fieldset>
							<div class="input-prepend" title="Username">
								<span class="add-on"><i class="halflings-icon user"></i></span>
								<input class="form-control" name="txt_email" id="txt_email" type="text" placeholder="type email"/>
							</div>
							<br>
							<div class="clearfix"></div>

							<div class="input-prepend" title="Password">
								<span class="add-on"><i class="halflings-icon lock"></i></span>
								<input class="form-control" name="txt_pwd" id="txt_pwd" type="password" placeholder="type password"/>
							</div>
							<br>
							<div class="clearfix"></div>
							
							<!--<label class="remember" for="remember"><input type="checkbox" id="remember" />Remember me</label>-->

							<div class="button-login">	
								<button type="submit" class="btn btn-primary">Login</button>
							</div>
							<div class="clearfix"></div>
					</form>
					<!--<hr>
					<h3>Forgot Password?</h3>
					<p>
						No problem, <a href="#">click here</a> to get a new password.
					</p>	-->
				</div><!--/span-->
			</div><!--/row-->
			

	</div><!--/.fluid-container-->
	
		</div><!--/fluid-row-->
	
		
</body>
</html>
