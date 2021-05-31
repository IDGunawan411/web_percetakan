<?php
    // post data produk
    include "../../koneksi.php";
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $id_produk      = $_POST['id_produk'];
        $nama_produk    = $_POST['nama_produk'];
        $harga_produk   = $_POST['harga_produk'];
        $status_produk  = $_POST['status_produk'];
        $ket_produk     = $_POST['ket_produk'];
        $harga_sup      = $_POST['harga_sup'];

        
        if($id_produk == NULL || $nama_produk == NULL || $harga_produk == NULL || $status_produk == "0" || $harga_sup == NULL){
            header("location:../v_produk_add.php?ps=produk_kurang");
        }else{
            mysqli_query($koneksi,"INSERT INTO jenis_produk(id_produk,nama_produk,harga_produk,status_produk,ket_produk,harga_supplier) 
            VALUES('$id_produk','$nama_produk','$harga_produk','$status_produk','$ket_produk','$harga_sup')");
            header("location:../v_produk.php?ps=produk_sukses");
        }
    }  
?>