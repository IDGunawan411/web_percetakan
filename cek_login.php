<?php
    session_start();
    include "koneksi.php";
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $usrnm = $_POST['username'];
        $pass  = $_POST['password'];
        
        $query = "SELECT username, password 
        from user 
        WHERE username ='$usrnm' AND password='$pass'";
        $q    = mysqli_query($koneksi,$query);

        if(mysqli_num_rows($q) < 1){
            header("location:index.php?pesan=eror&us=$usrnm");
        }else{
            $q1 = "SELECT * FROM user where username='$usrnm'";
            $qs = mysqli_query($koneksi,$q1);
            $ds = mysqli_fetch_array($qs);

            // $_SESSION['login_sukses']   = "login_sukses";
            $_SESSION['id_user']        = $ds['id_user'];
            $_SESSION['username']       = $ds['username'];
            $_SESSION['password']       = $ds['password'];
        $_SESSION['nama_lengkap']       = $ds['nama_lengkap'];
            $_SESSION['email']          = $ds['email'];
            $_SESSION['level']          = $ds['level'];
            
            if($ds['level']=="CS"){
                header("location:Data_Transaksi/dashboard.php");
            }elseif($ds['level']=="Designer"){
                header("location:Data_Design/dashboard.php");
            }else{
                header("location:Data_Laporan/dashboard.php");
            }
        }
    }
?>
