<?php
    if($_SERVER['REQUEST_METHOD']=="POST"){
        include "../../koneksi.php";
        $id_customer    = $_POST['id_customer'];
        $nama_customer  = $_POST['nama_customer'];
        $no_telp        = $_POST['no_telp'];
        $email          = $_POST['email'];
        $alamat         = $_POST['alamat'];
        
        if($nama_customer == NULL || $no_telp == NULL || $alamat == NULL || $email == NULL){
            header("location:../v_customer_upd.php?id=$id_customer&ps=customer_kurang");
        }else{
            mysqli_query($koneksi,"UPDATE customer SET nama_customer = '$nama_customer', no_telp = '$no_telp',
            alamat = '$alamat', email = '$email' WHERE id_customer = '$id_customer'");
            header("location:../v_customer.php?ps=customer_sukses");
        }
    }
?>