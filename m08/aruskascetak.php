<?php
	session_start();
	include("../dbcon.php");
	include("../fungsi.php");
	//$idperiode1=$_SESSION['aktif_idperiode'];
	//$nmperiode1=$_SESSION['aktif_nmperiode'];	
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
	<link rel="shortcut icon" href="../pic/logobaktihusada_kecil.ico">	
	<link rel='stylesheet' href='../css/cetak.css' />
</head>
<body>
	<!--<p class="pnormal">&nbsp;</p>-->
	<table border='0' cellspacing='0' cellpadding='0' width='950'>
		<tr>
			<td align='center'>
				<h2 class='h2'>ARUS KAS</h2>
				<h2 class='h2'><small>Per <?php echo($tgllapdana);?></small>
				</h2>
			</td>
		</tr>
		<tr>
			<td>
				<hr>
			</td>
		</tr>
	</table>
		
	<table border='0' cellspacing='0' cellpadding='0' width='800'>		
		<tr><td colspan='4' align="center" class='h2'><b>ARUS KAS DARI OPERASI</b></td>
		<tr>
			<td align='left' class='tdn' width='150'><b>ARUS KAS MASUK</b></td><td></td><td></td><td></td>
		</tr>	
		<?php
			$totaldebet1=0; $totalkredit1=0;
			$sql2 ="SELECT idaruskas, tipe, kodekel, namakel, kodeakun, noaruskas, namaaruskas, tingkat, dk, debet, kredit 
					FROM aruskas WHERE kodekel=1 AND tipe='MASUK' ORDER BY idaruskas";	
			$result2 = $mysqli->query($sql2);
			while($baris2 = $result2->fetch_object())
			{
				$idaruskas=$baris2->idaruskas; $tipe=$baris2->tipe; $kodekel=$baris2->kodekel; 
				$namakel=$baris2->namakel; $kodeakun=$baris2->kodeakun; $noaruskas=$baris2->noaruskas; 
				$namaaruskas=$baris2->namaaruskas; $tingkat=$baris2->tingkat; $db=$baris2->dk;
				$debet=$baris2->debet; $kredit=$baris2->kredit;
				$totaldebet1=$totaldebet1+$debet; $totalkredit1=$totalkredit1+$kredit;
		?>		
		<tr>
			<td></td>
			<td align='left' class='tdn' width='350'><?php echo($noaruskas . ". " . $namaaruskas);?></td>
			<td align='right' class='tdnr' width='150'><?php echo(number_format($debet));?></td>
			<td align='right' class='tdnr' width='150'></td>
		</tr>
	<?php
		}
	?>
		<tr>
			<td></td><td></td><td align="right" class='tdn'><hr></td>
			<td align="right"  class='tdnr'></td>
		</tr>		
		<tr>
			<td align="right" colspan='3'  class='tdn'>Jumlah Arus Kas Masuk</td>
			<td align="right"  class='tdnr'><?php echo(number_format($totaldebet1));?></td>
		</tr>		

		<tr>
			<td class='tdn' ><b>ARUS KAS KELUAR</b></td><td></td><td></td><td></td>
		</tr>
		<?php
			$totaldebet2=0; $totalkredit2=0;
			$sql2 ="SELECT idaruskas, tipe, kodekel, namakel, kodeakun, noaruskas, namaaruskas, tingkat, dk, debet, kredit 
					FROM aruskas WHERE kodekel=1 AND tipe='KELUAR' ORDER BY idaruskas";	
			$result2 = $mysqli->query($sql2);
			while($baris2 = $result2->fetch_object())
			{
				$idaruskas=$baris2->idaruskas; $tipe=$baris2->tipe; $kodekel=$baris2->kodekel; 
				$namakel=$baris2->namakel; $kodeakun=$baris2->kodeakun; $noaruskas=$baris2->noaruskas; 
				$namaaruskas=$baris2->namaaruskas; $tingkat=$baris2->tingkat; $db=$baris2->dk;
				$debet=$baris2->debet; $kredit=$baris2->kredit;
				$totaldebet2=$totaldebet2+$debet; $totalkredit2=$totalkredit2+$kredit;
		?>									
		<tr>
			<td></td>
			<td align='left' class='tdn' width='350'><?php echo($noaruskas . ". " . $namaaruskas);?></td>
			<td align="right"  class='tdnr'><?php echo(number_format($kredit));?></td>
			<td></td>
		</tr>
		<?php
				}
		?>
		<tr>
			<td></td><td></td><td align="right" class='tdn'><hr></td>
			<td align="right"  class='tdnr'></td>
		</tr>	
		<tr>
			<td align="right" colspan='3'  class='tdn'>Jumlah Arus Kas Keluar</td>
			<td align="right"  class='tdnr'><?php echo(number_format($totalkredit2));?></td>
		</tr>
		<tr>
			<td></td><td></td><td align="right" class='tdn'></td>
			<td align="right"  class='tdnr'><hr></td>
		</tr>	
		<tr>
			<td align="right" colspan='3'  class='tdn'><b>Arus Kas Operasi</b></td>
			<td align="right"  class='tdnr'><b><?php echo(number_format($totaldebet1-$totalkredit2));?></b></td>
		</tr>
	</table>	

<!-- ----------------------------------------------------------------------------------------------------------------------- -->

	<table border='0' cellspacing='0' cellpadding='0' width='800'>		
		<tr><td colspan='4' align="center" class='h2'><b>ARUS KAS DARI INVESTASI</b></td>
		<tr>
			<td align='left' class='tdn' width='150'><b>ARUS KAS MASUK</b></td><td></td><td></td><td></td>
		</tr>	
		<?php
			$totaldebet3=0; $totalkredit3=0;
			$sql2 ="SELECT idaruskas, tipe, kodekel, namakel, kodeakun, noaruskas, namaaruskas, tingkat, dk, debet, kredit 
					FROM aruskas WHERE kodekel=2 AND tipe='MASUK' ORDER BY idaruskas";	
			$result2 = $mysqli->query($sql2);
			while($baris2 = $result2->fetch_object())
			{
				$idaruskas=$baris2->idaruskas; $tipe=$baris2->tipe; $kodekel=$baris2->kodekel; 
				$namakel=$baris2->namakel; $kodeakun=$baris2->kodeakun; $noaruskas=$baris2->noaruskas; 
				$namaaruskas=$baris2->namaaruskas; $tingkat=$baris2->tingkat; $db=$baris2->dk;
				$debet=$baris2->debet; $kredit=$baris2->kredit;
				$totaldebet3=$totaldebet3+$debet;  $totalkredit3=$totalkredit3+$debet;
		?>		
		<tr>
			<td></td>
			<td align='left' class='tdn' width='350'><?php echo($noaruskas . ". " . $namaaruskas);?></td>
			<td align='right' class='tdnr' width='150'><?php echo(number_format($debet));?></td>
			<td align='right' class='tdnr' width='150'></td>
		</tr>
	<?php
		}
	?>
		<tr>
			<td></td><td></td><td align="right" class='tdn'><hr></td>
			<td align="right"  class='tdnr'></td>
		</tr>		
		<tr>
			<td align="right" colspan='3'  class='tdn'>Jumlah Arus Kas Masuk</td>
			<td align="right"  class='tdnr'><?php echo(number_format($totaldebet3));?></td>
		</tr>		

		<tr>
			<td class='tdn' ><b>ARUS KAS KELUAR</b></td><td></td><td></td><td></td>
		</tr>
		<?php
			$totaldebet4=0; $totalkredit4=0;
			$sql2 ="SELECT idaruskas, tipe, kodekel, namakel, kodeakun, noaruskas, namaaruskas, tingkat, dk, debet, kredit 
					FROM aruskas WHERE kodekel=2 AND tipe='MASUK' ORDER BY idaruskas";	
			$result2 = $mysqli->query($sql2);
			while($baris2 = $result2->fetch_object())
			{
				$idaruskas=$baris2->idaruskas; $tipe=$baris2->tipe; $kodekel=$baris2->kodekel; 
				$namakel=$baris2->namakel; $kodeakun=$baris2->kodeakun; $noaruskas=$baris2->noaruskas; 
				$namaaruskas=$baris2->namaaruskas; $tingkat=$baris2->tingkat; $db=$baris2->dk;
				$debet=$baris2->debet; $kredit=$baris2->kredit;
				$totaldebet4=$totaldebet4+$debet;  $totalkredit4=$totalkredit4+$debet;
		?>									
		<tr>
			<td></td>
			<td align='left' class='tdn' width='350'><?php echo($noaruskas . ". " . $namaaruskas);?></td>
			<td align="right"  class='tdnr'><?php echo(number_format($kredit));?></td>
			<td></td>
		</tr>
		<?php
				}
		?>
		<tr>
			<td></td><td></td><td align="right" class='tdn'><hr></td>
			<td align="right"  class='tdnr'></td>
		</tr>	
		<tr>
			<td align="right" colspan='3'  class='tdn'>Jumlah Arus Kas Keluar</td>
			<td align="right"  class='tdnr'><?php echo(number_format($totalkredit4));?></td>
		</tr>
		<tr>
			<td></td><td></td><td align="right" class='tdn'></td>
			<td align="right"  class='tdnr'><hr></td>
		</tr>	
		<tr>
			<td align="right" colspan='3'  class='tdn'><b>Arus Kas Investasi</b></td>
			<td align="right"  class='tdnr'><b><?php echo(number_format($totaldebet3-$totalkredit4));?></b></td>
		</tr>
	</table>	

<!-- ----------------------------------------------------------------------------------------------------------------------- -->
	<!-- halaman dua --------------------------------------------------------------------- -->	
	<p style="page-break-before: always">

	<table border='0' cellspacing='0' cellpadding='0' width='950'>
		<tr>
			<td align='center'>
				<h2 class='h2'>ARUS KAS</h2>
				<h1 class='h1'>RSUD H.ABDUL MANAN SIMATUPANG</h1>
				<h2 class='h2'><small>Per <?php echo($tgllapdana);?></small>
				</h2>
			</td>
		</tr>
		<tr>
			<td>
				<hr>
			</td>
		</tr>
	</table>	
	<table border='0' cellspacing='0' cellpadding='0' width='800'>		
		<tr><td colspan='4' align="center" class='h2'><b>ARUS KAS DARI PENDANAAN</b></td>
		<tr>
			<td align='left' class='tdn' width='150'><b>ARUS KAS MASUK</b></td><td></td><td></td><td></td>
		</tr>	
		<?php
			$totaldebet5=0; $totalkredit5=0;
			$sql2 ="SELECT idaruskas, tipe, kodekel, namakel, kodeakun, noaruskas, namaaruskas, tingkat, dk, debet, kredit 
					FROM aruskas WHERE kodekel=3 AND tipe='MASUK' ORDER BY idaruskas";	
			$result2 = $mysqli->query($sql2);
			while($baris2 = $result2->fetch_object())
			{
				$idaruskas=$baris2->idaruskas; $tipe=$baris2->tipe; $kodekel=$baris2->kodekel; 
				$namakel=$baris2->namakel; $kodeakun=$baris2->kodeakun; $noaruskas=$baris2->noaruskas; 
				$namaaruskas=$baris2->namaaruskas; $tingkat=$baris2->tingkat; $db=$baris2->dk;
				$debet=$baris2->debet; $kredit=$baris2->kredit;
				$totaldebet5=$totaldebet5+$debet;  $totalkredit5=$totalkredit5+$debet;
		?>		
		<tr>
			<td></td>
			<td align='left' class='tdn' width='350'><?php echo($noaruskas . ". " . $namaaruskas);?></td>
			<td align='right' class='tdnr' width='150'><?php echo(number_format($debet));?></td>
			<td align='right' class='tdnr' width='150'></td>
		</tr>
	<?php
		}
	?>
		<tr>
			<td></td><td></td><td align="right" class='tdn'><hr></td>
			<td align="right"  class='tdnr'></td>
		</tr>		
		<tr>
			<td align="right" colspan='3'  class='tdn'>Jumlah Arus Kas Masuk</td>
			<td align="right"  class='tdnr'><?php echo(number_format($totaldebet5));?></td>
		</tr>		

		<tr>
			<td class='tdn' ><b>ARUS KAS KELUAR</b></td><td></td><td></td><td></td>
		</tr>
		<?php
			$totaldebet6=0; $totalkredit6=0;
			$sql2 ="SELECT idaruskas, tipe, kodekel, namakel, kodeakun, noaruskas, namaaruskas, tingkat, dk, debet, kredit 
					FROM aruskas WHERE kodekel=2 AND tipe='MASUK' ORDER BY idaruskas";	
			$result2 = $mysqli->query($sql2);
			while($baris2 = $result2->fetch_object())
			{
				$idaruskas=$baris2->idaruskas; $tipe=$baris2->tipe; $kodekel=$baris2->kodekel; 
				$namakel=$baris2->namakel; $kodeakun=$baris2->kodeakun; $noaruskas=$baris2->noaruskas; 
				$namaaruskas=$baris2->namaaruskas; $tingkat=$baris2->tingkat; $db=$baris2->dk;
				$debet=$baris2->debet; $kredit=$baris2->kredit;
				$totaldebet6=$totaldebet6+$debet;  $totalkredit6=$totalkredit6+$debet;
		?>									
		<tr>
			<td></td>
			<td align="left"  class='tdn'><?php echo($namaaruskas);?></td>
			<td align="right"  class='tdnr'><?php echo(number_format($kredit));?></td>
			<td></td>
		</tr>
		<?php
				}
		?>
		<tr>
			<td></td><td></td><td align="right" class='tdn'><hr></td>
			<td align="right"  class='tdnr'></td>
		</tr>	
		<tr>
			<td align="right" colspan='3'  class='tdn'>Jumlah Arus Kas Keluar</td>
			<td align="right"  class='tdnr'><?php echo(number_format($totalkredit6));?></td>
		</tr>
		<tr>
			<td></td><td></td><td align="right" class='tdn'></td>
			<td align="right"  class='tdnr'><hr></td>
		</tr>	
		<tr>
			<td align="right" colspan='3'  class='tdn'><b>Arus Kas Investasi</b></td>
			<td align="right"  class='tdnr'><b><?php echo(number_format($totaldebet5-$totalkredit6));?></b></td>
		</tr>
	</table>

	
</body>
</html>