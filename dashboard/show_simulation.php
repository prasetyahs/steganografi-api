<?php
include "../stegano_function.php";
if (isset($_POST)) {
    header("Content-Type: application/json");
    $mp3 = $_POST['mp3'];
    
    if (!$mp3) {
        echo json_encode("err");
    }
    $fileName = uniqid() . date("hsi") . ".mp3";
    file_put_contents( "../uploads/".$fileName, base64_decode($_POST['mp3']));

    $bin = binary('../uploads/' . $fileName);
    echo json_encode($bin);
}
