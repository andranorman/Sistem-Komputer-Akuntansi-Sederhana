<?php
//error_reporting(0);
// boc: -- cek sesi user --
session_start();
$cek_user=$_SESSION['simkeu'];
if(!$cek_user)
{	$pesan="mohon ulangi login..."; $menuju="../index.php?pesan=" . $pesan; header("location:$menuju");	}
// eoc: -- cek sesi user --
$idperiode1=$_SESSION['aktif_idperiode'];
$nmperiode1=$_SESSION['aktif_nmperiode'];
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
			  <h1>Input Saldo Awal</h1>
			  <ol class="breadcrumb">
				<li><a href="../modpgw/menu.php"><i class="fa fa-dashboard"></i> Beranda </a></li>
				<li><a href="menu.php"><i></i> Saldo Awal </a></li>
				<li><a href="#"><i></i> Input Saldo Awal </a></li>
			  </ol>
			</section>
			<!-- ./ content header (Page header) -->
			
			<!-- Main content -->
			<section class="content container-fluid">
				<form name="form1" method="POST" action="menuedit_proses.php" class="form-horizontal">
						<?php
							$kodeakun=$_REQUEST['kodeakun'];
							$sql = "SELECT idperiode, tb_awal.kodeakun, akun, db, kr
									FROM `tb_awal` 
									INNER JOIN tb_coa ON tb_awal.kodeakun = tb_coa.kodeakun
									WHERE tb_awal.kodeakun=" . $kodeakun . " AND idperiode =" . $idperiode1 . " ;";
							$result = $mysqli->query($sql);
							while($baris = $result->fetch_object())
							{
								$kodeakun=$baris->kodeakun; $akun=$baris->akun;  
								$db=$baris->db; $kr=$baris->kr; 
						?>				
				<div class="row">
					<!-- kolom kiri -->
					<div class="col-md-6">								
						<div class="box box-primary">						
							<div class="box-header  with-border">
								<b><i class="fa fa-edit"></i> Edit Saldo Awal Periode <?php echo($nmperiode1);?>
								<a href="../m03a/menu.php" class="btn btn-xs bg-navy margin-r-5 pull-right"><i class="fa fa-sign-out"></i> </a>
								</b>
							</div>
							<div class="box-body box-profile">
								<!-- Setup Kode Akun   -->
								<div class="form-group">
									<label for="kodeakun" class="col-md-4 control-label">Kode Akun</label>
									<div class="col-md-8">
										<input type="hidden" class="form-control" name="kodeakun" value="<?php echo($kodeakun);?>" >
										<input type="text" class="form-control" name="kodeakun1" value="<?php echo($kodeakun);?>" disabled>
									</div>
								</div>
								<!-- Setup Akun -->
								<div class="form-group">
									<label for="akun" class="col-md-4 control-label">Akun</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="akun" value="<?php echo($akun);?>" disabled>
									</div>
								</div>
								<!-- Setup Debet  -->
								<div class="form-group">
									<label for="db" class="col-md-4 control-label">Debet</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="db" value="<?php echo($db);?>" >
									</div>
								</div>
								<!-- Setup Kredit  -->
								<div class="form-group">
									<label for="kr" class="col-md-4 control-label">Kredit</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="kr" value="<?php echo($kr);?>">
									</div>
								</div>
								
							</div>
						</div>
						
						<div class="box">						
							<div class="box-body box-profile">					
							
								<div class="form-group">
									<div class="col-md-12">	
								<?php $m04=$_SESSION['m04']; if($m04=='a') { ?>
										<input type="submit" value="Simpan"  class="btn btn-success btn-flat col-md-3 margin-r-5" name="submit">
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