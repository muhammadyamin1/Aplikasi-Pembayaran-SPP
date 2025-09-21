<?php
// Base URL (dinamis)
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST'];
$script = dirname($_SERVER['SCRIPT_NAME']);
$base_url = $protocol . $host . $script . '/';

// Logo & Kop Sekolah
$logo_kiri = $base_url . 'Foto/struk/logo.jpeg';
$logo_kanan = $base_url . 'Foto/struk/tutwuri.png';
$nama_sekolah = "SMKN 9 MEDAN";
$alamat_sekolah = "Dinas Pendidikan Kota Medan<br>Provinsi Sumatera Utara";