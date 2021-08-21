<?php
	session_start();
	include("../dbcon.php");
	include("../fungsi.php");
?>
<!DOCTYPE html>
<html lang='en'>    
<head>
    <meta charset="UTF-8">
    <title> SisKA : Sistem Komputer Akuntansi Rumah </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>	
	<link rel="shortcut icon" href="../pic/logo.ico">	
	<link rel='stylesheet' href='../css/cetak.css' />
</head>
<body>
	<?php
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
			
			// looping header
			if($ulangheader==0)
			{
	?>
	<p class="pnormal">&nbsp;</p>
	<table border='0' cellspacing='0' cellpadding='0' width='1100'>
		<tr><td align='center'>
			<h2 class='h1'>Daftar Akun Operasional<br/>Sistem Akuntansi Keuangan</h2></td>
		</tr>
	</table>	
	<p class="pnormal">hal.<?php echo($hal);?></p>
	<table border='1' cellspacing='0' cellpadding='0' width='1100'>		
		<tr>
			<td align='center' class='tdnc' width='25'>KDA</td>
			<td align='center' class='tdnc' width='350'>Nama Akun Operasional</td>
			<td align='center' class='tdnc' width='25'>IDK</td>
			<td align='center' class='tdnc' width='350'>Kelompok</td>
			<td align='center' class='tdnc' width='25'>Kd.Agr.</td>			
			<td align='center' class='tdnc' width='350'>Nama Akun Anggaran</td>
		</tr>
	<?php
			}
			
	?>			
		<tr>
			<td class='tdnc'><?php echo($kodeakun);?></td>
			<td class='tdn'><?php echo($akun);?></td>			
			<td class='tdnc'><?php echo($idkelompok);?></td>
			<td class='tdn'><?php echo($kelompok);?></td>
			<td class='tdnc'><?php echo($kodeakuna);?></td>
			<td class='tdn'><?php echo($akuna);?></td>			
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
			
		}	
	?>
	</table>
	
</body>
</html>