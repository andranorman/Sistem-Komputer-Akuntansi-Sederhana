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
			$idperiode1=$_SESSION['idperiodepilih']; // -- periode berdasarkan pilihan bulan
			$nmperiode1=$_SESSION['nmperiodepilih'];			
		?>		
		<!-- content group -->
		<div class="content-wrapper">
			<!-- content header (Page header) -->
			<section class="content-header">
			  <h1>Jurnal Umum</h1>
			  <p>Periode: <?php echo($nmperiode1);?></p>
			  <ol class="breadcrumb">
				<li><a href="../modpgw/menu.php"><i class="fa fa-dashboard"></i> Beranda </a></li>
				<li><a href="#"><i></i> Jurnal Umum </a></li>
			  </ol>
			</section>
			<!-- ./ content header (Page header) -->
			
			<!-- Main content -->
			<section class="content container-fluid">
				<!-- kolom kiri -->
				<div class="row">
					<div class="col-md-12">
						<!-- Data Jurnal  -->
						<form action="settanggal.php" name="form1" method="POST" class="form-horizontal">
							<div class="row">
								<div class="col-md-6">
									<div class="input-group margin">
										<label for="idperiodepilih" class="col-md-4">Pilih Periode</label>
										<div class="col-md-6">
											<select class="form-control" id="idperiodepilih" name="idperiodepilih" >
											<?php
												$idperiodepilih=$_SESSION['idperiodepilih'];
												$sqlp= "SELECT idperiode, nmperiode FROM `tb_periode` ORDER BY idperiode";														
												$resultp = $mysqli->query($sqlp);
												while($barisp = $resultp->fetch_object())
												{
													$idperiode2=$barisp->idperiode; $nmperiode2=$barisp->nmperiode;  
													if($idperiode2==$idperiode1)
													{
											?>
												<option value="<?php echo($idperiode2);?>" selected><?php echo($idperiode2 . ' - ' . $nmperiode2);?></option>											
											<?php	
													} else {
											?>
												<option value="<?php echo($idperiode2);?>"><?php echo($idperiode2 . ' - ' . $nmperiode2);?></option>																					
											<?php
													}
												}
											?>
											</select>
										</div>
										<div class="col-md-2">
											<span class="input-group-btn">
												<input type="submit" class="btn btn-info btn-block" value="Tampilkan" />
											</span>
										</div>
									</div>	
								</div>
							</div>
						</form>
						
						<!-- Data Jurnal  -->
						<div class="box box-info">
							<div class="box-header with-border">
								<div class="box-title text-center">Transaksi Bulan :&nbsp;<?php echo($nmperiode1);?></div>							
								<a class="btn bg-navy btn-xs pull-right" href="../modpgw/menu.php"><i class="fa fa-sign-out margin-l-10"></i></a>
								&nbsp;
							<?php $m05=$_SESSION['m05']; if($m05=='a') { ?>
								<a class="btn bg-green btn-xs pull-right" href="menutambah.php"><i class="fa fa-plus"></i> Tambah</a>
							<?php	}	?>	
							</div>							
							<div class="box-body">

								<table class="table table-bordered table-striped" id="example1">
									<thead>
										<tr>
											<th>Urut</th>
											<th>No.Buku</th>
											<th>No.Bukti</th>
											<th>Tgl.</th>
											<th>Deskripsi </th>
											<th>Edit</th>
											<th>Rinci</th>
										</tr>
									</thead>
									<tbody>
										<?php		
										//	$sql2 ="SELECT idperiode, tb_jurnal_mst.idjurnal, tgljurnal, nobukti, deskripsi, dr, cr
										//			FROM tb_jurnal_mst INNER JOIN vjurnal_rinci ON tb_jurnal_mst.idjurnal=vjurnal_rinci.idjurnal
										//			WHERE  (tgljurnal BETWEEN '" . $daritgl2 . "' AND '" . $sampaitgl2 . "' ) AND nonaktif=0
										//			ORDER BY tgljurnal DESC, nobukti DESC";
										//	
											$sql2 ="SELECT idperiode, idjurnal, tgljurnal, nobukti, nobuku, deskripsi
													FROM tb_jurnal_mst 
													WHERE  idperiode =" . $idperiode1 . " AND nonaktif=0
													ORDER BY tgljurnal DESC, nobuku DESC, nobukti DESC";
													
											$result2 = $mysqli->query($sql2);
											while($baris2 = $result2->fetch_object())
											{
												$idperiode=$baris2->idperiode; $idjurnal=$baris2->idjurnal; $tgljurnal=$baris2->tgljurnal; 
												$nobukti=$baris2->nobukti; $nobuku=$baris2->nobuku; $deskripsi=$baris2->deskripsi;  
												//$tgljurnal=formattgl($tgljurnal);  
										?>									
										<tr>
											<td class="text-center"><?php echo($idjurnal);?></td>
											<td class="text-center"><?php echo($nobuku);?></td>
											<td class="text-center"><?php echo($nobukti);?></td>
											<td class="text-center"><?php echo(formattgl($tgljurnal));?>
											<td><?php echo($deskripsi);?></td>
											<td>
											<?php $m05=$_SESSION['m05']; if($m05=='a') { ?>
												<a class="btn bg-orange btn-xs" href="menuedit.php?kode=<?php echo(berantakan($idjurnal));?>">
												<i class="fa fa-pencil"></i></a>
											<?php	}	?>													
											</td>
											<td>
												<a class="btn bg-red btn-xs" href="menudetil.php?kode=<?php echo(berantakan($idjurnal));?>">
												<i class="fa fa-tasks"></i></a>
											</td>											
										</tr>
										<?php
											}
										?>
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
		  'paging'      : true,
		  'lengthChange': true,
		  'searching'   : true,
		  'ordering'    : true,
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
		//Date picker
		$('#datepicker').datepicker({
		  autoclose: true
		})			
		//Date picker
		$('#datepicker2').datepicker({
		  autoclose: true
		})			

	  })
	</script>		
</body>
</html>