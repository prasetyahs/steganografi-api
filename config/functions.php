<?php 

    $baseUrl = "http://localhost/steganografi/";

    function login($data,$conn){
        global $baseUrl;
        $idNumber = $data['id_number'];
        $password = $data['password'];
        $queryCekEmail = mysqli_query($conn,"SELECT * FROM users WHERE personal_number = '$idNumber'");
        $dataUsers = mysqli_fetch_assoc($queryCekEmail);
        if($dataUsers != null){
            $passwordDb = $dataUsers['password'];
            if($password == $passwordDb){
                $_SESSION['data_users'] = $dataUsers;
                $_SESSION['login'] = true;
                header("Location: " . $baseUrl.'dashboard');
                exit();
            }else{
                $_SESSION['message'] = "Mohon Maaf, Password yang anda masukan salah.";
                $_SESSION['status'] = "danger";
                header("Location: " . $baseUrl);
                exit();
            }
        }else{
            $_SESSION['message'] = "Mohon Maaf, ID yang anda masukan tidak terdaftar.";
            $_SESSION['status'] = "warning";
            header("Location: " . $baseUrl);
            exit();
        }
    }

    function create($data,$conn,$table){
        $column = "";
        $values = "";
        foreach($data as $index => $value){
            $column .= $index.",";   
            $values .= "'$value'".",";   
        }
        $lengthColumn = strlen($column);
        $lengthValues = strlen($values);
        $subStringColumn = substr($column,0,$lengthColumn-1);
        $subStringValues = substr($values,0,$lengthValues-1);
        $insert = "INSERT INTO $table ($subStringColumn) VALUES ($subStringValues) ";
        $execQuery = mysqli_query($conn,$insert);
        return $execQuery;
    }
    
    function update($data,$where,$table,$conn){
        $columnValue = "";
        $whereValue = "";
        foreach($data as $index => $value){
            $columnValue .= $index.'='."'$value'".',';
        }
        foreach($where as $index => $value){
            $whereValue .= $index.'='."'$value'";
        }
        $fixData = substr($columnValue,0,strlen($columnValue) -1);
        $update = "UPDATE $table SET $fixData WHERE $whereValue";
        $execQuery = mysqli_query($conn,$update);
        return $execQuery;
    }
    
    function delete($table,$where,$conn){
        $whereValue = "";
        foreach($where as $index => $value){
            $whereValue .= $index.'='."'$value'";
        }
        $delete = "DELETE FROM $table WHERE $whereValue";
        $execQuery = mysqli_query($conn,$delete);
        return $execQuery;
    }
    
    function readDataAllRow($conn,$query){
        $data =[];
        $execQuery = mysqli_query($conn,$query);
        while ($result = mysqli_fetch_assoc($execQuery)) {
            # code...
            $data[] = $result;
        }
        return $data;
    }
    
    function readDataPerRow($conn,$query){
        $execQuery = mysqli_query($conn,$query);
        $data = mysqli_fetch_assoc($execQuery);
        return $data;
    }

    function addUsers($data,$conn){
        global $baseUrl;
        if($data['id_number'] != null && $data['name'] != null && $data['password']){
            $dataInsers = [
                "personal_number" => $data['id_number'],
                "name" => $data['name'],
                "password" => $data['password'],
                "role" => $data['role']
            ];
    
            $insert = create($dataInsers,$conn,'users');
            if(mysqli_affected_rows($conn) == 1){
                $_SESSION['message'] = "Selamat, akun anda berhasil didaftarkan";
                $_SESSION['type'] = "success";
                $_SESSION['title'] = "Success";
                Redirect($baseUrl . "dashboard/data-users.php");
                
            }else{
                $_SESSION['message'] = "Maaf, akun anda gagal didaftarkan";
                $_SESSION['type'] = "success";
                $_SESSION['title'] = "Success";
                Redirect($baseUrl . "dashboard/data-users.php");
                
            }
        }else{
            $_SESSION['message'] = "Tolong lengkapi field yang tersedia.";
            $_SESSION['type'] = "error";
            $_SESSION['title'] = "Error !";
            header($baseUrl . "dashboard/data-users.php");
            
        }
        
    }

    function updateUsers($data,$conn){
        global $baseUrl;
        if($data['id_number'] != null && $data['name'] != null){
            $dataUpdate = [
                "name" => $data['name'],
                "role" => $data['role']
            ];
            if($data['password'] != null){
                $dataUpdate = [
                    "name" => $data['name'],
                    "role" => $data['role'],
                    "password" => $data['password']
                ];
            }
            

            $where = [
                "personal_number" => $data['id_number']
            ];

    
            
            
            $update = update($dataUpdate,$where,'users',$conn);
            if($update){
                $_SESSION['message'] = "Data User berhasil diperbarui";
                $_SESSION['type'] = "success";
                $_SESSION['title'] = "Success";
                Redirect($baseUrl . "dashboard/data-users.php");
                
            }else{
                $_SESSION['message'] = "Maaf, akun anda gagal didaftarkan";
                $_SESSION['type'] = "success";
                $_SESSION['title'] = "Success";
                Redirect($baseUrl . "dashboard/data-users.php");
                
            }
        }else{
            $_SESSION['message'] = "Tolong lengkapi field yang tersedia.";
            $_SESSION['type'] = "error";
            $_SESSION['title'] = "Error !";
            header($baseUrl . "dashboard/data-users.php");
            
        }
    }

    function deleteUsers($id,$conn){
        global $baseUrl;
        $queryDelete = "DELETE FROM users WHERE personal_number = '$id'";
        mysqli_query($conn,$queryDelete);
        $_SESSION['message'] = "Data User berhasil dihapus";
        $_SESSION['type'] = "success";
        $_SESSION['title'] = "Success";
        Redirect($baseUrl . "dashboard/data-users.php");
    }

    function downloadFile($fileName,$type){
        global $baseUrl;
        if($type == 'original'){
            $file = '../uploads/'.$fileName;
        }else{
            $file = '../steganoFile/'.$fileName;
        }

        // var_dump(file_exists($fileName));die;

        // if(file_exists($file)) {

            //Define header information
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($file).'"');
            header('Content-Length: ' . filesize($file));
            header('Pragma: public');
            
            //Clear system output buffer
            flush();
            
            //Read the size of the file
            readfile($file,true);
            
            //Terminate from the script
            die();
        // }
        // else{
        //     echo "File path does not exist.";
        // }
            
    }

    function Redirect($url, $permanent = false){
        // header('Location: ' . $url, true, $permanent ? 301 : 302);
        echo "<script>window.location.href = '$url';</script>";
        exit(0);
    }
