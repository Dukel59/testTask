<?php
require_once 'core/setCookie.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
</head>
<body>

<form>
    <h2 style="margin: 10px 0;">Hello <?= $name ?></h2>
    <a href="core/logout.php" class="logout">Выход</a>
</form>

</body>
</html>