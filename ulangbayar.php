<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
if($_SESSION['status']!="login"){
	echo "<script>window.location.href='index.php?pesan=belum_login';</script>";
}
require('koneksi.php');
$idget = $_GET['id'];
$query = mysqli_query($koneksi, "select nisn from pembayaran where id_pembayaran = '$idget'");
while ($d = mysqli_fetch_array($query)) {
    $nisn = $d['nisn'];
}
$query2 = mysqli_query($koneksi, "select id_spp from siswa where nisn = '$nisn'");
while ($d = mysqli_fetch_array($query2)) {
    $id_spp = $d['id_spp'];
}
$query3 = mysqli_query($koneksi, "select nominal from spp where id_spp = '$id_spp'");
while ($d = mysqli_fetch_array($query3)) {
    $spp = $d['nominal'];
}
$querybayar = mysqli_query($koneksi, "update pembayaran set id_petugas = '".$_SESSION['id_pengguna']."', tgl_bayar = '".date("Y-m-d")."', jumlah_bayar = '$spp', status = 'Lunas' where id_pembayaran = '$idget'");
if (!$querybayar) {
    echo "Gagal : ".$koneksi->error;
} else {
    echo "<script>window.location.href='bayar.php?cari=$nisn';</script>";
}