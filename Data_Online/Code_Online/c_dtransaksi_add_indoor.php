<?php
    // post detail transaksi produk indoor
    include "../../koneksi.php";
    if($_SERVER['REQUEST_METHOD']=="POST"){

        $id_dtransaksi      = $_POST['id_dtransaksi'];
        $id_transaksi       = $_POST['id_transaksi'];
        $nama_transaksi     = $_POST['nama_transaksi'];
        $ukuran_cetak       = NULL;
        $quantity           = $_POST['quantity']; 
        $jenis_bahan        = $_POST['jenis_bahan'];        
        $total_cetak        = $_POST['total_cetak'];
        $jasa_design        = "Tidak";
        $ket_design         = NULL;
        $total_design       = NULL;
        $total_harga        = $_POST['total_cetak'];
        $jenis_transaksi    = "Cetak";
        $ket_transaksi      = NULL;

        $str                = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $rndm               = str_shuffle($str);
        $sub                = date('dmy').substr($rndm,0,5);
        $id_file            = "FL".$sub;
        $link_file          = $_POST['link_file'];
        $ket_file           = $_POST['ket_file'];

        if($nama_transaksi == NULL  || $quantity == NULL || $quantity == "0" || $jenis_bahan == "0" || $total_cetak == NULL || $jasa_design == "0" || $total_harga == NULL){
            header("location:../v_dtransaksi_add_indoor.php?id=$id_transaksi&ps=transaksi_kurang");
        }else{
            mysqli_query($koneksi,"INSERT INTO detail_transaksi(id_dtransaksi, id_transaksi, nama_transaksi, ukuran_cetak, quantity, jenis_bahan, total_cetak, jasa_design, ket_design, total_design, total_harga, jenis_transaksi, ket_transaksi)
            VALUES('$id_dtransaksi','$id_transaksi','$nama_transaksi','$ukuran_cetak','$quantity','$jenis_bahan','$total_cetak','$jasa_design','$ket_design','$total_design','$total_harga','$jenis_transaksi','$ket_transaksi')");    
            
            mysqli_query($koneksi,"INSERT INTO file_design(id_file, id_dtransaksi, link_file, keterangan)
            VALUES('$id_file','$id_dtransaksi','$link_file','$ket_file')");    

            header("location:../v_dtransaksi_cst.php?id=$id_transaksi&ps=transaksi_sukses");
        }
    }  
?>