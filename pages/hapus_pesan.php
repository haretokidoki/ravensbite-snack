<?php
session_start();
if (empty($_SESSION['priv']) || $_SESSION['priv'] != "admin") {
    header("Location: sign-in.php?"); 
  }
include_once("koneksi.php");
$id = $_GET['id'];
$result = mysqli_query($koneksi, "DELETE FROM pesan WHERE id_pesan='$id'");
if($result){
    header("Location:tampil_pesan.php");
}
?>