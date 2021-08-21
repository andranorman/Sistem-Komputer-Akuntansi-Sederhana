<?php
session_start();
//error_reporting(0);
include("../dbcon.php"); include("../fungsi.php"); 

$idbukubesar=$_POST['idbukubesar'];
$kodeakun=$_POST['kodeakun'];
$_SESSION['aktif_akunbukubesarpenerimaan']=$kodeakun ;
$_SESSION['aktif_idbukubesar']=0;

// ===== tampilkan hasilnya ===============
$menuju = "menu.php" ;	
echo "<script type='text/javascript'> document.location = '" . $menuju . "'; </script>";

?>