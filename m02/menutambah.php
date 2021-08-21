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
			  <h1>Tambah Akun</h1>
			  <ol class="breadcrumb">
				<li><a href="../modpgw/menu.php"><i class="fa fa-dashboard"></i> Beranda </a></li>
				<li><a href="menu.php"><i></i> Setup Akun </a></li>
				<li><a href="#"><i></i> Tambah Akun </a></li>
			  </ol>
			</section>
			<!-- ./ content header (Page header) -->
			
			<!-- Main content -->
			<section class="content container-fluid">
				<form name="form1" method="POST" action="menutambah_proses.php" class="form-horizontal">
				<div class="row">
					<!-- kolom kiri -->
					<div class="col-md-10">								
						<div class="box box-primary">						
							<div class="box-header  with-border">
								<b><i class="fa fa-plus"></i> Tambah Akun 
								<a href="../m02/menu.php" class="btn btn-xs bg-navy margin-r-5 pull-right"><i class="fa fa-sign-out"></i> </a>
								</b>
							</div>
							<div class="box-body box-profile">
								<!-- Setup Kode Akun   -->
								<div class="form-group">
									<label for="idjenis" class="col-md-4 control-label">Kode Akun</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="kodeakun" placeholder="isikan kode akun" >
									</div>
								</div>
								<!-- Setup Akun -->
								<div class="form-group">
									<label for="akun" class="col-md-4 control-label">Akun</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="akun" placeholder="isikan nama akun" >
									</div>
								</div>
								<!-- Setup ID Kelompok  -->
								<div class="form-group">
									<label for="idkelompok" class="col-md-4 control-label">Kelompok Akun</label>
									<div class="col-md-8">
										<select class="form-control" id="idkelompok" name="idkelompok" >
										<?php
										$sql3 = "SELECT idkelompok, kelompok FROM `tb_coa_info` ORDER BY idkelompok";
										$result3 = $mysqli->query($sql3);
										while($baris3 = $result3->fetch_object())
										{
											$idkelompok1=$baris3->idkelompok; $kelompok=$baris3->kelompok;										
										?>
											<option value=<?php echo($idkelompok1);?> ><?php echo($kelompok);?></option>
										<?php	 
										}
										?>
										</select>
									</div>
								</div>								

								
								<!-- Setup ID Laporan  -->
								<div class="form-group">
									<label for="idlaporan" class="col-md-4 control-label">Tampil di Laporan</label>
									<div class="col-md-8">
										<select class="form-control" id="idlaporan" name="idlaporan" >
										<?php
										$sql4 = "SELECT idlaporan, laporan FROM `tb_jenislaporan` ORDER BY idlaporan";
										$result4 = $mysqli->query($sql4);
										while($baris4 = $result4->fetch_object())
										{
											$idlaporan1=$baris4->idlaporan; $laporan=$baris4->laporan;										
										?>
											<option value=<?php echo($idlaporan1);?> ><?php echo($laporan);?></option>
										<?php	
										}
										?>
										</select>
									</div>
								</div>									
								
							</div>
						</div>
						
						<div class="box">						
							<div class="box-body box-profile">					
								<div class="form-group">
									<div class="col-md-12">	
								<?php $m02=$_SESSION['m02']; if($m02=='a') { ?>
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