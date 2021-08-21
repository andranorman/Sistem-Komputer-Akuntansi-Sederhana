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
			  <h1>Edit Periode Akuntansi</h1>
			  <ol class="breadcrumb">
				<li><a href="../modpgw/menu.php"><i class="fa fa-dashboard"></i> Beranda </a></li>
				<li><a href="menu.php"><i></i> Setup Periode Akuntansi</a></li>
				<li><a href="#"><i></i> Edit Periode Akuntansi</a></li>
			  </ol>
			</section>
			<!-- ./ content header (Page header) -->
			
			<!-- Main content -->
			<section class="content container-fluid">
				<form name="form1" method="POST" action="menuedit_proses.php" class="form-horizontal">
						<?php
							$idperiode=$_REQUEST['idperiode'];
							$sql = "SELECT idperiode, nmperiode, dari, sampai, keterangan, dipilih		
									FROM tb_periode WHERE idperiode=" . $idperiode ;
							$result = $mysqli->query($sql);
							while($baris = $result->fetch_object())
							{
								$idperiode=$baris->idperiode; $nmperiode=$baris->nmperiode; $dari=$baris->dari; $sampai=$baris->sampai; 
								$keterangan=$baris->keterangan; $dipilih=$baris->dipilih; 
								$dari=formattgl($dari); $sampai=formattgl($sampai); 
						?>				
				<div class="row">
					<!-- kolom kiri -->
					<div class="col-md-6">								
						<div class="box box-primary">						
							<div class="box-header  with-border">
								<b><i class="fa fa-edit"></i> Edit Periode Akuntansi
								<a href="../m03/menu.php" class="btn btn-xs bg-navy margin-r-5 pull-right"><i class="fa fa-sign-out"></i> </a>
								</b>
							</div>
							<div class="box-body box-profile">
								<!-- Setup Nama Periode  -->
								<div class="form-group">
									<label for="nmperiode" class="col-md-4 control-label">ID Periode</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="idperiode1" value="<?php echo($idperiode);?>" disabled>
										<input type="hidden" class="form-control" name="idperiode" value="<?php echo($idperiode);?>" >
									</div>
								</div>							
								<!-- Setup Nama Periode  -->
								<div class="form-group">
									<label for="nmperiode" class="col-md-4 control-label">Nama Periode</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="nmperiode" value="<?php echo($nmperiode);?>" >
									</div>
								</div>
								<!-- Setup Awal Periode  -->
								<div class="form-group">
									<label for="dari" class="col-md-4 control-label">Awal Periode</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="dari" value="<?php echo($dari);?>" >
									</div>
								</div>
								<!-- Setup Akhir Periode  -->
								<div class="form-group">
									<label for="sampai" class="col-md-4 control-label">Akhir Periode</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="sampai" value="<?php echo($sampai);?>" >
									</div>
								</div>
								<!-- Setup Keterangan Periode  -->
								<div class="form-group">
									<label for="keterangan" class="col-md-4 control-label">Keterangan</label>
									<div class="col-md-8">
										<textarea class="form-control" name="keterangan"><?php echo($keterangan);?></textarea>
									<!--<input type="text" class="form-control" name="keterangan" value="<?php echo($keterangan);?>" >-->
									</div>
								</div>
							
								<!-- Setup Aktif/Non Aktif  -->
								<div class="form-group">
									<label for="dipilih" class="col-md-4 control-label">Status</label>
									<div class="col-md-8">
										<select class="form-control" id="dipilih" name="dipilih" >
										<?php
											if($dipilih==0) {
										?>
											<option value=0 selected>non-aktif</option>
											<option value=1>aktif</option>
										<?php	} else 	{
										?>
											<option value=0>non-aktif</option>
											<option value=1 selected>aktif</option>
										<?php	}
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
								<?php $m03=$_SESSION['m03']; if($m03=='a') { ?>
										<input type="submit" value="Simpan"  class="btn btn-success btn-flat col-md-3 margin-r-5" name="submit">
										<a href="menuhapus.php?idperiode=<?php echo($idperiode);?>"  class="btn btn-danger btn-flat col-md-3" >Hapus</a>											
								<?php 	} ?>
										<a href="menu.php"  class="btn btn-warning btn-flat col-md-3 pull-right">Tutup</a> 
									</div>	
								</div>
							</div>
							<!-- /.box-body -->
						</div>						
						
					</div>
						<?php
							}
						?>
						
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