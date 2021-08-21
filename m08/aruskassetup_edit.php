<?php
//error_reporting(0);
// boc: -- cek sesi user --
session_start();
$cek_user=$_SESSION['simkeu'];
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
			<!-- content header (Page header) -->
			<section class="content-header">
			  <h1>Pengaturan Akun dan Kalkulasi Arus Kas<small></small></h1>
			  <ol class="breadcrumb">
				<li><a href="../modpgw/menu.php"><i class="fa fa-dashboard"></i> Beranda </a></li>
				<li><a href="aruskassetup.php"><i></i> Arus Kas </a></li>
				<li><a href="#"><i></i> Pengaturan </a></li>
			  </ol>
			</section>
			<!-- ./ content header (Page header) -->
			
			<!-- Main content -->
			<section class="content container-fluid">
				<form name="form1" method="POST" action="aruskassetup_edit_proses.php" class="form-horizontal">
						<?php
							$idaruskas=$_REQUEST['idaruskas'];
							$sql2 ="SELECT idaruskas, tipe, kodekel, namakel, kodeakun, noaruskas, namaaruskas, tingkat, dk, debet, kredit 
									FROM aruskas WHERE idaruskas='" . $idaruskas . "' ORDER BY idaruskas";	
							$result2 = $mysqli->query($sql2);
							while($baris2 = $result2->fetch_object())
							{
								$idaruskas=$baris2->idaruskas; $tipe=$baris2->tipe; $kodekel=$baris2->kodekel; 
								$namakel=$baris2->namakel; $kodeakun=$baris2->kodeakun; $noaruskas=$baris2->noaruskas; 
								$namaaruskas=$baris2->namaaruskas; $tingkat=$baris2->tingkat; $dk=$baris2->dk;
								$debet=$baris2->debet; $kredit=$baris2->kredit;
						?>				
				<div class="row">
					<!-- kolom kiri -->
					<div class="col-md-8">								
						<div class="box box-primary">						
							<div class="box-header  with-border">
								<b><i class="fa fa-edit"></i> Edit Data Item Arus Kas
								<a href="aruskassetup.php" class="btn btn-xs bg-navy margin-r-5 pull-right"><i class="fa fa-sign-out"></i> </a>
								</b>
							</div>
							<div class="box-body box-profile">
								<!-- Setup Kode Arus Kas   -->
								<div class="form-group">
									<label for="idaruskas" class="col-md-4 control-label">Kode Baris</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="idaruskas1" value="<?php echo($idaruskas);?>" disabled>
										<input type="hidden" class="form-control" name="idaruskas" value="<?php echo($idaruskas);?>" >
									</div>
								</div>
								<!-- Setup Kode Kelompok   -->
								<div class="form-group">
									<label for="kodekel" class="col-md-4 control-label">Kode Kelompok</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="kodekel" value="<?php echo($kodekel);?>" >
									</div>
								</div>
								<!-- Setup Nama Kelompok -->
								<div class="form-group">
									<label for="namakel" class="col-md-4 control-label">Nama Kelompok</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="namakel" value="<?php echo($namakel);?>" >
									</div>
								</div>
								<!-- Setup Nama Tipe -->
								<div class="form-group">
									<label for="tipe" class="col-md-4 control-label">Tipe</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="tipe" value="<?php echo($tipe);?>" >
									</div>
								</div>

								<!-- Setup Tipe  -->
								<div class="form-group">
									<label for="tipe" class="col-md-4 control-label">Akun Sumber Data</label>
									<div class="col-md-8">
										<select class="form-control" id="kodeakun" name="kodeakun" >
										<?php
										if($tingkat==4)
										{	$sql3 ="SELECT idcoa_info, idkelompok AS idakunsumber, kelompok AS namaakunsumber FROM tb_coa_info
													ORDER BY idkelompok";
										}
										elseif($tingkat==3)
										{	$sql3 ="SELECT idcoa_info, idjenis AS idakunsumber, jenis AS namaakunsumber FROM tb_coa_info
													GROUP BY idjenis";
										}										
										
										$result3 = $mysqli->query($sql3);
										while($baris3 = $result3->fetch_object())
										{
											$idakunsumber=$baris3->idakunsumber; $namaakunsumber=$baris3->namaakunsumber;										
											if($idakunsumber==$kodeakun) { 
										?>
											<option value=<?php echo($idakunsumber);?> selected><?php echo($idakunsumber . " - " . $namaakunsumber);?></option>
										<?php	} else 	{ 
										?>
											<option value=<?php echo($idakunsumber);?> ><?php echo($idakunsumber . " - " . $namaakunsumber);?></option>
										<?php	} 
										}
										?>
										</select>
									</div>
								</div>								

								<!-- Setup Nama Tingkat -->
								<div class="form-group">
									<label for="tipe" class="col-md-4 control-label">Level Akun</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="tingkat1" value="<?php echo($tingkat);?>" disabled >
										<input type="hidden" class="form-control" name="tingkat" value="<?php echo($tingkat);?>" >
									</div>
								</div>

								<!-- Setup Posisi Debet/Kredit -->
								<div class="form-group">
									<label for="tipe" class="col-md-4 control-label">Posisi Debet/Kredit</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="dk1" value="<?php echo($dk);?>" disabled>
										<input type="hidden" class="form-control" name="dk" value="<?php echo($dk);?>" >
									</div>
								</div>

								<!-- Setup No Item Arus Kas   -->
								<div class="form-group">
									<label for="noaruskas" class="col-md-4 control-label">No.Arus.Kas</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="noaruskas" value="<?php echo($noaruskas);?>" >
									</div>
								</div>
								<!-- Setup Nama Item Arus Kas -->
								<div class="form-group">
									<label for="namaaruskas" class="col-md-4 control-label">Nama Item Arus Kas</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="namaaruskas" value="<?php echo($namaaruskas);?>" >
									</div>
								</div>
								<!-- Setup Debet   -->
								<div class="form-group">
									<label for="debet" class="col-md-4 control-label">Debet</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="debet" value="<?php echo($debet);?>" >
									</div>
								</div>
								<!-- Setup No Item Arus Kas   -->
								<div class="form-group">
									<label for="kredit" class="col-md-4 control-label">No.Arus.Kas</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="kredit" value="<?php echo($kredit);?>" >
									</div>
								</div>
								
							</div>
						</div>
						
						<div class="box">						
							<div class="box-body box-profile">					
							
								<div class="form-group">
									<div class="col-md-12">	
								<?php $m06=$_SESSION['m06']; if($m06=='a') { ?>
										<input type="submit" value="Simpan"  class="btn btn-success btn-flat col-md-3 margin-r-5" name="submit">
								<?php 	} ?>
										<a href="aruskassetup.php"  class="btn btn-warning btn-flat col-md-3 pull-right">Tutup</a> 
									</div>	
								</div>
							</div>
							<!-- /.box-body -->
						</div>						
						
					</div>
						<?php
							}
						?>
						
				</div>
				</form>
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