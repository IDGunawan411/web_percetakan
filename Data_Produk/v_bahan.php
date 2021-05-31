<?php $menu = "CS_Bahan"; ?>
<?php include "../header.php"; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper p-2">
    <div class="card">
        <div class="card-body table-responsive">
            <div class="row content-header border shadow-sm">
                <div class="col-md-6">
                    <h4>Data Bahan</h4>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb float-md-right">
                        <li class="breadcrumb-item">Data Bahan</li>
                    </ol>
                </div>
            </div>
            <hr>
            <a href="v_bahan_add.php" class="btn btn-sm btn-primary"><i class="fas fa-plus"> Tambah data</i></a><hr>
            <table class="table table-bordered table-hover fixed nowrap" id="example1">
                <thead>
                    <tr>
                        <th>ID Bahan</th>
                        <th>Nama Bahan</th>
                        <th>Harga Supplier</th>
                        <th>Harga Jual</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                        <th>Act</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $qpr = mysqli_query($koneksi, "SELECT * FROM jenis_bahan ORDER BY id_bahan ASC");
                    while($dpr=mysqli_fetch_array($qpr)){ 
                    $meteran = $dpr['ket_bahan'] == 2 ? "meter" : "pcs";
                    ?>
                    <tr>
                        <td><?= $dpr['id_bahan']; ?></td>  
                        <td><?= $dpr['nama_bahan']; ?></td>
                        <td><?= $dpr['harga_supplier'] == NULL ? '-' : rupiah($dpr['harga_supplier'])."/ $meteran"; ?></td>  
                        <td><?= $dpr['harga_bahan'] == NULL ? '-' : rupiah($dpr['harga_bahan'])."/ $meteran"; ?></td>  
                        <td><span class="p-2 <?= $dpr['status_bahan'] == 'Tersedia' ? 'bg-success' : 'bg-danger'?>">
                        <?= $dpr['status_bahan']; ?></span></td>  
                        <td class="<?= $dpr['ket_bahan'] == 1 ? 'text-info' : 'text-purple' ?> font-weight-bold"><?= $dpr['ket_bahan'] == 1 ? 'Tetap' : 'Meteran'; ?></td>  
                        <td>
                            <a href="v_bahan_upd.php?id=<?= $dpr['id_bahan']; ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                            <!-- <?php if($dpr['status_bahan'] == 'Kosong'){ ?>
                                <a href="Code_bahan/c_bahan_act.php?act=bahan_tersedia&id=<?= $dpr['id_bahan']; ?>" class="btn btn-sm btn-success"><i class="fas fa-check"></i></a>
                            <?php }else{ ?>
                                <a href="Code_bahan/c_bahan_act.php?act=bahan_kosong&id=<?= $dpr['id_bahan']; ?>" class="btn btn-sm btn-danger"><i class="fas fa-times"></i></a>
                            <?php } ?> -->
                            <a href="Code_produk/c_bahan_del.php?id=<?= $dpr['id_bahan']; ?>" class="btn btn-sm btn-danger"><i class="fas fa-times"></i></a>
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
