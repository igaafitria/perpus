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


	if($mod == "buku" AND $act == "simpan")
	{
		$kodeBuku = ($_POST['kodeBuku']);
		$judul = ($_POST['judul']);
		$pengarang = ($_POST['pengarang']);
		$thnTerbit = ($_POST['thnTerbit']);
		$idPenerbit = ($_POST['idPenerbit']);
		$tebalHalaman = ($_POST['tebalHalaman']);
		$idKategori = ($_POST['idKategori']);
		$jmlBuku = ($_POST['jmlBuku']);
		$stok = ($_POST['stok']);
		$keterangan = ($_POST['keterangan']);

		$koneksi->query("INSERT INTO buku(kodeBuku, judul, pengarang, thnTerbit, idPenerbit, tebalHalaman, idKategori, jmlBuku, stok, keterangan) 
			VALUES('$kodeBuku', '$judul', '$pengarang', '$thnTerbit', '$idPenerbit', '$tebalHalaman', '$idKategori', '$jmlBuku', '$stok', '$keterangan')") or die(mysqli_error($koneksi));

		echo"<script>
			window.history.go(-2);
		</script>";

	} elseif ($mod == "buku" AND $act == "edit") {
		$judul = ($_POST['judul']);
		$pengarang = ($_POST['pengarang']);
		$thnTerbit = ($_POST['thnTerbit']);
		$idPenerbit = ($_POST['idPenerbit']);
		$tebalHalaman = ($_POST['tebalHalaman']);
		$idKategori = ($_POST['idKategori']);
		$jmlBuku = ($_POST['jmlBuku']);
		$stok = ($_POST['stok']);
		$keterangan = ($_POST['keterangan']);

		$koneksi->query("UPDATE buku SET judul = '$judul', 
									penulis = '$penulis',
									thnTerbit = '$thnTerbit', 
									idPenerbit = '$idPenerbit', 
									tebalHalaman = '$tebalHalaman',  
									idKategori = '$idKategori',
									jmlBuku = '$jmlBuku', 
									stok = '$stok',
									keterangan = '$keterangan' 
					WHERE kodeBuku = '$_POST[kodeBuku]'") or die(mysqli_error());

		echo"<script>
			window.history.go(-2);
		</script>";

	} elseif ($mod == "buku" AND $act == "hapus") {
		$koneksi->query("DELETE FROM buku WHERE kodeBuku = '$_GET[id]'") or die(mysqli_error());

		echo"<script>
			window.history.back();
		</script>";
	}
?>c