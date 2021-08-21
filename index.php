<?php 
session_start();
error_reporting(0);
//$cryptinstall="crypt/cryptographp.fct.php";
//include $cryptinstall; 
include("dbcon.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include("acuan_title.php");?>
	</head>
	<body style="background:#000000 url(pic/main.jpg) repeat center center ;" >
		<div class="login-box">
			<div class="login-logo">
				<h2 style="color:#EACD12;"><b>SisKA 2.0</b>
				<br><small>Sistem Komputer Akuntansi</small></h2>
			</div>
			
			<div class="login-box-body">
			<?php
				if(!isset($_REQUEST['pesan']))
				{	$pesan="Silahkan Anda Login";	}
				else
				{	$pesan=$_REQUEST['pesan'];}
			?>
		<!--<p class="login-box-msg"><b><?php echo($pesan);?></b></p>-->
			<p class="login-box-msg"><img src="pic/logo.png" class="img pull-center"><br/><br/><b><?php echo($pesan);?></b></p>
			<form action="loginproses.php" method="post" name="form1">
				<div class="form-group has-feedback">
					<input type="text" class="form-control" name="userid" placeholder="User ID"/>
					<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<input type="password" class="form-control" name="password" placeholder="Password"/>
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				</div>
				
				<div class="row">
					<div class="col-xs-12">&nbsp;</div><!-- /.col -->
					<div class="col-xs-12">
						<button type="submit" class="btn btn-success btn btn-flat pull-right"><i class="glyphicon glyphicon-log-in"></i> Login</button>
						<a href="../index.php" class="btn btn-danger  btn-flat pull-left"><i class="glyphicon glyphicon-home"></i> Batal</a>
					</div><!-- /.col -->
				</div>
			</form>

			<br/>
			<center><p><small><i>Sistem Komputer Akuntansi versi 2.0 - 2021</i></small></p></center>
			
			</div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-green',
          radioClass: 'iradio_square-green',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>