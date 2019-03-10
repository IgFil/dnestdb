<?php
require '../db.php';
?>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <title>О сайте</title>
</head>
<body>
<h1> О сайте </h1>

<nav class="top-menu">
    <ul class="menu-main">
        <?
        if (isset($_SESSION['id'])) {
            echo '<li class="left-item"> <a href="/">Главная</a>
        </li>
        <li class="right-item"> <a href="logout.php">Выйти</a>
        </li>
        <li class="left-item"> <a href="cabinet.php">' . $_SESSION['login'] . '</a>
        </li>
       ';

        } else {

            echo '<li class="left-item"> <a href="login.php">Авторизация</a> </li>
<li class="left-item"> <a href="registration.php">Регистрация</a> </li>';
        }
        ?>
    </ul>
</nav>
<?
if (isset($_SESSION['id'])) {
    echo '<p id=info>Сайт предназначен для поиска людей в определённой местности по заданным параметрам. Здесь вы сможете найти человека для работы,для знакомства. Всю информацию и мнение о человеке определяют его знакомые соответственно нектоторые данные могут быть ошибочные.  Модерация слидит за достоверностью информации.</p>';

}
?>


</body>
</html>