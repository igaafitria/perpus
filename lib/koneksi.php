<?php
	$host = 'localhost';
	$user = 'root';
	$pass = '';
	$db = 'db_perpus';

	$koneksi = new mysqli ( "localhost" , "root" , "" , "db_perpus" );
echo $koneksi->connect_errno?'Koneksi gagal : '.$koneksi->connect_error:'';


?>