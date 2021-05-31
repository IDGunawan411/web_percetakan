<?php
    if(isset($_GET['ps'])){
        // Data Transaksi

        $ps_tr  = array("transaksi_kurang","transaksi_sukses","transaksi_hapus","tr_belum_selesai","transaksi_pen");
        $ic_tr  = array("warning", "success", "info", "warning","warning");
        $tltr   = array("Data transaksi belum lengkap !","Data transaksi berhasil disimpan !","Data transaksi berhasil dihapus !","Data design maasih proses !","Mohon selesaikan transaksi lain !"); 

        for($i_tr = 0;$i_tr < 5;$i_tr++){
            if($_GET['ps']==$ps_tr["$i_tr"]){ ?>
                <script type='text/javascript'>
                    $(document).ready( function() {
                    //     const Toast = Swal.mixin({
                    //         toast: true,
                    //         position: 'top-end',
                    //         showConfirmButton: false,
                    //         timer: 1500
                    //     });
                        Swal.fire({
                            icon: "<?= $ic_tr[$i_tr]; ?>",
                            title: '&nbsp;&nbsp; <?= $tltr[$i_tr]; ?>',
                        })
                    });
                </script> 
                <?php
            } 
        }
        // Data Customer
        $ps_cst  = array("customer_kurang","customer_sukses","customer_hapus","invalid_img");
        $ic_cst  = array("warning", "success", "error","error");
        $tlcst   = array("Data customer belum lengkap !","Data Customer berhasil disimpan !","Data Customer berhasil dihapus !","Upload Gagal !"); 

        for($i_cst = 0;$i_cst < 4;$i_cst++){
            if($_GET['ps']==$ps_cst["$i_cst"]){ ?>
                <script type='text/javascript'>
                    $(document).ready( function() {
                        // const Toast = Swal.mixin({
                        //     toast: true,
                        //     position: 'top-end',
                        //     showConfirmButton: false,
                        //     timer: 1500
                        // });
                        Swal.fire({
                            icon: "<?= $ic_cst[$i_cst]; ?>",
                            title: '&nbsp;&nbsp; <?= $tlcst[$i_cst]; ?>',
                            showConfirmButton: true,
                        })
                    });
                </script> 
                <?php
            } 
        }

        // Data Produk
        $ps_prd  = array("produk_kurang","produk_sukses","produk_hapus");
        $ic_prd  = array("warning", "success", "error");
        $tlprd   = array("Data Produk belum lengkap !","Data Produk berhasil disimpan !","Data Produk berhasil dihapus !"); 

        for($i_prd = 0;$i_prd < 3;$i_prd++){
            if($_GET['ps']==$ps_prd["$i_prd"]){ ?>
                <script type='text/javascript'>
                    $(document).ready( function() {
                        // const Toast = Swal.mixin({
                        //     toast: true,
                        //     position: 'top-end',
                        //     showConfirmButton: false,
                        //     timer: 1500
                        // });
                        Swal.fire({
                            icon: "<?= $ic_prd[$i_prd]; ?>",
                            title: '&nbsp;&nbsp; <?= $tlprd[$i_prd]; ?>',
                            showConfirmButton: true,
                        })
                    });
                </script> 
                <?php
            } 
        }

        // Data bahan
        $ps_bhn  = array("bahan_kurang","bahan_sukses","bahan_hapus");
        $ic_bhn  = array("warning","success","error");
        $tlbhn   = array("Data bahan belum lengkap !","Data bahan berhasil disimpan !","Data bahan berhasil dihapus !"); 

        for($i_bhn = 0;$i_bhn < 3;$i_bhn++){
            if($_GET['ps']==$ps_bhn["$i_bhn"]){ ?>
                <script type='text/javascript'>
                    $(document).ready( function() {
                        // const Toast = Swal.mixin({
                        //     toast: true,
                        //     position: 'top-end',
                        //     showConfirmButton: false,
                        //     timer: 1500
                        // });
                        Swal.fire({
                            icon: "<?= $ic_bhn[$i_bhn]; ?>",
                            title: '&nbsp;&nbsp; <?= $tlbhn[$i_bhn]; ?>',
                            showConfirmButton: true,
                        })
                    });
                </script> 
                <?php
            } 
        }

        // Data design
        $ps_dsn  = array("konfirm_design","design_mulai","design_batal","save_design","design_hapus","masukan_tgl");
        $ic_dsn  = array("success","success","info","success","error","info");
        $tldsn   = array("Pengajuan telah di konfirmasi !","Design telah di mulai !","Design telah di batalkan !","Design telah di selesaikan !","Pegajuan telah dibatalkan !","Harap masukan tanggal !"); 

        for($i_dsn = 0;$i_dsn < 6;$i_dsn++){
            if($_GET['ps']==$ps_dsn["$i_dsn"]){ ?>
                <script type='text/javascript'>
                    $(document).ready( function() {
                        // const Toast = Swal.mixin({
                        //     toast: true,
                        //     position: 'top-end',
                        //     showConfirmButton: false,
                        //     timer: 1500
                        // });
                        Swal.fire({
                            icon: "<?= $ic_dsn[$i_dsn]; ?>",
                            title: '&nbsp;&nbsp; <?= $tldsn[$i_dsn]; ?>',
                            showConfirmButton: true,
                        })
                    });
                </script> 
                <?php
            } 
        }

        // Data konfigurasi
        $ps_conf  = array("sukses_konf");
        $ic_conf  = array("success");
        $tlconf   = array("Data Konfigurasi Berhasil Disimpan !"); 

        for($i_conf = 0;$i_conf < 1;$i_conf++){
            if($_GET['ps']==$ps_conf["$i_conf"]){ ?>
                <script type='text/javascript'>
                    $(document).ready( function() {
                        // const Toast = Swal.mixin({
                        //     toast: true,
                        //     position: 'top-end',
                        //     showConfirmButton: false,
                        //     timer: 1500
                        // });
                        Swal.fire({
                            icon: "<?= $ic_conf[$i_conf]; ?>",
                            title: '&nbsp;&nbsp; <?= $tlconf[$i_conf]; ?>',
                            showConfirmButton: true,
                        })
                    });
                </script> 
                <?php
            } 
        }
    }
?>