<?php
session_start();
if($_SESSION['status']!="login"){
	echo "<script>window.location.href='index.php?pesan=belum_login';</script>";
}
ob_start();
require('koneksi.php');
$title = 'Bayar SPP';
$page = 'Profil Saya';
include('include/header.php');
?>
<div class="content mt-3">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="mx-auto d-block">
                        <img class="rounded-circle mx-auto d-block" height="200px" src="Foto/petugas/<?php echo $_SESSION['foto'] ?>" alt="Card image cap">
                        <h5 class="text-sm-center mt-2 mb-1"><?php echo $_SESSION['pengguna'] ?></h5>
                        <div class="location text-sm-center"><i class="fa fa-users"></i> <?php echo $_SESSION['level'] ?></div>
                        <?php if ($_SESSION['level'] != "siswa") { ?>
                            <div class="text-center">
                                <a href="editprofil.php" role="button" class="btn btn-success mt-2"><i class="fa fa-arrow-right"></i> Edit Profile</a>
                            </div>
                        <?php } ?>
                    </div>
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