<?php
session_start();
include('koneksi.php');
$errLogin = '';
if (isset($_POST['btnLogin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // menyeleksi data admin dengan username dan password yang sesuai
    $data = mysqli_query($koneksi, "select * from petugas where username='$username' and password='" . SHA1($password) . "'");
    while ($d = mysqli_fetch_array($data)) {
        $foto = $d['photo'];
        $id_pengguna = $d['id_petugas'];
        $pengguna = $d['nama_petugas'];
        $level = $d['level'];
    }

    // menghitung jumlah data yang ditemukan
    $cek = mysqli_num_rows($data);

    if ($cek > 0) {
        $_SESSION['username'] = $username;
        $_SESSION['foto'] = $foto;
        $_SESSION['id_pengguna'] = $id_pengguna;
        $_SESSION['pengguna'] = $pengguna;
        $_SESSION['level'] = $level;
        $_SESSION['status'] = "login";
        header("location:home.php");
    } else {
        header("location:index.php?pesan=gagal");
    }
}
if (isset($_GET['pesan'])) {
    if ($_GET['pesan'] == "gagal") {
        $errLogin = "<strong>Login gagal !</strong> username atau password salah !";
    } else if ($_GET['pesan'] == "logout") {
        $errLogin = "Anda telah berhasil logout";
    } else if ($_GET['pesan'] == "belum_login") {
        $errLogin = "Anda harus login untuk mengakses Aplikasi ini";
    }
}
?>
<meta name="description" content="Sufee Admin - HTML5 Admin Template">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
<link rel="manifest" href="site.webmanifest">

<link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
<link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
<link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
<link rel="stylesheet" href="vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="vendors/responsivedt/css/responsive.bootstrap4.min.css">

<link rel="stylesheet" href="vendors/chosen/chosen.min.css">
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/login.css">
<div class="container px-4 py-5 mx-auto">
    <div class="card card0">
        <div class="d-flex flex-lg-row flex-column-reverse">
            <div class="card card1">
                <?php if ($errLogin != "") { ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo $errLogin ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <div class="row justify-content-center my-auto">
                    <div class="col-md-8 col-10 my-5">
                        <div class="row justify-content-center px-3 mb-3"> <img height="160px" src="images/bayarspp2-1.png"> </div>
                        <h6 class="msg-info">Silahkan Login</h6>
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div class="form-group"> <label class="form-control-label text-muted">Username</label> <input type="text" id="email" name="username" placeholder="Username anda..." class="form-control" required> </div>
                            <div class="form-group"> <label class="form-control-label text-muted">Password</label> <input type="password" id="psw" name="password" placeholder="Password anda..." class="form-control" required> </div>
                            <div class="row justify-content-center my-3 px-3"> <button class="btn-block btn-color" name="btnLogin">Login</button> </div>
                        </form>
                    </div>
                </div>
                <div class="bottom text-center mb-5">
                    <p href="#" class="sm-text mx-auto mb-3">Belum punya akun? Silahkan hubungi admin untuk membuat akun
                </div>
            </div>
            <div class="card card2">
                <div class="my-auto mx-md-5 px-md-5 right">
                    <h3 class="text-white">Bayar dan lihat riwayat spp jadi semakin mudah</h3> <small class="text-white">Aplikasi yang memudahkan pengelolaan spp berdasarkan basis data yang telah disesuaikan dengan keadaan sesungguhnya</small>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="vendors/jquery/dist/jquery.min.js"></script>
<script src="vendors/popper.js/dist/umd/popper.min.js"></script>
<script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="assets/js/main.js"></script>


<script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="vendors/jszip/dist/jszip.min.js"></script>
<script src="vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="vendors/pdfmake/build/vfs_fonts.js"></script>
<script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="vendors/datatables.net-buttons/js/buttons.colVis.min.js"></script>
<script src="vendors/responsivedt/js/dataTables.responsive.min.js"></script>
<script src="vendors/chart.js/dist/Chart.bundle.min.js"></script>
<script src="vendors/chosen/chosen.jquery.min.js"></script>