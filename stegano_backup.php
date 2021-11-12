
<?php
include "config/database.php";
include "crud.php";

function binary($data)
{
    $data =  file_get_contents($data);
    $u    = unpack('C*', $data);
    $bin = [];
    foreach ($u as $b) {
        array_push($bin, decbin($b));
    }
    return $bin;
}


function stringToBinary($secretMessage)
{
    $bins = "";
    for ($i = 0; $i < strlen($secretMessage); $i++) {
        $bin  = decbin(ord($secretMessage[$i]));
        $bin = strlen($bin) < 7 ? "0" . $bin : $bin;
        $bins .= $bin;
    }
    return $bins;
}
function binaryToDec($result)
{
    $dec = [];
    foreach ($result as $r) {
        array_push($dec, bindec($r));
    }
    return $dec;
}

function binaryToString($binary)
{
    $output = '';
    for ($i = 0; $i < strlen($binary); $i += 7) {
        $subStr = substr($binary, $i, 7);
        $bin = strlen($subStr) < 7 ? "0" . $subStr : $subStr;
        $output .= chr(bindec($subStr));
    }
    return $output;
}

function embedding($secretMessage, $file)
{
    for ($i = 0; $i < strlen($secretMessage); $i++) {
        $secretMessage = strlen($secretMessage) < 7 ? "0" . $secretMessage : $secretMessage;
        $file[$i][strlen($file[$i]) - 1] = $secretMessage[$i];
    }
    return $file;
}

function showSecretMessage($file)
{
    $binSC = "";
    foreach ($file as $f) {
        $binSC .= $f[strlen($f) - 1];
    }
    return $binSC;
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
        header("Content-Type: application/json");
        echo json_encode(
            ["message" => "Sukses", 'status' => $result]
        );
        break;
    case "show":
        $file = binary("steganofile/618dfaf50a8a4061326.mp3");
        $output = showSecretMessage($file);
        $output = binaryToString($output);
        echo Passaaa(explode("|", $output)[0], "dec", "google123");
        break;
}
