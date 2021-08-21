<?php
//error_reporting(0);
// boc: -- cek sesi user --
session_start();
$cek_user=$_SESSION['simkeu'];
if(!$cek_user)
{	$pesan="mohon ulangi login..."; $menuju="../index.php?pesan=" . $pesan; header("location:$menuju");	}
// eoc: -- cek sesi user --
?>
<!DOCTYPE html>
<html>
<head>
	<?php include("../modpgw/acuan_title.php");?>
</head>
<body class="hold-transition skin-blue-light sidebar-mini">
	<div class="wrapper">
		<!-- header -->
		<?php include("../acuan_header.php");?>
		<!-- ./ header -->
		<!-- sidebar -->
		<?php include("../modpgw/acuan_sidebar.php");?>
		<!-- ./ sidebar -->
		<?php include("../dbcon.php"); include("../fungsi.php"); ?>
		
		<!-- content group -->
		<div class="content-wrapper">
			<!-- content header (Page header) -->
			<section class="content-header">
			  <h1>Tambah Kelompok Akun</h1>
			  <ol class="breadcrumb">
				<li><a href="../modpgw/menu.php"><i class="fa fa-dashboard"></i> Beranda </a></li>
				<li><a href="menu.php"><i></i> Kelompok Akun </a></li>
				<li><a href="#"><i></i> Tambah Kelompok Akun </a></li>
			  </ol>
			</section>
			<!-- ./ content header (Page header) -->
			
			<!-- Main content -->
			<section class="content container-fluid">
				<form name="form1" method="POST" action="menutambah_proses.php" class="form-horizontal">
				<div class="row">
					<!-- kolom kiri -->
					<div class="col-md-6">								
						<div class="box box-primary">						
							<div class="box-header  with-border">
								<b><i class="fa fa-edit"></i> Tambah Kelompok Akun
								<a href="../m01/menu.php" class="btn btn-xs bg-navy margin-r-5 pull-right"><i class="fa fa-sign-out"></i> </a>
								</b>
							</div>
							<div class="box-body box-profile">
								<!-- Setup ID Jenis   -->
								<div class="form-group">
									<label for="idjenis" class="col-md-4 control-label">ID Jenis</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="idjenis" placeholder="terdiri dari 2 angka, mis:01" >
									</div>
								</div>
								<!-- Setup Jenis Akun -->
								<div class="form-group">
									<label for="jenis" class="col-md-4 control-label">Jenis Akun</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="jenis" placeholder="ketikkan teks" >
									</div>
								</div>
								<!-- Setup ID Kelompok  -->
								<div class="form-group">
									<label for="idkelompokdua" class="col-md-4 control-label">ID Kelompok</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="idkelompok"  placeholder="terdiri dari 4 angka, mis:0101" >
									</div>
								</div>
								<!-- Setup Kelompok Akun  -->
								<div class="form-group">
									<label for="kelompok" class="col-md-4 control-label">Kelompok</label>
									<div class="col-md-8">
										<textarea class="form-control" name="kelompok"  placeholder="ketikkan teks"></textarea>
									</div>
								</div>
							
								<!-- Setup Aktif/Non Aktif  -->
								<div class="form-group">
									<label for="normal" class="col-md-4 control-label">Saldo Normal</label>
									<div class="col-md-8">
										<select class="form-control" id="normal" name="normal" >
											<option value="D">Debet</option>
											<option value="K">Kredit</option>
										</select>
									</div>
								</div>								
							</div>
							
						</div>
						
						<div class="box">						
							<div class="box-body box-profile">					
							
								<div class="form-group">
									<div class="col-md-12">	
								<?php $m01=$_SESSION['m01']; if($m01=='a') { ?>
										<input type="submit" value="Simpan"  class="btn btn-success btn-flat col-md-3 margin-r-5" name="submit">
								<?php 	} ?>
										<a href="menu.php"  class="btn btn-warning btn-flat col-md-3 pull-right">Tutup</a> 
									</div>	
								</div>
							</div>
							<!-- /.box-body -->
						</div>						
						
					</div>
				</div>
				</form>
			</section>
			<!-- /.Main content -->
		</div>
		<!-- ./ content group -->
		
		<!-- header -->
		<?php include("../acuan_footer.php");?>
		<!-- ./ header -->

	</div>
	
	<!-- js component -->
	<?php include("../modpgw/acuan_js.php");?>	
	<!-- ./ js component -->		
	
</body>
</html>