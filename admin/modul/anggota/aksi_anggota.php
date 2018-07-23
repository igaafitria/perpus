<?php
	session_start();
	include"../../../lib/koneksi.php";
	include"../../../lib/all_function.php";


	if(!isset($_SESSION['username'])){
		header('location: ../../login.php'); // Mengarahkan ke Home Page
	}

	if(isset($_GET['mod']) && isset($_GET['act']))
	{
		$mod = $_GET['mod'];
		$act = $_GET['act'];
	}
	else
	{
		$mod = "";
		$act = "";
	}


	if($mod == "anggota" AND $act == "simpan")
	{
		$noAnggota = ($_POST['noanggota']);
		$nama = ($_POST['nama']);
		$tmpLahir = ($_POST['tmpLahir']);
		$tglLahir = ($_POST['tglLahir']);
		$alamat = ($_POST['alamat']);
		$noHp = ($_POST['noHp']);
		$thnDaftar = date('Y');

		$koneksi->query("INSERT INTO anggota(noAnggota, nama, tmpLahir, tglLahir, alamat, noHp, thnDaftar, jmlpinjam) 
					VALUES('$noAnggota', '$nama', '$tmpLahir', '$tglLahir', '$alamat', '$noHp', '$thnDaftar', 2)") or die(mysqli_error($koneksi));

		echo"<script>
			window.history.go(-2);
		</script>";

	} elseif ($mod == "anggota" AND $act == "edit") {
		$nama = ($_POST['nama']);
		$tmpLahir = ($_POST['tmpLahir']);
		$tglLahir = ($_POST['tglLahir']);
		$alamat = ($_POST['alamat']);
		$noHp = ($_POST['noHp']);

		$koneksi->query("UPDATE anggota SET nama = '$nama', 
										tmpLahir = '$tmpLahir', 
										tglLahir = '$tgilLahir', 
										alamat = '$alamat', 
										noHp = '$noHp'
					WHERE noAnggota = '$_POST[noAnggota]'") or die(mysqli_error());

		echo"<script>
			window.history.go(-2);
		</script>";

	} elseif ($mod == "anggota" AND $act == "hapus") {
		$koneksi->query("DELETE FROM anggota WHERE noAnggota = '$_GET[id]'") or die(mysqli_error());

		echo"<script>
			window.history.back();
		</script>";
	}


?>