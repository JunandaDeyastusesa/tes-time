<?php
session_start();

// Menghapus semua variabel sesi
$_SESSION = array();

// Menghapus sesi
session_destroy();

// Redirect ke halaman login setelah logout
header("location: ../index.php");
exit;
?>
