<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
if($_SESSION['status']!="login"){
	echo "<script>window.location.href='index.php?pesan=belum_login';</script>";
}
ob_start();
require('koneksi.php');
$title = 'Bayar SPP';
$page = 'Bayar';
date_default_timezone_set('Asia/Jakarta');
include('include/header.php');
$cariErr = "";
$nisn = $nis = $nama = $kelas = $alamat = $hp = $idspp = $spp = $foto = "-";
if (isset($_GET['cari'])) {
    $cari = $_GET['cari'];
    $data = mysqli_query($koneksi, "SELECT pembayaran.id_pembayaran,siswa.nama,petugas.nama_petugas,pembayaran.tgl_bayar,pembayaran.bulan_dibayar,pembayaran.tahun_dibayar,pembayaran.status FROM pembayaran LEFT JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas LEFT JOIN siswa ON pembayaran.nisn=siswa.nisn WHERE pembayaran.nisn = '$cari'");
    $query = mysqli_query($koneksi, "SELECT siswa.nisn,siswa.nis,siswa.nama,kelas.nama_kelas,siswa.alamat,siswa.no_telp,spp.id_spp,spp.nominal,siswa.photo FROM siswa LEFT JOIN kelas ON siswa.id_kelas=kelas.id_kelas LEFT JOIN spp ON siswa.id_spp=spp.id_spp WHERE nisn = '$cari' ");
    if (mysqli_num_rows($query) == 0) {
        $cariErr = "Upss... Data tidak dapat ditemukan.";
    } else {
        while ($d = mysqli_fetch_array($query)) {
            $nisn = $d['nisn'];
            $nis = $d['nis'];
            $nama = $d['nama'];
            $kelas = $d['nama_kelas'];
            $alamat = $d['alamat'];
            $hp = $d['no_telp'];
            $idspp = $d['id_spp'];
            $spp = $d['nominal'];
            $foto = $d['photo'];
        }
    }
}
if (isset($_POST['btnSubmit'])) {
    $petugas = $_SESSION['id_pengguna'];
    $tanggal = $_POST['tanggal'];
    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];
    $status = "Lunas";
    $cekbayar = mysqli_query($koneksi, "SELECT * FROM pembayaran WHERE nisn = '$nisn' AND bulan_dibayar = '$bulan'");
    $cekkolom = mysqli_num_rows($cekbayar);
    if ($cekkolom == 0) {
        $qbayar = mysqli_query($koneksi, "insert into pembayaran values(NULL,'$petugas','$nisn','$tanggal','$bulan','$tahun','$idspp','$spp','$status')");
        if (!$qbayar) {
            $msgErr = $koneksi->error;
            $_SESSION['errorMsgTambah'] = $msgErr;
            echo "<script>window.location.href='bayar.php?cari=$nisn';</script>";
            exit;
        } else {
            $_SESSION['success'] = 'Data Berhasil Ditambah';
            echo "<script>window.location.href='bayar.php?cari=$nisn';</script>";
            exit;
        }
    } else {
        while ($c = mysqli_fetch_array($cekbayar)) {
            $statuscek = $c['status'];
        }
        if ($statuscek == "Belum Bayar") {
            $msgErr = "Siswa sudah pernah melakukan transaksi di bulan $bulan dengan <strong>status belum bayar</strong> (Silahkan Bayar Ulang).";
            $_SESSION['errorMsgTransaksi'] = $msgErr;
            echo "<script>window.location.href='bayar.php?cari=$nisn';</script>";
            exit;
        } else {
            $msgErr = "Tidak boleh melakukan transaksi pembayaran lebih dari 1 kali pada bulan yang sama.";
            $_SESSION['errorMsgTransaksi'] = $msgErr;
            echo "<script>window.location.href='bayar.php?cari=$nisn';</script>";
            exit;
        }
    }
}
?>
<div class="content mt-3">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form method="GET" action="">
                        <div class="input-group">
                            <input type="text" id="cari" name="cari" placeholder="Cari siswa berdasarkan NISN..." class="form-control" value="<?php if (isset($_GET['cari'])) {
                                                                                                                                                    echo $_GET['cari'];
                                                                                                                                                } ?>">
                            <div class="input-group-btn"><button class="btn btn-primary"><i class="fa fa-search"></i> Cari</button></div>
                        </div>
                    </form>
                    <?php if ($cariErr != "") { ?>
                        <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show mb-1">
                            <?php echo $cariErr; ?><br>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php if (isset($_GET['cari']) && $cariErr == "") { ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Detail Siswa</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-center">
                                    <?php if (!isset($_GET['cari']) || $cariErr != "") { ?>
                                        <img width="100px" height="130px" src="Foto/siswa/default.png" class="mb-4">
                                    <?php } else { ?>
                                        <img width="100px" height="130px" src="Foto/siswa/<?php echo $foto ?>" class="mb-4">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <table class="table">
                                    <tr>
                                        <td width="130px">NISN</td>
                                        <td width="10px">:</td>
                                        <td><?php echo $nisn ?></td>
                                    </tr>
                                    <tr>
                                        <td width="130px">Nama</td>
                                        <td width="10px">:</td>
                                        <td><?php echo $nama ?></td>
                                    </tr>
                                    <tr>
                                        <td width="130px">Alamat</td>
                                        <td width="10px">:</td>
                                        <td><?php echo $alamat ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table">
                                    <tr>
                                        <td width="130px">NIS</td>
                                        <td width="10px">:</td>
                                        <td><?php echo $nis ?></td>
                                    </tr>
                                    <tr>
                                        <td width="130px">Kelas</td>
                                        <td width="10px">:</td>
                                        <td><?php echo $kelas ?></td>
                                    </tr>
                                    <tr>
                                        <td width="130px">Nomor HP</td>
                                        <td width="10px">:</td>
                                        <td><?php echo $hp ?></td>
                                    </tr>
                                    <tr>
                                        <td width="130px">Nominal Bayar</td>
                                        <td width="10px">:</td>
                                        <td><?php echo $spp ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/.col-->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Pembayaran</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <form method="POST" action="cetakstruk.php" target="_blank">
                                    <div class="input-group mb-2">
                                        <input type="date" name="tanggalcetak" placeholder="Masukkan Tanggal..." class="form-control" value="<?php echo date("Y-m-d"); ?>" max="<?php echo date("Y-m-d"); ?>">
                                        <input type="hidden" name="nisn" value="<?php echo $nisn ?>">
                                        <input type="hidden" name="nama" value="<?php echo $nama ?>">
                                        <div class="input-group-btn"><button class="btn btn-secondary" name="cetakstruk"><i class="fa fa-print"></i> Buat Struk</button></div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-6 mb-4"></div>
                            <form method="POST" action="">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="date" name="tanggal" class="form-control" placeholder="Tanggal Bayar..." value="<?php echo date("Y-m-d"); ?>" max="<?php echo date("Y-m-d"); ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select name="bulan" class="form-control" required>
                                            <option value="">Untuk Pembayaran...</option>
                                            <option value="Januari">Januari</option>
                                            <option value="Februari">Februari</option>
                                            <option value="Maret">Maret</option>
                                            <option value="April">April</option>
                                            <option value="Mei">Mei</option>
                                            <option value="Juni">Juni</option>
                                            <option value="Juli">Juli</option>
                                            <option value="Agustus">Agustus</option>
                                            <option value="September">September</option>
                                            <option value="Oktober">Oktober</option>
                                            <option value="November">November</option>
                                            <option value="Desember">Desember</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="tahun" value="<?php echo date("Y"); ?>">
                                    </div>
                                </div>
                                <div class="col-md-2 mb-5">
                                    <button class="btn btn-primary" name="btnSubmit"><i class="fa fa-money"></i> Bayar SPP</button>
                                </div>
                            </form>
                            <div class="col-md-12">
                                <?php if (!empty($_SESSION['success'])) { ?>
                                    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show" id="hide-alert">
                                        <?php echo $_SESSION['success']; ?><br>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php unset($_SESSION['success']);
                                } ?>
                                <?php if (!empty($_SESSION['errorMsgTambah'])) { ?>
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <h4>Gagal Ditambah !</h4>
                                        <?php echo $_SESSION['errorMsgTambah']; ?><br>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php unset($_SESSION['errorMsgTambah']);
                                } ?>
                                <?php if (!empty($_SESSION['errorMsgHapus'])) { ?>
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <h4>Gagal Dihapus !</h4>
                                        <?php echo $_SESSION['errorMsgHapus']; ?><br>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php unset($_SESSION['errorMsgHapus']);
                                } ?>
                                <?php if (!empty($_SESSION['errorMsgTransaksi'])) { ?>
                                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        <h4>Pembayaran tidak dapat dilakukan !</h4>
                                        <?php echo $_SESSION['errorMsgTransaksi']; ?><br>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php unset($_SESSION['errorMsgTransaksi']);
                                } ?>
                                <table id="tabelbayar" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Siswa</th>
                                            <th>Petugas Bayar</th>
                                            <th>Tanggal Transaksi</th>
                                            <th>Untuk Pembayaran</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($d = mysqli_fetch_array($data)) { ?>
                                            <tr>
                                                <td align="center"></td>
                                                <td><?php echo $d['nama']; ?></td>
                                                <td><?php echo $d['nama_petugas']; ?></td>
                                                <td><?php echo $d['tgl_bayar']; ?></td>
                                                <td><?php echo $d['bulan_dibayar'] . " "; ?><?php echo $d['tahun_dibayar']; ?></td>
                                                <td>
                                                    <?php if ($d['status'] == 'Lunas') { ?><span class="badge badge-success">Lunas</span><?php } ?>
                                                    <?php if ($d['status'] == 'Belum Bayar') { ?><span class="badge badge-danger">Belum Bayar</span><?php } ?>
                                                </td>
                                                <td align="center" style="min-width: 90px;">
                                                    <?php if ($d['status'] == "Lunas") { ?>
                                                        <a href="editbayar.php?id=<?php echo $d['id_pembayaran'] ?>" role="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Batalkan Transaksi" onclick="return confirm('Apakah anda yakin ingin membatalkan transaksi ini?')"><i class="fa fa-times"></i></a>
                                                        <a href="deletebayar.php?id=<?php echo $d['id_pembayaran'] ?>" role="button" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Hapus Transaksi" onclick="return confirm('Apakah anda yakin ingin mengapus data ini?')"><i class="fa fa-trash"></i></a>
                                                    <?php } else { ?>
                                                        <a href="ulangbayar.php?id=<?php echo $d['id_pembayaran'] ?>" role="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Bayar Ulang"><i class="fa fa-money"></i></a>
                                                        <a href="deletebayar.php?id=<?php echo $d['id_pembayaran'] ?>" role="button" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Hapus Transaksi" onclick="return confirm('Apakah anda yakin ingin mengapus data ini?')"><i class="fa fa-trash"></i></a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/.col-->
        </div>
    <?php } ?>
    <!--/.row-->

</div> <!-- .content -->
</div><!-- /#right-panel -->

<!-- Right Panel -->

<?php
ob_flush();
include('include/footer.php')
?>
<?php include('include/js.php') ?>
<script src="assets/js/buat/bayar.js"></script>
<?php include('include/closetag.php') ?>