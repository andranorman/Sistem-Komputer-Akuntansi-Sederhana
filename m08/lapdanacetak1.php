<?php
	session_start();
	include("../dbcon.php");
	include("../fungsi.php");
	$idperiode1=$_SESSION['aktif_idperiode'];
	$nmperiode1=$_SESSION['aktif_nmperiode'];	
?>
<!DOCTYPE html>
<html lang='en'>    
<head>
    <meta charset="UTF-8">
    <title> RSUD HAMS | SKARS : Sistem Komputer Akuntansi Rumah Sakit</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>	
	<link rel="shortcut icon" href="../pic/logobaktihusada_kecil.ico">	
	<link rel='stylesheet' href='../css/cetak.css' />
</head>
<body>
	<?php
		$tdb_saldo=0;
		$tkr_saldo=0;

		$sql6 ="SELECT tb_coa.idkelompok, kelompok, SUM(db_awal) AS sdb_awal, SUM(kr_awal) AS skr_awal, 
				SUM(db_mutasi) AS sdb_mutasi, SUM(kr_mutasi) AS skr_mutasi, 
				SUM(db_penyesuaian) AS sdb_penyesuaian, SUM(kr_penyesuaian) AS skr_penyesuaian, 
				SUM(db_saldo) AS sdb_saldo, SUM(kr_saldo) AS skr_saldo 
				FROM tb_nrcsaldo INNER JOIN tb_coa ON tb_nrcsaldo.kodeakun=tb_coa.kodeakun 
				INNER JOIN tb_coa_info ON tb_coa.idkelompok=tb_coa_info.idkelompok
				WHERE idperiode=" . $idperiode1 . " AND idlaporan=2
				GROUP BY tb_coa.idkelompok";
		
		$ulang=1;
		$nourut=1;
		$ulangheader=0;
		$hal=1;
		$cekkodebag="awal";
		$tdb=0;
		$tkr=0; 
		
		$result2 = $mysqli->query($sql6);
		while($baris2 = $result2->fetch_object())
		{			
			$idperiode=$idperiode1;  
			$idkelompok=$baris2->idkelompok; $kelompok=$baris2->kelompok; $db_awal=$baris2->sdb_awal; $kr_awal=$baris2->skr_awal;
			$db_mutasi=$baris2->sdb_mutasi; $kr_mutasi=$baris2->skr_mutasi; 
			$db_penyesuaian=$baris2->sdb_penyesuaian; $kr_penyesuaian=$baris2->skr_penyesuaian;
			$db_saldo=$baris2->sdb_saldo; $kr_saldo=$baris2->skr_saldo;
			$kelompok=substr($kelompok,0,50);
			
			$pdb_saldo=number_format($db_saldo);
			$pkr_saldo=number_format($kr_saldo);
			if($ulangheader==0)
			{
	?>
	<p class="pnormal">&nbsp;</p>
	<table border='0' cellspacing='0' cellpadding='0' width='700'>
		<tr><td align='center'>
			<h2 class='h1'>Sistem Akuntansi Keuangan<br/>
			Laporan Operasional <?php echo($nmperiode1);?>
			</h2></td>
		</tr>
	</table>	
	<p class="pnormal">hal.<?php echo($hal);?></p>
	<table border='1' cellspacing='0' cellpadding='0' width='700'>		
		<tr>
			<td rowspan="2" align='center' class='tdnc' width='25'>Kode</td>
			<td rowspan="2" align='center' class='tdnc' width='335'>Nama Akun</td>
			<td colspan="2" align='center' class='tdnc' width='340'>Nilai</td>
		</tr>
		<tr>
			<td align='center' class='tdnc' width='170'>Debet</td>
			<td align='center' class='tdnc' width='170'>Kredit</td>
		</tr>
	<?php
			}
			
	?>			
		<tr>
			<td class='tdnc'><?php echo($idkelompok);?></td>
			<td class='tdn'><?php echo($kelompok);?></td>			
			<td class='tdnr'><?php echo($pdb_saldo);?></td>
			<td class='tdnr'><?php echo($pkr_saldo);?></td>			
		</tr>
	<?php
			$ulang=$ulang+1;
			$nourut=$nourut+1;
			if($ulangheader>32)
			{	$ulangheader=0;	$hal=$hal+1;
	?>
	</table>
	<p style="page-break-before: always">
	<?php
			}
			else
			{	$ulangheader=$ulangheader+1;	}
			$tdb_saldo=$tdb_saldo+$db_saldo;
			$tkr_saldo=$tkr_saldo+$kr_saldo;
			
		}	
		
	?>
		<tr>
			<td class='tdb'>9999</td>
			<td class='tdb'>Selisih Lebih/Kurang Penggunaan Anggaran (SILPA)</td>			
			<td class='tdnrb'>0</td>
			<td class='tdnrb'><?php echo(number_format(($tkr_saldo-$tdb_saldo)));?></td>			
		</tr>		
		<tr>
			<td class='tdbc' colspan="2">J u m l a h</td>		
			<td class='tdnrb'><?php echo(number_format($tdb_saldo));?></td>
			<td class='tdnrb'><?php echo(number_format($tkr_saldo));?></td>			
		</tr>
	
	</table>
	
</body>
</html>