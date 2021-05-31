<?php $menu = "CS_Konfigurasi"; ?>
<?php include "../header.php"; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper p-2">
    <div class="card">
        <div class="card-body table-responsive">
            <div class="row content-header border shadow-sm">
                <div class="col-md-6">
                    <h4>Data Konfigurasi</h4>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="#">Konfigurasi</a></li>
                        <li class="breadcrumb-item">Data Konfigurasi</li>
                    </ol>
                </div>
            </div>
            <hr>
            <div class="col-md-8">
                <form action="Code_Konfigurasi/c_konfigurasi_upd.php" method="post">
                <?php 
                    $read         = "readonly";
                    $visible      = "hidden";
                    $visible2     = "";
                    if(isset($_GET['read'])){
                        $read     = "";
                        $visible  = "";
                        $visible2 = "hidden";
                    }
                $kon = mysqli_query($koneksi, "SELECT * FROM konfigurasi");
                while($dkon=mysqli_fetch_array($kon)){ ?>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label"><?= $dkon['nama_konfigurasi']; ?></label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <?php if($dkon['jenis_konfigurasi']=="2"){ ?>
                                    <div class="input-group">
                                        <input type="number" class="konfigurasi<?= $dkon['id_konfigurasi'] ?> form-control" name="konfigurasi<?= $dkon['id_konfigurasi'] ?>" value="<?= $dkon['isi_konfigurasi']; ?>" <?= $read; ?>>
                                        <input type="text" class="col-md-3 form-control" value="permenit" readonly>
                                    </div>
                                <?php }else{ ?>
                                    <textarea name="konfigurasi<?= $dkon['id_konfigurasi'] ?>" class="konfigurasi<?= $dkon['id_konfigurasi'] ?> form-control" rows="2" <?= $read; ?>><?= $dkon['isi_konfigurasi']; ?></textarea>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                    <div class="form-group row">
                        <div class="col-md-4"></div>
                        <div class="col-md-8">
                            <div class="input-group">
                                <a href="v_konfigurasi.php" class="hiden_batal btn btn-danger btn-sm mr-2" <?= $visible; ?>>Batal</a> 
                                <input type="submit" value="Simpan" class="hiden_save btn btn-primary btn-sm" <?= $visible; ?>>

                                <a href="v_konfigurasi.php?read=read" class="btn btn-info btn-sm" <?= $visible2; ?>>Update</a>
                                <!-- <a href="#" class="read btn btn-info btn-sm" <?= $visible2; ?>>Update</a>  -->

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div> 
    </div>
</div>
<!-- /.content-wrapper -->
<?php include "../footer.php"; ?>
<!-- <script>
$(document).ready(function() {

    $(".read").click( function(){
        $(".hiden_save").removeAttr("hidden");
        $(".hiden_batal").removeAttr("hidden");
        $(".read").attr("hidden",true);

        for (var i = 1; i < 6;i++) {
            $(".konfigurasi" + i).removeAttr("readonly");
        }
    });
});
</script> -->