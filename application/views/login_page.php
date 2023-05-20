<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>CodeIgniter Login</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
</head>
<style>

body {
            padding-top: 20px;
            padding-right: 80px;
            padding-left: 80px;
            font-family: 'Poppins', serif;
        }
	h3 {
		text-align: center;
	}
</style>
<body>
	<div class="container">
		<h1 class="page-header text-center">Mobile Verification System</h1>
		<div class="row">
			<div class="col-sm-4 col-sm-offset-4">
				<div class="login-panel panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title"></span> Login
						</h3>
					</div>
					<div class="panel-body">
						<form method="POST" action="<?php echo base_url(); ?>user/login">
							<fieldset>
								<div class="form-group">
									<input class="form-control" placeholder="Username" name="username" required>
								</div>
								<div class="form-group">
									<input class="form-control" placeholder="Password" type="password" name="password" required>
								</div>

								<div class="form-group">
									<label><input id="chkRemeberme" type="checkbox" name="chkRemeberme" /> Remember me</label>
									<br />
									<br />
									Forgot Password? <a href="frmForgotPassword.aspx">Click here!</a>
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-primary "></span> Login</button>
									<button type="reset" class="btn btn-secondary "></span> Reset</button>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
				<?php
				if ($this->session->flashdata('error')) {
				?>
					<div class="alert alert-danger text-center" style="margin-top:20px;">
						<?php echo $this->session->flashdata('error'); ?>
					</div>
				<?php
				}
				?>
			</div>
		</div>
	</div>
</body>
</html>