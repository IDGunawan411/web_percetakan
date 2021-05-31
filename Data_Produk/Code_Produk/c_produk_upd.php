<?php
    // update data produk
    include "../../koneksi.php";
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $id_produk      = $_POST['id_produk'];
        $nama_produk    = $_POST['nama_produk'];
        $harga_produk   = $_POST['harga_produk'];
        $status_produk  = $_POST['status_produk'];
        $ket_produk     = $_POST['ket_produk'];
        $harga_sup      = $_POST['harga_sup'];
        
        if($id_produk == NULL || $nama_produk == NULL || $status_produk == "0"){
            header("location:../v_produk_upd.php?id=$id_produk&ps=produk_kurang");
        }else{
            mysqli_query($koneksi,"UPDATE jenis_produk SET nama_produk = '$nama_produk', harga_produk = '$harga_produk',
            status_produk = '$status_produk', ket_produk = '$ket_produk', harga_supplier = '$harga_sup' WHERE id_produk = '$id_produk'");
            header("location:../v_produk.php?ps=produk_sukses");
        }
    }  
?>