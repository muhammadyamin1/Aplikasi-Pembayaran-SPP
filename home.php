<?php
session_start();
if($_SESSION['status']!="login"){
	echo "<script>window.location.href='index.php?pesan=belum_login';</script>";
}
require('koneksi.php');
$title = 'Bayar SPP';
$page = 'Dashboard';
include('include/header.php');
$query1 = mysqli_query($koneksi, 'select * from kelas');
$query2 = mysqli_query($koneksi, "select * from petugas where level='petugas'");
$query3 = mysqli_query($koneksi, 'select * from siswa');
$query4 = mysqli_query($koneksi, "select * from pembayaran where status='Lunas'");
$kelas = mysqli_num_rows($query1);
$petugas = mysqli_num_rows($query2);
$siswa = mysqli_num_rows($query3);
$transaksi = mysqli_num_rows($query4);

$bulan1 = mysqli_query($koneksi, "SELECT SUM(jumlah_bayar) FROM pembayaran WHERE bulan_dibayar = 'Januari'");
while ($d = mysqli_fetch_array($bulan1)) {
    $Januari = $d['SUM(jumlah_bayar)'];
}$bulan2 = mysqli_query($koneksi, "SELECT SUM(jumlah_bayar) FROM pembayaran WHERE bulan_dibayar = 'Februari'");
while ($d = mysqli_fetch_array($bulan2)) {
    $Februari = $d['SUM(jumlah_bayar)'];
}$bulan3 = mysqli_query($koneksi, "SELECT SUM(jumlah_bayar) FROM pembayaran WHERE bulan_dibayar = 'Maret'");
while ($d = mysqli_fetch_array($bulan3)) {
    $Maret = $d['SUM(jumlah_bayar)'];
}$bulan4 = mysqli_query($koneksi, "SELECT SUM(jumlah_bayar) FROM pembayaran WHERE bulan_dibayar = 'April'");
while ($d = mysqli_fetch_array($bulan4)) {
    $April = $d['SUM(jumlah_bayar)'];
}$bulan5 = mysqli_query($koneksi, "SELECT SUM(jumlah_bayar) FROM pembayaran WHERE bulan_dibayar = 'Mei'");
while ($d = mysqli_fetch_array($bulan5)) {
    $Mei = $d['SUM(jumlah_bayar)'];
}$bulan6 = mysqli_query($koneksi, "SELECT SUM(jumlah_bayar) FROM pembayaran WHERE bulan_dibayar = 'Juni'");
while ($d = mysqli_fetch_array($bulan6)) {
    $Juni = $d['SUM(jumlah_bayar)'];
}$bulan7 = mysqli_query($koneksi, "SELECT SUM(jumlah_bayar) FROM pembayaran WHERE bulan_dibayar = 'Juli'");
while ($d = mysqli_fetch_array($bulan7)) {
    $Juli = $d['SUM(jumlah_bayar)'];
}$bulan8 = mysqli_query($koneksi, "SELECT SUM(jumlah_bayar) FROM pembayaran WHERE bulan_dibayar = 'Agustus'");
while ($d = mysqli_fetch_array($bulan8)) {
    $Agustus = $d['SUM(jumlah_bayar)'];
}$bulan9 = mysqli_query($koneksi, "SELECT SUM(jumlah_bayar) FROM pembayaran WHERE bulan_dibayar = 'September'");
while ($d = mysqli_fetch_array($bulan9)) {
    $September = $d['SUM(jumlah_bayar)'];
}$bulan10 = mysqli_query($koneksi, "SELECT SUM(jumlah_bayar) FROM pembayaran WHERE bulan_dibayar = 'Oktober'");
while ($d = mysqli_fetch_array($bulan10)) {
    $Oktober = $d['SUM(jumlah_bayar)'];
}$bulan11 = mysqli_query($koneksi, "SELECT SUM(jumlah_bayar) FROM pembayaran WHERE bulan_dibayar = 'November'");
while ($d = mysqli_fetch_array($bulan11)) {
    $November = $d['SUM(jumlah_bayar)'];
}$bulan12 = mysqli_query($koneksi, "SELECT SUM(jumlah_bayar) FROM pembayaran WHERE bulan_dibayar = 'Desember'");
while ($d = mysqli_fetch_array($bulan12)) {
    $Desember = $d['SUM(jumlah_bayar)'];
}
?>
<div class="content mt-3">
    <div class="row">
        <?php if($_SESSION['status'] == "login"){?>
        <div class="col-md-12">
            <div class="alert  alert-success alert-dismissible fade show" role="alert">
                <span class="badge badge-pill badge-success">Sukses Login</span> Selamat Datang <strong><?php echo $_SESSION['pengguna'] ?></strong> sebagai <?php echo $_SESSION['level'] ?> pada Aplikasi Pembayaran SPP
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        <?php } ?>
        <!--/.col-->

        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-one">
                        <div class="stat-icon dib"><i class="fa fa-sign-in text-danger border-danger"></i></div>
                        <div class="stat-content dib">
                            <div class="stat-text">Jumlah Kelas</div>
                            <div class="stat-digit"><?php echo $kelas ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-one">
                        <div class="stat-icon dib"><i class="fa fa-users text-warning border-warning"></i></div>
                        <div class="stat-content dib">
                            <div class="stat-text">Petugas</div>
                            <div class="stat-digit"><?php echo $petugas ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-one">
                        <div class="stat-icon dib"><i class="fa fa-male text-info border-info"></i></div>
                        <div class="stat-content dib">
                            <div class="stat-text">Total Siswa</div>
                            <div class="stat-digit"><?php echo $siswa ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-one">
                        <div class="stat-icon dib"><i class="ti-check-box text-success border-success"></i></div>
                        <div class="stat-content dib">
                            <div class="stat-text">Bayar Sukses</div>
                            <div class="stat-digit"><?php echo $transaksi ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if($_SESSION['level'] == "admin"){?>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-3">Total Perkiraan Pemasukan SPP Tahun <?php echo date("Y"); ?></h4>
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    <!--/.row-->

</div> <!-- .content -->
</div><!-- /#right-panel -->

<!-- Right Panel -->

<?php include('include/footer.php');?>
<?php include('include/js.php');?>
<script type="text/javascript">

var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
        datasets: [{
            label: 'Sebanyak',
            data: [<?php echo $Januari ?>, <?php echo $Februari ?>, <?php echo $Maret ?>, <?php echo $April ?>, <?php echo $Mei ?>, <?php echo $Juni ?>, <?php echo $Juli ?>, <?php echo $Agustus ?>, <?php echo $September ?>, <?php echo $Oktober ?>, <?php echo $November ?>, <?php echo $Desember ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>

<?php include('include/closetag.php');?>