<!DOCTYPE html>
<html lang='en'>    
<head>
    <meta charset="UTF-8">
    <title> SisKA : Sistem Komputer Akuntansi </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>	
	<link rel="shortcut icon" href="../pic/logobaktihusada_kecil.ico">	
</head>
<body>

	<table border='1' cellspacing='0' cellpadding='0' width='1250'>		
		<tr>
			<td colspan=8>
				<h2 ><small>Sistem Akuntansi Keuangan </small><br/>Buku Besar <?php echo($nmperiode1);?></h2></td>
			</td>
		</tr>
		<tr>		
			<td align='center' width='50'></td>
			<td align='center' width='100'></td>
			<td align='center' width='200'></td>
			<td align='center' width='200'></td>
			<td align='center' width='600'></td>
			<td align='right' width='100'></td>
			<td align='right' width='100'></td>
			<td align='right' width='100'></td>
		</tr'
		<?php
			// cari kode akun, nama akun, saldo awal dan posisi normal
			$normal=''; 
			//$sldawal=0; $dbawal=0; $krawal=0; $saldo=0; $kodeakun1=''; $akun1='';
			$sqlaw="SELECT idperiode, tb_awal.kodeakun, akun, normal, db, kr 
					FROM `tb_awal` 
					INNER JOIN tb_coa ON tb_awal.kodeakun = tb_coa.kodeakun
					INNER JOIN tb_coa_info ON tb_coa.idkelompok = tb_coa_info.idkelompok
					WHERE LEFT(idperiode,4)=" . $tahunperiode . " AND tb_awal.kodeakun=" . $akunbukubesar . ";";

					
			$resultaw = $mysqli->query($sqlaw);
			while($barisaw = $resultaw->fetch_object())
			{
				$kodeakun1=$barisaw->kodeakun; $akun1=$barisaw->akun; $normal1=$barisaw->normal;
				$dbawal=$barisaw->db; $krawal=$barisaw->kr; 
				if($normal1=="D"){ $sldawal=$dbawal; } else { $sldawal=$krawal; }
			}	
			$saldo=$saldo+$sldawal;
			
			// 	=============== cari rekap saldo di periode lalu =====================================================
			$saldolalu=0; $dblalu=0; $krlalu=0;
			$sqllalu = "SELECT kodeakun, namaakun, SUM( debet ) AS tdebet, SUM( kredit ) AS tkredit, 
						IF( LEFT( kodeakun, 1 ) = '1' OR LEFT( kodeakun, 1 ) = '5', SUM( debet - kredit ) , SUM( kredit - debet ) ) AS saldo
						FROM vbukubesardua
						WHERE kodeakun ='" . $akunbukubesar . "' 
						AND idperiode <" . $idperiodepilih . "
						GROUP BY kodeakun";

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
		
		<tr>
			<td class='tdb' colspan=2 >Kode Perkiraan</td>
			<td class='tdb'  colspan=6 >: <?php echo($kodeakun1);?></td> 
		</tr>
		<tr><td class='tdb' colspan=2 >Nama Perkiraan</td>
			<td class='tdb' colspan=6 >: <?php echo($akun1);?></td> 
		</tr>				
		<tr>		
			<td align='center' width='50'>urut.</td>
			<td align='center' width='100'>Tanggal</td>
			<td align='center' width='200'>No.Bukti</td>
			<td align='center' width='200'>No.Buku</td>
			<td align='center' width='600'>Deskripsi</td>
			<td align='right' width='100'>Debet</td>
			<td align='right' width='100'>Kredit</td>
			<td align='right' width='100'>Saldo</td>
		</tr>
		<tr>
			<td class='tdnc'>1</td>
			<td class='tdnc'></td>			
			<td class='tdn'></td>
			<td class='tdn'></td>
			<td class='tdn'>Saldo Awal</td>
			<td class='tdn'></td>
			<td class='tdn'></td>
			<!--
			<td class='tdnr'><?php echo($dbawal);?></td>
			<td class='tdnr'><?php echo($krawal);?></td>
			-->
			<td class='tdnr'><?php echo(number_format($saldoawalbaris,2,',','.'));?></td>
		</tr>				
		
	<?php
			//}			
	?>			
	<?php
		$tnilaidb=0;
		$tnilaicr=0;
		//$tsaldo=$sldawal;
		$tsaldo=$saldoawalbaris;
		//$sql2 ="SELECT idperiode, idjurnal, tgljurnal, nobukti, nobuku, deskripsi, idbaris, kodeakun, namaakun, debet, kredit 
		//		FROM vbukubesardua WHERE idperiode=" . $idperiodepilih . " AND kodeakun=" . $akunbukubesar . " ORDER BY idbaris;";	
				
		$sql2 ="SELECT idjurnal, tgljurnal, nobukti, nobuku, deskripsi, idbaris, kodeakun, namaakun, debet, kredit, idperiode  
				FROM vbukubesardua WHERE kodeakun=" . $akunbukubesar . " AND idperiode=" . $idperiodepilih . "
				ORDER BY idperiode, tgljurnal, nobukti;";		
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
			$cek=substr($akunbukubesar,0,1); 
			if($cek==1 || $cek==5) 
			{	$tsaldo=$tsaldo+($debet-$kredit);  
			}
			else
			{ 	$tsaldo=$tsaldo+($kredit-$debet);   
			}
	?>

		<tr>
			<td align='center' ><?php echo($nourut);?></td>
			<td align='center' ><?php echo($tgljurnal);?></td>
			<td align='center' ><?php echo($nobukti);?></td>	
			<td align='center' ><?php echo($nobuku);?></td>		
			<td align='justify' ><?php echo($deskripsi);?></td>
			<td align='right' ><?php echo(number_format($debet,2,',','.'));?></td>
			<td align='right' ><?php echo(number_format($kredit,2,',','.'));?></td>
			<td align='right' ><?php echo(number_format($tsaldo,2,',','.'));?></td>
		</tr>
	<?php
			$ulang=$ulang+1;
			$nourut=$nourut+1;
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
				WHERE LEFT(idperiode,4)=" . $tahunperiode . " AND tb_awal.kodeakun=" . $akunbukubesar . ";";
		$resultaw = $mysqli->query($sqlaw);
		while($barisaw = $resultaw->fetch_object())
		{
			$kodeakun1=$barisaw->kodeakun; $akun1=$barisaw->akun; $normal=$barisaw->normal;
			$db=$barisaw->db; $kr=$barisaw->kr; 
		}
		if($normal=='D')
		{
			$saldo=$sldawal+($tnilaidb-$tnilaicr);
			$sebutan='Db';
		}
		if($normal=='K')
		{
			$saldo=$sldawal+($tnilaicr-$tnilaidb);
			$sebutan='Kr';
		}
	?>
		<tr>
			<td colspan="5" align='right' >J u m l a h</td>		
			<td align='right' ><?php echo(number_format($tnilaidb,2,',','.'));?></td>
			<td align='right' ><?php echo($tnilaicr);?></td>
			<td align='right' ></td>
		</tr>
		<tr>
			<td colspan="5" align='right' >Saldo (<?php echo($sebutan);?>)</td>		
			<td colspan="3" align='right' ><?php echo(number_format($saldo,2,',','.'));?></td>
		</tr>
	
	</table>
	
</body>
</html>