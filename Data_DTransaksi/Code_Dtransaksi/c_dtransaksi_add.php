<?php
    // post detail transaksi
    include "../../koneksi.php";
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $id_dtransaksi      = $_POST['id_dtransaksi'];
        $id_transaksi       = $_POST['id_transaksi'];
        
        // cek pilih produk, jika sudah ada
        $nama_produk2       = "0";
        if(isset($_POST['nama_produk1'])){
            $nama_produk1   = $_POST['nama_produk1']; // 0
        }

        // cek pilih produk, jika custom
        $nama_produk2       = $_POST['nama_produk2']; // Custom

        // cek jika pilih produk custom !== null
        if($nama_produk2 !== ""){
           $post_produk     = $nama_produk2; 
        }else{
           $post_produk     = $nama_produk1; 
        }
        $panjang            = $_POST['panjang'];
        $lebar              = $_POST['lebar'];
        if($panjang !== "-" || $lebar !== "-" ){
            $ukuran_cetak   = $panjang."cm"." x ".$lebar."cm";
        }else{
            $ukuran_cetak   = "-";    
        }

        
        $jumlah_cetak       = $_POST['jumlah_cetak'];
        $jenis_bahan        = $_POST['jenis_bahan'];
        $total_cetak        = $_POST['total_cetak'];
        $jasa_design        = $_POST['jasa_design'];
        $total_harga        = $_POST['total_cetak'];

        if($jasa_design=="Ya"){
            $ket_design = "Proses";
        }else{
            $ket_design = "-";
        }
        if($post_produk == NULL || $post_produk == "0" || $panjang == NULL || $lebar == NULL || $jumlah_cetak == NULL || $jenis_bahan == "0" || $jasa_design == "0"){
            header("location:../v_dtransaksi_add.php?id=$id_transaksi&ps=dtransaksi_kurang");
        }else{

            // $qtr1    = mysqli_query($koneksi,"SELECT * FROM transaksi WHERE id_transaksi = '$id_transaksi'");
            // $dtr1    = mysqli_fetch_array($qtr1);
            // $jumlah_baru = $dtr1['jumlah_transaksi'] + 1;
            // $total_baru  = $dtr1['total_transaksi'] + $total_cetak;
            // mysqli_query($koneksi,"UPDATE transaksi SET jumlah_transaksi = '$jumlah_baru', total_transaksi = '$total_baru' WHERE id_transaksi = '$id_transaksi'");

            mysqli_query($koneksi,"INSERT INTO detail_transaksi(id_dtransaksi,id_transaksi,nama_produk,ukuran_cetak,jumlah_cetak,jenis_bahan,total_cetak,jasa_design,ket_design,total_design,total_harga) 
            VALUES('$id_dtransaksi','$id_transaksi','$post_produk','$ukuran_cetak','$jumlah_cetak','$jenis_bahan','$total_cetak','$jasa_design','$ket_design','','$total_harga')");
            header("location:../v_dtransaksi.php?id=$id_transaksi&ps=dtransaksi_sukses");
        }
    }  
?>