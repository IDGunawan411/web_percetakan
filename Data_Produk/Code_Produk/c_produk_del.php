<?php
    // delete data produk
    include "../../koneksi.php";
    mysqli_query($koneksi,"DELETE FROM jenis_produk WHERE id_produk = '$_GET[id]'");
    header("location:../v_produk.php?ps=produk_hapus");
?>