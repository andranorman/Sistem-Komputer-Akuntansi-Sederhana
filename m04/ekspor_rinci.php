<!DOCTYPE html>
<html lang='en'>    
<head>
    <meta charset="UTF-8">
    <title> RSUD HAMS | SKARS : Sistem Komputer Akuntansi Rumah Sakit</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>	
	<link rel="shortcut icon" href="../pic/logobaktihusada_kecil.ico">	
</head>
<body>
	<table border='0' cellspacing='0' cellpadding='0' width='800'>
		<tr><td align='center' colspan=4 >
			<h2 class='h1'>Saldo Awal Transaksi per Akun <br/>Sistem Akuntansi Keuangan</h2></td>
		</tr>
		<tr>
			<td align='center' class='tdnc' width='125'>Kode</td>
			<td align='center' class='tdnc' width='325'>Nama Akun</td>
			<td align='center' class='tdnc' width='175'>Debet</td>
			<td align='center' class='tdnc' width='175'>Kredit</td>
		</tr>

	<?php
		$sql6= "SELECT idperiode, tb_awal.kodeakun, akun, db, kr
				FROM `tb_awal` 
				INNER JOIN tb_coa ON tb_awal.kodeakun = tb_coa.kodeakun
				WHERE idperiode =" . $idperiode1 . " ORDER BY kodeakun";								
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
			$idperiode=$baris2->idperiode;  
			$kodeakun=$baris2->kodeakun; $akun=$baris2->akun; $db=$baris2->db; $kr=$baris2->kr;
			$akun=substr($akun,0,50);
	?>			
		<tr>
			<td class='tdnc'><?php echo($kodeakun);?></td>
			<td class='tdn'><?php echo($akun);?></td>			
			<td class='tdnr'><?php echo(number_format($db,2, ',', '.')); ?></td>
			<td class='tdnr'><?php echo(number_format($kr,2, ',', '.'));?></td>
		</tr>
	<?php
			$ulang=$ulang+1;
			$nourut=$nourut+1;
			$tdb=$tdb+$db;
			$tkr=$tkr+$kr;
		}			
	?>	
		<tr>
			<td class='tdbc' colspan="2">J u m l a h</td>		
			<td class='tdnrb'><?php echo(number_format($tdb,2, ',', '.'));?></td>
			<td class='tdnrb'><?php echo(number_format($tkr,2, ',', '.'));?></td>
		</tr>	
	</table>
	
</body>
</html>