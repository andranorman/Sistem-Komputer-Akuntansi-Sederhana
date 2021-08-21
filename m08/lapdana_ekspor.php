<?php
	session_start();
	include("../dbcon.php");
	include("../fungsi.php");

	//$idperiode1=$_SESSION['aktif_idperiode'];
	//$nmperiode1=$_SESSION['aktif_nmperiode'];	
	$idperiode1=$_SESSION['idperiodepilih'];
	$nmperiode1=$_SESSION['nmperiodepilih'];
	$tgllapdana=$_SESSION['aktif_sampai'];
	$tgllapdana=formattgl($tgllapdana);
	$nmdirektur=$_SESSION['nmdirektur'];
	$nipdirektur=$_SESSION['nipdirektur'];
	
	$tahunperiode=intval(substr($idperiode1,0,4));
		
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=lap_operasional_periode_" . $idperiode1 . ".xls");

// Tambahkan table
include("lapdana_ekspor_rinci.php");
?>