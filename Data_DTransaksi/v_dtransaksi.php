<?php $menu = "CS_Transaksi"; ?>
<?php include "../header.php"; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper p-2">
    <div class="card">
        <div class="card-body table-responsive">
            <div class="row content-header border shadow-sm">
                <div class="col-md-6">
                    <?php
                        $gtnm = mysqli_query($koneksi,"SELECT * FROM transaksi INNER JOIN customer ON customer.id_customer = transaksi.id_customer 
                        WHERE id_transaksi = '$_GET[id]'");
                        $dnm  = mysqli_fetch_array($gtnm);
                    ?>
                    <h4>Detail Transaksi - <?= $dnm['nama_customer']; ?></h4>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="../Data_Transaksi/v_transaksi.php">Transaksi</a></li>
                        <li class="breadcrumb-item">Detail Transaksi</li>
                    </ol>
                </div>
            </div>
            <hr>
            <a href="v_dtransaksi_list.php?id=<?= $_GET['id']; ?>" class="btn btn-sm btn-primary"><i class="fas fa-plus"> Tambah data</i></a><hr>
            <table class="table table-bordered table-hover fixed nowrap" id="example1">
                <thead>
                    <tr>
                        <th>ID DTransaksi</th>
                        <th>Nama Transaksi</th>
                        <th>Ukuran</th>
                        <th>Qty</th>
                        <th>Bahan</th>
                        <th>Ket. Design</th>
                        <th>Total Design</th>
                        <th>Total Harga</th>
                        <th>Act</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $qtr1 = mysqli_query($koneksi, "SELECT * FROM detail_transaksi WHERE id_transaksi = '$_GET[id]' AND jenis_transaksi = 'Cetak'");
                    $rowqtr1 = mysqli_num_rows($qtr1);
                    while($dtr=mysqli_fetch_array($qtr1)){ 
                    if($dtr['ket_design'] == "Proses"){
                        $text_design = "border bg-primary";
                    }elseif($dtr['ket_design'] == "Active"){
                        $text_design = "border bg-success";
                    }elseif($dtr['ket_design'] == "Selesai"){
                        $text_design = "border bg-info";
                    }else{
                        $text_design = "";
                    }
                    $text_tr = $dtr['ukuran_cetak'] == NULL ? 'font-weight-bold text-red' : 'font-weight-bold text-purple'; 
                ?>
                    <tr>
                        <td><?= $dtr['id_dtransaksi'] == NULL ? '-' : $dtr['id_dtransaksi']; ?></td>
                        <td><span class="p-2 <?= $text_tr; ?>"><?= $dtr['nama_transaksi'] == NULL ? '-' : $dtr['nama_transaksi']; ?></span></td>

                        <td><?= $dtr['ukuran_cetak'] == NULL ? '-' : $dtr['ukuran_cetak']; ?></td>  
                        <td><?= $dtr['quantity'] == NULL ? '-' : $dtr['quantity']; ?></td>
                        <td><?= $dtr['jenis_bahan'] == NULL ? '-' : $dtr['jenis_bahan']; ?></td>

                        <td>
                            <span class="p-2 <?= $text_design; ?>"><?= $dtr['ket_design'] == NULL ? '-' : $dtr['ket_design']; ?></span>
                            <?php if($dtr['ket_design'] == "Selesai" || $dtr['ket_design'] == "Active"){ ?>
                                <span data-toggle="modal" data-target="#InfoDesign<?= $dtr['id_dtransaksi']; ?>"><i class="fas fa-info-circle text-info"></i></span>
                                <!-- Modal Info Design-->
                                <div class="modal fade" id="InfoDesign<?= $dtr['id_dtransaksi']; ?>" tabindex="-1" role="dialog" aria-labelledby="InfoDesign<?= $dtr['id_dtransaksi']; ?>Label" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5>Info Design</h5>
                                            </div>
                                            <div class="modal-body login-card-body">
                                                <?php
                                                    $qds    = mysqli_query($koneksi, "SELECT * FROM jasa_design INNER JOIN user ON user.id_user = jasa_design.id_user WHERE id_dtransaksi = '$dtr[id_dtransaksi]'");
                                                    $dds    = mysqli_fetch_array($qds); ?>
                                                <table class="table table-bordered text-dark">
                                                    <tr><th>ID Design</th><th><?= $dds['id_design'] == NULL ? '-' : $dds['id_design']; ?></th></tr>
                                                    <tr><th>Nama Admin</th><th><?= $dds['nama_lengkap'] == NULL ? '-' : $dds['nama_lengkap']; ?></th></tr>
                                                    <tr><th>Waktu Mulai</th><th><?= $dds['waktu_mulai'] == NULL ? '-' : $dds['waktu_mulai']; ?></span></th></tr>
                                                    <tr><th>Waktu Selesai</th><th><?= $dds['waktu_selesai'] == NULL ? '-' : $dds['waktu_selesai']; ?></span></th></tr>
                                                    <tr><th>Waktu Total</th><th><?= $dds['waktu_total'] == NULL ? '-' : $dds['waktu_total']." menit"; ?></span></th></tr>
                                                    <tr><th>Total Design</th><th><?= $dds['total_design'] == NULL ? '-' : rupiah($dds['total_design']); ?></span></th></tr>
                                                    <tr><th>Nama File</th><th><?= $dds['nama_file'] == NULL ? '-' : $dds['nama_file']; ?></span></th></tr>
                                                    <tr><th>Status Design</th><th><?= $dds['status_cetak'] == NULL ? '-' : $dds['status_cetak']; ?></span></th></tr>
                                                    <tr><th></th><th><button type="button" class="btn btn-secondary  btn-sm" data-dismiss="modal">Close</button></th></tr>                                                    
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </td>
                        <td><?= $dtr['total_design'] == NULL ? '-' : rupiah($dtr['total_design']); ?></td>  
                        <td><?= $dtr['total_harga'] == NULL ? '-' : rupiah($dtr['total_harga']); ?></td>
                        <td>
                            <?php if($dtr['ket_design'] != "Active" ){ ?>
                            <a href="#" class="h5 hapus-transaksi<?= $dtr['id_dtransaksi']; ?>"><i class="text-danger fas fa-times"></i></a>
                            <script>
                                $(document).ready(function() {
                                    $(".hapus-transaksi<?= $dtr['id_dtransaksi']; ?>").click( function(){
                                        Swal.fire({
                                            title: 'Apakah yakin ingin menghapus ?',
                                            text: '<?= $dtr['id_dtransaksi']; ?>',
                                            icon: 'info',
                                            showCancelButton: true,
                                            confirmButtonText: 'Konfirmasi',
                                            cancelButtonText: 'Batal'
                                            }).then((result) => {
                                            if (result.value) {
                                                window.location.href='Code_DTransaksi/c_dtransaksi_del.php?id=<?= $_GET['id'];?>&id_dtransaksi=<?= $dtr['id_dtransaksi']; ?>';
                                            } 
                                        });
                                    });
                                });
                            </script>     
                            <?php } ?>                                   
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
            <hr>
            <table class="table table-bordered table-hover fixed nowrap" id="example2">
                <thead>
                    <tr>
                        <th>ID DTransaksi</th>
                        <th>Nama Produk</th>
                        <th>Qty</th>
                        <th>Ket. Transaksi</th>
                        <th>Total Harga</th>
                        <th>Act</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $qtr2 = mysqli_query($koneksi, "SELECT * FROM detail_transaksi WHERE id_transaksi = '$_GET[id]' AND jenis_transaksi = 'Produk'");
                    $rowqtr2 = mysqli_num_rows($qtr2);
                    while($dtr=mysqli_fetch_array($qtr2)){ ?>
                    <tr>
                        <td><?= $dtr['id_dtransaksi'] == NULL ? '-' : $dtr['id_dtransaksi']; ?></td>  
                        <td><?= $dtr['nama_transaksi'] == NULL ? '-' : $dtr['nama_transaksi']; ?></td>  
                        <td><?= $dtr['quantity'] == NULL ? '-' : $dtr['quantity']; ?></td>
                        <td><?= $dtr['ket_transaksi'] == NULL ? '-' : $dtr['ket_transaksi']; ?></td>  
                        <td><?= $dtr['total_harga'] == NULL ? '-' : rupiah($dtr['total_harga']); ?></td>
                        <td>
                            <a href="#" id="" class="tr_produk<?= $dtr['id_dtransaksi']; ?> h5"><i class="text-danger fas fa-times"></i></a>
                            <script>
                                $(document).ready(function() {
                                    $(".tr_produk<?= $dtr['id_dtransaksi']; ?>").click( function(){
                                        Swal.fire({
                                            title: 'Apakah yakin ingin menghapus ?',
                                            text: '<?= $dtr['id_dtransaksi']; ?>',
                                            icon: 'info',
                                            showCancelButton: true,
                                            confirmButtonText: 'Konfirmasi',
                                            cancelButtonText: 'Batal'
                                            }).then((result) => {
                                            if (result.value) {
                                                window.location.href='Code_DTransaksi/c_dtransaksi_del.php?id=<?= $_GET['id'];?>&id_dtransaksi=<?= $dtr['id_dtransaksi']; ?>';
                                            } 
                                        });
                                    });
                                });
                            </script>     
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th>ID Transaksi</th>
                            <td><?= $_GET['id']; ?></td>
                        </tr>
                        <tr>
                            <th>Nama Customer</th>
                            <td><?= $dnm['nama_customer']; ?></td>
                        </tr>
                        <tr>
                            <th>Tgl Transaksi</th>
                            <td><?= tgl($dnm['tanggal_transaksi']); ?></td>
                        </tr>
                    </table>
                </div>
                
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <?php 
                            $jtr  = mysqli_query($koneksi, "SELECT COUNT(id_dtransaksi) as jtr FROM detail_transaksi WHERE id_transaksi = '$_GET[id]'");
                            $djtr = mysqli_fetch_array($jtr);
                            $ttr  = mysqli_query($koneksi, "SELECT SUM(total_harga) as ttr FROM detail_transaksi WHERE id_transaksi = '$_GET[id]'");
                            $dttr = mysqli_fetch_array($ttr); 
                        ?>
                        <tr>
                            <th>Jumlah Transaksi</th>
                            <td><?= $djtr['jtr']; ?> Produk</td>
                        </tr>
                        <tr>
                            <th>Total Transaksi</th>
                            <td><?= $dttr['ttr'] == NULL ? '-' : rupiah($dttr['ttr']); ?></td>
                        </tr>
                        <?php
                            $cds = mysqli_query($koneksi,"SELECT * FROM detail_transaksi WHERE id_transaksi = '$_GET[id]' AND (ket_design = 'Active' OR ket_design ='Proses')");
                            $dcds  = mysqli_num_rows($cds);
                            if($dcds < 1 && ($rowqtr1 != 0 || $rowqtr2 != 0)){ ?>
                                <tr><td>Checkout</td><td><a href="v_dtransaksi_invoice.php?id=<?= $_GET['id']; ?>" class="btn btn-primary btn-sm">Submit &nbsp; <i class="far fa-check-square"></i> </a></td></tr>
                            <?php } else { ?>
                                <tr><td>Checkout</td><td>Transaksi Belum Selesai</td></tr>
                            <?php } ?>
                    </table>
                </div>
            </div>
        </div> 
    </div>
</div>
<!-- /.content-wrapper -->
<?php include "../footer.php"; ?>