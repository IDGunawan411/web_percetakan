<?php
    if($_SERVER['REQUEST_METHOD']=="POST"){
        include "../../koneksi.php";
        $id_customer    = $_POST['id_customer'];
        $nama_customer  = $_POST['nama_customer'];
        $no_telp        = $_POST['no_telp'];
        $email          = $_POST['email'];
        $alamat         = $_POST['alamat'];
        $pass           = $_POST['password'];
        
        if($nama_customer == NULL || $no_telp == NULL || $alamat == NULL || $email == NULL){
            header("location:../v_customer_add.php?ps=customer_kurang");
        }else{
            mysqli_query($koneksi,"INSERT INTO customer(id_customer,nama_customer,no_telp,alamat,email,password) 
            VALUES ('$id_customer','$nama_customer','$no_telp','$alamat','$email','$pass')");
            header("location:../v_customer.php?ps=customer_sukses");
        }
    }
?>