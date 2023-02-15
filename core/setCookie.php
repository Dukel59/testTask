<?php

session_start();

if (!isset($_SESSION['user'])) {
    header('Location: ../authorization.php');
} else {
    setcookie('name', $_SESSION['user']['userName']);
    $name = $_COOKIE['name'];
}