<?php
	
	$mod = @$_GET['mod'];

	if ($mod == 'home') {
		include"home.php";
	} elseif ($mod == 'profile') {
		include"profil.php";
	} elseif ($mod == 'pencarian') {
		include"pencarian.php";
	} elseif ($mod == 'peraturan') {
		include"peraturan.php";
	} elseif ($mod == 'anggota') {
		include"anggota.php";
	} elseif ($mod == 'detailbuku') {
		include"detailbuku.php";
	}


?>