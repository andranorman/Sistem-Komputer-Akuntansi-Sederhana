<?php
session_start();
include("../dbcon.php");
include("../fungsi.php");

$idperiode=$_SESSION['aktif_idperiode'];
$sql1 ="SELECT kodeakun FROM `tb_coa` ORDER BY kodeakun";
$result1 = $mysqli->query($sql1);
$nilaidb=0;
$nilaikr=0;
while($baris1 = $result1->fetch_object())
{
	$kodeakun=$baris1->kodeakun; 

	$sql="INSERT INTO tb_awal( idperiode, kodeakun, db, kr ) 
		  VALUES ( ?,?,?,? ) ;";	  
		  
	$statement = $mysqli->prepare($sql);
	$statement->bind_param('iiii', $idperiode, $kodeakun, $nilaidb, $nilaikr );
	$results =  $statement->execute();	

}
// ===== tampilkan hasilnya ===============
$menuju = "menu.php" ;	
echo "<script type='text/javascript'> document.location = '" . $menuju . "'; </script>";
?>