<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login | inoday Discover</title>
	<link rel="stylesheet" href="style.css">
	<link rel="icon" type="image/gif" href="assets/img/logo-fevicon.png">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
  	<link rel="stylesheet" href="assets/css/bootstrap.css">
  	<script src="assets/js/jquery.js"></script>
  	<link rel="stylesheet" href="assets/css/font-awesome.css">
</head>
<body class="loginrapper">
	<div class="wrapper">
		<div class="container">
			<div class="loginwrapper">
				<div class="leftlogin">
					<img src="assets/img/inoday-logo.png" class="img-fluid">
					<p>World's Leading Provider of Cloud Business Management ERP Software NetSuite lionizes <b>inoday India's #1 NetSuite Solution Provider</b></p>
					<a href="https://inoday.com/contactus/" class="btn" style="background: #f3541a;color:#ffffff" target="_blank">Contact Us</a>
				</div>
				<div class="rightlogin">
					<h3>Login</h3>
					<form class="" method="POST" action="functions/login.php">
						<div class="form-group">
							<label>Username / Email</label>
							<input type="text" name="usemail" required class="form-control borderstrip">
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" name="userpass" required class="form-control borderstrip">
						</div>
						<div class="clearfix">
							<input type="submit" name="login" class="btn btn-dark float-right" value="Login">
						</div>
					</form>
					<?php
					if(isset($_GET['err']))
					{
						?>
						<div class="alert alert-danger mt-2">Username & Password Wrong.</div>
						<?php
					}
					?>
				</div>

			</div>

		</div>
		<div class="footer">
				<div class="text-center">Powered By <a href="https://inoday.com/" class="text-dark font-weight-bold">inoday Inc. </a> &copy; <?php echo date('Y');?></div>
				
				

			</div>
	</div>
</body>
</html>
