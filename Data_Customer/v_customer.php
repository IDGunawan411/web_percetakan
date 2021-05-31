<?php $menu = "CS_Customer"; ?>
<?php include "../header.php"; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper p-2">
    <div class="card">
        <div class="card-body table-responsive">
            <div class="row content-header border shadow-sm">
                <div class="col-md-6">
                    <h4>Data Customer</h4>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb float-md-right">
                        <li class="breadcrumb-item">Customer</li>
                    </ol>
                </div>
            </div>
            <hr>
            <!-- table customer -->
            <a href="v_customer_add.php" class="btn btn-sm btn-primary"><i class="fas fa-plus"> Tambah data</i></a><hr>
            <table class="table table-bordered table-hover" id="example1">
                <thead>
                    <tr>
                        <th>ID Customer</th>
                        <th>Nama Customer</th>
                        <th>Nomor Telpon</th>
                        <th>Email</th>
                        <th width="300px">Alamat</th>
                        <th width="50px">Act.</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $qcs = mysqli_query($koneksi, "SELECT * FROM customer");
                    while($dcs=mysqli_fetch_array($qcs)){ ?>
                    <tr>
                        <td><?= $dcs['id_customer']; ?></td>  
                        <td><?= $dcs['nama_customer']; ?></td>  
                        <td><?= $dcs['no_telp']; ?></td>  
                        <td><?= $dcs['email']; ?></td>
                        <td><?= $dcs['alamat']; ?></td>
                        <td>
                            <a href="v_customer_upd.php?id=<?= $dcs['id_customer'] ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                            <a href="Code_Customer/c_customer_del.php?id=<?= $dcs['id_customer'] ?>" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></a>
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
