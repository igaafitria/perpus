<div id="new_item">
		<div id="new_item_header">
			<h1>Pencarian Buku</h1>
			<h2>&nbsp;</h2>
		</div>

			<form action="" method="GET">
				<input type="hidden" name="mod" value="pencarian">
				<table>
					<tr>
						<td>Cari Buku :</td>
						<td>
							<select name="opsi">
								<option value='judul'>- Berdasarkan -</option>
								<option value='judul'>Judul</option>
								<option value='penulis'>Penulis</option>
							</select>
						</td>
						<td><input type="text" name="keyword" placeholder="ketik keyword ..."></td>
						<td><input type="submit" name="submit" value="Cari"></td>
					</tr>
				</table>
			</form>


			<?php
			include"lib/koneksi.php";
			include"lib/paging.class.php";
			include"lib/all_function.php";
			include"lib/fungsi_indotgl.php";

			if (isset($_GET['submit'])) {
				echo"Pencarian Buku dengan keyword : <b>".$_GET['keyword']." ...</b>";

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

				echo"<table class='gridtable' width='100%'>
				<thead>
				<tr>
					<th>NO</th>
					<th>KODE</th>
					<th>JUDUL</th>
					<th>PENULIS</th>
					<th>KATEGORI</th>
					<th>STOK</th>
					<th>DETAIL</th>
				</tr>
				</thead>
				<tbody>";

				$p      = new Paging;
				$batas  = 10;

				$posisi = $p->cariPosisi($batas);
				$query = "SELECT a.*, b.namaKategori, c.namaPenerbit 
						FROM buku a LEFT JOIN buku_kategori b ON (a.idKategori = b.idKategori) 
						LEFT JOIN buku_penerbit c ON (a.idPenerbit = c.idPenerbit) ";

				$q 	= "SELECT * FROM buku ";

				$opsi = @$_GET['opsi'];
				if (!empty($opsi)) {
					$field = $opsi;

					$linkaksi .= "&opsi=$_GET[opsi]&keyword=$_GET[keyword]&submit=Cari";

					$query .= " WHERE $field LIKE '%$_GET[keyword]%'";
					$q .= " WHERE $field LIKE '%$_GET[keyword]%'";
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
							<td>$m[penulis]</td>
							<td>$m[namaKategori]</td>
							<td>$m[stok]</td>
							<td><a href='?mod=detailbuku&id=$m[kodeBuku]'>Detail Buku</a></td>
						</tr>";
						$no++;
					}
	

					$jmldata = mysqli_num_rows(mysql_query($q));

					$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
		    		$linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman, $linkaksi);
				}
				else
				{
					echo"<tr>
						<td colspan='7'><div class='w3-center'><i>Pencarian Not Found.</i></div></td>
					</tr>";
				}

					echo"<tr>
						<td colspan='7'>"; ?><?php echo isset($linkHalaman) ? $linkHalaman : ''; ?><?php echo"</td>
					</tr>

					</tbody>
				</table>";
			} else {
				echo"<p>Silahkan lakukan pencarian ....</p>";
			}

			?>
		

		<div class="clearthis">&nbsp;</div>
	</div>