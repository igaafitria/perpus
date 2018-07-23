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


	if($mod == "penerbit" AND $act == "simpan")
	{
		$namaPenerbit = anti_inject($_POST['namaPenerbit']);

		$koneksi->query("INSERT INTO buku_penerbit(namaPenerbit) VALUES('$namaPenerbit')") or die(mysqli_error($koneksi));

		echo"<script>
			window.history.go(-2);
		</script>";

	} elseif ($mod == "penerbit" AND $act == "edit") {
		$namaPenerbit = anti_inject($_POST['namaPenerbit']);

		$koneksi->query("UPDATE buku_penerbit SET namaPenerbit = '$namaPenerbit' 
					WHERE idPenerbit = '$_POST[idPenerbit]'") or die(mysql_error());

		echo"<script>
			window.history.go(-2);
		</script>";

	} elseif ($mod == "penerbit" AND $act == "hapus") {
		$koneksi->query("DELETE FROM buku_penerbit WHERE idPenerbit = '$_GET[id]'") or die(mysql_error());

		echo"<script>
			window.history.back();
		</script>";
	}

?>