<?php
    // update data transaksi terbaru
    if($_SERVER['REQUEST_METHOD']=="POST"){
        session_start();
        include "../../koneksi.php";

        // upload bukti
        $namaFile = $_FILES['bukti_bayar']['name'];
        $namaSementara = $_FILES['bukti_bayar']['tmp_name'];
        $type = $_FILES['bukti_bayar']['type'];
        $dirUpload = "../Bukti_Bayar/";

        if (strpos($namaFile, '.jpg') == true || strpos($namaFile, '.JPG') == true || strpos($namaFile, '.PNG') == true || strpos($namaFile, '.png') == true) {
            // echo 'benar';
            $namaBaru = "";
            $date     = date('Y-m-d');
            $exts = array(".jpg", ".JPG", ".png", ".PNG");
            
            foreach ($exts as $jenis_file) {
                if(strpos($namaFile, $jenis_file) == true){
                    $namaBaru = "$_GET[id]-$_SESSION[nama_lengkap]-$date".$jenis_file;
                }
            }
            $terupload = move_uploaded_file($namaSementara, $dirUpload.$namaBaru);

            // update data
            $jtr  = mysqli_query($koneksi, "SELECT COUNT(id_dtransaksi) as jtr FROM detail_transaksi WHERE id_transaksi = '$_GET[id]'");
            $djtr = mysqli_fetch_array($jtr);
            $ttr  = mysqli_query($koneksi, "SELECT SUM(total_harga) as ttr FROM detail_transaksi WHERE id_transaksi = '$_GET[id]'");
            $dttr = mysqli_fetch_array($ttr);  

            $id_transaksi   = $_GET['id'];
            $jumlah_baru    = $djtr['jtr'];
            $total_baru     = $dttr['ttr'];
            $nama_gambar    = $namaBaru;
            $keterangan     = $_POST['keterangan'] == NULL ? '-' : $_POST['keterangan'];
            $ket_pembayaran = "Proses";

            //id pembayaran
            $str                = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $rndm               = str_shuffle($str);
            $sub                = date('dmy').substr($rndm,0,5);
            $id_pembayaran      = "PM".$sub;
            $waktu_upload       = date('Y-m-d H:i:s');
            //insert bukti bayar
            mysqli_query($koneksi,"UPDATE transaksi SET jumlah_transaksi = '$jumlah_baru', total_transaksi = '$total_baru', ket_pembayaran = '$ket_pembayaran' WHERE id_transaksi = '$id_transaksi'");
            //update data transaksi
            mysqli_query($koneksi,"INSERT INTO pembayaran(id_pembayaran,id_transaksi,nama_gambar,keterangan,waktu_upload) VALUES ('$id_pembayaran','$id_transaksi','$nama_gambar','$keterangan','$waktu_upload')");
            header("location:../../Data_Online/v_transaksi_on.php?ps=transaksi_sukses");

        }else{
            $id_transaksi = $_GET['id'];
            header("location:../v_pembayaran.php?id=$id_transaksi&ps=invalid_img");
        }
    }
?>