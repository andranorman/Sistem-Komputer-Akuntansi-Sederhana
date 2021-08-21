<?php
session_start();
//error_reporting(0);
include("../dbcon.php"); include("../fungsi.php"); 

// nonaktifkan periode lama
$dipilihcek=1;
$dipilihkosong=0;
$sqlb="UPDATE tb_periode SET dipilih=? 			
      WHERE dipilih=?;";

$statement = $mysqli->prepare($sqlb);
$statement->bind_param('ii', $dipilihkosong, $dipilihcek );
$results =  $statement->execute();


// aktifkan pilih periode yang dipilih
$idperiode=$_REQUEST['idperiode'];
$dipilih=$_REQUEST['dipilih'];
if ($dipilih==0)	
{	$dipilihbaru=1;	}
else
{	$dipilihbaru=0;	}

$sql="UPDATE tb_periode SET dipilih=? 			
      WHERE idperiode=?;";

$statement = $mysqli->prepare($sql);
$statement->bind_param('ii', $dipilihbaru, $idperiode );
$results =  $statement->execute();


// ambil variabel periode semester aktif
$sqla="SELECT idperiode, nmperiode, dari, sampai, dipilih FROM tb_periode WHERE dipilih=1;";
$resulta = $mysqli->query($sqla);
while($barisa = $resulta->fetch_object())
{			
	$idperiode=$barisa->idperiode; $nmperiode=$barisa->nmperiode;
	$dari=$barisa->dari; $sampai=$barisa->sampai;  
	$_SESSION['aktif_idperiode']=$idperiode;
	$_SESSION['aktif_nmperiode']=$nmperiode;	
	$_SESSION['aktif_dari']=$dari;
	$_SESSION['aktif_sampai']=$sampai;
}

// ===== tampilkan hasilnya ===============
$menuju = "menu.php" ;	
header("location:$menuju");echo "<script type='text/javascript'> document.location = '" . $menuju . "'; </script>";

?>