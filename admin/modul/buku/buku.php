<?php
	if(!isset($_SESSION['username'])){
		header('location: login.php'); // Mengarahkan ke Home Page
	}

	//link buat paging
	$linkaksi = 'halaman.php?mod=buku';

	if(isset($_GET['act']))
	{
		$act = $_GET['act'];
		$linkaksi .= '&act='.$act;
	}
	else
	{
		$act = '';
	}

	$aksi = 'modul/buku/aksi_buku.php';

	switch ($act) {
		case 'form':
			if(!empty($_GET['id']))
			{
				$act = "$aksi?mod=buku&act=edit";
				$query = $koneksi->query("SELECT * FROM buku WHERE kodeBuku = '$_GET[id]'");
				$temukan = mysqli_num_rows($query);
				if($temukan > 0)
				{
					$c = mysqli_fetch_assoc($query);
				}
				else
				{
					header("location:halaman.php?mod=buku");
				}

			}
			else
			{
				$act = "$aksi?mod=buku&act=simpan";
			}

			echo"<div class='formstyle'>
			<form action='$act' method='POST'>
				<input type='hidden' name='kodeBuku' value='";?><?php echo isset($c['kodeBuku']) ? $c['kodeBuku'] : ''; ?><?php echo"'>
				<p>
					<label>KODE BUKU</label>
					: <input type='text' name='kodebuku' placeholder='kodebuku...' value='";?><?php echo isset($c['judul']) ? $c['judul'] : ''; ?><?php echo"' size='40' >
				</p>				<p>
					<label>JUDUL</label>
					: <input type='text' name='judul' placeholder='judul...' value='";?><?php echo isset($c['judul']) ? $c['judul'] : ''; ?><?php echo"' size='40' >
				</p>
				<p>
					<label>PENGARANG</label>
					: <input type='text' name='pengarang' placeholder='pengarang...' value='";?><?php echo isset($c['pengarang']) ? $c['pengarang'] : ''; ?><?php echo"' size='40' >
				</p>
				<p>
					<label>THN. TERBIT</label>
					: <input type='text' name='tglTerbit' id='thn' placeholder='tahun...' value='";?><?php echo isset($c['thnTerbit']) ? $c['thnTerbit'] : ''; ?><?php echo"' >
				</p>
				<p>
					<label>PENERBIT</label>
					: <select name='idPenerbit'>
						<option value=''>- Pilih Penerbit -</option>";
						$penerbit = $koneksi->query("SELECT * FROM buku_penerbit ORDER BY idPenerbit ASC");
						while($p = mysqli_fetch_assoc($penerbit)) {
							if($c['idPenerbit'] == $p['idPenerbit']) {
								echo"<option value='$p[idPenerbit]' selected>$p[namaPenerbit]</option>";
							} else {
								echo"<option value='$p[idPenerbit]'>$p[namaPenerbit]</option>";
							}
						}

					echo"</select>
				</p>
				<p>
					<label>TEBAL HALAMAN</label>
					: <input type='text' name='tebalHalaman' placeholder='tebal...' value='";?><?php echo isset($c['tebalHalaman']) ? $c['tebalHalaman'] : ''; ?><?php echo"' >
				</p>
				<p>
					<label>KATEGORI</label>
					: <select name='idKategori'>
						<option value=''>- Pilih Kategori -</option>";
						$kategori = $koneksi->query("SELECT * FROM buku_kategori ORDER BY idKategori ASC");
						while($p = mysqli_fetch_assoc($kategori)) {
							if($c['idKategori'] == $p['idKategori']) {
								echo"<option value='$p[idKategori]' selected>$p[namaKategori]</option>";
							} else {
								echo"<option value='$p[idKategori]'>$p[namaKategori]</option>";
							}
						}

					echo"</select>
				</p>
				<p>
					<label>JUMLAH BUKU</label>
					: <input type='text' name='jmlBuku' placeholder='0' value='";?><?php echo isset($c['jmlBuku']) ? $c['jmlBuku'] : ''; ?><?php echo"' >
				</p>
				<p>
					<label>STOK BUKU</label>
					: <input type='text' name='stok' placeholder='0' value='";?><?php echo isset($c['stok']) ? $c['stok'] : ''; ?><?php echo"' >
				</p>
				<p>
					<label>KETERANGAN</label>
					: <textarea name='keterangan' cols='80' rows='4'>";?><?php echo isset($c['keterangan']) ? $c['keterangan'] : ''; ?><?php echo"</textarea>
				</p>
				<p>
					<label>&nbsp;</label>
					&nbsp; <input type='submit' name='submit' value='Simpan'>
				</p>
			</form>
			</div>";
			?>
			<script type="text/javascript">
				$(document).ready(function() {
					$("#tgl").datepicker({
						showOn:"button",
						buttonImage:"../images/calendar.gif",
						buttonImageOnly : true,
						dateFormat : "yy-mm-dd",
						changeMonth:true,
						changeYear:true,
						showAnim : "fold"
					});
				});
			</script>

			<?php
			break;
		
		default:
		
			echo"<h3>DATA BUKU</h3>";

			echo"<table width='100%'>
				<tr>
					<td width='50%'><a href='halaman.php?mod=buku&act=form'>TAMBAH BUKU</a> | 
					<a href='halaman.php?mod=buku'>REFRESH</a> | 
					</td>
					<td width='50%'>
						<form action='' method='GET'>
							<input type='hidden' name='mod' value='buku'>
							Cari : <select name='field'>
								<option value='judul'>- Pilih -</option>
								<option value='judul'>Judul</option>
								<option value='pengarang'>pengarang</option>
							</select>
							<input type='text' name='cari' placeholder='ketik keyword ...'>
							<input type='submit' name='submit' value='Cari'>
						</form>
					</td>
				</tr>
			</table>";

			echo"<table class='gridtable' width='100%'>
				<thead>
				<tr>
					<th>NO</th>
					<th>KODE</th>
					<th>JUDUL</th>
					<th>PENGARANG</th>
					<th>THN. TERBIT</th>
					<th>PENERBIT</th>
					<th>TEBAL HLM.</th>
					<th>KATEGORI</th>
					<th>JML. BUKU</th>
					<th>STOK</th>
					<th>AKSI</th>
				</tr>
				</thead>
				<tbody>";
				$p      = new Paging;
				$batas  = 10;
			    if(isset($_GET['show']) && is_numeric($_GET['show']))
				{
					$batas = (int)$_GET['show'];
					$linkaksi .="&show=$_GET[show]";
				}

				$posisi = $p->cariPosisi($batas);
				$query = "SELECT a.*, b.namaKategori, c.namaPenerbit 
						FROM buku a LEFT JOIN buku_kategori b ON (a.idKategori = b.idKategori) 
						LEFT JOIN buku_penerbit c ON (a.idPenerbit = c.idPenerbit) ";

				$q 	= "SELECT * FROM buku ";

				if(!empty($_GET['field']))
				{
					$hideinp = "<input type='hidden' name='field' value='$_GET[field]'>
								<input type='hidden' name='cari' value='$_GET[cari]'>";

					$linkaksi = "&field=$_GET[field]&cari=$_GET[cari]";

					$query .= " WHERE $_GET[field] LIKE '%$_GET[cari]%'";
					$q .= " WHERE $_GET[field] LIKE '%$_GET[cari]%'";
				}

				$query .= " LIMIT $posisi, $batas";
				$q 	.= " ";
				

				$sql_kul = $koneksi->query($query);
				$fd_kul = mysqli_num_rows($sql_kul);

				if($fd_kul > 0)
				{
					$no = $posisi + 1;
					while ($m = mysqli_fetch_assoc($sql_kul)) {
						echo"<tr>
							<td>$no</td>
							<td>$m[kodeBuku]</td>
							<td>$m[judul]</td>
							<td>$m[pengarang]</td>
							<td>$m[thnTerbit]</td>
							<td>$m[namaPenerbit]</td>
							<td>$m[tebalHalaman]</td>
							<td>$m[namaKategori]</td>
							<td>$m[jmlBuku]</td>
							<td>$m[stok]</td>
							<td><a href='halaman.php?mod=buku&act=form&id=$m[kodeBuku]'>EDIT</i></a> | 
							<a href='$aksi?mod=buku&act=hapus&id=$m[kodeBuku]' onclick=\"return confirm('Yakin hapus data');\">HAPUS</a></td>
						
						</tr>";
						$no++;
					}
	

					$jmldata = mysqli_num_rows($koneksi->query($q));

					$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
		    		$linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman, $linkaksi);
				}
				else
				{
					echo"<tr>
						<td colspan='13'><div class='w3-center'><i>Penerbit Not Found.</i></div></td>
					</tr>";
				}

				echo"</tbody>
			</table>";


			echo"<div id='foot'>
				<div id='foot-left'>
					<form class='w3-tiny' action='' method='GET'>
						<input type='hidden' name='mod' value='buku'>";
						if(!empty($hideinp))
						{
							echo $hideinp;
						}
						echo"<select class='w3-select w3-border' name='show' onchange='submit()'>
							<option value=''>- Show -</option>";
							$i=10;
							while($i <= 100)
							{
								if(isset($_GET['show']) AND (int)$_GET['show'] == $i)
								{
									echo"<option value='$i' selected>$i</option>";	
								}
								else
								{
									echo"<option value='$i'>$i</option>";
								}

								$i+=10;
							}
						echo"</select>
					</form>
				</div>
				<div id='foot-right'>
					<div class='paging'>
					<ul>
						$linkHalaman
					</ul>
					</div>
				</div>

				<div style=\"clear:both;\"></div>
			</div>";
			break;
	}

?>