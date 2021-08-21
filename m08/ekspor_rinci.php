<!DOCTYPE html>
<html lang='en'>    
<head>
    <meta charset="UTF-8">
    <title> SisKA : Sistem Komputer Akuntansi </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>	
	<link rel="shortcut icon" href="../pic/logobaktihusada_kecil.ico">	
</head>
<body>
	
	<table border='0' cellspacing='0' cellpadding='0' width='800'>		
		<tr>
			<td colspan='4'>
				<h2>Arus Kas Periode <?php echo($nmperiode1);?>
				</h2>			
			</td>
		</tr>	
		<tr><td colspan='4'><hr></td>
		</tr>
		<tr><td colspan='4' align="center" ><b>ARUS KAS DARI OPERASI</b></td>
		<tr>
			<td align='left' width='150'><b>ARUS KAS MASUK</b></td><td></td><td></td><td></td>
		</tr>	
		<?php
			$totaldebet1=0; $totalkredit1=0;
			$sql2 ="SELECT idaruskas, kodeurut, kodekel, namakel, kodeakun, namaakun, debet, kredit
					FROM `aruskas`
					WHERE kodekel = '1'  AND kodeurut='MASUK'";
			$result2 = $mysqli->query($sql2);
			while($baris2 = $result2->fetch_object())
			{
				$idaruskas=$baris2->idaruskas; $kodeurut=$baris2->kodeurut; $kodekel=$baris2->kodekel; 
				$namakel=$baris2->namakel; $kodeakun=$baris2->kodeakun; $namaakun=$baris2->namaakun;
				$debet=$baris2->debet; $kredit=$baris2->kredit;
				$totaldebet1=$totaldebet1+$debet;
		?>		
		<tr>
			<td></td>
			<td align='left' width='350'><?php echo($namaakun);?></td>
			<td align='right' width='150'><?php echo(number_format($debet));?></td>
			<td align='right' width='150'></td>
		</tr>
	<?php
		}
	?>
		<tr>
			<td></td><td></td><td align="right" ><hr></td>
			<td align="right" ></td>
		</tr>		
		<tr>
			<td align="right" colspan='3' >Jumlah Arus Kas Masuk</td>
			<td align="right" ><?php echo(number_format($totaldebet1));?></td>
		</tr>		

		<tr>
			<td ><b>ARUS KAS KELUAR</b></td><td></td><td></td><td></td>
		</tr>
		<?php
				$totaldebet2=0; $totalkredit2=0;
				$sql2 ="SELECT idaruskas, kodeurut, kodekel, namakel, kodeakun, namaakun, debet, kredit
						FROM `aruskas`
						WHERE kodekel = '1'  AND kodeurut='KELUAR'";
				$result2 = $mysqli->query($sql2);
				while($baris2 = $result2->fetch_object())
				{
					$idaruskas=$baris2->idaruskas; $kodeurut=$baris2->kodeurut; $kodekel=$baris2->kodekel; 
					$namakel=$baris2->namakel; $kodeakun=$baris2->kodeakun; $namaakun=$baris2->namaakun;
					$debet=$baris2->debet; $kredit=$baris2->kredit;
					$totalkredit2=$totalkredit2+$kredit;
		?>									
		<tr>
			<td></td>
			<td align="left" ><?php echo($namaakun);?></td>
			<td align="right" ><?php echo(number_format($kredit));?></td>
			<td></td>
		</tr>
		<?php
				}
		?>
		<tr>
			<td></td><td></td><td align="right" ><hr></td>
			<td align="right" ></td>
		</tr>	
		<tr>
			<td align="right" colspan='3' >Jumlah Arus Kas Keluar</td>
			<td align="right" ><?php echo(number_format($totalkredit2));?></td>
		</tr>
		<tr>
			<td></td><td></td><td align="right" ></td>
			<td align="right" ><hr></td>
		</tr>	
		<tr>
			<td align="right" colspan='3' ><b>Arus Kas Operasi</b></td>
			<td align="right" ><b><?php echo(number_format($totaldebet1-$totalkredit2));?></b></td>
		</tr>
		<!-- -------------------------------------------------------------------------------------------------------------------- -->
		<tr><td colspan='4'><hr></td>
		</tr>
		<tr><td colspan='4' align="center" ><b>ARUS KAS DARI INVESTASI</b></td>
		<tr>
			<td align='left' width='150'><b>ARUS KAS MASUK</b></td><td></td><td></td><td></td>
		</tr>	
		<?php
			$totaldebet3=0; $totalkredit3=0;
			$sql2 ="SELECT idaruskas, kodeurut, kodekel, namakel, kodeakun, namaakun, debet, kredit
					FROM `aruskas`
					WHERE kodekel = '2'  AND kodeurut='MASUK'";
			$result2 = $mysqli->query($sql2);
			while($baris2 = $result2->fetch_object())
			{
				$idaruskas=$baris2->idaruskas; $kodeurut=$baris2->kodeurut; $kodekel=$baris2->kodekel; 
				$namakel=$baris2->namakel; $kodeakun=$baris2->kodeakun; $namaakun=$baris2->namaakun;
				$debet=$baris2->debet; $kredit=$baris2->kredit;
				$totaldebet3=$totaldebet3+$debet;
		?>		
		<tr>
			<td></td>
			<td align='left' width='350'><?php echo($namaakun);?></td>
			<td align='right' width='150'><?php echo(number_format($debet));?></td>
			<td align='right' width='150'></td>
		</tr>
	<?php
		}
	?>
		<tr>
			<td></td><td></td><td align="right" ><hr></td>
			<td align="right" ></td>
		</tr>		
		<tr>
			<td align="right" colspan='3' >Jumlah Arus Kas Masuk</td>
			<td align="right" ><?php echo(number_format($totaldebet3));?></td>
		</tr>		

		<tr>
			<td ><b>ARUS KAS KELUAR</b></td><td></td><td></td><td></td>
		</tr>
		<?php
				$totaldebet4=0; $totalkredit4=0;
				$sql2 ="SELECT idaruskas, kodeurut, kodekel, namakel, kodeakun, namaakun, debet, kredit
						FROM `aruskas`
						WHERE kodekel = '1'  AND kodeurut='KELUAR'";
				$result2 = $mysqli->query($sql2);
				while($baris2 = $result2->fetch_object())
				{
					$idaruskas=$baris2->idaruskas; $kodeurut=$baris2->kodeurut; $kodekel=$baris2->kodekel; 
					$namakel=$baris2->namakel; $kodeakun=$baris2->kodeakun; $namaakun=$baris2->namaakun;
					$debet=$baris2->debet; $kredit=$baris2->kredit;
					$totalkredit4=$totalkredit4+$kredit;
		?>									
		<tr>
			<td></td>
			<td align="left" ><?php echo($namaakun);?></td>
			<td align="right" ><?php echo(number_format($kredit));?></td>
			<td></td>
		</tr>
		<?php
				}
		?>
		<tr>
			<td></td><td></td><td align="right" ><hr></td>
			<td align="right" ></td>
		</tr>	
		<tr>
			<td align="right" colspan='3' >Jumlah Arus Kas Keluar</td>
			<td align="right" ><?php echo(number_format($totalkredit4));?></td>
		</tr>
		<tr>
			<td></td><td></td><td align="right" ></td>
			<td align="right" ><hr></td>
		</tr>	
		<tr>
			<td align="right" colspan='3' ><b>Arus Kas Investasi</b></td>
			<td align="right" ><b><?php echo(number_format($totaldebet3-$totalkredit4));?></b></td>
		</tr>
		
		<!-- -------------------------------------------------------------------------------------------------------------------- -->
		<tr><td colspan='4'><hr></td>
		</tr>
		<tr><td colspan='4' align="center" ><b>ARUS KAS DARI PENDANAAN</b></td>
		<tr>
			<td align='left' width='150'><b>ARUS KAS MASUK</b></td><td></td><td></td><td></td>
		</tr>	
		<?php
			$totaldebet5=0; $totalkredit5=0;
			$sql2 ="SELECT idaruskas, kodeurut, kodekel, namakel, kodeakun, namaakun, debet, kredit
					FROM `aruskas`
					WHERE kodekel = '3'  AND kodeurut='MASUK'";
			$result2 = $mysqli->query($sql2);
			while($baris2 = $result2->fetch_object())
			{
				$idaruskas=$baris2->idaruskas; $kodeurut=$baris2->kodeurut; $kodekel=$baris2->kodekel; 
				$namakel=$baris2->namakel; $kodeakun=$baris2->kodeakun; $namaakun=$baris2->namaakun;
				$debet=$baris2->debet; $kredit=$baris2->kredit;
				$totaldebet5=$totaldebet5+$debet;
		?>		
		<tr>
			<td></td>
			<td align='left' width='350'><?php echo($namaakun);?></td>
			<td align='right' width='150'><?php echo(number_format($debet));?></td>
			<td align='right' width='150'></td>
		</tr>
	<?php
		}
	?>
		<tr>
			<td></td><td></td><td align="right" ><hr></td>
			<td align="right" ></td>
		</tr>		
		<tr>
			<td align="right" colspan='3' >Jumlah Arus Kas Masuk</td>
			<td align="right" ><?php echo(number_format($totaldebet5));?></td>
		</tr>		

		<tr>
			<td ><b>ARUS KAS KELUAR</b></td><td></td><td></td><td></td>
		</tr>
		<?php
				$totaldebet6=0; $totalkredit6=0;
				$sql2 ="SELECT idaruskas, kodeurut, kodekel, namakel, kodeakun, namaakun, debet, kredit
						FROM `aruskas`
						WHERE kodekel = '1'  AND kodeurut='KELUAR'";
				$result2 = $mysqli->query($sql2);
				while($baris2 = $result2->fetch_object())
				{
					$idaruskas=$baris2->idaruskas; $kodeurut=$baris2->kodeurut; $kodekel=$baris2->kodekel; 
					$namakel=$baris2->namakel; $kodeakun=$baris2->kodeakun; $namaakun=$baris2->namaakun;
					$debet=$baris2->debet; $kredit=$baris2->kredit;
					$totalkredit6=$totalkredit6+$kredit;
		?>									
		<tr>
			<td></td>
			<td align="left" ><?php echo($namaakun);?></td>
			<td align="right" ><?php echo(number_format($kredit));?></td>
			<td></td>
		</tr>
		<?php
				}
		?>
		<tr>
			<td></td><td></td><td align="right" ><hr></td>
			<td align="right" ></td>
		</tr>	
		<tr>
			<td align="right" colspan='3' >Jumlah Arus Kas Keluar</td>
			<td align="right" ><?php echo(number_format($totalkredit6));?></td>
		</tr>
		<tr>
			<td></td><td></td><td align="right" ></td>
			<td align="right" ><hr></td>
		</tr>	
		<tr>
			<td align="right" colspan='3' ><b>Arus Kas Investasi</b></td>
			<td align="right" ><b><?php echo(number_format($totaldebet5-$totalkredit6));?></b></td>
		</tr>


	</table>	
	
	
</body>
</html>