<?php if($_GET['dfrom'] == NULL || $_GET['dto'] == NULL) {
    header('location:v_laporan_pengeluaran.php?ps=masukan_tgl');
}else{ ?>
    <?php include "../koneksi.php";
    $namafile = "Laporan_Pengeluaran_$_GET[dfrom]_$_GET[dto]";
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
            <th colspan="2">Nama Perusahaan</th>
            <td colspan="3">: <?= $dcon['isi_konfigurasi']; ?></td>
        </tr>
        <tr>
            <th colspan="2">Nama Laporan</th>
            <td colspan="3">: Laporan Pengeluaran</td>
        </tr>
        <tr>
            <th colspan="2">Tanggal Laporan</th>
            <td colspan="3">: <?= tgl($_GET['dfrom']); ?> s/d <?= tgl($_GET['dto']); ?></td>
        </tr>
        <tr>
            <th colspan="5"></th>
        </tr>
    </table>

    <table class="table" border="1">
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
                $total_pr = $total_pr + $dtr['total_pengeluaran'];
                $total_qty = $total_qty + $dtr['qty'];
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

<?php } ?>