<?php
session_start();
include("../dbcon.php");
include("../fungsi.php");

$idjurnal=$mysqli->real_escape_string($_POST['idjurnal']);
$kodeakun=$mysqli->real_escape_string($_POST['kodeakun']);
$debet=$mysqli->real_escape_string($_POST['debet']);
$kredit=$mysqli->real_escape_string($_POST['kredit']);

// cari nama akun

$sqla = "SELECT kodeakun, akun FROM `tb_coa` WHERE kodeakun=" . $kodeakun . ";";

$resulta = $mysqli->query($sqla);
while($barisa = $resulta->fetch_object())
{
	$namaakun=$barisa->akun;
}	

$sql="INSERT INTO tb_jurnal_rinci ( idjurnal, kodeakun, namaakun, debet, kredit ) 
	  VALUES ( ?,?,?,?,? ) ";
	  
$statement = $mysqli->prepare($sql);
$statement->bind_param('iisii', $idjurnal, $kodeakun, $namaakun, $debet, $kredit );
$results =  $statement->execute();

// ===== tampilkan hasilnya ===============
//$menuju = "menu.php?idkelompok=" . $idkelompok . "&kelompok=". $kelompok ;	
$menuju="menudetil.php?idjurnal=" . $idjurnal;
echo "<script type='text/javascript'> document.location = '" . $menuju . "'; </script>";
?>