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
			  <h1>Edit Akun</h1>
			  <ol class="breadcrumb">
				<li><a href="../modpgw/menu.php"><i class="fa fa-dashboard"></i> Beranda </a></li>
				<li><a href="menu.php"><i></i> Edit Akun </a></li>
				<li><a href="#"><i></i> Edit Rincian Akun </a></li>
			  </ol>
			</section>
			<!-- ./ content header (Page header) -->
			
			<!-- Main content -->
			<section class="content container-fluid">
				<form name="form1" method="POST" action="menuedit_proses.php" class="form-horizontal">
						<?php
							$idakun=$_REQUEST['idakun'];
							$sql = "SELECT kodeakun, akun, tb_coa.idkelompok, kelompok, tb_coa.idlaporan, laporan, idakun
									FROM `tb_coa`
									INNER JOIN tb_coa_info ON tb_coa.idkelompok = tb_coa_info.idkelompok
									INNER JOIN tb_jenislaporan ON tb_coa.idlaporan = tb_jenislaporan.idlaporan
									WHERE idakun='" . $idakun . "';";
							$result = $mysqli->query($sql);
							while($baris = $result->fetch_object())
							{
								$kodeakun=$baris->kodeakun; $akun=$baris->akun; $idkelompok=$baris->idkelompok;
								$kelompok=$baris->kelompok; $idlaporan=$baris->idlaporan; $laporan=$baris->laporan; 
								$idakun=$baris->idakun;
						?>				
				<div class="row">
					<!-- kolom kiri -->
					<div class="col-md-10">								
						<div class="box box-primary">						
							<div class="box-header  with-border">
								<b><i class="fa fa-edit"></i> Edit Akun
								<a href="../m02/menu.php" class="btn btn-xs bg-navy margin-r-5 pull-right"><i class="fa fa-sign-out"></i> </a>
								</b>
							</div>
							<div class="box-body box-profile">
								<!-- Setup Kode Akun   -->
								<div class="form-group">
									<label for="kodeakun" class="col-md-4 control-label">Kode Akun</label>
									<div class="col-md-8">
										<input type="hidden" class="form-control" name="idakun" value="<?php echo($idakun);?>" >
										<input type="hidden" class="form-control" name="kodeakun" value="<?php echo($kodeakun);?>" >
										<input type="text" class="form-control" name="kodeakun2" value="<?php echo($kodeakun);?>" >
									</div>
								</div>
								<!-- Setup Akun -->
								<div class="form-group">
									<label for="akun" class="col-md-4 control-label">Akun</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="akun" value="<?php echo($akun);?>" >
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
											if($idkelompok1==$idkelompok) { 
										?>
											<option value=<?php echo($idkelompok1);?> selected><?php echo($kelompok);?></option>
										<?php	} else 	{ 
										?>
											<option value=<?php echo($idkelompok1);?> ><?php echo($kelompok);?></option>
										<?php	} 
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
											if($idlaporan1==$idlaporan) {
										?>
											<option value=<?php echo($idlaporan1);?> selected><?php echo($laporan);?></option>
										<?php	} else 	{
										?>
											<option value=<?php echo($idlaporan1);?> ><?php echo($laporan);?></option>
										<?php	}
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
								<?php $m01=$_SESSION['m02']; if($m02=='a') { ?>
										<input type="submit" value="Simpan"  class="btn btn-success btn-flat col-md-3 margin-r-5" name="submit">
										<a href="menuhapus.php?kodeakun=<?php echo($kodeakun);?>"  class="btn btn-danger btn-flat col-md-3" >Hapus</a>											
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