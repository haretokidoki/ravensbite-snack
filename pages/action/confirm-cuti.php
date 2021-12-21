<?php  
	session_start();
	if (empty($_SESSION['priv']) || $_SESSION['priv'] != "admin") {
	   header("Location: ../sign-in.php?"); 
	}
	include '../koneksi.php';
	$kode = $_POST['kode'];
	$nama = $_POST['nama'];
	$status = $_POST['submit'];
	
	if ($status == "Setujui") {
		$status2 = "disetujui";
	}elseif ($status == "Tolak") {
		$status2 = "ditolak";
	}

	$result = mysqli_query($koneksi, "UPDATE cuti SET status='$status2' WHERE id_cuti='$kode'");
	if ($result) {
		echo '
			<script type="text/javascript">
				alert("Permohonan cuti dari '.$nama.' telah di'.strtolower($status).'!")
				window.location.replace("../permohonan-cuti.php");
			</script>
		';
	}
	
	
?>
