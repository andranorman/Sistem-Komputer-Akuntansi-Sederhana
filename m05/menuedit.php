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
		<?php include("../dbcon.php"); include("../fungsi.php");  
			$nmperiode1=$_SESSION['nmperiodepilih'];
			$idperiode1=$_SESSION['idperiodepilih']; 			
			$idjurnal1= $_REQUEST['kode'];
			$idjurnal1= rapikan($idjurnal1);
			$idjurnal1 = stripslashes(strip_tags($idjurnal1)); 
			$idjurnal1 = $mysqli->real_escape_string($idjurnal1);			
		?>
		
		<!-- content group -->
		<div class="content-wrapper">
			<!-- content header (Page header) -->
			<section class="content-header">
			  <h1>Edit Jurnal Umum</h1>
			  <p>Periode: <?php echo($nmperiode1);?></p>
			  <ol class="breadcrumb">
				<li><a href="../modpgw/menu.php"><i class="fa fa-dashboard"></i> Beranda </a></li>
				<li><a href="menu.php"><i></i> Jurnal Umum </a></li>
				<li><a href="#"><i></i> Edit Jurnal Umum </a></li>
			  </ol>
			</section>
			<!-- ./ content header (Page header) -->
			
			<!-- Main content -->
			<section class="content container-fluid">
				<form name="form1" method="POST" action="menuedit_proses.php" class="form-horizontal">
						<?php
							$sql2 ="SELECT idperiode, idjurnal, tgljurnal, nobuku, nobukti, deskripsi 
									FROM tb_jurnal_mst  
									WHERE  idjurnal=" . $idjurnal1 . "";
															
							$result2 = $mysqli->query($sql2);
							while($baris2 = $result2->fetch_object())
							{
								$idperiode=$baris2->idperiode; $idjurnal=$baris2->idjurnal; $tgljurnal=$baris2->tgljurnal; 
								$nobukti=$baris2->nobukti; $nobuku=$baris2->nobuku; $deskripsi=$baris2->deskripsi;  
																
								$tgljurnal=formattgl($tgljurnal);  
						?>				
				<div class="row">
					<!-- kolom kiri -->
					<div class="col-md-8">								
						<div class="box box-primary">						
							<div class="box-header  with-border">
								<b><i class="fa fa-edit"></i> Edit Jurnal Umum
								<a href="menu.php" class="btn btn-xs bg-navy margin-r-5 pull-right"><i class="fa fa-sign-out"></i> </a>
								</b>
							</div>
							<div class="box-body box-profile">
								<div class="form-group">
									<input type="hidden" class="form-control" name="idjurnal" value="<?php echo($idjurnal1);?>" >
								</div>
								<!-- Setup No.Bukti -->
								<div class="form-group">
									<label for="nobukti" class="col-md-4 control-label">No.Bukti</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="nobukti" value="<?php echo($nobukti);?>" >
									</div>
								</div>
								<!-- Setup No.Buku -->
								<div class="form-group">
									<label for="nobuku" class="col-md-4 control-label">No.Buku</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="nobuku" value="<?php echo($nobuku);?>" >
									</div>
								</div>

								<!-- Setup Tanggal Transaksi  -->
								<div class="form-group">
									<label for="tgltran" class="col-md-4 control-label">Tgl.Transaksi</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="tgljurnal" value="<?php echo($tgljurnal);?>" >
									</div>
								</div>
								<!-- Setup Deskripsi  -->
								<div class="form-group">
									<label for="deskripsi" class="col-md-4 control-label">Deskripsi</label>
									<div class="col-md-8">
										<textarea class="form-control" name="deskripsi"><?php echo($deskripsi);?></textarea>
									</div>
								</div>
							</div>	
						</div>
						
						<div class="box">						
							<div class="box-body box-profile">					
								<div class="form-group">
									<div class="col-md-12">	
								<?php $m05=$_SESSION['m05']; if($m05=='a') { ?>
										<input type="submit" value="Simpan"  class="btn btn-success btn-flat col-md-3 margin-r-5" name="submit">
										<a href="menuhapus.php?kode=<?php echo(berantakan($idjurnal));?>"  class="btn btn-danger btn-flat col-md-3" >Hapus</a>											
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