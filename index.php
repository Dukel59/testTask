<?php
session_start();

if(!isset($_SESSION['user'])){
    header('Location: ../authorization.php');
} else{
    setcookie('name', $_SESSION['user']['userName']);
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
</head>
<body>

<form>
    <h2 style="margin: 10px 0;">Hello <?= $_COOKIE['name'] ?></h2>
    <a href="core/logout.php" class="logout">Выход</a>
</form>

</body>
</html>