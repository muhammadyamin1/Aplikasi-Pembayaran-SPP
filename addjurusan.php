<?php
session_start();
if($_SESSION['status']!="login"){
	echo "<script>window.location.href='index.php?pesan=belum_login';</script>";
}
ob_start();
require('koneksi.php');
$title = 'Bayar SPP';
$page = 'Tambah Kompetensi Keahlian';
include('include/header.php');
$idErr = $namaErr = "";
$id = $nama = "";
if (isset($_POST['btnSubmit'])) {
    if (empty($_POST["idjur"])) {
        $idErr = "ID Kompetensi Keahlian Masih Kosong !";
    } else if (strlen($_POST['idjur']) > 11) {
        $idErr = "ID Kompetensi Keahlian Tidak Boleh lebih dari 11 karakter !";
        $hapusSpasi = str_replace(' ', '', $_POST["idjur"]);
        $id = $hapusSpasi;
    } else {
        $hapusSpasi = str_replace(' ', '', $_POST["idjur"]);
        $id = $hapusSpasi;
    }

    if (empty($_POST["namajur"])) {
        $namaErr = "Nama Kompetensi Keahlian Masih Kosong !";
    } else if (strlen($_POST['namajur']) > 50) {
        $namaErr = "Nama Kompetensi Keahlian Tidak Boleh lebih dari 50 karakter !";
        $nama = $_POST["namajur"];
    } else {
        $nama = $_POST["namajur"];
    }

    if ($idErr == '' && $namaErr == '') {
        $result = mysqli_query($koneksi, "insert into kompetensi_keahlian values ('$id','$nama')");
        if (!$result) {
            $msgErr = $koneksi->error;
            $_SESSION['errorMsgTambah'] = $msgErr;
            echo "<script>window.location.href='jurusan.php';</script>";
            exit;
        } else {
            $_SESSION['success'] = 'Data Berhasil Disimpan';
            echo "<script>window.location.href='jurusan.php';</script>";
            exit;
        }
    }
}
?>
<div class="content mt-3">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <button class="btn btn-primary mb-2" id="kembalijur"><i class="fa fa-arrow-left"></i> Kembali</button>
            <div class="card">
                <div class="card-header text-white bg-danger">
                    <strong>Tambah Kompetensi Keahlian</strong>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="form-group">
                            <label for="idjur" class="control-label mb-1">ID Kompetensi Keahlian :</label>
                            <input name="idjur" type="text" class="form-control" value="<?php echo $id ?>">
                            <?php if ($idErr != "") { ?>
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <?php echo $idErr; ?><br>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label for="namajur" class="control-label mb-1">Nama Kompetensi Keahlian :</label>
                            <input name="namajur" type="text" class="form-control" value="<?php echo $nama ?>">
                            <?php if ($namaErr != "") { ?>
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <?php echo $namaErr; ?><br>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php } ?>
                        </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary float-right" name="btnSubmit">Submit</button>
                </div>
                </form>
            </div>
        </div>
        <div class="col-md-2">

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