<?php $menu = "CS_Customer"; ?>
<?php include "../header.php"; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper p-2">
    <div class="card">
        <div class="card-body table-responsive">
            <div class="row content-header border shadow-sm">
                <div class="col-md-6">
                    <h4>Update Data Customer</h4>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="v_customer.php">Customer</a></li>
                        <li class="breadcrumb-item">Update Customer</li>
                    </ol>
                </div>
            </div>
            <hr>
            <!-- Form upd customer -->
            <?php
                $updcs = mysqli_query($koneksi, "SELECT * FROM customer WHERE id_customer = '$_GET[id]'");
                $dcs   = mysqli_fetch_array($updcs);
            ?>
            <form class="form-horizontal col-md-6" action="Code_Customer/c_customer_upd.php" method="post">
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">ID Customer</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="id_customer" name="id_customer" value="<?= $dcs['id_customer']; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Nama Customer</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="nama_customer" name="nama_customer" value="<?= $dcs['nama_customer']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">No. Telpon</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="no_telp" name="no_telp" value="<?= $dcs['no_telp']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Email</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="email" name="email" value="<?= $dcs['email']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Alamat</label>
                    <div class="col-md-8">
                        <textarea name="alamat" id="alamat" rows="3" class="form-control"><?= $dcs['alamat']; ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <input type="submit" class="btn btn-primary btn-sm" value="Simpan">
                </div>
            </form>
        </div> 
    </div>
</div>
<!-- /.content-wrapper -->
<?php include "../footer.php"; ?>