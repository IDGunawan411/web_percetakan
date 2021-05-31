<?php $menu = "CS_Transaksi"; ?>
<?php include "../header.php"; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper p-2">
    <div class="card">
        <div class="card-body table-responsive">
            <div class="row content-header border shadow-sm">
                <div class="col-md-6">
                    <h4>Pilih Transaksi</h4>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="../Data_Transaksi/v_transaksi.php">Transaksi</a></li>
                        <li class="breadcrumb-item"><a href="v_dtransaksi.php?id=<?= $_GET['id']; ?>">Detail Transaksi</a></li>
                        <li class="breadcrumb-item">Pilih Transaksi</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-5"></div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner"><h5>Produk Tetap</h5><p>Jenis Order</p></div>
                        <div class="icon"><i class="ion ion-bag"></i></div>
                        <a href="v_dtransaksi_add_produk.php?id=<?= $_GET['id']; ?>" class="small-box-footer">Pilih <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-primary">
                        <div class="inner"><h5>Produk Custom</h5><p>Jenis Indoor</p></div>
                        <div class="icon"><i class="ion ion-image"></i></div>
                        <a href="v_dtransaksi_add_indoor.php?id=<?= $_GET['id']; ?>" class="small-box-footer">Pilih <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner"><h5>Produk Besar</h5><p>Jenis Outdoor</p></div>
                        <div class="icon"><i class="ion ion-images"></i></div>
                        <a href="v_dtransaksi_add_outdoor.php?id=<?= $_GET['id']; ?>" class="small-box-footer">Pilih <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>
<!-- /.content-wrapper -->
<?php include "../footer.php"; ?>