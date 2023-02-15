<?php

session_start();
require_once '../models/User.php';
require_once '../models/UserService.php';

use models\User;
use models\UserService;


if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {

    $service = new UserService();

    $login = $_POST['login'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $id = 1;
    $regexFromLogin = '/^(\S{6,})$/';
    $regexFromPassword = '/^(?=.*[a-z])(?=.*\d)[a-zA-Z\d]{6,}$/';
    $regexFromEmail = '/^[\w_-]+@[\w_-]+\.[a-z]{2,6}$/';
    $regexFromName = '/^([a-zA-Z]{2,})$/';
    $errorFields = [];

    if (preg_match($regexFromLogin, $login) != 1) {
        $errorFields[] = 'login';
    }
    if (preg_match($regexFromPassword, $password) != 1) {
        $errorFields[] = 'password';
    }
    if ($password !== $confirmPassword) {
        $errorFields[] = 'confirmPassword';
    }
    if (preg_match($regexFromEmail, $email) != 1) {
        $errorFields[] = 'email';
    }
    if (preg_match($regexFromName, $name) != 1) {
        $errorFields[] = 'name';
    }
    if (!empty($errorFields)) {
        $response = [
            "status" => false,
            "type" => 1,
            "fields" => $errorFields
        ];
        echo json_encode($response);
        die();
    }

    $users = $service->getUsers();
    if ($service->getUserByEmail($email)) {
        $errorFields[] = 'email';
    }
    if ($service->getUserByLogin($login)) {
        $errorFields[] = 'login';
    }
    if (!empty($errorFields)) {
        $response = [
            "status" => false,
            "type" => 2,
            "fields" => $errorFields
        ];
        echo json_encode($response);
        die();
    }

    if ($users) {
        $id = count($users) + 1;
    }

    $user = $service->addUser(new User($id, $login, $password, $email, $name));
    if ($user) {
        $_SESSION['user'] = [
            "id" => $user->getId(),
            "userName" => $user->getName(),
        ];
        $response = [
            "status" => true
        ];
    } else {
        $response = [
            "status" => false,
            "type" => 3
        ];
    }
    echo json_encode($response);
}

