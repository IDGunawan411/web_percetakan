<?php
include "../koneksi.php";
    function acc_transaksi($id){
        mysqli_query($koneksi, "UPDATE page_login SET level='Admin CS' WHERE id_user='$id'");
    }
?>