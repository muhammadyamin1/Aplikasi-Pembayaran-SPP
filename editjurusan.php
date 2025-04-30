<?php
session_start();
if($_SESSION['status']!="login"){
	echo "<script>window.location.href='index.php?pesan=belum_login';</script>";
}
ob_start();
require('koneksi.php');
$title = 'Bayar SPP';
$page = 'Edit Kompetensi Keahlian';
include('include/header.php');
$namaErr = "";
$nama = "";
if (isset($_POST['btnSubmit'])) {
    $edit_id = $_POST['edit_id'];
    $idget = $_GET['id'];
    $query = mysqli_query($koneksi, "select * from kompetensi_keahlian where id_kompetensi_keahlian = '$idget'");
    while ($d = mysqli_fetch_array($query)) {
        $id = $d['id_kompetensi_keahlian'];
    }
    if (empty($_POST["namajur"])) {
        $namaErr = "Nama Kompetensi Keahlian Masih Kosong !";
    } else if (strlen($_POST['namajur']) > 50) {
        $namaErr = "Nama Kompetensi Keahlian Tidak Boleh lebih dari 50 karakter !";
        $nama = $_POST["namajur"];
    } else {
        $nama = $_POST["namajur"];
    }
    if ($namaErr == '') {
        $result = mysqli_query($koneksi, "update kompetensi_keahlian set nama_kompetensi_keahlian = '$nama' where id_kompetensi_keahlian = '$edit_id'");
        if (!$result) {
            $msgErr = $koneksi->error;
            $_SESSION['errorMsgEdit'] = $msgErr;
            echo "<script>window.location.href='jurusan.php';</script>";
            exit;
        } else {
            $_SESSION['success'] = 'Data Berhasil Diedit';
            echo "<script>window.location.href='jurusan.php';</script>";
            exit;
        }
    }
} else {
    $idget = $_GET['id'];
    $query = mysqli_query($koneksi, "select * from kompetensi_keahlian where id_kompetensi_keahlian = '$idget'");
    while ($d = mysqli_fetch_array($query)) {
        $id = $d['id_kompetensi_keahlian'];
        $nama = $d['nama_kompetensi_keahlian'];
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
                    <strong>Edit Kompetensi Keahlian</strong>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=" . $idget); ?>">
                        <input type="hidden" name="edit_id" value="<?php echo $id ?>">
                        <div class="form-group">
                            <label for="idjur" class="control-label mb-1">ID Kompetensi Keahlian :</label>
                            <input name="idjur" type="text" class="form-control" disabled="disabled" value="<?php echo $id ?>">
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