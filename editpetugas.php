<?php
session_start();
if($_SESSION['status']!="login"){
	echo "<script>window.location.href='index.php?pesan=belum_login';</script>";
}
ob_start();
require('koneksi.php');
$title = 'Bayar SPP';
$page = 'Edit Pengguna';
include('include/header.php');
$namaErr = $userErr = $passoldErr = $passErr = $konpassErr = $levelErr = $fotoErr = "";
$nama = $user = $passold = $pass = $konpass = $level = $foto = "";
if (isset($_POST['btnSubmit'])) {
    $idget = $_GET['id'];
    $query = mysqli_query($koneksi, "select * from petugas where id_petugas = '$idget'");
    while ($d = mysqli_fetch_array($query)) {
        $passold = $d['password'];
    }

    $x = $_POST['x'];

    if (empty($_POST["namapetugas"])) {
        $namaErr = "Nama Pengguna Masih Kosong !";
    } else if (strlen($_POST['namapetugas']) > 35) {
        $namaErr = "Nama Pengguna Tidak Boleh lebih dari 35 karakter !";
        $nama = $_POST["namapetugas"];
    } else {
        $nama = $_POST["namapetugas"];
    }

    if (empty($_POST["user"])) {
        $userErr = "Username Masih Kosong !";
    } else if (strlen($_POST['user']) > 25) {
        $userErr = "Username Tidak Boleh lebih dari 25 karakter !";
        $user = $_POST["user"];
    } else {
        $user = $_POST["user"];
    }

    if (!empty($_POST["pass"])) {
        if ($passold != sha1($_POST['passold'])) {
            $passoldErr = "Password Lama anda tidak sesuai !";
        }
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
        $konpassErr = "Password Baru Tidak Sesuai !";
    }

    if (empty($_POST["level"])) {
        $levelErr = "Level Belum Dipilih !";
    } else {
        $level = $_POST["level"];
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


    if ($namaErr == '' && $userErr == '' && $passoldErr == "" && $passErr == '' && $konpassErr == '' && $levelErr == '' && $fotoErr == '') {
        if (!empty($_POST["pass"])) {
            $result = mysqli_query($koneksi, "update petugas set username = '$user', password = '" . sha1($pass) . "', nama_petugas = '$nama', level = '$level', photo = '$foto' WHERE id_petugas = '$idget'");
        } else {
            $result = mysqli_query($koneksi, "update petugas set username = '$user', nama_petugas = '$nama', level = '$level', photo = '$foto' WHERE id_petugas = '$idget'");
        }
        if (!$result) {
            $msgErr = $koneksi->error;
            $_SESSION['errorMsgEdit'] = $msgErr;
            echo "<script>window.location.href='petugas.php';</script>";
            exit;
        } else {
            $_SESSION['success'] = 'Data Berhasil Diedit';
            echo "<script>window.location.href='petugas.php';</script>";
            exit;
        }
    }
} else {
    $idget = $_GET['id'];
    $query = mysqli_query($koneksi, "select * from petugas where id_petugas = '$idget'");
    while ($d = mysqli_fetch_array($query)) {
        $nama = $d['nama_petugas'];
        $user = $d['username'];
        $level = $d['level'];
        $foto = $d['photo'];
    }
}
?>
<div class="content mt-3">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <button class="btn btn-primary mb-2" id="kembalipetugas"><i class="fa fa-arrow-left"></i> Kembali</button>
            <div class="card">
                <div class="card-header text-white bg-danger">
                    <strong>Edit Pengguna</strong>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=" . $idget); ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="namapetugas" class="control-label mb-1">Nama Pengguna :</label>
                            <input name="namapetugas" type="text" class="form-control" value="<?php echo $nama ?>">
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
                            <label for="user" class="control-label mb-1">Username :</label>
                            <input name="user" type="text" class="form-control" value="<?php echo $user ?>">
                            <?php if ($userErr != "") { ?>
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <?php echo $userErr; ?><br>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label for="passold" class="control-label mb-1">Password Lama :</label>
                            <input name="passold" type="password" class="form-control">
                            <?php if ($passoldErr != "") { ?>
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <?php echo $passoldErr; ?><br>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label for="pass" class="control-label mb-1">Password Baru :</label>
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
                            <label for="konpass" class="control-label mb-1">Masukkan Ulang Password Baru :</label>
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
                            <label for="level" class="control-label mb-1">Level :</label>
                            <select name="level" class="form-control">
                                <option value="">-- Pilih Level --</option>
                                <option value="admin" <?php if ('admin' == $level) {
                                                            echo "selected='selected'";
                                                        } ?>>Admin</option>
                                <option value="petugas" <?php if ('petugas' == $level) {
                                                            echo "selected='selected'";
                                                        } ?>>Petugas</option>
                                <option value="siswa" <?php if ('siswa' == $level) {
                                                            echo "selected='selected'";
                                                        } ?>>Siswa</option>
                            </select>
                            <?php if ($levelErr != "") { ?>
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <?php echo $levelErr; ?><br>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label for="foto" class="control-label mb-1">Foto : *Max 1 MB</label><br>
                            <img class="mb-1" style="max-width: 200px" id="blah" src="Foto/petugas/<?php echo $foto ?>" alt="your image" />
                            <input name="foto" id="foto" type="file" class="form-control-file mb-1">
                            <input type="hidden" name="x" value="<?php echo $foto ?>">
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
<script src="assets/js/buat/petugas.js"></script>
<?php include('include/closetag.php') ?>