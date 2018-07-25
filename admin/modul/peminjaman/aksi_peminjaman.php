<?php
	session_start();
	include"../../../lib/koneksi.php";
	include"../../../lib/all_function.php";
	include"../../../lib/fungsi_transaction.php";


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


	if($mod == "peminjaman" AND $act == "addpinjam")
	{
		$dt = date('Y-m-d');
		$noPeminjaman =($_POST['noPeminjaman']);
		$kodeBuku = ($_POST['kodeBuku']);

		$newdate1week = strtotime('+1 week', strtotime($dt));
		$newdate = date ('Y-m-d' , $newdate1week);

		//echo $newdate;exit;
		//
		//cek sisa buku
		$cekbuku = $koneksi->query("SELECT SUM(stok) AS jml FROM buku WHERE kodeBuku = '$kodeBuku'");
		$bo = mysqli_fetch_assoc($cekbuku);

		if ($bo['jml'] > 0) {
			//cek sisa peminjaman
			$ceksisa = $koneksi->query("SELECT SUM(jmlpinjam) AS jmlp FROM anggota WHERE noAnggota = '$_POST[noAnggota]'");
			$po = mysqli_fetch_assoc($ceksisa);

			if ($po['jmlp'] > 0) {

				$koneksi->query("INSERT INTO peminjaman(noPeminjaman, kodeBuku, noAnggota, tglPinjam, tglKembali, stsPinjam) 
						VALUES('$noPeminjaman', '$kodeBuku', '$_POST[noAnggota]', '$dt', '$newdate', '1')") or die(mysqli_error($koneksi));	

				echo"<script>
					window.history.back();
				</script>";
			} else {
				echo"<script>
					alert('Batas Peminjaman Anda Sudah Habis!');
					window.history.back();
				</script>";
			}

				
		} else {
			echo"<script>
				alert('Stok Buku kosong!');
				window.history.back();
			</script>";
		}

		
	} elseif ($mod == "peminjaman" AND $act == "kembali") {
		$noPeminjaman = ($_POST['noPeminjaman']);
		$ket = ($_POST['ket']);
		$dt = date('Y-m-d');

		start_transaction();

		$koneksi->query("INSERT INTO pengembalian(noPeminjaman, tglKembalib, lamaPinjam, terLambat, denda, dendaRusak, keterangan, stsBuku) 
					VALUES('$noPeminjaman', '$dt', '$_POST[lama]', '$_POST[terlambat]', '$_POST[denda]', '$_POST[dendarusak]', '$ket', '$_POST[stsbuku]')") or die(mysqli_error($koneksi));

		//jika buku tidak hilang update stok buku
		if ($_POST['stsbuku'] <> 3) {
			$koneksi->query("UPDATE buku SET stok = stok + 1 WHERE kodeBuku = '$_POST[kodeBuku]'");
		}

		$koneksi->query("UPDATE peminjaman SET stsPinjam = 2 WHERE noPeminjaman = '$noPeminjaman'");
		$koneksi->query("UPDATE anggota SET jmlpinjam = jmlpinjam + 1 WHERE noAnggota = '$_POST[noAnggota]'");

		commit();

		echo"<script>
			alert('Berhasil menyimpan pengembalian buku');
			window.history.go(-2);
		</script>";
			

	} elseif ($mod == "peminjaman" AND $act == "hapus") {
		$koneksi->query("DELETE FROM peminjaman WHERE noPeminjaman = '$_GET[id]'") or die(mysqli_error($koneksi));

		echo"<script>
			window.history.back();
		</script>";
	}

?>