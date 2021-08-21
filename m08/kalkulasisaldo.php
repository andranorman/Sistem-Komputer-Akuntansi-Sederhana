<?php
session_start();
//error_reporting(0);
include("../dbcon.php"); include("../fungsi.php");
//$idperiode=$_SESSION['aktif_idperiode'];
$idperiode=$_SESSION['idperiodepilih'];

// tampilkan data tb_nrcsaldo
//$sql1 ="SELECT idperiode, tb_nrcsaldo.kodeakun, akun, db_koreksi, kr_koreksi, db_awal, kr_awal, db_mutasi, kr_mutasi, 
//		db_penyesuaian, kr_penyesuaian, normal, (db_awal+db_mutasi+db_penyesuaian) AS db_total,
//		(kr_awal+kr_mutasi+kr_penyesuaian) AS kr_total,
//		IF(normal='D', (db_koreksi+db_awal+db_mutasi+db_penyesuaian)-(kr_koreksi+kr_awal+kr_mutasi+kr_penyesuaian), 0) AS saldo_db, 
//		IF(normal='K', (kr_koreksi+kr_awal+kr_mutasi+kr_penyesuaian)-(db_koreksi+db_awal+db_mutasi+db_penyesuaian), 0) AS saldo_kr   
//		FROM tb_nrcsaldo 
//		INNER JOIN tb_coa ON tb_nrcsaldo.kodeakun=tb_coa.kodeakun  
//		INNER JOIN tb_coa_info ON tb_coa.idkelompok=tb_coa_info.idkelompok
//		WHERE idperiode=" . $idperiode . " ORDER BY tb_nrcsaldo.kodeakun";

$sql1 ="SELECT idperiode, tb_nrcsaldo.kodeakun, akun, db_koreksi, kr_koreksi, db_awal, kr_awal, db_mutasi, kr_mutasi, 
		db_penyesuaian, kr_penyesuaian, normal, (db_awal+db_mutasi+db_penyesuaian) AS db_total,
		(kr_awal+kr_mutasi+kr_penyesuaian) AS kr_total,
		IF(normal='D', (db_koreksi+db_awal+db_mutasi+db_penyesuaian)-(kr_koreksi+kr_awal+kr_mutasi+kr_penyesuaian), 0) AS saldo_db, 
		IF(normal='K', (kr_koreksi+kr_awal+kr_mutasi+kr_penyesuaian)-(db_koreksi+db_awal+db_mutasi+db_penyesuaian), 0) AS saldo_kr   
		FROM tb_nrcsaldo 
		INNER JOIN tb_coa ON tb_nrcsaldo.kodeakun=tb_coa.kodeakun  
		INNER JOIN tb_coa_info ON tb_coa.idkelompok=tb_coa_info.idkelompok
		ORDER BY tb_nrcsaldo.kodeakun";
														
$result1 = $mysqli->query($sql1);
$awaldb=0;
$awalkr=0;
while($baris1 = $result1->fetch_object())
{
	$idp=$baris1->idperiode; $kodeakun=$baris1->kodeakun; $db_saldo=$baris1->saldo_db; $kr_saldo=$baris1->saldo_kr;      
	$sql1b="UPDATE tb_nrcsaldo SET db_saldo=?, kr_saldo=? WHERE kodeakun=?;";
		  
	$statement = $mysqli->prepare($sql1b);
	$statement->bind_param('iii', $db_saldo, $kr_saldo, $kodeakun );
	$results =  $statement->execute();	
}

// ===== tampilkan hasilnya ===============
$menuju = "menu.php" ;	
echo "<script type='text/javascript'> document.location = '" . $menuju . "'; </script>";

?>