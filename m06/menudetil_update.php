<?php
session_start();
include("../dbcon.php");
include("../fungsi.php");

$idperiode=$_SESSION['aktif_idperiode'];

$idjurnal=$mysqli->real_escape_string($_POST['idjurnal']);
$tgljurnal=$mysqli->real_escape_string($_POST['tgljurnal']);
$tgljurnal=formattglsql($tgljurnal); 
$nobukti=$mysqli->real_escape_string($_POST['nobukti']);
$nobuku=$mysqli->real_escape_string($_POST['nobuku']);
$deskripsi=$mysqli->real_escape_string($_POST['deskripsi']);

$sql="UPDATE tb_jurnal_mst SET tgljurnal=?, nobukti=?, nobuku=?, deskripsi=?, idperiode=? 		
      WHERE idjurnal=?;";


$statement = $mysqli->prepare($sql);
$statement->bind_param('ssssii', $tgljurnal, $nobukti, $nobuku, $deskripsi, $idperiode, $idjurnal );

$results =  $statement->execute();

// ===== tampilkan hasilnya ===============
$menuju = "menudetil.php?idjurnal=" . $idjurnal . "&e=1" ;
echo "<script type='text/javascript'> document.location = '" . $menuju . "'; </script>";
?>