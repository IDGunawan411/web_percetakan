<?php
    include "../../koneksi.php";
    mysqli_query($koneksi,"DELETE FROM detail_transaksi WHERE id_transaksi = '$_GET[id_transaksi]'");
    mysqli_query($koneksi,"DELETE FROM pembayaran WHERE id_transaksi = '$_GET[id_transaksi]'");

    mysqli_query($koneksi,"UPDATE transaksi SET status_transaksi = '3' WHERE id_transaksi = '$_GET[id_transaksi]'");
    header("location:../../Data_Transaksi/v_transaksi.php?&ps=dtransaksi_reject");
?>