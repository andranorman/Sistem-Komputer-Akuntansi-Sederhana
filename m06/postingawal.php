<?php
session_start();
//error_reporting(0);
include("../dbcon.php"); include("../fungsi.php");
$idperiode=$_SESSION['aktif_idperiode'];

// hapus data di tabel tb_nrcsaldo
$sqlp ="DELETE FROM tb_nrcsaldo";
$resultp = $mysqli->query($sqlp);
$statement = $mysqli->prepare($sqlp);
$results =  $statement->execute();

// isi data saldo awal ke tb_nrcsaldo
$sql1 ="SELECT idperiode, kodeakun, db, kr FROM `tb_awal` WHERE idperiode=" . $idperiode . " ORDER BY kodeakun";
$result1 = $mysqli->query($sql1);
$awaldb=0;
$awalkr=0;
while($baris1 = $result1->fetch_object())
{
	$idp=$baris1->idperiode; $kodeakun=$baris1->kodeakun; $awaldb=$baris1->db; $awalkr=$baris1->kr;    
	$sql1b="INSERT INTO tb_nrcsaldo( idperiode, kodeakun, db_awal, kr_awal ) 
		  VALUES ( ?,?,?,? ) ;";	  
		  
	$statement = $mysqli->prepare($sql1b);
	$statement->bind_param('iiii', $idp, $kodeakun, $awaldb, $awalkr );
	$results =  $statement->execute();	
}
// ===== tampilkan hasilnya ===============
$menuju = "menurekap.php" ;	
echo "<script type='text/javascript'> document.location = '" . $menuju . "'; </script>";
?>
