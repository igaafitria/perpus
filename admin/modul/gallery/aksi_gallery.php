<?php
	session_start();
	include"../../../lib/koneksi.php";
	include"../../../lib/all_function.php";


	if(!isset($_SESSION['username'])){
		header('location: ../../login.php'); // Mengarahkan ke Home Page
	}

	if(isset($_GET['mod']) && isset($_GET['act']))
	{
		$mod = $_GET['mod'];
		$act = $_GET['act'];
	}
	else
	{
		$mod = "";
		$act = "";
	}


	if($mod == "gallery" AND $act == "simpan")
	{
		$lokasi_file = $_FILES['adfile']['tmp_name'];
		$image_name	= $_FILES['adfile']['name'];
		$image_size = $_FILES['adfile']['size'];
		$tipe_file = $_FILES['adfile']['type'];

		$vdir_upload = "../../../gallery/";
  		$vfile_upload = $vdir_upload . $image_name;

  		$keterangan = anti_inject($_POST['keterangan']);

  		if(empty($lokasi_file))
		{
			$koneksi->query("INSERT INTO gallery(keterangan)
						VALUES('$keterangan')") or die(mysqli_error());

			echo"<script>alert('Berhasil menambah berita.');
			window.history.go(-2)</script>";
		}
		else
		{
			if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
				echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        			window.location=('../../med.php?mod=berita')</script>";
			}
			else
			{

				$koneksi->query("INSERT INTO gallery(keterangan, pathfoto) VALUES('$keterangan', '$image_name')") or die(mysqli_error());

				move_uploaded_file($lokasi_file, $vfile_upload);

				echo"<script>
					window.history.go(-2);
				</script>";
			}
		}

	} elseif ($mod == "kategori" AND $act == "edit") {
		$lokasi_file = $_FILES['adfile']['tmp_name'];
		$image_name	= $_FILES['adfile']['name'];
		$image_size = $_FILES['adfile']['size'];
		$tipe_file = $_FILES['adfile']['type'];

		$vdir_upload = "../../../gallery/";
  		$vfile_upload = $vdir_upload . $image_name;

		if(empty($lokasi_file))
		{
			$koneksi->query("UPDATE gallery SET keterangan = '$_POST[keterangan]' 
						WHERE idGallery = '$_POST[idGallery]'") or die(mysqli_error());

			echo"<script>alert('Berhasil mengedit data Cagar Budaya.');
			window.history.go(-2)</script>";
		}
		else
		{
			if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
				echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        			window.location=('../../med.php?mod=cagar')</script>";
			}
			else
			{

				$koneksi->query("UPDATE gallery SET keterangan = '$_POST[keterangan]',
												pathfoto = '$image_name' 
						WHERE idGallery = '$_POST[idGallery]'") or die(mysqli_error());

				move_uploaded_file($lokasi_file, $vfile_upload);

				echo"<script>alert('Berhasil mengedit data Cagar Budaya.');
				window.history.go(-2)</script>";
			}
			
		}

	} elseif ($mod == "gallery" AND $act == "hapus") {
		$cekfile = $koneksi->query("SELECT * FROM gallery WHERE idGallery = '$_GET[id]'");
		$temukan = mysqli_num_rows($cekfile);
		if ($temukan > 0) {
			$a = mysqli_fetch_assoc($cekfile);

			$path = '../../../gallery/'.$a['pathfoto'];
			unlink($path);

			$koneksi->query("DELETE FROM gallery WHERE idGallery = '$_GET[id]'") or die(mysqli_error());

			echo"<script>
				window.history.back();
			</script>";	
		} else {
			echo"<script>
				window.history.back();
			</script>";	
		}
	
		
	}

?>