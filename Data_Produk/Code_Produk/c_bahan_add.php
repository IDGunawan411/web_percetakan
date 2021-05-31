<?php
    // post data bahan
    include "../../koneksi.php";
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $id_bahan      = $_POST['id_bahan'];
        $nama_bahan    = $_POST['nama_bahan'];
        $harga_bahan   = $_POST['harga_bahan'];
        $status_bahan  = $_POST['status_bahan'];
        $ket_bahan     = $_POST['ket_bahan'];
        $harga_sup     = $_POST['harga_sup'];
        
        if($id_bahan == NULL || $nama_bahan == NULL || $harga_bahan == NULL || $status_bahan == "0" || $ket_bahan == "0" || $harga_sup == NULL){
            header("location:../v_bahan_add.php?ps=bahan_kurang");
        }else{
            mysqli_query($koneksi,"INSERT INTO jenis_bahan(id_bahan,nama_bahan,harga_bahan,status_bahan,ket_bahan,harga_supplier) 
            VALUES('$id_bahan','$nama_bahan','$harga_bahan','$status_bahan','$ket_bahan','$harga_sup')");
            header("location:../v_bahan.php?ps=bahan_sukses");
        }
    }  
?>