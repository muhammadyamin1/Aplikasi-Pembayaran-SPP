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
$query = mysqli_query($koneksi, "update pembayaran set tgl_bayar = '0000-00-00', jumlah_bayar = '0', status = 'Belum Bayar' where id_pembayaran = '$idget'");
if (!$query) {
    echo "Gagal : ".$koneksi->error;
} else {
    $_SESSION['success'] = 'Transaksi Berhasil dibatalkan';
    echo "<script>window.location.href='bayar.php?cari=$nisn';</script>";
}