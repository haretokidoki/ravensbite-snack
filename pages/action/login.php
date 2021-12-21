<?php  
	include '../koneksi.php';
	session_start();

	$uname = $_POST['uname'];
	$pass = md5($_POST['password']);
	$result = $koneksi->query("SELECT id_pegawai, password, priv FROM pegawai WHERE username = '$uname'");
	if ($result == null) {
		header("Location: ../sign-in.php?");
		exit();
	}
	$arr = mysqli_fetch_array($result);

	if ($pass != $arr['password']) {
		header("Location: ../sign-in.php?r=pw");
		exit();
	}else{
		if ($arr['priv'] == 1) {
			$_SESSION['priv'] = "admin";
			$_SESSION['id'] = $arr['id_pegawai'];
			header("Location: ../dashboard_admin.php");
		} elseif ($arr['priv'] == 2) {
			$_SESSION['priv'] = "kadiv";
			$_SESSION['id'] = $arr['id_pegawai'];
			header("Location: ../dashboard_pegawai.php");
		} elseif ($arr['priv'] == 3) {
			$_SESSION['priv'] = "pegawai";
			$_SESSION['id'] = $arr['id_pegawai'];
			header("Location: ../dashboard_pegawai.php");
		}
	}

?>