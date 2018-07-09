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

	
}