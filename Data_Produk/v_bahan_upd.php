<?php $menu = "CS_Produk"; ?>
<?php include "../header.php"; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper p-2">
    <div class="card">
        <div class="card-body table-responsive">
            <div class="row content-header border shadow-sm">
                <div class="col-md-6">
                    <h4>Edit Bahan</h4>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="v_bahan.php">Bahan</a></li>
                        <li class="breadcrumb-item">Edit Bahan</li>
                    </ol>
                </div>
            </div>
            <hr>
            <!-- Form add Bahan -->
            <form class="form-horizontal col-md-6" action="Code_Produk/c_bahan_upd.php" method="post">
                <?php
                    $upr    = mysqli_query($koneksi,"SELECT * FROM jenis_bahan WHERE id_bahan ='$_GET[id]'");
                    $dupr   = mysqli_fetch_array($upr);    
                ?>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">ID Bahan</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="id_bahan" name="id_bahan" value="<?= $dupr['id_bahan']; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Nama Bahan</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="nama_bahan" name="nama_bahan" value="<?= $dupr['nama_bahan'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Harga Supplier</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="harga_sup" name="harga_sup" value="<?= $dupr['harga_supplier'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Harga Jual</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="harga_bahan" name="harga_bahan" value="<?= $dupr['harga_bahan'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Status Bahan</label> 
                    <div class="col-md-8">
                        <select class="form-control select2" name="status_bahan" id="status_bahan">
                            <option value="0">- Pilih Status -</option>
                            <option value="Tersedia" <?= $dupr['status_bahan'] == "Tersedia" ? 'selected' : '' ?>>Tersedia</option>
                            <option value="Kosong" <?= $dupr['status_bahan'] == "Tersedia" ? '' : 'selected' ?>>Kosong</option>
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