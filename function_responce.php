<?php 
    function systemResponce($data){
        if(isset($data)){
            http_response_code(200);
            $responceGood = [
                "status_response" => true,
                "description_ru" => "Операция выполнена успешно.",
                "description_ch" => "操作成功完成.",
                "description_eng" => "Operation completed successfully.",
                "data" => array(
                    "roleRUSSIA" => $data['name'],
                    "roleCHINESE" => $data['name_chinese']
                ),
            ];
            echo json_encode($responceGood);
        }
        else{
            http_response_code(203);
            $responce = [
                "status_response" => false,
                "description" => "Пользователя нет."
            ];

            echo json_encode($responce);
        }
    }
?>