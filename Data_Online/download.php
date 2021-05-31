<?php
if(isset($_GET['nama_file'])){
    $dir = "Bukti_Bayar/"; 
    $nama_file = $_GET['nama_file'];
    $file = $dir.$nama_file;
    if (file_exists($file)){
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($file));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        ob_clean();
        flush();
        readfile($file);
        exit;
    }
}

?>