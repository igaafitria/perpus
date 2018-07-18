<?php
// class paging untuk halaman administrator
class Paging {
	// Fungsi untuk mencek halaman dan posisi data
	function cariPosisi($batas){
		if(empty($_GET['halaman']))
		{
			$posisi=0;
			$_GET['halaman']=1;
		}
		else
		{
			$posisi = ($_GET['halaman']-1) * $batas;
		}
			return $posisi;
	}
// Fungsi untuk menghitung total halaman
	function jumlahHalaman($jmldata, $batas){
		$jmlhalaman = ceil($jmldata/$batas);
		return $jmlhalaman;
	}

	// Fungsi untuk link halaman 1,2,3 (untuk admin)
	function navHalaman($halaman_aktif, $jmlhalaman, $link){
		$link_halaman = "";

		// Link ke halaman pertama (first) dan sebelumnya (prev)
		if($halaman_aktif > 1){
			$prev = $halaman_aktif-1;
			$link_halaman .= "<a href=$link&halaman=1>&laquo; First</a>
                    <a href=$link&halaman=$prev>&lsaquo; Prev</a> ";
		}
		else
		{ 
			$link_halaman .= "&laquo; First &lsaquo; Prev ";
		}

		// Link halaman 1,2,3, ...
		$angka = ($halaman_aktif > 3 ? " ... " : " "); 
		for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  			if ($i < 1) {
  				continue;
  			}
			$angka .= "<a href=$link&halaman=$i>$i</a> ";
  		}
		$angka .= " <b>$halaman_aktif</b> ";
  
    	for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
  	  		if($i > $jmlhalaman) {
    	  		break;
  	  		}
	  		$angka .= "<a href=$link&halaman=$i>$i</a> ";
    	}
	  	$angka .= ($halaman_aktif+2<$jmlhalaman ? " ... <a href=$link&halaman=$jmlhalaman>$jmlhalaman</a> " : " ");

		$link_halaman .= "$angka";

		// Link ke halaman berikutnya (Next) dan terakhir (Last) 
		if($halaman_aktif < $jmlhalaman){
			$next = $halaman_aktif+1;
			$link_halaman .= " <a href=$link&halaman=$next>Next &rsaquo;</a> 
                     <a href=$link&halaman=$jmlhalaman>Last &raquo;</a> ";
		}
		else
		{
			$link_halaman .= " Next &rsaquo; Last &raquo;";
		}

		return $link_halaman;
	}
}
