<?php
session_start();
//error_reporting(0);
include("../dbcon.php"); include("../fungsi.php"); 

$daritgl=$_POST['daritgl'];
$sampaitgl=$_POST['sampaitgl'];

//$daritgl=formattgl2($daritgl);
//$sampaitgl=formattgl2($sampaitgl);

$_SESSION['aktif_daritgl']=$daritgl;
$_SESSION['aktif_sampaitgl']=$sampaitgl;	

// ===== tampilkan hasilnya ===============
$menuju = "menu.php" ;	
echo "<script type='text/javascript'> document.location = '" . $menuju . "'; </script>";

?>