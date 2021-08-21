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
			  <h1>Setup Akun </h1>
			  <ol class="breadcrumb">
				<li><a href="../modpgw/menu.php"><i class="fa fa-dashboard"></i> Beranda </a></li>
				<li><a href="#"><i></i> Setup Akun </a></li>
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
							<div class="box-header with-border">
							<?php $m02=$_SESSION['m02']; if($m02=='a') { ?>
								<a class="btn bg-green btn-xs" href="menutambah.php"><i class="fa fa-plus"></i></a>
							<?php	}	?>	
								<a class="btn bg-navy btn-xs pull-right" href="../modpgw/menu.php"><i class="fa fa-sign-out margin-r-10"></i></a><b> Tambah Akun </b>
								<a class="btn bg-orange btn-xs margin-r-5 pull-right" href="menucetak.php" target="blank"><i class="fa fa-print"></i> Cetak </a>
								<a class="btn bg-blue btn-xs margin-r-5 pull-right" href="ekspor.php" target="blank"><i class="fa fa-file-excel-o"></i> Ekspor Excel </a>
							</div>
							<div class="box-body">
								<table class="table table-bordered table-striped" id="example1">
									<thead>
										<tr>
											<th>Kode</th>
											<th>Nama Akun</th>
											<th>Kelompok</th>
											<th>Laporan</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php
											$sql2 ="SELECT kodeakun, akun, tb_coa.idkelompok, kelompok, tb_coa.idlaporan, laporan, idakun
													FROM `tb_coa`
													INNER JOIN tb_coa_info ON tb_coa.idkelompok = tb_coa_info.idkelompok
													INNER JOIN tb_jenislaporan ON tb_coa.idlaporan = tb_jenislaporan.idlaporan
													ORDER BY kodeakun";
											$result2 = $mysqli->query($sql2);
											while($baris2 = $result2->fetch_object())
											{
												$akuna="";
												$kodeakun=$baris2->kodeakun; $akun=$baris2->akun; $idkelompok=$baris2->idkelompok;
												$kelompok=$baris2->kelompok; $idlaporan=$baris2->idlaporan; $laporan=$baris2->laporan;   
												$idakun=$baris2->idakun;																							
										?>									
										<tr>
											<td><?php echo($kodeakun);?></td>
											<td><?php echo($akun);?>
											<td><?php echo($kelompok);?></td>
											<td><?php echo($laporan);?></td>											
											<td>
											<?php $m02=$_SESSION['m02']; if($m02=='a') { ?>
												<a class="btn bg-orange btn-xs" href="menuedit.php?idakun=<?php echo($idakun);?>">
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