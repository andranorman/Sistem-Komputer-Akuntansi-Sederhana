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
			  <h1>Tambah Periode Akuntansi</h1>
			  <ol class="breadcrumb">
				<li><a href="../modpgw/menu.php"><i class="fa fa-dashboard"></i> Beranda </a></li>
				<li><a href="menu.php"><i></i> Setup Periode Akuntansi </a></li>
				<li><a href="#"><i></i> Tambah Periode Akuntansi</a></li>
			  </ol>
			</section>
			<!-- ./ content header (Page header) -->
			
			<!-- Main content -->
			<section class="content container-fluid">
				<form name="form1" method="POST" action="menutambah_proses.php" class="form-horizontal">
				<div class="row">
					<!-- kolom kiri -->
					<div class="col-md-6">								
						<div class="box box-danger">						
							<div class="box-header  with-border">
								<b><i class="fa fa-plus"></i> Tambah Periode Akuntansi
								<a href="../m03/menu.php" class="btn btn-xs bg-navy margin-r-5 pull-right"><i class="fa fa-sign-out"></i> </a>
								</b>
							</div>
							<div class="box-body box-profile">
								<!-- Setup Nama Periode  -->
								<div class="form-group">
									<label for="nmperiode" class="col-md-4 control-label">ID Periode</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="idperiode" placeholder="Misal: 19 (untuk 2019)" >
									</div>
								</div>														
								<!-- Setup Nama Periode  -->
								<div class="form-group">
									<label for="nmperiode" class="col-md-4 control-label">Nama Periode</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="nmperiode" placeholder="Misal: Januari 2018" >
									</div>
								</div>
								<!-- Setup Awal Periode  -->
								<div class="form-group">
									<label for="dari" class="col-md-4 control-label">Awal Periode</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="dari" placeholder="Misal: 01-01-2018" >
									</div>
								</div>
								<!-- Setup Akhir Periode  -->
								<div class="form-group">
									<label for="sampai" class="col-md-4 control-label">Akhir Periode</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="sampai" placeholder="Misal: 31-01-2018" >
									</div>
								</div>
								<!-- Setup Keterangan Periode  -->
								<div class="form-group">
									<label for="keterangan" class="col-md-4 control-label">Keterangan</label>
									<div class="col-md-8">
										<textarea class="form-control" name="keterangan" placeholder="Isikan jika ada keterangan"></textarea>
									</div>
								</div>
							
								<!-- Setup Aktif/Non Aktif  -->
								<div class="form-group">
									<label for="dipilih" class="col-md-4 control-label">Status</label>
									<div class="col-md-8">
										<select class="form-control" id="dipilih" name="dipilih" >
											<option value=0 selected>non-aktif</option>
											<option value=1>aktif</option>
										</select>
									</div>
								</div>								
							</div>							
						</div>
						
						<div class="box">						
							<div class="box-body box-profile">					
								<div class="form-group">
									<div class="col-md-12">	
								<?php $m03=$_SESSION['m03']; if($m03=='a') { ?>
										<input type="submit" value="Simpan"  class="btn btn-success btn-flat col-md-3 margin-r-5" name="submit">
								<?php 	} ?>
										<a href="menu.php"  class="btn btn-warning btn-flat col-md-3 pull-right">Batal/Tutup</a> 
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