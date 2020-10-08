<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="MDR Information Organizer">
    <meta name="author" content="Aldila">

 <title>Mangli Djaya Raya</title>  

    
  <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/css/bootstrap.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/css/font-awesome.min.css">
  
    <!-- Custom CSS 
    <link href="<?php echo base_url();?>assets/admin/css/login.css" rel="stylesheet">

    <!-- Custom Fonts 
    <link href="<?php echo base_url();?>assets/admin/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/dist/css/AdminLTE.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/dist/css/skins/_all-skins.min.css">	
	
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/iCheck/square/blue.css">
	-->
      <link rel="stylesheet" href="<?php echo base_url();?>assets/calm/css/style.css">
	
	<link rel="shortcut icon" href="<?php echo base_url();?>/assets/admin/img/mio_ver2.ico">


</head>


  <body class="hold-transition login-page">
  <div class="wrapper">
	<div class="container">
		<img src="<?= base_url();?>assets/admin/img/mdr-logo.png" width=150px>
		<h1>Welcome</h1>
		
        <form action="<?= site_url();?>login/logon" method="post">
            <input type="text"  placeholder="Username" name="username" required>
            <input type="password"  placeholder="Password" name="password" required>
			<button type="submit" id="login-button">Login</button>
		</form>
	</div>
	
	<ul class="bg-bubbles">
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
	</ul>
</div>
 <!--
    <div class="login-box">
      <div class="login-logo">
        <a href="<?= site_url();?>">
		<img src="<?= base_url();?>assets/admin/img/mdr-logo.png" width=200px>
		<p><b>Mangli Djaya Raya</b></p>
		</a>
      </div>
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to continue</p>
        <form action="<?= site_url();?>login/logon" method="post">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Username" name="username" required>
            <span class="fa fa-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="password" required>
            <span class="fa fa-lock form-control-feedback"></span>
          </div>
          <div class="row">
	
            <div class="col-xs-offset-8 col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div>
          </div>
        </form>

		<?php
		if(isset($errVar))
		{
		?>
		<p>
                  <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Cannot sign in ! </h4>
                    Check your Username or Password.
                  </div>
		</p>
		<?php
		}
		?>
      </div>
    </div> -->

	
		<!-- jQuery 2.1.4 -->
    <script type="text/javascript" src="<?php echo base_url();?>assets/admin/js/jquery-2.1.3.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/admin/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/admin/iCheck/icheck.min.js"></script>
	
    <script  src="<?php echo base_url();?>assets/calm/js/index.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>

