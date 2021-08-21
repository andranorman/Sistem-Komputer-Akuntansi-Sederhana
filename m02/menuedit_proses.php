<?php
include("../dbcon.php");
include("../fungsi.php");

$idakun=$mysqli->real_escape_string($_POST['idakun']);
$kodeakun=$mysqli->real_escape_string($_POST['kodeakun']);
$kodeakun2=$mysqli->real_escape_string($_POST['kodeakun2']);
$akun=$mysqli->real_escape_string($_POST['akun']);
$idkelompok=$mysqli->real_escape_string($_POST['idkelompok']);
$idlaporan=$mysqli->real_escape_string($_POST['idlaporan']);

// update tabel akun operasional
$sql="UPDATE tb_coa SET kodeakun=?, akun=?, idkelompok=?, idlaporan=?   			
      WHERE idakun=?;";

$statement = $mysqli->prepare($sql);
$statement->bind_param('isiii', $kodeakun2, $akun, $idkelompok, $idlaporan, $idakun );
$results =  $statement->execute();

// ===== tampilkan hasilnya ===============
$menuju = "menu.php" ;	
echo "<script type='text/javascript'> document.location = '" . $menuju . "'; </script>";
?>