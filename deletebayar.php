<?php
session_start();
if($_SESSION['status']!="login"){
	echo "<script>window.location.href='index.php?pesan=belum_login';</script>";
}
require('koneksi.php');
$idget = $_GET['id'];
$querynisn = mysqli_query($koneksi, "select nisn from pembayaran where id_pembayaran = '$idget'");
while ($d = mysqli_fetch_array($querynisn)) {
    $nisn = $d['nisn'];
}
$query = mysqli_query($koneksi, "delete from pembayaran where id_pembayaran = '$idget'");
if (!$query) {
    $msgErr = $koneksi->error;
    $_SESSION['errorMsgHapus'] = $msgErr;
    echo "<script>window.location.href='bayar.php?cari=$nisn';</script>";
    exit;
} else {
    $_SESSION['success'] = 'Data Berhasil Dihapus';
    echo "<script>window.location.href='bayar.php?cari=$nisn';</script>";
    exit;
}
