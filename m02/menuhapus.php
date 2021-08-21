<?php
include("../dbcon.php");
include("../fungsi.php");

$kodeakun=$mysqli->real_escape_string($_REQUEST['kodeakun']);

$sql="DELETE FROM tb_coa WHERE kodeakun=?";
$statement = $mysqli->prepare($sql);
$statement->bind_param('i', $kodeakun );
$results =  $statement->execute();

// ===== tampilkan hasilnya ===============
$menuju = "menu.php" ;	
echo "<script type='text/javascript'> document.location = '" . $menuju . "'; </script>";
?>