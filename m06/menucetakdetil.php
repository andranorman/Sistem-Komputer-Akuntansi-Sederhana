<?php
	session_start();
	include("../dbcon.php");
	include("../fungsi.php");
	$idperiode1=$_SESSION['aktif_idperiode'];
	$nmperiode1=$_SESSION['aktif_nmperiode'];	
	$akunbukubesar=$_SESSION['aktif_akunbukubesar'];
//	$kelakunbukubesar=$_SESSION['aktif_kelakunbukubesar'];
//	$idbukubesar=$_SESSION['aktif_idbukubesar'];	

	// cari kode akun, nama akun, saldo awal dan posisi normal
	$sqlaw="SELECT idperiode, tb_awal.kodeakun, akun, normal, db, kr 
			FROM `tb_awal` 
			INNER JOIN tb_coa ON tb_awal.kodeakun = tb_coa.kodeakun
			INNER JOIN tb_coa_info ON tb_coa.idkelompok = tb_coa_info.idkelompok
			WHERE idperiode=" . $idperiode1 . " AND tb_awal.kodeakun=" . $akunbukubesar . ";";
	$resultaw = $mysqli->query($sqlaw);
	while($barisaw = $resultaw->fetch_object())
	{
		$kodeakun1=$barisaw->kodeakun; $akun1=$barisaw->akun; $normal=$barisaw->normal;
		$dbawal=$barisaw->db; $krawal=$barisaw->kr; 
	}	
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
		$tnilaidb=0;
		$tnilaicr=0;
//		$sql6 = "SELECT idtran, tgltran, nobukti, deskripsi, akundb, akuncr, nilai,
//				IF(akundb=" . $akunbukubesar . ", nilai, 0) AS nilaidb, 
//				IF(akuncr=" . $akunbukubesar . ", nilai, 0) AS nilaicr
//				FROM `tb_jurnal`
//				WHERE akundb =" . $akunbukubesar . "
//				OR akuncr =" . $akunbukubesar . "
//				ORDER BY `tb_jurnal`.`tgltran` ASC , `tb_jurnal`.`nobukti` ASC";

		//$transaksi=0; $tdebet=0; $tkredit=0;
		$sql2 ="SELECT idjurnal, tgljurnal, nobukti, deskripsi, idbaris, kodeakun, namaakun, debet, kredit 
				FROM vbukubesar WHERE kodeakun=" . $akunbukubesar . " ORDER BY idbaris;";	

		$ulang=1;
		$nourut=1;
		$ulangheader=0;
		$hal=1;
		$cekkodebag="awal";
		$tdb=0;
		$tkr=0; 
		
//		$result2 = $mysqli->query($sql6);
//		while($baris2 = $result2->fetch_object())
//		{			
//			$idperiode=$idperiode1;  
//			$idtran=$baris2->idtran; $tgltran=$baris2->tgltran; $nobukti=$baris2->nobukti; $deskripsi=$baris2->deskripsi;
//			$akundb=$baris2->akundb;   
//			$akuncr=$baris2->akuncr; $nilai=$baris2->nilai; $nilaidb=$baris2->nilaidb; $nilaicr=$baris2->nilaicr; 
//			$tgltran=formattgl($tgltran);  
//			$deskripsi=substr($deskripsi,0,100); 

		$result2 = $mysqli->query($sql2);
		while($baris2 = $result2->fetch_object())
		{
			$idperiode=$idperiode1;
			$idjurnal=$baris2->idjurnal; $tgljurnal=$baris2->tgljurnal; $nobukti=$baris2->nobukti; 
			$deskripsi=$baris2->deskripsi; $idbaris=$baris2->idbaris;
			$kodeakun=$baris2->kodeakun;   
			$namaakun=$baris2->namaakun; $debet=$baris2->debet; $kredit=$baris2->kredit; 
			$tgljurnal=formattgl($tgljurnal); 		

		
			if($ulangheader==0)
			{
	?>
	<p class="pnormal">&nbsp;</p>
	<table border='0' cellspacing='0' cellpadding='0' width='1000'>
		<tr><td align='center'>
				<h2 class='h1'>Sistem Akuntansi Keuangan <br/>
				Buku Besar <br/><?php echo($nmperiode1);?></h2>
			</td>
		</tr>
	</table>	
	<table border='0' cellspacing='0' cellpadding='0' width='1000'>
		<tr><td class='tdb' width=20%>Kode Perkiraan</td>
			<td class='tdb'  width=80%>: <?php echo($kodeakun1);?></td> 
		</tr>
		<tr><td class='tdb' >Nama Perkiraan</td>
			<td class='tdb' >: <?php echo($akun1);?></td> 
		</tr>		
	</table>	
	
	<p class="pnormal">hal.<?php echo($hal);?></p>
	<table border='1' cellspacing='0' cellpadding='0' width='1000'>		
		<tr>
			<td align='center' class='tdnc' width='25'>Urut</td>
			<td align='center' class='tdnc' width='75'>Tanggal</td>			
			<td align='center' class='tdnc' width='100'>No.Bukti</td>			
			<td align='center' class='tdnc' width='600'>Deskripsi</td>
			<td align='center' class='tdnc' width='100'>Debet</td>
			<td align='center' class='tdnc' width='100'>Kredit</td>
		</tr>
		<tr>
			<td class='tdnc'></td>
			<td class='tdnc'></td>			
			<td class='tdn'></td>
			<td class='tdn'>Saldo Awal</td>
			<td class='tdnr'><?php echo(number_format($dbawal,2, ',', '.'));?></td>
			<td class='tdnr'><?php echo(number_format($krawal,2, ',', '.'));?></td>
		</tr>				
		
	<?php
			}			
	?>			
		<tr>
			<td class='tdnc'><?php echo($idbaris);?></td>
			<td class='tdnc'><?php echo($tgljurnal);?></td>			
			<td class='tdn'><?php echo($nobukti);?></td>
			<td class='tdn'><?php echo($deskripsi);?></td>
			<td class='tdnr'><?php echo(number_format($debet,2, ',', '.'));?></td>
			<td class='tdnr'><?php echo(number_format($kredit,2, ',', '.'));?></td>
		</tr>
	<?php
			$ulang=$ulang+1;
			$nourut=$nourut+1;
			if($ulangheader>28)
			{	$ulangheader=0;	$hal=$hal+1;
	?>
	</table>
	<p style="page-break-before: always">
	<?php
			}
			else
			{	$ulangheader=$ulangheader+1;	}
			$tnilaidb=$tnilaidb+$debet;
			$tnilaicr=$tnilaicr+$kredit;
		}	
		
	?>
	<?php
		// cari kode akun, nama akun, saldo awal dan posisi normal
		$sqlaw="SELECT idperiode, tb_awal.kodeakun, akun, normal, db, kr 
				FROM `tb_awal` 
				INNER JOIN tb_coa ON tb_awal.kodeakun = tb_coa.kodeakun
				INNER JOIN tb_coa_info ON tb_coa.idkelompok = tb_coa_info.idkelompok
				WHERE idperiode=" . $idperiode1 . " AND tb_awal.kodeakun=" . $akunbukubesar . ";";
		$resultaw = $mysqli->query($sqlaw);
		while($barisaw = $resultaw->fetch_object())
		{
			$kodeakun1=$barisaw->kodeakun; $akun1=$barisaw->akun; $normal=$barisaw->normal;
			$db=$barisaw->db; $kr=$barisaw->kr; 
		}
		if($normal=='D')
		{
			$saldo=$tnilaidb-$tnilaicr;
			$sebutan='Db';
		}
		if($normal=='K')
		{
			$saldo=$tnilaicr-$tnilaidb;
			$sebutan='Kr';
		}
	?>
		<tr>
			<td colspan='3' class='tdnr'>Saldo (<?php echo($sebutan . '): ' . number_format($saldo,2, ',', '.'));?></td>
			<td class='tdnr'>J u m l a h</td>
			<td class='tdnrb'><?php echo(number_format($tnilaidb,2, ',', '.'));?></td>			
			<td class='tdnrb'><?php echo(number_format($tnilaicr,2, ',', '.'));?></td>			
			
		</tr>			
	</table>
	
</body>
</html>