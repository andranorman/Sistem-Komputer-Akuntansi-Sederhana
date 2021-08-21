<?php
session_start();
//error_reporting(0);
include("../dbcon.php"); include("../fungsi.php"); 

$idbukubesar=$_POST['idbukubesar'];
$kodeakun=$_POST['kodeakun'];
$_SESSION['aktif_akunbukubesar']=$kodeakun ;
$_SESSION['aktif_idbukubesar']=0;

$idperiodeini=$mysqli->real_escape_string($_POST['idperiodeini']);

	// cari periode akuntansi aktif
	$sql1 ="SELECT idperiode, nmperiode, dari, sampai, dipilih
			FROM `tb_periode` WHERE idperiode=" . $idperiodeini ;
	$result1 = $mysqli->query($sql1);
	while($baris1 = $result1->fetch_object())
	{
		$idperiode=$baris1->idperiode; $nmperiode=$baris1->nmperiode;
		$dari=$baris1->dari; $sampai=$baris1->sampai;  
		$_SESSION['nmperiodepilih']=$nmperiode;
		$_SESSION['idperiodepilih']=$idperiodeini ;
	}


// ===== tampilkan hasilnya ===============
$menuju = "menu.php" ;	
echo "<script type='text/javascript'> document.location = '" . $menuju . "'; </script>";

?>