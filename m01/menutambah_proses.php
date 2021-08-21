<?php
include("../dbcon.php");
include("../fungsi.php");

$idkelompok=$mysqli->real_escape_string($_POST['idkelompok']);
$kelompok=$mysqli->real_escape_string($_POST['kelompok']);
$idjenis=$mysqli->real_escape_string($_POST['idjenis']);
$jenis=$mysqli->real_escape_string($_POST['jenis']);
$normal=$mysqli->real_escape_string($_POST['normal']);

$sql="INSERT INTO tb_coa_info( idkelompok, kelompok, idjenis, jenis, normal  ) 
	  VALUES ( ?,?,?,?,? ) ;";		  
	  
$statement = $mysqli->prepare($sql);
$statement->bind_param('isiss', $idkelompok, $kelompok, $idjenis, $jenis, $normal );
$results =  $statement->execute();

// ===== tampilkan hasilnya ===============
$menuju = "menu.php" ;	
echo "<script type='text/javascript'> document.location = '" . $menuju . "'; </script>";?>
