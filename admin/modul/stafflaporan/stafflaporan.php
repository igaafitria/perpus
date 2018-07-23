<?php
	if(!isset($_SESSION['username'])){
		header('location: login.php'); // Mengarahkan ke Home Page
	}

	//link buat paging
	$linkaksi = 'halaman.php?mod=stafflaporan';

	if(isset($_GET['act']))
	{
		$act = $_GET['act'];
		$linkaksi .= '&act='.$act;
	}
	else
	{
		$act = '';
	}

	$aksi = 'modul/stafflaporan/aksi_stafflaporan.php';

	switch ($act) {
		case 'form':
			echo"<h3>FORM LAPORAN STAFF</h3>";

			if(!empty($_GET['id']))
			{
				$act = "$aksi?mod=stafflaporan&act=edit";
				$query = $koneksi->query("SELECT * FROM staff_laporan WHERE idLaporan = '$_GET[id]'");
				$temukan = mysqli_num_rows($query);
				if($temukan > 0)
				{
					$c = mysqli_fetch_assoc($query);
				}
				else
				{
					header("location:halaman.php?mod=stafflaporan");
				}

			}
			else
			{
				$act = "$aksi?mod=stafflaporan&act=simpan";
			}

			echo"<div class='formstyle'>
			<form action='$act' method='POST'>
				<input type='hidden' name='idLaporan' value='";?><?php echo isset($c['idLaporan']) ? $c['idLaporan'] : ''; ?><?php echo"'>
				<p>
					<label>JUDUL</label>
					: <input type='text' name='judulLaporan' placeholder='judul...' value='";?><?php echo isset($c['judulLaporan']) ? $c['judulLaporan'] : ''; ?><?php echo"' size='60' required>
				</p>
				<p>
					<label>PENYUSUN</label>
					: <input type='text' name='penyusun' placeholder='penulis...' value='";?><?php echo isset($c['penyusun']) ? $c['penyusun'] : ''; ?><?php echo"' size='40' required>
				</p>
				<p>
					<label>TAHUN PEMBUATAN</label>
					: <input type='text' name='thnPembuatan' placeholder='0000' value='";?><?php echo isset($c['thnPembuatan']) ? $c['thnPembuatan'] : ''; ?><?php echo"' size='4' required>
				</p>
				<p>
					<label>PENERBIT</label>
					: <select name='idPenerbit' required>
						<option value=''>- Pilih Penerbit -</option>";
						$penerbit = $koneksi->query("SELECT * FROM buku_penerbit ORDER BY namaPenerbit ASC");
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
					<label>NO. INDUK</label>
					: <input type='text' name='noInduk' placeholder='0' value='";?><?php echo isset($c['noInduk']) ? $c['noInduk'] : ''; ?><?php echo"' size='4' required>
				</p>
				<p>
					<label>NO. KELAS</label>
					: <input type='text' name='noKelas' placeholder='0' value='";?><?php echo isset($c['noKelas']) ? $c['noKelas'] : ''; ?><?php echo"' size='4' required>
				</p>
				<p>
					<label>TGL. TERIMA</label>
					: <input type='text' name='tglTerima' id='tgl' placeholder='tanggal...' value='";?><?php echo isset($c['tglTerima']) ? $c['tglTerima'] : ''; ?><?php echo"' required>
				</p>
				<p>
					<label>LEMARI - RAK</label>
					: <input type='text' name='lemari' placeholder='0' value='";?><?php echo isset($c['lemari']) ? $c['lemari'] : ''; ?><?php echo"' size='4' required> - 
					<input type='text' name='rak' placeholder='0' value='";?><?php echo isset($c['rak']) ? $c['rak'] : ''; ?><?php echo"' size='4' required>
				</p>
				<p>
					<label>KEGIATAN</label>
					: <input type='text' name='kegiatan' placeholder='kegiatan...' value='";?><?php echo isset($c['kegiatan']) ? $c['kegiatan'] : ''; ?><?php echo"' size='40' required>
				</p>
				<p>
					<label>JUMLAH</label>
					: <input type='text' name='jumlah' placeholder='0' value='";?><?php echo isset($c['jumlah']) ? $c['jumlah'] : ''; ?><?php echo"' size='4' required>
				</p>
				<p>
					<label>DESKRIPSI</label>
					: <textarea name='deskripsi' cols='80' rows='4'>";?><?php echo isset($c['deskripsi']) ? $c['deskripsi'] : ''; ?><?php echo"</textarea>
				</p>
				<p>
					<label>&nbsp;</label>
					&nbsp; <input type='submit' name='submit' value='Simpan'> 
					<button type='button' onclick='window.history.back()'>Kembali</button>
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
						showAnim : "fold",
						yearRange:'-100:+0',
					});
				});
			</script>

			<?php
			break;
		
		default:
			echo"<h3>DATA LAPORAN STAFF</h3>";

			echo"<table width='100%'>
				<tr>
					<td width='50%'><a href='halaman.php?mod=stafflaporan&act=form'>TAMBAH DATA</a> | 
					<a href='halaman.php?mod=stafflaporan'>REFRESH</a>
					</td>
					<td width='50%'>
						<form action='' method='GET'>
							<input type='hidden' name='mod' value='stafflaporan'>
							Cari : <select name='field'>
								<option value='judul'>- Pilih -</option>
								<option value='judul'>Judul</option>
								<option value='penulis'>Penulis</option>
								<option value='thnPembuatan'>Tahun</option>
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
					<th>JUDUL</th>
					<th>PENYUSUN</th>
					<th>TAHUN</th>
					<th>PENERBIT</th>
					<th>NO. KELAS</th>
					<th>LEMARI</th>
					<th>RAK</th>
					<th>JUMLAH</th>
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
				$query = "SELECT a.*, b.namaPenerbit 
						FROM staff_laporan a 
						LEFT JOIN buku_penerbit b ON (a.idPenerbit = b.idPenerbit) ";

				$q 	= "SELECT * FROM staff_laporan ";

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
						echo"<tr>
							<td>$no</td>
							<td>$m[judulLaporan]</td>
							<td>$m[penyusun]</td>
							<td>$m[thnPembuatan]</td>
							<td>$m[namaPenerbit]</td>
							<td>$m[noKelas]</td>
							<td>$m[lemari]</td>
							<td>$m[rak]</td>
							<td>$m[jumlah]</td>
							<td><a href='halaman.php?mod=stafflaporan&act=form&id=$m[idLaporan]'>EDIT</i></a> | 
							<a href='$aksi?mod=stafflaporan&act=hapus&id=$m[idLaporan]' onclick=\"return confirm('Yakin hapus data');\">HAPUS</a></td>
						
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
						<td colspan='11'><div class='w3-center'><i>Laporan Staff Not Found.</i></div></td>
					</tr>";
				}

				echo"</tbody>
			</table>";


			echo"<div id='foot'>
				<div id='foot-left'>
					<form class='w3-tiny' action='' method='GET'>
						<input type='hidden' name='mod' value='stafflaporan'>";
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