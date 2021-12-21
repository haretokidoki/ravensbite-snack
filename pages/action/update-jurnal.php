<?php  
	include '../koneksi.php';
	$kode = $_POST['kode'];
	$id = $_POST['id_divisi'];
	$tanggal = $_POST['tanggal'];
	$jurnal = $_POST['jurnal'];
	$result = mysqli_query($koneksi, "UPDATE jurnal SET isi_jurnal='$jurnal' WHERE id_jurnal='$kode'");
	if ($result) {
		echo '
			<script type="text/javascript">
				alert("Jurnal berhasil diperbarui!")
				window.location.replace("../jurnal.php");
			</script>
		';
	}
	
	
?>
