<?php
session_start();
include("../dbcon.php");
include("../fungsi.php");

$idperiode=$_SESSION['idperiodepilih']; 			
//$idkelompok=$mysqli->real_escape_string($_POST['idkelompok']);
//$kelompok=$mysqli->real_escape_string($_POST['kelompok']);

$idjurnal=$mysqli->real_escape_string($_POST['idjurnal']);
$tgljurnal=$mysqli->real_escape_string($_POST['tgljurnal']);
$tgljurnal=formattglsql($tgljurnal); 
$nobuku=$mysqli->real_escape_string($_POST['nobuku']);
$nobukti=$mysqli->real_escape_string($_POST['nobukti']);
$deskripsi=$mysqli->real_escape_string($_POST['deskripsi']);

$sql="UPDATE tb_jurnal_mst SET tgljurnal=?, nobukti=?, nobuku=?, deskripsi=?, idperiode=? 		
      WHERE idjurnal=?;";

//$sql="UPDATE tb_jurnal SET tgltran=?, nobukti=?, deskripsi=?, npm=?, kddosen=?, nilaiterbilang=?, akundb=?, akuncr=?, nilai=?, idperiode=? 		
//      WHERE idtran=?;";

$statement = $mysqli->prepare($sql);
//$statement->bind_param('ssssssiiiii', $tgltran, $nobukti, $deskripsi, $npm, $kddosen, $nilaiterbilang, $akundb, $akuncr, $nilai, $idperiode, $idtran );
$statement->bind_param('ssssii', $tgljurnal, $nobukti, $nobuku, $deskripsi, $idperiode, $idjurnal );

$results =  $statement->execute();

// ===== tampilkan hasilnya ===============
$menuju = "menu.php" ;	
echo "<script type='text/javascript'> document.location = '" . $menuju . "'; </script>";
?>