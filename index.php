<?php 
    header("Content-Type:application/json");
    header('Access-Control-Allow-Origin: *');

    require_once 'connect.php'; 
    require_once 'function_post.php';
    require_once 'function_get.php';
    require_once 'function_responce.php';

    $actionMethod = $_SERVER['REQUEST_METHOD'];
    
    $paramUrl = explode("/", $_GET['q']);
    $typeUrl = $paramUrl[0];
    $idUrl = $paramUrl[1];
            //GET
    switch ($actionMethod) {
        case 'GET':
            
                switch ($typeUrl) {
                    case 'users':
                        viewallusers($connect);
                       break;
                    case 'test':
                        viewData($connect);
                       break;
                    case 'user':
                        viewalluser($connect, $idUrl);
                        break;
                    case 'auth':
                        authUser($connect, $_GET['login'], $_GET['password']);
                        break;

                    default:
                        http_response_code(418);
                        echo "Такого типа запроса нет.";
                        break;
                }
            break;
            case 'POST':
                    switch($typeUrl){
                        case 'create-user':
                        
                        #Забыл прописать, чтобы в POST можно было через RAW передавать значения в виде JSON
                        #НАЧАЛО
                        $dataUser = file_get_contents('php://input');
                        $dataUser = json_decode($dataUser, true);
                        #КОНЕЦ
                        addUser($connect, $dataUser);
                        break;
                        
                        default:
                            http_response_code(418);
                            echo "Такого типа запроса нет.";
                            break;
                }
        break;
        default:
        
            break;
    }
?>