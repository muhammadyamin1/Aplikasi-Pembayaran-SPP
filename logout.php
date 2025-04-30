<?php
     session_start();
     unset($_SESSION['username']);
     unset($_SESSION['foto']);
     unset($_SESSION['id_pengguna']);
     unset($_SESSION['pengguna']);
     unset($_SESSION['level']);
     unset($_SESSION['status']);

     session_unset();
     session_destroy();

     header("location:index.php?pesan=logout");
?>