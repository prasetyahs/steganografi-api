<?php
require_once "config/database.php";
require_once "crud.php";

function createHistory($request, $conn)
{
    header("Content-Type: application/json");
    $request['date'] = date("Y-m-d");
    if (count(array_filter($request)) <= 2) {
        return json_encode([
            "message" => "Lengkapi data !",
            "status" =>  false,
        ]);
    }
    create($request, $conn, "history");
    return json_encode([
        "message" => "Berhasil menambahkan data!",
        "status" =>  true,
    ]);
}

function deleteHistory($conn, $id)
{
    header("Content-Type: application/json");
    delete("history", ["id" => $id], $conn);
    return json_encode([
        "message" => "Berhasil menghapus data!",
        "status" =>  true,
    ]);
}

function getHistory($conn)
{

    $isType = $_GET['is_type'];
    $usersID = $_GET['users_id'];
    // print_r("SELECT history.id,stegano_id,date,personal_number,output as embedding_file,original_file,type,name FROM history join users on users.id = history.users_id join stegano on stegano.id=history.stegano_id where users.id=" . $_GET['users_id'] . "AND stegano.type=" . parse_str($isType));
    $data = readDataAllRow($conn, "SELECT history.id,stegano_id,date,personal_number,output as embedding_file,original_file,type,name FROM history join users on users.id = history.users_id join stegano on stegano.id=history.stegano_id where users.id='$usersID' AND type='$isType'");
    header("Content-Type: application/json");
    return json_encode([
        "data" =>  $data,
        "message" => "Berhasil mengambil data!",
        "status" =>  true,
    ]);
}

$type = $_GET['type'];

switch ($type) {
    case "add":
        echo createHistory($_POST, $conn);
        break;
    case  "get":
        echo getHistory($conn);
        break;
    case "del":
        echo deleteHistory($conn, $_GET['id']);
        break;
    default:
        echo "Not Found";
}
