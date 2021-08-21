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
			  <h1>Edit Data Laporan Ekuitas<small></small></h1>
			  <ol class="breadcrumb">
				<li><a href="../modpgw/menu.php"><i class="fa fa-dashboard"></i> Beranda </a></li>
				<li><a href="lap_ekuitas.php"><i></i> Laporan Ekuitas </a></li>
				<li><a href="#"><i></i> Edit Data Laporan Ekuitas </a></li>
			  </ol>
			</section>
			<!-- ./ content header (Page header) -->
			
			<!-- Main content -->
			<section class="content container-fluid">
				<form name="form1" method="POST" action="lap_ekuitas_edit_proses.php" class="form-horizontal">
						<?php
							$j=$_REQUEST['j'];
							$id=$_REQUEST['id'];
							$sql2 ="SELECT id, kelompok, deskripsi, nilai, kodeakun, tingkat, dk FROM ekuitas WHERE id=" . $id ;	
							$result2 = $mysqli->query($sql2);
							while($baris2 = $result2->fetch_object())
							{
								$id=$baris2->id; $kelompok=$baris2->kelompok; $deskripsi=$baris2->deskripsi; 
								$nilai=$baris2->nilai; $kodeakun=$baris2->kodeakun; $tingkat=$baris2->tingkat; $dk=$baris2->dk;
						?>				
				<div class="row">
					<!-- kolom kiri -->
					<div class="col-md-8">								
						<div class="box box-primary">						
							<div class="box-header  with-border">
								<b><i class="fa fa-edit"></i> Edit Data Item Laporan Ekuitas
								<a href="lap_ekuitas.php" class="btn btn-xs bg-navy margin-r-5 pull-right"><i class="fa fa-sign-out"></i> </a>
								</b>
							</div>
							<div class="box-body box-profile">
								<!-- Setup ID   -->
								<div class="form-group">
									<label for="id" class="col-md-4 control-label">Kode Baris</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="id1" value="<?php echo($id);?>" disabled>
										<input type="hidden" class="form-control" name="id" value="<?php echo($id);?>" >
										<input type="hidden" class="form-control" name="j" value="<?php echo($j);?>" >
									</div>
								</div>
								<!-- Setup Kelompok   -->
								<div class="form-group">
									<label for="kelompok" class="col-md-4 control-label">Kelompok</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="kelompok" value="<?php echo($kelompok);?>" >
									</div>
								</div>
								<!-- Setup Deskripsi -->
								<div class="form-group">
									<label for="deskripsi" class="col-md-4 control-label">Deskripsi</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="deskripsi" value="<?php echo($deskripsi);?>" >
									</div>
								</div>
								<!-- Setup Nilai -->
								<div class="form-group">
									<label for="nilai" class="col-md-4 control-label">Nilai</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="nilai" value="<?php echo($nilai);?>" >
									</div>
								</div>

							<?php 
								if($j==1)
								{
							?>
								<!-- Setup Tipe  -->
								<div class="form-group">
									<label for="tipe" class="col-md-4 control-label">Akun Sumber Data</label>
									<div class="col-md-8">
										<select class="form-control" id="kodeakun" name="kodeakun" >
											<option value=0 >- Pilih Kelompok Akun Operasional -</option>
										<?php
										if($tingkat==4)
										{	$sql3 ="SELECT idcoa_info, idkelompok AS idakunsumber, kelompok AS namaakunsumber FROM tb_coa_info
													ORDER BY idkelompok";
										}
										elseif($tingkat==3)
										{	$sql3 ="SELECT idcoa_info, idjenis AS idakunsumber, jenis AS namaakunsumber FROM tb_coa_info
													GROUP BY idjenis";
										}										
										else
										{	$sql3 ="SELECT idcoa_info, idkelompok AS idakunsumber, kelompok AS namaakunsumber FROM tb_coa_info
													ORDER BY idkelompok";
										}
										
										$result3 = $mysqli->query($sql3);
										while($baris3 = $result3->fetch_object())
										{
											$idakunsumber=$baris3->idakunsumber; $namaakunsumber=$baris3->namaakunsumber;										
											if($kodeakun>0)
											{
												if($idakunsumber==$kodeakun) 
													{ 
										?>
											<option value=<?php echo($idakunsumber);?> selected><?php echo($idakunsumber . " - " . $namaakunsumber);?></option>
										<?php		} else 	
													{ 
										?>
											<option value=<?php echo($idakunsumber);?> ><?php echo($idakunsumber . " - " . $namaakunsumber);?></option>
										<?php		} 
											}
											else
											{
										?>
											<option value=<?php echo($idakunsumber);?> ><?php echo($idakunsumber . " - " . $namaakunsumber);?></option>
										<?php
											}
										}
										?>
										</select>
									</div>
								</div>								

								<!-- Setup Nama Tingkat -->
								<div class="form-group">
									<label for="tipe" class="col-md-4 control-label">Level Akun</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="tingkat1" value="<?php echo($tingkat);?>" >
										<input type="hidden" class="form-control" name="tingkat" value="<?php echo($tingkat);?>" >
									</div>
								</div>

								<!-- Setup Posisi Debet/Kredit -->
								<div class="form-group">
									<label for="tipe" class="col-md-4 control-label">Posisi Debet/Kredit</label>
									<div class="col-md-8">
										<input type="text" class="form-control" name="dk1" value="<?php echo($dk);?>" >
										<input type="hidden" class="form-control" name="dk" value="<?php echo($dk);?>" >
									</div>
								</div>
						<?php
								}
						?>
							</div>
						</div>
						
						<div class="box">						
							<div class="box-body box-profile">					
							
								<div class="form-group">
									<div class="col-md-12">	
										<input type="submit" value="Simpan"  class="btn btn-success btn-flat col-md-3 margin-r-5" name="submit">
										<a href="lap_ekuitas.php"  class="btn btn-warning btn-flat col-md-3 pull-right">Tutup</a> 
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