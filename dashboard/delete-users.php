<?php 
    include '../config/database.php';
    include '../config/functions.php';
    $id = $_GET['id'];
    deleteUsers($id,$conn);
