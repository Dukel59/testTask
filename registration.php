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
    <title>Авторизация и регистрация</title>
    <link rel="stylesheet" href="assetes/css/main.css">
</head>
<body>

<div class="container">
    <form action="" id="registrationForm">
        <label>Login</label>
        <input type="text" name="login" id="login" placeholder="Enter Login" class="form-control" require>
        <p class="msg-login-error none">Lorem ipsum.</p><br>
        <label>Password</label>
        <input type="password" name="password" id="password" placeholder="Enter password" class="form-control" require>
        <p class="msg-password-error none">Lorem ipsum.</p><br>
        <label>Confirm Password</label>
        <input type="password" name="confirm-password" id="confirm-password" placeholder="Confirm password"
               class="form-control" require>
        <p class="msg-confirm-password-error none">Lorem ipsum.</p><br>
        <label>Email</label>
        <input name="email" id="email" name="email" placeholder="email" class="form-control" require>
        <p class="msg-email-error none">Lorem ipsum.</p><br>
        <label>Name</label>
        <input name="text" id="name" name="name" placeholder="Enter name" class="form-control" require>
        <p class="msg-name-error none">Lorem ipsum.</p><br>
        <button id="sendRegistration" type="button" name="button" class="btn">Send</button>
        <p><a href="authorization.php">Authorization</a></p>
        <p class="msg none"></p>
    </form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="assetes/js/fromRegistration.js"></script>
</body>
</html>