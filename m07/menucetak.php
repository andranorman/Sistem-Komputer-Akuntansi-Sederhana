<?php
	session_start();
	include("../dbcon.php");
	include("../fungsi.php");
	$idperiodepilih=$_SESSION['idperiodepilih'];
	$nmperiodepilih=$_SESSION['nmperiodepilih'];
	$idperiode1=$_SESSION['aktif_idperiode'];
	$nmperiode1=$_SESSION['aktif_nmperiode'];	
	$akunbukubesar=$_SESSION['aktif_akunbukubesar'];
	$tahunperiode=substr($idperiodepilih,0,4);
	
	$dbawal=0; $krawal=0; $sldawal=0; $saldo=0; $barisawal=0; $normal=''; 

	// cari kode akun, nama akun, saldo awal dan posisi normal 
	$sqlaw="SELECT idperiode, tb_awal.kodeakun, akun, normal, db, kr 
			FROM `tb_awal` 
			INNER JOIN tb_coa ON tb_awal.kodeakun = tb_coa.kodeakun
			INNER JOIN tb_coa_info ON tb_coa.idkelompok = tb_coa_info.idkelompok
			WHERE LEFT(idperiode,4)=" . $tahunperiode . " AND tb_awal.kodeakun=" . $akunbukubesar . ";";
	$resultaw = $mysqli->query($sqlaw);
	while($barisaw = $resultaw->fetch_object())
	{
		$kodeakun1=$barisaw->kodeakun; $akun1=$barisaw->akun; $normal=$barisaw->normal;
		$dbawal=$barisaw->db; $krawal=$barisaw->kr; 
		if($normal=="D"){ $sldawal=$dbawal; } 
		else { $sldawal=$krawal; }
	}	
	$saldo=$saldo+$sldawal;

	// 	=============== cari rekap saldo di periode lalu =====================================================
	$saldolalu=0; $dblalu=0; $krlalu=0;
	$sqllalu = "SELECT kodeakun, namaakun, SUM( debet ) AS tdebet, SUM( kredit ) AS tkredit, 
				IF( LEFT( kodeakun, 1 ) = '1' OR LEFT( kodeakun, 1 ) = '5', SUM( debet - kredit ) , SUM( kredit - debet ) ) AS saldo
				FROM (
					SELECT idperiode, tb_jurnal_rinci.idjurnal, tgljurnal, nobukti, nobuku, 
					deskripsi, kodemst, idbaris, kodeakun, namaakun, debet, kredit, koderinci 
					FROM tb_jurnal_rinci 
					INNER JOIN tb_jurnal_mst ON tb_jurnal_rinci.idjurnal=tb_jurnal_mst.idjurnal
					) AS data 
				WHERE kodeakun=" . $akunbukubesar . " AND idperiode=" . $idperiodepilih . "
				GROUP BY kodeakun;";

	//$sqllalu = "SELECT kodeakun, namaakun, SUM( debet ) AS tdebet, SUM( kredit ) AS tkredit, 
	//			IF( LEFT( kodeakun, 1 ) = '1' OR LEFT( kodeakun, 1 ) = '5', SUM( debet - kredit ) , SUM( kredit - debet ) ) AS saldo
	//			FROM vbukubesardua
	//			WHERE kodeakun ='" . $akunbukubesar . "' 
	//			AND idperiode <" . $idperiodepilih . "
	//			GROUP BY kodeakun";
				
	$resultlalu = $mysqli->query($sqllalu);
	$barislalu = $resultlalu->fetch_object();
	$countlalu = $resultlalu->num_rows; 
	if($countlalu>0)
	{
		$saldolalu=$barislalu->saldo; $dblalu=$barislalu->tdebet; $krlalu=$barislalu->tkredit; 
	}
	// 	cek posisi normal debet atau kredit	
	$cek=substr($akunbukubesar,0,1); 
	//$saldo=$saldo+$saldolalu;
	$saldoawalbaris=$saldo+$saldolalu;
	// 	===================================================================================================

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
	<?php		
		$tnilaidb=0;
		$tnilaicr=0;

		$sql2 ="SELECT idjurnal, tgljurnal, nobukti, nobuku, deskripsi, idbaris, kodeakun, namaakun, debet, kredit, idperiode  
				FROM 
				(
					SELECT idperiode, tb_jurnal_rinci.idjurnal, tgljurnal, nobukti, nobuku, 
					deskripsi, kodemst, idbaris, kodeakun, namaakun, debet, kredit, koderinci 
					FROM tb_jurnal_rinci 
					INNER JOIN tb_jurnal_mst ON tb_jurnal_rinci.idjurnal=tb_jurnal_mst.idjurnal
					) AS data  
				WHERE kodeakun=" . $akunbukubesar . " AND idperiode=" . $idperiodepilih . "
				ORDER BY idperiode, tgljurnal, nobukti;";	

		//$sql2 ="SELECT idjurnal, tgljurnal, nobukti, nobuku, deskripsi, idbaris, kodeakun, namaakun, debet, kredit, idperiode  
		//		FROM vbukubesardua WHERE kodeakun=" . $akunbukubesar . " AND idperiode=" . $idperiodepilih . "
		//		ORDER BY idperiode, tgljurnal, nobukti;";	
		$ulang=1;
		$nourut=1;
		$ulangheader=0;
		$hal=1;
		$cekkodebag="awal";
		$tdb=0;
		$tkr=0; 
		
		$result2 = $mysqli->query($sql2);
		while($baris2 = $result2->fetch_object())
		{
			$idperiode=$idperiode1;
			$idjurnal=$baris2->idjurnal; $tgljurnal=$baris2->tgljurnal; $nobukti=$baris2->nobukti; 
			$deskripsi=$baris2->deskripsi; $idbaris=$baris2->idbaris; $nobuku=$baris2->nobuku; 
			$kodeakun=$baris2->kodeakun;   
			$namaakun=$baris2->namaakun; $debet=$baris2->debet; $kredit=$baris2->kredit; 
			$tgljurnal=formattgl($tgljurnal); 		
			
			// 	cek posisi normal debet atau kredit	 
			if($normal=="D") 
			{	$saldo=$saldo+($debet-$kredit);  
			}
			else
			{ 	$saldo=$saldo+($kredit-$debet);   
			}			
						
			if($ulangheader==0)
			{
	?>
	<p class="pnormal">&nbsp;</p>
	<table border='0' cellspacing='0' cellpadding='0' width='1100'>
		<tr><td align='center'>
				<h2 class='h1'>Sistem Akuntansi Keuangan <br/>
				Buku Besar <br/><?php echo($nmperiodepilih);?></h2>
			</td>
		</tr>
	</table>	
	<table border='0' cellspacing='0' cellpadding='0' width='1100'>
		<tr><td class='tdb' width=20%>Kode Perkiraan</td>
			<td class='tdb'  width=80%>: <?php echo($kodeakun);?></td> 
		</tr>
		<tr><td class='tdb' >Nama Perkiraan</td>
			<td class='tdb' >: <?php echo($namaakun);?></td> 
		</tr>		
	</table>	
	
	<p class="pnormal">hal.<?php echo($hal);?></p>
	<table border='1' cellspacing='0' cellpadding='0' width='1100'>		
		<tr>
			<td align='center' class='tdnc' width='25'>Urut</td>
			<td align='center' class='tdnc' width='75'>Tanggal</td>			
			<td align='center' class='tdnc' width='100'>No.Bukti</td>			
			<td align='center' class='tdnc' width='100'>No.Buku</td>
			<td align='center' class='tdnc' width='500'>Deskripsi</td>
			<td align='center' class='tdnc' width='100'>Debet</td>
			<td align='center' class='tdnc' width='100'>Kredit</td>
			<td align='center' class='tdnc' width='100'>Saldo</td>
		</tr>
	<?php
				if($barisawal==0)
				{
	?>
		<tr>
			<td class='tdnc'>1</td>
			<td class='tdnc'></td>			
			<td class='tdn'></td>
			<td class='tdn'></td>
			<td class='tdn'>Saldo Awal</td>
			<td class='tdn'></td>
			<td class='tdn'></td>
			<!--
			<td class='tdnr'><?php echo(number_format($dbawal,2,',','.'));?></td>
			<td class='tdnr'><?php echo(number_format($krawal,2,',','.'));?></td>
			-->
			<td class='tdnr'><?php echo(number_format($saldoawalbaris,2,',','.'));?></td>
		</tr>				
		
	<?php
				}
			}
			$ulang=$ulang+1;
			$nourut=$nourut+1;			
	?>			
		<tr>
			<td class='tdnc'><?php echo($nourut);?></td>
			<td class='tdnc'><?php echo($tgljurnal);?></td>			
			<td class='tdn'><?php echo($nobukti);?></td>
			<td class='tdn'><?php echo($nobuku);?></td>
			<td class='tdn'><?php echo($deskripsi);?></td>
			<td class='tdnr'><?php echo(number_format($debet,2,',','.'));?></td>
			<td class='tdnr'><?php echo(number_format($kredit,2,',','.'));?></td>
			<td class='tdnr'><?php echo(number_format($saldo,2,',','.'));?></td>
		</tr>
	<?php
			$barisawal=$barisawal+1;
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
				WHERE idperiode=" . $idperiodepilih . " AND tb_awal.kodeakun=" . $akunbukubesar . ";";
		$resultaw = $mysqli->query($sqlaw);
		while($barisaw = $resultaw->fetch_object())
		{
			$kodeakun1=$barisaw->kodeakun; $akun1=$barisaw->akun; $normal=$barisaw->normal;
			$db=$barisaw->db; $kr=$barisaw->kr; 
		}
		if($normal=='D')
		{
			$tsaldo=$dbawal+($tnilaidb-$tnilaicr);
			$sebutan='Db';
		}
		if($normal=='K')
		{
			$tsaldo=$krawal+($tnilaicr-$tnilaidb);
			$sebutan='Kr';
		}
	?>
		<tr>
			<td colspan='4' class='tdbc'>Saldo (<?php echo($sebutan . '): ' . number_format(($saldo)));?></td>
			<td class='tdnr'>J u m l a h</td>
			<td class='tdnrb'><?php echo(number_format($dbawal+$tnilaidb,2,',','.'));?></td>			
			<td class='tdnrb'><?php echo(number_format($krawal+$tnilaicr,2,',','.'));?></td>			
			<td class='tdnrb'></td>						
		</tr>			
	</table>
	
</body>
</html>