<?php
include("../dbcon.php");
include("../fungsi.php");

$idkelompok=$mysqli->real_escape_string($_REQUEST['idkelompok']);

$sql="DELETE FROM tb_coa_info WHERE idkelompok=?";
$statement = $mysqli->prepare($sql);
$statement->bind_param('i', $idkelompok );
$results =  $statement->execute();

// ===== tampilkan hasilnya ===============
$menuju = "menu.php" ;	
echo "<script type='text/javascript'> document.location = '" . $menuju . "'; </script>";
?>