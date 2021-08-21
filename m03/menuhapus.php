<?php
include("../dbcon.php");
include("../fungsi.php");

$idperiode=$mysqli->real_escape_string($_REQUEST['idperiode']);

$sql="DELETE FROM tb_periode WHERE idperiode=?";
$statement = $mysqli->prepare($sql);
$statement->bind_param('i', $idperiode );
$results =  $statement->execute();

// ===== tampilkan hasilnya ===============
$menuju = "menu.php" ;	
header("location:$menuju");echo "<script type='text/javascript'> document.location = '" . $menuju . "'; </script>";
?>