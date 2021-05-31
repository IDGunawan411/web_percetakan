<?php
    session_start();
    
    if($_SESSION['level'] == "Customer"){
        session_destroy();
        header("location:index_on.php");
    }else{
        session_destroy();
        header("location:index.php");
    }

?>