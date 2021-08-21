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
			  <h1>Setup Periode Akuntansi</h1>
			  <ol class="breadcrumb">
				<li><a href="../modpgw/menu.php"><i class="fa fa-dashboard"></i> Beranda </a></li>
				<li><a href="#"><i></i> Setup Periode Akuntansi</a></li>
			  </ol>
			</section>
			<!-- ./ content header (Page header) -->
			
			<!-- Main content -->
			<section class="content container-fluid">
				<!-- kolom kiri -->
				<div class="row">
					<div class="col-md-6">
						<!-- Profile  -->
						<div class="box box-info">
							<div class="box-header with-border">
							<?php $m03=$_SESSION['m03']; if($m03=='a') { ?>
								<a class="btn bg-green btn-xs" href="menutambah.php"><i class="fa fa-plus"></i></a>
							<?php	}	?>	
								<a class="btn bg-navy btn-xs pull-right" href="../modpgw/menu.php"><i class="fa fa-sign-out margin-r-10"></i></a><b> Tambah Data </b>
							</div>							
							<div class="box-body">
								<table class="table table-bordered table-striped" id="example1">
									<thead>
										<tr>
											<th>Periode</th>
											<th>Dari</th>
											<th>Sampai</th>
											<th>Status</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php
											$sql2 = "SELECT idperiode, nmperiode, dari, sampai, keterangan, dipilih
													 FROM `tb_periode` ORDER BY dari DESC";
											$result2 = $mysqli->query($sql2);
											while($baris2 = $result2->fetch_object())
											{
												$idperiode=$baris2->idperiode; $nmperiode=$baris2->nmperiode; $dari=$baris2->dari; $sampai=$baris2->sampai;
												$keterangan=$baris2->keterangan; $dipilih=$baris2->dipilih;
												$dari=formattgl($dari); $sampai=formattgl($sampai);
												if($dipilih==0){$status="nonaktif"; $warna="bg-green";} else {$status="aktif"; $warna="bg-red";}													
										?>									
										<tr>
											<td><?php echo($nmperiode);?></td>
											<td><?php echo($dari);?>
											<td><?php echo($sampai);?></td>
											<td>
											<?php 
											if($dipilih==0){
											?>
												<a href="setaktif.php?idperiode=<?php echo($idperiode);?>&dipilih=<?php echo($dipilih);?>" class="btn btn-xs <?php echo($warna);?>"><?php echo($status);?></a>
											<?php	}
											else	{	echo("<b>" . $status . "</b>");
											?>
											<?php	}	
											?>
											</td>
											<td>
											<?php $m03=$_SESSION['m03']; if($m03=='a') { ?>
												<a class="btn bg-orange btn-xs" href="menuedit.php?idperiode=<?php echo($idperiode);?>">
												<i class="fa fa-pencil"></i></a>
											<?php	}	?>													
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