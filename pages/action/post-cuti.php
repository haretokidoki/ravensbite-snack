<?php  
	include '../koneksi.php';
	$time = $_POST['time'];
	$id = $_POST['id_pegawai'];
	$cutistr = $_POST['cutistr'];
	$cutistp = $_POST['cutistp'];
	$kode = date("ymd",strtotime($cutistr)).date("md",strtotime($cutistp)).$id;
	$alasan = $_POST['alasan'];
	$status = $_POST['status'];
	if ($cutistr > $cutistp) {
		echo '
			<script type="text/javascript">
				alert("Tanggal selesai tidak valid!")
				window.location.replace("../ajukan_cuti.php");
			</script>
		';
	}else{
		$result = mysqli_query($koneksi, "INSERT INTO cuti (timestamp, id_cuti, tanggal_mulai, tanggal_selesai, id_pegawai, alasan, status) VALUES('$time','$kode', '$cutistr', '$cutistp', '$id', '$alasan', '$status')");
		if ($result) {
			echo '
				<script type="text/javascript">
					alert("Izin cuti berhasil diajukan!")
					window.location.replace("../ajukan_cuti.php");
				</script>
			';
		}
	}
	
?>