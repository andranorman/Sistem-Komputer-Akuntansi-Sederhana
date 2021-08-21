<?php
//error_reporting(0);
// boc: -- cek sesi user --
session_start();
$cek_user=$_SESSION['skars'];
if(!$cek_user)
{	$pesan="mohon ulangi login..."; $menuju="../index.php?pesan=" . $pesan; header("location:$menuju");	}
$idperiode1=$_SESSION['aktif_idperiode'];
$nmperiode1=$_SESSION['aktif_nmperiode'];
$tahunperiode=intval(substr($idperiode1,0,4));
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
			<section class="content-header">
			  <h1>Pengaturan Laporan Arus Kas<small></small></h1>
			  <ol class="breadcrumb">
				<li><a href="../modpgw/menu.php"><i class="fa fa-dashboard"></i> Beranda </a></li>
				<li><a href="aruskas.php"><i></i> Arus Kas </a></li>
				<li><a href="#"><i></i> Pengaturan </a></li>
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
								<a class="btn bg-teal btn-xs pull-left margin-r-5" href="aruskas.php"><i class="fa fa-tasks"></i> &nbsp;Kembali ke Data</a>
								<a class="btn bg-navy btn-xs pull-right" href="aruskas.php"><i class="fa fa-sign-out margin-r-10"></i></a>
							<div class="box-body">
								<table class="table table-bordered table-striped" id="example1">
									<thead>
										<tr>
											<th>id</th>
											<th>Kode Kel.</th>
											<th>Nama Kelompok</th>
											<th>Tipe</th>
											<th>Kode Akun</th>
											<th>Level Akun</th>
											<th>D/K</th>
											<th>No.</th>
											<th>Deskripsi</th>
											<th>Debet</th>
											<th>Kredit</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php
											$sql2 ="SELECT idaruskas, tipe, kodekel, namakel, kodeakun, noaruskas, namaaruskas, tingkat, dk, debet, kredit
													FROM `aruskas`
													ORDER BY idaruskas";
											$result2 = $mysqli->query($sql2);
											while($baris2 = $result2->fetch_object())
											{
												$idaruskas=$baris2->idaruskas;$tipe=$baris2->tipe; 
												$kodekel=$baris2->kodekel; $namakel=$baris2->namakel; 
												$kodeakun=$baris2->kodeakun; $noaruskas=$baris2->noaruskas; $namaaruskas=$baris2->namaaruskas; 
												$tingkat=$baris2->tingkat; $dk=$baris2->dk; $debet=$baris2->debet; $kredit=$baris2->kredit;
										?>									
										<tr>
											<td align="center"><?php echo($idaruskas);?></td>
											<td align="center"><?php echo($kodekel);?>
											<td><?php echo($namakel);?></td>
											<td align="center"><?php echo($tipe);?>
											<td><?php echo($kodeakun);?></td>
											<td align="center"><?php echo($tingkat);?></td>
											<td align="center"><?php echo($dk);?></td>
											<td align="center"><?php echo($noaruskas);?></td>
											<td><?php echo($namaaruskas);?></td>
											<td><?php echo($debet);?></td>
											<td><?php echo($kredit);?></td>											
											<td>
											<?php $m02=$_SESSION['m06']; if($m06=='a') { ?>
												<a class="btn bg-orange btn-xs" href="aruskassetup_edit.php?idaruskas=<?php echo($idaruskas);?>">
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
		  'lengthChange': true,
		  'searching'   : true,
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