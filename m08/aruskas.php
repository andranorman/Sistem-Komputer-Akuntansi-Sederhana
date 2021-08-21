   <?php
//error_reporting(0);
// boc: -- cek sesi user --
session_start();

$cek_user=$_SESSION['simkeu'];
if(!$cek_user)
{	$pesan="mohon ulangi login..."; $menuju="../index.php?pesan=" . $pesan; header("location:$menuju");	}
$idperiode1=$_SESSION['aktif_idperiode'];
$nmperiode1=$_SESSION['aktif_nmperiode'];
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
			  <h1>Arus Kas <?php echo($nmperiode1);?></h1>
			  <ol class="breadcrumb">
				<li><a href="../modpgw/menu.php"><i class="fa fa-dashboard"></i> Beranda </a></li>
				<li><a href="#"><i></i> Arus Kas </a></li>
			  </ol>
			</section>
			<!-- ./ content header (Page header) -->
			
			<!-- Main content -->
			<section class="content container-fluid">
				<!-- kolom kiri -->
				<div class="row">
					<div class="col-md-12">
							
						<!-- Arus Kas dari Operasi  -->
						<div class="box box-info">
							<div class="box-header with-border">
							<!--<a class="btn bg-purple btn-xs pull-left margin-r-5" href="aruskassetup.php"><i class="fa fa-wrench"></i> Pengaturan</a>-->
								<a class="btn bg-navy btn-xs pull-right" href="../modpgw/menu.php"><i class="fa fa-sign-out margin-r-10"></i></a>
								<a class="btn bg-blue btn-xs pull-right margin-r-5" href="aruskassetup.php" ><i class="fa fa-wrench"></i> Pengaturan </a>
								<a class="btn bg-red btn-xs pull-right margin-r-5" href="aruskashitung.php" ><i class="fa fa-calculator"></i> Update </a>
								<a class="btn bg-orange btn-xs pull-right margin-r-5" href="aruskascetak.php" target="blank"><i class="fa fa-print"></i> Cetak </a>
								<a class="btn bg-green btn-xs pull-right margin-r-5" href="aruskas_ekspor.php" target="blank"><i class="fa fa-file-excel-o"></i> Ekspor </a>
							</div>							
							<div class="box-body">
								<hr>
								<table class="table table-bordered table-striped" id="example1">
									<tbody>
										<tr><td colspan='4' align="center"><b>ARUS KAS DARI OPERASI</b></td>
										<tr>
											<td><b>ARUS KAS MASUK</b></td><td></td><td></td><td></td>
										</tr>
										<?php
												$totaldebet1=0; $totalkredit1=0;
												$sql2 ="SELECT idaruskas, tipe, kodekel, namakel, kodeakun, noaruskas, namaaruskas, tingkat, dk, debet, kredit 
														FROM aruskas WHERE kodekel=1 AND tipe='MASUK' ORDER BY idaruskas";	
												$result2 = $mysqli->query($sql2);
												while($baris2 = $result2->fetch_object())
												{
													$idaruskas=$baris2->idaruskas; $tipe=$baris2->tipe; $kodekel=$baris2->kodekel; 
													$namakel=$baris2->namakel; $kodeakun=$baris2->kodeakun; $noaruskas=$baris2->noaruskas; 
													$namaaruskas=$baris2->namaaruskas; $tingkat=$baris2->tingkat; $db=$baris2->dk;
													$debet=$baris2->debet; $kredit=$baris2->kredit;
													$totaldebet1=$totaldebet1+$debet; $totalkredit1=$totalkredit1+$kredit;
										?>									
										<tr>
											<td></td>
											<td align="left"><?php echo($noaruskas . ". " . $namaaruskas);?></td>
											<td align="right"><?php echo(number_format($debet));?></td>
											<td></td>
										</tr>
										<?php
												}
										?>
										<tr>
											<td align="right" colspan='3'>Jumlah Arus Kas Masuk</td>
											<td align="right"><?php echo(number_format($totaldebet1));?></td>
										</tr>

										<tr>
											<td><b>ARUS KAS KELUAR</b></td><td></td><td></td><td></td>
										</tr>
										<?php
												$totaldebet2=0; $totalkredit2=0;
												$sql2 ="SELECT idaruskas, tipe, kodekel, namakel, kodeakun, noaruskas, namaaruskas, tingkat, dk, debet, kredit 
														FROM aruskas WHERE kodekel=1 AND tipe='KELUAR' ORDER BY idaruskas";	
												$result2 = $mysqli->query($sql2);
												while($baris2 = $result2->fetch_object())
												{
													$idaruskas=$baris2->idaruskas; $tipe=$baris2->tipe; $kodekel=$baris2->kodekel; 
													$namakel=$baris2->namakel; $kodeakun=$baris2->kodeakun; $noaruskas=$baris2->noaruskas; 
													$namaaruskas=$baris2->namaaruskas; $tingkat=$baris2->tingkat; $db=$baris2->dk;
													$debet=$baris2->debet; $kredit=$baris2->kredit;
													$totaldebet2=$totaldebet2+$debet; 
													$totalkredit2=$totalkredit2+$kredit;
										?>									
										<tr>
											<td></td>
											<td align="left"><?php echo($noaruskas . ". " . $namaaruskas);?></td>
											<td align="right"><?php echo(number_format($kredit));?></td>
											<td></td>
										</tr>
										<?php
												}
										?>
										<tr>
											<td align="right" colspan='3'>Jumlah Arus Kas Keluar</td>
											<td align="right"><?php echo(number_format($totalkredit2));?></td>
										</tr>
										<tr>
											<td align="right" colspan='3'><b>Arus Kas Operasi</b></td>
											<td align="right"><b><?php echo(number_format($totaldebet1-$totalkredit2));?></b></td>
										</tr>
									</tbody>
								</table>
								<hr>
								<table class="table table-bordered table-striped" id="example1">
									<tbody>
										<tr><td colspan='4' align="center"><b>ARUS KAS DARI INVESTASI</b></td>
										<tr>
											<td><b>ARUS KAS MASUK</b></td><td></td><td></td><td></td>
										</tr>
										<?php
												$totaldebet3=0; $totalkredit3=0;
												$sql2 ="SELECT idaruskas, tipe, kodekel, namakel, kodeakun, noaruskas, namaaruskas, tingkat, dk, debet, kredit 
														FROM aruskas WHERE kodekel=2 AND tipe='MASUK' ORDER BY idaruskas";														
												$result2 = $mysqli->query($sql2);
												while($baris2 = $result2->fetch_object())
												{
													$idaruskas=$baris2->idaruskas; $tipe=$baris2->tipe; $kodekel=$baris2->kodekel; 
													$namakel=$baris2->namakel; $kodeakun=$baris2->kodeakun; $noaruskas=$baris2->noaruskas; 
													$namaaruskas=$baris2->namaaruskas; $tingkat=$baris2->tingkat; $db=$baris2->dk;
													$debet=$baris2->debet; $kredit=$baris2->kredit;
													$totaldebet3=$totaldebet3+$debet; $totalkredit3=$totalkredit3+$kredit;
										?>									
										<tr>
											<td></td>
											<td align="left"><?php echo($noaruskas . ". " . $namaaruskas);?></td>
											<td align="right"><?php echo(number_format($debet));?></td>
											<td></td>
										</tr>
										<?php
												}
										?>
										<tr>
											<td align="right" colspan='3'>Jumlah Arus Kas Masuk</td>
											<td align="right"><?php echo(number_format($totaldebet3));?></td>
										</tr>

										<tr>
											<td><b>ARUS KAS KELUAR</b></td><td></td><td></td><td></td>
										</tr>
										<?php
												$totaldebet4=0; $totalkredit4=0;
												$sql2 ="SELECT idaruskas, tipe, kodekel, namakel, kodeakun, noaruskas, namaaruskas, tingkat, dk, debet, kredit 
														FROM aruskas WHERE kodekel=2 AND tipe='KELUAR' ORDER BY idaruskas";	
												$result2 = $mysqli->query($sql2);
												while($baris2 = $result2->fetch_object())
												{
													$idaruskas=$baris2->idaruskas; $tipe=$baris2->tipe; $kodekel=$baris2->kodekel; 
													$namakel=$baris2->namakel; $kodeakun=$baris2->kodeakun; $noaruskas=$baris2->noaruskas; 
													$namaaruskas=$baris2->namaaruskas; $tingkat=$baris2->tingkat; $db=$baris2->dk;
													$debet=$baris2->debet; $kredit=$baris2->kredit;
													$totaldebet4=$totaldebet4+$debet; $totalkredit4=$totalkredit4+$kredit;
										?>									
										<tr>
											<td></td>
											<td align="left"><?php echo($noaruskas . ". " . $namaaruskas);?></td>
											<td align="right"><?php echo(number_format($kredit));?></td>
											<td></td>
										</tr>
										<?php
												}
										?>
										<tr>
											<td align="right" colspan='3'>Jumlah Arus Kas Keluar</td>
											<td align="right"><?php echo(number_format($totalkredit4));?></td>
										</tr>
										<tr>
											<td align="right" colspan='3'><b>Arus Kas Investasi</b></td>
											<td align="right"><b><?php echo(number_format($totaldebet3-$totalkredit4));?></b></td>
										</tr>
									</tbody>
								</table>
								<hr>
								<table class="table table-bordered table-striped" id="example1">
									<tbody>
										<tr><td colspan='4' align="center"><b>ARUS KAS DARI PENDANAAN</b></td>
										<tr>
											<td><b>ARUS KAS MASUK</b></td><td></td><td></td><td></td>
										</tr>
										<?php
												$totaldebet5=0; $totalkredit5=0;
												$sql2 ="SELECT idaruskas, tipe, kodekel, namakel, kodeakun, noaruskas, namaaruskas, tingkat, dk, debet, kredit 
														FROM aruskas WHERE kodekel=3 AND tipe='MASUK' ORDER BY idaruskas";	
												$result2 = $mysqli->query($sql2);
												while($baris2 = $result2->fetch_object())
												{
													$idaruskas=$baris2->idaruskas; $tipe=$baris2->tipe; $kodekel=$baris2->kodekel; 
													$namakel=$baris2->namakel; $kodeakun=$baris2->kodeakun; $noaruskas=$baris2->noaruskas; 
													$namaaruskas=$baris2->namaaruskas; $tingkat=$baris2->tingkat; $db=$baris2->dk;
													$debet=$baris2->debet; $kredit=$baris2->kredit;
													$totaldebet5=$totaldebet5+$debet; $totalkredit5=$totalkredit5+$kredit;
										?>									
										<tr>
											<td></td>
											<td align="left"><?php echo($noaruskas . ". " . $namaaruskas);?></td>
											<td align="right"><?php echo(number_format($debet));?></td>
											<td></td>
										</tr>
										<?php
												}
										?>
										<tr>
											<td align="right" colspan='3'>Jumlah Arus Kas Masuk</td>
											<td align="right"><?php echo(number_format($totaldebet5));?></td>
										</tr>

										<tr>
											<td><b>ARUS KAS KELUAR</b></td><td></td><td></td><td></td>
										</tr>
										<?php
												$totaldebet6=0; $totalkredit6=0;
												$sql2 ="SELECT idaruskas, tipe, kodekel, namakel, kodeakun, noaruskas, namaaruskas, tingkat, dk, debet, kredit 
														FROM aruskas WHERE kodekel=3 AND tipe='KELUAR' ORDER BY idaruskas";	
												$result2 = $mysqli->query($sql2);
												while($baris2 = $result2->fetch_object())
												{
													$idaruskas=$baris2->idaruskas; $tipe=$baris2->tipe; $kodekel=$baris2->kodekel; 
													$namakel=$baris2->namakel; $kodeakun=$baris2->kodeakun; $noaruskas=$baris2->noaruskas; 
													$namaaruskas=$baris2->namaaruskas; $tingkat=$baris2->tingkat; $db=$baris2->dk;
													$debet=$baris2->debet; $kredit=$baris2->kredit;
													$totaldebet6=$totaldebet6+$debet; $totalkredit6=$totalkredit6+$kredit;
										?>									
										<tr>
											<td></td>
											<td align="left"><?php echo($noaruskas . ". " . $namaaruskas);?></td>
											<td align="right"><?php echo(number_format($kredit));?></td>
											<td></td>
										</tr>
										<?php
												}
										?>
										<tr>
											<td align="right" colspan='3'>Jumlah Arus Kas Keluar</td>
											<td align="right"><?php echo(number_format($totalkredit6));?></td>
										</tr>
										<tr>
											<td align="right" colspan='3'><b>Arus Kas dari Pendanaan</b></td>
											<td align="right"><b><?php echo(number_format($totaldebet5-$totalkredit6));?></b></td>
										</tr>
									</tbody>
								</table>
								
							</div>
						</div>
						<!-- /.box -->		
					</div>					
				</div>
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
	<!-- page script -->
	<script>
	  $(function () {
		$('#example1').DataTable({
		  'paging'      : false, 
		  'lengthChange': false,
		  'searching'   : false,
		  'ordering'    : false,
		  'info'        : false,
		  'autoWidth'   : false		
		})
		$('#example2').DataTable({
		  'paging'      : true,
		  'lengthChange': true,
		  'searching'   : true,
		  'ordering'    : false,
		  'info'        : true,
		  'autoWidth'   : false
		})
	  })
	</script>		
</body>
</html>