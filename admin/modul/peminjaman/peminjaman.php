<?php
	if(!isset($_SESSION['username'])){
		header('location: login.php'); // Mengarahkan ke Home Page
	}

	//link buat paging
	$linkaksi = 'halaman.php?mod=peminjaman';

	if(isset($_GET['act']))
	{
		$act = $_GET['act'];
		$linkaksi .= '&act='.$act;
	}
	else
	{
		$act = '';
	}

	$aksi = 'modul/peminjaman/aksi_peminjaman.php';

	switch ($act) {
		case 'form' :
			echo"<div class='formstyle'>
			<form action='halaman.php' method='GET'>
				<input type='hidden' name='mod' value='peminjaman'>
				<input type='hidden' name='act' value='addpinjam'>
				<p>
					<label>NOMOR ANGGOTA</label>
					: <input type='text' name='no' placeholder='Ketik Nomor Anggota...'>
				</p>
				<p>
					<label>&nbsp;</label>
					&nbsp; <input type='submit' name='submit' value='Cari'>
				</p>
			</form>
			</div>";

			break;

		case 'addpinjam':
			$no = ($_GET['no']);

			$cek = $koneksi->query("SELECT * FROM anggota WHERE noAnggota = '$no'");
			$temukan = mysqli_num_rows($cek);

			if ($temukan > 0) {
				$a = mysqli_fetch_assoc($cek);

				echo"<div class='formstyle'>
					<p>
						<label>NOMOR ANGGOTA</label>
						: <b>$a[noAnggota]</b>
					</p>
					<p>
						<label>NAMA ANGGOTA</label>
						: $a[nama]
					</p>
					<p>
						<label>TEMPAT, TANGGAL LAHIR</label>
						: $a[tmpLahir], ".tglindo($a['tglLahir'])."
					</p>
					<p>
						<label>ALAMAT</label>
						: $a[alamat]
					</p>
					<p>
						<label>NOMOR HP</label>
						: $a[noHp]
					</p>
					<p>
						<label>SISA BOLEH PINJAM</label>
						: $a[jmlpinjam] BUKU
					</p>
				</div>";

				echo"<h4>DATA PEMINJAMAN</h4>";

				echo"<div class='formstyle'>
					<form action='$aksi?mod=peminjaman&act=addpinjam' method='POST'>
						<input type='hidden' name='noAnggota' value='";?><?php echo isset($a['noAnggota']) ? $a['noAnggota'] : ''; ?><?php echo"'>
						<p>
							<label>KODE BUKU</label>
							: <input type='text' name='kodeBuku' placeholder='Ketik Kode Buku...'> 
						</p>
						<p>
							<label>&nbsp;</label>
							&nbsp; <button type='submit' name='submit' value='Simpan'>Tambah Peminjaman</button>
						</p>
					</form>
				</div>";

				echo"<table class='gridtable'>
					<thead>
					<tr>
						<th>NO</th>
						<th>NO. PEMINJAMAN</th>
						<th>KODE BUKU</th>
						<th>JUDUL</th>
						<th>TGL. PEMINJAMAN</th>
						<th>TGL. PENGEMBALIAN</th>
						<th>AKSI</th>
					</tr>
					</thead>
					<tbody>";
					$sql = $koneksi->query("SELECT a.*, b.judul FROM peminjaman a 
										LEFT JOIN buku b ON a.kodeBuku = b.kodeBuku 
										WHERE a.noAnggota = '$a[noAnggota]' AND stsPinjam = 1");
					$temukan = mysqli_num_rows($sql);

					if ($temukan > 0) {
						$no = 1;
						while ($b = mysqli_fetch_assoc($sql)) {
							echo"<tr>
								<td>$no</td>
								<td>$b[noPeminjaman]</td>
								<td>$b[kodeBuku]</td>
								<td>$b[judul]</td>
								<td>".tglindo($b['tglPinjam'])."</td>
								<td>".tglindo($b['tglKembali'])."</td>
								<td><a href='$aksi?mod=peminjaman&act=hapus&id=$b[noPeminjaman]' onclick=\"return confirm('Yakin hapus data');\">HAPUS</a> | 
								<a href='halaman.php?mod=peminjaman&act=kembali&id=$b[noPeminjaman]'>PENGEMBALIAN</a></td>
							</tr>";

							$no++;
						}
					} else {
						echo"<tr>
							<td colspan='8'>Tidak ada peminjaman-</td>
						</tr>";
					}

						

					echo"</tbody>
				</table>";


			} else {
				echo"<script>
					alert('Tidak ditemukan anggota');
					window.history.back();
				</script>";
			}

			break;

		case 'kembali':
			if (!empty($_GET['id'])) {
				$sql = $koneksi->query("SELECT a.*, b.judul, c.nama FROM peminjaman a 
									LEFT JOIN buku b ON a.kodeBuku = b.kodeBuku 
									LEFT JOIN anggota c ON a.noAnggota = c.noAnggota 
									WHERE a.noPeminjaman = '$_GET[id]' AND stsPinjam = 1");
				$temukan = mysqli_num_rows($sql);

				if ($temukan > 0) {
					$a = mysqli_fetch_assoc($sql);

					$dt = date('Y-m-d');
					$lama = selisih_tanggal($dt, $a['tglPinjam']);
					$shr = selisih_tanggal($a['tglKembali'], $a['tglPinjam']);
					
					$terlambat = 0;
					$denda = 0;
					if ($lama <= $shr) {
						$ket = 'Tidak Terlambat';
					} else {
						$terlambat = $lama - $shr;
						$denda = $terlambat * 100;
						$ket = 'Terlambat ' . $terlambat . ' Hari';
					}

					echo"<div class='formstyle'>
						<p>
							<label>NOMOR ANGGOTA</label>
							: <b>$a[noAnggota]</b>
						</p>
						<p>
							<label>NAMA ANGGOTA</label>
							: $a[nama]
						</p>
						<p>
							<label>KODE BUKU</label>
							: $a[kodeBuku]
						</p>
						<p>
							<label>JUDUL</label>
							: $a[judul]
						</p>
						<p>
							<label>TANGGAL PINJAM & KEMBALI</label>
							: ".tglindo($a['tglPinjam'])." - ".tglindo($a['tglKembali'])."
						</p>
						<p>
							<label>LAMA PEMINJAMAN</label>
							: $lama HARI (Seharusnya $shr HARI)
						</p>
						<p>
							<label>KETERANGAN</label>
							: $ket
						</p>
						<p>
							<label>DENDA KETERLAMBATAN</label>
							: Rp. ".number_format($denda)."
						</p>
					</div>";

					echo"<p style=\"font-size:12px;\"><b>Keterangan Pengembalian :</b> <br>
					* Jika terjadi kerusakan buku maka akan di denda sebesar Rp. 5000<br>
					* Keterlambatan di dendan Rp. 100/hari<br>
					* Jika terjadi kehilangan buku, silahkan melakukan ganti rugi kehilangan pada menu ganti rugi</p>";

					echo"<form action='$aksi?mod=peminjaman&act=kembali' method='POST'>
						<input type='hidden' name='lama' value='$lama'>
						<input type='hidden' name='terlambat' value='$terlambat'>
						<input type='hidden' name='denda' value='$denda'>
						<input type='hidden' name='kodepeminjamann' value='$a[noPeminjaman]'>
						<input type='hidden' name='kodeBuku' value='$a[kodeBuku]'>
						<input type='hidden' name='noAnggota' value='$a[noAnggota]'>
						<div class='formstyle'>
							<p>
								<label>STATUS BUKU</label>
								: <input type='radio' name='stsbuku' value='1' required> Baik 
								<input type='radio' name='stsbuku' value='2' required> Rusak 
								<input type='radio' name='stsbuku' value='3' required> Hilang
							</p>
							<p>
								<label>DENDA KERUSAKAN</label>
								: <input type='text' name='dendarusak' value='0' required>
							</p>
							<p>
								<label>KETERANGAN</label>
								: <textarea name='ket' cols='40' rows='4' placeholder='Keterangan'></textarea>
							</p>
							<p>
								<label>&nbsp;</label>
								<input type='submit' name='submit' value='Kembali Buku'>
							</p>
						</div>
					</form>";

					echo"<button type='button' onclick=\"window.history.back()\">BATAL</button>";
					

				} else {
					echo"<script>
						alert('Sudah dikembalikan...');
						window.history.back();
					</script>";
				}
			} else {
				header("location:halaman.php?mod=peminjaman&act=form");
			}

				
			break;
		
		default:
			echo"<h3>DATA SEMUA PEMINJAMAN BUKU</h3>";

			echo"<p><a href='halaman.php?mod=peminjaman&act=form'>TAMBAH PEMINJAMAN</a></p>";

			echo"<table class='gridtable'>
				<thead>
				<tr>
					<th>NO</th>
					<th>NO. PEMINJAMAN</th>
					<th>KODE BUKU</th>
					<th>JUDUL BUKU</th>
					<th>NO. ANGGOTA</th>
					<th>NAMA ANGGOTA</th>
					<th>TGL. PINJAM & PENGEMBALIAN</th>
					<th>STATUS</th>
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
				$query = "SELECT a.*, b.judul, c.nama FROM peminjaman a 
							LEFT JOIN buku b ON a.kodeBuku = b.kodeBuku 
							LEFT JOIN anggota c ON a.noAnggota = c.noAnggota";
				$q 	= "SELECT * FROM peminjaman";

				if(!empty($_GET['field']))
				{
					$hideinp = "<input type='hidden' name='field' value='$_GET[field]'>
								<input type='hidden' name='cari' value='$_GET[cari]'>";

					$linkaksi .= "&field=$_GET[field]&cari=$_GET[cari]";

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
						if ($m['stsPinjam'] == 2) {
							$ket = 'Sudah dikembalikan';
							$noa = $m['noPeminjaman'];
						} elseif($m['stsPinjam'] == 1) {
							$ket = 'Sedang dipinjam...';
							$noa = "<a href='halaman.php?mod=peminjaman&act=kembali&id=$m[noPeminjaman]'>$m[noPeminjaman]</a>";
						}
						echo"<tr>
							<td>$no</td>
							<td>$noa</td>
							<td>$m[kodeBuku]</td>
							<td>$m[judul]</td>
							<td>$m[noAnggota]</td>
							<td>$m[nama]</td>
							<td>".tglindo($m['tglPinjam'])." - ".tglindo($m['tglKembali'])."</td>
							<td>$ket</td>
						
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
						<td colspan='8'><div class='w3-center'><i>Peminjaman Not Found.</i></div></td>
					</tr>";
				}

				echo"</tbody>
			</table>";


			echo"<div id='foot'>
				<div id='foot-left'>
					<form class='w3-tiny' action='' method='GET'>
						<input type='hidden' name='mod' value='kategori'>";
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