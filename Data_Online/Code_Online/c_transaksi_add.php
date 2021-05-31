<?php
    // post data transaksi
    session_start();
    include "../../koneksi.php";
    if($_GET['act_on']=="add"){
        $trm = mysqli_query($koneksi, "SELECT MAX(substr(id_transaksi,3,4)) as max_id FROM transaksi");
        $dtr = mysqli_fetch_array($trm);
        $max_id  = $dtr['max_id'] + 1; 
        $id_transaksi = "TR".Sprintf('%04s',$max_id);

        $id_customer        = $_SESSION['id_customer'];
        $tgl_transaksi      = date('Y-m-d');
        $jumlah_transaksi   = NULL;
        $total_transaksi    = NULL;
        $ket_pembayaran     = NULL;
        $status_tr          = "2";

        // $ket_pembayaran     = $_POST['ket_pembayaran'];
        $ql = mysqli_query($koneksi,"SELECT * FROM transaksi where id_customer = '$_SESSION[id_customer]' AND (NOT ket_pembayaran  = 'LUNAS' AND NOT status_transaksi = 3)");
        // echo "SELECT * FROM transaksi where id_customer = '$_SESSION[id_customer]' AND NOT ket_pembayaran = 'LUNAS'";
        if(mysqli_num_rows($ql) > 0){
            header("location:../v_transaksi_on.php?ps=transaksi_pen");
        }else{
            mysqli_query($koneksi,"INSERT INTO transaksi(id_transaksi,id_customer,tanggal_transaksi,jumlah_transaksi,total_transaksi,ket_pembayaran,status_transaksi) 
            VALUES('$id_transaksi','$id_customer','$tgl_transaksi','$jumlah_transaksi','$total_transaksi','$ket_pembayaran','$status_tr')");
            header("location:../v_dtransaksi_cst.php?id=$id_transaksi&ps=transaksi_sukses");
        }
    }  
?>