<?php 
    require_once "function_responce.php";
    ///
    /// Вывести всех пользователей
    ///
    function viewallusers($connect){
        $users = mysqli_query($connect, "SELECT `user`.`id` AS `id`, `user`.`login` AS login, `user`.`password` AS `password`, `role`.`name` AS roleName FROM `user` INNER JOIN `role` ON `user`.`role_id` = `role`.`id`");
        if(mysqli_num_rows($users) == 0){
            http_response_code(404);
            $responce = [
                "status" => false,
                "description" => "Таблица пуста."
            ];

            echo json_encode($responce);
        }
        else{
            
            $userList = array();
            while($user = mysqli_fetch_assoc($users)){
                $userList[] = $user;
            }

            echo json_encode($userList);
        }
    }

    function viewalluser($connect, $id){
        $user = mysqli_query($connect, "SELECT * FROM `user` WHERE id=".$id);
        if(mysqli_num_rows($user) == 0){
            http_response_code(404);
            $responce = [
                "status" => false,
                "description" => "Пользователя нет.",
                "link" => "https://easy4.team/"
            ];
            
            echo json_encode($responce);
        }
        else{
            http_response_code(200);
            echo json_encode(mysqli_fetch_assoc($user));
        }
    }

    function authUser($connect, $login, $password){
        $user = mysqli_query($connect, "SELECT * FROM `user` INNER JOIN `role` ON `user`.`role_id` = `role`.`id` WHERE `login`='$login' AND `password`='$password'");
        $data = mysqli_fetch_assoc($user);
        if($data == null)
            systemResponce(null);
        
        else
            systemResponce($data);
        
    }

    function viewData($connect){
        $users = mysqli_query($connect, "SELECT
        `user`.`id` AS idUser,
        `user`.`login` AS loginUser,
        `role`.`id` AS roleIdUser,
        `role`.`name_china` AS roleChinaName,
        `role`.`name` AS roleListUser
        FROM
        `user`
        INNER JOIN `role` ON `user`.`role_id` = `role`.`id`");
        
        if($users == null){
            http_response_code(404);
            $responce = [
                "status" => false,
                "description" => "Пользователей нет."
            ];

            echo json_encode($responce);
        }
        else{
            while($rowUser = mysqli_fetch_assoc($users)){
                $data_array[] = array(
                    'idUser' => $rowUser['idUser'],
                    'login' => $rowUser['loginUser'],
                    'roleName' => array(
                                        $rowUser['roleListUser'],
                                        $rowUser['roleChinaName']
                                        )
                );
            }
            echo json_encode($data_array);
        }
    }
?>