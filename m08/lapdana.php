<?php
//error_reporting(0);
// boc: -- cek sesi user --
session_start();

$cek_user=$_SESSION['simkeu'];
if(!$cek_user)
{	$pesan="mohon ulangi login..."; $menuju="../index.php?pesan=" . $pesan; header("location:$menuju");	}
//$idperiode1=$_SESSION['aktif_idperiode'];
//$nmperiode1=$_SESSION['aktif_nmperiode'];
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
			  <h1>Laporan Operasional </h1>
			  <ol class="breadcrumb">
				<li><a href="../modpgw/menu.php"><i class="fa fa-dashboard"></i> Beranda </a></li>
				<li><a href="#"><i></i> Lap.Operasional </a></li>
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
							<div class="box-header with-border"><b>Laporan Operasional untuk Periode <?php echo($nmperiode1);?></b>
								<a class="btn bg-navy btn-xs pull-right" href="../modpgw/menu.php"><i class="fa fa-sign-out margin-r-10"></i></a>
							</div>							
							<div class="box-body">
								<a class="btn bg-orange btn-xs margin-r-5" href="lapdanacetak.php" target="blank"><i class="fa fa-print"></i> Cetak </a>
								<a class="btn bg-blue btn-xs margin-r-5" href="lapdana_ekspor.php" target="blank"><i class="fa fa-file-excel-o"></i> Ekspor Excel </a>
								<!-- isi data -------------------------------------------------------------------------- -->
								<div class="embed-responsive embed-responsive-16by9">
									<iframe class="embed-responsive-item" src="lapdanacetak.php" allowfullscreen></iframe>
								</div>
								<!-- */ isi data -------------------------------------------------------------------------- -->

								<hr>
							</div>
						</div>
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