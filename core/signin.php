<?php
session_start();

require_once '../models/UserService.php';
use models\UserService;

if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){

    $service = new UserService();

    $login = $_POST['login'];
    $password = $_POST['password'];

    $errorFields = [];
    $regexFromPassword = '/(\w{6,})/';

    if(strlen($login) < 5){
        $errorFields[] = 'login';
    }
    if(preg_match($regexFromPassword, $password) != 1){
        $errorFields[] = 'password';
    }

    if(!empty($errorFields)){
        $response = [
            "status" => false,
            "type" => 1,
            "fields" => $errorFields
        ];
        echo json_encode($response);
        die();
    }

    $user = $service->getUserByLogin($login);

    if($user && $user->getPassword() == sha1($user->getSault().$password)){
        $_SESSION['user'] = [
            "id" => $user->getId(),
            "userName" => $user->getName(),
        ];
        $response = [
            "status" => true
        ];

    } else{
        $response = [
            "status" => false,
            "type" => 2
        ];
    }
    echo json_encode($response);
}
