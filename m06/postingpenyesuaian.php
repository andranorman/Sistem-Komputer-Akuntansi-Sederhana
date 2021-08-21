<?php
session_start();
//error_reporting(0);
include("../dbcon.php"); include("../fungsi.php");
$idperiode=$_SESSION['aktif_idperiode'];


// isi data mutasi debet ke tb_nrcsaldo
$sql1= "SELECT idperiode, kodeakun, namaakun, COUNT( kodeakun ) AS transaksi, SUM( debet ) AS tdebet, SUM( kredit ) AS tkredit
		FROM `vbukubesar`
		WHERE idperiode =" . $idperiode . " AND koderinci=1 
		GROUP BY kodeakun";

$result1 = $mysqli->query($sql1);
$awaldb=0;
$awalkr=0;
while($baris1 = $result1->fetch_object())
{
	$idp=$baris1->idperiode; $kodeakun=$baris1->kodeakun; $db_penyesuaian=$baris1->tdebet; $kr_penyesuaian=$baris1->tkredit;      
	$sql1b="UPDATE tb_nrcsaldo SET db_penyesuaian=?, kr_penyesuaian=? WHERE kodeakun=?;";
		  
	$statement = $mysqli->prepare($sql1b);
	$statement->bind_param('iii', $db_penyesuaian, $kr_penyesuaian, $kodeakun );
	$results =  $statement->execute();	
}

// ===== tampilkan hasilnya ===============
$menuju = "menurekap.php" ;	
echo "<script type='text/javascript'> document.location = '" . $menuju . "'; </script>";

?>