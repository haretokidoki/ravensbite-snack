<?php 
	$host = "localhost";
	$username = "root";
	$pass = "";
	$db = "ravensbite";

	$koneksi = mysqli_connect($host,$username,$pass,$db);

	if (!$koneksi) {
		die("Koneksi gagal ".mysqli_connect_error());
	}
?>