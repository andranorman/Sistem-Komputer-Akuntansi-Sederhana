<?php
include("../dbcon.php");
include("../fungsi.php");

$idjurnal=$mysqli->real_escape_string(rapikan($_REQUEST['kode']));

$sql="DELETE FROM tb_jurnal_rinci WHERE idjurnal=?";
$statement = $mysqli->prepare($sql);
$statement->bind_param('i', $idjurnal );
$results =  $statement->execute();

$sql="DELETE FROM tb_jurnal_mst WHERE idjurnal=?";
$statement = $mysqli->prepare($sql);
$statement->bind_param('i', $idjurnal );
$results =  $statement->execute();

// ===== tampilkan hasilnya ===============
$menuju = "menu.php" ;		
echo "<script type='text/javascript'> document.location = '" . $menuju . "'; </script>";
?>