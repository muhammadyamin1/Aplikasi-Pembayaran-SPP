<?php
session_start();
if($_SESSION['status']!="login"){
	echo "<script>window.location.href='index.php?pesan=belum_login';</script>";
}
require('koneksi.php');
$idget = $_GET['id'];
$queryfoto = mysqli_query($koneksi, "select * from petugas WHERE id_petugas = '$idget'");
$resultfoto = mysqli_fetch_array($queryfoto);
if ($resultfoto['photo'] != "default.png") {
    $img = "Foto/petugas/" . $resultfoto['photo'];
    @unlink("$img");
}
$query = mysqli_query($koneksi, "delete from petugas where id_petugas = '$idget'");
if (!$query) {
    $msgErr = $koneksi->error;
    $_SESSION['errorMsgHapus'] = $msgErr;
    echo "<script>window.location.href='petugas.php';</script>";
    exit;
} else {
    $_SESSION['success'] = 'Data Berhasil Dihapus';
    echo "<script>window.location.href='petugas.php';</script>";
    exit;
}
