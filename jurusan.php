<?php
session_start();
if($_SESSION['status']!="login"){
	echo "<script>window.location.href='index.php?pesan=belum_login';</script>";
}
ob_start();
require('koneksi.php');
$title = 'Bayar SPP';
$page = 'Kompetensi Keahlian';
include('include/header.php');
$no = 1;
$data = mysqli_query($koneksi, "select * from kompetensi_keahlian");
?>
<div class="content mt-3">
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-primary mb-2" id="tambahjur"><i class="fa fa-plus"></i> Tambah Kompetensi Keahlian</button>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Data Kompetensi Keahlian</strong>
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
                    <table id="tabeljurusan" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Kompetensi Keahlian</th>
                                <th>Nama Kompetensi Keahlian</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($d = mysqli_fetch_array($data)) { ?>
                                <tr>
                                    <td align="center"></td>
                                    <td align="center"><?php echo $d['id_kompetensi_keahlian']; ?></td>
                                    <td><?php echo $d['nama_kompetensi_keahlian']; ?></td>
                                    <td align="center">
                                        <a href="editjurusan.php?id=<?php echo $d['id_kompetensi_keahlian'] ?>" role="button" class="btn btn-info"><i class="fa fa-edit"></i> Edit</a>
                                        <a href="deletejurusan.php?id=<?php echo $d['id_kompetensi_keahlian'] ?>" role="button" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin mengapus data ini?')"><i class="fa fa-trash"></i> Hapus</a>
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
<script src="assets/js/buat/jurusan.js"></script>
<?php include('include/closetag.php') ?>