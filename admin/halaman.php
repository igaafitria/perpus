<?php
date_default_timezone_set('Asia/Jakarta');

session_start();
if (!isset($_SESSION['username']) OR empty($_SESSION['username'])) {
	header("location:login.php");
}
include"../lib/fungsi_indotgl.php";

?>
<!DOCTYPE html>
<html>
<head>
	<title>Administrator Perpustakaan AIE</title>

	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="paging.css">
	<link rel="stylesheet" type="text/css" href="../js/jquery-ui/jquery-ui.css">


	<script type="text/javascript" src="../js/jquery/1.12.4/jquery.min.js"></script>
	<script type="text/javascript" src="../js/jquery-ui/jquery-ui.min.js"></script>
</head>
<body>
	<div id="wrapper">
		<div id="header">
			<p><center>SISTEM INFORMASI PERPUSTAKAAN AIE</center></p>
			
		</div>
		<div id="content">
				<ul class="menu">
				  <li class="dropdown">
				    <a href="" class="dropbtn">MENU UTAMA</a>
				    <div class="dropdown-content">
				      <a href="?mod=utama">HALAMAN UTAMA</a>
				      <a href="?mod=kategori">KATEGORI BUKU</a>
				      <a href="?mod=penerbit">PENERBIT</a>
				      <a href="?mod=buku">DATA BUKU</a>
				      <a href="?mod=stafflaporan">DATA LAPORAN STAFF</a>
				      <a href="?mod=anggota">DATA ANGGOTA</a>
					  <a href="?mod=gallery">GALLERY</a>
				    </div>
				  </li>
				  <li class="dropdown">
				  	<a href="" class="dropbtn">MENU TRANSAKSI</a>
				  	<div class="dropdown-content">
				  		<a href="?mod=peminjaman&act=form">PINJAM/PERPANJANGAN & KEMBALI BUKU</a>
						<a href="?mod=peminjaman">DATA SEMUA PEMINJAMAN BUKU </a>
				  	</div>
				  </li>
				  <li class="dropdown">
				    <a href="javascript:void(0)" class="dropbtn">MENU LAPORAN</a>
				    <div class="dropdown-content">
				      <a href="?mod=laporan&act=peminjaman">LAPORAN PEMINJAMAN BUKU</a>
				      <a href="?mod=laporan&act=peminjamanalli">LAPORAN SEMUA PEMINJAMAN BUKU</a>
				      <a href="?mod=laporan&act=pengembalian">LAPORAN PENGEMBALIAN BUKU</a>
				      <a href="?mod=laporan&act=buku">LAPORAN BUKU </a>
				      <a href="?mod=laporan&act=koleksi">LAPORAN KOLEKSI BUKU</a>
				    </div>
				  </li>
				</ul>
			</div>

			<div id="content-right">
				<div id="menu-user">
					Selamat Datang, <b><?php echo @$_SESSION['nama']; ?></b> | Tanggal : <?php echo tglindo(date('Y-m-d')).', Jam : '.date('H:i:s'); ?> | <a href="../index.php" target="_blank">Lihat Website</a> | 
					<a href="logout.php">Keluar</a>
				</div>

				<?php include"content.php"; ?>
			</div>
				

			<div style="clear: both;"></div>
		</div>
		<div id="footer">
			<p>Copyright &copy; 2018. Perpustakaan AIE</p>
		</div>

	</div>


</body>
</html>