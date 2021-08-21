<?php
include("../dbcon.php");
include("../fungsi.php");

// idaruskas, tipe, kodekel, namakel, kodeakun, noaruskas, namaaruskas, tingkat, dk, debet, kredit

$idaruskas=$mysqli->real_escape_string($_POST['idaruskas']);
$tipe=$mysqli->real_escape_string($_POST['tipe']);
$kodekel=$mysqli->real_escape_string($_POST['kodekel']);
$namakel=$mysqli->real_escape_string($_POST['namakel']);
$kodeakun=$mysqli->real_escape_string($_POST['kodeakun']);
$noaruskas=$mysqli->real_escape_string($_POST['noaruskas']);
$namaaruskas=$mysqli->real_escape_string($_POST['namaaruskas']);
//$tingkat=$mysqli->real_escape_string($_POST['tingkat']);
//$dk=$mysqli->real_escape_string($_POST['dk']);
$debet=$mysqli->real_escape_string($_POST['debet']);
$kredit=$mysqli->real_escape_string($_POST['kredit']);

$sql="UPDATE aruskas SET tipe=?, kodekel=?, namakel=?, kodeakun=?, noaruskas=?, namaaruskas=?, debet=?, kredit=?   			
      WHERE idaruskas=?;";

$statement = $mysqli->prepare($sql);
$statement->bind_param('sisissiii', $tipe, $kodekel, $namakel, $kodeakun, $noaruskas, $namaaruskas, $debet, $kredit, $idaruskas );
$results =  $statement->execute();

// ===== tampilkan hasilnya ===============
$menuju = "aruskassetup.php" ;	
echo "<script type='text/javascript'> document.location = '" . $menuju . "'; </script>";
?>