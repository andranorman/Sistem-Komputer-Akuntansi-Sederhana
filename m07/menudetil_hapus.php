<?php
include("../dbcon.php");
include("../fungsi.php");

$idjurnal=$mysqli->real_escape_string($_REQUEST['idjurnal']);
$idbaris=$mysqli->real_escape_string($_REQUEST['idbaris']);

$sql="DELETE FROM tb_jurnal_rinci WHERE idbaris=?";
$statement = $mysqli->prepare($sql);
$statement->bind_param('i', $idbaris );
$results =  $statement->execute();

// ===== tampilkan hasilnya ===============
$menuju = "menudetil.php?idjurnal=" . $idjurnal ;		
echo "<script type='text/javascript'> document.location = '" . $menuju . "'; </script>";
?>