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
			$idperiodepilih=$_SESSION['idperiodepilih'];
			$nmperiodepilih=$_SESSION['nmperiodepilih'];
			$akunbukubesar=$_SESSION['aktif_akunbukubesar'];
			$kelakunbukubesar=$_SESSION['aktif_kelakunbukubesar'];
			$idbukubesar=$_SESSION['aktif_idbukubesar'];	
			$tahunperiode=substr($idperiodepilih,0,4);
		?>		
		<!-- content group -->
		<div class="content-wrapper">
			<!-- content header (Page header) -->
			<section class="content-header">
			  <h1>Buku Besar</h1>
			  <p>Periode: <?php echo($nmperiodepilih);?></p>
			  <ol class="breadcrumb">
				<li><a href="../modpgw/menu.php"><i class="fa fa-dashboard"></i> Beranda </a></li>
				<li><a href="#"><i></i> Buku Besar </a></li>
			  </ol>
			</section>
			<!-- ./ content header (Page header) -->
			
			<!-- Main content -->
			<section class="content container-fluid">
				<div class="row">
					<form action="posting.php" class="form-horizontal" name="form2" method="POST" action="posting.php">					
						<!-- Data Pilihan Akun  -->
						<div class="col-md-6">									
							<div class="box">
								<div class="box-body">	
									<!-- Data Pilihan Bulan Periode  -->
									<div class="form-group">
										<label for="idperiodeini" class="col-lg-2 control-label">Periode</label>
										<div class="col-lg-10">
											<select class="form-control" id="idperiodeini" name="idperiodeini" >
											<?php
												$idperiodepilih=$_SESSION['idperiodepilih'];
												$sqlp= "SELECT idperiode, nmperiode FROM `tb_periode` ORDER BY idperiode";														
												$resultp = $mysqli->query($sqlp);
												while($barisp = $resultp->fetch_object())
												{
													$idperiode2=$barisp->idperiode; $nmperiode2=$barisp->nmperiode;  
													if($idperiode2==$idperiodepilih)
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
									</div>	
								
									<div class="form-group">
										<label for="akundb" class="col-lg-2 control-label">Akun</label>
										<div class="col-lg-10">
											<select class="form-control" id="kodeakun" name="kodeakun" >
											<?php
												$kodeakun=$_SESSION['aktif_akunbukubesar'] ;											
												$sqlk= "SELECT idakun, kodeakun, akun, tb_coa_info.idkelompok, kelompok, idjenis, jenis
														FROM tb_coa
														INNER JOIN tb_coa_info ON tb_coa.idkelompok = tb_coa_info.idkelompok
														ORDER BY kodeakun";
															
												$resultk = $mysqli->query($sqlk);
												while($barisk = $resultk->fetch_object())
												{
													$idakun=$barisk->idakun; $kodeakun1=$barisk->kodeakun; $akun1=$barisk->akun;  
													$idkelompok=$barisk->idkelompok; $kelompok=$barisk->kelompok;
													$idjenis=$barisk->idjenis; $jenis=$barisk->jenis;
													if($kodeakun1==$kodeakun)
													{
											?>
												<option value="<?php echo($kodeakun1);?>" selected><?php echo($kodeakun1 . ' - ' . $akun1 . ' - ' . $kelompok . ' - ' . $jenis);?></option>																						
											<?php
													} else {
											?>
												<option value="<?php echo($kodeakun1);?>"><?php echo($kodeakun1 . ' - ' . $akun1 . ' - ' . $kelompok . ' - ' . $jenis);?></option>											
											<?php	
													}
												}
											?>
											</select>
											<input type="hidden" name="idbukubesar" value=1>
										</div>
									</div>
									<div class="form-group">
										<div class="col-lg-12">
											<input type="submit" value="Posting Per Akun"  class="btn bg-orange btn-flat btn-block pull-right" name="submit">
										</div>
									</div>
								
								</div>
							</div>
						</div>
					</form>
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
									<b>Rincian Transaksi Akun <?php echo( '[ ' . $kodeakunpil . ' ] - ' . $akunpil . ' - ' . $akunbukubesar);?></b>
									<a class="btn bg-navy btn-xs pull-right" href="../modpgw/menu.php"><i class="fa fa-sign-out margin-r-10"></i></a>
									<a class="btn bg-orange btn-xs margin-r-5 pull-right" href="menucetak.php" target="blank"><i class="fa fa-print"></i> Cetak </a>
									<a class="btn bg-blue btn-xs margin-r-5 pull-right" href="ekspor.php" target="blank"><i class="fa fa-file-excel-o"></i> Ekspor Excel </a>

								</div>							
								<div class="box-body">
									<table class="table table-bordered table-striped" id="example1">
										<thead>
											<tr>
												<th class="text-center">IDJ</th>
												<th>No.Buku</th>
												<th>No.Bukti</th>
												<th class="text-center">Tgl.</th>
												<th>Deskripsi</th>
												<th class="text-right">Debet</th>
												<th class="text-right">Kredit</th>
												<th class="text-right">Saldo</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$nourut=1; $saldoawal=0; $saldo=0; $saldolalu=0; $labelsaldo=''; $dbawal=0; $krawal=0;
												// 	=============== cari saldo awal di tabel awal =====================================================
												$sqlawal = "SELECT idperiode, kodeakun,db,kr FROM `tb_awal`
															WHERE kodeakun=" . $akunbukubesar . " AND LEFT(idperiode,4)='" . $tahunperiode . "'
															;";
												$resultawal = $mysqli->query($sqlawal);
												$barisawal = $resultawal->fetch_object();
												$countawal = $resultawal->num_rows; 
												if($countawal>0)
												{
													$dbawal=$barisawal->db; $krawal=$barisawal->kr; 
												}
												// 	cek posisi normal debet atau kredit	
												$cek=substr($akunbukubesar,0,1); 
												if($cek==1 || $cek==5) 
												{	$labelsaldo='Debet'; $saldoawal=$dbawal; //$saldo=$tdebet-$tkredit; $saldoakhir=$saldoawal+$saldo; 
												}
												else
												{ 	$labelsaldo='Kredit'; $saldoawal=$krawal; //$saldo=$tkredit-$tdebet;  $saldoakhir=$saldoawal+$saldo; 
												}
												$saldo=$saldo+$saldoawal;
												// 	===================================================================================================
												
												// 	=============== cari rekap saldo di periode lalu =====================================================
												$sqllalu = "SELECT kodeakun, namaakun, SUM( debet ) AS tdebet, SUM( kredit ) AS tkredit, 
															IF( LEFT( kodeakun, 1 ) = '1' OR LEFT( kodeakun, 1 ) = '5', SUM( debet - kredit ) , SUM( kredit - debet ) ) AS saldo
															FROM (
																SELECT idperiode, tb_jurnal_rinci.idjurnal, tgljurnal, nobukti, nobuku, 
																deskripsi, kodemst, idbaris, kodeakun, namaakun, debet, kredit, koderinci 
																FROM tb_jurnal_rinci 
																INNER JOIN tb_jurnal_mst ON tb_jurnal_rinci.idjurnal=tb_jurnal_mst.idjurnal
															) AS data 
															WHERE kodeakun ='" . $akunbukubesar . "' 
															AND idperiode <" . $idperiodepilih . "
															GROUP BY kodeakun";

												//$sqllalu = "SELECT kodeakun, namaakun, SUM( debet ) AS tdebet, SUM( kredit ) AS tkredit, 
												//			IF( LEFT( kodeakun, 1 ) = '1' OR LEFT( kodeakun, 1 ) = '5', SUM( debet - kredit ) , SUM( kredit - debet ) ) AS saldo
												//			FROM vbukubesardua
												//			WHERE kodeakun ='" . $akunbukubesar . "' 
												//			AND idperiode <" . $idperiodepilih . "
												//			GROUP BY kodeakun";
												$resultlalu = $mysqli->query($sqllalu);
												$barislalu = $resultlalu->fetch_object();
												$countlalu = $resultlalu->num_rows; 
												if($countlalu>0)
												{
													$saldolalu=$barislalu->saldo; $dblalu=$barislalu->tdebet; $krlalu=$barislalu->tkredit; 
												}
												// 	cek posisi normal debet atau kredit	
												$cek=substr($akunbukubesar,0,1); 
												$saldo=$saldo+$saldolalu;
												// 	===================================================================================================
											?>
											<tr>
												<td align="center"><?php echo($nourut);?></td>
												<td></td>
												<td>Saldo Awal</td>
												<td align="center">00-00-0000</td>
												<td align="right"></td>
												<td align="right"></td>
												<td align="right"></td>
												<td align="right"><?php echo(number_format($saldo,2,',','.'));?></td>	
											</tr>									
											<?php	
												
												$transaksi=0; $tdebet=0; $tkredit=0; 
												$sql2= "SELECT idperiode, idjurnal, tgljurnal, nobukti, nobuku, deskripsi, idbaris, 
														kodeakun, namaakun, debet, kredit 
														FROM (
															SELECT idperiode, tb_jurnal_rinci.idjurnal, tgljurnal, nobukti, nobuku, 
															deskripsi, kodemst, idbaris, kodeakun, namaakun, debet, kredit, koderinci 
															FROM tb_jurnal_rinci 
															INNER JOIN tb_jurnal_mst ON tb_jurnal_rinci.idjurnal=tb_jurnal_mst.idjurnal
															) AS data 
														WHERE kodeakun=" . $akunbukubesar . " AND idperiode=" . $idperiodepilih . "
														ORDER BY idperiode, tgljurnal, nobuku;";
												
												//$sql2 ="SELECT idperiode, idjurnal, tgljurnal, nobukti, nobuku, deskripsi, idbaris, 
												//		kodeakun, namaakun, debet, kredit 
												//		FROM vbukubesardua WHERE kodeakun=" . $akunbukubesar . " AND idperiode=" . $idperiodepilih . "
												//		ORDER BY idperiode, tgljurnal, nobuku;";	
												$result2 = $mysqli->query($sql2);
												while($baris2 = $result2->fetch_object())
												{
													$idjurnal=$baris2->idjurnal; $tgljurnal=$baris2->tgljurnal; $nobukti=$baris2->nobukti; 
													$deskripsi=$baris2->deskripsi; $idbaris=$baris2->idbaris; $nobuku=$baris2->nobuku;
													$kodeakun=$baris2->kodeakun;   
													$namaakun=$baris2->namaakun; $debet=$baris2->debet; $kredit=$baris2->kredit; 
													$tgljurnal=formattgl($tgljurnal);  
													
													$transaksi=$transaksi+1;
													$tdebet=$tdebet+$debet;
													$tkredit=$tkredit+$kredit;
													$nourut=$nourut+1;
													// 	cek posisi normal debet atau kredit	
													$cek=substr($akunbukubesar,0,1); 
													if($cek==1 || $cek==5) 
													{	$saldo=$saldo+($debet-$kredit);  
													}
													else
													{ 	$saldo=$saldo+($kredit-$debet);   
													}
											?>									
											<tr>
												<td align="center">
													<a href="menudetil.php?kode=<?php echo(berantakan($idjurnal));?>" target="blank" class="btn bg-blue btn-xs"> 
														<?php echo($nourut);?>
													</a>
												</td>
												<td><?php echo($nobuku);?></td>
												<td><?php echo($nobukti);?></td>
												<td align="center"><?php echo($tgljurnal);?></td>
												<td><?php echo($deskripsi);?></td>
												<td align="right"><?php echo(number_format($debet,2,',','.'));?></td>
												<td align="right"><?php echo(number_format($kredit,2,',','.'));?></td>
												<td align="right"><?php echo(number_format($saldo,2,',','.'));?></td>	
											</tr>
											<?php
												}
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
												<td><b><?php echo(number_format($saldo,2,',','.'));?></b></td>												
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
		  'autoWidth'   : true		
		})
		$('#example2').DataTable({
		  'paging'      : true,
		  'lengthChange': true,
		  'searching'   : true,
		  'ordering'    : false,
		  'info'        : true,
		  'autoWidth'   : true
		})
	  })
	</script>		
</body>
</html>