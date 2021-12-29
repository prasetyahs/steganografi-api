<?php
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