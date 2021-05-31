<?php $menu = "Pimpinan"; ?>
<?php include "../header.php"; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper p-2">
    <div class="card">
        <div class="card-body table-responsive">
            <div class="row content-header border shadow-sm">
                <div class="col-md-6">
                    <h4>Selamat Datang <?= $_SESSION['nama_lengkap'] ?></h4>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb float-md-right">
                        <li class="breadcrumb-item">Dashboard PM</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-4"></div>
                <!-- Jumlah produk -->
                <?php
                    $jp  = mysqli_query($koneksi, "SELECT COUNT(id_produk) as jumlah_produk FROM jenis_produk");
                    $djp = mysqli_fetch_array($jp);      
                ?>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-purple">
                        <div class="inner">
                            <h4><strong><?= $djp['jumlah_produk']; ?></strong></h4>
                            <h5>Produk</h5>
                        </div>
                        <div class="icon mt-2"><i class="ion ion-document"></i></div>
                        <a href="#" class="small-box-footer"> &nbsp; - &nbsp;</i></a>
                    </div>
                </div>
                <!-- Jumlah bahan -->
                <?php
                    $jb  = mysqli_query($koneksi, "SELECT COUNT(id_bahan) as jumlah_bahan FROM jenis_bahan");
                    $djb = mysqli_fetch_array($jb);      
                ?>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h4><strong><?= $djb['jumlah_bahan']; ?></strong></h4>
                            <h5>Bahan</h5>
                        </div>
                        <div class="icon mt-2"><i class="ion ion-image"></i></div>
                        <a href="#" class="small-box-footer"> &nbsp; - &nbsp;</i></a>
                    </div>
                </div>
                <!-- Jumlah Transaksi -->
                <?php
                    $dt  = mysqli_query($koneksi, "SELECT COUNT(id_transaksi) as jumlah_transaksi FROM transaksi");
                    $ddt = mysqli_fetch_array($dt);      
                ?>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h4><strong><?= $ddt['jumlah_transaksi']; ?></strong></h4>
                            <h5>Transaksi</h5>
                        </div>
                        <div class="icon mt-2"><i class="ion ion-card"></i></div>
                        <a href="#" class="small-box-footer"> &nbsp; - &nbsp;</i></a>
                    </div>
                </div>
                <!-- Jumlah Pendapatan -->
                <?php
                    $date = date('Y-m-d');
                    $pn  = mysqli_query($koneksi, "SELECT SUM(t.total_transaksi) as total_transaksi 
                    FROM transaksi t INNER JOIN customer c on c.id_customer = t.id_customer WHERE tanggal_transaksi = '$date'");
                    $dpn = mysqli_fetch_array($pn);      
                ?>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h4><strong><?= $dpn['total_transaksi'] == "" ? "0" : rupiah($dpn['total_transaksi']) ; ?></strong></h4>
                            <h5>Pendapatan</h5>
                        </div>
                        <div class="icon mt-2"><i class="ion ion-card"></i></div>
                        <a href="#" class="small-box-footer"> &nbsp; - &nbsp;</i></a>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>
<!-- /.content-wrapper -->
<?php include "../footer.php"; ?>
