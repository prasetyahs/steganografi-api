<?php 
    include 'config/database.php';
    session_start();
    session_destroy();
    header("Location: " . $baseUrl);
    exit();
