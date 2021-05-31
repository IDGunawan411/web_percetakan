<?php $menu = "CS_Customer"; ?>
<?php include "../header.php"; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper p-2">
    <div class="card">
        <div class="card-body table-responsive">
            <div class="row content-header border shadow-sm">
                <div class="col-md-6">
                    <h4>Registrasi Data Customer</h4>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="v_customer.php">Customer</a></li>
                        <li class="breadcrumb-item">Registrasi Customer</li>
                    </ol>
                </div>
            </div>
            <hr>
            <!-- Form add customer -->
            <form class="form-horizontal col-md-6" action="Code_Customer/c_customer_add.php" method="post">
                <div class="form-group row">
                    <?php
                        $csm = mysqli_query($koneksi, "SELECT MAX(substr(id_customer,3,4)) as max_id FROM customer");
                        $dcs = mysqli_fetch_array($csm);
                        $max_id  = $dcs['max_id'] + 1; 
                        $id_customer = "CS".Sprintf('%04s',$max_id)
                    ?>
                    <label class="col-md-4 col-form-label">ID Customer</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="id_customer" name="id_customer" value="<?= $id_customer; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Nama Customer</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="nama_customer" name="nama_customer">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">No. Telpon</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="no_telp" name="no_telp">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">E-Mail</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="email" name="email">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Password</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="password" name="password">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Alamat</label>
                    <div class="col-md-8">
                        <textarea name="alamat" id="alamat" rows="3" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <a href="#" onclick="window.history.back();" class="btn btn-sm btn-danger">Kembali</a>
                    <input type="submit" class="btn btn-primary btn-sm ml-2" value="Simpan">
                </div>
            </form>
        </div> 
    </div>
</div>
<!-- /.content-wrapper -->
<?php include "../footer.php"; ?>