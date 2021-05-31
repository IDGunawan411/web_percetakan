<?php
    if(isset($_GET['act'])){
        session_start();
        date_default_timezone_set("Asia/Jakarta");
        include "../../koneksi.php";
        if($_GET['act'] == "acc_pengajuan"){

            // Insert design
            $str     = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $rndm    = str_shuffle($str);
            $sub     = date('dmy').substr($rndm,0,5);

            $id_design          = "DS".$sub;
            $id_dtransaksi      = $_GET['id'];
            $id_user            = $_SESSION['id_user'];
            $tanggal_cetak      = date('Y-m-d');
            $waktu_mulai        = NULL;
            $waktu_selesai      = NULL;
            $waktu_total        = NULL;
            $status_cetak_ds    = "Proses";
            $status_cetak_tr    = "Active";
            $total_design       = NULL;
            $nama_file          = NULL;

            mysqli_query($koneksi, "INSERT INTO jasa_design(id_design,id_dtransaksi,id_user,tanggal_cetak,waktu_mulai,waktu_selesai,waktu_total,status_cetak,total_design,nama_file) 
            VALUES('$id_design','$id_dtransaksi','$id_user','$tanggal_cetak','$waktu_mulai','$waktu_selesai','$waktu_total','$status_cetak_ds','$total_design','$nama_file')");
            
            mysqli_query($koneksi, "UPDATE detail_transaksi SET ket_design = '$status_cetak_tr' WHERE id_dtransaksi = '$id_dtransaksi'");
            header("location:../v_design.php?ps=konfirm_design");
        }
        if($_GET['act'] == "acc_design"){
            $id_design          = $_GET['id'];
            $waktu_mulai        = date('H:i');
            $status_cetak       = "Active";

            mysqli_query($koneksi, "UPDATE jasa_design SET status_cetak = '$status_cetak', waktu_mulai = '$waktu_mulai' WHERE id_design = '$id_design'");
            header("location:../v_design.php?ps=design_mulai");
        }
        if($_GET['act'] == "batal_design"){
            $id_dtransaksi      = $_GET['id'];
            $waktu_mulai        = NULL;
            $status_cetak       = "Proses";

            mysqli_query($koneksi, "UPDATE jasa_design SET status_cetak = '$status_cetak', waktu_mulai = '$waktu_mulai' WHERE id_dtransaksi = '$id_dtransaksi'");
            header("location:../v_design.php?ps=design_batal");
        }
        if($_GET['act'] == "save_design"){
            if($_SERVER["REQUEST_METHOD"]=="POST"){
                $id_design          = $_GET['id'];
                $nama_file          = $_POST['nama_file'];
                // Update waktu selesai
                $waktu_selesai_upd  = date("H:i");
                mysqli_query($koneksi, "UPDATE jasa_design SET waktu_selesai = '$waktu_selesai_upd' WHERE id_design = '$id_design'");
                
                // Get waktu selesai
                $svd                = mysqli_query($koneksi,"SELECT * FROM jasa_design WHERE id_design = '$id_design'");
                $dsvd               = mysqli_fetch_array($svd);
                $waktu_mulai        = $dsvd['waktu_mulai'];
                $waktu_selesai      = $dsvd['waktu_selesai'];
                $id_dtransaksi      = $dsvd['id_dtransaksi'];

                // Get current total harga 
                $curr               = mysqli_query($koneksi,"SELECT * FROM detail_transaksi WHERE id_dtransaksi = '$id_dtransaksi'");
                $dcurr              = mysqli_fetch_array($curr);
                $total_harga        = $dcurr['total_harga'];

                // Total waktu mulai (menit)
                $ex_waktu_mulai     = explode(":",$waktu_mulai);
                $jam_mulai          = $ex_waktu_mulai[0] * 60;
                $mnt_mulai          = $ex_waktu_mulai[1];
                $total_mulai        = $jam_mulai + $mnt_mulai;

                // Total waktu selesai (menit)
                $ex_waktu_selesai   = explode(":",$waktu_selesai);
                $jam_selesai        = $ex_waktu_selesai[0] * 60;
                $mnt_selesai        = $ex_waktu_selesai[1];
                $total_selesai      = $jam_selesai + $mnt_selesai;

                // Total waktu keseluruhan (menit)
                $pm                 = mysqli_query($koneksi, "SELECT * FROM konfigurasi WHERE jenis_konfigurasi = '2'");
                $dpm                = mysqli_fetch_array($pm);
                $bil_per            = $dpm['isi_konfigurasi'];

                $waktu_total        = $total_selesai - $total_mulai;
                $sub_total          = $waktu_total * $bil_per;
                $total_harga_upd    = $sub_total + $total_harga;
                
                // Update data terbaru
                $status_cetak       = "Selesai";
                $ket_design         = "Selesai";
                mysqli_query($koneksi, "UPDATE jasa_design SET waktu_total = '$waktu_total', status_cetak = '$status_cetak', total_design = '$sub_total', nama_file = '$nama_file' WHERE id_design = '$id_design'");
                mysqli_query($koneksi, "UPDATE detail_transaksi SET ket_design = '$ket_design', total_design = '$sub_total', total_harga = '$total_harga_upd' WHERE id_dtransaksi = '$id_dtransaksi'");

                header("location:../v_design.php?ps=save_design");

                // echo "Mulai : $waktu_mulai";
                // echo "<br>";
                // echo "Total Mulai : $total_mulai";
                // echo "<br>";
                // echo "Selesai : $waktu_selesai";
                // echo "<br>";
                // echo "Total Selesai : $total_selesai";
                // echo "<br>";
                // echo "Total Wkatu $waktu_total";
            }
        }
    }
?>
