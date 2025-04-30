-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 30 Apr 2025 pada 18.10
-- Versi server: 10.3.39-MariaDB-0+deb10u2
-- Versi PHP: 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_spp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` varchar(30) NOT NULL,
  `nama_kelas` varchar(10) NOT NULL,
  `id_kompetensi_keahlian` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `id_kompetensi_keahlian`) VALUES
('XIIAN1', 'XII AN 1', 'j6'),
('XIIRPL1', 'XII RPL 1', 'j2'),
('XIIRPL2', 'XII RPL 2', 'j2'),
('XIITKJ1', 'XII TKJ 1', 'j1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kompetensi_keahlian`
--

CREATE TABLE `kompetensi_keahlian` (
  `id_kompetensi_keahlian` varchar(11) NOT NULL,
  `nama_kompetensi_keahlian` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `kompetensi_keahlian`
--

INSERT INTO `kompetensi_keahlian` (`id_kompetensi_keahlian`, `nama_kompetensi_keahlian`) VALUES
('j1', 'Teknik Komputer dan Jaringan (TKJ)'),
('j2', 'Rekayasa Perangkat Lunak (RPL)'),
('j6', 'Animasi (AN)');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_petugas` int(11) NOT NULL,
  `nisn` varchar(10) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `bulan_dibayar` varchar(9) NOT NULL,
  `tahun_dibayar` varchar(4) NOT NULL,
  `id_spp` int(11) NOT NULL,
  `jumlah_bayar` int(11) NOT NULL,
  `status` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_petugas`, `nisn`, `tgl_bayar`, `bulan_dibayar`, `tahun_dibayar`, `id_spp`, `jumlah_bayar`, `status`) VALUES
(41, 56, '0022436102', '2021-04-06', 'Januari', '2021', 6, 450000, 'Lunas'),
(42, 56, '0022436102', '2021-04-06', 'Februari', '2021', 6, 450000, 'Lunas'),
(43, 56, '0022436102', '2021-04-06', 'Maret', '2021', 6, 450000, 'Lunas'),
(44, 56, '0022436102', '2021-04-06', 'April', '2021', 6, 450000, 'Lunas'),
(45, 60, '0022436102', '0000-00-00', 'Mei', '2021', 6, 0, 'Belum Bayar'),
(46, 56, '0022436103', '2021-04-06', 'Januari', '2021', 8, 500000, 'Lunas'),
(47, 56, '0022436103', '2021-04-06', 'Februari', '2021', 8, 500000, 'Lunas'),
(48, 58, '0022436103', '2021-04-06', 'Maret', '2021', 8, 500000, 'Lunas'),
(49, 58, '0022436104', '2021-04-06', 'Januari', '2021', 6, 450000, 'Lunas'),
(54, 58, '0022436104', '2021-04-06', 'Februari', '2021', 6, 450000, 'Lunas'),
(55, 58, '0022436104', '0000-00-00', 'Maret', '2021', 6, 0, 'Belum Bayar'),
(56, 60, '0022436103', '2023-12-31', 'April', '2021', 8, 500000, 'Lunas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_petugas` varchar(35) NOT NULL,
  `level` enum('admin','petugas','siswa') NOT NULL,
  `photo` varchar(150) DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `username`, `password`, `nama_petugas`, `level`, `photo`) VALUES
(56, 'dedi123', 'a642a77abd7d4f51bf9226ceaf891fcbb5b299b8', 'Dedi Mulyadi', 'admin', 'default.png'),
(57, 'zaki123', '14993032bd035408dd9ab6f6e6ad0b023eced296', 'Muhammad Zaki', 'siswa', 'default.png'),
(58, 'aini123', 'f638e2789006da9bb337fd5689e37a265a70f359', 'Aini Fitriana', 'petugas', 'default.png'),
(60, 'yamin123', 'f865b53623b121fd34ee5426c792e5c33af8c227', 'Muhammad Yamin', 'admin', 'default.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `nisn` char(10) NOT NULL,
  `nis` char(8) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `id_kelas` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `id_spp` int(11) NOT NULL,
  `photo` varchar(150) DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`nisn`, `nis`, `nama`, `id_kelas`, `alamat`, `no_telp`, `id_spp`, `photo`) VALUES
('0022436102', '17.1369', 'Muhammad Zaki', 'XIIRPL2', 'Jl. Kertas Gg. Tinju No. 80 Y', '085362637026', 6, 'default.png'),
('0022436103', '17.7564', 'Andre', 'XIITKJ1', 'Jl. Hayam Wuruk', '087834316542', 8, 'default.png'),
('0022436104', '17.1371', 'Zakiya', 'XIITKJ1', 'Jl. Mongonsidi', '081234236766', 6, 'Avatar Delima.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `spp`
--

CREATE TABLE `spp` (
  `id_spp` int(11) NOT NULL,
  `tahun` varchar(15) NOT NULL,
  `nominal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `spp`
--

INSERT INTO `spp` (`id_spp`, `tahun`, `nominal`) VALUES
(6, '2019/2020', 450000),
(8, '2020/2021', 500000);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `id_kompetensi_keahlian` (`id_kompetensi_keahlian`);

--
-- Indeks untuk tabel `kompetensi_keahlian`
--
ALTER TABLE `kompetensi_keahlian`
  ADD PRIMARY KEY (`id_kompetensi_keahlian`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_petugas` (`id_petugas`),
  ADD KEY `id_spp` (`id_spp`),
  ADD KEY `nisn` (`nisn`);

--
-- Indeks untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nisn`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_spp` (`id_spp`);

--
-- Indeks untuk tabel `spp`
--
ALTER TABLE `spp`
  ADD PRIMARY KEY (`id_spp`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT untuk tabel `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT untuk tabel `spp`
--
ALTER TABLE `spp`
  MODIFY `id_spp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`id_kompetensi_keahlian`) REFERENCES `kompetensi_keahlian` (`id_kompetensi_keahlian`);

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`),
  ADD CONSTRAINT `pembayaran_ibfk_2` FOREIGN KEY (`nisn`) REFERENCES `siswa` (`nisn`),
  ADD CONSTRAINT `pembayaran_ibfk_3` FOREIGN KEY (`id_spp`) REFERENCES `siswa` (`id_spp`);

--
-- Ketidakleluasaan untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`id_spp`) REFERENCES `spp` (`id_spp`),
  ADD CONSTRAINT `siswa_ibfk_3` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
