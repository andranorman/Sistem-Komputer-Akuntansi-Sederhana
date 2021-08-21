<?php
include("../dbcon.php");
include("../fungsi.php");

$idperiode=$mysqli->real_escape_string($_POST['idperiode']);
$nmperiode=$mysqli->real_escape_string($_POST['nmperiode']);

$dari=$mysqli->real_escape_string($_POST['dari']);
$sampai=$mysqli->real_escape_string($_POST['sampai']);
$keterangan=$mysqli->real_escape_string($_POST['keterangan']);

$dipilih=$mysqli->real_escape_string($_POST['dipilih']);
$dari=formattglsql($dari); $sampai=formattglsql($sampai); 

$sql="INSERT INTO tb_periode( idperiode, nmperiode, dari, sampai, keterangan, dipilih ) 
	  VALUES ( ?,?,?,?,?,? ) ";
	  
$statement = $mysqli->prepare($sql);
$statement->bind_param('issssi', $idperiode, $nmperiode, $dari, $sampai, $keterangan, $dipilih );
$results =  $statement->execute();

// ===== tampilkan hasilnya ===============
$menuju = "menu.php" ;	
header("location:$menuju");echo "<script type='text/javascript'> document.location = '" . $menuju . "'; </script>";
?>