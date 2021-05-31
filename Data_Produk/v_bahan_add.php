<?php $menu = "CS_Bahan"; ?>
<?php include "../header.php"; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper p-2">
    <div class="card">
        <div class="card-body table-responsive">
            <div class="row content-header border shadow-sm">
                <div class="col-md-6">
                    <h4>Tambah Bahan</h4>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="v_bahan.php">Bahan</a></li>
                        <li class="breadcrumb-item">Add Bahan</li>
                    </ol>
                </div>
            </div>
            <hr>
            <!-- Form add bahan -->
            <form class="form-horizontal col-md-6" action="Code_Produk/c_bahan_add.php" method="post">
                <div class="form-group row">
                    <?php
                        $str     = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                        $rndm    = str_shuffle($str);
                        $sub     = date('dmy').substr($rndm,0,5);
                        $id_bahan = "BN".$sub;
                    ?>
                    <label class="col-md-4 col-form-label">ID Bahan</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="id_bahan" name="id_bahan" value="<?= $id_bahan; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Nama Bahan</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="nama_bahan" name="nama_bahan">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Harga Supplier</label> 
                    <div class="col-md-8">
                        <input type="number" class="form-control" id="harga_sup" name="harga_sup">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Harga Jual</label> 
                    <div class="col-md-8">
                        <input type="number" class="form-control" id="harga_bahan" name="harga_bahan">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Status Bahan</label> 
                    <div class="col-md-8">
                        <select class="form-control select2" name="status_bahan" id="status_bahan">
                            <option value="0">- Pilih Status -</option>
                            <option value="Tersedia">Tersedia</option>
                            <option value="Kosong">Kosong</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Ket. Bahan</label>
                    <div class="col-md-8">
                        <select class="form-control select2" name="ket_bahan" id="ket_bahan">
                            <option value="0">- Pilih Status -</option>
                            <option value="1">Tetap</option>
                            <option value="2">Meteran</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <a href="v_bahan.php" class="btn btn-sm btn-danger">Kembali</a>
                    <input type="submit" class="btn btn-primary btn-sm ml-2" value="Simpan">
                </div>
            </form>
        </div> 
    </div>
</div>
<!-- /.content-wrapper -->
<?php include "../footer.php"; ?>