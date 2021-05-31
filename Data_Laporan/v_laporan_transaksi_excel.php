<?php if($_GET['dfrom'] == NULL || $_GET['dto'] == NULL) {
    header('location:v_laporan_transaksi.php?ps=masukan_tgl');
}else{ ?>
    <?php include "../koneksi.php";
    $namafile = "Laporan_Transaksi_$_GET[dfrom]_$_GET[dto]";
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=$namafile.xls");
    
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
 
    <table class="table" border="1">
        <?php
            $con  = mysqli_query($koneksi,"SELECT * FROM konfigurasi where id_konfigurasi = '1'");
            $dcon = mysqli_fetch_array($con);
        ?>
        <tr>
            <th colspan="2" align="left">Nama Perusahaan</th>
            <td colspan="5">: <?= $dcon['isi_konfigurasi']; ?></td>
        </tr>
        <tr>
            <th colspan="2" align="left">Nama Laporan</th>
            <td colspan="5">: Laporan Transaksi</td>
        </tr>
        <tr>
            <th colspan="2" align="left">Tanggal Laporan</th>
            <td colspan="5">: <?= tgl($_GET['dfrom']); ?> s/d <?= tgl($_GET['dto']); ?></td>
        </tr>
        <tr>
            <th colspan="7"></th>
        </tr>
    </table>

    <table class="table" border="1">
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
                <td align="right"><?= $dtr['total_transaksi'] == NULL ? '-' : rupiah($dtr['total_transaksi']); ?></td>
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

<?php } ?>