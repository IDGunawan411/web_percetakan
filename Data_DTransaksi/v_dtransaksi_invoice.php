<?php $menu = "CS_Transaksi"; ?>
<?php 
    include "../header.php"; 
?>
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
                    <h4>Transaksi - <?= $dnm['nama_customer']; ?></h4>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="../Data_Transaksi/v_transaksi.php">Transaksi</a></li>
                        <li class="breadcrumb-item">Submit Transaksi</li>
                    </ol>
                </div>
            </div>  
            <hr>
            <div class="invoice p-3 mb-3">
                <!-- title row -->
                <div class="row">
                    <div class="col-12">
                    <?php
                        $conf        = mysqli_query($koneksi,"SELECT * FROM konfigurasi WHERE jenis_konfigurasi = '1'");
                        $data        = "";
                        while($dconf = mysqli_fetch_array($conf)){
                            $data    = $data.$dconf['isi_konfigurasi'].";";
                        }
                        $ex_data     = explode(";",$data);
                        $nama_admin  = $ex_data[0];
                        $telpon      = $ex_data[1];
                        $email       = $ex_data[2];
                        $alamat      = $ex_data[3];                       
                    ?>
                    <h4>
                        <i class="fas fa-globe"></i> <?= $nama_admin; ?>
                        <small class="float-right">Date: <?= tgl(date('Y-m-d')); ?></small>
                    </h4>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-3 invoice-col">
                        From 
                        <address>
                            <strong><?= $_SESSION['nama_lengkap']; ?></strong><br>
                            <i class="fas fa-map-marker-alt"></i> <?= $alamat; ?><br>
                            <i class="fas fa-phone-square"></i> <?= $telpon; ?><br>
                            <i class="far fa-envelope-open"></i> <?= $email; ?>
                        </address>
                    </div>
                    <div class="col-sm-1"></div>
                    <div class="col-sm-3 invoice-col">
                        To Customer
                        <address>
                            <strong><?= $dnm['nama_customer']; ?></strong><br>
                            <i class="fas fa-map-marker-alt"></i> <?= $dnm['alamat']; ?><br>
                            <i class="fas fa-phone-square"></i> <?= $dnm['no_telp'] ?><br>
                            <i class="far fa-envelope-open"></i> <?= $dnm['email']; ?>
                        </address>
                    </div>
                    <div class="col-sm-1"></div>
                    <div class="col-sm-3 invoice-col">
                        <!-- <b>Invoice #007612</b><br> -->
                        <br>
                        <b>ID Transaksi :</b> <?= $dnm['id_transaksi']; ?><br>
                        <b>Tanggal Transaksi :</b> <?= $dnm['tanggal_transaksi'] == NULL ? '-' : tgl($dnm['tanggal_transaksi']); ?><br>
                        <b>ID Customer : </b> <?= $dnm['id_customer']; ?>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Table row -->
                <div class="row">
                    <div class="col-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Detail</th>
                                <th>Nama Transaksi</th>
                                <th>Ukuran</th>
                                <th>Bahan</th>
                                <th>Qty</th>
                                <th>Satuan</th>
                                <th>Sub Total</th>
                                <th>Design</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $total_invoice = "0";
                                $inv  = mysqli_query($koneksi, "SELECT * FROM detail_transaksi WHERE id_transaksi = '$_GET[id]'");
                                while($dinv = mysqli_fetch_array($inv)){ 
                                    if($dinv['total_design'] != NULL ){
                                        $jumlah_satuan = $dinv['total_harga'] - $dinv['total_design'];    
                                        $satuan        = $jumlah_satuan / $dinv['quantity'];
                                    }else{
                                        $jumlah_satuan = $dinv['total_harga'];
                                        $satuan        = $dinv['total_harga'] / $dinv['quantity'];
                                    }
                                    $total_invoice     = $total_invoice + $jumlah_satuan;
                            ?>
                            <tr>
                                <td><?= $dinv['id_dtransaksi']; ?></td>
                                <td><?= $dinv['nama_transaksi'] == NULL ? '-' : $dinv['nama_transaksi']; ?></td>
                                <td><?= $dinv['ukuran_cetak'] == NULL ? '-' : $dinv['ukuran_cetak']; ?></td>
                                <td><?= $dinv['jenis_bahan'] == NULL ? '-' : $dinv['jenis_bahan']; ?></td>
                                <td><?= $dinv['quantity'] == NULL ? '-' : $dinv['quantity']; ?></td>
                                <td><?= $satuan == "-" ? '-' : rupiah($satuan); ?></td>
                                <td><?= $jumlah_satuan == "-" ? '-' : rupiah($jumlah_satuan); ?></td>
                                <td><?= $dinv['total_design'] == NULL ? '-' : rupiah($dinv['total_design']); ?></td>
                                <td><?= $dinv['total_harga'] == NULL ? '-' : rupiah($dinv['total_harga']); ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <form action="Code_DTransaksi/c_dtransaksi_checkout.php?id=<?= $_GET['id']; ?>" method="post">
                    <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-6">
                            
                        </div>
                        <!-- /.col -->
                        <div class="col-6">
                            <p class="lead ml-2 text-left"><i class="ion ion-bag"></i> Total Transaksi</p>
                            <div class="table-responsive">
                                <table class="table">
                                    <?php 
                                        $jtr  = mysqli_query($koneksi, "SELECT COUNT(id_dtransaksi) as jtr FROM detail_transaksi WHERE id_transaksi = '$_GET[id]'");
                                        $djtr = mysqli_fetch_array($jtr);
                                        
                                        $ttr  = mysqli_query($koneksi, "SELECT SUM(total_harga) as ttr FROM detail_transaksi WHERE id_transaksi = '$_GET[id]'");
                                        $dttr = mysqli_fetch_array($ttr); 
                                    
                                        $qty  = mysqli_query($koneksi, "SELECT SUM(quantity) as qty FROM detail_transaksi WHERE id_transaksi = '$_GET[id]'");
                                        $dqty = mysqli_fetch_array($qty);
                                        
                                        $tds  = mysqli_query($koneksi, "SELECT SUM(total_design) as tds FROM detail_transaksi WHERE id_transaksi = '$_GET[id]'");
                                        $dtds = mysqli_fetch_array($tds); ?>
                                    <tr>
                                        <th><i class="fas fa-list"></i> Qty / Total</th>
                                        <td>: <?= $dqty['qty']; ?> Unit / <?= $djtr['jtr']; ?> Transaksi</td>
                                    </tr>
                                    <tr>
                                        <th><i class="fas fa-money-check"></i> Sub Total</th>
                                        <td>: <?= rupiah($total_invoice); ?></td>
                                    </tr>
                                    <tr>
                                        <th><i class="fas fa-money-check"></i> Design</th>
                                        <td>: <?= rupiah($dtds['tds']); ?></td>
                                    </tr>
                                    <tr>
                                        <th><i class="far fa-credit-card"></i> Total</th>
                                        <td>: <?= rupiah($dttr['ttr']); ?></td>
                                    </tr>
                                    <?php
                                        $ctr  = mysqli_query($koneksi,"SELECT * FROM transaksi WHERE id_transaksi = '$_GET[id]'");
                                        $dctr = mysqli_fetch_array($ctr); 
                                        if($dctr['ket_pembayaran'] == NULL || $dctr['ket_pembayaran'] == "Kredit"){
                                    ?>
                                        <tr>
                                            <th>Metode Pembayaran</th>
                                            <td>
                                                <select name="pembayaran" id="" class="form-control select2">
                                                    <option value="0" disabled>- Pilih Metode -</option>
                                                    <option value="Lunas"> Lunas </option>
                                                    <option value="Kredit"> Kredit </option>
                                                </select>
                                            </td>
                                        </tr>
                                    <?php } else { ?>
                                        <tr>
                                            <th>Pembayaran</th>
                                            <td>: 
                                                <strong>
                                                    <span class="text-success"><?= $dctr['ket_pembayaran']; ?></span>
                                                </strong>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-12">
                        <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                        <?php
                            if($dctr['ket_pembayaran'] == NULL || $dctr['ket_pembayaran'] == "Kredit"){
                        ?>
                        <button type="submit" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                            Payment
                        </button>
                        <?php } ?>
                        <a href="v_dtransaksi_invoice_print.php?id=<?= $_GET['id']; ?>" class="btn btn-primary float-right" style="margin-right: 5px;">
                            <i class="fas fa-download"></i> Generate PDF
                        </a>
                        </div>
                    </div>
                </form>
            </div>
        </div> 
    </div>
</div>
<!-- /.content-wrapper -->
<?php include "../footer.php"; ?>