<?php
    include "../../koneksi.php";
    $id_customer = $_GET['id'];
    mysqli_query($koneksi,"DELETE FROM customer WHERE id_customer = '$id_customer'");
    header("location:../v_customer.php?ps=customer_hapus");
?>