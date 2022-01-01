<?php 
    include '../config/functions.php';
    $fileName = $_GET['file_name'];
    $type = $_GET['type'];
    downloadFile($fileName,$type);
