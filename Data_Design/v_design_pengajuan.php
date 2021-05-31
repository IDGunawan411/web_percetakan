<?php $menu = "Design_Pengajuan"; ?>
<?php include "../header.php"; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper p-2">
    <div class="card">
        <div class="card-body table-responsive">
            <div class="row content-header border shadow-sm">
                <div class="col-md-6">
                    <h4>Data Pengajuan Design</h4>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb float-md-right">
                        <li class="breadcrumb-item">Pengajuan Design</li>
                    </ol>
                </div>
            </div>
            <hr>
            <table class="table table-bordered table-hover fixed nowrap" id="example1">
                <thead>
                    <tr>
                        <th>ID DTransaksi</th>
                        <th>Nama Transaksi</th>
                        <th>Nama Customer</th>
                        <th>Tanggal</th>
                        <th>Ukuran</th>
                        <th>Bahan</th>
                        <th>Ket. Design</th>
                        <th>Act</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $qtr = mysqli_query($koneksi, "SELECT * FROM detail_transaksi INNER JOIN transaksi on transaksi.id_transaksi = detail_transaksi.id_transaksi 
                        INNER JOIN customer on customer.id_customer = transaksi.id_customer WHERE detail_transaksi.jenis_transaksi = 'Cetak' AND NOT detail_transaksi.ket_design = ''");
                        while($dtr=mysqli_fetch_array($qtr)){ 
                        if($dtr['ket_design']=="Proses"){
                            $text_design = "border bg-primary";
                        }elseif($dtr['ket_design']=="Active"){
                            $text_design = "border bg-success";
                        }else{
                            $text_design = "border bg-info";
                        }
                        $text_tr = $dtr['ukuran_cetak'] == NULL ? 'font-weight-bold text-red' : 'font-weight-bold text-purple'; 
                    ?>
                    <tr>
                        <td><?= $dtr['id_dtransaksi'] == NULL ? '-' : $dtr['id_dtransaksi']; ?></td>    
                        <td><span class="p-2 <?= $text_tr; ?>"><?= $dtr['nama_transaksi'] == NULL ? '-' : $dtr['nama_transaksi']; ?></span></td>
                        <td><?= $dtr['nama_customer'] == NULL ? '-' : $dtr['nama_customer']; ?></td>
                        <td><?= $dtr['tanggal_transaksi'] == NULL ? '-' : tgl($dtr['tanggal_transaksi']); ?></td>    
                        <td><?= $dtr['ukuran_cetak'] == NULL ? '-' : $dtr['ukuran_cetak']; ?></td>  
                        <td><?= $dtr['jenis_bahan'] == NULL ? '-' : $dtr['jenis_bahan']; ?></td>
                        <td><span class="p-2 <?= $text_design; ?>"><?= $dtr['ket_design'] == NULL ? '-' : $dtr['ket_design']; ?></span></td>
                        <td>
                            <?php if($dtr['ket_design'] == 'Proses'){ ?>
                                <!-- Button info -->
                                <a href="#" data-toggle="modal" class="btn btn-sm btn-info" data-target="#Pengajuan<?= $dtr['id_dtransaksi']; ?>"><i class="fas fa-info-circle"></i></a>
                                <!-- Modal Mulai Design-->
                                <div class="modal fade" id="Pengajuan<?= $dtr['id_dtransaksi']; ?>" tabindex="-1" role="dialog" aria-labelledby="Pengajuan<?= $dtr['id_dtransaksi']; ?>Label" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5>Informasi Pengajuan</h5>
                                            </div>
                                            <div class="modal-body login-card-body">
                                                <table class="table table-bordered text-dark">
                                                    <tr><th>ID Transaksi</th><th><?= $dtr['id_transaksi'] == NULL ? '-' : $dtr['id_transaksi']; ?></th></tr>
                                                    <tr><th>ID Detail</th><th><?= $dtr['id_dtransaksi'] == NULL ? '-' : $dtr['id_dtransaksi']; ?></th></tr>
                                                    <tr><th>Nama Transaksi</th><th><?= $dtr['nama_transaksi'] == NULL ? '-' : $dtr['nama_transaksi']; ?></th></tr>
                                                    <tr><th>Nama Customer</th><th><?= $dtr['nama_customer'] == NULL ? '-' : $dtr['nama_customer']; ?></th></tr>
                                                    <tr><th>Ukuran</th><th><?= $dtr['ukuran_cetak'] == NULL ? '-' : $dtr['ukuran_cetak']; ?></th></tr>
                                                    <tr><th>Bahan</th><th><?= $dtr['jenis_bahan'] == NULL ? '-' : $dtr['jenis_bahan']; ?></th></tr>
                                                    <tr><th class="text-info">Konfirmasi Pengajuan</th>
                                                    <th><a href="Code_Design/c_design_act.php?act=acc_pengajuan&id=<?= $dtr['id_dtransaksi']; ?>" class="btn btn-sm btn-info mr-2">Konfirm</a><button type="button" class="btn btn-secondary  btn-sm" data-dismiss="modal">Batal</button></th></tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Button info -->
                            <?php }else{ ?>
                                <span>-</span> 
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
