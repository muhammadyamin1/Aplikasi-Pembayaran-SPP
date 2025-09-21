<?php
session_start();
require('koneksi.php');
require_once("vendor/autoload.php");
require('config_struk.php');
use Dompdf\Dompdf;
$dompdf = new Dompdf();
date_default_timezone_set('Asia/Jakarta');
if (isset($_POST['cetakstruk'])) {
    $cetakstruk = $_POST['tanggalcetak']; $tanggal_cetak = date("d-m-Y", strtotime($cetakstruk));
    $nisn = $_POST['nisn'];
    $nama = $_POST['nama'];
    $datastruk = mysqli_query($koneksi, "SELECT pembayaran.id_pembayaran,petugas.nama_petugas,pembayaran.nisn,siswa.nama,pembayaran.tgl_bayar,pembayaran.bulan_dibayar,pembayaran.tahun_dibayar,pembayaran.status,spp.nominal FROM pembayaran LEFT JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas LEFT JOIN spp ON pembayaran.id_spp=spp.id_spp LEFT JOIN siswa ON pembayaran.nisn=siswa.nisn WHERE tgl_bayar = '$cetakstruk' and pembayaran.nisn = '$nisn'");
    $total = mysqli_query($koneksi, "SELECT SUM(nominal) FROM pembayaran LEFT JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas LEFT JOIN spp ON pembayaran.id_spp=spp.id_spp LEFT JOIN siswa ON pembayaran.nisn=siswa.nisn WHERE tgl_bayar = '$cetakstruk' and pembayaran.nisn = '$nisn'");
    while ($d = mysqli_fetch_array($total)) {
        $totalbayar = $d['SUM(nominal)'];
    }
}
$html = '
<table width="100%">
    <tr>
        <td align="center"><img height="80px" src="'.$logo_kiri.'"></td>
        <td align="center"><h2>'.$alamat_sekolah.'<br>'.$nama_sekolah.'</h2></td>
        <td align="center"><img height="80px" src="'.$logo_kanan.'"></td>
    </tr>
</table><hr/>
<font face="helvetica" size="17px">Berikut merupakan laporan pembayaran SPP untuk siswa dengan nama '.$nama.' dan NISN '.$nisn.' tanggal '.$tanggal_cetak.' :</font><br><br>
<table border="1" width="100%" cellspacing="0" cellpadding="2">
    <tr>
        <th align="center">No</th>
        <th align="center">Siswa</th>
        <th align="center">Petugas Bayar</th>
        <th align="center">Tanggal Transaksi</th>
        <th align="center">Untuk Pembayaran</th>
        <th align="center">Status</th>
        <th align="center">Jumlah Bayar</th>
    </tr>
';
$no=1;
while ($d = mysqli_fetch_array($datastruk)) {
$html .= '
    <tr>
        <td align="center">'.$no++.'</td>
        <td>'.$d["nama"].'</td>
        <td>'.$d["nama_petugas"].'</td>
        <td align="center">'.$d["tgl_bayar"].'</td>
        <td>'.$d["bulan_dibayar"].' '.$d["tahun_dibayar"].'</td>
        <td>'.$d["status"].'</td>
        <td>Rp. '.$d["nominal"].'</td>
    </tr>
';
}
$html .= '
    <tr>
        <td align="center" colspan="6"><b>Jumlah</b></td>
        <td><b>Rp. '.$totalbayar.'</b></td>
    </tr>
';
$html .= '
</table><br><br>
<table width = 100%>
    <tr>
        <td width="75%"></td>
        <td>Medan, '.date("d-m-Y").'<br>Petugas SPP<br><br><br><br><br><b><u>'.$_SESSION['pengguna'].'</u></b></td>
    </tr>
</table>
</html>';
$dompdf->loadHtml($html);
$dompdf->set_option('isRemoteEnabled',true);
// Setting ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'potrait');
// Rendering dari HTML Ke PDF
$dompdf->render();
// Melakukan output file Pdf
$dompdf->stream('laporan_pembayaran_spp.pdf',array('Attachment'=>0));
?>