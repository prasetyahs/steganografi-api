<?php
require_once "config/database.php";
require_once "crud.php";

$personalNumber = isset($_POST['personal_number']) ? $_POST['personal_number'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$data = readDataPerRow($conn, "SELECT id,personal_number,name FROM users where personal_number = '$personalNumber' AND password='$password'");
header("Content-Type: application/json");
if(empty($data)){

    echo json_encode([
        "status" =>  empty($data) ? false : true,
        "message" => empty($data) ?    "Personal Number Tidak Sesuai !" : "Berhasil Login"
    ]);
}else{
    echo json_encode([
        "data" => empty($data) ? [] : $data,
        "status" =>  empty($data) ? false : true,
        "message" => empty($data) ?    "Personal Number Tidak Sesuai !" : "Berhasil Login"
    ]);
}
