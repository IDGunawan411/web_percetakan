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
        $jasa_design        = $_POST['jasa_design'];
        $ket_design         = $jasa_design == "Ya" ? "Proses" : NULL;
        $total_design       = NULL;
        $total_harga        = $_POST['total_cetak'];
        $jenis_transaksi    = "Cetak";
        $ket_transaksi      = NULL;

        if($nama_transaksi == NULL  || $quantity == NULL || $quantity == "0" || $jenis_bahan == "0" || $total_cetak == NULL || $jasa_design == "0" || $total_harga == NULL){
            header("location:../v_dtransaksi_add_indoor.php?id=$id_transaksi&ps=transaksi_kurang");
        }else{
            mysqli_query($koneksi,"INSERT INTO detail_transaksi(id_dtransaksi, id_transaksi, nama_transaksi, ukuran_cetak, quantity, jenis_bahan, total_cetak, jasa_design, ket_design, total_design, total_harga, jenis_transaksi, ket_transaksi)
            VALUES('$id_dtransaksi','$id_transaksi','$nama_transaksi','$ukuran_cetak','$quantity','$jenis_bahan','$total_cetak','$jasa_design','$ket_design','$total_design','$total_harga','$jenis_transaksi','$ket_transaksi')");    

            header("location:../v_dtransaksi.php?id=$id_transaksi&ps=transaksi_sukses");
        }
    }  
?>