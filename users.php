<?php

    require_once "config/database.php";
    require_once "crud.php";

    function changePassword($req,$conn){
        $personalNumber = isset($req['personal_number']) ? $req['personal_number'] : '';
        $oldPassword = isset($req['old_password']) ? $req['old_password'] : '';
        $newPassword = isset($req['new_password']) ? $req['new_password'] : '';
        $confirmPassword = isset($req['confirm_password']) ? $req['confirm_password'] : '';

            $query = "SELECT * FROM users WHERE personal_number = '$personalNumber' AND password = '$oldPassword'";
            $cekData = readDataPerRow($conn,$query);
            if($cekData != null){
                if($confirmPassword == $newPassword){
                    $data = [
                       "password" => $newPassword
                    ];
                    $where = [
                        "personal_number" => $personalNumber
                    ];
    
                    update($data,$where,'users',$conn);
                    header("Content-Type: application/json");
                    return json_encode([
                        "message" => "Password berhasil diperbarui",
                        "status" =>  true,
                    ]);
                }else{
                    header("Content-Type: application/json");
                    return json_encode([
                        "message" => "Password baru dengan Konfirmasi Password tidak cocok !",
                        "status" =>  false,
                    ]);
                }
            }else{
                header("Content-Type: application/json");
                return json_encode([
                    "message" => "Password Lama tidak cocok !",
                    "status" =>  false,
                ]);
            }

        
    }

    function changeProfile($req,$files,$conn){
        $personalNumber = isset($req['personal_number']) ? $req['personal_number'] : '';
        $name = isset($req['name']) ? $req['name'] : '';
        $image = '';
        if($files != null){

            $image = uploadFile($files);
        }else{
            $query = "SELECT * FROM users WHERE personal_number = '$personalNumber'";
            $getData = readDataPerRow($conn,$query);
            $image = $getData['image'];
        }
        
        $data = [
            'image' => $image,
            'name'  => $name
        ];
        $where = [
            'personal_number' => $personalNumber
        ];

        update($data,$where,'users',$conn);
        header("Content-Type: application/json");
        return json_encode([
            "message" => "Data Profile berhasil diperbarui",
            "status" =>  true,
        ]);
    }

    function uploadFile($files){
        $extAcc = ['png','jpg','jpeg'];
        $fileName = $files['image']['name'];
        $x = explode('.',$fileName);
        $extFile = strtolower(end($x));
        $fileTmp = $files['image']['tmp_name'];
        if(in_array($extFile,$extAcc) === true){
            $convertNameFile = md5($fileName).'.'.$extFile;
            move_uploaded_file($fileTmp,'assets/image/'.$convertNameFile);
            return $convertNameFile;
        }
    }

    $type = $_GET['type'];

    switch($type){
        case 'change_password' :
            echo changePassword($_POST,$conn);
            break;

        case 'change_profile' : 
            echo changeProfile($_POST,$_FILES,$conn);
            break;

        default:    
            echo "Not Found";
    }