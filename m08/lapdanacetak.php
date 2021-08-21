<?php
	session_start();
	include("../dbcon.php");
	include("../fungsi.php");
	$idperiode1=$_SESSION['idperiodepilih'];
	$nmperiode1=$_SESSION['nmperiodepilih'];
	$tgllapdana=$_SESSION['aktif_sampai'];
	$tgllapdana=formattgl($tgllapdana);
	$nmdirektur=$_SESSION['nmdirektur'];
	$nipdirektur=$_SESSION['nipdirektur'];
?>
<!DOCTYPE html>
<html lang='en'>    
<head>
    <meta charset="UTF-8">
    <title> SisKA : Sistem Komputer Akuntansi </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>	
	<link rel="shortcut icon" href="../pic/logoasahan.ico">	
	<link rel='stylesheet' href='../css/cetak.css' />
</head>
<body>
	<!--<p class="pnormal">&nbsp;</p>-->
	<table border='0' cellspacing='0' cellpadding='0' width='950'>
		<tr>
			<td align='center'>
				<h2 class='h2'>LAPORAN OPERASIONAL</h2>
				<h2 class='h2'><small>Per <?php echo($tgllapdana);?></small>
				</h2>
			</td>
		</tr>
	</table>	
	<?php $saldo=0;?>
	<table border='0' cellspacing='0' cellpadding='0' width='950'>		
		<tr>
			<td align='center' class='tdnc' width='250'></td>
			<td align='center' class='tdnc' width='200'></td>
			<td align='center' class='tdnc' width='150'></td>
			<td align='center' class='tdnc' width='150'></td>
			<td align='center' class='tdnc' width='150'></td>
		</tr>
		<tr>
			<td class='tdn'><h2 class='h1'><b><u>P E N D A P A T A N</u></b></h2></td>
			<td class='tdn'></td>
			<td class='tdn'></td>
			<td class='tdn'></td>			
			<td class='tdn'></td>			
		</tr>		

	<?php
		$idacuan=4;
		$idacuan_cek=4;
		$idjenis_cek=0001000; $awal=0; $tambahrow=0;	 
		$jenis_sebelumnya='';
		$sql6 ="SELECT idacuan, acuan, idsubacuan, subacuan, idjenis, jenis, 
					tb_coa.idkelompok, kelompok, SUM(db_awal) AS sdb_awal, SUM(kr_awal) AS skr_awal, 
					SUM(db_mutasi) AS sdb_mutasi, SUM(kr_mutasi) AS skr_mutasi, 
					SUM(db_penyesuaian) AS sdb_penyesuaian, SUM(kr_penyesuaian) AS skr_penyesuaian, 
					SUM(db_saldo) AS sdb_saldo, SUM(kr_saldo) AS skr_saldo 
				FROM tb_nrcsaldo INNER JOIN tb_coa ON tb_nrcsaldo.kodeakun=tb_coa.kodeakun 
					INNER JOIN tb_coa_info ON tb_coa.idkelompok=tb_coa_info.idkelompok
				WHERE idperiode=" . $idperiode1 . " AND idlaporan=2
				GROUP BY tb_coa.idkelompok";
		
		$tdb=0; $tkr=0; 
		$stdb=0; $stkr=0; $tsaldo=0;
		$result2 = $mysqli->query($sql6);
		while($baris2 = $result2->fetch_object())
		{			
			$idperiode=$idperiode1;  
			$idacuan=$baris2->idacuan; $acuan=$baris2->acuan; $idsubacuan=$baris2->idsubacuan; $idjenis=$baris2->idjenis; $jenis=$baris2->jenis;
			$idkelompok=$baris2->idkelompok; $kelompok=$baris2->kelompok; 
			$db_saldo=$baris2->sdb_saldo; $kr_saldo=$baris2->skr_saldo;
			if($idacuan==1 || $idacuan==5){ $saldo=$db_saldo; } else { $saldo=$kr_saldo; }
			if($idjenis<>$idjenis_cek) { $kolomjenis=$jenis; $idjenis_cek=$idjenis; if($awal==1) {  $tambahrow=1; } else {  $tambahrow=0; } }
			else { $kolomjenis="";}
			if($idacuan<>$idacuan_cek) { $tambahrowtotal=1; } else { $tambahrowtotal=0; }
	?>	
	<?php
			if($tambahrow==1 & $awal==1)
			{
	?>
		<tr>
			<td class='tdn'></td>
			<td class='tdn'></td>
			<td class='tdnr'></td>
			<td class='tdnr'><hr></hr></td>			
			<td class='tdn'></td>			
		</tr>
		<tr>
			<td class='tdn'></td>
			<td class='tdnr' colspan=2 ><i>SUBTOTAL <?php echo($jenis_sebelumnya);?></i></td>
			<td class='tdnr' valign="top" >Rp. <?php echo(number_format($tsaldo,2,',','.'));?></td>			
			<td class='tdn'></td>			
		</tr>
	<?php
				$tambahrow=0; $tsaldo=0; 
			}
			if($tambahrowtotal==1)
			{
	?>
		<tr>
			<td class='tdn'></td>
			<td class='tdn'></td>
			<td class='tdnr'></td>
			<td class='tdnr'></td>			
			<td class='tdn'><hr></hr></td>			
		</tr>
		<tr>
			<td class='tdn' colspan=4 align="center"  valign="top" ><i> JUMLAH PENDAPATAN</i></td>
			<td class='tdnr'>Rp. <?php echo(number_format($tkr,2,',','.'));?></td>			
		</tr>
	</table>

	<!-- halaman dua --------------------------------------------------------------------- -->	
	<p style="page-break-before: always">

	<table border='0' cellspacing='0' cellpadding='0' width='950'>		
		<tr>
			<td colspan=5 align='center'>
				<h2 class='h2'>LAPORAN OPERASIONAL</h2>
				<h2 class='h2'><small>Per <?php echo($tgllapdana);?></small>
				</h2>
			</td>
		</tr>
		<tr>
			<td align='center' class='tdnc' width='250'></td>
			<td align='center' class='tdnc' width='200'></td>
			<td align='center' class='tdnc' width='150'></td>
			<td align='center' class='tdnc' width='150'></td>
			<td align='center' class='tdnc' width='150'></td>
		</tr>		
		<tr>
			<td class='tdn'><h2 class='h1'><b>B E B A N</b></h2></td>
			<td class='tdn'></td>
			<td class='tdn'></td>
			<td class='tdn'></td>			
			<td class='tdn'></td>			
		</tr>			
	<?php
				$tambahrowtotal=0; $idacuan_cek=$idacuan;
			}
	?>	
		<tr>
			<td class='tdn' valign="top" ><b><?php echo($kolomjenis);?></b></td>
			<td class='tdn' valign="top" ><?php echo($kelompok);?></td>
			<td class='tdnr' valign="top" >Rp. <?php echo(number_format($saldo,2,',','.'));?></td>
			<td class='tdnr'></td>			
			<td class='tdn'></td>			
		</tr>
	<?php
			$tdb=$tdb+$db_saldo; $tkr=$tkr+$kr_saldo; $tsaldo=$tsaldo+$saldo; $awal=1;	
			$jenis_sebelumnya=$jenis;
		}	
		$surplusdefisit=$tkr-$tdb;
	?>
		<tr>
			<td class='tdn'></td>
			<td class='tdn'></td>
			<td class='tdnr'></td>
			<td class='tdnr'><hr></hr></td>			
			<td class='tdn'></td>			
		</tr>
		<tr>
			<td class='tdn'></td>
			<td class='tdnr' colspan=2 ><i>SUBTOTAL <?php echo($jenis_sebelumnya);?></i></td>
			<td class='tdnr' valign="top" >Rp. <?php echo(number_format($tsaldo,2,',','.'));?></td>			
			<td class='tdn'></td>			
		</tr>
		<tr>
			<td class='tdn'></td>
			<td class='tdn'></td>
			<td class='tdn'></td>
			<td class='tdn'></td>			
			<td class='tdn'><hr></hr></td>			
		</tr>		
		<tr>
			<td class='tdn' colspan=4 align="center"  valign="top" ><i> JUMLAH BEBAN</i></td>
			<td class='tdnr' valign="top" >Rp. <?php echo(number_format($tdb,2,',','.'));?></td>			
		</tr>
		<tr>
			<td class='tdn'></td>
			<td class='tdn'></td>
			<td class='tdn'></td>
			<td class='tdn'></td>			
			<td class='tdn'><hr></hr></td>			
		</tr>		
		<tr>
			<td class='tdn' colspan=4 align="center"><i> SURPLUS/DEFISIT TAHUN BERJALAN</i></td>
			<td class='tdnr' valign="top"  >Rp. <?php echo(number_format($surplusdefisit,2,',','.'));?></td>			
		</tr>
		<tr>
			<td class='tdn'></td>
			<td class='tdn'></td>
			<td class='tdn'></td>
			<td class='tdn'></td>			
			<td class='tdn'><hr></hr></td>			
		</tr>
	
	</table>
	
</body>
</html>                                                                                                                               