<?php $menu = "ON_TR"; ?>
<?php include "../header.php"; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper p-2">
    <div class="card">
        <div class="card-body table-responsive">
            <div class="row content-header border shadow-sm">
                <div class="col-md-6">
                    <?php
                        $gtnm = mysqli_query($koneksi,"SELECT * FROM transaksi INNER JOIN customer ON customer.id_customer = transaksi.id_customer 
                        WHERE id_transaksi = '$_GET[id]'");
                        $dnm  = mysqli_fetch_array($gtnm);
                    ?>
                    <h4>Detail Transaksi - <?= $dnm['nama_customer']; ?></h4>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="v_transaksi_on.php">Transaksi</a></li>
                        <li class="breadcrumb-item">Detail Transaksi</li>
                    </ol>
                </div>
            </div>
            <?php if($dnm['status_transaksi'] == "2"){

                if($dnm['ket_pembayaran'] == NULL) { ?>
                    <hr><a href="../Data_Dtransaksi/v_dtransaksi_list.php?id=<?= $_GET['id']; ?>" class="btn btn-sm btn-primary"><i class="fas fa-plus"> Tambah data</i></a><hr>
                <?php } else {?>
                    <hr><h5>Transaksi Selesai</h5><hr>
                <?php } ?>

            <?php } else { ?>
                <hr><h5>Transaksi Offline</h5><hr>
            <?php } ?>
            <table class="table table-bordered table-hover fixed nowrap" id="example1">
                <thead>
                    <tr>
                        <th>ID DTransaksi</th>
                        <th>Nama Transaksi</th>
                        <th>Ukuran</th>
                        <th>Qty</th>
                        <th>Bahan</th>
                        <!-- <th>Ket. Design</th>
                        <th>Total Design</th> -->
                        <th>Total Harga</th>
                        <th>File</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $qtr1 = mysqli_query($koneksi, "SELECT * FROM detail_transaksi dt INNER JOIN file_design fd
                    on dt.id_dtransaksi = fd.id_dtransaksi WHERE dt.id_transaksi = '$_GET[id]' AND dt.jenis_transaksi = 'Cetak'");
                    $rowqtr1 = mysqli_num_rows($qtr1);
                    while($dtr=mysqli_fetch_array($qtr1)){ 
                    
                    $text_tr = $dtr['ukuran_cetak'] == NULL ? 'font-weight-bold text-red' : 'font-weight-bold text-purple'; 
                ?>
                    <tr>
                        <td><?= $dtr['id_dtransaksi'] == NULL ? '-' : $dtr['id_dtransaksi']; ?></td>
                        <td><span class="p-2 <?= $text_tr; ?>"><?= $dtr['nama_transaksi'] == NULL ? '-' : $dtr['nama_transaksi']; ?></span></td>
                        <td><?= $dtr['ukuran_cetak'] == NULL ? '-' : $dtr['ukuran_cetak']; ?></td>  
                        <td><?= $dtr['quantity'] == NULL ? '-' : $dtr['quantity']; ?></td>
                        <td><?= $dtr['jenis_bahan'] == NULL ? '-' : $dtr['jenis_bahan']; ?></td>
                        <td><?= $dtr['total_harga'] == NULL ? '-' : rupiah($dtr['total_harga']); ?></td>
                        <td><a href="<?= $dtr['link_file']; ?>">Lihat</a></td>                       
                    </tr>
                    <?php }?>
                </tbody>
            </table>
            <hr>
            <table class="table table-bordered table-hover fixed nowrap" id="example2">
                <thead>
                    <tr>
                        <th>ID DTransaksi</th>
                        <th>Nama Produk</th>
                        <th>Qty</th>
                        <th>Ket. Transaksi</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $qtr2 = mysqli_query($koneksi, "SELECT * FROM detail_transaksi WHERE id_transaksi = '$_GET[id]' AND jenis_transaksi = 'Produk'");
                    $rowqtr2 = mysqli_num_rows($qtr2);
                    while($dtr=mysqli_fetch_array($qtr2)){ ?>
                    <tr>
                        <td><?= $dtr['id_dtransaksi'] == NULL ? '-' : $dtr['id_dtransaksi']; ?></td>  
                        <td><?= $dtr['nama_transaksi'] == NULL ? '-' : $dtr['nama_transaksi']; ?></td>  
                        <td><?= $dtr['quantity'] == NULL ? '-' : $dtr['quantity']; ?></td>
                        <td><?= $dtr['ket_transaksi'] == NULL ? '-' : $dtr['ket_transaksi']; ?></td>  
                        <td><?= $dtr['total_harga'] == NULL ? '-' : rupiah($dtr['total_harga']); ?></td>   
                    </tr>
                    <?php }?>
                </tbody>
            </table>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th>ID Transaksi</th>
                            <td><?= $_GET['id']; ?></td>
                        </tr>
                        <tr>
                            <th>Nama Customer</th>
                            <td><?= $dnm['nama_customer']; ?></td>
                        </tr>
                        <tr>
                            <th>Tgl Transaksi</th>
                            <td><?= tgl($dnm['tanggal_transaksi']); ?></td>
                        </tr>
                    </table>
                </div>
                
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <?php 
                            $jtr  = mysqli_query($koneksi, "SELECT COUNT(id_dtransaksi) as jtr FROM detail_transaksi WHERE id_transaksi = '$_GET[id]'");
                            $djtr = mysqli_fetch_array($jtr);
                            $ttr  = mysqli_query($koneksi, "SELECT SUM(total_harga) as ttr FROM detail_transaksi WHERE id_transaksi = '$_GET[id]'");
                            $dttr = mysqli_fetch_array($ttr); 
                            $bkt  = mysqli_query($koneksi, "SELECT * FROM pembayaran WHERE id_transaksi = '$_GET[id]'");
                            $dbkt = mysqli_fetch_array($bkt);
                        ?>
                        <tr>
                            <th>Jumlah Transaksi</th>
                            <td><?= $djtr['jtr']; ?> Produk</td>
                        </tr>
                        <tr>
                            <th>Total Transaksi</th>
                            <td><?= $dttr['ttr'] == NULL ? '-' : rupiah($dttr['ttr']); ?></td>
                        </tr>
                        <?php if($dnm['ket_pembayaran'] == NULL) { ?>
                            <tr><td>Pembayaran</td><td><a href="v_pembayaran.php?id=<?= $_GET['id']; ?>" class="btn btn-primary btn-sm">Submit &nbsp; <i class="far fa-check-square"></i> </a></td></tr>
                        <?php } else { ?>
                            <tr><td>Pembayaran</td><td><a href="v_pembayaran.php?id=<?= $_GET['id']; ?>" class="btn btn-primary btn-sm">Cek &nbsp; <i class="far fa-check-square"></i> </a></td></tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div> 
    </div>
</div>
<!-- /.content-wrapper -->
<?php include "../footer.php"; ?>