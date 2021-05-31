<?php
    // delete data bahan
    include "../../koneksi.php";
    mysqli_query($koneksi,"DELETE FROM jenis_bahan WHERE id_bahan = '$_GET[id]'");
    header("location:../v_bahan.php?ps=bahan_hapus");
?>