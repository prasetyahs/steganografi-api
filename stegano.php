<?php

include "config/database.php";
include "crud.php";
include "stegano_function.php";

//encode
// $secretMessage = stringToBinary(Passaaa("1+1=2", "en", "google123")."|");
// $file = binary("uploads/618df28047218050850.mp3");
// $output = embedding($secretMessage, $file);
// $output = binaryToDec($output);
// $pack = pack("C*", ...$output);
// file_put_contents("steganofile/a.mp3", $pack);
//decode
// $file = binary("steganofile/a.mp3");
// $output = showSecretMessage($file);
// $output = binaryToString($output);
// echo Passaaa(explode("|", $output)[0], "dec", "google123");
$uniq = uniqid() . date("hsi");
switch ($_GET['type']) {
    case "hide":
        header("Content-Type: application/json");
        $inputFilter = array_filter($_POST);
        $inputFilter = array_keys($inputFilter);
        if (!empty(array_diff(["mp3", "secret_message", "password", "users_id"], $inputFilter))) {
            echo json_encode(
                ["message" => "Mohon lengkapi Data!", 'status' => false, "filename" => null]
            );
            return;
        }
        $fileName = $uniq . ".mp3";
        file_put_contents('uploads/' . $fileName, base64_decode($_POST['mp3']));
        $secretMessage = stringToBinary(Passaaa($_POST['secret_message'], "en", $_POST['password']) . "|");
        $file = binary('uploads/' . $fileName);
        $output = embedding($secretMessage, $file);
        $output = binaryToDec($output);
        $pack = pack("C*", ...$output);
        file_put_contents("steganofile/" . $fileName, $pack);
        $input = [
            "output" => $fileName,
            "original_file" => $fileName,
            "type" => "encode"
        ];

        $result = create($input, $conn, "stegano");
        $history = create([
            "users_id" => $_POST['users_id'],
            "stegano_id" => $conn->insert_id,
            "date" => date("Y-m-d")
        ], $conn, "history");
        echo json_encode(
            ["message" => "Sukses", 'status' => $result, "filename" => $fileName,"enc_result"=>Passaaa($_POST['secret_message'], "en", $_POST['password'])]
        );
        break;
    case "show":
        $file = binary($_FILES["mp3"]["tmp_name"]);
        $output = showSecretMessage($file);
        $output = binaryToString($output);
        header("Content-Type: application/json");
        $result = Passaaa(explode("|", $output)[0], "dec", $_POST['password']);
        echo json_encode(
            ["message" => !empty($result) ? $result : "Password tidak sesuai!", 'status' => !empty($result)]
        );
        break;
}