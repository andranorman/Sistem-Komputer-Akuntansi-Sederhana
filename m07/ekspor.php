<?php
	session_start();
	include("../dbcon.php");
	include("../fungsi.php");
//	$idperiode1=$_SESSION['aktif_idperiode'];
//	$nmperiode1=$_SESSION['aktif_nmperiode'];	
	$idperiodepilih=$_SESSION['idperiodepilih'];
	$nmperiodepilih=$_SESSION['nmperiodepilih'];

	$idperiode1=$_SESSION['aktif_idperiode'];
	$nmperiode1=$_SESSION['aktif_nmperiode'];	
	$akunbukubesar=$_SESSION['aktif_akunbukubesar'];
	
	$tahunperiode=intval(substr($idperiodepilih,0,4));
	
	//$normal==''; 
	$sldawal=0; $dbawal=0; $krawal=0; $saldo=0; $kodeakun1=''; $akun1='';
	
	$sqlk= "SELECT idakun, kodeakun, akun, tb_coa_info.idkelompok, kelompok, idjenis, jenis
				FROM tb_coa
				INNER JOIN tb_coa_info ON tb_coa.idkelompok = tb_coa_info.idkelompok
				WHERE kodeakun='" . $akunbukubesar . "' 
				ORDER BY idakun";
				
	$resultk = $mysqli->query($sqlk);
	while($barisk = $resultk->fetch_object())
	{
		$namaakunbukubesar=$barisk->akun;  
	}
	
		
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=buku_besar_" . $akunbukubesar . "_periode_" . $idperiodepilih . ".xls");

// Tambahkan table
include("ekspor_rinci.php");
?>