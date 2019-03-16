<?php
require '../db.php';
require '../php/online.php';
include '../php/users_online.php';
?>
<html>
<head>
    <title>Админ Панель</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="/css/main.css">

</head>
<body>
<header>

    <?php if (!isset($_SESSION['admin'])) {
        echo '<meta http-equiv="refresh" content="0;URL=/index.php">';

    } ?>
    <h1>Админ Панель</h1>
    <nav class="top-menu">
        <ul class="menu-main">
            <li class="left-item"><a href="info_users.php">Статистика пользователей</a></li>
            <li class="left-item"><a href="support_team.php">Служба поддрежки</a></li>
        </ul>


    </nav>
</header>

</body>
</html>