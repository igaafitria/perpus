<?php
	if(!isset($_SESSION['username'])){
		header('location: login.php'); // Mengarahkan ke Home Page
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

	$aksi = 'modul/anggota/aksi_anggota.php';

	switch ($act) {
		case 'form':
			if(!empty($_GET['id']))
			{
				$act = "$aksi?mod=anggota&act=edit";
				$query = $koneksi->query("SELECT * FROM anggota WHERE noAnggota = '$_GET[id]'");
				$temukan = mysqli_num_rows($query);
				if($temukan > 0)
				{
					$c = mysqli_fetch_assoc($query);
				}
				else
				{
					header("location:halaman.php?mod=anggota");
				}

			}
			else
			{
				$act = "$aksi?mod=anggota&act=simpan";
			}

			echo"<div class='formstyle'>
			<form action='$act' method='POST'>
				<input type='hidden' name='noAnggota' value='";?><?php echo isset($c['noAnggota']) ? $c['noAnggota'] : ''; ?><?php echo"'>
				<p>
					<label>NO. ANGGOTA</label>
					: <input type='text' name='noanggota' placeholder='KODE ANGGOTA ...' value='";?><?php echo isset($c['nama']) ? $c['nama'] : ''; ?><?php echo"' size='45' >
				</p>
				<p>
					<label>NAMA</label>
					: <input type='text' name='nama' placeholder='Nama Anggota...' value='";?><?php echo isset($c['nama']) ? $c['nama'] : ''; ?><?php echo"' size='45' >
				</p>
				<p>
					<label>TEMPAT LAHIR, TGL. LAHIR</label>
					: <input type='text' name='tmpLahir' placeholder='Tempat Lahir...' value='";?><?php echo isset($c['tmpLahir']) ? $c['tmpLahir'] : ''; ?><?php echo"' size='30' >,

					<input type='text' name='tglLahir' id='tgl' placeholder='Tanggal Lahir...' value='";?><?php echo isset($c['tglLahir']) ? $c['tglLahir'] : ''; ?><?php echo"' >
				</p>
				<p>
					<label>ALAMAT</label>
					: <textarea name='alamat' cols='50' rows='4'>";?><?php echo isset($c['alamat']) ? $c['alamat'] : ''; ?><?php echo"</textarea>
				</p>
				<p>
					<label>NOMOR HP</label>
					: <input type='text' name='noHp' placeholder='Nomor HP...' value='";?><?php echo isset($c['noHp']) ? $c['noHp'] : ''; ?><?php echo"' size='20' >
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
			echo"<h3>DATA ANGGOTA</h3>";

			echo"<table width='100%'>
				<tr>
					<td width='50%'><a href='halaman.php?mod=anggota&act=form'>TAMBAH ANGGOTA</a> | 
					<a href='halaman.php?mod=anggota'>REFRESH</a> | 
			<a href='laporan/laporananggota.php' target='_blank'>CETAK</a>
					</td>
					<td width='50%'>
						<form action='' method='GET'>
							<input type='hidden' name='mod' value='anggota'>
							Cari : <select name='field'>
								<option value='nama'>- Pilih -</option>
								<option value='noAnggota'>Nomor Anggota</option>
								<option value='nama'>Nama</option>
								<option value='tmpLahir'>Tempat Lahir</option>
								<option value='alamat'>Alamat</option>
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
					<th>NO. ANGGOTA</th>
					<th>NAMA</th>
					<th>TEMPAT, TGL. LAHIR</th>
					<th>ALAMAT</th>
					<th>NOMOR HP</th>
					<th>THN. DAFTAR</th>
					<th>SISA</th>
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
				$query = "SELECT * FROM anggota ";
				$q 	= "SELECT * FROM anggota";

				if(!empty($_GET['field']))
				{
					$hideinp = "<input type='hidden' name='field' value='$_GET[field]'>
								<input type='hidden' name='cari' value='$_GET[cari]'>";

					$linkaksi .= "&field=$_GET[field]&cari=$_GET[cari]";

					$query .= " WHERE $_GET[field] LIKE '%$_GET[cari]%'";
					$q .= " WHERE $_GET[field] LIKE '%$_GET[cari]%'";
				}

				$query .= " ORDER BY noAnggota ASC LIMIT $posisi, $batas ";
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
							<td>$m[tmpLahir] ". tglindo($m['tglLahir'])."</td>
							<td>$m[alamat]</td>
							<td>$m[noHp]</td>
							<td>$m[thnDaftar]</td>
							<td>$m[jmlpinjam]</td>
							<td><a href='halaman.php?mod=anggota&act=form&id=$m[noAnggota]'>EDIT</i></a> | 
							<a href='$aksi?mod=anggota&act=hapus&id=$m[noAnggota]' onclick=\"return confirm('Yakin hapus data');\">HAPUS</a></td>
						
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
						<td colspan='8'><i>Anggota Not Found.</i></td>
					</tr>";
				}

				echo"</tbody>
			</table>";


			echo"<div id='foot'>
				<div id='foot-left'>
					<form class='w3-tiny' action='' method='GET'>
						<input type='hidden' name='mod' value='anggota'>";
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