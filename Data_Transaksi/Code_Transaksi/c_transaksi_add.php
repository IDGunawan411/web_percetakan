<?php
    // post data transaksi
    include "../../koneksi.php";
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $id_transaksi       = $_POST['id_transaksi'];
        $id_customer        = $_POST['id_customer'];
        $tgl_transaksi      = $_POST['tgl_transaksi'];
        $jumlah_transaksi   = NULL;
        $total_transaksi    = NULL;
        $ket_pembayaran     = NULL;
        $status_tr          = "1";

        // $ket_pembayaran     = $_POST['ket_pembayaran'];

        if($id_customer == "0" || $tgl_transaksi == NULL || $ket_pembayaran == "0"){
            header("location:../v_transaksi_add.php?ps=transaksi_kurang");
        }else{
            mysqli_query($koneksi,"INSERT INTO transaksi(id_transaksi,id_customer,tanggal_transaksi,jumlah_transaksi,total_transaksi,ket_pembayaran,status_transaksi) 
            VALUES('$id_transaksi','$id_customer','$tgl_transaksi','$jumlah_transaksi','$total_transaksi','$ket_pembayaran','$status_tr')");
            header("location:../../Data_Dtransaksi/v_dtransaksi.php?id=$id_transaksi&ps=transaksi_sukses");
        }
    }  
?>