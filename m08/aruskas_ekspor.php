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
		
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=arus_kas_" . $idperiode1 . ".xls");

// Tambahkan table
include("aruskas_ekspor_rinci.php");
?>