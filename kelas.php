<?php
session_start();
if($_SESSION['status']!="login"){
	echo "<script>window.location.href='index.php?pesan=belum_login';</script>";
}
ob_start();
require('koneksi.php');
$title = 'Bayar SPP';
$page = 'Kelas';
include('include/header.php');
$no = 1;
$data = mysqli_query($koneksi, "SELECT kelas.id_kelas,kelas.nama_kelas,kompetensi_keahlian.nama_kompetensi_keahlian FROM kelas INNER JOIN kompetensi_keahlian ON kelas.id_kompetensi_keahlian=kompetensi_keahlian.id_kompetensi_keahlian");
?>
<div class="content mt-3">
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-primary mb-2" id="tambahkelas"><i class="fa fa-plus"></i> Tambah Kelas</button>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Data Kelas</strong>
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
                    <table id="tabelkelas" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Kelas</th>
                                <th>Nama Kelas</th>
                                <th>Nama Kompetensi Keahlian</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($d = mysqli_fetch_array($data)) { ?>
                                <tr>
                                    <td align="center"></td>
                                    <td align="center"><?php echo $d['id_kelas']; ?></td>
                                    <td><?php echo $d['nama_kelas']; ?></td>
                                    <td><?php echo $d['nama_kompetensi_keahlian']; ?></td>
                                    <td align="center">
                                        <a href="editkelas.php?id=<?php echo $d['id_kelas'] ?>" role="button" class="btn btn-info"><i class="fa fa-edit"></i> Edit</a>
                                        <a href="deletekelas.php?id=<?php echo $d['id_kelas'] ?>" role="button" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin mengapus data ini?')"><i class="fa fa-trash"></i> Hapus</a>
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
<script src="assets/js/buat/kelas.js"></script>
<?php include('include/closetag.php') ?>