<?php $menu = "Design_Saya"; ?>
<?php include "../header.php"; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper p-2">
    <div class="card">
        <div class="card-body table-responsive">
            <div class="row content-header border shadow-sm">
                <div class="col-md-6">
                    <h4>Data Design - Administrator <?= $_SESSION['nama_lengkap']; ?></h4>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb float-md-right">
                        <li class="breadcrumb-item">Data Design</li>
                    </ol>
                </div>
            </div>
            <hr>
            <table class="table table-bordered table-hover fixed nowrap" id="example1">
                <thead>
                    <tr>
                        <th>ID Design</th>
                        <th>ID Dtransaksi</th>
                        <th>Customer</th>
                        <th>Nama Cetak</th>
                        <th>Tanggal Cetak</th>
                        <th>Status</th>
                        <th>Act.</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $qds = mysqli_query($koneksi, "SELECT * FROM `jasa_design` INNER JOIN detail_transaksi on detail_transaksi.id_dtransaksi = jasa_design.id_dtransaksi 
                    INNER JOIN transaksi on transaksi.id_transaksi = detail_transaksi.id_transaksi INNER JOIN customer on customer.id_customer = transaksi.id_customer 
                    WHERE jasa_design.id_user = '$_SESSION[id_user]'");
                    while($dds=mysqli_fetch_array($qds)){ 
                    if($dds['status_cetak'] == "Active"){
                        $stc = "bg-success";
                    }elseif($dds['status_cetak'] == "Proses"){
                        $stc = "bg-primary";
                    }else{
                        $stc = "bg-info";
                    } ?>
                    <tr>
                        <td><?= $dds['id_design']; ?></td>  
                        <td><?= $dds['id_dtransaksi']; ?></td>
                        <td><?= $dds['nama_customer']; ?></td>
                        <td><?= $dds['nama_transaksi']; ?></td>
                        <td><?= $dds['tanggal_cetak'] == NULL ? "-" : tgl($dds['tanggal_cetak']); ?></td>  
                        <td><span class="p-2 <?= $stc; ?>"><?= $dds['status_cetak'] == NULL ? '-' : $dds['status_cetak']; ?></span></td>
                        <td>
                            <!-- Button info -->
                            <a href="#" data-toggle="modal" class="btn btn-sm btn-info" data-target="#InfoDesign<?= $dds['id_design']; ?>"><i class="fas fa-info-circle"></i></a>
                            <!-- Modal info Design-->
                            <div class="modal fade" id="InfoDesign<?= $dds['id_design']; ?>" tabindex="-1" role="dialog" aria-labelledby="InfoDesign<?= $dds['id_design']; ?>Label" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5>Informasi Design</h5>
                                        </div>
                                        <div class="modal-body login-card-body">
                                            <table class="table table-bordered text-dark">
                                                <?php 
                                                    $id_design = $dds['id_design'];
                                                    $qinf = mysqli_query($koneksi, "SELECT * FROM `jasa_design` INNER JOIN detail_transaksi on detail_transaksi.id_dtransaksi = jasa_design.id_dtransaksi 
                                                    INNER JOIN transaksi on transaksi.id_transaksi = detail_transaksi.id_transaksi INNER JOIN customer on customer.id_customer = transaksi.id_customer 
                                                    WHERE jasa_design.id_user = '$_SESSION[id_user]' AND id_design = '$id_design'");
                                                    $dinf = mysqli_fetch_array($qinf);
                                                ?>
                                                <tr><th>Nama File</th><th><?= $dinf['nama_file'] == NULL ? '-' : $dinf['nama_file']; ?></th></tr>
                                                <tr><th>Jenis Bahan</th><th><?= $dinf['jenis_bahan'] == NULL ? '-' : $dinf['jenis_bahan']; ?></th></tr>
                                                <tr><th>Ukuran Cetak</th><th><?= $dinf['ukuran_cetak'] == NULL ? '-' : $dinf['ukuran_cetak']; ?></th></tr>
                                                <tr><th>Waktu Mulai</th><th><?= $dinf['waktu_mulai'] == NULL ? '-' : $dinf['waktu_mulai']; ?></th></tr>
                                                <tr><th>Waktu Selesai</th><th><?= $dinf['waktu_selesai'] == NULL ? '-' : $dinf['waktu_selesai']; ?></th></tr>
                                                <tr><th>Waktu Total</th><th><?= $dinf['waktu_total'] == NULL ? '-' : $dinf['waktu_total']." menit"; ?></th></tr>
                                                <tr><th>Sub Total</th><th><?= $dinf['total_design'] == NULL ? '-' : rupiah($dinf['total_design']); ?></th></tr>
                                                <tr><th>Status</th><th><span class="p-2 <?= $stc; ?>"><?= $dinf['status_cetak'] == NULL ? '-' : $dinf['status_cetak']; ?></span></th></tr>
                                                <?php if($dinf['status_cetak'] == "Proses"){ ?>
                                                    <tr><th class="text-info">Mulai Sekarang</th>
                                                    <th><a href="Code_Design/c_design_act.php?act=acc_design&id=<?= $dinf['id_design']; ?>" class="btn btn-sm btn-info mr-2">Mulai</a><button type="button" class="btn btn-secondary  btn-sm" data-dismiss="modal">Close</button></th></tr>
                                                <?php }elseif($dinf['status_cetak'] == "Selesai"){ ?>
                                                    <tr><th class="text-warning">Transaksi Selesai</th><th></th></tr>
                                                <?php }else{ ?>
                                                    <tr><th class="text-warning">Transaksi Berjalan</th>
                                                    <th><a href="Code_Design/c_design_act.php?act=batal_design&id=<?= $dinf['id_dtransaksi']; ?>" class="btn btn-sm btn-info mr-2">Batal</a><button type="button" class="btn btn-secondary  btn-sm" data-dismiss="modal">Close</button></th></tr>
                                                <?php } ?>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Button info -->
                            <?php if($dds['status_cetak'] == "Active"){ ?>
                                <!-- Button selesai -->
                                <a href="#" data-toggle="modal" class="btn btn-sm btn-success save_design<?= $dds['id_design']; ?>" data-target="#SaveDesign<?= $dds['id_design']; ?>"><i class="fas fa-check"></i></a>
                                <!-- Modal save Design-->
                                <div class="modal fade" id="SaveDesign<?= $dds['id_design']; ?>" tabindex="-1" role="dialog" aria-labelledby="SaveDesign<?= $dds['id_design']; ?>Label" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5>Simpan Design</h5>
                                            </div>
                                            <div class="modal-body login-card-body">
                                                <?php 
                                                    $id_design1 = $dds['id_design'];
                                                    $qsvd = mysqli_query($koneksi, "SELECT * FROM `jasa_design` INNER JOIN detail_transaksi on detail_transaksi.id_dtransaksi = jasa_design.id_dtransaksi 
                                                    INNER JOIN transaksi on transaksi.id_transaksi = detail_transaksi.id_transaksi INNER JOIN customer on customer.id_customer = transaksi.id_customer 
                                                    WHERE jasa_design.id_user = '$_SESSION[id_user]' AND id_design = '$id_design1'");
                                                    $dsvd = mysqli_fetch_array($qsvd);

                                                    $pm1                 = mysqli_query($koneksi, "SELECT * FROM konfigurasi WHERE jenis_konfigurasi = '2'");
                                                    $dpm1                = mysqli_fetch_array($pm1);
                                                    $bil_per1            = $dpm1['isi_konfigurasi'];
                                                ?>
                                                <form action="Code_Design/c_design_act.php?act=save_design&id=<?= $dsvd['id_design']; ?>" method="post">
                                                    <table class="table table-bordered text-dark">
                                                    <script>
                                                        $(document).ready(function() {
                                                            
                                                            $(".save_design<?= $dsvd['id_design']; ?>").click( function(){
                                                                setInterval(function(){ 
                                                                    var dt   = new Date();
                                                                     var time = dt.getHours() + ":" + dt.getMinutes();
                                                                    $(".waktu_selesai<?= $dsvd['id_design']; ?>").text(time)
                                                                    
                                                                    var waktu_mulai     = $(".waktu_mulai<?= $dsvd['id_design']; ?>").text();
                                                                    var sp_waktu_mulai  = waktu_mulai.split(":");

                                                                    var total_jam_mulai = sp_waktu_mulai[0] * 60;
                                                                    var total_mnt_mulai = sp_waktu_mulai[1];
                                                                    var total_menit1    = parseInt(total_jam_mulai) + parseInt(total_mnt_mulai);
                                                                
                                                                    var waktu_selesai     = $(".waktu_selesai<?= $dsvd['id_design']; ?>").text();
                                                                    var sp_waktu_selesai  = waktu_selesai.split(":");

                                                                    var total_jam_selesai = sp_waktu_selesai[0] * 60;
                                                                    var total_mnt_selesai = sp_waktu_selesai[1];
                                                                    var total_menit2      = parseInt(total_jam_selesai) + parseInt(total_mnt_selesai);

                                                                    var total_menit       = parseInt(total_menit2) - parseInt(total_menit1) + " menit";
                                                                    $(".waktu_total<?= $dsvd['id_design']; ?>").text(total_menit);
                                                                    $(".sub_total<?= $dsvd['id_design']; ?>").text("Rp. " + parseInt(total_menit) * parseInt("<?= $bil_per1; ?>"));

                                                                }, 100);
                                                            });
                                                        });
                                                        </script>
                                                        <tr><th>Waktu Mulai</th><th><span class="waktu_mulai<?= $dsvd['id_design']; ?>"><?= $dsvd['waktu_mulai'] == NULL ? '-' : $dsvd['waktu_mulai']; ?></th></span></tr>
                                                        <tr><th>Waktu Selesai</th><th><span class="waktu_selesai<?= $dsvd['id_design']; ?>"></span></th></tr>
                                                        <tr><th>Waktu Total</th><th><span class="waktu_total<?= $dsvd['id_design']; ?>"></span></th></tr>
                                                        <tr><th>Sub Total</th><th><span class="sub_total<?= $dsvd['id_design']; ?>"></span></th></tr>
                                                        <tr><th>Status</th><th><span class="p-2 <?= $dsvd['status_cetak'] == "Active" ? "text-success" : "text-primary" ?>"><?= $dsvd['status_cetak'] == NULL ? '-' : $dsvd['status_cetak']; ?></span></th></tr>
                                                        <tr>
                                                            <th>Nama File</th>
                                                            <th><input type="text" class="form-control" name="nama_file" id="nama_file" value="" >
                                                            <!-- $dsvd['nama_customer']."_".$dsvd['jenis_bahan']."_".date('Y-m-d'); ?> -->
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th class="text-success">Konfirmasi Sekarang</th>
                                                            <th>
                                                                <button type="submit" class="btn btn-success btn-sm">Save</button>
                                                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                                            </th>
                                                        </tr>                                                    
                                                    </table>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if($dds['status_cetak'] == "Proses"){ ?>
                                <a href="#" class="btn btn-sm btn-danger hapus-design<?= $dds['id_design'] ?>"><i class="fas fa-times-circle"></i></a>
                                <script>
                                    $(document).ready(function() {
                                        $(".hapus-design<?= $dds['id_design'] ?>").click( function(){
                                            Swal.fire({
                                            title: 'Apakah yakin ingin membatalkan ?',
                                            text: '<?= $dds['id_design']; ?>',
                                            icon: 'info',
                                            showCancelButton: true,
                                            confirmButtonText: 'Konfirmasi',
                                            cancelButtonText: 'Batal'
                                            }).then((result) => {
                                                if (result.value) {
                                                    window.location.href='Code_Design/c_design_del.php?id=<?= $dds['id_dtransaksi']; ?>';
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
        </div> 
    </div>
</div>
<!-- /.content-wrapper -->
<?php include "../footer.php"; ?>