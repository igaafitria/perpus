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

	$aksi = 'modul/penerbit/aksi_penerbit.php';

	switch ($act) {
		case 'form':
			if(!empty($_GET['id']))
			{
				$act = "$aksi?mod=penerbit&act=edit";
				$query = $koneksi->query("SELECT * FROM buku_penerbit WHERE idPenerbit = '$_GET[id]'");
				$temukan = mysqli_num_rows($query);
				if($temukan > 0)
				{
					$c = mysqli_fetch_assoc($query);
				}
				else
				{
					header("location:halaman.php?mod=penerbit");
				}

			}
			else
			{
				$act = "$aksi?mod=penerbit&act=simpan";
			}

			echo"<div class='formstyle'>
			<form action='$act' method='POST'>
				<input type='hidden' name='idPenerbit' value='";?><?php echo isset($c['idPenerbit']) ? $c['idPenerbit'] : ''; ?><?php echo"'>
				<p>
					<label>NAMA PENERBIT</label>
					: <input type='text' name='namaPenerbit' placeholder='Nama Penerbit...' value='";?><?php echo isset($c['namaPenerbit']) ? $c['namaPenerbit'] : ''; ?><?php echo"' size='40' >
				</p>
				<p>
					<label>&nbsp;</label>
					&nbsp; <input type='submit' name='submit' value='Simpan'>
				</p>
			</form>
			</div>";
			break;
		
		default:
			echo"<h3>PENERBIT</h3>";

			echo"<a href='halaman.php?mod=penerbit&act=form'>TAMBAH PENERBIT</a>";

			echo"<table class='gridtable'>
				<thead>
				<tr>
					<th>NO</th>
					<th>ID</th>
					<th>NAMA PENERBIT</th>
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
				$query = "SELECT * FROM buku_penerbit ";
				$q 	= "SELECT * FROM buku_penerbit ";

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
							<td>$m[idPenerbit]</td>
							<td>$m[namaPenerbit]</td>
							<td><a href='halaman.php?mod=penerbit&act=form&id=$m[idPenerbit]'>EDIT</i></a> | 
							<a href='$aksi?mod=penerbit&act=hapus&id=$m[idPenerbit]' onclick=\"return confirm('Yakin hapus data');\">HAPUS</a></td>
						
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
						<td colspan='4'><div class='w3-center'><i>Penerbit Not Found.</i></div></td>
					</tr>";
				}

				echo"</tbody>
			</table>";


			echo"<div id='foot'>
				<div id='foot-left'>
					<form class='w3-tiny' action='' method='GET'>
						<input type='hidden' name='mod' value='penerbit'>";
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