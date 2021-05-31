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
                    <h4>Tambah Detail Transaksi - <?= $dnm['nama_customer']; ?></h4>
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
            <form class="form-horizontal col-md-6" action="Code_DTransaksi/c_dtransaksi_add.php" method="post">
                <div class="form-group row">
                    <?php
                        $str     = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                        $rndm    = str_shuffle($str);
                        $sub     = date('dmy').substr($rndm,0,5);
                        $id_dtransaksi = "DT".$sub;
                    ?>
                    <label class="col-md-4 col-form-label">ID DTransaksi</label>
                    <div class="col-md-8">
                        <input type="hidden" class="form-control" id="id_transaksi" name="id_transaksi" value="<?= $_GET['id']; ?>" readonly>
                        <input type="text" class="form-control" id="id_dtransaksi" name="id_dtransaksi" value="<?= $id_dtransaksi; ?>" readonly>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Pilih Produk</label>
                    <div class="col-md-8">
                        <select class="form-control select2 pilih-produk" name="pilih_produk">
                            <option value="0">- Pilih Produk -</option>
                            <option value="1">Sudah Ada</option>
                            <option value="2">Custom</option>
                        </select>
                    </div>
                </div>
                
                <div class="nama_produk1">
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Nama Produk</label>
                        <div class="col-md-8">
                            <select class="form-control select2 sc_produk" name="nama_produk1" id="nama_produk1">
                                <option value="0">- Pilih Produk -</option>
                                <?php
                                    $qcs    = mysqli_query($koneksi,"SELECT * FROM jenis_produk");
                                    while($dcs=mysqli_fetch_array($qcs)){ ?>
                                <option value="<?= $dcs['nama_produk']; ?>"><?=  $dcs['nama_produk']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="nama_produk2">
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Nama Produk</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control nama_produk2" id="nama_produk2" name="nama_produk2" value="">                        
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Jenis bahan</label>
                    <div class="col-md-8">
                        <div class="input-group">
                            <select class="form-control select2 bahan" name="jenis_bahan">
                                <option value="0">- Pilih bahan -</option>
                                <?php
                                    $qjb    = mysqli_query($koneksi,"SELECT * FROM jenis_bahan");
                                    while($djb=mysqli_fetch_array($qjb)){ ?>
                                <option data-id="<?= $djb['ket_bahan'] ?>" value="<?= $djb['nama_bahan']; ?>"><?=  $djb['ket_bahan'] == "1" ? $djb['nama_bahan']." - Harga tetap" : $djb['nama_bahan']; ?></option>
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
                                    <span>cm</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Jumlah Cetak</label>
                    <div class="col-md-8">
                        <input type="number" class="form-control jumlah" value="1" name="jumlah_cetak" id="jumlah_cetak">
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Total Cetak</label>
                    <div class="col-md-8">
                        <input type="number" class="form-control total" placeholder="Total" name="total_cetak" id="total_cetak">
                    </div>
                </div>
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

        $(".nama_produk1").hide();      
        $(".nama_produk2").hide();            
        $(".pilih-produk").change( function(){
            var pp = $(this).find(':selected').val(); 
            if(pp == "1"){
                $(".nama_produk1").show();
                $(".nama_produk2").hide();
                $(".nama_produk2").val("");
                $(".sc_produk").attr("name","nama_produk1");
            }else if(pp == "2"){
                $(".nama_produk1").hide();
                $(".nama_produk2").show();
                $(".sc_produk").removeAttr('name');
            }else{
                $(".nama_produk1").hide();
                $(".nama_produk2").hide(); 
                $(".nama_produk2").val("");
                $(".sc_produk").attr("name","nama_produk1");
            }
        });

        $(".bahan").change( function(){

            var data_ket = $(this).find(':selected').data('id'); 
            if(data_ket=="1"){
            <?php
                $q1 = mysqli_query($koneksi,"SELECT * FROM jenis_bahan WHERE ket_bahan = '1'");
                while($d1=mysqli_fetch_array($q1)){ 
            ?>
                if($(".bahan").val()=="<?= $d1['nama_bahan']; ?>"){ 
                    $(".total").val($(".jumlah").val() * <?= $d1['harga_fix']; ?>);
                    $(".hargaper").val("Rp. <?= $d1['harga_fix']; ?>");
                    $(".panjang").attr("readonly",true);
                    $(".lebar").attr("readonly",true);
                    $(".panjang").val("-");
                    $(".lebar").val("-");
                }
            <?php } ?>
            }else{
            <?php
                $q2 = mysqli_query($koneksi,"SELECT * FROM jenis_bahan WHERE ket_bahan = '2'");
                while($d2=mysqli_fetch_array($q2)){ 
            ?>
                if($(".bahan").val()=="<?= $d2['nama_bahan']; ?>"){ 
            
                    $(".total").val($(".panjang").val() * $(".lebar").val() * $(".jumlah").val() * <?= $d2['harga_custom']; ?>);
                    $(".hargaper").val("Rp. <?= $d2['harga_custom']; ?>/cm");         
                    $(".panjang").attr("readonly",false);
                    $(".lebar").attr("readonly",false);
                    $(".panjang").val("");
                    $(".lebar").val("");
                }
            <?php } ?>
            }
            if($(".bahan").val() == "0"){
                $(".total").val("");
            }
        });

                 
        $(".panjang, .lebar, .jumlah").keyup( function(){

            var data_ket1 = $(".bahan").find(':selected').data('id'); 
            if(data_ket1=="1"){
            <?php
                $q11 = mysqli_query($koneksi,"SELECT * FROM jenis_bahan WHERE ket_bahan = '1'");
                while($d11=mysqli_fetch_array($q11)){ 
            ?>
                if($(".bahan").val()=="<?= $d11['nama_bahan']; ?>"){ 
                
                    $(".total").val($(".jumlah").val() * <?= $d11['harga_fix']; ?>);
                    $(".hargaper").val("Rp. <?= $d11['harga_fix']; ?>");
                    $(".panjang").attr("readonly",true);
                    $(".lebar").attr("readonly",true);
                    $(".panjang").val("-");
                    $(".lebar").val("-");
                }
            <?php } ?>
            }else{
            <?php
                $q22 = mysqli_query($koneksi,"SELECT * FROM jenis_bahan WHERE ket_bahan = '2'");
                while($d22=mysqli_fetch_array($q22)){ 
            ?>
                if($(".bahan").val()=="<?= $d22['nama_bahan']; ?>"){ 
            
                    $(".total").val($(".panjang").val() * $(".lebar").val() * $(".jumlah").val() * <?= $d22['harga_custom']; ?>);
                    $(".hargaper").val("Rp. <?= $d22['harga_custom']; ?>/cm");         
                    $(".panjang").attr("readonly",false);
                    $(".lebar").attr("readonly",false);

                }
            <?php } ?>
            }
            if($(".bahan").val() == "0"){
                $(".total").val("");
            }
        });
    });
</script>