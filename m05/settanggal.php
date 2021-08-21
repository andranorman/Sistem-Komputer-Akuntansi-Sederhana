<?php
session_start();
//error_reporting(0);
include("../dbcon.php"); include("../fungsi.php"); 
$idperiodepilih=$_POST['idperiodepilih'];
// cari nama periode aktif
$sql1 ="SELECT idperiode, nmperiode, dari, sampai, dipilih
		FROM `tb_periode` WHERE idperiode =" . $idperiodepilih . "";
$result1 = $mysqli->query($sql1);
while($baris1 = $result1->fetch_object())
{
	$nmperiode=$baris1->nmperiode;
	$_SESSION['nmperiodepilih']=$nmperiode;
	$_SESSION['idperiodepilih']=$idperiodepilih;
}	

// ===== tampilkan hasilnya ===============
$menuju = "menu.php" ;	
echo "<script type='text/javascript'> document.location = '" . $menuju . "'; </script>";

?>