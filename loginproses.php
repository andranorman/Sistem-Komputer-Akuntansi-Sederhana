<?php
session_start();
//error_reporting(0);
//date_default_timezone_set('Asia/Jakarta');
require_once("dbcon.php");

$my_idusr=$_POST['userid']; 
$my_pwusr=$_POST['password']; 

$my_idusr = stripslashes(strip_tags($my_idusr)); 
$my_pwusr = stripslashes(strip_tags($my_pwusr)); 

$my_idusr = $mysqli->real_escape_string($my_idusr); 
$my_pwusr = $mysqli->real_escape_string($my_pwusr); 

$menuju = "modpgw/menu.php" ;		
$sqlp = "SELECT idusr, pwusr, nmpeg, kdpeg, kode, m01, m02, m03, m04, m05, m06, m07, m08, m09, m10, m11, m12, m13, m14
		 FROM usr_peg 
		 WHERE idusr='$my_idusr' AND pwusr='$my_pwusr'";
$resultp = $mysqli->query($sqlp);
$barisp = $resultp->fetch_object();
$countp = $resultp->num_rows; 

if( $countp>0 ) 
{
	// ambil variabel wewenang user	
	$_SESSION['idusr']=$my_idusr ;
	$_SESSION['kdpeg']=$barisp->kdpeg ;
	$_SESSION['nmpeg']=$barisp->nmpeg ;
	$_SESSION['kode']=$barisp->kode ;
	$_SESSION['m01']=$barisp->m01 ;
	$_SESSION['m02']=$barisp->m02 ;
	$_SESSION['m03']=$barisp->m03 ;
	$_SESSION['m04']=$barisp->m04 ;
	$_SESSION['m05']=$barisp->m05 ;
	$_SESSION['m06']=$barisp->m06 ;
	$_SESSION['m07']=$barisp->m07 ;
	$_SESSION['m08']=$barisp->m08 ;
	$_SESSION['m09']=$barisp->m09 ;
	$_SESSION['m10']=$barisp->m10 ;
	$_SESSION['m11']=$barisp->m11 ;
	$_SESSION['m12']=$barisp->m12 ;
	$_SESSION['m13']=$barisp->m13 ;
	$_SESSION['m14']=$barisp->m14 ;
		
	// cari periode akuntansi aktif
	$sql1 ="SELECT idperiode, nmperiode, dari, sampai, dipilih
			FROM `tb_periode` WHERE dipilih =1";
	$result1 = $mysqli->query($sql1);
	while($baris1 = $result1->fetch_object())
	{
		$idperiode=$baris1->idperiode; $nmperiode=$baris1->nmperiode;
		$dari=$baris1->dari; $sampai=$baris1->sampai;  
		$_SESSION['idperiodeaktif']=$idperiode;
		$_SESSION['idperiodepilih']=$idperiode;
		$_SESSION['nmperiodepilih']=$nmperiode;
		$_SESSION['aktif_idperiode']=$idperiode;
		$_SESSION['aktif_nmperiode']=$nmperiode;	

		$_SESSION['aktif_dari']=$dari;
		$_SESSION['aktif_sampai']=$sampai;
		$_SESSION['idtriwulanaktif']=1;
		$_SESSION['nmtriwulanaktif']='TRIWULAN I';

		//$daritgl=date("d-m-Y");
		//$sampaitgl=date("d-m-Y");
		$daritgl=date("m/d/Y");
		$sampaitgl=date("m/d/Y");
		$tglcetakspj=date("d-m-Y");

		$_SESSION['aktif_daritgl']=$daritgl;
		$_SESSION['aktif_sampaitgl']=$sampaitgl;
		$_SESSION['tglcetakspj']=$tglcetakspj;
		
		$_SESSION['aktif_akunbukubesar']=100101;
		//$_SESSION['aktif_akunbukubesar']=100100101;
		//$_SESSION['aktif_akunbukubesarpenerimaan']=414210101;
		//$_SESSION['aktif_akunbukubesarpenerimaan_operasional']=414210101;
		//$_SESSION['aktif_nama_akunbukubesarpenerimaan_operasional']='Rawat Jalan';
		//$_SESSION['aktif_nama_kelompok_akunbukubesarpenerimaan_operasional']='PENDAPATAN JASA LAYANAN';
		//$_SESSION['aktif_akunbukubesarpengeluaran']=511100001;
		$_SESSION['aktif_kelakunbukubesar']=0;
		$_SESSION['aktif_idbukubesar']=0;
	}

	// cari periode anggaran aktif
	$sql1 ="SELECT idperiode, nmperiode, dari, sampai, dipilih, nmdirektur, nipdirektur, nmpejabatkeu, nippejabatkeu, nmpejabatblu, nippejabatblu,
					nmbendmasuk, nipbendmasuk, nmbendkeluar, nipbendkeluar 
			FROM `tb_periode_anggaran` WHERE dipilih =1";
	$result1 = $mysqli->query($sql1);
	while($baris1 = $result1->fetch_object())
	{
		$idperiodea=$baris1->idperiode; $nmperiodea=$baris1->nmperiode;
		$daria=$baris1->dari; $sampaia=$baris1->sampai;  
		$nmdirektur=$baris1->nmdirektur; $nipdirektur=$baris1->nipdirektur; 
		$nmpejabatkeu=$baris1->nmpejabatkeu; $nippejabatkeu=$baris1->nippejabatkeu; $nmpejabatblu=$baris1->nmpejabatblu; $nippejabatblu=$baris1->nippejabatblu;
		$nmbendmasuk=$baris1->nmbendmasuk; $nipbendmasuk=$baris1->nipbendmasuk; $nmbendkeluar=$baris1->nmbendkeluar; $nipbendkeluar=$baris1->nipbendkeluar;
		
		$_SESSION['idanggaran_aktif']=$idperiodea;
		$_SESSION['nmanggaran_aktif']=$nmperiodea;
		$_SESSION['anggarandari_aktif']=$daria;
		$_SESSION['anggaransampai_aktif']=$sampaia;
		// variabel pejabat keuangan
		$_SESSION['nmdirektur']=$nmdirektur;
		$_SESSION['nipdirektur']=$nipdirektur;
		$_SESSION['nmpejabatkeu']=$nmpejabatkeu;
		$_SESSION['nippejabatkeu']=$nippejabatkeu;
		$_SESSION['nmpejabatblu']=$nmpejabatblu;
		$_SESSION['nippejabatblu']=$nippejabatblu;
		$_SESSION['nmbendmasuk']=$nmbendmasuk;
		$_SESSION['nipbendmasuk']=$nipbendmasuk;
		$_SESSION['nmbendkeluar']=$nmbendkeluar;
		$_SESSION['nipbendkeluar']=$nipbendkeluar;
	}
	
	// tetapkan session kunci
	$_SESSION['skars']=1;
	$_SESSION['simkeu']=1;
	$_SESSION['kondisi']=0 ;
	$_SESSION['idsupplier']=1 ;
	$_SESSION['supplier']='' ;
	$_SESSION['tampilkoreksi']=1;
	$_SESSION['daripajak']=0;
	$_SESSION['idjen']=1 ;
	$_SESSION['jenis']='' ;
}
else
{
	$pesan="User ID atau Password anda keliru...";
	$menuju="index.php?pesan=" . $pesan;
}		

header("location:$menuju");
?>