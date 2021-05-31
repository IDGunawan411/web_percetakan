<?php include "../koneksi.php";
date_default_timezone_set("Asia/Jakarta");
function tgl($tanggal)
{
    $bulan_arr    = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    // $hari_arr     = ['', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

    $ex           = explode('-', $tanggal);
    $hari         = date('N', strtotime($tanggal));
    $tanggal_indo = $ex[2] . ' ' . $bulan_arr[(int)$ex[1]] . ' ' . $ex[0];

    return $tanggal_indo;
}
function rupiah($angka)
{
    $hasil_rupiah = "Rp. " . number_format($angka, 0, '', '.');
    return $hasil_rupiah;
}
?>
<!-- <script> window.print();</script> -->
<!-- Font Awesome -->
<link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<!-- SweetAlert2 -->
<link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<!-- Toastr -->
<link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<!-- select2 -->
<link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="../dist/css/adminlte.min.css">
<!-- Content Wrapper. Contains page content -->
<style>
    .borderless td, .borderless th {
        border: none;
    }
    body{ 
      font-family:Arial, Helvetica, sans-serif;
      /* font-family: sans-serif; */
    }
</style>
<script>window.print()</script>

<div class="container p-2">
    <div class="card">
        <div class="card-body table-responsive">
            <hr>
            <div class="invoice p-3">
                <div class="col-md-12 text-center">  
                    <h4>Laporan Transakasi</h4>
                </div>
            </div>
            <hr>
            <div class="col-md-6">
                <table class="table borderless">
                    <?php
                        $con  = mysqli_query($koneksi,"SELECT * FROM konfigurasi where id_konfigurasi = '1'");
                        $dcon = mysqli_fetch_array($con);
                    ?>
                    <tr>
                        <th>Nama Perusahaan</th>
                        <td>: <?= $dcon['isi_konfigurasi']; ?></td>
                    </tr>
                    <tr>
                        <th>Nama Laporan</th>
                        <td>: Laporan Transaksi Penjualan</td>
                    </tr>
                    <tr>
                        <th>Tanggal Laporan</th>
                        <td>: <?= tgl($_GET['dfrom']); ?> s/d <?= tgl($_GET['dto']); ?></td>
                    </tr>
                </table>
            </div>
            <table class="table table-bordered table-hover fixed nowrap">
                <tr>
                    <th>No</th>
                    <th>ID Transaksi</th>
                    <th>ID Customer</th>
                    <th>Nama Customer</th>
                    <th>Tanggal</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                </tr>
                <tbody>
                <?php
                    $no = 1;
                    $total_tr = 0;
                    $total_bn = 0;                    
                    $qtr = mysqli_query($koneksi, "SELECT * FROM laporan_transaksi 
                    WHERE tanggal_transaksi BETWEEN '$_GET[dfrom]' AND '$_GET[dto]'");
                    while($dtr=mysqli_fetch_array($qtr)){ 
                        $total_tr = (int)$total_tr + (int)$dtr['total_transaksi'];
                        $total_bn = (int)$total_bn + (int)$dtr['jumlah_transaksi'];
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $dtr['id_transaksi']; ?></td>  
                        <td><?= $dtr['id_customer']; ?></td>
                        <td><?= $dtr['nama_customer']; ?></td>  
                        <td><?= tgl($dtr['tanggal_transaksi']); ?></td>  
                        <td><?= $dtr['jumlah_transaksi'] == NULL ? '-' : $dtr['jumlah_transaksi']; ?></td>  
                        <td><?= $dtr['total_transaksi'] == NULL ? '-' : rupiah($dtr['total_transaksi']); ?></td>
                    </tr>
                    <?php } ?>
                    <tr><td colspan="7">&nbsp;</td></tr>

                    <tr>
                        <td colspan="6"><strong>Total Jumlah</strong></td>
                        <td><strong><?= $total_bn; ?></strong></td>
                    </tr>
                    <tr>
                        <td colspan="6"><strong>Total Penjualan</strong></td>
                        <td><strong><?= rupiah($total_tr); ?></strong></td>
                    </tr>
                </tbody>
            </table>
        </div> 
    </div>
</div>
