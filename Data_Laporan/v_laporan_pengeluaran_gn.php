<?php if($_GET['dfrom'] == NULL || $_GET['dto'] == NULL) {
    header('location:v_laporan_pengeluaran.php?ps=masukan_tgl');
}else{ ?>
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
                        <h4>Laporan Pengeluaran</h4>
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
                            <td>: Laporan Pengeluaran</td>
                        </tr>
                        <tr>
                            <th>Tanggal Laporan</th>
                            <td>: <?= tgl($_GET['dfrom']); ?> s/d <?= tgl($_GET['dto']); ?></td>
                        </tr>
                    </table>
                </div>
                <table class="table table-bordered table-hover fixed nowrap">
                    <tr>
                        <th width="10px">No</th>
                        <th>Jenis Bahan</th>
                        <th>Qty</th>
                        <th>Tanggal Transaksi</th>
                        <th>Total Pengeluaran</th>
                    </tr>
                    <tbody>
                    <?php
                        $lpp = mysqli_query($koneksi, "SELECT * FROM laporan_pengeluaran
                        where tanggal_transaksi BETWEEN '$_GET[dfrom]' AND '$_GET[dto]'");
                        $no = 1;
                        $total_pr  = 0;
                        $total_qty = 0;
                        while($dtr=mysqli_fetch_array($lpp)){ 
                            $total_pr = (int)$total_pr + (int)$dtr['total_pengeluaran'];
                            $total_qty = (int)$total_qty + (int)$dtr['qty'];
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $dtr['nama_bahan']; ?></td>  
                            <td><?= $dtr['qty']; ?></td>
                            <td><?= tgl($dtr['tanggal_transaksi']); ?></td>
                            <td><?= rupiah($dtr['total_pengeluaran']); ?></td>
                        </tr>
                        <?php } ?>
                        <tr><td colspan="5">&nbsp;</td></tr>
                        <tr>
                            <td colspan="4"><strong>Total Qty</strong> </td>
                            <td><strong><?= $total_qty; ?></strong></td>
                        </tr>
                        <tr>
                            <td colspan="4"><strong>Total Pengeluaran</strong> </td>
                            <td><strong><?= rupiah($total_pr); ?></strong></td>
                        </tr>
                    </tbody>
                </table>
            </div> 
        </div>
    </div>
<?php } ?>