<?php
include("../dbcon.php");
include("../fungsi.php");

$kodeakun=$mysqli->real_escape_string($_POST['kodeakun']);
$akun=$mysqli->real_escape_string($_POST['akun']);
$idkelompok=$mysqli->real_escape_string($_POST['idkelompok']);
$idlaporan=$mysqli->real_escape_string($_POST['idlaporan']);

$sql="INSERT INTO tb_coa( kodeakun, akun, idkelompok, idlaporan ) 
	  VALUES ( ?,?,?,? ) ;";	  
	  
$statement = $mysqli->prepare($sql);
$statement->bind_param('isii', $kodeakun, $akun, $idkelompok, $idlaporan );
$results =  $statement->execute();

// ===== tampilkan hasilnya ===============
$menuju = "menu.php" ;	
echo "<script type='text/javascript'> document.location = '" . $menuju . "'; </script>";

?>