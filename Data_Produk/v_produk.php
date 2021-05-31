<?php $menu = "CS_Produk"; ?>
<?php include "../header.php"; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper p-2">
    <div class="card">
        <div class="card-body table-responsive">
            <div class="row content-header border shadow-sm">
                <div class="col-md-6">
                    <h4>Data Produk</h4>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb float-md-right">
                        <li class="breadcrumb-item">Data Produk</li>
                    </ol>
                </div>
            </div>
            <hr>
            <a href="v_produk_add.php" class="btn btn-sm btn-primary"><i class="fas fa-plus"> Tambah data</i></a><hr>
            <table class="table table-bordered table-hover fixed nowrap" id="example1">
                <thead>
                    <tr>
                        <th>ID Produk</th>
                        <th>Nama Produk</th>
                        <th>Harga Supplier</th>
                        <th>Harga Jual</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                        <th>Act</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $qpr = mysqli_query($koneksi, "SELECT * FROM jenis_produk ORDER BY id_produk ASC");
                    while($dpr=mysqli_fetch_array($qpr)){ ?>
                    <tr>
                        <td><?= $dpr['id_produk']; ?></td>  
                        <td><?= $dpr['nama_produk']; ?></td>
                        <td><?= $dpr['harga_supplier'] == NULL ? "-" : rupiah($dpr['harga_supplier']); ?></td>
                        <td><?= $dpr['harga_produk'] == NULL ? '-' : rupiah($dpr['harga_produk']); ?></td>  
                        <td><span class="p-2 <?= $dpr['status_produk'] == 'Tersedia' ? 'bg-success' : 'bg-danger'?>">
                        <?= $dpr['status_produk']; ?></span></td>  
                        <td><?= $dpr['ket_produk'] == NULL ? '-' : $dpr['ket_produk']; ?></td>  
                        <td>
                            <a href="v_produk_upd.php?id=<?= $dpr['id_produk']; ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                            <!-- <?php if($dpr['status_produk'] == 'Kosong'){ ?>
                                <a href="Code_Produk/c_produk_act.php?act=produk_tersedia&id=<?= $dpr['id_produk']; ?>" class="btn btn-sm btn-success"><i class="fas fa-check"></i></a>
                            <?php }else{ ?>
                                <a href="Code_Produk/c_produk_act.php?act=produk_kosong&id=<?= $dpr['id_produk']; ?>" class="btn btn-sm btn-danger"><i class="fas fa-times"></i></a>
                            <?php } ?> -->
                            <a href="Code_Produk/c_produk_del.php?id=<?= $dpr['id_produk']; ?>" class="btn btn-sm btn-danger"><i class="fas fa-times"></i></a>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div> 
    </div>
</div>
<!-- /.content-wrapper -->
<?php include "../footer.php"; ?>
