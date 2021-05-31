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
                    <h4>Transaksi Outdoor - <?= $dnm['nama_customer']; ?></h4>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="../Data_Transaksi/v_transaksi.php">Transaksi</a></li>
                        <li class="breadcrumb-item"><a href="v_dtransaksi.php?id=<?= $_GET['id'] ?>">Detail Transaksi</a></li>
                        <li class="breadcrumb-item">Add Detail Transaksi</li>
                    </ol>
                </div>
            </div>
            <hr>
            <!-- Form add customer -->
            <form class="form-horizontal col-md-6" action="<?= $_SESSION['level'] == "CS" ? 'Code_DTransaksi' : '../Data_Online/Code_Online' ?>/c_dtransaksi_add_outdoor.php" method="post">
                <div class="form-group row">
                    <?php
                        $str     = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                        $rndm    = str_shuffle($str);
                        $sub     = date('dmy').substr($rndm,0,5);
                        $id_dtransaksi = "TO".$sub;
                    ?>
                    <label class="col-md-4 col-form-label">ID DTransaksi</label>
                    <div class="col-md-8">
                        <input type="hidden" class="form-control" id="id_transaksi" name="id_transaksi" value="<?= $_GET['id']; ?>" readonly>
                        <input type="text" class="form-control" id="id_dtransaksi" name="id_dtransaksi" value="<?= $id_dtransaksi; ?>" readonly>
                    </div>
                </div>
                
                <div class="form-group row produk_custom">
                    <label class="col-md-4 col-form-label">Nama Cetak</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="nama_transaksi" id="nama_transaksi">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Jenis bahan</label>
                    <div class="col-md-8">
                        <div class="input-group">
                            <select class="form-control select2 bahan" name="jenis_bahan">
                                <option value="0">- Pilih bahan -</option>
                                <?php
                                    $qjb    = mysqli_query($koneksi,"SELECT * FROM jenis_bahan WHERE ket_bahan = '2' AND status_bahan = 'Tersedia'");
                                    while($djb=mysqli_fetch_array($qjb)){ ?>
                                <option value="<?= $djb['nama_bahan']; ?>"><?=  $djb['nama_bahan']; ?></option>
                                <?php } ?>
                            </select>
                            <input type="text" class="form-control hargaper" placeholder="Harga" readonly>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Ukuran Cetak</label>
                    <div class="col-md-8">
                        <div class="input-group">
                            <input type="text" class="form-control panjang" placeholder="Panjang" name="panjang" id="panjang">
                            <input type="text" class="form-control lebar" placeholder="Lebar" name="lebar" id="lebar">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span>m</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Jumlah Cetak</label>
                    <div class="col-md-8">
                        <input type="number" class="form-control jumlah" value="1" name="quantity" id="quantity">
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Total Cetak</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control total" placeholder="Total" name="total_cetak" id="total_cetak" readonly>
                    </div>
                </div>

                <?php if($_SESSION['level'] == "CS"){ ?>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Design Manual</label>
                        <div class="col-md-8">
                            <select class="form-control select2" name="jasa_design">
                                <option value="0">- Pilih Ket -</option>
                                <option value="Ya">Ya</option>
                                <option value="Tidak">Tidak</option>
                            </select>
                        </div>
                    </div>
                <?php }else{ ?>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Link File</label>
                        <div class="col-md-8">
                            <textarea name="link_file" id="link_file" cols="" rows="2" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Keterangan</label>
                        <div class="col-md-8">
                            <textarea name="ket_file" id="ket_file" cols="" rows="2" class="form-control"></textarea>
                        </div>
                    </div>
                <?php } ?>

                <div class="form-group row">
                    <a href="v_dtransaksi.php?id=<?= $_GET['id']; ?>" class="btn btn-sm btn-danger mr-2">Kembali</a>
                    <input type="submit" class="btn btn-primary btn-sm" value="Simpan">
                </div>
            </form>
        </div> 
    </div>
</div>
<!-- /.content-wrapper -->
<?php include "../footer.php"; ?>
<script>
    $(document).ready(function() {

        $(".bahan").change( function(){
            <?php
                $q11 = mysqli_query($koneksi,"SELECT * FROM jenis_bahan WHERE ket_bahan = '2' AND status_bahan = 'Tersedia'");
                while($d11=mysqli_fetch_array($q11)){ 
            ?>
                if($(".bahan").val()=="<?= $d11['nama_bahan']; ?>"){ 
                
                    $(".total").val(($(".panjang").val() * $(".lebar").val() * <?= $d11['harga_bahan']; ?>) * $(".jumlah").val());
                    $(".hargaper").val("Rp. <?= $d11['harga_bahan']; ?>");
                }
            <?php } ?>
            if($(".bahan").val() == "0"){
                $(".total").val("");
                $(".hargaper").val("");
            }
        }); 

        $(".jumlah, .panjang, .lebar").keyup( function(){
            <?php
                $q11 = mysqli_query($koneksi,"SELECT * FROM jenis_bahan WHERE ket_bahan = '2' AND status_bahan = 'Tersedia'");
                while($d11=mysqli_fetch_array($q11)){ 
            ?>
                if($(".bahan").val()=="<?= $d11['nama_bahan']; ?>"){ 
                
                    $(".total").val(($(".panjang").val() * $(".lebar").val() * <?= $d11['harga_bahan']; ?>) * $(".jumlah").val());
                    $(".hargaper").val("Rp. <?= $d11['harga_bahan']; ?>");
                }
            <?php } ?>
            if($(".bahan").val() == "0"){
                $(".total").val("");
                $(".harga_per").val("");
            }
        });
    });
</script>