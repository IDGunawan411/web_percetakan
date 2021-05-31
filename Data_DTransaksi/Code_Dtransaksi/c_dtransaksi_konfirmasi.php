<?php
    include "../../koneksi.php";
    mysqli_query($koneksi,"UPDATE transaksi SET ket_pembayaran = 'Lunas' WHERE id_transaksi = '$_GET[id]'");
    header("location:../../Data_Transaksi/v_transaksi.php?&ps=transaksi_sukses");
?>