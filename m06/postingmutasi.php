<?php
session_start();
//error_reporting(0);
include("../dbcon.php"); include("../fungsi.php");
$idperiode=$_SESSION['aktif_idperiode'];


// isi data mutasi debet ke tb_nrcsaldo
//$sql1= "SELECT idperiode, kodeakun, namaakun, COUNT( kodeakun ) AS transaksi, SUM( debet ) AS tdebet, SUM( kredit ) AS tkredit
//		FROM `vbukubesar`
//		WHERE idperiode =" . $idperiode . " AND koderinci=0 
//		GROUP BY kodeakun";

$sql1 ="SELECT idperiode, kodeakun, namaakun, SUM( debet ) AS tdebet, SUM( kredit ) AS tkredit
		FROM `tb_jurnal_rinci`
		INNER JOIN tb_jurnal_mst ON tb_jurnal_mst.idjurnal = tb_jurnal_rinci.idjurnal
		WHERE idperiode =" . $idperiode . " AND koderinci=0
		GROUP BY kodeakun";

$result1 = $mysqli->query($sql1);
$awaldb=0;
$awalkr=0;
while($baris1 = $result1->fetch_object())
{
	$idp=$baris1->idperiode; $kodeakun=$baris1->kodeakun; $db_mutasi=$baris1->tdebet; $kr_mutasi=$baris1->tkredit;      
	$sql1b="UPDATE tb_nrcsaldo SET db_mutasi=?, kr_mutasi=? WHERE kodeakun=?;";
		  
	$statement = $mysqli->prepare($sql1b);
	$statement->bind_param('iii', $db_mutasi, $kr_mutasi, $kodeakun );
	$results =  $statement->execute();	
}


// ===== tampilkan hasilnya ===============
$menuju = "menurekap.php" ;	
echo "<script type='text/javascript'> document.location = '" . $menuju . "'; </script>";

?>