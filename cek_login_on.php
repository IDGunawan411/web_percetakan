<?php
    session_start();
    include "koneksi.php";
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $email = $_POST['email'];
        $pass  = $_POST['password'];
        
        $query = "SELECT email, password 
        from customer 
        WHERE email ='$email' AND password='$pass'";
        $q    = mysqli_query($koneksi,$query);

        if(mysqli_num_rows($q) < 1){
            header("location:index_on.php?pesan=eror&us=$email");
        }else{ 
            $q1 = "SELECT * FROM customer where email='$email'";
            $qs = mysqli_query($koneksi,$q1);
            $ds = mysqli_fetch_array($qs);

            // $_SESSION['login_sukses']   = "login_sukses";
            $_SESSION['id_customer']       = $ds['id_customer'];
            $_SESSION['email']             = $ds['email'];
            $_SESSION['no_telp']           = $ds['no_telp'];
            $_SESSION['nama_lengkap']      = $ds['nama_customer'];
            $_SESSION['alamat']            = $ds['alamat'];
            $_SESSION['level']             = "Customer";
            header("location:Data_Online/dashboard_customer.php");
        }
    }
?>
