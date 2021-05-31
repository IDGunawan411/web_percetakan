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
                <div class="row">
                    <div class="col-md-6 text-left"><h5>Transaksi Online</h5></div>
                    <div class="col-md-6 text-right"><a href="Code_Dtransaksi/c_dtransaksi_reject.php?id_transaksi=<?= $_GET['id']; ?>" class="btn btn-danger btn-sm">Tolak Transaksi</a></div>
                </div>
            <hr>
            
            <table class="table table-bordered table-hover fixed nowrap" id="example1">
                <thead>
                    <tr>
                        <th>ID DTransaksi</th>
                        <th>Nama Transaksi</th>
                        <th>Ukuran</th>
                        <th>Qty</th>
                        <th>Bahan</th>
                        <!-- <th>Ket. Design</th>
                        <th>Total Design</th> -->
                        <th>Total Harga</th>
                        <th>File</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $qtr1 = mysqli_query($koneksi, "SELECT * FROM detail_transaksi dt INNER JOIN
                    file_design fd on dt.id_dtransaksi = fd.id_dtransaksi WHERE dt.id_transaksi = '$_GET[id]' AND dt.jenis_transaksi = 'Cetak'");
                    $rowqtr1 = mysqli_num_rows($qtr1);
                    while($dtr=mysqli_fetch_array($qtr1)){ 
                    
                    $text_tr = $dtr['ukuran_cetak'] == NULL ? 'font-weight-bold text-red' : 'font-weight-bold text-purple'; 
                ?>
                    <tr>
                        <td><?= $dtr['id_dtransaksi'] == NULL ? '-' : $dtr['id_dtransaksi']; ?></td>
                        <td><span class="p-2 <?= $text_tr; ?>"><?= $dtr['nama_transaksi'] == NULL ? '-' : $dtr['nama_transaksi']; ?></span></td>

                        <td><?= $dtr['ukuran_cetak'] == NULL ? '-' : $dtr['ukuran_cetak']; ?></td>  
                        <td><?= $dtr['quantity'] == NULL ? '-' : $dtr['quantity']; ?></td>
                        <td><?= $dtr['jenis_bahan'] == NULL ? '-' : $dtr['jenis_bahan']; ?></td>

                        <td><?= $dtr['total_harga'] == NULL ? '-' : rupiah($dtr['total_harga']); ?></td>
                        <td><a href="<?= $dtr['link_file']; ?>">Download</a> <i class="text-primary fas fa-info-circle note-link<?= $dtr['id_file']; ?>"></i></td>                       
                        <script>
                            $(document).ready(function() {
                                $(".note-link<?= $dtr['id_file'] ?>").click( function(){
                                    Swal.fire({
                                        title: 'Note File',
                                        text: '<?= $dtr['keterangan'] ?>',
                                        icon: 'info',
                                    });
                                });
                            });
                        </script>   
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

                            $bkt  = mysqli_query($koneksi, "SELECT * FROM pembayaran WHERE id_transaksi = '$_GET[id]'");
                            $dbkt = mysqli_fetch_array($bkt);
                        ?>
                        <tr>
                            <th>Jumlah Transaksi</th>
                            <td><?= $djtr['jtr']; ?> Produk</td>
                        </tr>
                        <tr>
                            <th>Total Transaksi</th>
                            <td><?= $dttr['ttr'] == NULL ? '-' : rupiah($dttr['ttr']); ?></td>
                        </tr>
                        <tr>
                            <th>Ket Pembayaran</th>
                            <?php if(mysqli_num_rows($bkt) < 1) { ?>
                                <td><a href="#" class="">-</a></td>
                            <?php }else{ ?>
                                <td>
                                    <a href="../Data_Online/download.php?nama_file=<?= $dbkt['nama_gambar']; ?>" class="btn btn-warning btn-sm">Download</a>
                                    <?php if($dnm['ket_pembayaran'] == "Proses"){ ?>
                                        <a href="#" class="btn btn-success btn-sm konfirmasi">Konfirmasi</a>
                                    <?php } ?>
                                    <i class="text-primary fas fa-info-circle note-down"></i>
                                    <script>
                                        $(document).ready(function() {
                                            $(".note-down").click( function(){
                                                Swal.fire({
                                                    title: 'Note Bukti Bayar',
                                                    text: '<?= $dbkt['keterangan'] ?>',
                                                    icon: 'info',
                                                });
                                            });
                                            $(".konfirmasi").click( function(){
                                                Swal.fire({
                                                    title: 'Apakah yakin ingin konfirmasi ?',
                                                    text: '<?= $dbkt['id_transaksi']; ?>',
                                                    icon: 'info',
                                                    showCancelButton: true,
                                                    confirmButtonText: 'Konfirmasi',
                                                    cancelButtonText: 'Batal'
                                                    }).then((result) => {
                                                    if (result.value) {
                                                        window.location.href="Code_Dtransaksi/c_dtransaksi_konfirmasi.php?id=<?= $dbkt['id_transaksi']; ?>";
                                                    } 
                                                });
                                            });
                                        });
                                    </script>  
                                </td>
                            <?php } ?>
                        </tr>
                    </table>
                </div>
            </div>
        </div> 
    </div>
</div>
<!-- /.content-wrapper -->
<?php include "../footer.php"; ?> 