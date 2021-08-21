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
    <title> SisKA : Sistem Komputer Akuntansi</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>	
	<link rel="shortcut icon" href="../pic/logobaktihusada_kecil.ico">	
	<link rel='stylesheet' href='../css/cetak.css' />
</head>
<body>
	<!--<p class="pnormal">&nbsp;</p>-->
	<table border='0' cellspacing='0' cellpadding='0' width='750'>
		<tr>
			<td align='center'>
				<h2 class='h2'>LAPORAN PERUBAHAN EKUITAS</h2>
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
		
	<table border='0' cellspacing='0' cellpadding='0' width='750'>		
		<tr><td colspan='5' align="center"><b>&nbsp;</b></td>
		<tr>
			<td width='10%' ></td>
			<td width='5%' ></td>
			<td width='55%' ></td>
			<td width='20%' ></td>
			<td width='10%' ></td>
		</tr>
		<?php
			$totalnilaiA=0; 
			$sql2 ="SELECT id, kelompok, deskripsi, nilai FROM ekuitas WHERE kelompok='A' ORDER BY kelompok, id";	
			$result2 = $mysqli->query($sql2);
			while($baris2 = $result2->fetch_object())
			{
				$id=$baris2->id; $kelompok=$baris2->kelompok; $deskripsi=$baris2->deskripsi; 
				$nilai=$baris2->nilai; 
				if($kelompok=='A') {	$totalnilaiA=$totalnilaiA+$nilai;	}
		?>										
		<tr>
			<td></td>
			<td colspan=2 align="left" class='tdb' ><?php echo($deskripsi);?></td>
			<td align="right" class='tdnr' ><?php echo(number_format($nilai,2,',','.'));?></td>
			<td></td>
		</tr>
	<?php
		}
	?>
		<tr>
			<td></td>
			<td></td>
			<td align="left" class='tdn'></td>
			<td align="right" class='tdnr'><hr></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td align="left" class='tdn'><i>Ekuitas untuk dikonsolidasikan</i></td>
			<td align="right" class='tdnr'><?php echo(number_format($totalnilaiA,2,',','.'));?></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td align="left" colspan='4' class="tdb"></td>
		</tr>
		<tr>
			<td></td>
			<td align="left" colspan='4' class="tdb">Dampak Kumulatif Perubahan Kebijakan/Kesalahan Mendasar:</td>
		</tr>
		<?php
				$totalnilaiB=0; $urut=0;
				$sql2 ="SELECT id, kelompok, deskripsi, nilai FROM ekuitas WHERE kelompok='B' ORDER BY kelompok, id";	
				$result2 = $mysqli->query($sql2);
				while($baris2 = $result2->fetch_object())
				{
					$id=$baris2->id; $kelompok=$baris2->kelompok; $deskripsi=$baris2->deskripsi; 
					$nilai=$baris2->nilai; 
					$urut=$urut+1;
					if($kelompok=='B') {	$totalnilaiB=$totalnilaiB+$nilai;	}
		?>									
		<tr>
			<td></td>
			<td align="center" class="tdnc" ><?php echo($urut);?></td>
			<td align="left"  class="tdn" ><?php echo($deskripsi);?></td>
			<td align="right"  class="tdnr" ><?php echo(number_format($nilai,2,',','.'));?></td>
			<td></td>
		</tr>
		<?php
				}
		?>
		<tr>
			<td></td>
			<td colspan=2 align="left" class="tdn" ><b></b></td>
			<td align="right" class="tdnc" ><hr/></td>
			<td></td>
		</tr>

		<tr>
			<td></td>
			<td colspan=2 align="left" class="tdn" ><b>EKUITAS AKHIR</b></td>
			<td align="right" class="tdnr" ><?php echo(number_format($totalnilaiA-$totalnilaiB,2,',','.'));?></td>
			<td></td>
		</tr>
	</table>

</body>
</html>