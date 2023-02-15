<?php
session_start();

if ($_SESSION['user']) {
    header('Location: /');
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Authorization</title>
    <link rel="stylesheet" href="assetes/css/main.css">
</head>
<body>

<div class="container">
    <form action="" id="authForm">
        <label>Login</label>
        <input type="text" name="login" id="login" placeholder="Enter Login">
        <p class="msg-login-error none"></p><br>
        <label>Password</label>
        <input type="password" name="password" id="password" placeholder="Enter password">
        <p class="msg-password-error none"></p><br>
        <button id="sendAuth" type="button" name="button" class="btn">Send</button>
        <p><a href="registration.php">Registration</a></p>
        <p class="msg none"></p>
    </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="assetes/js/fromAuthorization.js"></script>

</body>
</html>