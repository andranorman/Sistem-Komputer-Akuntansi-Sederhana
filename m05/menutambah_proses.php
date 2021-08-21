<?php
session_start();
include("../dbcon.php");
include("../fungsi.php");

//$idperiode=$_SESSION['aktif_idperiode'];
$idperiode=$_SESSION['idperiodepilih']; // -- periode berdasarkan pilihan bulan

$tgljurnal=$mysqli->real_escape_string($_POST['tgljurnal']);
$tgljurnal=formattglsql($tgljurnal); 
$nobukti=$mysqli->real_escape_string($_POST['nobukti']);
$nobuku=$mysqli->real_escape_string($_POST['nobuku']);
$deskripsi=$mysqli->real_escape_string($_POST['deskripsi']);

$sql="INSERT INTO tb_jurnal_mst ( tgljurnal, nobukti, nobuku, deskripsi, idperiode ) 
	  VALUES ( ?,?,?,?,? ) ";
	  
$statement = $mysqli->prepare($sql);
$statement->bind_param('ssssi', $tgljurnal, $nobukti, $nobuku, $deskripsi, $idperiode );
$results =  $statement->execute();

// ===== tampilkan hasilnya ===============
//$menuju = "menu.php?idkelompok=" . $idkelompok . "&kelompok=". $kelompok ;	
$menuju="menu.php";
echo "<script type='text/javascript'> document.location = '" . $menuju . "'; </script>";
?>