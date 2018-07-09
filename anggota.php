<div id="new_item">
		<div id="new_item_header">
			<h1>Data Anggota Perpustakaan</h1>
			<h2>&nbsp;</h2>
		</div>

		<form action="" method="GET">
				<input type="hidden" name="mod" value="anggota">
				<table>
					<tr>
						<td>Cari Anggota :</td>
						<td>
							<select name="opsi">
								<option value='nama'>- Berdasarkan -</option>
								<option value='nama'>Nama</option>
								<option value='alamat'>Alamat</option>
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

			if(isset($_GET['submit'])) {
				echo"Pencarian Anggota : <b>".@$_GET['keyword']." ...</b>";
			}
				

				//link buat paging
				$linkaksi = 'halaman.php?mod=anggota';

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
					<th>NO. ANGGOTA</th>
					<th>NAMA</th>
					<th>TEMPAT, TGL. LAHIR</th>
					<th>ALAMAT</th>
					<th>NOMOR HP</th>
					<th>THN. DAFTAR</th>
				</tr>
				</thead>
				<tbody>";

				$p      = new Paging;
				$batas  = 10;

				$posisi = $p->cariPosisi($batas);
				$query = "SELECT * FROM anggota ";

				$q 	= "SELECT * FROM anggota ";

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
							<td>$m[noAnggota]</td>
							<td>$m[nama]</td>
							<td>$m[tmpLahir], ". tglindo($m['tglLahir'])."</td>
							<td>$m[alamat]</td>
							<td>$m[noHp]</td>
							<td>$m[thnDaftar]</td>
						
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
						<td colspan='7'><div class='w3-center'><i>Anggota Not Found.</i></div></td>
					</tr>";
				}

					echo"<tr>
						<td colspan='7'>"; ?><?php echo isset($linkHalaman) ? $linkHalaman : ''; ?><?php echo"</td>
					</tr>

					</tbody>
				</table>";
			

			?>
		

		<div class="clearthis">&nbsp;</div>
	</div>