<?php
    // post detail transaksi produk fix
    include "../../koneksi.php";
    if($_SERVER['REQUEST_METHOD']=="POST"){

        $id_dtransaksi      = $_POST['id_dtransaksi'];
        $id_transaksi       = $_POST['id_transaksi'];
        $nama_transaksi     = $_POST['nama_transaksi'];
        $ukuran_cetak       = NULL; 
        $quantity           = $_POST['quantity']; 
        $jenis_bahan        = NULL;        
        $total_cetak        = NULL;
        $jasa_design        = NULL;
        $ket_design         = NULL;
        $total_design       = NULL;
        $total_harga        = $_POST['total_harga'];
        $jenis_transaksi    = "Produk";
        $ket_transaksi      = $_POST['ket_transaksi'];

        if($nama_transaksi == NULL  || $quantity == NULL || $quantity == "0" || $total_harga == NULL){
                header("location:../v_dtransaksi_add_produk.php?id=$id_transaksi&ps=transaksi_kurang");
        }else{
            mysqli_query($koneksi,"INSERT INTO detail_transaksi(id_dtransaksi, id_transaksi, nama_transaksi, ukuran_cetak, quantity, jenis_bahan, total_cetak, jasa_design, ket_design, total_design, total_harga, jenis_transaksi, ket_transaksi)
            VALUES('$id_dtransaksi','$id_transaksi','$nama_transaksi','$ukuran_cetak','$quantity','$jenis_bahan','$total_cetak','$jasa_design','$ket_design','$total_design','$total_harga','$jenis_transaksi','$ket_transaksi')");
            if($_SESSION['level']=="CS"){
                header("location:../v_dtransaksi.php?id=$id_transaksi&ps=transaksi_sukses");
            }else{
                header("location:../../Data_Online/v_dtransaksi_cst.php?id=$id_transaksi&ps=transaksi_sukses");
            }
        }
    }  
?>