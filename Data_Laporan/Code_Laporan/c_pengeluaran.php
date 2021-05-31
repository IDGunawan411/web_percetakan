<?php
    if(isset($_POST["Search"])){
        $tanggal_from   = $_POST['tanggal_from'];
        $tanggal_to     = $_POST['tanggal_to'];
        $hidden         = "";
        header("location:../v_laporan_pengeluaran.php?dfrom=$tanggal_from&dto=$tanggal_to");
    }

?>