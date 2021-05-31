<?php $menu = "CS_Index"; ?>
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
                        <li class="breadcrumb-item">Dashboard CS</li>
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
                        <a href="../Data_Produk/v_produk.php" class="small-box-footer">Selangkapnya <i class="fas fa-arrow-circle-right"></i></a>
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
                        <a href="../Data_Produk/v_bahan.php" class="small-box-footer">Selangkapnya <i class="fas fa-arrow-circle-right"></i></a>
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
                        <a href="../Data_Produk/v_produk.php" class="small-box-footer">Selangkapnya <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- Jumlah Design -->
                <?php
                    $ds  = mysqli_query($koneksi, "SELECT COUNT(id_design) as jumlah_design FROM jasa_design");
                    $dds = mysqli_fetch_array($ds);      
                ?>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h4><strong><?= $dds['jumlah_design']; ?></strong></h4>
                            <h5>Pengajuan Design</h5>
                        </div>
                        <div class="icon mt-2"><i class="ion ion-laptop"></i></div>
                        <a href="#" class="small-box-footer"> - </a>
                    </div>
                </div>
            </div>
        </div> 
    </div>
    <div class="card">
        <div class="card-header h5">Design Aktif <?= tgl(date('Y-m-d')); ?></div>
        <div class="card-body">
            <table class="table table-bordered fixed nowrap" id="example2">
                <thead>
                    <tr>
                        <th>ID Design</th>
                        <th>ID Dtransaksi</th>
                        <th>Nama Admin</th>
                        <th>Waktu Mulai</th>
                        <th>Waktu Selesai</th>
                        <th>Waktu Total</th>
                        <th>Status</th>
                        <th>Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $date_now = date('Y-m-d');
                    $qds = mysqli_query($koneksi, "SELECT * FROM jasa_design INNER JOIN user on user.id_user = jasa_design.id_user 
                    INNER JOIN detail_transaksi on detail_transaksi.id_dtransaksi = jasa_design.id_dtransaksi INNER JOIN transaksi on transaksi.id_transaksi = detail_transaksi.id_transaksi WHERE tanggal_cetak = '$date_now'");
                    while($dds = mysqli_fetch_array($qds)){

                    if($dds['status_cetak'] == "Selesai"){
                        $bg_ds = "p-2 bg-info";
                    }elseif($dds['status_cetak'] == "Active"){
                        $bg_ds = "p-2 bg-success";
                    }elseif($dds['status_cetak'] == "Proses"){
                        $bg_ds = "p-2 bg-primary";
                    }else{
                        $bg_ds = "";
                    }
                ?>
                    <tr>
                        <td><?= $dds['id_design'] == NULL ? '-' : $dds['id_design']; ?></td>
                        <td><?= $dds['id_dtransaksi']; ?> <a href="../Data_Dtransaksi/v_dtransaksi.php?id=<?= $dds['id_transaksi']; ?>"><i class="fas fa-info-circle text-info"></i></a> </td>
                        <td><?= $dds['nama_lengkap'] == NULL ? '-' : $dds['nama_lengkap']; ?></td>
                        <td><?= $dds['waktu_mulai'] == NULL ? '-' : $dds['waktu_mulai']; ?></td>
                        <td><?= $dds['waktu_selesai'] == NULL ? '-' : $dds['waktu_selesai']; ?></td>
                        <td><?= $dds['waktu_total'] == NULL ? '-' : $dds['waktu_total']." menit"; ?></td>
                        <td><span class="<?= $bg_ds ?>"><?= $dds['status_cetak'] == NULL ? '-' : $dds['status_cetak']; ?></span></td>
                        <td><?= $dds['total_design'] == NULL ? '-' : rupiah($dds['total_design']); ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
<?php include "../footer.php"; ?>