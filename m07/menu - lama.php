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
			$akunbukubesar=$_SESSION['aktif_akunbukubesar'];
			$kelakunbukubesar=$_SESSION['aktif_kelakunbukubesar'];
			$idbukubesar=$_SESSION['aktif_idbukubesar'];		
		?>
		
		<!-- content group -->
		<div class="content-wrapper">
			<!-- content header (Page header) -->
			<section class="content-header">
			  <h1>Buku Besar</h1>
			  <p>Periode: <?php echo($nmperiode1);?></p>
			  <ol class="breadcrumb">
				<li><a href="../modpgw/menu.php"><i class="fa fa-dashboard"></i> Beranda </a></li>
				<li><a href="#"><i></i> Buku Besar </a></li>
			  </ol>
			</section>
			<!-- ./ content header (Page header) -->
			
			<!-- Main content -->
			<section class="content container-fluid">
				<div class="row">
					<!-- Data Pilihan Akun  -->
					<div class="col-md-6">									
						<div class="box">
							<div class="box-body">												
								<form action="posting.php" name="form2" method="POST" action="posting.php">
									<div class="form-group">
										<label for="akundb" class="control-label">Pilih Akun</label>
										<select class="form-control" id="kodeakun" name="kodeakun" >
										<?php
											$sqlk= "SELECT idakun, kodeakun, akun, tb_coa_info.idkelompok, kelompok, idjenis, jenis
														FROM tb_coa
														INNER JOIN tb_coa_info ON tb_coa.idkelompok = tb_coa_info.idkelompok
														ORDER BY idakun";
														
											$resultk = $mysqli->query($sqlk);
											while($barisk = $resultk->fetch_object())
											{
												$idakun=$barisk->idakun; $kodeakun1=$barisk->kodeakun; $akun1=$barisk->akun;  
												$idkelompok=$barisk->idkelompok; $kelompok=$barisk->kelompok;
												$idjenis=$barisk->idjenis; $jenis=$barisk->jenis;
										?>
											<option value="<?php echo($kodeakun1);?>"><?php echo($kodeakun1 . ' - ' . $akun1 . ' - ' . $kelompok . ' - ' . $jenis);?></option>											
										<?php	
											}
										?>
										</select>
										<input type="hidden" name="idbukubesar" value=1>
									</div>
									<div class="form-group">
										<input type="submit" value="Posting Per Akun"  class="btn bg-orange btn-flat btn-block pull-right" name="submit">
									</div>
									
								</form>
							</div>
						</div>
					</div>
					<?php
						$sqlk= "SELECT idakun, kodeakun, akun, tb_coa_info.idkelompok, kelompok, idjenis, jenis
									FROM tb_coa
									INNER JOIN tb_coa_info ON tb_coa.idkelompok = tb_coa_info.idkelompok
									WHERE kodeakun='" . $akunbukubesar . "' 
									ORDER BY idakun";
									
						$resultk = $mysqli->query($sqlk);
						while($barisk = $resultk->fetch_object())
						{
							$idakunpil=$barisk->idakun; $kodeakunpil=$barisk->kodeakun; $akunpil=$barisk->akun;  
						}
					?>
					<div class="col-md-6">									
						<div class="box">
							<div class="box-body">
							<!--<h5><b>Akun Buku Besar Dipilih:</b></h5>-->
								<ul class="nav nav-stacked">      
									<li><a href="#" class="bg-navy text-teal h4">Kode Akun : <b><?php echo($kodeakunpil);?></b> </a></li>
									<li><a href="#" class="bg-navy text-white h4">Nama Akun : <b><?php echo($akunpil);?></b> </a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				
				<!-- kolom bawah -->
				<div class="row">
					<div class="col-md-12">						
							<!-- Data Jurnal  -->
							<div class="box box-info">
								<div class="box-header with-border">
									<b>Rincian Transaksi Akun <?php echo( '[ ' . $kodeakunpil . ' ] - ' . $akunpil);?></b>
									<a class="btn bg-navy btn-xs pull-right" href="../modpgw/menu.php"><i class="fa fa-sign-out margin-r-10"></i></a>
									<a class="btn bg-orange btn-xs margin-r-5 pull-right" href="menucetak.php" target="blank"><i class="fa fa-print"></i> Cetak </a>
									<a class="btn bg-blue btn-xs margin-r-5 pull-right" href="ekspor.php" target="blank"><i class="fa fa-file-excel-o"></i> Ekspor Excel </a>

								</div>							
								<div class="box-body">
									<table class="table table-bordered table-striped" id="example1">
										<thead>
											<tr>
												<th class="text-center">Urut</th>
												<th class="text-center">Tgl.</th>
												<th>No.Bukti</th>
												<th>Deskripsi</th>
												<th class="text-right">Debet</th>
												<th class="text-right">Kredit</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$transaksi=0; $tdebet=0; $tkredit=0;
												$sql2 ="SELECT idjurnal, tgljurnal, nobukti, deskripsi, idbaris, kodeakun, namaakun, debet, kredit 
														FROM vbukubesar WHERE kodeakun=" . $akunbukubesar . " AND idperiode=" . $idperiode1 . "
														ORDER BY idbaris;";	
												$result2 = $mysqli->query($sql2);
												while($baris2 = $result2->fetch_object())
												{
													$idjurnal=$baris2->idjurnal; $tgljurnal=$baris2->tgljurnal; $nobukti=$baris2->nobukti; 
													$deskripsi=$baris2->deskripsi; $idbaris=$baris2->idbaris;
													$kodeakun=$baris2->kodeakun;   
													$namaakun=$baris2->namaakun; $debet=$baris2->debet; $kredit=$baris2->kredit; 
													$tgljurnal=formattgl($tgljurnal);  
											?>									
											<tr>
												<td align="center"><?php echo($idbaris);?>
												<td align="center"><?php echo($tgljurnal);?>
												<td><?php echo($nobukti);?></td>
												<td><?php echo($deskripsi);?></td>
												<td align="right"><?php echo(number_format($debet,2,',','.'));?></td>
												<td align="right"><?php echo(number_format($kredit,2,',','.'));?></td>
												
											</tr>
											<?php
													$transaksi=$transaksi+1;
													$tdebet=$tdebet+$debet;
													$tkredit=$tkredit+$kredit;
												}
												// cari saldo awal
												$sqlawal = "SELECT idperiode, kodeakun,db,kr FROM `tb_awal`
															WHERE kodeakun='" . $akunbukubesar . "' AND idperiode=" . $idperiode1 . ";";
												$resultawal = $mysqli->query($sqlawal);
												while($barisawal = $resultawal->fetch_object())
												{
													$dbawal=$barisawal->db; $krawal=$barisawal->kr; 
												}
												// cek posisi normal debet atau kredit	
												$cek=substr($akunbukubesar,0,1); 
												if($cek==1 || $cek==5) 
												{ $labelsaldo='Debet'; $saldoawal=$dbawal; $saldo=$tdebet-$tkredit; $saldoakhir=$saldoawal+$saldo; }
												else
												{ $labelsaldo='Kredit'; $saldoawal=$krawal; $saldo=$tkredit-$tdebet;  $saldoakhir=$saldoawal+$saldo; }
											?>
										</tbody>
									</table>
									<table class="table table-bordered table-striped" id="example1">
										<tbody>
											<tr>
												<td align='right'>Transaksi :</td>
												<td><?php echo($transaksi);?></td>											
												<td align='right'>Saldo Awal :</td>
												<td><?php echo(number_format($saldoawal,2,',','.'));?></td>
												<td align='right'>Mutasi Debet :</td>
												<td><?php echo(number_format($tdebet,2,',','.'));?></td>
												<td align='right'>Mutasi Kredit :</td>
												<td><?php echo(number_format($tkredit,2,',','.'));?></td>
												<td align='right'><b>Saldo Akhir : <?php echo($labelsaldo);?></b></td>
												<td><b><?php echo(number_format($saldoakhir,2,',','.'));?></b></td>												
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
	  })
	</script>		
</body>
</html>