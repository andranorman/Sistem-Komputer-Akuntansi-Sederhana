<?php
	session_start();
	include("../dbcon.php");
	include("../fungsi.php");
	$idperiode1=$_SESSION['idperiodepilih'];
	$nmperiode1=$_SESSION['nmperiodepilih'];	
	$tahunperiode=intval(substr($idperiode1,0,4));
		
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=arus_kas_" . $idperiode1 . ".xls");

// Tambahkan table
include("ekspor_rinci.php");
?>