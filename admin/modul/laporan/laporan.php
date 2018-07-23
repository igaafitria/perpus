<?php
	if(!isset($_SESSION['username'])){
		header('location: login.php'); // Mengarahkan ke Home Page
	}

	//link buat paging
	$linkaksi = 'halaman.php?mod=kategori';

	if(isset($_GET['act']))
	{
		$act = $_GET['act'];
		$linkaksi .= '&act='.$act;
	}
	else
	{
		$act = '';
	}

	$aksi = 'modul/kategori/aksi_kategori.php';

	switch ($act) {
		case 'peminjaman':
			echo"<h3>LAPORAN PEMINJAMAN BUKU</h3>";


			echo"<div class='formstyle'>
			<form action='laporan/laporanpeminjaman.php' method='POST' target='_blank'>
				<input type='hidden' name='idKategori' value='";?><?php echo isset($c['idKategori']) ? $c['idKategori'] : ''; ?><?php echo"'>
				<p>
					<label>PILIH TANGGAL</label>
					: <input type='text' name='tglawal' id='tgl_awal' placeholder='1999-09-09' required> s/d 
					<input type='text' name='tglakhir' id='tgl_akhir' placeholder='1999-09-09' required>
				</p>
				<p>
					<label>&nbsp;</label>
					&nbsp; <input type='submit' name='submit' value='Cetak Laporan'>
				</p>
			</form>
			</div>";

			?>
			<script type="text/javascript">
				$(document).ready(function() {
					$("#tgl_awal, #tgl_akhir").datepicker({
						showOn:"button",
						buttonImage:"../images/calendar.gif",
						buttonImageOnly : true,
						dateFormat : "yy-mm-dd",
						beforeShow: customRange,
						changeMonth:true,
						changeYear:true,
						showAnim : "fold"
					});
				});

				function customRange(input)
				{
					if (input.id == 'tgl_akhir') {
						var minDate = new Date($("#tgl_awal").val());
						minDate.setDate(minDate.getDate() + 1)

						return {
							minDate: minDate
						}
					}
				}
			</script>

			<?php

			break;

		case 'pengembalian':
			echo"<h3>LAPORAN PENGEMBALIAN BUKU</h3>";


			echo"<div class='formstyle'>
			<form action='laporan/laporanpengembalian.php' method='POST' target='_blank'>
				<input type='hidden' name='idKategori' value='";?><?php echo isset($c['idKategori']) ? $c['idKategori'] : ''; ?><?php echo"'>
				<p>
					<label>PILIH TANGGAL</label>
					: <input type='text' name='tglawal' id='tgl_awal' placeholder='1999-09-09' required> s/d 
					<input type='text' name='tglakhir' id='tgl_akhir' placeholder='1999-09-09' required>
				</p>
				<p>
					<label>&nbsp;</label>
					&nbsp; <input type='submit' name='submit' value='Cetak Laporan'>
				</p>
			</form>
			</div>";

			?>
			<script type="text/javascript">
				$(document).ready(function() {
					$("#tgl_awal, #tgl_akhir").datepicker({
						showOn:"button",
						buttonImage:"../images/calendar.gif",
						buttonImageOnly : true,
						dateFormat : "yy-mm-dd",
						beforeShow: customRange,
						changeMonth:true,
						changeYear:true,
						showAnim : "fold"
					});
				});

				function customRange(input)
				{
					if (input.id == 'tgl_akhir') {
						var minDate = new Date($("#tgl_awal").val());
						minDate.setDate(minDate.getDate() + 1)

						return {
							minDate: minDate
						}
					}
				}
			</script>

			<?php

			break;

		case 'peminjamanall':
			echo"<h3>LAPORAN SEMUA PEMINJAMAN BUKU</h3>";


			echo"<div class='formstyle'>
			<form action='laporan/laporanpeminjamanall.php' method='POST' target='_blank'>
				<input type='hidden' name='idKategori' value='";?><?php echo isset($c['idKategori']) ? $c['idKategori'] : ''; ?><?php echo"'>
				<p>
					<label>PILIH TANGGAL</label>
					: <input type='text' name='tglawal' id='tgl_awal' placeholder='1999-09-09' required> s/d 
					<input type='text' name='tglakhir' id='tgl_akhir' placeholder='1999-09-09' required>
				</p>
				<p>
					<label>&nbsp;</label>
					&nbsp; <input type='submit' name='submit' value='Cetak Laporan'>
				</p>
			</form>
			</div>";

			?>
			<script type="text/javascript">
				$(document).ready(function() {
					$("#tgl_awal, #tgl_akhir").datepicker({
						showOn:"button",
						buttonImage:"../images/calendar.gif",
						buttonImageOnly : true,
						dateFormat : "yy-mm-dd",
						beforeShow: customRange,
						changeMonth:true,
						changeYear:true,
						showAnim : "fold"
					});
				});

				function customRange(input)
				{
					if (input.id == 'tgl_akhir') {
						var minDate = new Date($("#tgl_awal").val());
						minDate.setDate(minDate.getDate() + 1)

						return {
							minDate: minDate
						}
					}
				}
			</script>

			<?php

			break;

		case 'buku':
			echo"<h3>LAPORAN DATA BUKU</h3>";


			echo"<div class='formstyle'>
			<form action='laporan/laporanbook.php' method='POST' target='_blank'>
				<input type='hidden' name='idKategori' value='";?><?php echo isset($c['idKategori']) ? $c['idKategori'] : ''; ?><?php echo"'>
				<p>
					<label>PILIH TANGGAL</label>
					: <input type='text' name='tglawal' id='tgl_awal' placeholder='1999-09-09' required> s/d 
					<input type='text' name='tglakhir' id='tgl_akhir' placeholder='1999-09-09' required>
				</p>
				<p>
					<label>&nbsp;</label>
					&nbsp; <input type='submit' name='submit' value='Cetak Laporan'>
				</p>
			</form>
			</div>";

			?>
			<script type="text/javascript">
				$(document).ready(function() {
					$("#tgl_awal, #tgl_akhir").datepicker({
						showOn:"button",
						buttonImage:"../images/calendar.gif",
						buttonImageOnly : true,
						dateFormat : "yy-mm-dd",
						beforeShow: customRange,
						changeMonth:true,
						changeYear:true,
						showAnim : "fold"
					});
				});

				function customRange(input)
				{
					if (input.id == 'tgl_akhir') {
						var minDate = new Date($("#tgl_awal").val());
						minDate.setDate(minDate.getDate() + 1)

						return {
							minDate: minDate
						}
					}
				}
			</script>

			<?php

			break;

		case 'koleksi':
			echo"<h3>LAPORAN KOLEKSI BUKU</h3>";

			echo"<table class='gridtable'>
				<thead>
				<tr>
					<th>NO</th>
					<th>KATEGORI</th>
					<th>JUMLAH KOLEKSI</th>
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
				$query = "SELECT a.*, COUNT(b.kodeBuku) AS qty FROM buku_kategori a 
				LEFT JOIN buku b ON a.idKategori = b.idKategori  
				GROUP BY a.idKategori LIMIT $posisi, $batas";

				$q 	= "SELECT * FROM buku_kategori";

				$sql_kul = mysql_query($query);
				$fd_kul = mysql_num_rows($sql_kul);



				if($fd_kul > 0)
				{
					$no = $posisi + 1;
					while ($m = mysql_fetch_assoc($sql_kul)) {
						echo"<tr>
							<td>$no</td>
							<td>$m[namaKategori]</td>
							<td>$m[qty] BUKU</td>
						
						</tr>";
						$no++;
					}
	

					$jmldata = mysql_num_rows(mysql_query($q));

					$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
		    		$linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman, $linkaksi);
				}
				else
				{
					echo"<tr>
						<td colspan='4'><div class='w3-center'><i>Penerbit Not Found.</i></div></td>
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

		default:
			
			break;
	}

?>