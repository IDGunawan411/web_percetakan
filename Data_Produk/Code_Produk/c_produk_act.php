<?php
if(isset($_GET['act'])){

    include "../../koneksi.php";

    if($_GET['act']=='produk_kosong'){

        mysqli_query($koneksi,"UPDATE jenis_produk SET status_produk = 'Kosong' WHERE id_produk = '$_GET[id]'");
        header("location:../v_produk.php");           

    }elseif($_GET['act']=='produk_tersedia'){

        mysqli_query($koneksi,"UPDATE jenis_produk SET status_produk = 'Tersedia' WHERE id_produk = '$_GET[id]'");
        header("location:../v_produk.php");           

    }
}
?>