<?php
    include "../../koneksi.php";
    
    $id_dtransaksi = $_GET['id'];
    $ket_design    = "Proses";
    mysqli_query($koneksi,"DELETE FROM jasa_design WHERE id_dtransaksi = '$id_dtransaksi'");
    mysqli_query($koneksi,"UPDATE detail_transaksi SET ket_design = '$ket_design' WHERE id_dtransaksi = '$id_dtransaksi'");
    header("location:../v_design.php?ps=design_hapus");
?>