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
			  <h1>Laporan Pendapatan </h1>
			  <ol class="breadcrumb">
				<li><a href="../modpgw/menu.php"><i class="fa fa-dashboard"></i> Beranda </a></li>
				<li><a href="#"><i></i> Lap.Pendapatan </a></li>
			  </ol>
			</section>
			<!-- ./ content header (Page header) -->
			
			<!-- Main content -->
			<section class="content container-fluid">
				<!-- kolom kiri -->
				<div class="row">
					<div class="col-md-12">
						<!-- Profile  -->
						<div class="box box-info">
							<div class="box-header with-border"><b>Laporan Pendapatan untuk Periode <?php echo($nmperiode1);?></b>
								<a class="btn bg-navy btn-xs pull-right" href="../modpgw/menu.php"><i class="fa fa-sign-out margin-r-10"></i></a>
							</div>							
							<div class="box-body">
								<a class="btn bg-orange btn-xs margin-r-5" href="lapdanacetak.php" target="blank"><i class="fa fa-print"></i> Cetak </a>
								<hr>
								<table class="table table-bordered table-striped" id="example1">
									<thead>
										<tr>
											<th>Kelompok Akun</th>
											<th>Awal Db</th>
											<th>Awal Kr</th>
											<th>Mutasi Db</th>
											<th>Mutasi Kr</th>
											<th>Pnys Db</th>
											<th>Pnys Kr</th>
											<th>Saldo Db</th>
											<th>Saldo Kr</th>
										</tr>
									</thead> 
									<tbody>
										<?php
											$tawal_db=0;
											$tawal_kr=0;
											$tmutasi_db=0;
											$tmutasi_kr=0;
											$tpenyesuaian_db=0;
											$tpenyesuaian_kr=0;
											$tsaldo_db=0;
											$tsaldo_kr=0;
											$sqlp ="SELECT idperiode FROM tb_nrcsaldo   
													WHERE idperiode=" . $idperiode1 . ";";
											$resultp = $mysqli->query($sqlp);
											$barisp = $resultp->fetch_object();
											$countp = $resultp->num_rows; 
											if( $countp>0 ) 
											{
												$sql2 ="SELECT tb_coa.idkelompok, kelompok, SUM(db_awal) AS sdb_awal, SUM(kr_awal) AS skr_awal, 
														SUM(db_mutasi) AS sdb_mutasi, SUM(kr_mutasi) AS skr_mutasi, 
														SUM(db_penyesuaian) AS sdb_penyesuaian, SUM(kr_penyesuaian) AS skr_penyesuaian, 
														SUM(db_saldo) AS sdb_saldo, SUM(kr_saldo) AS skr_saldo 
														FROM tb_nrcsaldo INNER JOIN tb_coa ON tb_nrcsaldo.kodeakun=tb_coa.kodeakun 
														INNER JOIN tb_coa_info ON tb_coa.idkelompok=tb_coa_info.idkelompok
														WHERE idperiode=" . $idperiode1 . " AND LEFT(tb_coa.idkelompok,1)='4'
														GROUP BY tb_coa.idkelompok";
												$result2 = $mysqli->query($sql2);
												while($baris2 = $result2->fetch_object())
												{
													$idperiode=$idperiode1;  
													$idkelompok=$baris2->idkelompok; $kelompok=$baris2->kelompok; $db_awal=$baris2->sdb_awal; 
													$kr_awal=$baris2->skr_awal;
													$db_mutasi=$baris2->sdb_mutasi; $kr_mutasi=$baris2->skr_mutasi; 
													$db_penyesuaian=$baris2->sdb_penyesuaian; $kr_penyesuaian=$baris2->skr_penyesuaian;
													$db_saldo=$baris2->sdb_saldo; $kr_saldo=$baris2->skr_saldo;
										?>									
										<tr>
											<td align="left"><?php echo($idkelompok . "-" . $kelompok);?></td>
											<td align="right"><?php echo(number_format($db_awal));?></td>
											<td align="right"><?php echo(number_format($kr_awal));?></td>											
											<td align="right"><?php echo(number_format($db_mutasi));?></td>
											<td align="right"><?php echo(number_format($kr_mutasi));?></td>											
											<td align="right"><?php echo(number_format($db_penyesuaian));?></td>
											<td align="right"><?php echo(number_format($kr_penyesuaian));?></td>											
											<td align="right"><?php echo(number_format($db_saldo));?></td>
											<td align="right"><?php echo(number_format($kr_saldo));?></td>											
										</tr>
										
										<?php
													$tawal_db=$tawal_db+$db_awal;
													$tawal_kr=$tawal_kr+$kr_awal;
													$tmutasi_db=$tmutasi_db+$db_mutasi;
													$tmutasi_kr=$tmutasi_kr+$kr_mutasi;
													$tpenyesuaian_db=$tpenyesuaian_db+$db_penyesuaian;
													$tpenyesuaian_kr=$tpenyesuaian_kr+$kr_penyesuaian;
													$tsaldo_db=$tsaldo_db+$db_saldo;
													$tsaldo_kr=$tsaldo_kr+$kr_saldo;												
												}
											}
										?>
										<tr>
											<td align="center">J u m l a h</td>
											<td align="right"><?php echo(number_format($tawal_db));?></td>
											<td align="right"><?php echo(number_format($tawal_kr));?></td>											
											<td align="right"><?php echo(number_format($tmutasi_db));?></td>
											<td align="right"><?php echo(number_format($tmutasi_kr));?></td>											
											<td align="right"><?php echo(number_format($tpenyesuaian_db));?></td>
											<td align="right"><?php echo(number_format($tpenyesuaian_kr));?></td>											
											<td align="right"><?php echo(number_format($tsaldo_db));?></td>
											<td align="right"><?php echo(number_format($tsaldo_kr));?></td>											
										</tr>
									</tbody>
								</table>
							</div>
							<!--
							<div class="box-footer"> 
								<table class="table table-bordered table-striped" id="example1">
									<tbody>
										<tr>
											<td>Jumlah</th>
											<td align="right"><?php echo(number_format($sdb));?></th>
											<td align="right"><?php echo(number_format($skr));?></th>
										</tr>
									</tbody>
								</table>								
							</div>
							-->
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
		  'paging'      : true,
		  'lengthChange': true,
		  'searching'   : true,
		  'ordering'    : false,
		  'info'        : true,
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