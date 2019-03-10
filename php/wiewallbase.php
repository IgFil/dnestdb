<?php
require '../db.php';
?>
<html>
<head>
    <title>Базы данных</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="/css/main.css">
</head>
<body>
<h1>Базы данных</h1>
<h2>Здесь находяться все базы данных сайта</h2>
<?php

if (!isset($_SESSION['id'])) {
    echo '<meta http-equiv="refresh" content="0;URL=/index.php">';

}

?>
<nav class="top-menu">
    <ul class="menu-main">
        <li class="left-item"><a href="/">Главная</a></li>
        <li class="left-item"><a href="wiewbase1.php">База №1</a></li>
        <li class="left-item"><a href="wiewbase2.php">База №2</a></li>

    </ul>
</nav>
</body>
</html>
