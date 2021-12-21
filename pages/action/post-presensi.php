<?php  
	
	include '../koneksi.php';
	$kode = $_POST['kode'];
	$id = $_POST['id'];
	$waktu = $_POST['waktu'];
	$result = mysqli_query($koneksi, "INSERT INTO presensi (id_presensi, waktu, id_pegawai) VALUES('$kode', '$waktu', '$id')");
	header("Location:../presensi.php");
?>