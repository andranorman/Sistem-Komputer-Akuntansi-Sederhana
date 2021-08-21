<?php
session_start();
include("../dbcon.php");
include("../fungsi.php");

//$kodeakun1=$mysqli->real_escape_string($_POST['kodeakun1']);
$kodeakun=$mysqli->real_escape_string($_POST['kodeakun']);

$idperiode=$_SESSION['aktif_idperiode'];

$db=$mysqli->real_escape_string($_POST['db']);
$kr=$mysqli->real_escape_string($_POST['kr']);

$sql="UPDATE tb_awal SET db=?, kr=?    			
      WHERE kodeakun=? AND idperiode=? ;";

$statement = $mysqli->prepare($sql);
$statement->bind_param('ddii', $db, $kr, $kodeakun, $idperiode );
$results =  $statement->execute();

// ===== tampilkan hasilnya ===============
$menuju = "menu.php" ;	
echo "<script type='text/javascript'> document.location = '" . $menuju . "'; </script>";

?>