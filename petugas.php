<?php
session_start();
if($_SESSION['status']!="login"){
	echo "<script>window.location.href='index.php?pesan=belum_login';</script>";
}
ob_start();
require('koneksi.php');
$title = 'Bayar SPP';
$page = 'Pengguna';
include('include/header.php');
$no = 1;
$data = mysqli_query($koneksi, "SELECT * FROM petugas");
?>
<div class="content mt-3">
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-primary mb-2" id="tambahpetugas"><i class="fa fa-plus"></i> Tambah Pengguna</button>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Data Pengguna</strong>
                </div>
                <div class="card-body">
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
                    <?php if (!empty($_SESSION['errorMsgEdit'])) { ?>
                        <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                            <h4>Gagal Diedit !</h4>
                            <?php echo $_SESSION['errorMsgEdit']; ?><br>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php unset($_SESSION['errorMsgEdit']);
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
                    <table id="tabelpetugas" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Foto</th>
                                <th>Username</th>
                                <th>Nama Pengguna</th>
                                <th>Level</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($d = mysqli_fetch_array($data)) { ?>
                                <tr>
                                    <td align="center" style="vertical-align: middle"></td>
                                    <td align="center" style="vertical-align: middle"><img class="zoom" width="100px" height="130px" src="Foto/petugas/<?php echo $d['photo']; ?>"></td>
                                    <td style="vertical-align: middle"><?php echo $d['username']; ?></td>
                                    <td style="vertical-align: middle"><?php echo $d['nama_petugas']; ?></td>
                                    <td align="center" style="vertical-align: middle">
                                        <?php if ($d['level'] == 'admin') { ?><span class="badge badge-danger">Admin</span><?php } ?>
                                        <?php if ($d['level'] == 'petugas') { ?><span class="badge badge-success">Petugas</span><?php } ?>
                                        <?php if ($d['level'] == 'siswa') { ?><span class="badge badge-primary">Siswa</span><?php } ?>
                                    </td>
                                    <td align="center" style="vertical-align: middle">
                                        <a href="editpetugas.php?id=<?php echo $d['id_petugas'] ?>" role="button" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                        <a href="deletepetugas.php?id=<?php echo $d['id_petugas'] ?>" role="button" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin mengapus data ini?')" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></a>
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
<script src="assets/js/buat/petugas.js"></script>
<?php include('include/closetag.php') ?>