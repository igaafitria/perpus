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


	if($mod == "kategori" AND $act == "simpan")
	{
		$idKategori = anti_inject($_POST['idKategori']);
		$namaKategori = anti_inject($_POST['namaKategori']);

		$koneksi->query("INSERT INTO buku_kategori(idKategori, namaKategori) VALUES('$idKategori', '$namaKategori')") or die(mysql_error());

		echo"<script>
			window.history.go(-2);
		</script>";

	} elseif ($mod == "kategori" AND $act == "edit") {
		$namaKategori = anti_inject($_POST['namaKategori']);
		$koneksi->query("UPDATE buku_kategori SET namaKategori = '$namaKategori'  
					WHERE idKategori = '$_POST[idKategori]'") or die(mysql_error());

		echo"<script>
			window.history.go(-2);
		</script>";

	} elseif ($mod == "kategori" AND $act == "hapus") {
		$koneksi->query("DELETE FROM buku_kategori WHERE idKategori = '$_GET[id]'") or die(mysql_error());

		echo"<script>
			window.history.back();
		</script>";
	}

?>