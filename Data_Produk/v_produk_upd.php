<?php $menu = "CS_Produk"; ?>
<?php include "../header.php"; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper p-2">
    <div class="card">
        <div class="card-body table-responsive">
            <div class="row content-header border shadow-sm">
                <div class="col-md-6">
                    <h4>Edit Produk</h4>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="v_produk.php">Produk</a></li>
                        <li class="breadcrumb-item">Edit Produk</li>
                    </ol>
                </div>
            </div>
            <hr>
            <!-- Form add produk -->
            <form class="form-horizontal col-md-6" action="Code_Produk/c_produk_upd.php" method="post">
                <?php
                    $upr    = mysqli_query($koneksi,"SELECT * FROM jenis_produk WHERE id_produk ='$_GET[id]'");
                    $dupr   = mysqli_fetch_array($upr);    
                ?>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">ID Produk</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="id_produk" name="id_produk" value="<?= $dupr['id_produk']; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Nama Produk</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?= $dupr['nama_produk'] ?>">
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
                        <input type="text" class="form-control" id="harga_produk" name="harga_produk" value="<?= $dupr['harga_produk'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Status Produk</label> 
                    <div class="col-md-8">
                        <select class="form-control select2" name="status_produk" id="status_produk">
                            <option value="0">- Pilih Status -</option>
                            <option value="Tersedia" <?= $dupr['status_produk'] == "Tersedia" ? 'selected' : '' ?>>Tersedia</option>
                            <option value="Kosong" <?= $dupr['status_produk'] == "Tersedia" ? '' : 'selected' ?>>Kosong</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Ket. Produk</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="ket_produk" name="ket_produk" value="<?= $dupr['ket_produk'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <a href="v_produk.php" class="btn btn-sm btn-danger">Kembali</a>
                    <input type="submit" class="btn btn-primary btn-sm ml-2" value="Simpan">
                </div>
            </form>
        </div> 
    </div>
</div>
<!-- /.content-wrapper -->
<?php include "../footer.php"; ?>