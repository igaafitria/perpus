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


	if($mod == "stafflaporan" AND $act == "simpan")
	{
		$judulLaporan = anti_inject($_POST['judulLaporan']);
		$penyusun = anti_inject($_POST['penyusun']);
		$thnPembuatan = anti_inject($_POST['thnPembuatan']);
		$idPenerbit = anti_inject($_POST['idPenerbit']);
		$noInduk = anti_inject($_POST['noInduk']);
		$noKelas = anti_inject($_POST['noKelas']);
		$tglTerima = $_POST['tglTerima'];
		$lemari = anti_inject($_POST['lemari']);
		$rak = anti_inject($_POST['rak']);
		$kegiatan = anti_inject($_POST['kegiatan']);
		$jumlah = anti_inject($_POST['jumlah']);
		$deskripsi = anti_inject($_POST['deskripsi']);

		$koneksi->query("INSERT INTO staff_laporan(judulLaporan, 
												penyusun, 
												thnPembuatan, 
												idPenerbit, 
												noInduk, 
												noKelas, 
												tglTerima, 
												lemari, 
												rak, 
												kegiatan, 
												jumlah, 
												deskripsi) 
										VALUES('$judulLaporan', 
												'$penyusun', 
												'$thnPembuatan', 
												'$idPenerbit', 
												'$noInduk', 
												'$noKelas', 
												'$tglTerima', 
												'$lemari', 
												'$rak', 
												'$kegiatan', 
												'$jumlah', 
												'$deskripsi')") or die(mysqli_error());

		echo"<script>
			window.history.go(-2);
		</script>";

	} elseif ($mod == "stafflaporan" AND $act == "edit") {
		$judulLaporan = anti_inject($_POST['judulLaporan']);
		$penyusun = anti_inject($_POST['penyusun']);
		$thnPembuatan = anti_inject($_POST['thnPembuatan']);
		$idPenerbit = anti_inject($_POST['idPenerbit']);
		$noInduk = anti_inject($_POST['noInduk']);
		$noKelas = anti_inject($_POST['noKelas']);
		$tglTerima = $_POST['tglTerima'];
		$lemari = anti_inject($_POST['lemari']);
		$rak = anti_inject($_POST['rak']);
		$kegiatan = anti_inject($_POST['kegiatan']);
		$jumlah = anti_inject($_POST['jumlah']);
		$deskripsi = anti_inject($_POST['deskripsi']);

		$koneksi->query("UPDATE staff_laporan SET judulLaporan = '$judulLaporan', 
												penyusun = '$penyusun', 
												thnPembuatan = '$thnPembuatan', 
												idPenerbit = '$idPenerbit', 
												noInduk = '$noInduk', 
												noKelas = '$noKelas', 
												tglTerima = '$tglTerima', 
												lemari = '$lemari', 
												rak = '$rak', 
												kegiatan = '$kegiatan', 
												jumlah = '$jumlah', 
												deskripsi = '$deskripsi' 
					WHERE idLaporan = '$_POST[idLaporan]'") or die(mysql_error());

		echo"<script>
			window.history.go(-2);
		</script>";

	} elseif ($mod == "stafflaporan" AND $act == "hapus") {
		$koneksi->query("DELETE FROM staff_laporan WHERE idLaporan = '$_GET[id]'") or die(mysql_error());

		echo"<script>
			window.history.back();
		</script>";
	}

?>