<?php $menu = "TR_Pimpinan"; ?>
<?php include "../header.php"; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper p-2">
    <div class="card">
        <div class="card-body table-responsive">
            <div class="row content-header border shadow-sm">
                <div class="col-md-6">
                    <h4>Laporan Transaksi</h4>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb float-md-right">
                        <li class="breadcrumb-item">Laporan</li>
                    </ol>
                </div>
            </div>
            <hr>
            <form action="Code_Laporan/c_generate.php" method="post">
                <?php 
                    $tanggal_from   = "";
                    $tanggal_to     = "";
                    if(isset($_GET['dfrom']) && isset($_GET['dto'])){
                        $tanggal_from   = $_GET['dfrom'];
                        $tanggal_to     = $_GET['dto'];
                    }
                ?>
                <div class="row">
                    <div class="row col-md-6">
                        <div class="col-md-6">
                            <h5>Tanggal Dari</h5>
                            <input type="date" class="form-control" name="tanggal_from" value="<?= $tanggal_from; ?>">
                        </div>
                        <div class="col-md-6">
                            <h5>Tanggal Sampai</h5>
                            <div class="input-group">
                                <input type="date" class="form-control" name="tanggal_to" value="<?= $tanggal_to; ?>">
                                <div class="input-group-append">
                                    <button type="submit" name="Search" class="btn btn-primary float-right"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row col-md-6">
                        <div class="col-md-6">
                            <h5>&nbsp;</h5>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <a href="v_laporan_transaksi_gn.php?dfrom=<?= $tanggal_from; ?>&dto=<?= $tanggal_to; ?>" class="btn btn-primary"><i class="fas fa-download"></i> Gen PDF</a>
                                    <a href="v_laporan_transaksi_excel.php?dfrom=<?= $tanggal_from; ?>&dto=<?= $tanggal_to; ?>" class="btn btn-success"><i class="fas fa-download"></i> Gen Xls</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <hr>
            <div class="">
                <table class="table table-bordered table-hover fixed nowrap" id="example1">
                    <thead>
                        <tr>
                            <th>ID Transaksi</th>
                            <th>ID Customer</th>
                            <th>Nama Customer</th>
                            <th>Tanggal</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $total_transaksi = 0;
                        $qtr = mysqli_query($koneksi, "SELECT * FROM laporan_transaksi WHERE tanggal_transaksi BETWEEN '$tanggal_from' AND '$tanggal_to'");
                        while($dtr=mysqli_fetch_array($qtr)){ 

                        $total_transaksi = (int)$total_transaksi + (int)$dtr['total_transaksi'];    
                    ?>
                        <tr>
                            <td><?= $dtr['id_transaksi']; ?></td>  
                            <td><?= $dtr['id_customer']; ?></td>
                            <td><?= $dtr['nama_customer']; ?></td>  
                            <td><?= tgl($dtr['tanggal_transaksi']); ?></td>  
                            <td><?= $dtr['jumlah_transaksi'] == NULL ? '-' : $dtr['jumlah_transaksi']; ?></td>  
                            <td><?= $dtr['total_transaksi'] == NULL ? '-' : rupiah($dtr['total_transaksi']); ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <hr>
                <div class=""><h5>Total Pengeluaran : <?= rupiah($total_transaksi); ?></h5></div>
                <hr>
            </div>
        </div> 
    </div>
</div>
<!-- /.content-wrapper -->
<?php include "../footer.php"; ?>
