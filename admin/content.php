<?php
	include"../lib/koneksi.php";
	include"../lib/paging.class.php";
	include"../lib/all_function.php";
	include"../lib/fungsi_transaction.php";


	if ($_GET['mod'] == 'utama') {
		include"utama.php";
	} elseif ($_GET['mod'] == 'kategori') {
		include"modul/kategori/kategori.php";
	} 




?>