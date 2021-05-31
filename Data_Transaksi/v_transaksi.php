<?php $menu = "CS_Transaksi"; ?>
<?php include "../header.php"; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper p-2">
    <div class="card">
        <div class="card-body table-responsive">
            <div class="row content-header border shadow-sm">
                <div class="col-md-6">
                    <h4>Data Transaksi</h4>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb float-md-right">
                        <li class="breadcrumb-item">Transaksi</li>
                    </ol>
                </div>
            </div>
            <hr>
            <a href="v_transaksi_add.php" class="btn btn-sm btn-primary"><i class="fas fa-plus"> Tambah data</i></a><hr>
            <table class="table table-bordered table-hover fixed nowrap" id="example1">
                <thead>
                    <tr>
                        <th>ID Transaksi</th>
                        <th>ID Customer</th>
                        <th>Nama Customer</th>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Ket.</th>
                        <th>Status</th>
                        <th>Act</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $qtr = mysqli_query($koneksi, "SELECT * FROM transaksi INNER JOIN customer on customer.id_customer = transaksi.id_customer");
                    while($dtr=mysqli_fetch_array($qtr)){ 
                    switch ($dtr['status_transaksi']) {
                        case "1":
                            $color_status = "text-secondary";
                            $text_status  = "Offline";
                            break;
                        case "2":
                            $color_status = "text-success";
                            $text_status  = "Online";
                            break;
                        case "3":
                            $color_status = "text-danger";
                            $text_status  = "Reject";
                            break;
                        }
                    ?>
                    <tr>
                        <td><?= $dtr['id_transaksi']; ?></td>  
                        <td><?= $dtr['id_customer']; ?></td>
                        <td><?= $dtr['nama_customer']; ?></td>  
                        <td><?= tgl($dtr['tanggal_transaksi']); ?></td>  
                        <td><?= $dtr['jumlah_transaksi'] == NULL ? '-' : $dtr['jumlah_transaksi']; ?></td>  
                        <td><?= $dtr['total_transaksi'] == NULL ? '-' : rupiah($dtr['total_transaksi']); ?></td>
                        <td><?= $dtr['ket_pembayaran'] == NULL ? "-" : $dtr['ket_pembayaran']; ?></td>
                        <td class="<?= $color_status; ?>"><?= $text_status; ?></td>
                        <td>
                            <?php if($dtr['status_transaksi'] == "1") { ?>
                                <a href="../Data_Dtransaksi/v_dtransaksi.php?id=<?= $dtr['id_transaksi'] ?>" class="btn btn-sm btn-info"><i class="fas fa-info-circle"></i></a>
                            <?php }elseif($dtr['status_transaksi'] == "2"){ ?>
                                <a href="../Data_Dtransaksi/v_dtransaksi_on.php?id=<?= $dtr['id_transaksi'] ?>" class="btn btn-sm btn-info"><i class="fas fa-info-circle"></i></a>
                            <?php } else { ?>
                                <a href="">-</a>
                            <?php } ?>
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
