<?php
session_start();
if($_SESSION['status']!="login"){
	echo "<script>window.location.href='index.php?pesan=belum_login';</script>";
}
ob_start();
require('koneksi.php');
$title = 'Bayar SPP';
$page = 'Tambah Siswa';
include('include/header.php');
$querykelas = mysqli_query($koneksi, "select * from kelas");
$queryspp = mysqli_query($koneksi, "select * from spp");
$nisnErr = $nisErr = $namaErr = $kelasErr = $alamatErr = $sppErr = $fotoErr = "";
$nisn = $nis = $nama = $kelas = $alamat = $hp = $spp = $foto = "";
if (isset($_POST['btnSubmit'])) {
    if (empty($_POST["nisn"])) {
        $nisnErr = "NISN Masih Kosong !";
    } else if (strlen($_POST['nisn']) > 10) {
        $nisnErr = "NISN Tidak Boleh lebih dari 10 karakter !";
        $hapusSpasi = str_replace(' ', '', $_POST["nisn"]);
        $nisn = $hapusSpasi;
    } else {
        $hapusSpasi = str_replace(' ', '', $_POST["nisn"]);
        $nisn = $hapusSpasi;
    }

    if (empty($_POST["nis"])) {
        $nisErr = "NIS Masih Kosong !";
    } else if (strlen($_POST['nis']) > 8) {
        $nisErr = "NIS Tidak Boleh lebih dari 8 karakter !";
        $hapusSpasi = str_replace(' ', '', $_POST["nis"]);
        $nis = $hapusSpasi;
    } else {
        $hapusSpasi = str_replace(' ', '', $_POST["nis"]);
        $nis = $hapusSpasi;
    }

    if (empty($_POST["nama"])) {
        $namaErr = "Nama Lengkap Masih Kosong !";
    } else if (strlen($_POST['nama']) > 35) {
        $namaErr = "Nama Lengkap Tidak Boleh lebih dari 35 karakter !";
        $nama = $_POST["nama"];
    } else {
        $nama = $_POST["nama"];
    }

    if (empty($_POST["kelas"])) {
        $kelasErr = "Kelas Belum Dipilih !";
    } else {
        $kelas = $_POST["kelas"];
    }

    if (empty($_POST["alamat"])) {
        $alamatErr = "Alamat Masih Kosong !";
    } else {
        $alamat = $_POST["alamat"];
    }

    $hp = $_POST['hp'];

    if (empty($_POST["spp"])) {
        $sppErr = "Nominal Bayar Belum Dipilih !";
    } else {
        $spp = $_POST["spp"];
    }

    $foto = $_FILES["foto"]["name"];
    $ukuran_gambar = $_FILES['foto']['size'];
    $ukuran = 1000000;
    if (!empty($_FILES["foto"]["name"])) {
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
            }
        }
    } else {
        $foto = "default.png";
    }

    if ($nisnErr == '' && $nisErr == '' && $namaErr == '' && $kelasErr == '' && $alamatErr == '' && $sppErr == '' && $fotoErr == '') {
        $result = mysqli_query($koneksi, "insert into siswa values('$nisn','$nis','$nama','$kelas','$alamat','$hp','$spp','$foto')");
        if (!$result) {
            $msgErr = $koneksi->error;
            $_SESSION['errorMsgTambah'] = $msgErr;
            echo "<script>window.location.href='siswa.php';</script>";
            exit;
        } else {
            $target = "Foto/siswa/" . basename($_FILES["foto"]["name"]);
            move_uploaded_file($_FILES["foto"]["tmp_name"], $target);
            $_SESSION['success'] = 'Data Berhasil Ditambah';
            echo "<script>window.location.href='siswa.php';</script>";
            exit;
        }
    }
}
?>
<div class="content mt-3">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <button class="btn btn-primary mb-2" id="kembalisiswa"><i class="fa fa-arrow-left"></i> Kembali</button>
            <div class="card">
                <div class="card-header text-white bg-danger">
                    <strong>Tambah Siswa</strong>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nisn" class="control-label mb-1">NISN :</label>
                            <input name="nisn" type="text" class="form-control" value="<?php echo $nisn ?>">
                            <?php if ($nisnErr != "") { ?>
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <?php echo $nisnErr; ?><br>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label for="nis" class="control-label mb-1">NIS :</label>
                            <input name="nis" type="text" class="form-control" value="<?php echo $nis ?>">
                            <?php if ($nisErr != "") { ?>
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <?php echo $nisErr; ?><br>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label for="nama" class="control-label mb-1">Nama Lengkap :</label>
                            <input name="nama" type="text" class="form-control" value="<?php echo $nama ?>">
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
                            <label for="kelas" class="control-label mb-1">Kelas :</label>
                            <select name="kelas" data-placeholder="Pilih Kelas..." class="standardSelect form-control" tabindex="1">
                                <option value=""></option>
                                <?php
                                while ($d = mysqli_fetch_array($querykelas)) {
                                ?>
                                    <option value="<?php echo $d['id_kelas'] ?>" <?php if ($d['id_kelas'] == $kelas) {
                                                                                        echo "selected='selected'";
                                                                                    } ?>><?php echo $d['nama_kelas'] ?> - <?php echo $d['id_kelas'] ?></option>
                                <?php } ?>
                            </select>
                            <?php if ($kelasErr != "") { ?>
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <?php echo $kelasErr; ?><br>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label for="alamat" class="control-label mb-1">Alamat :</label>
                            <textarea name="alamat" class="form-control"><?php echo $alamat ?></textarea>
                            <?php if ($alamatErr != "") { ?>
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <?php echo $alamatErr; ?><br>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label for="hp" class="control-label mb-1">Nomor Handphone :</label>
                            <input name="hp" type="tel" placeholder="Isikan 11 sampai 13 nomor" pattern="[0-9]{11,13}" class="form-control" value="<?php echo $hp ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="spp" class="control-label mb-1">Nominal Bayar SPP 1 Bulan :</label>
                            <select name="spp" data-placeholder="Pilih Nominal Bayar..." class="standardSelect form-control" tabindex="1">
                                <option value=""></option>
                                <?php
                                while ($d = mysqli_fetch_array($queryspp)) {
                                ?>
                                    <option value="<?php echo $d['id_spp'] ?>" <?php if ($d['id_spp'] == $spp) {
                                                                                        echo "selected='selected'";
                                                                                    } ?>>Tahun Ajaran : <?php echo $d['tahun'] ?> - Rp. <?php echo $d['nominal'] ?></option>
                                <?php } ?>
                            </select>
                            <?php if ($sppErr != "") { ?>
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <?php echo $sppErr; ?><br>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label for="foto" class="control-label mb-1">Foto : *Max 1 MB</label><br>
                            <img class="mb-1" style="max-width: 200px" id="blah" src="Foto/siswa/default.png" alt="your image" />
                            <input name="foto" id="foto" type="file" class="form-control-file mb-1">
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
<script src="assets/js/buat/siswa.js"></script>
<?php include('include/closetag.php') ?>