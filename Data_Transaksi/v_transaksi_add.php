<?php $menu = "CS_Transaksi"; ?>
<?php include "../header.php"; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper p-2">
    <div class="card">
        <div class="card-body table-responsive">
            <div class="row content-header border shadow-sm">
                <div class="col-md-6">
                    <h4>Tambah Data Transaksi</h4>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="v_transaksi.php">Transaksi</a></li>
                        <li class="breadcrumb-item">Add Transaksi</li>
                    </ol>
                </div>
            </div>
            <hr>
            <!-- Form add customer -->
            <form class="form-horizontal col-md-6" action="Code_Transaksi/c_transaksi_add.php" method="post">
                <div class="form-group row">
                    <?php
                        $trm = mysqli_query($koneksi, "SELECT MAX(substr(id_transaksi,3,4)) as max_id FROM transaksi");
                        $dtr = mysqli_fetch_array($trm);
                        $max_id  = $dtr['max_id'] + 1; 
                        $id_transaksi = "TR".Sprintf('%04s',$max_id)
                    ?>
                    <label class="col-md-4 col-form-label">ID Transaksi</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="id_transaksi" name="id_transaksi" value="<?= $id_transaksi; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Nama Customer</label>
                    <div class="col-md-8">
                        <div class="input-group">
                            <select class="form-control select2" name="id_customer">
                                <option value="0">- Pilih Customer -</option>
                                <?php
                                    $qcs    = mysqli_query($koneksi,"SELECT * FROM customer");
                                    while($dcs=mysqli_fetch_array($qcs)){ ?>
                                <option value="<?= $dcs['id_customer']; ?>"><?=  $dcs['id_customer']." - ".$dcs['nama_customer']; ?></option>
                                <?php } ?>
                            </select>
                            <div class="input-group-prepend">
                                <a class="btn btn-sm btn-info p-2" href="../Data_Customer/v_customer_add.php?ps=regis">Register</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Tanggal Transaksi</label>
                    <div class="col-md-8">
                        <input type="date" class="form-control" id="tgl_transaksi" name="tgl_transaksi">
                    </div>
                </div>
                <!-- <div class="form-group row">
                    <label class="col-md-4 col-form-label">Ket. Pembayaran</label>
                    <div class="col-md-8">
                        <select class="form-control select2" name="ket_pembayaran">
                            <option value="0">- Pilih Ket -</option>
                            <option value="DP">DP</option>
                            <option value="Lunas">Lunas</option>
                        </select>
                    </div>
                </div> -->
                <div class="form-group row">
                    <a href="v_transaksi.php" class="btn btn-sm btn-danger mr-2">Kembali</a>
                    <input type="submit" class="btn btn-primary btn-sm" value="Simpan">
                </div>
            </form>
        </div> 
    </div>
</div>
<!-- /.content-wrapper -->
<?php include "../footer.php"; ?>