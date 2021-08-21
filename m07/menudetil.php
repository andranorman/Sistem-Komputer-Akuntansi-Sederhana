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
			//$idperiode1=$_SESSION['aktif_idperiode'];
			//$nmperiode1=$_SESSION['aktif_nmperiode'];
			$idperiode1=$_SESSION['idperiodepilih'];
			$nmperiode1=$_SESSION['nmperiodepilih'];
			
			$idjurnal1=$mysqli->real_escape_string(rapikan($_REQUEST['kode']));
		?>
		
		<!-- content group -->
		<div class="content-wrapper">
			<!-- content header (Page header) -->
			<section class="content-header">
			  <h1>Edit Jurnal Umum</h1>
			  <p>Periode: <?php echo($nmperiode1);?></p>
			  <ol class="breadcrumb">
				<li><a href="../modpgw/menu.php"><i class="fa fa-dashboard"></i> Beranda </a></li>
				<li><a href="menu.php"><i></i> Jurnal Umum </a></li>
				<li><a href="#"><i></i> Edit Jurnal Umum </a></li>
			  </ol>
			</section>
			<!-- ./ content header (Page header) -->
			
			<!-- Main content -->
			<section class="content container-fluid">
						<?php
							$sql2 ="SELECT idperiode, idjurnal, tgljurnal, nobukti, nobuku, deskripsi 
									FROM tb_jurnal_mst  
									WHERE  idjurnal=" . $idjurnal1 . "";
															
							$result2 = $mysqli->query($sql2);
							while($baris2 = $result2->fetch_object())
							{
								$idperiode=$baris2->idperiode; $idjurnal=$baris2->idjurnal; $tgljurnal=$baris2->tgljurnal; 
								$nobukti=$baris2->nobukti; $nobuku=$baris2->nobuku; $deskripsi=$baris2->deskripsi;  																
								$tgljurnal=formattgl($tgljurnal);  
						?>				
				<!-- data awal -->		
				<div class="row">
					<!-- kolom kiri -->
					<div class="col-md-8">								
						<div class="box box-primary">						
							<div class="box-header  with-border">
								<b><i class="fa fa-edit"></i> Jurnal Umum [id: <?php echo($idjurnal);?> ]
								<a href="menu.php" class="btn btn-xs bg-navy margin-r-5 pull-right"><i class="fa fa-sign-out"></i> </a>
								</b>
							</div>
							<div class="box-body box-profile">
								<div class="form-group">
									<input type="hidden" class="form-control" name="idjurnal" value="<?php echo($idjurnal);?>" disabled>
								</div>
								<!-- Setup No.Bukti -->
								<div class="form-group">
									<label for="nobukti" class="col-md-4 control-label">No.Bukti</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="nobukti" value="<?php echo($nobukti);?>" disabled>
									</div>
								</div>
								<!-- Setup No.Buku -->
								<div class="form-group">
									<label for="nobuku" class="col-md-4 control-label">No.Buku</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="nobuku" value="<?php echo($nobuku);?>" disabled>
									</div>
								</div>
								<!-- Setup Tanggal Transaksi  -->
								<div class="form-group">
									<label for="tgltran" class="col-md-4 control-label">Tgl.Transaksi</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="tgljurnal" value="<?php echo($tgljurnal);?>"disabled >
									</div>
								</div>
								<!-- Setup Deskripsi  -->
								<div class="form-group">
									<label for="deskripsi" class="col-md-4 control-label">Deskripsi</label>
									<div class="col-md-8">
										<textarea class="form-control" name="deskripsi" disabled><?php echo($deskripsi);?></textarea>
									</div>
								</div>
							</div>	
						</div>						
					</div>
						<?php
							}
						?>
				</div>
				
				<!-- data ayat jurnal -->		
				<div class="row">
					<!-- kolom kiri -->
					<div class="col-md-8">								
						<div class="box box-primary">						
							<div class="box-header  with-border">
								<i class="fa fa-edit"></i> Ayat Jurnal
								<a href="menu.php" class="btn btn-xs bg-navy margin-r-5 pull-right"><i class="fa fa-sign-out"></i> </a>
							</div>
							<div class="box-body box-profile">
								<table class="table table-bordered table-striped" id="example1">
									<thead>
										<tr>
											<th>id</th>
											<th>Kode</th>
											<th>Nama Akun</th>
											<th>Debet</th>
											<th>Kredit</th>
										</tr>
									</thead>
									<tbody>							
						<?php
							$tdebet=0; $tkredit=0;
							$sql2 ="SELECT idjurnal, idbaris, kodeakun, namaakun, debet, kredit 
									FROM tb_jurnal_rinci
									WHERE idjurnal=" . $idjurnal1 . "
									ORDER BY idbaris"; 
															
							$result2 = $mysqli->query($sql2);
							while($baris2 = $result2->fetch_object())
							{
								$idbaris=$baris2->idbaris; $idjurnal=$baris2->idjurnal; $kodeakun=$baris2->kodeakun; 
								$namaakun=$baris2->namaakun; $debet=$baris2->debet; $kredit=$baris2->kredit;  							
						?>				
										<tr>
											<td class="text-center"><?php echo($idbaris);?></td>
											<td class="text-center"><?php echo($kodeakun);?>
											<td><?php echo($namaakun);?></td>
											<td align="right"><?php echo(number_format($debet));?></td>
											<td align="right"><?php echo(number_format($kredit));?></td>											
											<td>
											<?php $m05=$_SESSION['m05']; if($m05=='a') { ?>
												<a class="btn bg-red btn-xs" href="menudetil_hapus.php?idbaris=<?php echo($idbaris);?>&idjurnal=<?php echo($idjurnal);?>">
												<i class="fa fa-close"></i></a>
											<?php	}	?>													
											</td>
										</tr>
						<?php
								$tdebet=$tdebet+$debet; $tkredit=$tkredit+$kredit;
							}
						?>
										<tr>
											<td></td>
											<td></td>
											<td align="right">Jumlah</td>
											<td align="right"><?php echo(number_format($tdebet));?></td>
											<td align="right"><?php echo(number_format($tkredit));?></td>	
											<td></td>
										<td>
									<tbody>	
								</table>
							</div>
							<div class="box-footer">
							<?php $m05=$_SESSION['m05']; if($m05=='a') { ?>
								<form name="form1" method="POST" action="menudetil_tambah.php" class="form-horizontal">
									<!-- Pilihan Akun -->
									<div class="form-group">
										<h5 class="box-title text-center">Tambah Ayat Jurnal</h5>
										<hr>
										<label for="kodeakun" class="col-md-4 control-label">Akun </label>
										<div class="col-md-8">
											<select class="form-control" id="kodeakun" name="kodeakun" >
												<option value=0>-- Pilih Akun -- </option>
											<?php
												$sqlk= "SELECT idakun, kodeakun, akun, tb_coa_info.idkelompok, kelompok, idjenis, jenis
														FROM tb_coa
														INNER JOIN tb_coa_info ON tb_coa.idkelompok = tb_coa_info.idkelompok
														ORDER BY idakun";
											//	$sqlk= "SELECT idakun, kodeakun, akun, idkelompok FROM `tb_coa` 
											//			ORDER BY kodeakun";
												$resultk = $mysqli->query($sqlk);
												while($barisk = $resultk->fetch_object())
												{
													$idakun=$barisk->idakun; $kodeakun=$barisk->kodeakun; $akun=$barisk->akun;
													$idkelompok=$barisk->idkelompok; $kelompok=$barisk->kelompok;
													$idjenis=$barisk->idjenis; $jenis=$barisk->jenis;
													
											?>
												<option value="<?php echo($kodeakun);?>"><?php echo($kodeakun . ' - ' . $akun . ' - ' . $kelompok . ' - ' . $jenis);?></option>
											<?php 	
												}
											?>
											</select>
										</div>
									</div>	
									<!-- Setup Debet  -->
									<div class="form-group">
										<label for="debet" class="col-md-4 control-label">Debet</label>
										<div class="col-md-8">
											<input type="text" class="form-control" name="debet" value="0" >
											<!-- hidden var -->
											<input type="hidden" name="idjurnal" value="<?php echo($idjurnal);?>" >
										</div>
									</div>									
									<!-- Setup Kredit  -->
									<div class="form-group">
										<label for="kredit" class="col-md-4 control-label">Kredit</label>
										<div class="col-md-8">
											<input type="text" class="form-control" name="kredit" value="0" >
										</div>
									</div>									
									<!-- Setup Kredit  -->
									<div class="form-group">
										<center>
										<input type="submit" value="Tambah"  class="btn btn-success btn-flat" name="submit">
										</center>
									</div>
								</form>
							<?php	}	?>	
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
	
</body>
</html>