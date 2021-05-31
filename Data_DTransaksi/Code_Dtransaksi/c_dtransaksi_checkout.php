<?php
    // update data transaksi terbaru
    if($_SERVER['REQUEST_METHOD']=="POST"){
        include "../../koneksi.php";

        $jtr  = mysqli_query($koneksi, "SELECT COUNT(id_dtransaksi) as jtr FROM detail_transaksi WHERE id_transaksi = '$_GET[id]'");
        $djtr = mysqli_fetch_array($jtr);
        $ttr  = mysqli_query($koneksi, "SELECT SUM(total_harga) as ttr FROM detail_transaksi WHERE id_transaksi = '$_GET[id]'");
        $dttr = mysqli_fetch_array($ttr);        
        $id_transaksi   = $_GET['id'];
        $jumlah_baru    = $djtr['jtr'];
        $total_baru     = $dttr['ttr'];
        $ket_pembayaran = $_POST['pembayaran'];
        $cek_design = mysqli_query($koneksi, "SELECT * FROM detail_transaksi WHERE id_transaksi = '$_GET[id]' AND ket_design = 'Proses'");
        $cd         = mysqli_num_rows($cek_design);
        mysqli_query($koneksi,"UPDATE transaksi SET jumlah_transaksi = '$jumlah_baru', total_transaksi = '$total_baru', ket_pembayaran = '$ket_pembayaran' WHERE id_transaksi = '$id_transaksi'");
        header("location:../../Data_Transaksi/v_transaksi.php?ps=transaksi_sukses");
    }
?>