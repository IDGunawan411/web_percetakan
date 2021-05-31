<?php
   if($_SERVER['REQUEST_METHOD']=="POST"){
        include "../../koneksi.php";
        $updk = mysqli_query($koneksi, "SELECT * FROM konfigurasi"); 
        $no = 0;
        while($dupdk=mysqli_fetch_array($updk)){
            $no = $no + 1;       
            $konfigurasi = $_POST["konfigurasi".$no];   
            mysqli_query($koneksi,"UPDATE konfigurasi SET isi_konfigurasi = '$konfigurasi' WHERE id_konfigurasi = '$no'");
            // echo "UPDATE konfigurasi SET isi_konfigurasi = '$konfigurasi' WHERE id_konfigurasi = '$no'"."<br>";
            header('location:../v_konfigurasi.php?ps=sukses_konf');
        }
   }
?>