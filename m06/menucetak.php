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
		$tdb_awal=0;
		$tkr_awal=0;
		$tdb_mutasi=0;
		$tkr_mutasi=0;
		$tdb_penyesuaian=0;
		$tkr_penyesuaian=0;
		$tdb_saldo=0;           
		$tkr_saldo=0;
			
		$sql6= "SELECT idperiode, tb_nrcsaldo.kodeakun, akun, db_awal, kr_awal, db_mutasi, kr_mutasi, 
				db_penyesuaian, kr_penyesuaian, db_saldo, kr_saldo 
				FROM tb_nrcsaldo INNER JOIN tb_coa ON tb_nrcsaldo.kodeakun=tb_coa.kodeakun  
				WHERE idperiode=" . $idperiode1 . " AND LEFT(tb_nrcsaldo.kodeakun,1)='4'
				ORDER BY tb_nrcsaldo.kodeakun";								
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
			$kodeakun=$baris2->kodeakun; $akun=$baris2->akun; $db_awal=$baris2->db_awal; $kr_awal=$baris2->kr_awal;
			$db_mutasi=$baris2->db_mutasi; $kr_mutasi=$baris2->kr_mutasi; 
			$db_penyesuaian=$baris2->db_penyesuaian; $kr_penyesuaian=$baris2->kr_penyesuaian;
			$db_saldo=$baris2->db_saldo; $kr_saldo=$baris2->kr_saldo;
			$akun=substr($akun,0,50);
			
			//$pdb_awal=number_format($db_awal);
			//$pkr_awal=number_format($kr_awal);
			//$pdb_mutasi=number_format($db_mutasi);
			//$pkr_mutasi=number_format($kr_mutasi);
			//$pdb_penyesuaian=number_format($db_penyesuaian);
			//$pkr_penyesuaian=number_format($kr_penyesuaian);
			//$pdb_saldo=number_format($db_saldo);
			//$pkr_saldo=number_format($kr_saldo);

			$pdb_awal=$db_awal;
			$pkr_awal=$kr_awal;
			$pdb_mutasi=$db_mutasi;
			$pkr_mutasi=$kr_mutasi;
			$pdb_penyesuaian=$db_penyesuaian;
			$pkr_penyesuaian=$kr_penyesuaian;
			$pdb_saldo=$db_saldo;
			$pkr_saldo=$kr_saldo;
			
			if($ulangheader==0)
			{
	?>
	<p class="pnormal">&nbsp;</p>
	<table border='0' cellspacing='0' cellpadding='0' width='1400'>
		<tr><td align='center'>
			<h2 class='h1'>Sistem Akuntansi Keuangan<br/>
			Neraca Saldo Pendapatan <?php echo($nmperiode1);?>
			</h2></td>
		</tr>
	</table>	
	<p class="pnormal">hal.<?php echo($hal);?></p>
	<table border='1' cellspacing='0' cellpadding='0' width='1400'>		
		<tr>
			<td rowspan="2" align='center' class='tdnc' width='25'>Kode</td>
			<td rowspan="2" align='center' class='tdnc' width='335'>Nama Akun</td>
			<td colspan="2" align='center' class='tdnc' width='260'>Saldo Awal</td>
			<td colspan="2" align='center' class='tdnc' width='260'>Mutasi</td>
			<td colspan="2" align='center' class='tdnc' width='260'>Penyesuaian</td>
			<td colspan="2" align='center' class='tdnc' width='260'>Saldo Akhir</td>
			
		</tr>
		<tr>
			<td align='center' class='tdnc' width='130'>Db</td>
			<td align='center' class='tdnc' width='130'>Kr</td>
			<td align='center' class='tdnc' width='130'>Db</td>
			<td align='center' class='tdnc' width='130'>Kr</td>
			<td align='center' class='tdnc' width='130'>Db</td>
			<td align='center' class='tdnc' width='130'>Kr</td>
			<td align='center' class='tdnc' width='130'>Db</td>
			<td align='center' class='tdnc' width='130'>Kr</td>			
		</tr>
	<?php
			}
			
	?>			
		<tr>
			<td class='tdnc'><?php echo($kodeakun);?></td>
			<td class='tdn'><?php echo($akun);?></td>			
			<td align='right'  class='tdnr'><?php echo(number_format($pdb_awal,2, ',', '.'));?></td>
			<td align='right'  class='tdnr'><?php echo(number_format($pkr_awal,2, ',', '.'));?></td>
			<td align='right'  class='tdnr'><?php echo(number_format($pdb_mutasi,2, ',', '.'));?></td>
			<td align='right'  class='tdnr'><?php echo(number_format($pkr_mutasi,2, ',', '.'));?></td>
			<td align='right'  class='tdnr'><?php echo(number_format($pdb_penyesuaian,2, ',', '.'));?></td>
			<td align='right'  class='tdnr'><?php echo(number_format($pkr_penyesuaian,2, ',', '.'));?></td>
			<td align='right'  class='tdnr'><?php echo(number_format($pdb_saldo,2, ',', '.'));?></td>
			<td align='right'  class='tdnr'><?php echo(number_format($pkr_saldo,2, ',', '.'));?></td>			
		</tr>
	<?php
			$ulang=$ulang+1;
			$nourut=$nourut+1;
			if($ulangheader>28)
			{	$ulangheader=0;	$hal=$hal+1;
	?>
	</table>
	<p style="page-break-before: always"></p>
	<?php
			}
			else
			{	$ulangheader=$ulangheader+1;	}
		
			$tdb_awal=$tdb_awal+$db_awal;
			$tkr_awal=$tkr_awal+$kr_awal;
			$tdb_mutasi=$tdb_mutasi+$db_mutasi;
			$tkr_mutasi=$tkr_mutasi+$kr_mutasi;
			$tdb_penyesuaian=$tdb_penyesuaian+$db_penyesuaian;
			$tkr_penyesuaian=$tkr_penyesuaian+$kr_penyesuaian;
			$tdb_saldo=$tdb_saldo+$db_saldo;
			$tkr_saldo=$tkr_saldo+$kr_saldo;
		}	
		
	?>
		<tr>
			<td class='tdnc'>-</td>
			<td class='tdnc'>J u m l a h</td>			
			<td align='right'  class='tdnr'><?php echo(number_format($tdb_awal,2, ',', '.'));?></td>
			<td align='right'  class='tdnr'><?php echo(number_format($tkr_awal,2, ',', '.'));?></td>
			<td align='right'  class='tdnr'><?php echo(number_format($tdb_mutasi,2, ',', '.'));?></td>
			<td align='right'  class='tdnr'><?php echo(number_format($tkr_mutasi,2, ',', '.'));?></td>
			<td align='right'  class='tdnr'><?php echo(number_format($tdb_penyesuaian,2, ',', '.'));?></td>
			<td align='right'  class='tdnr'><?php echo(number_format($tkr_penyesuaian,2, ',', '.'));?></td>
			<td align='right'  class='tdnr'><?php echo(number_format($tdb_saldo,2, ',', '.'));?></td>
			<td align='right'  class='tdnr'><?php echo(number_format($tkr_saldo,2, ',', '.'));?></td>			
		</tr>
	</table>
	
</body>
</html>