<?php
session_start();
//error_reporting(0);
include("../dbcon.php"); include("../fungsi.php");
$idperiode=$_SESSION['aktif_idperiode'];

// ------ kosongkan dulu nilai tiap akun di tabel arus kas ----------------------------------
// tampilkan data arus kas existing sebagai acuan looping
$sql1 ="SELECT kodeakun, debet, kredit FROM aruskas WHERE kodeakun>0";
$result1 = $mysqli->query($sql1);
$kosong=0;
while($baris1 = $result1->fetch_object())
{
	$kodeakun_acuan=$baris1->kodeakun;       
	$sql1b="UPDATE aruskas SET debet=?, kredit=? WHERE kodeakun=?;";		  
	$statement = $mysqli->prepare($sql1b);
	$statement->bind_param('iii', $kosong, $kosong, $kodeakun_acuan );
	$results =  $statement->execute();	
}

// ------ baru kemudian isikan nilai tiap akun di tabel arus kas ----------------------------------
// tampilkan data arus kas existing sebagai acuan looping
$sql1 ="SELECT kodeakun, tingkat, dk FROM aruskas WHERE kodeakun>0";
$result1 = $mysqli->query($sql1);
while($baris1 = $result1->fetch_object())
{
	$kodeakun_acuan=$baris1->kodeakun; $tingkat=$baris1->tingkat; $dk=$baris1->dk; 
	if($tingkat==3)
	{
		//$sql2 ="SELECT idperiode, idjenis, jenis, SUM(db_mutasi) AS saldodb, SUM(kr_mutasi) AS saldokr 
		//		FROM tb_nrcsaldo 
		//		INNER JOIN tb_coa ON tb_nrcsaldo.kodeakun=tb_coa.kodeakun
		//		INNER JOIN tb_coa_info ON tb_coa.idkelompok=tb_coa_info.idkelompok
		//		WHERE idperiode=" . $idperiode . " AND idjenis=" . $kodeakun_acuan . "
		//		GROUP BY idjenis";
		$sql2 ="SELECT idperiode, idjenis, jenis, SUM(db_mutasi) AS saldodb, SUM(kr_mutasi) AS saldokr 
				FROM tb_nrcsaldo 
				INNER JOIN tb_coa ON tb_nrcsaldo.kodeakun=tb_coa.kodeakun
				INNER JOIN tb_coa_info ON tb_coa.idkelompok=tb_coa_info.idkelompok
				WHERE idjenis=" . $kodeakun_acuan . "
				GROUP BY idjenis";
	}
	elseif($tingkat==4)
	{
		//$sql2 ="SELECT idperiode, tb_coa.idkelompok, kelompok, SUM(db_mutasi) AS saldodb, SUM(kr_mutasi) AS saldokr 
		//		FROM tb_nrcsaldo 
		//		INNER JOIN tb_coa ON tb_nrcsaldo.kodeakun=tb_coa.kodeakun
		//		INNER JOIN tb_coa_info ON tb_coa.idkelompok=tb_coa_info.idkelompok
		//		WHERE idperiode=" . $idperiode . " AND tb_coa.idkelompok=" . $kodeakun_acuan . "
		//		GROUP BY tb_coa.idkelompok";
		$sql2 ="SELECT idperiode, tb_coa.idkelompok, kelompok, SUM(db_mutasi) AS saldodb, SUM(kr_mutasi) AS saldokr 
				FROM tb_nrcsaldo 
				INNER JOIN tb_coa ON tb_nrcsaldo.kodeakun=tb_coa.kodeakun
				INNER JOIN tb_coa_info ON tb_coa.idkelompok=tb_coa_info.idkelompok
				WHERE tb_coa.idkelompok=" . $kodeakun_acuan . "
				GROUP BY tb_coa.idkelompok";
	}
	
	$result2 = $mysqli->query($sql2);
	while($baris2 = $result2->fetch_object())
	{
		if($dk=='D')
		{	$saldodb=$baris2->saldodb; $saldokr=0; 	}
		else
		{	$saldodb=0; $saldokr=$baris2->saldokr; 	}

		$sql3="UPDATE aruskas SET kredit=?, debet=? WHERE kodeakun=?;";		  
		$statement = $mysqli->prepare($sql3);
		$statement->bind_param('iii', $saldodb, $saldokr, $kodeakun_acuan );
		$results =  $statement->execute();	
	}
}
// ===== tampilkan hasilnya ===============
$menuju = "aruskas.php" ;	
echo "<script type='text/javascript'> document.location = '" . $menuju . "'; </script>";
?>