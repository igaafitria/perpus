<?php
	session_start();
	include"../lib/koneksi.php";


	if (isset($_POST['submit'])) {
		$usernm = isset($_POST['usernm']) ? $_POST['usernm'] : '';
		$pass = isset($_POST['passwrd']) ? $_POST['passwrd'] : '';


		$ceklogin = $koneksi->query("SELECT * FROM admin 
								WHERE usernm = '$usernm' AND passwrd = '$pass'") or die(mysql_error());

		$temukan = mysqli_num_rows($ceklogin);

		if ($temukan > 0) {
			$a = mysqli_fetch_assoc($ceklogin);
			$_SESSION['username'] = $a['usernm'];
			$_SESSION['nama'] = $a['nama'];

			header("location:halaman.php?mod=utama");


		} else {
			echo"<script>
				alert('Gagal login');
				window.location.href='login.php';
			</script>";
		}

	} else {
		header("location:login.php");
	}

?>