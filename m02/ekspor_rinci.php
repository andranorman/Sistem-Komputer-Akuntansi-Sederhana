<!DOCTYPE html>
<html lang='en'>    
<head>
    <meta charset="UTF-8">
    <title> RSUD HAMS | SKARS : Sistem Komputer Akuntansi Rumah Sakit</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>	
	<link rel="shortcut icon" href="../pic/logobaktihusada_kecil.ico">	
</head>
<body>
	<table border='1' cellspacing='0' cellpadding='0' width='1375'>		
		<tr>
			<td colspan=7>
			<h2><small>RSUD H.Abdul Manan Simatupang</small> 
			<br>Daftar Akun Operasional</h2></td>
		</tr>
		<tr>
			<td align='center' width='50'>No.</td>
			<td align='center' width='100'>KDA</td>
			<td align='center' width='350'>Nama Akun Operasional</td>
			<td align='center' width='100'>IDK</td>
			<td align='center' width='350'>Kelompok</td>
			<td align='center' width='100'>Kd.Anggar.</td>			
			<td align='center' width='350'>Nama Akun Anggaran</td>		
		</tr>

	<?php
		// cari nilai saldo awal
		$saldohitung=0;	
	
		$sql6= "SELECT kodeakun, akun, tb_coa.idkelompok, kelompok, tb_coa.idlaporan, laporan, kodeakuna
				FROM `tb_coa`
				INNER JOIN tb_coa_info ON tb_coa.idkelompok = tb_coa_info.idkelompok
				INNER JOIN tb_jenislaporan ON tb_coa.idlaporan = tb_jenislaporan.idlaporan
				ORDER BY kodeakun";								
	
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
			$akuna="";
			$kodeakun=$baris2->kodeakun; $akun=$baris2->akun; $idkelompok=$baris2->idkelompok;
			$kelompok=$baris2->kelompok; $idlaporan=$baris2->idlaporan; $laporan=$baris2->laporan; $kodeakuna=$baris2->kodeakuna;  
			//$akun=substr($akun,0,50);
			$kelompok=substr($kelompok,0,40);
			
			if($kodeakuna<>"")
			{	// cari nama akun anggaran
				$sql2a= "SELECT kodeakuna, akuna FROM `tb_coaa` WHERE kodeakuna='" . $kodeakuna ."'";								
				$result2a = $mysqli->query($sql2a);
				while($baris2a = $result2a->fetch_object())
				{	$akuna=$baris2a->akuna; }
			}
			else
			{	$akuna="";	
			}
	?>			
		<tr>
			<td align='center' ><?php echo($nourut);?></td>
			<td align='center' ><?php echo($kodeakun);?></td>
			<td align='left' ><?php echo($akun);?></td>
			<td align='center' ><?php echo($idkelompok);?></td>			
			<td align='justify' ><?php echo($kelompok);?></td>
			<td align='center' ><?php echo($kodeakuna);?></td>
			<td align='left' ><?php echo($akuna);?></td>
		</tr>
	<?php
			$ulang=$ulang+1;
			$nourut=$nourut+1;
		}			
	?>	
	</table>
	
</body>
</html>