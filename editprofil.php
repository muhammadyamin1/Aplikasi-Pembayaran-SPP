<?php
session_start();
if($_SESSION['status']!="login"){
	echo "<script>window.location.href='index.php?pesan=belum_login';</script>";
}
ob_start();
require('koneksi.php');
$title = 'Bayar SPP';
$page = 'Edit Profil';
include('include/header.php');
$nmPenggunaErr = $passErr = $konpassErr = $fotoErr = "";
$nmPengguna = $pass = $konpass = $foto = "";
if (isset($_POST['btnSubmit'])) {
    $x = $_POST['x'];

    if (empty($_POST["nmPengguna"])) {
        $nmPengguna = "Nama Pengguna Masih Kosong !";
    } else if (strlen($_POST['nmPengguna']) > 35) {
        $nmPengguna = "Nama Pengguna Tidak Boleh lebih dari 35 karakter !";
        $nama = $_POST["nmPengguna"];
    } else {
        $nama = $_POST["nmPengguna"];
    }

    if (!empty($_POST["pass"])) {
        if (strlen($_POST['pass']) < 8) {
            $passErr = "Password Tidak Boleh kurang dari 8 karakter !";
            $pass = $_POST["pass"];
        } else if (strlen($_POST['pass']) > 50) {
            $passErr = "Password Tidak Boleh lebih dari 50 karakter !";
            $pass = $_POST["pass"];
        } else {
            $pass = $_POST["pass"];
        }
    }

    if ($_POST["konpass"] != $_POST["pass"]) {
        $konpassErr = "Password Tidak Sesuai !";
    }

    $foto = $_FILES["foto"]["name"];
    $ukuran_gambar = $_FILES['foto']['size'];
    $ukuran = 1000000;
    if (!empty($_FILES["foto"]["name"])) {
        if ($x != "default.png") {
            $img = "Foto/petugas/" . $x;
            @unlink("$img");
        }
        if ($ukuran_gambar >= $ukuran) {
            $fotoErr = "Ukuran gambar tidak boleh lebih dari 1 MB";
        } else {
            $allowed_image_extension = array(
                "png",
                "jpg",
                "jpeg"
            );
            $file_extension = pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);
            if (!in_array($file_extension, $allowed_image_extension)) {
                $fotoErr = "Format yang dibolehkan hanya *.png | *.jpg | *.jpeg";
            } else {
                $target = "Foto/petugas/" . basename($_FILES["foto"]["name"]);
                move_uploaded_file($_FILES["foto"]["tmp_name"], $target);
            }
        }
    } else {
        $foto = $x;
    }

    if ($nmPenggunaErr == "" && $passErr == "" &&  $konpassErr == "" &&  $fotoErr == "") {
        if (!empty($_POST["pass"])) {
            $result = mysqli_query($koneksi, "update petugas set password = '" . sha1($pass) . "', nama_petugas = '$nama', photo = '$foto' WHERE id_petugas = '" . $_SESSION['id_pengguna'] . "'");
        } else {
            $result = mysqli_query($koneksi, "update petugas set nama_petugas = '$nama', photo = '$foto' WHERE id_petugas = '" . $_SESSION['id_pengguna'] . "'");
        }
        if (!$result) {
            echo "Gagal : " . $koneksi->error;
        } else {
            unset($_SESSION['pengguna']);
            unset($_SESSION['foto']);
            $_SESSION['pengguna'] = $nama;
            $_SESSION['foto'] = $foto;
            echo "<script>window.location.href='profil.php';</script>";
            exit;
        }
    }
}
?>
<div class="content mt-3">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <a href="profil.php" role="button" class="btn btn-primary mb-2"><i class="fa fa-arrow-left"></i> Kembali</a>
            <div class="card">
                <div class="card-header text-white bg-danger">
                    <strong>Edit Profil</strong>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nmPengguna" class="control-label mb-1">Nama Pengguna : </label>
                            <input name="nmPengguna" type="text" class="form-control" value="<?php echo $_SESSION['pengguna'] ?>">
                            <?php if ($nmPenggunaErr != "") { ?>
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <?php echo $nmPenggunaErr; ?><br>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label for="pass" class="control-label mb-1">Ubah Password :</label>
                            <input name="pass" type="password" class="form-control" value="<?php echo $pass ?>">
                            <?php if ($passErr != "") { ?>
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <?php echo $passErr; ?><br>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label for="konpass" class="control-label mb-1">Masukkan Ulang Password :</label>
                            <input name="konpass" type="password" class="form-control">
                            <?php if ($konpassErr != "") { ?>
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <?php echo $konpassErr; ?><br>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label for="foto" class="control-label mb-1">Foto : *Max 1 MB</label><br>
                            <img class="mb-1" style="max-width: 200px" id="blah" src="Foto/petugas/<?php echo $_SESSION['foto'] ?>" alt="your image" />
                            <input name="foto" id="foto" type="file" class="form-control-file mb-1">
                            <input type="hidden" name="x" value="<?php echo $_SESSION['foto'] ?>">
                            <?php if ($fotoErr != "") { ?>
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <?php echo $fotoErr; ?><br>
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
<script src="assets/js/buat/profil.js"></script>
<?php include('include/closetag.php') ?>