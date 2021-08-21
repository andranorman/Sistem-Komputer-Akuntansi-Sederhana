<?php 
// ------------- awal fungsi tgl string (dd-MMM-yyyy) ke date 0000-00-00 -------------- //
function tglstringkedate($cektgl)
{
	switch($cektgl)
	{
	case "" :
		$hasiltgl="0000-00-00" ;	
		break ;
	default :
		$thn=substr($cektgl,-4,4) ;
		$bln_nama=substr($cektgl,-8,3) ;
		switch ( $bln_nama ) 
		{
			case "Jan" :
				$bln_angka="01" ;
				break ;
			case "Feb" :
				$bln_angka="02" ;
				break ;
			case "Mar" :
				$bln_angka="03" ;
				break ;
			case "Apr" :
				$bln_angka="04" ;
				break ;
			case "May" :
				$bln_angka="05" ;
				break ;
			case "Jun" :
				$bln_angka="06" ;
				break ;
			case "Jul" :
				$bln_angka="07" ;
				break ;
			case "Aug" :
				$bln_angka="08" ;
				break ;
			case "Sep" :
				$bln_angka="09" ;
				break ;
			case "Oct" :
				$bln_angka="10" ;
				break ;
			case "Nov" :
				$bln_angka="11" ;
				break ;
			case "Dec" :
				$bln_angka="12" ;
				break ;
		}
		$periksa_tgl=substr($cektgl,1,1) ; 
		if ($periksa_tgl=="-") 
		{	$tgl_angka="0". substr($cektgl,0,1) ; } 
		else 
		{	$tgl_angka = substr($cektgl,0,2) ; } 
		
		$hasiltgl=$thn . "-" . $bln_angka . "-" . $tgl_angka ;
		
		break ;
	}
	return $hasiltgl ;
}
// ------------- akhir fungsi tgl string (dd-MMM-yyyy) ke date 0000-00-00 -------------- //

// ------------- awal fungsi cek field text berisi atau tidak ------ //
function cekfieldtext($namafield)
{
	if ($namafield)
		return $namafield ;
	else
		return "-" ; 
}
// ------------- akhir fungsi cek field text berisi atau tidak ----- //

// ------------- awal fungsi cek field numerik berisi atau tidak ------ //
function cekfieldnum($namafieldnum)
{
	if ($namafieldnum)
		return $namafieldnum ;
	else
		return 0 ; 
}
// ------------- akhir fungsi cek field numerik berisi atau tidak ----- //

// ------------- awal fungsi cek field date berisi atau tidak ------ //
function cekfielddate($namafielddate)
{
	if ($namafielddate)
		return $namafielddate ;
	else
		return "0000-00-00" ; 
}
// ------------- akhir fungsi cek field date berisi atau tidak ----- //

// ------------- awal fungsi tgl date (0000-00-00) ke tgl string (dd-MMM-yyyy) -------------- //
function datekestring($cektgl)
{
	switch($cektgl)
	{
	case "0000-00-00" :
		$hasiltgl="" ;	
		break ;
	default :
		$tgl=substr($cektgl,-2,2) ; 
		$thn=substr($cektgl,0,4) ;
		$bln_angka=substr($cektgl,5,2) ;
		switch ( $bln_angka ) 
		{
			case "01" :
				$bln_nama="Jan" ;
				break ;
			case "02" :
				$bln_nama="Feb" ;
				break ;
			case "03" :
				$bln_nama="Mar" ;
				break ;
			case "04" :
				$bln_nama="Apr" ;
				break ;
			case "05" :
				$bln_nama="May" ;
				break ;
			case "06" :
				$bln_nama="Jun" ;
				break ;
			case "07" :
				$bln_nama="Jul" ;
				break ;
			case "08" :
				$bln_nama="Aug" ;
				break ;
			case "09" :
				$bln_nama="Sep" ;
				break ;
			case "10" :
				$bln_nama="Oct" ;
				break ;
			case "11" :
				$bln_nama="Nov" ;
				break ;
			case "12" :
				$bln_nama="Dec" ;
				break ;
		}	
		$hasiltgl=$tgl . "-" . $bln_nama . "-" . $thn ;
		break;
	}
	return $hasiltgl ;
}
// ------------- akhir fungsi tgl date (0000-00-00) ke tgl string (dd-MMM-yyyy) -------------- //

//---------- awal fungsi ubah format tanggal yyyy-mm-dd jadi dd-mm-yyyy ---------- //
function formattgl($param)
	{
	$tgl=substr($param,8,2) ;
	$bln=substr($param,5,2) ;
	$thn=substr($param,0,4) ;
	$hasiltgl=$tgl . "-" . $bln . "-" . $thn ;
	return $hasiltgl ;
	}
//---------- akhir fungsi ubah format tanggal yyyy-mm-dd jadi dd-mm-yyyy --------- //

//---------- awal fungsi ubah format tanggal yyyy-mm-dd jadi mm-dd-yyyy ---------- //
function formattgl2($param)
	{
	$bln=substr($param,8,2) ;
	$tgl=substr($param,5,2) ;
	$thn=substr($param,0,4) ;
	$hasiltgl=$tgl . "-" . $bln . "-" . $thn ;
	return $hasiltgl ;
	}
//---------- akhir fungsi ubah format tanggal yyyy-mm-dd jadi mm-dd-yyyy --------- //


//---------- awal fungsi ubah format tanggal dd-mm-yyyy jadi yyyy-mm-yy ---------- //
function formattglsql($param)
	{
	$tgl=substr($param,0,2) ;
	$bln=substr($param,3,2) ;
	$thn=substr($param,6,4) ;
	$hasiltgl=$thn . "-" . $bln . "-" . $tgl ;
	return $hasiltgl ;
	}
//---------- akhir fungsi ubah format tanggal dd-mm-yyyy jadi yyyy-mm-yy  --------- //

//---------- awal fungsi ubah format tanggal mm-dd-yyyy jadi yyyy-mm-dd ---------- //
function formattglsql2($param)
	{
	$bln=substr($param,0,2) ;
	$tgl=substr($param,3,2) ;
	$thn=substr($param,6,4) ;
	$hasiltgl=$thn . "-" . $bln . "-" . $tgl ;
	return $hasiltgl ;
	}
//---------- akhir fungsi ubah format tanggal mm-dd-yyyy jadi yyyy-mm-dd  --------- //

//---------- awal fungsi triple encoding ---------- //
function berantakan($param)
	{
	$var_berantakan=base64_encode(base64_encode(base64_encode($param)));
	return $var_berantakan ;
	}
//---------- akhir fungsi triple encoding --------- //


//---------- awal fungsi triple decoding ---------- //
function rapikan($param)
	{
	$var_rapikan=base64_decode(base64_decode(base64_decode($param)));
	return $var_rapikan ;
	}
//---------- akhir fungsi triple decoding --------- //

//---------- awal fungsi format angka ---------- //
function format_angka($param)
	{
	// 999.999.999.999.999
	$pnj_angka=strlen($param);
	switch ($pnj_angka)
	{
		case 15	:
			$angka=substr($param,0,3). '.' . substr($param,3,3). '.' . substr($param,6,3). '.' . substr($param,9,3). '.' . substr($param,12,3) ;  
			break;
		case 14	:
			$angka=substr($param,0,2). '.' . substr($param,2,3). '.' . substr($param,5,3). '.' . substr($param,8,3). '.' . substr($param,11,3) ;  
			break;
		case 13	:
			$angka=substr($param,0,1). '.' . substr($param,1,3). '.' . substr($param,4,3). '.' . substr($param,7,3). '.' . substr($param,10,3) ;  
			break;
		case 12	:
			$angka=substr($param,0,3). '.' . substr($param,3,3). '.' . substr($param,6,3). '.' . substr($param,9,3) ;  
			break;
		case 11	:
			$angka=substr($param,0,2). '.' . substr($param,2,3). '.' . substr($param,5,3). '.' . substr($param,8,3) ;  
			break;
		case 10	:
			$angka=substr($param,0,1). '.' . substr($param,1,3). '.' . substr($param,4,3). '.' . substr($param,7,3) ;  
			break;
		case 9	:
			$angka=substr($param,0,3). '.' . substr($param,3,3). '.' . substr($param,6,3) ;  
			break;
		case 8	:
			$angka=substr($param,0,2). '.' . substr($param,2,3). '.' . substr($param,5,3) ;  
			break;
		case 7	:
			$angka=substr($param,0,1). '.' . substr($param,1,3). '.' . substr($param,4,3) ;  
			break;
		case 6	:
			$angka=substr($param,0,3). '.' . substr($param,3,3) ;  
			break;
		case 5	:
			$angka=substr($param,0,2). '.' . substr($param,2,3) ;  
			break;
		case 4	:
			$angka=substr($param,0,1). '.' . substr($param,1,3) ;  
			break;
		case 3 	:
			$angka=$param;
			break;
		case 2	:
			$angka=$param;
			break;
		case 1	:
			$angka=$param;
	}
	return $angka ;
	}
//---------- akhir fungsi format angka --------- //

//---------- awal fungsi terbilang ---------- //
	function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = penyebut($nilai - 10). " belas";
		} else if ($nilai < 100) {
			$temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
		}     
		return $temp;
	}
 
	function terbilang($nilai) {
		if($nilai<0) {
			$hasil = "minus ". trim(penyebut($nilai));
		} else {
			$hasil = trim(penyebut($nilai));
		}     		
		return $hasil;
	}
	
//---------- akhir fungsi terbilang --------- //
?>  
