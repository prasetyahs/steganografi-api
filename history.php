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
    $data = readDataAllRow($conn, "SELECT *,history.id FROM history join users on users.id = history.users_id");
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
