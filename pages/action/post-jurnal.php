<?php  
	include '../koneksi.php';
	$kode = $_POST['kode'];
	$id = $_POST['id_divisi'];
	$tanggal = $_POST['tanggal'];
	$jurnal = $_POST['jurnal'];
	$result = mysqli_query($koneksi, "INSERT INTO jurnal (id_jurnal, id_divisi, tanggal, isi_jurnal) VALUES('$kode', '$id', '$tanggal', '$jurnal')");
	if ($result) {
		echo '
			<script type="text/javascript">
				alert("Jurnal berhasil ditambahkan!")
				window.location.replace("../jurnal.php");
			</script>
		';
	}
?>