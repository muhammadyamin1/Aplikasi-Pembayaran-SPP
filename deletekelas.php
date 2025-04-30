<?php
session_start();
if($_SESSION['status']!="login"){
	echo "<script>window.location.href='index.php?pesan=belum_login';</script>";
}
require('koneksi.php');
$idget = $_GET['id'];
$query = mysqli_query($koneksi, "delete from kelas where id_kelas = '$idget'");
if (!$query) {
    $msgErr = $koneksi->error;
    $_SESSION['errorMsgHapus'] = $msgErr;
    echo "<script>window.location.href='kelas.php';</script>";
    exit;
} else {
    $_SESSION['success'] = 'Data Berhasil Dihapus';
    echo "<script>window.location.href='kelas.php';</script>";
    exit;
}
