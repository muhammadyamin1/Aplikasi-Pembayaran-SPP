<?php
session_start();
if($_SESSION['status']!="login"){
	echo "<script>window.location.href='index.php?pesan=belum_login';</script>";
}
ob_start();
require('koneksi.php');
$title = 'Bayar SPP';
$page = 'Tambah SPP';
include('include/header.php');
$TAErr = $nominalErr = "";
$TA = $nominal = "";
if (isset($_POST['btnSubmit'])) {
    if (empty($_POST["TA"])) {
        $TAErr = "Tahun Ajaran Masih Kosong !";
    } else if (strlen($_POST['TA']) > 15) {
        $TAErr = "Tahun Ajaran Tidak Boleh lebih dari 15 karakter !";
        $TA = $_POST['TA'];
    } else {
        $TA = $_POST['TA'];
    }

    if (empty($_POST["nominal"])) {
        $nominalErr = "Nominal Masih Kosong !";
    } else if (strlen($_POST['nominal']) > 11) {
        $nominalErr = "Nominal Tidak Boleh lebih dari 11 karakter !";
        $nominal = $_POST['nominal'];
    } else {
        $nominal = $_POST['nominal'];
    }

    if ($TAErr == '' && $nominalErr == '') {
        $result = mysqli_query($koneksi, "insert into spp values (NULL,'$TA','$nominal')");
        if (!$result) {
            $msgErr = $koneksi->error;
            $_SESSION['errorMsgTambah'] = $msgErr;
            echo "<script>window.location.href='spp.php';</script>";
            exit;
        } else {
            $_SESSION['success'] = 'Data Berhasil Disimpan';
            echo "<script>window.location.href='spp.php';</script>";
            exit;
        }
    }
}
?>
<div class="content mt-3">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <button class="btn btn-primary mb-2" id="kembalispp"><i class="fa fa-arrow-left"></i> Kembali</button>
            <div class="card">
                <div class="card-header text-white bg-danger">
                    <strong>Tambah SPP</strong>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="form-group">
                            <label for="TA" class="control-label mb-1">Tahun Ajaran : <i>*Contoh : 2020/2021</i></label>
                            <input name="TA" type="text" class="form-control" value="<?php echo $TA ?>">
                            <?php if ($TAErr != "") { ?>
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <?php echo $TAErr; ?><br>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label for="nominal" class="control-label mb-1">Nominal SPP per Bulan :</label>
                            <input name="nominal" type="number" class="form-control" value="<?php echo $nominal ?>">
                            <?php if ($nominalErr != "") { ?>
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <?php echo $nominalErr; ?><br>
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
<script src="assets/js/buat/spp.js"></script>
<?php include('include/closetag.php') ?>