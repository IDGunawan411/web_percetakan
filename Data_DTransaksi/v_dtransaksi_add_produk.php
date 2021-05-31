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
                    <h4>Transaksi Produk - <?= $dnm['nama_customer']; ?></h4>
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
            <form class="form-horizontal col-md-6" action="Code_DTransaksi/c_dtransaksi_add_produk.php" method="post">
                <div class="form-group row">
                    <?php
                        $str     = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                        $rndm    = str_shuffle($str);
                        $sub     = date('dmy').substr($rndm,0,5);
                        $id_dtransaksi = "TP".$sub;
                    ?>
                    <label class="col-md-4 col-form-label">ID DTransaksi</label>
                    <div class="col-md-8">
                        <input type="hidden" class="form-control" id="id_transaksi" name="id_transaksi" value="<?= $_GET['id']; ?>" readonly>
                        <input type="text" class="form-control" id="id_dtransaksi" name="id_dtransaksi" value="<?= $id_dtransaksi; ?>" readonly>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Nama Produk</label>
                    <div class="col-md-8">
                        <div class="input-group">
                            <select class="form-control select2 nama_transaksi" name="nama_transaksi" id="nama_transaksi">
                                <option value="0">- Pilih Produk -</option>
                                <?php
                                    $qcs    = mysqli_query($koneksi,"SELECT * FROM jenis_produk");
                                    while($dcs=mysqli_fetch_array($qcs)){ ?>
                                <option value="<?= $dcs['nama_produk']; ?>"><?=  $dcs['nama_produk']; ?></option>
                                <?php } ?>
                            </select>
                            <input type="text" class="form-control harga_produk"  name="harga_produk" id="harga_produk" readonly>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Jumlah</label>
                    <div class="col-md-8">
                        <input type="number" class="form-control jumlah" value="1" name="quantity" id="quantity">
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Total Harga</label>
                    <div class="col-md-8">
                        <input type="number" class="form-control total" placeholder="Total" name="total_harga" id="total_harga">
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Ket Transaksi</label>
                    <div class="col-md-8">
                        <textarea name="ket_transaksi" class="form-control" id="ket_transaksi" rows="2"></textarea>
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
        $(".nama_transaksi").change( function(){
            <?php
                $q1 = mysqli_query($koneksi,"SELECT * FROM jenis_produk");
                while($d1=mysqli_fetch_array($q1)){ 
            ?>
                if($(".nama_transaksi").val()=="<?= $d1['nama_produk']; ?>"){ 
                    $(".total").val($(".jumlah").val() * <?= $d1['harga_produk']; ?>);
                    $(".harga_produk").val("Rp. <?= $d1['harga_produk']; ?>");
                }
            <?php } ?>
            if($(".nama_transaksi").val() == "0"){
                $(".total").val("");
                $(".harga_produk").val("");
            }
        });
        $(".jumlah").keyup( function(){
            <?php
                $q1 = mysqli_query($koneksi,"SELECT * FROM jenis_produk");
                while($d1=mysqli_fetch_array($q1)){ 
            ?>
                if($(".nama_transaksi").val()=="<?= $d1['nama_produk']; ?>"){ 
                    $(".total").val($(".jumlah").val() * <?= $d1['harga_produk']; ?>);
                    $(".harga_produk").val("Rp. <?= $d1['harga_produk']; ?>");
                }
            <?php } ?>
            if($(".nama_transaksi").val() == "0"){
                $(".total").val("");
            }
        });
    });
</script>