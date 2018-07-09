<div id="new_item">
<?php
	include"lib/koneksi.php";
	include"lib/all_function.php";
	include"lib/fungsi_indotgl.php";

	$buku = $koneksi->query("SELECT a.*, b.namaKategori, c.namaPenerbit FROM buku a 
			LEFT JOIN buku_kategori b ON a.idKategori = b.idKategori 
			LEFT JOIN buku_penerbit c ON a.idPenerbit = c.idPenerbit WHERE a.kodeBuku = '$_GET[id]'");
	$temukan = mysqli_num_rows($buku);

	if ($temukan > 0) {
		$b = mysqli_fetch_assoc($buku);
	
	
?>

		<div id="new_item_header">
			<h1><?php echo $b['judul']; ?></h1>
			<h2>&nbsp;</h2>
		</div>

		<div id="new_item_image"><img src="images/pen.jpg" alt="" /></div>

		<div id="new_item_text">
			<p>Penulis : <b><?php echo $b['penulis']; ?></b><br>
			Kategori : <?php echo $b['namaKategori']; ?><br>
			Penerbit : <?php echo $b['namaPenerbit']; ?><br></p>
			<p><?php echo nl2br($b['sinopsis']); ?></p>

			<p><b>Keterangan :</b><br>
			<?php echo nl2br($b['sinopsis']); ?></p>
		</div>

		<div class="clearthis">&nbsp;</div>
	</div>

<?php } else {
	header("location:halaman.php?mod=home"); 
}

?>