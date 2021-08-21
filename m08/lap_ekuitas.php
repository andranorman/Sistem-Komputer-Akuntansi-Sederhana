   <?php
//error_reporting(0);
// boc: -- cek sesi user --
session_start();

$cek_user=$_SESSION['simkeu'];
if(!$cek_user)
{	$pesan="mohon ulangi login..."; $menuju="../index.php?pesan=" . $pesan; header("location:$menuju");	}
$idperiode1=$_SESSION['idperiodepilih'];
$nmperiode1=$_SESSION['nmperiodepilih'];
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
			  <h1>Laporan Ekuitas <?php echo($nmperiode1);?></h1>
			  <ol class="breadcrumb">
				<li><a href="../modpgw/menu.php"><i class="fa fa-dashboard"></i> Beranda </a></li>
				<li><a href="#"><i></i> Laporan Ekuitas </a></li>
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
								<!--
								<a class="btn bg-blue btn-xs pull-right margin-r-5" href="lap_ekuitas_setup.php" ><i class="fa fa-wrench"></i> Pengaturan </a>
								-->
								<a class="btn bg-red btn-xs pull-right margin-r-5" href="lap_ekuitas_hitung.php" ><i class="fa fa-calculator"></i> Update </a>
								<a class="btn bg-orange btn-xs pull-right margin-r-5" href="lap_ekuitas_cetak.php" target="blank"><i class="fa fa-print"></i> Cetak </a>
								
								<a class="btn bg-green btn-xs pull-right margin-r-5" href="lap_ekuitas_ekspor.php" target="blank"><i class="fa fa-file-excel-o"></i> Ekspor </a>
								
							</div>							
							<div class="box-body">
								<hr>
								<table class="table table-bordered table-striped" id="example1">
									<tbody>
										<tr><td colspan='5' align="center"><b>Laporan Perubahan Ekuitas <?php echo($nmperiode1);?></b></td>
										<tr>
											<td width='10%' ></td>
											<td width='10%' ></td>
											<td width='50%' ></td>
											<td width='20%' ></td>
											<td width='10%' ></td>
										</tr>
										<?php
												$totalnilaiA=0; 
												$sql2 ="SELECT id, kelompok, deskripsi, nilai FROM ekuitas WHERE kelompok='A' ORDER BY kelompok, id";	
												$result2 = $mysqli->query($sql2);
												while($baris2 = $result2->fetch_object())
												{
													$id=$baris2->id; $kelompok=$baris2->kelompok; $deskripsi=$baris2->deskripsi; 
													$nilai=$baris2->nilai; 
													if($kelompok=='A') {	$totalnilaiA=$totalnilaiA+$nilai;	}
										?>									
										<tr>
											<td></td>
											<td colspan=2 align="left"><?php echo($deskripsi);?></td>
											<td align="right"><?php echo(number_format($nilai,2,',','.'));?></td>
											<td>
												<a class="btn bg-blue btn-xs pull-right margin-r-5" href="lap_ekuitas_edit.php?id=<?php echo($id);?>&j=1" >
												<i class="fa fa-wrench"></i> edit </a>
											</td>
										</tr>
										<?php
												}
										?>
										<tr>
											<td></td>
											<td></td>
											<td align="left"><i>Ekuitas untuk dikonsolidasikan</i></td>
											<td align="right"><?php echo(number_format($totalnilaiA,2,',','.'));?></td>
											<td></td>
										</tr>

										<tr>
											<td></td>
											<td align="left" colspan='4'>Dampak Kumulatif Perubahan Kebijakan/Kesalahan Mendasar:</td>
										</tr>
										<?php
												$totalnilaiB=0; $urut=0;
												$sql2 ="SELECT id, kelompok, deskripsi, nilai FROM ekuitas WHERE kelompok='B' ORDER BY kelompok, id";	
												$result2 = $mysqli->query($sql2);
												while($baris2 = $result2->fetch_object())
												{
													$id=$baris2->id; $kelompok=$baris2->kelompok; $deskripsi=$baris2->deskripsi; 
													$nilai=$baris2->nilai; 
													$urut=$urut+1;
													if($kelompok=='B') {	$totalnilaiB=$totalnilaiB+$nilai;	}
										?>									
										<tr>
											<td></td>
											<td align="center"><?php echo($urut);?></td>
											<td align="left"><?php echo($deskripsi);?></td>
											<td align="right"><?php echo(number_format($nilai,2,',','.'));?></td>
											<td>
												<a class="btn bg-blue btn-xs pull-right margin-r-5" href="lap_ekuitas_edit.php?id=<?php echo($id);?>&j=2" >
												<i class="fa fa-wrench"></i> edit </a>
											</td>
										</tr>
										<?php
												}
										?>
										<tr>
											<td></td>
											<td colspan=2 align="left"><b>EKUITAS AKHIR</b></td>
											<td align="right"><?php echo(number_format($totalnilaiA-$totalnilaiB,2,',','.'));?></td>
											<td></td>
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