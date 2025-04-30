<?php
session_start();
if($_SESSION['status']!="login"){
	echo "<script>window.location.href='index.php?pesan=belum_login';</script>";
}
require('koneksi.php');
$idget = $_GET['id'];
$queryfoto = mysqli_query($koneksi, "select * from siswa WHERE nisn = '$idget'");
$resultfoto = mysqli_fetch_array($queryfoto);
if ($resultfoto['photo'] != "default.png") {
    $img = "Foto/siswa/" . $resultfoto['photo'];
    @unlink("$img");
}
$query = mysqli_query($koneksi, "delete from siswa where nisn = '$idget'");
if (!$query) {
    $msgErr = $koneksi->error;
    $_SESSION['errorMsgHapus'] = $msgErr;
    echo "<script>window.location.href='siswa.php';</script>";
    exit;
} else {
    $_SESSION['success'] = 'Data Berhasil Dihapus';
    echo "<script>window.location.href='siswa.php';</script>";
    exit;
}
