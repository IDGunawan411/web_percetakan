<?php
    include "../../koneksi.php";
    mysqli_query($koneksi,"DELETE FROM detail_transaksi WHERE id_dtransaksi = '$_GET[id_dtransaksi]'");
    mysqli_query($koneksi,"DELETE FROM jasa_design WHERE id_dtransaksi = '$_GET[id_dtransaksi]'");
    header("location:../v_dtransaksi.php?id=$_GET[id]&ps=transaksi_hapus");
?>