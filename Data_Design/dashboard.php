<?php $menu = "DB_Design"; ?>
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
                        <li class="breadcrumb-item">Dashboard</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-4"></div>
                <!-- Jumlah pengajuan -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <?php 
                            $date   = date('Y-m-d');
                            $pn     = mysqli_query($koneksi,"SELECT COUNT(id_dtransaksi) as total_pn from detail_transaksi INNER JOIN transaksi on transaksi.id_transaksi = detail_transaksi.id_transaksi WHERE jasa_design = 'Ya' AND tanggal_transaksi = '$date'");
                            $dpn    = mysqli_fetch_array($pn);
                        ?>
                        <div class="inner">
                            <h4><strong><?= $dpn['total_pn'] == "" ? "0" : $dpn['total_pn']; ?></strong></h4>
                            <h5>Pengajuan</h5>
                        </div>
                        <div class="icon mt-2"><i class="far fa-list-alt"></i></div>
                        <a href="v_design_pengajuan.php" class="small-box-footer">Selangkapnya <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- Jumlah aktif -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-teal">
                        <?php 
                            $pna     = mysqli_query($koneksi,"SELECT COUNT(id_design) as total_aktif from jasa_design jd INNER JOIN detail_transaksi dt on dt.id_dtransaksi = jd.id_dtransaksi INNER join transaksi tr on tr.id_transaksi = dt.id_transaksi WHERE tanggal_transaksi = '$date'");
                            $dpna    = mysqli_fetch_array($pna);
                        ?>
                        <div class="inner">
                            <h4><strong><?= $dpna['total_aktif'] == "" ? "0" : $dpna['total_aktif']; ?></strong></h4>
                            <h5>Sedang Aktif</h5>
                        </div>
                        <div class="icon mt-2"><i class="ion ion-image"></i></div>
                        <a href="v_design_pengajuan.php" class="small-box-footer">Selangkapnya <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- Jumlah Design saya -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-primary">
                        <?php 
                            $pns     = mysqli_query($koneksi,"SELECT COUNT(id_design) as total_saya from jasa_design WHERE id_user = '$_SESSION[id_user]'");
                            $dpns    = mysqli_fetch_array($pns);
                        ?>
                        <div class="inner">
                            <h4><strong><?= $dpns['total_saya'] == "" ? "0" : $dpns['total_saya']; ?></strong></h4>
                            <h5>Design Saya</h5>
                        </div>
                        <div class="icon mt-2"><i class="far fa-user-circle"></i></div>
                        <a href="v_design.php" class="small-box-footer">Selangkapnya <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div> 
    </div>
    <div class="card">
        <div class="card-header h5">Design Saya <?= tgl(date('Y-m-d')); ?></div>
        <div class="card-body">
            <table class="table table-bordered fixed nowrap" id="example2">
                <thead>
                    <tr>
                        <th>ID Design</th>
                        <th>ID Dtransaksi</th>
                        <!-- <th>Nama Admin</th> -->
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
                    INNER JOIN detail_transaksi on detail_transaksi.id_dtransaksi = jasa_design.id_dtransaksi INNER JOIN transaksi on transaksi.id_transaksi = detail_transaksi.id_transaksi 
                    WHERE tanggal_cetak = '$date_now' AND jasa_design.id_user = '$_SESSION[id_user]'");
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
                        <td><?= $dds['id_dtransaksi']; ?></td>
                        <!-- <td><?= $dds['nama_lengkap'] == NULL ? '-' : $dds['nama_lengkap']; ?></td> -->
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