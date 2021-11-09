<?php

include "crud.php";
include "config/database.php";
function binary($data, $type = "")
{
    $data =  file_get_contents($data);
    $data = $type === "em" ? str_replace(" ", "space", preg_replace('/\s\s+/', 'space', $data)) . 'space' : $data;
    $u    = unpack('C*', $data);
    $bin = [];
    foreach ($u as $b) {
        array_push($bin, decbin($b));
    }
    return $bin;
}

function stego($data, $embed)
{

    $em = implode("", $embed);
    for ($i = 0; $i < strlen($em); $i++) {
        $data[$i][strlen($data[$i]) - 1] = $em[$i];
    }
    return $data;
}

function stegoGetHide($result)
{
    $bin = "";
    for ($i = 0; $i < 7; $i++) {
        $bin .= $result[$i][strlen($result[$i]) - 1];
    }
    return $bin;
}
// encode
function encoder($cover, $embed, $outputName)
{
    header("Content-Type: application/json");
    $embed = binary($embed, "em");
    $data = binary($cover);
    $result = stego($data, $embed);
    $i = 0;
    foreach ($result as $s) {
        $result[$i] = bindec($s);
        $i++;
    }
    $pack = pack("C*", ...$result);
    file_put_contents($outputName, $pack);
    return $outputName;
}


function Passaaa($request, $type, $password)
{
    $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
    $data = $request;
    if ($type == 'en') {
        $enc = openssl_encrypt($data, 'aes-256-cbc', $password, 0, $iv);
    } else {
        $enc = openssl_decrypt($data, 'aes-256-cbc', $password, 0, $iv);
    }
    return $enc;
}

// decode
function decoder($fileSteg, $password)
{
    header("Content-Type: application/json");
    $data = binary($fileSteg);
    $binaryString = binary("uploads/tmp.txt");
    $tmpStr = '';
    for ($i = 0; $i < count($data); $i++) {
        $tmpStr .= $data[$i][strlen($data[$i]) - 1];
    }

    $min = 0;
    $max = 0;
    $result = '';
    foreach ($binaryString as $s) {
        $min = $max;
        $max = strlen($s);
        $result .= chr(bindec(substr($tmpStr, $min, $max)));
        $max = strlen($s) + $min;
    }
    if (!Passaaa($result, "dec", $password)) {
        return json_encode([
            "message" => "Data tidak sesuai!",
            "secret_message" => null,
            "status" => false
        ]);
    }
    return json_encode([
        "message" => "Berhasil!",
        "secret_message" => Passaaa($result, "dec", $password),
        "status" => true
    ]);
}

function createFile($secretMessage, $password)
{
    $filename = 'uploads/tmp.txt';
    file_put_contents($filename, Passaaa($secretMessage, "en", $password));
    return $filename;
}

$uniq = uniqid() . date("hsi");
switch ($_GET['type']) {
    case "hide":
        $fileName = $uniq . ".mp3";
        file_put_contents('uploads/' . $fileName, base64_decode($_POST['mp3']));
        $outputName = encoder("uploads/" . $fileName, createFile($_POST['secret_message'], $_POST['password']), "steganofile/" . $uniq . ".mp3");
        $input = [
            "output" => $outputName,
            "original_file" => $fileName,
            "secret_message" => Passaaa($_POST['secret_message'], 'en', $_POST['password']),
            "password" => $_POST['password'],
            "type" => "encode"
        ];
        $result = create($input, $conn, "stegano");
        echo json_encode(
            ["message" => "Sukses", 'status' => true]
        );
        break;
    case "show":
        echo decoder("steganofile/618ab523090c7063151.mp3", $_POST['password']);
        break;
}