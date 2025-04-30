<?php
session_start();
if($_SESSION['status']!="login"){
	echo "<script>window.location.href='index.php?pesan=belum_login';</script>";
}
ob_start();
require('koneksi.php');
$title = 'Bayar SPP';
$page = 'Siswa';
include('include/header.php');
$no = 1;
$data = mysqli_query($koneksi, "SELECT siswa.nisn,siswa.nis,siswa.nama,kelas.nama_kelas,siswa.alamat,siswa.no_telp,spp.nominal,siswa.photo FROM siswa LEFT JOIN kelas ON siswa.id_kelas=kelas.id_kelas LEFT JOIN spp ON siswa.id_spp=spp.id_spp");
?>
<div class="content mt-3">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Data Siswa</strong>
                </div>
                <div class="card-body">
                    <table id="tabelsiswapetugas" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="vertical-align: middle">No</th>
                                <th style="vertical-align: middle">Foto</th>
                                <th style="vertical-align: middle">NISN</th>
                                <th style="vertical-align: middle">NIS</th>
                                <th style="vertical-align: middle">Nama</th>
                                <th style="vertical-align: middle">Kelas</th>
                                <th style="vertical-align: middle">Alamat</th>
                                <th style="vertical-align: middle">No. HP</th>
                                <th style="vertical-align: middle">Nominal Bayar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($d = mysqli_fetch_array($data)) { ?>
                                <tr>
                                    <td align="center" style="vertical-align: middle"></td>
                                    <td align="center" style="vertical-align: middle"><img class="zoom" width="50px" height="65px" src="Foto/siswa/<?php echo $d['photo']; ?>"></td>
                                    <td><?php echo $d['nisn']; ?></td>
                                    <td><?php echo $d['nis']; ?></td>
                                    <td><?php echo $d['nama']; ?></td>
                                    <td><?php echo $d['nama_kelas']; ?></td>
                                    <td><?php echo $d['alamat']; ?></td>
                                    <td><?php echo $d['no_telp']; ?></td>
                                    <td>Rp. <?php echo $d['nominal']; ?></td>
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
<script src="assets/js/buat/siswa.js"></script>
<?php include('include/closetag.php') ?>