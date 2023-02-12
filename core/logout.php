<?php
session_start();
setcookie('name', '', time()-3600);
unset($_SESSION['user']);
header('Location: ../authorization.php');