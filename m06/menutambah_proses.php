<?php
session_start();
include("../dbcon.php");
include("../fungsi.php");

$tgljurnal=$mysqli->real_escape_string($_POST['tgljurnal']);
$tgljurnal=formattglsql($tgljurnal); 

$nobukti=$mysqli->real_escape_string($_POST['nobukti']);
$nobuku=$mysqli->real_escape_string($_POST['nobuku']);
$deskripsi=$mysqli->real_escape_string($_POST['deskripsi']);
$akundebet=$mysqli->real_escape_string($_POST['akundebet']);
$akunkredit=$mysqli->real_escape_string($_POST['akunkredit']);
$nominal=$mysqli->real_escape_string($_POST['nominal']);
$idperiode=$_SESSION['aktif_idperiode'];
$nol=0;

// cari nama akun debet dari field id akun debet
$sqlcari1 = "SELECT kodeakun, akun FROM `tb_coa` WHERE kodeakun=" . $akundebet . ";";
$resultcari1 = $mysqli->query($sqlcari1);
while($bariscari1 = $resultcari1->fetch_object())
{	$namaakundebet=$bariscari1->akun;
} 
// cari nama akun debet dari field id akun kredit
$sqlcari1 = "SELECT kodeakun, akun FROM `tb_coa` WHERE kodeakun=" . $akunkredit . ";";
$resultcari1 = $mysqli->query($sqlcari1);
while($bariscari1 = $resultcari1->fetch_object())
{	$namaakunkredit=$bariscari1->akun;
} 
// simpan di tb_jurnal_mst dahulu
$sql="INSERT INTO tb_jurnal_mst ( tgljurnal, nobukti, nobuku, deskripsi, idperiode ) 
	  VALUES ( ?,?,?,?,? ) ";  
$statement = $mysqli->prepare($sql);
$statement->bind_param('ssssi', $tgljurnal, $nobukti, $nobuku, $deskripsi, $idperiode );
$results =  $statement->execute();

// cari isi field idjurnal dari transaksi yang baru disimpan tadi 
$sqlcari3 = "SELECT idjurnal FROM tb_jurnal_mst ORDER BY idjurnal DESC LIMIT 0,1";
$resultcari3 = $mysqli->query($sqlcari3);
while($bariscari3 = $resultcari3->fetch_object())
{	$idjurnalbaru=$bariscari3->idjurnal;
}
// tambahkan ayat jurnal pertama
$sqlt1="INSERT INTO tb_jurnal_rinci ( idjurnal, kodeakun, namaakun, debet, kredit ) 
	  VALUES ( ?,?,?,?,? ) ";	  
$statement = $mysqli->prepare($sqlt1);
$statement->bind_param('iisii', $idjurnalbaru, $akundebet, $namaakundebet, $nominal, $nol );
$results =  $statement->execute();

// tambahkan ayat jurnal kedua
$sqlt2="INSERT INTO tb_jurnal_rinci ( idjurnal, kodeakun, namaakun, debet, kredit ) 
	  VALUES ( ?,?,?,?,? ) ";	  
$statement = $mysqli->prepare($sqlt2);
$statement->bind_param('iisii', $idjurnalbaru, $akunkredit, $namaakunkredit, $nol, $nominal );
$results =  $statement->execute();

// ===== tampilkan hasilnya ===============
$menuju="menu.php";
echo "<script type='text/javascript'> document.location = '" . $menuju . "'; </script>";
?>