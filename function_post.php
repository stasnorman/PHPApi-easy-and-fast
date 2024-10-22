<?php 
    require_once "function_responce.php";

    
    function addUser($connect, $dataUser){

        $getRole = $dataUser['roleName'];
        $getLogin = $dataUser['login'];
        
        $row = mysqli_query($connect, "SELECT * FROM `role` WHERE `name`='$getRole' OR `name_chinese`='$getRole'");

        $loginCheck = mysqli_query($connect, "SELECT * FROM user WHERE login = '$getLogin'");
        
        if ($loginCheck->num_rows > 0) {
            http_response_code(403);
            $responce = [
                "status" => false,
                "description" => "Пользователь с таким логином есть.",
                "link" => "https://easy4.team/"
            ];
            
            echo json_encode($responce);
        } else {
            
            $formatRow = mysqli_fetch_assoc($row);

            mysqli_query($connect, "INSERT INTO `user`(`id`, `login`, `password`, `role_id`) VALUES (NULL,'".$dataUser['login']."','".$dataUser['password']."',".$formatRow['id'].")");
            http_response_code(200);
            $responce = [
                "status" => true,
                "description" => "Пользователь успешно зарегистрирован.",
                "link" => "https://easy4.team/"
            ];
            
            echo json_encode($responce);
        }
    }
?>