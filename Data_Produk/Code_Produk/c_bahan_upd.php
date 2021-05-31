<?php
    // update data bahan
    include "../../koneksi.php";
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $id_bahan      = $_POST['id_bahan'];
        $nama_bahan    = $_POST['nama_bahan'];
        $harga_bahan   = $_POST['harga_bahan'];
        $status_bahan  = $_POST['status_bahan'];
        $harga_sup     = $_POST['harga_sup'];

        // $ket_bahan     = $_POST['ket_bahan'];
        
        if($id_bahan == NULL || $nama_bahan == NULL || $status_bahan == "0"){
            header("location:../v_bahan_upd.php?id=$id_bahan&ps=bahan_kurang");
        }else{
            mysqli_query($koneksi,"UPDATE jenis_bahan SET nama_bahan = '$nama_bahan', harga_bahan = '$harga_bahan',
            status_bahan = '$status_bahan', harga_supplier = '$harga_sup' WHERE id_bahan = '$id_bahan'");
            header("location:../v_bahan.php?ps=bahan_sukses");
        }
    }  
?>