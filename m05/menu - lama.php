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
			$idperiode1=$_SESSION['aktif_idperiode'];
			$nmperiode1=$_SESSION['aktif_nmperiode'];
			$daritgl=$_SESSION['aktif_daritgl'];
			$sampaitgl=$_SESSION['aktif_sampaitgl'];
			$daritgl2=formattglsql2($daritgl);
			$sampaitgl2=formattglsql2($sampaitgl);
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
						<div class="box">
							<div class="box-body">				
								<div class="col-md-5">
									<div class="form-group">
										<label for="daritgl" class="col-md-6 control-label">Dari Tgl (bln/tgl/thn): </label>
										<div class="col-md-5 input-group date" >
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input type="text" class="form-control" name="daritgl" value="" id="datepicker">
										</div>
									</div>
								</div>
								<div class="col-md-5">
									<div class="form-group">
										<label for="sampaitgl" class="col-md-6 control-label">Sampai (bln/tgl/thn): </label>
										<div class="col-md-5 input-group date" >
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input type="text" class="form-control" name="sampaitgl" value="" id="datepicker2" >
										</div>
									</div>								
								</div>
								<div class="col-md-1">
								</div>
								<div class="col-md-2">
									<div class="form-group  text-center">
										<input type="submit" value="Tampilkan Data"  class="btn bg-teal btn-flat margin-l-5" name="submit">
									</div>								
								</div>	
								<div class="col-md-1">
								</div>								
							</div>
						</div>
						</form>
						
						<!-- Data Jurnal  -->
						<div class="box box-info">
							<div class="box-header with-border">
								<div class="box-title text-center">Transaksi Dari :&nbsp;<?php echo(formattgl($daritgl2));?> s.d. &nbsp;<?php echo(formattgl($sampaitgl2));?></div>							
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
											<th>No.Bukti</th>
											<th>No.Buku</th>
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
													WHERE  (tgljurnal BETWEEN '" . $daritgl2 . "' AND '" . $sampaitgl2 . "' ) AND nonaktif=0
													ORDER BY tgljurnal DESC, nobukti DESC";
													
											$result2 = $mysqli->query($sql2);
											while($baris2 = $result2->fetch_object())
											{
												$idperiode=$baris2->idperiode; $idjurnal=$baris2->idjurnal; $tgljurnal=$baris2->tgljurnal; 
												$nobukti=$baris2->nobukti; $nobuku=$baris2->nobuku; $deskripsi=$baris2->deskripsi;  
												//$tgljurnal=formattgl($tgljurnal);  
										?>									
										<tr>
											<td class="text-center"><?php echo($idjurnal);?></td>
											<td class="text-center"><?php echo($nobukti);?></td>
											<td class="text-center"><?php echo($nobuku);?></td>
											<td class="text-center"><?php echo(formattgl($tgljurnal));?>
											<td><?php echo($deskripsi);?></td>
											<td>
											<?php $m05=$_SESSION['m05']; if($m05=='a') { ?>
												<a class="btn bg-orange btn-xs" href="menuedit.php?idjurnal=<?php echo($idjurnal);?>">
												<i class="fa fa-pencil"></i></a>
											<?php	}	?>													
											</td>
											<td>
												<a class="btn bg-red btn-xs" href="menudetil.php?idjurnal=<?php echo($idjurnal);?>">
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