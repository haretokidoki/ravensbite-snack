<?php
session_start();
if (empty($_SESSION['priv']) || $_SESSION['priv'] != "admin") {
    header("Location: sign-in.php?"); 
  }
include_once("koneksi.php");
$id = $_GET['id'];
$result = mysqli_query($koneksi, "DELETE FROM pegawai WHERE id_pegawai='$id'");
if($result){
    header("Location:pegawai.php");
}
?>