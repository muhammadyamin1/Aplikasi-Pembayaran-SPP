<?php
session_start();
if($_SESSION['status']!="login"){
	echo "<script>window.location.href='index.php?pesan=belum_login';</script>";
}
ob_start();
require('koneksi.php');
$title = 'Bayar SPP';
$page = 'Tambah Kelas';
include('include/header.php');
$queryselect = mysqli_query($koneksi, "select * from kompetensi_keahlian");
$idErr = $namaErr = $keahlianErr = "";
$id = $nama = $keahlian = "";
if (isset($_POST['btnSubmit'])) {
    if (empty($_POST["idkelas"])) {
        $idErr = "ID Kelas Masih Kosong !";
    } else if (strlen($_POST['idkelas']) > 30) {
        $idErr = "ID Kelas Tidak Boleh lebih dari 30 karakter !";
        $hapusSpasi = str_replace(' ', '', $_POST["idkelas"]);
        $id = $hapusSpasi;
    } else {
        $hapusSpasi = str_replace(' ', '', $_POST["idkelas"]);
        $id = $hapusSpasi;
    }

    if (empty($_POST["namakelas"])) {
        $namaErr = "Nama Kelas Masih Kosong !";
    } else if (strlen($_POST['namakelas']) > 10) {
        $namaErr = "Nama Kelas Tidak Boleh lebih dari 10 karakter !";
        $nama = $_POST["namakelas"];
    } else {
        $nama = $_POST["namakelas"];
    }

    if (empty($_POST["keahlian"])) {
        $keahlianErr = "Kompetensi Keahlian Belum Dipilih !";
    } else {
        $keahlian = $_POST["keahlian"];
    }

    if ($idErr == '' && $namaErr == '' && $keahlianErr == '') {
        $result = mysqli_query($koneksi, "insert into kelas values('$id','$nama','$keahlian')");
        if (!$result) {
            $msgErr = $koneksi->error;
            $_SESSION['errorMsgTambah'] = $msgErr;
            echo "<script>window.location.href='kelas.php';</script>";
            exit;
        } else {
            $_SESSION['success'] = 'Data Berhasil Ditambah';
            echo "<script>window.location.href='kelas.php';</script>";
            exit;
        }
    }
}
?>
<div class="content mt-3">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <button class="btn btn-primary mb-2" id="kembalikelas"><i class="fa fa-arrow-left"></i> Kembali</button>
            <div class="card">
                <div class="card-header text-white bg-danger">
                    <strong>Tambah Kelas</strong>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="form-group">
                            <label for="idkelas" class="control-label mb-1">ID Kelas :</label>
                            <input name="idkelas" type="text" class="form-control" value="<?php echo $id ?>">
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
                            <label for="namakelas" class="control-label mb-1">Nama Kelas :</label>
                            <input name="namakelas" type="text" class="form-control" value="<?php echo $nama ?>">
                            <?php if ($namaErr != "") { ?>
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <?php echo $namaErr; ?><br>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label for="keahlian" class="control-label mb-1">Kompetensi Keahlian :</label>
                            <select name="keahlian" data-placeholder="Pilih Kompetensi Keahlian..." class="standardSelect form-control" tabindex="1">
                                <option value=""></option>
                                <?php
                                while ($d = mysqli_fetch_array($queryselect)) {
                                ?>
                                <option value="<?php echo $d['id_kompetensi_keahlian'] ?>" <?php if($d['id_kompetensi_keahlian'] == $keahlian){echo "selected='selected'";} ?>><?php echo $d['nama_kompetensi_keahlian'] ?> - <?php echo $d['id_kompetensi_keahlian'] ?></option>
                                <?php } ?>
                            </select>
                            <?php if ($keahlianErr != "") { ?>
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <?php echo $keahlianErr; ?><br>
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
<script src="assets/js/buat/kelas.js"></script>
<?php include('include/closetag.php') ?>