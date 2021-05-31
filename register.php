<?php 
    include "koneksi.php";

    if($_SERVER['REQUEST_METHOD']=="POST"){
        $id_user      = $_POST['id_user'];
        $username     = $_POST['username'];
        $username     = $_POST['username'];
        $password     = $_POST['password'];
        $password2    = $_POST['password2'];
        $level        = $_POST['level'];
        $nama_lengkap = $_POST['nama_lengkap'];
        $email        = $_POST['email'];
        $sql          = mysqli_query($koneksi,"SELECT * FROM user WHERE username='$username'");
        $cekuser      = mysqli_num_rows($sql); 
        
        if($username == NULL || $password == NULL || $password2 == NULL || $level == "0" || $email == NULL){
            header("location:index.php?pesan=register_kurang");
        }elseif($password !== $password2){
            header("location:index.php?pesan=register_gagal");
        }elseif($cekuser > 0){
            header("location:index.php?pesan=register_usernm");
        }else{
            mysqli_query($koneksi,"INSERT INTO user(id_user,username,password,nama_lengkap,email,level) 
            VALUES ('$id_user','$username','$password','$nama_lengkap','$email','$level')");
            header("location:index.php?pesan=register_sukses&us=$username");
        }
    }
?>