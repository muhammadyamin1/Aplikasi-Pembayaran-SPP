<?php
session_start();
if($_SESSION['status']!="login"){
	echo "<script>window.location.href='index.php?pesan=belum_login';</script>";
}
ob_start();
require('koneksi.php');
$title = 'Bayar SPP';
$page = 'Riwayat';
include('include/header.php');
$no = 1;
$data = mysqli_query($koneksi, "SELECT petugas.id_petugas,petugas.nama_petugas,siswa.nama,pembayaran.tgl_bayar,pembayaran.bulan_dibayar,pembayaran.tahun_dibayar,pembayaran.jumlah_bayar,pembayaran.status FROM pembayaran LEFT JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas LEFT JOIN spp ON pembayaran.id_spp=spp.id_spp LEFT JOIN siswa ON pembayaran.nisn=siswa.nisn WHERE pembayaran.id_petugas='".$_SESSION['id_pengguna']."' ORDER BY id_pembayaran DESC");
?>
<div class="content mt-3">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Riwayat Pembayaran SPP</strong>
                </div>
                <div class="card-body">
                    <table id="tabelriwayat" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Petugas</th>
                                <th>Siswa</th>
                                <th>Tanggal Transaksi</th>
                                <th>Untuk Pembayaran</th>
                                <th>Jumlah Bayar</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($d = mysqli_fetch_array($data)) { ?>
                                <tr>
                                    <td align="center"></td>
                                    <td><?php echo $d['nama_petugas']; ?></td>
                                    <td><?php echo $d['nama']; ?></td>
                                    <td><?php echo $d['tgl_bayar']; ?></td>
                                    <td><?php echo $d['bulan_dibayar'] . " "; ?><?php echo $d['tahun_dibayar']; ?></td>
                                    <td align="right">Rp. <?php echo $d['jumlah_bayar']; ?></td>
                                    <td>
                                        <?php if ($d['status'] == 'Lunas') { ?><span class="badge badge-success">Lunas</span><?php } ?>
                                        <?php if ($d['status'] == 'Belum Bayar') { ?><span class="badge badge-danger">Belum Bayar</span><?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--/.col-->
    </div>
    <!--/.row-->

</div> <!-- .content -->
</div><!-- /#right-panel -->

<!-- Right Panel -->

<?php
ob_flush();
include('include/footer.php')
?>
<?php include('include/js.php') ?>
<script src="assets/js/buat/riwayat.js"></script>
<?php include('include/closetag.php') ?>