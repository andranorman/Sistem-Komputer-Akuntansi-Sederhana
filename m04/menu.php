<?php
//error_reporting(0);
// boc: -- cek sesi user --
session_start();

$cek_user=$_SESSION['simkeu'];
if(!$cek_user)
{	$pesan="mohon ulangi login..."; $menuju="../index.php?pesan=" . $pesan; header("location:$menuju");	}
$idperiode1=$_SESSION['aktif_idperiode'];
$nmperiode1=$_SESSION['aktif_nmperiode'];
$tahunperiode=substr($idperiode1,0,4)
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
			  <h1>Saldo Awal Tahun</h1>
			  <ol class="breadcrumb">
				<li><a href="../modpgw/menu.php"><i class="fa fa-dashboard"></i> Beranda </a></li>
				<li><a href="#"><i></i> Saldo Awal Tahun</a></li>
			  </ol>
			</section>
			<!-- ./ content header (Page header) -->
			
			<!-- Main content -->
			<section class="content container-fluid">
				<!-- kolom kiri -->
				<div class="row">
					<div class="col-md-8">
						<!-- Profile  -->
						<div class="box box-info">
							<div class="box-header with-border"><b>Saldo Awal Tahun <?php echo($tahunperiode);?></b>
								<a class="btn bg-navy btn-xs pull-right" href="../modpgw/menu.php"><i class="fa fa-sign-out margin-r-10"></i></a>
								<a class="btn bg-orange btn-xs margin-r-5 pull-right" href="menucetak.php" target="blank"><i class="fa fa-print"></i> Cetak </a>
								<a class="btn bg-blue btn-xs margin-r-5 pull-right" href="ekspor.php" ><i class="fa fa-file-excel-o"></i> Ke Excel </a>
								</div>							
							<div class="box-body">
								<table class="table table-bordered table-striped" id="example1">
									<thead>
										<tr>
											<th>KDA</th>
											<th>Akun</th>
											<th>Saldo Db</th>
											<th>Saldo Kr</th>
											<th></th>
										</tr>
									</thead> 
									<tbody>
										<?php
											$sqlp = "SELECT idperiode FROM tb_awal WHERE LEFT(idperiode,4)=" . $tahunperiode . ";";
											$resultp = $mysqli->query($sqlp);
											$barisp = $resultp->fetch_object();
											$countp = $resultp->num_rows; 
											if( $countp>0 ) 
											{
												$sql2 ="SELECT idperiode, tb_awal.kodeakun, akun, db, kr
														FROM `tb_awal` 
														INNER JOIN tb_coa ON tb_awal.kodeakun = tb_coa.kodeakun
														WHERE LEFT(idperiode,4) =" . $tahunperiode . " ORDER BY tb_awal.kodeakun";
												$result2 = $mysqli->query($sql2);
												while($baris2 = $result2->fetch_object())
												{
													$idperiode=$baris2->idperiode;  
													$kodeakun=$baris2->kodeakun; $akun=$baris2->akun; $db=$baris2->db; $kr=$baris2->kr;
										?>									
										<tr>
											<td><?php echo($kodeakun);?></td>
											<td><?php echo($akun);?></td>
											<td align="right"><?php echo(number_format($db,2, ',', '.'));?></td>
											<td align="right"><?php echo(number_format($kr,2, ',', '.'));?></td>											
											<td>
											<?php $m03=$_SESSION['m03']; if($m03=='a') { ?>
												<a class="btn bg-orange btn-xs" href="menuedit.php?kodeakun=<?php echo($kodeakun);?>&idperiode=<?php echo($idperiode1);?>">
												<i class="fa fa-pencil"></i></a>
											<?php	}	?>													
											</td>
										</tr>
										
										<?php
												}
											}
											else
											{
										?>
										<tr>
											<td cospan=5>
											<?php $m04=$_SESSION['m04']; if($m04=='a') { ?>
												<a class="btn bg-orange btn-xs" href="setsaldoawal.php?idperiode=<?php echo($idperiode1);?>">
												<i class="fa fa-pencil"></i> Set Saldo Awal</a>
											<?php	}	?>													
											</td>
										</tr>
										<?php	
											}	
										?>
									</tbody>
								</table>
							</div>
							<div class="box-footer"> 
								<?php
									$sdb=0; $skr=0;
									$sqls = "SELECT SUM(db) AS sdb, SUM(kr) AS skr FROM tb_awal WHERE LEFT(idperiode,4)=" . $tahunperiode . " GROUP BY idperiode ;";
									$results = $mysqli->query($sqls);
									$bariss = $results->fetch_object();
									$counts = $results->num_rows; 
									if( $counts>0 ) 
									{
										$sqld ="SELECT SUM(db) AS sdb, SUM(kr) AS skr FROM tb_awal WHERE LEFT(idperiode,4)=" . $tahunperiode . " GROUP BY idperiode ;";
										$resultd = $mysqli->query($sqld);
										while($barisd = $resultd->fetch_object())
										{
											$sdb=$barisd->sdb; $skr=$barisd->skr; 
										}
									}
									else
									{
										$sdb=0; $skr=0;
									}
								?>						
									<table class="table table-bordered table-striped" id="example1">
										<tbody>
											<tr>
												<td>Jumlah</th>
												<td align="right"><?php echo(number_format($sdb,2, ',', '.'));?></th>
												<td align="right"><?php echo(number_format($skr,2, ',', '.'));?></th>
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
		  'searching'   : true,
		  'ordering'    : false,
		  'info'        : true,
		  'autoWidth'   : false		
		})
		$('#example2').DataTable({
		  'paging'      : false,
		  'lengthChange': false,
		  'searching'   : true,
		  'ordering'    : false,
		  'info'        : true,
		  'autoWidth'   : false
		})
	  })
	</script>		
</body>
</html>